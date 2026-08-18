<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

/**
 * Ejecuta la prueba de Cypress FUERA del proceso web.
 *
 * Cypress arranca un navegador Electron completo: 400 MB-1 GB de RAM y hasta
 * varios minutos. Hacerlo dentro de una peticion HTTP, como estaba antes en
 * ClienteController::runCypressTest(), tumba un servidor web de 1 GB y agota
 * el tiempo de PHP-FPM. Encolandolo, el navegador corre en el nodo de datos
 * (donde vive el worker) y el nodo web se limita a servir HTTP.
 *
 * El resultado se deja en cache, que apunta al Redis compartido por los dos
 * nodos, asi que el web lo lee sin hablar con el worker.
 */
class EjecutarPruebaCypress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** Margen por encima del timeout del proceso, para que mande Symfony y no la cola. */
    public int $timeout = 320;

    public int $tries = 2;

    public function __construct(public readonly string $idTarea)
    {
        // Cola dedicada: solo la sirven los nodos con Node y el binario de
        // Cypress (B1 y B2). El nodo de datos atiende 'default' y nunca recibe
        // este trabajo, para no pelear por RAM con MariaDB.
        //
        // Se fija con onQueue() y NO con una propiedad $queue: el trait
        // Queueable ya declara esa propiedad, y redeclararla con un valor por
        // defecto distinto es un error fatal de composicion en PHP 8.3.
        $this->onQueue('cypress');
    }

    public static function claveCache(string $idTarea): string
    {
        return "cypress:resultado:{$idTarea}";
    }

    public function handle(): void
    {
        Cache::put(self::claveCache($this->idTarea), ['estado' => 'ejecutando'], now()->addHour());

        // Process en vez de exec(): permite acotar el tiempo y capturar stderr,
        // cosa que el exec() original no hacia (perdia el motivo real del fallo).
        $proceso = new Process(
            [
                'npx', 'cypress', 'run',
                '--spec', base_path('cypress/cypress/e2e/get_image_link.cy.js'),
                '--config-file', base_path('cypress/cypress.config.js'),
                '--quiet',
            ],
            base_path(),
            null,
            null,
            300.0
        );

        $proceso->run();

        $resultado = [
            'estado'  => $proceso->isSuccessful() ? 'completado' : 'fallido',
            'codigo'  => $proceso->getExitCode(),
            'salida'  => $proceso->getOutput(),
            'errores' => $proceso->getErrorOutput(),
        ];

        if (! $proceso->isSuccessful()) {
            Log::warning('Prueba de Cypress fallida', [
                'tarea'  => $this->idTarea,
                'codigo' => $proceso->getExitCode(),
            ]);
        }

        Cache::put(self::claveCache($this->idTarea), $resultado, now()->addHour());
    }

    public function failed(\Throwable $e): void
    {
        Cache::put(self::claveCache($this->idTarea), [
            'estado'  => 'fallido',
            'errores' => $e->getMessage(),
        ], now()->addHour());
    }
}

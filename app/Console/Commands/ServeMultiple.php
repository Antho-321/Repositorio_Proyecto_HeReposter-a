<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeMultiple extends Command
{
    protected $signature = 'serve:multiple';
    protected $description = 'Serve the application';

    public function handle()
    {
        $server1Cmd = ['php', 'artisan', 'serve'];

        $server1 = new Process($server1Cmd);

        $server1->start();

        $this->info('Server started on http://localhost:8000');
        // $this->info(public_path());

        while ($server1->isRunning()) {
            sleep(1);
        }

        $this->error('The server has stopped unexpectedly.');

        // Cleanup: Stop the process if it's still running
        $server1->stop();
    }
}

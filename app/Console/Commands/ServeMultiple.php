<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeMultiple extends Command
{
    protected $signature = 'serve:multiple';
    protected $description = 'Serve the application on multiple ports';

    public function handle()
    {
        $server1Cmd = ['php', 'artisan', 'serve'];
        $server2Cmd = ['php', '-d', 'display_errors=1', '-d', 'error_reporting=E_ALL', '-S', 'localhost:7000', base_path().'/cypress/router.php'];

        $server1 = new Process($server1Cmd);
        $server2 = new Process($server2Cmd);

        $server1->start();
        $server2->start();

        $this->info('Servers started on http://localhost:8000 and http://localhost:7000');
        // $this->info(public_path());

        while ($server1->isRunning() && $server2->isRunning()) {
            sleep(1);
        }

        $this->error('One of the servers has stopped unexpectedly.');

        // Cleanup: Stop remaining processes if they're still running
        $server1->stop();
        $server2->stop();
    }
}
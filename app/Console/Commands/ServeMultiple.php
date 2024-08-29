<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeMultiple extends Command
{
    protected $signature = 'serve:multiple';
    protected $description = 'Serve the application on multiple ports';

    public function handle()
    {
        $server1Cmd = 'php artisan serve > /dev/null 2>&1 & echo $!';
        $server2Cmd = 'php artisan serve --port=8001 > /dev/null 2>&1 & echo $!';

        exec($server1Cmd, $server1Output);
        exec($server2Cmd, $server2Output);

        $server1Pid = (int) $server1Output[0];
        $server2Pid = (int) $server2Output[0];

        $this->info('Servers started on http://localhost:8000 and http://localhost:8001');

        while (posix_getpgid($server1Pid) && posix_getpgid($server2Pid)) {
            sleep(1);
        }

        $this->error('One of the servers has stopped unexpectedly.');

        // Cleanup: Kill remaining processes if they're still running
        posix_kill($server1Pid, SIGTERM);
        posix_kill($server2Pid, SIGTERM);
    }
}
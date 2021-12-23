<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\Cron\CronJobController;

class PrecheckServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * cd .\script\
     
     
     * @command : php artisan precheck:init
     * 
     * 
     * 
     */
    protected $signature = 'precheck:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializing Websocket server to receive and manage connections';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        (new CronJobController())->index();
    }
}

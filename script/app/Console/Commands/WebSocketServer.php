<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\WebSocketController;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * cd .\script\
     
     * ./openssl genrsa -des3 -out private_key.pem 2048
     *  
     * // Create a certificate signing request (CSR).
     * ./openssl req -new -key private_key.pem -out pchess_net.csr  
     * // Sign the CSR.
     * ./openssl x509 -req -days 365 -in pchess_net.csr -signkey pchess_net.pem -out pchess_net.crt
     * Decrypt the RSA private key.
     * ../../apache/bin/openssl rsa -in private_key.pem -out self-signed-certificate.pem
     * @command : php artisan websocket:init
     * 
     * 
     * 
     */
    protected $signature = 'websocket:init';

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
        if( stripos('ws://', env('WEBSOCKET_PROTOCAL'))!==false)
        {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new WebSocketController()
                    )
                ),
                env('WEBSOCKET_PORT')
            );
            $server->run();
        }
        else
        {   # wss://
            $loop = \React\EventLoop\Factory::create(); 
            $webSock = new \React\Socket\SecureServer( 
                new \React\Socket\Server('0.0.0.0:'.env('WEBSOCKET_PORT'), $loop), 
                    $loop, 
                    [
                        'local_cert'        => env('CERT_PATH_CERT'),// path to your cert 
                        'local_pk'          => env('CERT_PATH_KEY'), // path to your server private key 
                        'allow_self_signed' => TRUE,                    // Allow self signed certs (should be false in production) 
                        'verify_peer'       => FALSE                    // Ratchet magic 
                    ] 
                ); 
            $webSock->on('error', function (Exception $e) {
                echo 'Error' . $e->getMessage() . PHP_EOL;
            });
            $webServer = new \Ratchet\Server\IoServer( 
                new \Ratchet\Http\HttpServer( 
                    new \Ratchet\WebSocket\WsServer( 
                        new WebSocketController() ) )
                , $webSock ); 
            $loop->run();

         }
           ## for client 
            /*
            \Ratchet\Client\connect(getenv('SOCKET_URL').':'.getenv('SOCKET_PORT'))
                    ->then(
                        function ($conn)        // connect success
                        { 
                            $conn->send('test message'); 
                            $conn->close(); echo "closed"; 
                        }, 
                        function ($e)           // connect failed
                        { 
                            var_dump("Could not connect: {$e->getMessage()}\n"); 
                        }
                    );
            ##<--- */
    }
}

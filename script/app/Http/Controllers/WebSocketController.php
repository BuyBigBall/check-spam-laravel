<?php
namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\TrashMail;
use App\Http\Controllers\Mailstester\EmailTestController;

class WebSocketController extends Controller implements MessageComponentInterface{
    
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        
        $this->replyUnreadMailID($from, $msg);
        $from->close();
    }

    public function replyUnreadMailID(ConnectionInterface $from, $msg){

        // $from->send($msg);

        $temp = 0;
        $client_info = json_decode($msg);
        //print_r($msg); print('\n');print_r($client_info); 
        $email = $client_info->email;
        
        while(1){
            // json_encode(['result'=>'ok', 'message_id'=>$id, 'email'=>$email] );
            $reply_msg = EmailTestController::temporaryEmailCheck($email);
            //foreach ($this->clients as $client) { $client->send($reply_msg); }
            $result_json = json_decode($reply_msg);

            if($result_json->result=='ok')
            {
                $from->send($reply_msg);
                print($temp . ' ' . $reply_msg .'             ');
                break;
            }


            usleep(1000000);            $temp++;
            if($temp > env('WAIT_TIMEOUT_SECONDS') ) break;
        }
    }

    
}
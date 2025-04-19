<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $userConnections;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->userConnections = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);
        
        switch($data->type) {
            case 'connect':
                // Store user connection
                $this->userConnections[$data->userId] = $from;
                echo "User {$data->userId} connected\n";
                break;
                
            case 'message':
                // Send message to recipient
                if (isset($this->userConnections[$data->receiver])) {
                    $recipient = $this->userConnections[$data->receiver];
                    $recipient->send(json_encode([
                        'type' => 'message',
                        'sender' => $data->sender,
                        'message' => $data->message,
                        'time' => date('g:i A')
                    ]));
                }
                break;
                
            case 'typing':
                // Send typing indicator to recipient
                if (isset($this->userConnections[$data->receiver])) {
                    $recipient = $this->userConnections[$data->receiver];
                    $recipient->send(json_encode([
                        'type' => 'typing',
                        'sender' => $data->sender
                    ]));
                }
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        // Remove user connection
        $userId = array_search($conn, $this->userConnections);
        if ($userId !== false) {
            unset($this->userConnections[$userId]);
        }
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Create WebSocket server
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run(); 
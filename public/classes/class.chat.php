<?php
namespace ChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

	protected $clients = false;
	private $welcome = false;
	private $array = array();

	public function __construct() {
		$this->clients = new \SplObjectStorage;
	}
	public function onOpen(ConnectionInterface $conn) {

		//store the new connection
		$this->clients->attach($conn);
 		$this->welcome = "{$conn->resourceId} joined";        

		//Converting to JSON
		$this->array = array (
			'message'=>$this->welcome
			);
		$this->welcome = json_encode($this->array);
		foreach($this->clients as $client) {
			$client->send($this->welcome);
		}
	}
	public function onMessage(ConnectionInterface $from, $msg) {

		//send the message to all clients connected
		foreach($this->clients as $client) {
			$client->send($msg);
		}
	}
	public function onClose(ConnectionInterface $conn) {

		$this->clients->detach($conn);
		echo "Somone has disconnected\n";
	}
	public function onError(ConnectionInterface $conn, \Exception $e) {

		echo "An error has ocured: {$e->getMessage()}\n";
		$conn->close();
	}
}

<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

 $connection = new AMQPStreamConnection('shrimp-01.rmq.cloudamqp.com', 5672, 'gafnmalf', 'dfidH6NSrF-w5gZkZ25zXNsVsViFLI7P');
 $channel = $connection->channel();

 $channel->queue_declare('hello', false, false, false, false);
 
 echo " [*] Waiting for messages. To exit press CTRL+C\n";
 
 $callback = function ($msg) {
     echo ' [x] Received ', $msg->body, "\n";
 };
 
 $channel->basic_consume('hello', '', false, true, false, false, $callback);
 
 while ($channel->is_consuming()) {
     $channel->wait();
 }
 
 $channel->close();
 $connection->close();
 ?>
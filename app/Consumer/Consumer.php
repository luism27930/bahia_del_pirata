<?php
require_once __DIR__ . '/vendor/autoload.php';
require('VideoDownloader.php');
use PhpAmqpLib\Connection\AMQPStreamConnection;
    $connection = new AMQPStreamConnection('shrimp-01.rmq.cloudamqp.com', 5672, 'gafnmalf', 'dfidH6NSrF-w5gZkZ25zXNsVsViFLI7P','gafnmalf');
    $channel = $connection->channel();
    $channel->queue_declare('default', false, true, false, false);
    echo "\n [*] Waiting for messages \n";
    $callback = function ($msg) {
        echo "\n Llegó...\n";
        $video=json_decode($msg->body);
        $Downloader = new VideoDownloader();
        $Downloader->download($video);
    };
    $channel->basic_consume('default', '', false, true, false, false, $callback);
    while ($channel->is_consuming()) {
        $channel->wait();
    }
    $channel->close();
    $connection->close();
?>
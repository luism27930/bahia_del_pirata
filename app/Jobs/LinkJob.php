<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class LinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    public function _contruct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $connection = new AMQPStreamConnection('shrimp-01.rmq.cloudamqp.com', 5672, 'gafnmalf', 'dfidH6NSrF-w5gZkZ25zXNsVsViFLI7P');
        $channel = $connection->channel();
        $channel->queue_declare('default', true, false, false, false);
        $message = $this->data;
        $msg = new AMQPMessage(json_encode($message));
        $channel->basic_publish($msg, '', 'default');
        $channel->close();
        $connection->close();
    }
}

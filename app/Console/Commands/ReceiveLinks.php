<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ReceiveLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $connection = new AMQPStreamConnection('shrimp-01.rmq.cloudamqp.com', 5672, 'gafnmalf', 'dfidH6NSrF-w5gZkZ25zXNsVsViFLI7P');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

    }
}

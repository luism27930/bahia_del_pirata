<?php

namespace App\Console\Commands;
use App\Jobs\LinkJob;
use Illuminate\Console\Command;

class SendLinks extends Command
{

    protected $signature = 'link';

    protected $description = 'Para enviar los links';


    public function handle()
    {
        LinkJob::dispatch();
        
    }
}

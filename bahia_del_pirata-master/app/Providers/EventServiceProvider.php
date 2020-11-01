<?php

namespace App\Providers;
use App\Jobs\LinkJob;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
 
    public function boot()
    {
        \App::bindMethod(LinkJob::class.'@handle', function($job){ 
    
        return $job->handle();
    
    } );

    }
}

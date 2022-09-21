<?php

namespace App\Listeners;

use App\Events\HomeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HomeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(HomeEvent $event) {
        info("[HomeEventListener]: Efetuou Login");
        info($event->msg);
    }

}

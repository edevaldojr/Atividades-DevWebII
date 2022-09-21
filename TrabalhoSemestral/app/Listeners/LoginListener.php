<?php

namespace App\Listeners;

use App\Mail\NewLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        info("[LoginListener]: Usuário Autenticou!");
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        info("[LoginListener]: ".$event->user->email);
        info("[LoginListener]: ".$event->user->name);
        Mail::to($event->user)->send(
            new NewLogin($event->user)
        );

    }
}

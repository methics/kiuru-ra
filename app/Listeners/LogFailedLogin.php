<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class LogFailedLogin
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

    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        //For logging activity
        $ip = $_SERVER["REMOTE_ADDR"];

        $userID = $event->user->getAuthIdentifier();
        $userName = $event->user->name;

        activity("login")->causedBy($userID)->withProperties(["IP"=>$ip])->log("$userName Failed to login");
    }
}

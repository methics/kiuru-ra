<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;


class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //For logging activity
        $ip = $_SERVER["REMOTE_ADDR"];

        $userID     = Auth::user()->id;
        $userName   = Auth::user()->name;
        activity("login")->causedBy($userID)->withProperties(["IP"=>$ip])->log("$userName logged in");

    }
}

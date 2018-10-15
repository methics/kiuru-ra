<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Session;




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

        $session = session("mobileidlogin");

        if(isset($session) && $session == true){
            $userName = session("msisdn");
        }else{
            $userName = Auth::user()->name;
        }
        //For logging activity
        $ip         = $_SERVER["REMOTE_ADDR"];
        $userID     = Auth::user()->id;
        activity("login")->causedBy($userID)->withProperties(["IP"=>$ip,"user"=>$userName])->log("$userName logged in");


    }

}

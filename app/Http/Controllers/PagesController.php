<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MRegModel;
use Spatie\Activitylog\Models\Activity;


class PagesController extends Controller
{

    public function __construct(){
    }

    public function index(){
        return view("pages.index");
    }

    public function registration(){
        $cfg = config("registration.RequiredFields");

        return view("pages.registration")->with("cfg",$cfg);
    }


    public function lookup(){
        return view("pages.lookup");
    }

    public function AdminDashboard(){
        return view("pages.dashboard");
    }

    public function Profile(){
        return view("pages.profile");
    }

    public function Logs($id){


        if($id == "default"){
            $activity = Activity::where("log_name","default")->paginate(5);

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "lookup"){
            $activity = Activity::where("log_name","lookup")->paginate(5);

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "createmobileuser"){
            $activity = Activity::where("log_name","createmobileuser")->paginate(5);

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "deletemobileuser"){
            $activity = Activity::where("log_name","deletemobileuser")->paginate(5);
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "all"){
            $activity = Activity::paginate(5);
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "deactivate"){
            $activity = Activity::where("log_name","deactivatemobileuser")->paginate(5);
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "editmobileuser"){
            $activity = Activity::where("log_name","editmobileuser")->paginate(5);
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "login"){
            $activity = Activity::where("log_name","login")->paginate(5);
            return view("logs.default")->with("activities",$activity);
        }

        $activity = Activity::paginate(5);
        return view("logs.default")->with("activities",$activity);

    }

    public function SearchLogs(Request $request){
        $text = $request->input("search");

        $logs = Activity::where("log_name",$text)->orWhere("description","like","%" . $text . "%")->get();

        return view("logs.searchresult")->with("activities",$logs);

    }




}

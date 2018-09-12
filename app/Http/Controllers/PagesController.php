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

    public function EditMobileUser($msisdn){
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $fields = array();
        $foundFields = array();

        for($i = 0; $i < $count; $i++){
            $mregName = $cfg[$i]["mregname"];

            array_push($fields,$mregName);

        }

        print_r($fields);


        $model = new MRegModel();
        $data = $model->GetMobileUserData($msisdn);

        $array = json_decode($data,true);

        foreach($array["MSS_RegistrationResp"]["UseCase"]["Outputs"] as $key=>$val) {
            foreach ($val as $k => $v) {

                $value = $v;
                if(in_array($value,$fields)){
                    echo $value;
                }

            }
        }

        //return view("pages.editmobileuser")->with("cfg",$cfg)->with("data",$data);

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
            $activity = Activity::where("log_name","default")->get();

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "lookup"){
            $activity = Activity::where("log_name","lookup")->get();

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "createmobileuser"){
            $activity = Activity::where("log_name","createmobileuser")->get();

            return view("logs.default")->with("activities",$activity);
        }

        if($id == "deletemobileuser"){
            $activity = Activity::where("log_name","deletemobileuser")->get();
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "all"){
            $activity = Activity::all();
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "deactivate"){
            $activity = Activity::where("log_name","deactivatemobileuser")->get();
            return view("logs.default")->with("activities",$activity);
        }

        if($id == "editmobileuser"){
            $activity = Activity::where("log_name","editmobileuser")->get();
            return view("logs.default")->with("activities",$activity);
        }



    }




}

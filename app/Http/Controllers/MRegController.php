<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\MRegModel;

class MRegController extends Controller
{


    public function GetUserDataByMsisdn($msisdn){
        $model = new MRegModel();
        $body = $model->GetMobileUserData($msisdn);

        return $body;
    }

    public function CheckIfUserExists($msisdn){
        $data = $this->GetUserDataByMsisdn($msisdn);
        $obj = json_decode($data);

        //returning true or false throws error, why? 0 and 1 for now
        //0 = user doesnt exist
        if(isset($obj->Fault->Reason) && $obj->Fault->Reason == "NO_SUCH_MOBILEUSER"){
            return 0;
        }else{
            return 1;
        }

    }

    public function CreateMobileUser(Request $request){

        $this->validate($request,[
            "msisdn" => "required",
            "fname" => "required",
            "lname" => "required",
            "language" =>  "required",
            "ssn" => "required",
            "address" => "required",
            "address2" => "",
            "city" => "required",
            "stateorprovince" => "required",
            "postalcode" => "required",
            "country" => "required"
        ]);

        $msisdn = $request->input("msisdn");
        $fname = $request->input("fname");
        $lname = $request->input("lname"); //rename to surname?
        $lang = $request->input("language");
        $ssn = $request->input("ssn");
        $address = $request->input("address");
        $address2 = $request->input("address2");
        $city = $request->input("city");
        $stateOrProvince = $request->input("stateorprovince");
        $postalcode = $request->input("postalcode");
        $country = $request->input("country");


        $model = new MRegModel();
        $data = $model->CreateMobileUser($msisdn,$fname,$lname,$lang,$ssn,$address,$address2,$city,$stateOrProvince,$postalcode,$country);
        $obj = json_decode($data);



        if(isset($obj->Fault->Reason)){
            print_r($obj);
        }else{
            //start activating user
        }


    }

    public function ActivateMobileUser(){

    }


    public function DeactivateMobileUser(){

    }

}

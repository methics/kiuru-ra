<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;

use App\MRegModel;
use PhpParser\Error;
use Redirect;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MRegController extends Controller
{

    public function __construct(){
        $this->middleware("auth");
    }

    public function GetUserDataByMsisdn($msisdn){
        $model = new MRegModel();
        $body = $model->GetMobileUserData($msisdn);
        return $body;
    }

    public function CheckIfUserExists($msisdn){
        $data = $this->GetUserDataByMsisdn($msisdn);
        $obj = json_decode($data);
        if(isset($obj->Fault->Reason) && $obj->Fault->Reason == "NO_SUCH_MOBILEUSER"){
            return true;
        }else{
            return false;
        }
    }

    public function LookupUser(Request $request){

        $this->validate($request,[
            "msisdn" => "required",
        ]);

        $msisdn = $request->input("msisdn");

        $data = $this->GetUserDataByMsisdn($msisdn);


        if($this->ErrorOrNot($data) == true){
            return Redirect::back()->withErrors(["this MSISDN doesnt exist", "MSISDN doesnt exist"])->withInput();
        }

        $array = json_decode($data,true);
        //TODO: config for this ????

        foreach($array["MSS_RegistrationResp"]["UseCase"]["Outputs"] as $key=>$val){
            foreach($val as $k=>$v){
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#givenName" || $v == "GivenName"){
                    $givenName = next($val);
                }
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#surName" || $v == "Surname"){
                    $surName = next($val);
                }
                if($v == "State"){
                    $state = last($val);
                }
            }
        }

        $data = array("fname"=>"$givenName","surname"=>"$surName","msisdn"=>"$msisdn","state"=>"$state");
        return view("pages.userinfo",["data" => $data]);
    }

    /*TODO: If error exists put it in a variable and echo message instead of prewritten errormsg in the code
     * feed this an JSON array
     */

    public function ErrorOrNot($body){
        $obj = json_decode($body);

        if(isset($obj->Fault->Reason)){
            return true;
        }else{
            return false;
        }
    }

    public function ActivateMobileUser($msisdn){
        $model = new MRegModel();
        $data = $model->ActivateMobileUser($msisdn);

        return $data;
    }

    public function CheckIfSimExists($msisdn){
        $model = new MRegModel();
        $data = $model->GetSimCardData($msisdn);

        if($this->ErrorOrNot($data) == false){
            return true;
        }else{
            return false;
        }
    }


    public function DeactivateMobileUser(Request $request, $msisdn){
        $msisdn = $request->route("msisdn");
        $model = new MRegModel();
        $data = $model->DeactivateUser($msisdn);

        if($this->ErrorOrNot($data) == false){
            return view("pages.lookup");
        }else{
            return Redirect::back()->withErrors(["Error deactivating user", "Error deactivating user"]);
        }
    }


    public function TestSignature(Request $request){
        $msisdn = $request->route("msisdn");
        $model = new MRegModel();
        $data = $model->TestSignature($msisdn);
        $obj = json_decode($data);

        if(isset($obj->MSS_SignatureResp->Status->StatusMessage)){
            $msg = $obj->MSS_SignatureResp->Status->StatusMessage;
        }else{
            $msg = $obj->Fault->Detail;
        }

        if($this->ErrorOrNot($data) == false){
            return response()->json(array("msg" => $msg), 200);
        }else{
            return response()->json(array("msg" => $msg), 200);
        }

    }

    public function CreateMobileUser(Request $request){

        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $array = array();//for form input validation
        $info = array();//passing input to view


        for($i = 0; $i < $count; $i++){

           $first = $cfg[$i]["formID"];
           $second = $cfg[$i]["options"];

           $array +=[$first => $second];//for validation

           $info +=[$i => $request->input($first)];

        }

        $this->validate($request,$array);
        $msisdn = $request->input("msisdn");

        if($this->CheckIfSimExists($msisdn) !== true){

            return Redirect::back()->withErrors(["SIM card doesnt exists", "SIM card doesnt exists"])->withInput();
        }

        if($this->CheckIfUserExists($msisdn) !== true){
            return Redirect::back()->withErrors(["ERROR: User already exists", "Error: User already exists"])->withInput();
        }else{

            //create user
            $model = new MRegModel();
            $data = $model->CreateMobileUser($info);
            $obj = json_decode($data);

            if(isset($obj->Fault->Reason)){
                $error = $obj->Fault->Reason;
                return Redirect::back()->withErrors(["ERROR : $error", "ERROR: Couldnt create mobile user"])->withInput();
            }else{
                $obj = $this->ActivateMobileUser($msisdn);

                if($this->ErrorOrNot($obj) !== false){
                    return view("pages.index")->with("msg","ERROR: Activation failed");
                }
            }
            return view("pages.index")->with("msg","Created user for MSISDN: {$msisdn} and started activation");
        }
    }

    public function EditMobileUserView($msisdn){
        $model = new MRegModel();
        $data = $model->GetMobileUserData($msisdn);
        $array = json_decode($data,true);

        //get required fields data
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $requiredFields = array();
        $data = array();

        //get required fields loop
        for($i = 0; $i < $count; $i++){
            $first = $cfg[$i]["mregname"];
            array_push($requiredFields,$first);
        }

        foreach($array["MSS_RegistrationResp"]["UseCase"]["Outputs"] as $key=>$val){
            foreach($val as $k=>$v){

                if($this->in_arrayi($v,$requiredFields)){
                    $value = last($val);
                    $v = strtolower($v);
                    $data[$v] = $value;
                }
            }
        }

        return view("pages.updateuser",["data" => $data])->with("cfg",$cfg);

    }

    //for case insensitive array lookup
    public function in_arrayi($needle,$haystack){
        return in_array(strtolower($needle), array_map("strtolower",$haystack));
    }

    public function UpdateUser(Request $request){
        //get required fields data
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $array = array();//for form input validation
        $info = array();//passing input to view


        for($i = 0; $i < $count; $i++){
            $first = $cfg[$i]["formID"];
            $second = $cfg[$i]["options"];

            $array +=[$first => $second];//for validation

            $info +=[$i => $request->input($first)];
        }

        $this->validate($request,$array);
        $msisdn = $request->input("msisdn");


        $model = new MRegModel();
        $data = $model->UpdateUser($info);
        $obj = json_decode($data);

        if(isset($obj->Fault->Reason)){
            $error = $obj->Fault->reason;
            return Redirect::back()->withErrors(["ERROR : $error", "ERROR: $error"])->withInput();
        }else{
            return Redirect::back()->with("msg","User edit success!");
        }
    }

}

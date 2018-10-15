<?php


namespace App\Http\Controllers;
use App\Jobs\ActivateMobileUser;
use Session;
use Illuminate\Http\Request;

use App\MRegModel;
use PhpParser\Error;
use Redirect;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;
Use Queue;


class MRegController extends Controller
{

    /**
     * Has middleware "auth" for requiring authentication
     *
     * MRegController constructor.
     */
    public function __construct(){
        $this->middleware(["auth","clearance"]);
    }


    /**
     * Gets user data from the API with curl/Guzzle using MRegModel
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     */
    public function GetUserDataByMsisdn($msisdn){

        $model = new MRegModel();
        $body = $model->GetMobileUserData($msisdn);
        return $body;
    }

    /**
     * Checks if user exists
     *
     * @param $msisdn
     * @return bool
     */
    public function CheckIfUserExists($msisdn){
        $data = $this->GetUserDataByMsisdn($msisdn);
        $obj = json_decode($data);
        if(isset($obj->Fault->Reason) && $obj->Fault->Reason == "NO_SUCH_MOBILEUSER"){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Looks up user information based on given MSISDN.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        foreach($array["MSS_RegistrationResp"]["UseCase"]["Outputs"] as $key=>$val){
            foreach($val as $k=>$v){
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#givenName" || $v == "GivenName"){
                    $givenName = next($val);
                }
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#surName" || $v == "Surname"){
                    $surName = last($val);
                }
                if($v == "State"){
                    $state = last($val);
                }
                if($v == "Country"){
                    $country = last($val);
                }
                if($v == "Language"){
                    $lang = last($val);
                }
            }
        }

        $this->ActivityLogger("lookup","looked up",$msisdn);

        $data = array("fname"=>"$givenName","surname"=>"$surName","msisdn"=>"$msisdn","state"=>"$state","country"=>$country,"lang"=>$lang);
        return view("pages.userinfo",["data" => $data]);
    }

    /**
     * Lookupuser GET method
     *
     * @param $msisdn
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function LookupUserGET($msisdn){

        $data = $this->GetUserDataByMsisdn($msisdn);

        if($this->ErrorOrNot($data) == true){
            return Redirect::back()->withErrors(["this MSISDN doesnt exist", "MSISDN doesnt exist"])->withInput();
        }

        $array = json_decode($data,true);

        foreach($array["MSS_RegistrationResp"]["UseCase"]["Outputs"] as $key=>$val){
            foreach($val as $k=>$v){
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#givenName" || $v == "GivenName"){
                    $givenName = next($val);
                }
                if($v == "http://mss.ficom.fi/TS102204/v1.0.0/PersonID#surName" || $v == "Surname"){
                    $surName = last($val);
                }
                if($v == "State"){
                    $state = last($val);
                }
                if($v == "Country"){
                    $country = last($val);
                }
                if($v == "Language"){
                    $lang = last($val);
                }
            }
        }

        $this->ActivityLogger("lookup","looked up",$msisdn);

        $data = array("fname"=>"$givenName","surname"=>"$surName","msisdn"=>"$msisdn","state"=>"$state","country"=>$country,"lang"=>$lang);
        return view("pages.userinfo",["data" => $data]);

    }

    /**
     * Takes guzzle response as a parameter and checks if Fault reason exists,
     * which means error.
     *
     * @param $body
     * @return bool
     */
    public function ErrorOrNot($body){
        $obj = json_decode($body);

        if(isset($obj->Fault->Reason)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Activates mobile user if SIM card exists
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     */
    public function ActivateMobileUser($msisdn){
        $model = new MRegModel();
        $data = $model->ActivateMobileUser($msisdn);

        return $data;
    }

    /**
     * Check if SIM card has been made. Kiuru-RA doesn't create sim cards
     *
     * @param $msisdn
     * @return bool
     */
    public function CheckIfSimExists($msisdn){
        $model = new MRegModel();
        $data = $model->GetSimCardData($msisdn);

        if($this->ErrorOrNot($data) == false){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Changes user state to INACTIVE.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DeactivateMobileUser(Request $request){
        $msisdn = $request->route("msisdn");
        $model = new MRegModel();
        $data = $model->DeactivateUser($msisdn);

        if($this->ErrorOrNot($data) == false){

            $this->ActivityLogger("deactivatemobileuser","deactivated",$msisdn);

            return response()->json(array("msg" => "Deactivation succesful"),200);
        }else{
            return response()->json(array("msg" => "Deactivation unsuccesful"),200);
        }
    }

    /**
     * Sends test signature request. This method is called with ajax on userinfo page.
     * Returns JsonResponse containing the mobile user accounts state.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            return response()->json(array("msg" => "Mobile ID test succeeded"), 200);
        }else{
            return response()->json(array("msg" => $msg), 200);
        }

    }


    /**
     * Creates a mobile user. This method includes a config containing
     * information on required fields. Validates the form input and
     * returns back to the form on error.
     *
     * Checks if SIM card exists. If user exists, returns to editable user form
     *
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function CreateMobileUser(Request $request){
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $array = array();//for form input validation
        $info = array();//passing input to view

        $formdata = $request->input("formdata");

        $values = array();
        parse_str($formdata,$values);

        $msisdn = $values["msisdn"];


        for($i = 0; $i < $count; $i++){
            $first = $cfg[$i]["formID"];
            $second = $cfg[$i]["options"];

            $array +=[$first => $second];//for validation
            $info +=[$i => $values[$first]];
        }


        //$this->validate($request,$array);


        if($this->CheckIfSimExists($msisdn) !== true){

            return response()->json(array("msg" => "SIM card doesn't exists"), 200);

        }
        if($this->CheckIfUserExists($msisdn) !== true){
            return response()->json(array("msg" => "User exists", "msisdn" => $msisdn), 200);

        }else {

            //create user
            $model = new MRegModel();
            $data = $model->CreateMobileUser($info);
            $obj = json_decode($data);

            if (isset($obj->Fault->Reason)) {
                $error = $obj->Fault->Reason;
                return response()->json(array("msg" => $error), 200);

            } else {
                $obj = $this->ActivateMobileUser($msisdn);

                if ($this->ErrorOrNot($obj) !== false) {
                   // return view("pages.index")->with("msg", "ERROR: Activation failed");
                    return response()->json(array("msg" => "activation failed"), 200);

                }
            }
            $this->ActivityLogger("createmobileuser", "created user", $msisdn);

        }
        return response()->json(array("msg" => "success", "msisdn" => $msisdn), 200);


    }

    /**
     * Returns edit view with users data.
     *
     * @param $msisdn
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

        $this->ActivityLogger("editmobileuser","edited",$msisdn);

        return view("pages.updateuser",["data" => $data])->with("cfg",$cfg);
    }

    /**
     * Used for case insensitive array handling
     *
     * @param $needle
     * @param $haystack
     * @return bool
     */
    public function in_arrayi($needle,$haystack){
        return in_array(strtolower($needle), array_map("strtolower",$haystack));
    }

    /**
     * Used for editing / updating users through edit form.
     *
     * @param Request $request
     * @return mixed
     */
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



        $this->ActivityLogger("update","updated",$msisdn);

        $model = new MRegModel();
        $data = $model->UpdateUser($info);
        $obj = json_decode($data);

        if(isset($obj->Fault->Reason)){
            $error = $obj->Fault->Reason;
            return Redirect::back()->withErrors(["ERROR : $error", "ERROR: $error"])->withInput();
        }else{
            return Redirect::back()->with("msg","User succesfully edited!");
        }
    }

    /**
     * Uses DeleteMobileUser to delete the user.
     *
     * @param $msisdn
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function DeleteUser($msisdn){
        $model = new MRegModel();
        $data = $model->DeleteMobileUser($msisdn);

        $obj = json_decode($data);

        //log activity
        $this->ActivityLogger("deletemobileuser","deleted",$msisdn);


        if(isset($obj->Fault->Reason)){
            return view("pages.lookup")->with("msg","Could not delete user");
        }else{
            return view("pages.index")->with("msg"," {$msisdn} has been deleted");
        }
    }

    /**
     * Used for reactivating mobile user. Returns JSON because of AJAX calls.
     *
     * @param $msisdn
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ReactivateMobileUser($msisdn){

        $model = new MRegModel();
        $data = $model->ReactivateMobileUser($msisdn);

        $obj = json_decode($data);

        //log activity
        $this->ActivityLogger("reactivatemobileuser","reactivated",$msisdn);
        if(isset($obj->Fault->Reason)){
            $error = $obj->Fault->Reason;
            return response()->json(array("msg" => $error),200);
        }else{
            return response()->json(array("msg" => "{$msisdn} reactivated successfully"), 200);
        }
    }

    /**
     * Logs activities to database. $log is the "logname" used to filter logs in Logs admin area.
     * $action is the message inserted, example: user DELETED 358010001.
     * $target is the MSISDN in question.
     *
     * Logs IP-addresses
     *
     * @param $log
     * @param $action
     * @param $target
     *
     */
    public function ActivityLogger($log, $action, $target){

        $ip = $_SERVER["REMOTE_ADDR"];
        $session = session("mobileidlogin");
        $userID = Auth::user()->id;

        if(isset($session) && $session == true){
            $userName = session("msisdn");
        }else{
            $userName = Auth::user()->name;
        }


        activity($log)
            ->causedBy($userID)
            ->withProperties(["IP"=>$ip,"user"=>$userName])
            ->log("$userName $action $target");
    }


}

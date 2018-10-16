<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MRegModel;
use Illuminate\Support\Facades\Auth;
use Redirect;

class MobileIDController extends Controller
{
    /**
     * Used for Mobile ID authentication.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function MobileIDLogin(Request $request){

        $this->validate($request,[
            "msisdn" => "required",
            "randomcode" => "required",//randomcode is a hidden input created when pressing Login button
        ]);

        $msisdn     = $request->input("msisdn");
        $randomcode = $request->input("randomcode");

        $model = new MRegModel();
        $data = $model->MobileIDLogin($msisdn,$randomcode);

        $array = json_decode($data,true);
        $obj = json_decode($data); //object

        if(isset($obj->Fault->Reason)){
            $error = $obj->Fault->Reason;
            return redirect::back()->withErrors(["ERROR : $error", "ERROR: $error"]);
        }

        foreach($array["MSS_SignatureResp"]["ServiceResponses"] as $key => $val){

            if(in_array("ra-user",$val["Roles"])){
                $userRole = "ra-user";
            }elseif(in_array("ra-admin",$val["Roles"])){
                $userRole = "ra-admin";
            }else{
                return view("auth.login")->with("msg","You do not have rights to use this software.");
            }
        }

        if($userRole == "ra-user"){
            $request->session()->put("mobileidlogin","true");
            $request->session()->put("msisdn",$msisdn);
            Auth::loginUsingId(3);
        }elseif($userRole == "ra-admin"){
            $request->session()->put("mobileidlogin","true");
            $request->session()->put("msisdn",$msisdn);
            Auth::loginUsingId(4);
        }else{
            return response()->json(array("success" => "false"),200);
        }




        return response()->json(array("success" => "true"),200);

    }

    public function CreateRandomCode(){
        $randomcode = substr(sha1(mt_rand()),17,5); //Generate random code with numbers and letters
        $uppercase = strtoupper($randomcode); //uppercase letters

        return response()->json(array("msg" => "{$uppercase}"),200);
    }


}

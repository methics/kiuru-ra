<?php

namespace App;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MRegModel
{

    private $url;
    private $username;
    private $password;


    public function __construct(){
        $this->url      = env("API_URL");
        $this->username = env("API_USER");
        $this->password = env("API_PASS");
    }

    public function SendPost($string_json){
        $client = new Client();
        $options = array(
            "auth" => [
                $this->username,
                $this->password
            ],
            "headers" => ["content-type" => "application/json", "Accept" => "application/json"],
            "body" => $string_json,
            "debug" => false
        );

        $res = $client->request("POST",$this->url,$options);
        $body = $res->getBody(); //gets json string
        return $body;
    }

    public function GetMobileUserData($msisdn){
        $string_json = "{
          \"MSS_RegistrationReq\": {
            \"User\": {
              \"Role\": \"enduser\"
            },
            \"UseCase\": {
              \"Name\": \"mids:GetMobileUser\",
              \"Inputs\": [{
                \"Name\": \"targetmsisdn\",
                \"Value\": \"$msisdn\"
              }]
            }
          }
        }";

        $body = $this->SendPost($string_json);
        return $body;
    }

    public function CreateMobileUser($info){
        $data = (object)$info;
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $string_start = "{
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:CreateMobileUser\",
                    \"Inputs\": [
                 ";

        $string_end = "]
                }
            }
        }";

        $string_mid = "";

        for($i = 0; $i < $count; $i++){
            $val = $data->$i;
            $name = $cfg[$i]["mregname"];

            $loopstring = "
                {
                \"Name\": \"$name\",
                \"Value\": \"$val\"
                }
                ";

            if($i == $count - 1){

            }else{
                $loopstring .= ",";
            }
            $string_mid .= $loopstring;
        }

        $string_json = $string_start . $string_mid . $string_end;

        $body = $this->SendPost($string_json);
        return $body;
    }

    public function ActivateMobileUser($msisdn){

        $string_json = "{
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:ActivateMobileUser\",
                    \"Inputs\": [{
                        \"Name\": \"targetmsisdn\",
                        \"Value\": \"$msisdn\"
                    }]
                }
            }
        }";

        $body = $this->SendPost($string_json);
        return $body;
    }

    public function GetSimCardData($msisdn){
        $string_json = "{
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:GetSimCard\",
                    \"Inputs\": [{
                        \"Name\": \"targetmsisdn\",
                        \"Value\": \"$msisdn\"
                    }]
                }
            }
        }";

        $body = $this->SendPost($string_json);
        return $body;
    }

    public function DeactivateUser($msisdn){
        $string_json = "{
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:DeactivateMobileUser\",
                    \"Inputs\": [{
                        \"Name\": \"targetmsisdn\",
                        \"Value\": \"$msisdn\"
                    }]
                }
            }
        }";

        $body = $this->SendPost($string_json);
        return $body;
    }

    public function TestSignature($msisdn){

        $cfg = config("registration.RequiredFields");
        $count = count($cfg);

        $string_json = "{
            \"MSS_SignatureReq\": {
                \"AP_Info\": {},
                \"MobileUser\": {
                    \"MSISDN\": \"$msisdn\"
                },
                \"MessagingMode\": \"synch\",
                \"DataToBeSigned\": {
                    \"MimeType\": \"text/plain\",
                    \"Encoding\": \"UTF-8\",
                    \"Data\": \"Mobile ID test\"
                },
                \"SignatureProfile\": \"http://alauda.mobi/digitalSignature\",
                \"AdditionalServices\": [{
                    \"Description\": \"http://uri.etsi.org/TS102204/v1.1.2#validate\"
                }]
            }
        }";

        $body = $this->SendPost($string_json);
        return $body;
    }
}

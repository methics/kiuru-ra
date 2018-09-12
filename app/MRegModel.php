<?php

namespace App;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MRegModel
{

    private $url;
    private $username;
    private $password;

    /**
     * MRegModel constructor. Gets API information from .env-file located in the root of the project.
     */
    public function __construct(){
        $this->url      = env("API_URL");
        $this->username = env("API_USER");
        $this->password = env("API_PASS");
    }

    /**
     * SendPost method uses guzzle to send data to API and comes back with the return.
     * After returning the variable with data, it gets returned to a controller.
     *
     * @param $string_json
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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

    /**
     * Gets all mobile user data available from api.
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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


    /**
     * Creates mobile user using API and CreateMobileUser method
     *
     * @param $info
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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


    /**
     * Activates the mobile user if possible, through API
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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

    /**
     * Gets SIM card data through API
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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

    /**
     * Deactivates user if possible, through API.
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
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

    /**
     * Tests users signature if possible. Returns "Mobile user account has state INACTIVE" if inactive,
     * and VALID_SIGNATURE if everything is ok. Configurable through registration config.
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
    public function TestSignature($msisdn){

        $cfg = config("registration.AdditionalServices");
        $count = count($cfg);

        $data = config("registration.SignatureReq.0.Data");
        $signatureProfile = config("registration.SignatureReq.0.SignatureProfile");

        $string_start = "{
            \"MSS_SignatureReq\": {
                \"AP_Info\": {},
                \"MobileUser\": {
                    \"MSISDN\": \"+$msisdn\"
                },
                \"MessagingMode\": \"synch\",
                \"DataToBeSigned\": {
                    \"MimeType\": \"text/plain\",
                    \"Encoding\": \"UTF-8\",
                    \"Data\": \"$data\"
                }, \"SignatureProfile\": \"$signatureProfile\",
                \"AdditionalServices\": [";

        $string_mid = "";
        $string_end = " ]}
            }
            ";

        for($i = 0; $i < $count; $i++){
            $description = $cfg[$i]["Description"];
            $loopstring = "{\"Description\": \"$description\"}";

            if(!$i == $count - 1){
                $loopstring .= ",";
            }

            $string_mid = $string_mid . $loopstring;
        }

        $string_json = $string_start . $string_mid  . $string_end;
        $body = $this->SendPost($string_json);
        return $body;
    }

    /**
     * Updates users information through API.
     *
     * @param $info
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
    public function UpdateUser($info){
        $data = (object)$info;
        $cfg = config("registration.RequiredFields");
        $count = count($cfg);



        $string_start  = "{
          \"MSS_RegistrationReq\": {
            \"User\": {
              \"Role\": \"enduser\"
            },
            \"UseCase\": {
              \"Name\": \"mids:UpdateMobileUser\",
              \"Inputs\": [{
                \"Name\": \"targetmsisdn\",
                \"Value\": \"$info[0]\"
              },
        ";

        $string_mid = "";

        $string_end = "]
                }
              }
            }
        ";


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

    /**
     * Deletes the mobile user
     *
     * @param $msisdn
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
    public function DeleteMobileUser($msisdn){
        $string_json = "
        {
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:DeleteMobileUser\",
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

}

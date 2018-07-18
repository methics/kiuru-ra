<?php

namespace App;

//we dont probably need this
//use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MRegModel
{

    private $url = "https://mssp.demo.methics.fi/rest/service";
    private $username = "eemeli";
    private $password = "yellowrunninglion";

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

    public function CreateMobileUser($msisdn,$fname,$lname,$lang,$ssn,$address,$address2,$city,$stateOrProvince,$postalcode,$country){

        $string_json = "{
            \"MSS_RegistrationReq\": {
                \"User\": {
                    \"Role\": \"enduser\"
                },
                \"UseCase\": {
                    \"Name\": \"mids:CreateMobileUser\",
                    \"Inputs\": [{
                        \"Name\": \"msisdn\",
                        \"Value\": \"$msisdn\"
                    }, {
                        \"Name\": \"givenName\",
                        \"Value\": \"$fname\"
                    }, {
                        \"Name\": \"surName\",
                        \"Value\": \"$lname\"
                    }, {
                        \"Name\": \"Language\",
                        \"Value\": \"$lang\"
                    }, {
                        \"Name\": \"hetu\",
                        \"Value\": \"$ssn\"
                    }, {
                        \"Name\": \"AddressLine1\",
                        \"Value\": \"$address\"
                    }, {
                        \"Name\": \"AddressLine2\",
                        \"Value\": \"$address2\"
                    }, {
                        \"Name\": \"City\",
                        \"Value\": \"$city\"
                    }, {
                        \"Name\": \"StateOrProvince\",
                        \"Value\": \"$stateOrProvince\"
                    }, {
                        \"Name\": \"ZipCode\",
                        \"Value\": \"$postalcode\"
                    }, {
                        \"Name\": \"Country\",
                        \"Value\": \"$country\"
                    }
                    ]
                }
            }
        }";

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

    public function ActivateMobileUser(){

        $string_json = "";

    }






}

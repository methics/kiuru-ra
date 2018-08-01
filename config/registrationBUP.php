<?php

//todo: put "required" into "options", we might want to check for more options than required
return [
    "RequiredFields" => [
        "0" => [
            "label" => "MSISDN",
            "type"  => "text",
            "formID" => "msisdn",
            "required" => "true",
        ],
        "1" => [
            "label" => "First name",
            "type"  => "text",
            "formID" => "fname",
            "required" => "true",
        ],
        "2" => [
            "label" => "Last name",
            "type"  => "text",
            "formID" => "lname",
            "required" => "true",
        ],
        "3" => [
            "label" => "Language",
            "type" => "text",
            "formID" => "language",
            "required" => "true",
        ],
        "4" => [
            "label" => "SSN",
            "type"  => "text",
            "formID" => "ssn",
            "required" => "true",
        ],
        "5" => [
            "label" => "address",
            "type"  => "text",
            "formID" => "address",
            "required" => "true",
        ],
        "6" => [
            "label" => "address line 2",
            "type" => "text",
            "formID" => "address2",
            "required" => "false",
        ],
        "7" => [
            "label" => "city",
            "type" => "text",
            "formID" => "city",
            "required" => "true",
         ],

        "8" => [
            "label" => "state/province",
            "type" => "text",
            "formID" => "stateorprovince",
            "required" => "true",
        ],
        "9" => [
            "label" => "postalcode",
            "type" => "text",
            "formID" => "postalcode",
            "required" => "true",
        ],
        "10" => [
            "label" => "country",
            "type" => "text",
            "formID" => "country",
            "required" => "true",
        ],
    ],


];
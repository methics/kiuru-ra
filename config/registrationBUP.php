<?php
//todo: rename to mregSOMETHING since it also handles signature requests
//options is for form validation: https://laravel.com/docs/5.6/validation#available-validation-rules
return [
    "RequiredFields" => [
        "0" => [
            "label" => "MSISDN",
            "formID" => "msisdn",
            "options" => "required", //for form validator
            "mregname" => "MSISDN"
        ],
        "1" => [
            "label" => "First name",
            "formID" => "fname",
            "options" => "required",
            "mregname" => "GivenName",
        ],
        "2" => [
            "label" => "Last name",
            "formID" => "lname",
            "options" => "required",
            "mregname" => "Surname",
        ],
        "3" => [
            "label" => "Language",
            "formID" => "language",
            "options" => "required",
            "mregname" => "Language",
        ],
        "4" => [
            "label" => "SSN",
            "formID" => "ssn",
            "options" => "required",
            "mregname" => "Hetu",
        ],
        "5" => [
            "label" => "address",
            "formID" => "address",
            "options" => "required",
            "mregname" => "AddressLine1",
        ],
        "6" => [
            "label" => "address line 2",
            "formID" => "address2",
            "options" => "",
            "mregname" => "AddressLine2",
        ],
        "7" => [
            "label" => "city",
            "formID" => "city",
            "options" => "required",
            "mregname" => "City",
        ],
        "8" => [
            "label" => "state/province",
            "formID" => "stateorprovince",
            "options" => "required",
            "mregname" => "StateOrProvince",
        ],
        "9" => [
            "label" => "postalcode",
            "formID" => "postalcode",
            "options" => "required",
            "mregname" => "ZipCode",
        ],
        "10" => [
            "label" => "country",
            "formID" => "country",
            "options" => "required",
            "mregname" => "Country",
        ]
    ],
    "SignatureReq" => [
        "0" => [
            "Data" => "Mobile ID test",
            "SignatureProfile" => "http://alauda.mobi/digitalSignature",
        ]
    ],

    "AdditionalServices" => [
        "0" => [
            "Description" => "http://uri.etsi.org/TS102204/v1.1.2#validate"
        ],


    ],


];
?>
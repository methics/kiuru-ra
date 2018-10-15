<?php
return [
    "RequiredFields" => [
        "0" => [
            "label" => "MSISDN",
            "formID" => "msisdn",
            "options" => "required", //for form validator
            "mregname" => "msisdn",
        ],
        "1" => [
            "label" => "IMSI",
            "formID" => "imsi",
            "options" => "",
            "mregname" => "IMSI",
        ],
        "2" => [
            "label" => "First Name",
            "formID" => "fname",
            "options" => "required",
            "mregname" => "givenName",
        ],
        "3" => [
            "label" => "Last name",
            "formID" => "lname",
            "options" => "required",
            "mregname" => "surName",
        ],
        "4" => [
            "label" => "Language",
            "formID" => "language",
            "options" => "required",
            "mregname" => "Language",
        ],
        "5" => [
            "label" => "SSN",
            "formID" => "ssn",
            "options" => "required",
            "mregname" => "hetu",
        ],
        "6" => [
            "label" => "address",
            "formID" => "address",
            "options" => "required",
            "mregname" => "AddressLine1",
        ],
        "7" => [
            "label" => "address line 2",
            "formID" => "address2",
            "options" => "",
            "mregname" => "AddressLine2",
        ],
        "8" => [
            "label" => "city",
            "formID" => "city",
            "options" => "required",
            "mregname" => "City",
        ],
        "9" => [
            "label" => "state/province",
            "formID" => "stateorprovince",
            "options" => "required",
            "mregname" => "StateOrProvince",
        ],
        "10" => [
            "label" => "postalcode",
            "formID" => "postalcode",
            "options" => "required",
            "mregname" => "ZipCode",
        ],
        "11" => [
            "label" => "country",
            "formID" => "country",
            "options" => "required",
            "mregname" => "Country",
        ],


    ],
    "SignatureReq" => [
        "0" => [
            "Data" => "Mobile ID test",
            "SignatureProfile" => "http://alauda.mobi/digitalSignature",
        ],
        "1" => [
            "Data" => "RA Login ",
            "SignatureProfile" => "http://alauda.mobi/digitalSignature",
        ]
    ],
    "AdditionalServices" => [
        "0" => [
            "Description" => "http://uri.etsi.org/TS102204/v1.1.2#validate"
        ],
        "1" => [
            "Description" => "http://www.methics.fi/KiuruMSSP/v5.0.0#role"
        ],

    ],
];
?>
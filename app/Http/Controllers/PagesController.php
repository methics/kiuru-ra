<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PagesController extends Controller
{

    public function __construct(){

    }

    public function index(){
        return view("pages.index");
    }

    //todo: get needed inputs from registration config
    public function registration(){

        $cfg = config("registration.RequiredFields");

        return view("pages.registration")->with("cfg",$cfg);
    }

    public function lookup(){
        return view("pages.lookup");
    }

    public function AdminDashboard(){
        return view("pages.dashboard");
    }

    public function configTest(){

        $cfg = config("registration.RequiredFields");

        /*
        $count = count($cfg);
        $i = 0;

        for($i = 0;$i < $count; $i++){

            echo $cfg[$i]["label"];
        }
        */





        return view("pages.test")->with("cfg",$cfg);
    }

}

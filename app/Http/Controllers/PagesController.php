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



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Kiuru-RA index"; //dont do this
        return view("pages.index")->with("title", $title);

    }

    public function registration(){
        return view("pages.registration");
    }

}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//page routes
Route::get("/","PagesController@index");
Route::get("/register","PagesController@registration");

//MReg routes
Route::post("/","MRegController@CreateMobileUser");

//for testing
Route::get("user/{msisdn}","MRegController@GetUserDataByMsisdn");
Route::get("usercheck/{msisdn}", "MRegController@CheckIfUserExists");

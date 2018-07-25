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
Route::get("/registration","PagesController@registration");
Route::get("/lookup","PagesController@lookup")->name("lookup");
Route::get("/dashboard","PagesController@AdminDashboard")->middleware("auth","kiuru-ra-admin");


//MReg routes
Route::post("/","MRegController@CreateMobileUser");
Route::post("/look","MRegController@LookupUser");

Route::get("/deactivate/{msisdn}","MRegController@DeactivateMobileUser");
Route::get("/testsignature/{msisdn}","MRegController@TestSignature");

//for testing
Route::get("user/{msisdn}","MRegController@GetUserDataByMsisdn");
Route::get("usercheck/{msisdn}", "MRegController@CheckIfUserExists");
Route::get("activate/{msisdn}","MRegController@ActivateMobileUser");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
Route::get("/","PagesController@index")->middleware("auth");
Route::get("/registration","PagesController@registration")->middleware("auth","clearance");
Route::get("/lookup","PagesController@lookup")->name("lookup")->middleware("auth","clearance");
//Route::get("test","PagesController@configTest");

//MReg routes
Route::post("/","MRegController@CreateMobileUser")->middleware("auth");
Route::post("/userinfo","MRegController@LookupUser")->middleware("auth");
Route::get("/deactivate/{msisdn}","MRegController@DeactivateMobileUser")->middleware("auth");
Route::get("/testsignature/{msisdn}","MRegController@TestSignature")->middleware("auth");

//for testing
Route::get("user/{msisdn}","MRegController@GetUserDataByMsisdn")->middleware("auth");
Route::get("usercheck/{msisdn}", "MRegController@CheckIfUserExists")->middleware("auth");
Route::get("activate/{msisdn}","MRegController@ActivateMobileUser")->middleware("auth");

//Route::post("/testreg","MRegController@TestCreate");


//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');//fix
//Route::get("auth/logout","Auth\AuthController@logout");

Route::resource("users","UserController")->middleware("auth");
Route::resource("roles","RoleController")->middleware("auth");
Route::resource("permissions","PermissionController")->middleware("auth");




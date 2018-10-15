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
Route::any("/home","PagesController@index")->middleware("auth"); //laravel auth uses this
Route::get("/","PagesController@index")->middleware("auth");
Route::get("/registration","PagesController@registration")->middleware("auth","clearance");
Route::any("/lookup/","PagesController@lookup")->name("lookup")->middleware("auth","clearance");
Route::get("/getlookup/{msisdn}","MRegController@LookupUserGET")->middleware("auth")->name("getlookup");
Route::get("/profile","PagesController@Profile")->middleware("auth");
Route::get("/editmobileuser/{msisdn}","PagesController@EditMobileUser")->middleware("auth","clearance");
Route::get("/logs/{id}","PagesController@Logs")->middleware("auth","clearance");
Route::any("/search","PagesController@SearchLogs")->middleware("auth");


//MReg routes
Route::post("/","MRegController@CreateMobileUser")->middleware("auth","clearance");
Route::any("/userinfo","MRegController@LookupUser")->middleware("auth");
Route::get("/deactivate/{msisdn}","MRegController@DeactivateMobileUser")->middleware("auth");
Route::get("/testsignature/{msisdn}","MRegController@TestSignature")->middleware("auth");
Route::get("/edituser/{msisdn}","MRegController@EditMobileUserView")->middleware("auth","clearance");
Route::post("/submitedits","MRegController@UpdateUser")->middleware("auth","clearance");
Route::get("/deleteuser/{msisdn}","MRegController@DeleteUser")->middleware("auth");
Route::get("/reactivate/{msisdn}","MRegController@ReactivateMobileUser")->middleware("auth");


Route::post("/reg","MRegController@CreateMobileUser")->middleware("auth","clearance");
//for testing
Route::get("user/{msisdn}","MRegController@GetUserDataByMsisdn")->middleware("auth");
Route::get("usercheck/{msisdn}", "MRegController@CheckIfUserExists")->middleware("auth");

//auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post("/changepw", "UserController@ChangePassword");

//mobile id login
Route::post("/mlogin","MobileIDController@MobileIDLogin");
Route::get("/code","MobileIDController@CreateRandomCode");

//users, roles and permissions
Route::resource("users","UserController")->middleware("auth");
Route::resource("roles","RoleController")->middleware("auth");
Route::resource("permissions","PermissionController")->middleware("auth");
Route::put("users.edit/{id}","UserController@update")->middleware("auth");



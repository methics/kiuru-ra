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
Route::get("/","PagesController@index")->middleware("auth"); //index/home page
Route::get("/registration","PagesController@registration")->middleware("auth","clearance"); //Mobile user registration form
Route::any("/lookup/","PagesController@lookup")->name("lookup")->middleware("auth","clearance"); //lookup form
Route::get("/getlookup/{msisdn}","MRegController@LookupUserGET")->middleware("auth")->name("getlookup"); //look up with GET
Route::get("/profile","PagesController@Profile")->middleware("auth"); //user profile
Route::get("/logs/{id}","PagesController@Logs")->middleware("auth","clearance"); //logs page
Route::any("/search","PagesController@SearchLogs")->middleware("auth"); //search functionality for log page


//MReg routes
Route::any("/userinfo","MRegController@LookupUser")->middleware("auth"); //page showing user info
Route::get("/deactivate/{msisdn}","MRegController@DeactivateMobileUser")->middleware("auth"); //deactivation route
Route::get("/testsignature/{msisdn}","MRegController@TestSignature")->middleware("auth"); //test signature route
Route::get("/edituser/{msisdn}","MRegController@EditMobileUserView")->middleware("auth","clearance"); //edit user form page
Route::post("/submitedits","MRegController@UpdateUser")->middleware("auth","clearance");//route to submit edited information & update
Route::get("/deleteuser/{msisdn}","MRegController@DeleteUser")->middleware("auth"); //delete user route
Route::get("/reactivate/{msisdn}","MRegController@ReactivateMobileUser")->middleware("auth"); //reactivation route
Route::post("/reg","MRegController@CreateMobileUser")->middleware("auth","clearance"); //create mobile user route


//Laravel Auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post("/changepw", "UserController@ChangePassword");

//mobile id login
Route::post("/mlogin","MobileIDController@MobileIDLogin"); //mobile ID login
Route::get("/code","MobileIDController@CreateRandomCode"); //gets the 5 digit authentication code shown on your phone

//users, roles and permissions
Route::resource("users","UserController")->middleware("auth");
Route::resource("roles","RoleController")->middleware("auth");
Route::resource("permissions","PermissionController")->middleware("auth");
Route::put("users.edit/{id}","UserController@update")->middleware("auth");



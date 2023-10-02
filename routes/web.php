<?php


use Illuminate\Support\Facades\Route;

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



Route::middleware(["check.login"])->group(function(){
    Route::get("login","App\Http\Controllers\LoginController@login")->name("login");
    Route::get("islogin","App\Http\Controllers\LoginController@callback");   
});


Route::get("/","App\Http\Controllers\LoginController@islogin")->name("islogin");
Route::middleware(["auth","sub"])->group(function () {
 
    Route::get("account","App\Http\Controllers\LoginController@account");
    Route::get("scripts","App\Http\Controllers\ScriptController@script")->name("script");
    Route::post("scripts/store","App\Http\Controllers\ScriptController@store_script")->name("scripts_store");
    Route::post("scripts/delete","App\Http\Controllers\ScriptController@delete_scripts")->name("scripts_delete");
    Route::post("scripts/update","App\Http\Controllers\ScriptController@update_form_scripts")->name("updatescripts");
    
    Route::get("subs","App\Http\Controllers\Subscontroller@index");
    
    Route::get("actievs","App\Http\Controllers\ScriptController@actievs");
    Route::post("actievs/store","App\Http\Controllers\ScriptController@store_active")->name("actievs");
    Route::post("actievs/update_actievs","App\Http\Controllers\ScriptController@update_active")->name("update_actievs");
    Route::post("actievs/delete","App\Http\Controllers\ScriptController@delete")->name("delete");
    Route::post("actievs/update","App\Http\Controllers\ScriptController@update_form_actievs")->name("updateactievs");
    

});
Route::middleware(["auth"])->group(function () {

Route::get("/buy/{product_id}/{plan_id}", "App\Http\Controllers\Subscontroller@token_payment");
Route::post("/buy/done", "App\Http\Controllers\Subscontroller@create_sub");
Route::get("/product", "App\Http\Controllers\Subscontroller@index");
});
Route::group(['prefix' => 'admin', "middleware" => ['auth']], function () {
    Route::get("cpanel","App\Http\Controllers\CpanelController@index")->name("cpanel");
    Route::post("cpanel/store","App\Http\Controllers\CpanelController@store")->name("cpanel_store");
    Route::post("free/store","App\Http\Controllers\CpanelController@givefree")->name("free");
    Route::post("ban/store","App\Http\Controllers\CpanelController@ban")->name("ban");
    Route::post("delete/store","App\Http\Controllers\CpanelController@delete")->name("delete_cpanel");

});
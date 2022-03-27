<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

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



Route::get('/',[HomeController::class,"index"]);

Route::get('/pocetna',[HomeController::class,"index"])->name('home');
Route::get('/autor',[HomeController::class,"author"])->name('author');
Route::get('vikendice',[VenueController::class,"index"])->name("vikendice.index");
Route::get('vikendice/{vikendice}',[VenueController::class,"show"])->where('vikendice', '[0-9]+')->name("vikendice.show");

Route::group(["middleware" => "logged"],function(){

    Route::get('prijava',[AuthController::class,"loginForm"])->name('login');
    Route::get('registracija',[AuthController::class,"registerForm"])->name('register');
    Route::post("registracija",[AuthController::class,"register"])->name("doRegister");
    Route::post("prijava",[AuthController::class,"login"])->name("doLogin");
});

Route::group(["middleware" => "notLogged"],function(){
    Route::get('profil',[AuthController::class,"profile"])->name('profile');
    Route::get('promena_lozinke',[AuthController::class,"changePasswordForm"])->name('changePasswordForm');
    Route::post('promena_lozinke',[AuthController::class,"changePassword"])->name('changePassword');
    Route::get('oglasi/{id}',[VenueController::class,"getUserVenues"])->name('oglasi');
    Route::get('vikendiceTabela',[VenueController::class,"paginateTable"]);
    Route::delete('obrisiSliku/{id}',[VenueController::class,"deleteImageWhenEditing"])->name("deleteImageWhenEditing");
    Route::get("odjava",[AuthController::class,"logout"])->name("logout");
    Route::post("rezervacija",[VenueController::class,"reserveVenue"])->name("reserve");
    Route::resource("vikendice",VenueController::class)->except("index","show");

    Route::group(["middleware"=>"notAdmin","prefix"=>"admin"],function(){
        Route::get("dashboard",[AdminController::class,"index"])->name("dashboard");
        Route::patch("ban",[AdminController::class,"banUser"])->name("ban");
        Route::get("venues",[AdminController::class,"venues"])->name("venues.index");
        Route::get("venuesCreate",[AdminController::class,"create"])->name("venues.create");
        Route::delete("venues",[AdminController::class,"destroy"])->name("venues.destroy");


        Route::resource("users",UserController::class)->only(["index","create","store"]);
        Route::resource("categories",CategoryController::class)->except(["show","edit","update"]);
        Route::resource("locations",LocationController::class)->except(["show","edit","update"]);

    });

});



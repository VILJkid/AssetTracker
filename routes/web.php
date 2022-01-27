<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AssetType;
use App\Http\Controllers\Asset;
use App\Http\Middleware\ActiveSession;
use App\Http\Middleware\RedirectToDash;

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

Route::get('/', function () {
    return view('welcome');
});

//This will redirect logged in users to the dashboard.
Route::middleware([RedirectToDash::class])->group(
    function () {
        //Login
        Route::get('/login', [Auth::class, "login"]);

        //Validation part for Login
        Route::post('/login_check', [Auth::class, "login_check"]);
    }
);

//This will redirect guests to the login page.
Route::middleware([ActiveSession::class])->group(
    function () {
        // # Auth Controller

        //Logout
        Route::get('/logout', [Auth::class, "logout"]);

        //Dashboard
        Route::get('/dashboard', [Auth::class, "dashboard"]);

        //Fetching the asset stats to dashboard
        Route::post('/getstats', [Auth::class, "getstats"]);

        // # Asset Type Controller

        //Create Asset Type
        Route::get('/createat', [AssetType::class, "createat"]);

        //Validation part for creating Asset Type
        Route::post('/createat_check', [AssetType::class, "createat_check"]);

        //Displaying Asset Type
        Route::get('/showat', [AssetType::class, "showat"]);

        //Editing Asset Type
        Route::post('/editat', [AssetType::class, "editat"]);

        //Validation part for editing Asset Type
        Route::post('/editat_check', [AssetType::class, "editat_check"]);

        //Delete ASset Type
        Route::post('/delat', [AssetType::class, "delat"]);

        // # Asset Controller

        //Create Asset
        Route::get('/createasset', [Asset::class, "createasset"]);

        //Validation part for creating Asset
        Route::post('/createasset_check', [Asset::class, "createasset_check"]);

        //Display Asset
        Route::get('/showasset', [Asset::class, "showasset"]);

        //Display Asset Image
        Route::post('/showimage', [Asset::class, "showimage"]);

        //Change Asset Status
        Route::post('/changestatus', [Asset::class, "changestatus"]);

        //Edit Asset
        Route::post('/editasset', [Asset::class, "editasset"]);

        //Validation part for editing Asset Type
        Route::post('/editasset_check', [Asset::class, "editasset_check"]);

        //Delete Asset
        Route::post('/delasset', [Asset::class, "delasset"]);
    }
);

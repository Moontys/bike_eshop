<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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


Route::get('/', [HomeController::class, 'homeAndProduct']);   // Home page
Route::get('/bicycles', [HomeController::class, 'homeAndProduct']); // Product page


Route::get('/contact', [ContactController::class, 'contact']); // Contact page

Route::get('/need_a_bike_repair', [ContactController::class, 'bikeRepair']); // Need a Bike repair? page


Route::get('/cart', function () {

    return view('pages.cart');

});




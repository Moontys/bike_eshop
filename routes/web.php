<?php

use App\Http\Controllers\CartController;
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


Route::get('/', [HomeController::class, 'homeAndProduct']); // Home page = Product page displaying all categories, each featuring it's most popular bicycle based on views.

Route::get('/bicycles', [HomeController::class, 'homeAndProduct']); // Product page displaying all categories, each featuring it's most popular bicycle based on views.

Route::get('/all_bicycles', [HomeController::class, 'allBicycles']);    // Product page displaying all categories and their respective bicycles.




Route::get('/contact', [ContactController::class, 'contact']);  // Contact page

Route::get('/need_a_bike_repair', [ContactController::class, 'bikeRepair']);    // Contac page for bicycle repair




Route::get('/cart', [CartController::class, 'cart']);   // Cart page




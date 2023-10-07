<?php

use App\Http\Controllers\AuthlikefornowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*

Route::get('/', function () {
    return view('welcome');
});

*/


Route::get('/', [HomeController::class, 'homePageAndTopBicycles']); // Home page = Product page displaying all categories, each featuring it's most popular bicycle based on views.

Route::get('/bicycles', [HomeController::class, 'homePageAndTopBicycles']); // Product page displaying all categories, each featuring it's most popular bicycle based on views.

Route::get('/all-bicycles', [HomeController::class, 'allBicycles']);    // Product page displaying all categories and their respective bicycles.

Route::get('/bicycle/{id}', [HomeController::class, 'displayBicycle']); // Page displaying the selected bicycle's details




Route::get('/add-product', [ProductController::class, 'addProduct']);

Route::post('/save-product', [ProductController::class, 'saveAddedProduct']);





Route::get('/contact', [ContactController::class, 'contact']);  // Contact page

Route::get('/need_a_bike_repair', [ContactController::class, 'bikeRepair']);    // Contact page for bicycle repair services




Route::get('/cart', [CartController::class, 'cart']);   // Cart page







Route::get('/admin-like-for-now', [AuthlikefornowController::class, 'adminLikeForNow']);








<?php

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



Route::get('/', [HomeController::class, 'home_product']);   // Home page


Route::get('/bicycles', [HomeController::class, 'home_product']); // Product page




Route::get('/contact', function () {

    return view('pages.contact');
});


Route::get('/cart', function () {

    return view('pages.cart');

});


Route::get('/need_a_bike_repair', function () {

    return view('pages.need_a_bike_repair');
    
});

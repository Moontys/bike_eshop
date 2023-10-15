<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthlikefornowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;





Route::get('/', [ClientController::class, 'home']);

Route::get('/shop', [ClientController::class, 'shop']);

Route::get('/cart', [ClientController::class, 'cart']);

Route::get('/checkout', [ClientController::class, 'checkout']);

Route::get('/login', [ClientController::class, 'login']);

Route::get('/signup', [ClientController::class, 'signup']);






// Route::get('/welcome', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';





// Route::get('/', [HomeController::class, 'homePageAndTopBicycles']); // Home page = Product page displaying all categories, each featuring it's most popular bicycle based on views.

// Route::get('/bicycles', [HomeController::class, 'homePageAndTopBicycles']); // Product page displaying all categories, each featuring it's most popular bicycle based on views.

// Route::get('/all-bicycles', [HomeController::class, 'allBicycles']);    // Product page displaying all categories and their respective bicycles.

// Route::get('/bicycle/{id}', [HomeController::class, 'displayBicycle']); // Page displaying the selected bicycle's details






// Route::get('/admin-like-for-now/product/{id}', [ProductController::class, 'displayProduct']);


// Route::get('/admin-like-for-now/add-product', [ProductController::class, 'addProduct']);

// Route::post('/admin-like-for-now/save-product', [ProductController::class, 'saveAddedProduct']);


// Route::get('/admin-like-for-now/edit-product/{id}', [ProductController::class, 'editProduct']);

// Route::post('/admin-like-for-now/update-product', [ProductController::class, 'updateEditedProduct']);


// Route::get('/admin-like-for-now/delete-product/{id}', [ProductController::class, 'deleteProduct']);




// Route::get('/contact', [ContactController::class, 'contact']);  // Contact page

// Route::get('/need_a_bike_repair', [ContactController::class, 'bikeRepair']);    // Contact page for bicycle repair services




// Route::get('/cart', [CartController::class, 'cart']);   // Cart page







// Route::get('/admin-like-for-now', [AuthlikefornowController::class, 'adminLikeForNow']);






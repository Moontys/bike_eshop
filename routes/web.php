<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthlikefornowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;




Route::get('/', [ClientController::class, 'home']);

Route::get('/shop', [ClientController::class, 'shop']);

Route::get('/cart', [ClientController::class, 'cart']);

Route::get('/checkout', [ClientController::class, 'checkout']);

Route::get('/login', [ClientController::class, 'login']);

Route::get('/signup', [ClientController::class, 'signup']);





Route::get('/admin', [AdminController::class, 'admin']);





Route::get('/all-categories', [CategoryController::class, 'allCategories']);

Route::get('/add-category', [CategoryController::class, 'addCategory']);

Route::post('/save-category', [CategoryController::class, 'saveAddedCategory']);

Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory']);

Route::post('/update-category', [CategoryController::class, 'updateEditedCategory']);

Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);





Route::get('/add-slider', [SliderController::class, 'addSlider']);

Route::get('/all-sliders', [SliderController::class, 'allSliders']);





Route::get('/all-products', [ProductController::class, 'allProducts']);

Route::get('/add-product', [ProductController::class, 'addProduct']);

Route::post('/save-product', [ProductController::class, 'saveAddedProduct']);




Route::get('all-orders', [OrderController::class, 'allOrders']);





// Route::get('/welcome', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';



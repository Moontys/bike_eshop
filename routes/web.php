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




Route::get('/all-sliders', [SliderController::class, 'allSliders']);

Route::get('/add-slider', [SliderController::class, 'addSlider']);

Route::post('/save-slider', [SliderController::class, 'saveAddedSlider']);

Route::get('/edit-slider/{id}', [SliderController::class, 'editSlider']);

Route::post('/update-slider', [SliderController::class, 'updateEditedSlider']);

Route::get('/delete-slider/{id}', [SliderController::class, 'deleteSlider']);

Route::get('/activate-slider/{id}', [SliderController::class, 'activateSlider']);

Route::get('/unactivate-slider/{id}', [SliderController::class, 'unactivateSlider']);




Route::get('/all-products', [ProductController::class, 'allProducts']);

Route::get('/add-product', [ProductController::class, 'addProduct']);

Route::post('/save-product', [ProductController::class, 'saveAddedProduct']);

Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']);

Route::post('/update-product', [ProductController::class, 'updateEditedProduct']);

Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

Route::get('/activate-product/{id}', [ProductController::class, 'activateProduct']);

Route::get('/unactivate-product/{id}', [ProductController::class, 'unactivateProduct']);




Route::get('all-orders', [OrderController::class, 'allOrders']);





// Route::get('/welcome', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';



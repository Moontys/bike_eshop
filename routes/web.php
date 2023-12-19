<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthlikefornowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SliderController;
use App\Models\Discount;

// Route::get('/', [ClientController::class, 'home']);



Route::get('/cart', [ClientController::class, 'cart']);

Route::get('/add-to-cart/{id}', [ClientController::class, 'addToCart']);

Route::post('/update-quantity/{id}', [ClientController::class, 'updateQuantity']);

Route::get('/remove-from-cart/{id}', [ClientController::class, 'removeFromCart']);

Route::get('/checkout', [ClientController::class, 'checkout']);

Route::get('/login', [ClientController::class, 'login']);

Route::get('/signup', [ClientController::class, 'signup']);

Route::post('/create-account', [ClientController::class, 'createAccount']);

Route::get('/access-account', [ClientController::class, 'accessAccount']);

Route::post('/post-checkout', [ClientController::class, 'postCheckout']);

Route::get('/paiement-success', [ClientController::class, 'paymentSuccess']);

Route::get('/log-out', [ClientController::class, 'logOut']);

Route::get('all-orders', [ClientController::class, 'allOrders']);




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

Route::get('/products-by-category/{category_name}', [ProductController::class, 'productsByCategory']);

Route::get('/', [ProductController::class, 'shop']);

Route::get('/shop', [ProductController::class, 'shop']);

Route::get('/display-product/{id}', [ProductController::class, 'displayProduct']);

// Route::get('/products-by-category/All', [ProductController::class, 'shop']);




Route::get('/all-discounts', [DiscountController::class, 'allDiscounts']);

Route::get('/add-discount', [DiscountController::class, 'addDiscount']);

Route::post('/save-discount', [DiscountController::class, 'saveAddedDiscount']);

Route::get('/edit-discount/{id}', [DiscountController::class, 'editDiscount']);

Route::post('/update-discount', [DiscountController::class, 'updateEditedDiscount']);

Route::get('/delete-discount/{id}', [DiscountController::class, 'deleteDiscount']);



// Route::get('/items', [ClientController::class, 'pagination']);



Route::get('/view-pdf-order/{id}', [PdfController::class, 'viewPdfOrder']);



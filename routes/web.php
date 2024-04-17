<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;

// Route::get('/', function () {
//     return view('site.index');
// });
Route::get('/', [IndexController::class, 'openHomePage'])->name('site.home');
Route::get('product/{id}', [IndexController::class, 'getProductDetails'])->name('site.product.details');
Route::get('cart', [IndexController::class, 'openCartPage']);
Route::get('checkout', [IndexController::class, 'openCheckoutPage']);

Route::get('add_to_cart', [IndexController::Class, 'addProductIntoCart'])->name('add.to.cart');
Route::get('calculate/cart_items', [IndexController::Class, 'calculateCartItems'])->name('calculate.add.to.cart');


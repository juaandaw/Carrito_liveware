<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\PaymentOrder;
use App\Http\Livewire\ShoppingCart;
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

Route::get('/', WelcomeController::class);

Route::get('categories/{category}',[CategoryController::class,'show'])->name('categories.show');

Route::get('products/{product}', [\App\Http\Controllers\ProductsController::class,'show'])->name('products.show');

Route::get('search', SearchController::class)->name('search');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::get('orders/create', CreateOrder::class)->middleware('auth')->name('orders.create');

Route::get('orders/{order}',[OrderController::class, 'show'])->name('orders.show');

Route::get('orders/{order}/payment',PaymentOrder::class)->name('orders.payment');

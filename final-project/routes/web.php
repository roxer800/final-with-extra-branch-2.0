<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\isAdminCheck;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {

    // პროფილი
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // პროდუქტები
    Route::get('/products/create', [ProductController::class, 'create'])->middleware(isAdminCheck::class)->name('products.create');
    Route::post('/product', [ProductController::class, 'store'])->middleware(isAdminCheck::class)->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->middleware(isAdminCheck::class)->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->middleware(isAdminCheck::class)->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware(isAdminCheck::class)->name('product.destroy');

    // კალათა
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::delete('/basket/{productsId}', [BasketController::class, 'destroy'])->name('basket.destroy');
    Route::post('basket/add/{productId}', [BasketController::class, 'addToBasket'])->name('basket.add');



    // კატეგორიები
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    // შეკვეთები
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::delete('/orders', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->middleware(isAdminCheck::class)->name('order.update');

    // admin panel routes
    Route::get('/admin', [AdminPanelController::class, 'index'])->middleware(isAdminCheck::class)->name('admin.index');
    Route::post('/admin/store', [AdminPanelController::class, 'store'])->name('admin.store');
});


require __DIR__ . '/auth.php';

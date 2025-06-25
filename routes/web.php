<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Models\Category; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file defines all browser-accessible routes in the application.
| These routes are loaded by the RouteServiceProvider and assigned to the "web" middleware group.
|
*/

// Public route to the welcome/landing page (non-authenticated users)
Route::get('/', function () {
    $categories = Category::with('products')->get();
    return view('home', compact('categories'));
});

// Dashboard route, accessible only to authenticated and verified users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes grouped under "auth" middleware (must be logged in)
Route::middleware('auth')->group(function () {

    // Profile routes (edit/update/delete account)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Product Catalog Routes
    |--------------------------------------------------------------------------
    */

    // Full CRUD routes for managing products
    Route::resource('products', ProductController::class);

    // Full CRUD routes for managing categories
    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | Order Management (Future Feature)
    |--------------------------------------------------------------------------
    */

    // Routes for order management (optional, you can skip implementing the logic for now)
    Route::resource('orders', OrderController::class);
});

// web.php
Route::get('/products', [ProductController::class, 'index'])->name('products.index');


// Includes authentication routes like login, register, password reset
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ==========================================================
// PUBLIC ROUTES
// ==========================================================

// Landing page with product categories
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages (About Us, Safety Rules, FAQs, Contact Us)
Route::view('/aboutus', 'aboutus')->name('aboutus');
Route::view('/safetyrules', 'safetyrules')->name('safetyrules');
Route::view('/faqs', 'faqs')->name('faqs');
Route::view('/contactus', 'contactus')->name('contactus');

// Route to redirect to first product in a category
Route::get('/category/{slug}', [ProductController::class, 'redirectToFirstProduct']);

// Public product viewing
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ==========================================================
// DASHBOARD (Authenticated Users Only)
// ==========================================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================================
// AUTH ROUTES
// ==========================================================
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product CRUD (non-admin version)
    Route::resource('products', ProductController::class)->except(['show', 'index']);

    // Category CRUD (non-admin version)
    Route::resource('categories', CategoryController::class);

    // Order Management (optional/future)
    Route::resource('orders', OrderController::class);
});

// ==========================================================
// ADMIN ROUTES (Protected by RoleMiddleware directly)
// ==========================================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', RoleMiddleware::class . ':admin,product-manager'])
    ->group(function () {

    // Admin Dashboard (admin only)
    Route::get('/', [AdminController::class, 'index'])
        ->name('index')
        ->middleware(RoleMiddleware::class . ':admin');

    // Product CRUD (admin + product-manager)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Category CRUD (admin only)
    Route::resource('categories', AdminCategoryController::class)
        ->middleware(RoleMiddleware::class . ':admin');

    // User Management (admin only)
    Route::resource('users', AdminUserController::class)
        ->only(['index', 'edit', 'update'])
        ->middleware(RoleMiddleware::class . ':admin');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

require __DIR__.'/auth.php';

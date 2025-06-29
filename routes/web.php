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
use App\Http\Controllers\AdminUserController; // ADD THIS LINE
use App\Http\Middleware\RoleMiddleware;
use App\Models\Category;


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
// Home Route
Route::get('/', function () {
    $categories = Category::all();
    return view('home', compact('categories'));
})->name('home');

// View Rentals Route
Route::get('/viewrentals', function () {
    $categories = Category::all();
    return view('viewrentals', compact('categories'));
})->name('viewrentals');



// Route to redirect to first product in a category
Route::get('/category/{slug}', [ProductController::class, 'redirectToFirstProduct']);

// Public product viewing
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ==========================================================
// DASHBOARD - REDIRECT TO ADMIN (for logged in users)
// ==========================================================
Route::get('/dashboard', function () {
    if (auth()->check()) {
        // Check if user has admin role, redirect to admin panel
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'product-manager' || auth()->user()->role === 'new') {
            return redirect()->route('admin.index');
        }
        // For regular users, you can create a different dashboard or redirect to home
        return redirect()->route('home');
    }
    return redirect()->route('login');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================================
// AUTH ROUTES (for regular users)
// ==========================================================
Route::middleware('auth')->group(function () {

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product CRUD (non-admin version) - only for regular users
    Route::resource('products', ProductController::class)->except(['show', 'index']);

    // Category CRUD (non-admin version) - only for regular users
    Route::resource('categories', CategoryController::class);

    // Order Management (optional/future)
    Route::resource('orders', OrderController::class);
});

// ==========================================================
// ADMIN ROUTES (Protected by Role Middleware)
// ==========================================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', RoleMiddleware::class . ':admin,product-manager,new'])
    ->group(function () {

    // Admin Dashboard - accessible by both admin and product-manager
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Product CRUD (admin + product-manager)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Category CRUD (admin + product-manager)
    Route::resource('categories', AdminCategoryController::class);

    // User management (admin only) - REPLACE THE OLD ROUTE WITH THIS:
    Route::resource('users', AdminUserController::class)
        ->middleware(RoleMiddleware::class . ':admin');

    // Other future admin-only routes can go here
});

// Auth routes (includes login, register, etc.)
require __DIR__.'/auth.php';
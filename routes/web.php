<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/**
 * Routes untuk Web Portfolio Application
 * 
 * File ini mendefinisikan semua routes untuk aplikasi.
 * Routes dikelompokkan berdasarkan fungsi: public, auth, dan admin.
 */

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Routes yang bisa diakses oleh semua visitor tanpa authentication.
| Ini adalah bagian frontend dari portfolio website.
|
*/

// Home page - Halaman utama dengan featured projects
Route::get('/', [HomeController::class, 'index'])->name('home');

// About page - Informasi tentang portfolio owner
Route::view('/about', 'about')->name('about');

// Portfolio routes - Listing dan detail projects
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    // List semua portfolio projects dengan pagination dan search
    Route::get('/', [PortfolioController::class, 'index'])->name('index');
    
    // Detail single project
    Route::get('/{project}', [PortfolioController::class, 'show'])->name('show');
});

// Contact routes - Contact form
Route::prefix('contact')->name('contact')->group(function () {
    // Contact form page
    Route::get('/', [ContactController::class, 'index']);
    
    // Submit contact form
    Route::post('/', [ContactController::class, 'submit'])->name('.submit');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Routes untuk login, register, dan logout functionality.
| Menggunakan Laravel's built-in authentication scaffolding.
|
*/

// Login routes
Route::middleware('guest')->group(function () {
    // Show login form
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    
    // Process login
    Route::post('/login', [LoginController::class, 'login']);
    
    // Show register form
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    
    // Process registration
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout route (requires authentication)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes untuk admin dashboard dan management.
| Semua routes ini dilindungi dengan 'auth' middleware.
| Hanya user yang sudah login yang bisa akses.
|
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Admin dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Project management (CRUD)
    // Menggunakan resource routes untuk generate semua CRUD routes
    Route::resource('projects', AdminProjectController::class);
    
    // Additional project routes
    Route::post('projects/{id}/restore', [AdminProjectController::class, 'restore'])
        ->name('projects.restore');
    Route::delete('projects/{id}/force', [AdminProjectController::class, 'forceDestroy'])
        ->name('projects.force-destroy');
});

/*
|--------------------------------------------------------------------------
| Error Pages Routes
|--------------------------------------------------------------------------
|
| Routes untuk custom error pages.
| Laravel akan otomatis redirect ke error pages ini jika terjadi error.
|
*/

// Fallback route untuk 404 - Page not found
Route::fallback(function () {
    return view('errors.404');
});


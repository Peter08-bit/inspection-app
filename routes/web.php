<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Matériels CRUD
    Route::resource('materiels', MaterielController::class);

    // Inspections CRUD
    Route::resource('inspections', InspectionController::class)->except(['show']);

    // Users CRUD
    Route::resource('users', UserManagementController::class)->except(['show']);
});

// User routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/materiels', [UserDashboardController::class, 'materiels'])->name('materiels');
    Route::get('/inspections', [UserDashboardController::class, 'inspections'])->name('inspections');
});

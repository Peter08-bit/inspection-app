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

// Routes Chat
Route::middleware('auth')->prefix('chat')->name('chat.')->group(function () {
    Route::get('/groupe', [App\Http\Controllers\MessageController::class, 'groupChat'])->name('group');
    Route::post('/groupe/envoyer', [App\Http\Controllers\MessageController::class, 'sendGroup'])->name('group.send');
    Route::get('/prive/{user}', [App\Http\Controllers\MessageController::class, 'privateChat'])->name('private');
    Route::post('/prive/{user}/envoyer', [App\Http\Controllers\MessageController::class, 'sendPrivate'])->name('private.send');
    Route::get('/non-lus', [App\Http\Controllers\MessageController::class, 'unreadCount'])->name('unread');
    Route::get('/users-statut', [App\Http\Controllers\MessageController::class, 'usersStatus'])->name('chat.users.status');
    Route::get('/messages/prive/{user}', [App\Http\Controllers\MessageController::class, 'getPrivateMessages'])->name('chat.messages.private');
    Route::get('/messages/groupe', [App\Http\Controllers\MessageController::class, 'getGroupMessages'])->name('chat.messages.group');
    Route::post('/marquer-lu/{user}', [App\Http\Controllers\MessageController::class, 'markAsRead'])->name('chat.mark.read');
});

Route::middleware('auth')->prefix('chat')->name('chat.')->group(function () {
    Route::get('/groupe', [App\Http\Controllers\MessageController::class, 'groupChat'])->name('group');
    Route::post('/groupe/envoyer', [App\Http\Controllers\MessageController::class, 'sendGroup'])->name('group.send');
    Route::get('/prive/{user}', [App\Http\Controllers\MessageController::class, 'privateChat'])->name('private');
    Route::post('/prive/{user}/envoyer', [App\Http\Controllers\MessageController::class, 'sendPrivate'])->name('private.send');
    Route::get('/non-lus', [App\Http\Controllers\MessageController::class, 'unreadCount'])->name('unread');
    Route::get('/users-statut', [App\Http\Controllers\MessageController::class, 'usersStatus'])->name('users.status');
    Route::get('/messages/prive/{user}', [App\Http\Controllers\MessageController::class, 'getPrivateMessages'])->name('messages.private');
    Route::get('/messages/groupe', [App\Http\Controllers\MessageController::class, 'getGroupMessages'])->name('messages.group');
    Route::post('/marquer-lu/{user}', [App\Http\Controllers\MessageController::class, 'markAsRead'])->name('mark.read');
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RequestController;
use App\Http\Middleware\IsAdmin;

// Home
Route::get('/', function () {
    return view('LandingPage.index');
})->name('welcome');

// Request Routes
Route::post('/request/store', [RequestController::class, 'store'])->name('request.store');
Route::get('/request/{id}/download', [RequestController::class, 'downloadDocument'])->name('request.download');
Route::get('/request/{id}/view', [RequestController::class, 'viewDocument'])->name('request.view');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.show')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/requests', [AdminController::class, 'requests'])->name('admin.requests');
    Route::post('/requests/{id}/status', [AdminController::class, 'updateRequestStatus'])->name('admin.request.status');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
});

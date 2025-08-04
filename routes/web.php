<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ViolationCategoryController;
use App\Http\Controllers\ViolationTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page - Student Violations Management
Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Students - All users can view, only administrators can manage
    Route::resource('students', StudentController::class);
    
    // Violations - All users can create and view, teachers can only see their own
    Route::resource('violations', ViolationController::class)->except(['edit', 'update']);
    
    // Violation Categories - All users can view, only administrators can manage
    Route::resource('violation-categories', ViolationCategoryController::class);
    
    // Violation Types - All users can view, only administrators can manage
    Route::resource('violation-types', ViolationTypeController::class);
    
    // Users - Only administrators can manage
    Route::resource('users', UserController::class)->except(['edit', 'update']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
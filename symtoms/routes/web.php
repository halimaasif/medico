<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;

Route::get('/symptom-checker', [SymptomController::class, 'index'])
    ->name('symptoms.index')
    ->middleware('auth'); 
// Symptom Checker Route
Route::post('/symptoms-check', [SymptomController::class, 'checkSymptoms'])
    ->name('symptoms.check')
    ->middleware('auth');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Authentication Actions
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// History page dekhne ke liye
Route::get('/history', [HistoryController::class, 'index'])->name('diagnostic.history');

// Data save karne ke liye (AJAX request yahan aayegi)
Route::post('/save-diagnostic', [HistoryController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    // Profile Settings page ka route
    Route::get('/profile/settings', [App\Http\Controllers\SymptomController::class, 'profileSettings'])->name('profile.settings');
    Route::get('/diagnostic-history', [App\Http\Controllers\SymptomController::class, 'diagnosticHistory'])->name('diagnostic.history');
    Route::get('/get-symptom-json', [App\Http\Controllers\SymptomController::class, 'getSymptomDataJson'])->name('symptom.json');
    
});
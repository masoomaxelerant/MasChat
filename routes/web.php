<?php

use App\Http\Controllers\MasChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;

Route::get('/', [MasChatController::class, 'index']);

// Protected routes
Route::middleware('auth')->group(function () {
  Route::post('/maschats', [MasChatController::class, 'store']);
  Route::get('/maschats/{maschat}/edit', [MasChatController::class, 'edit']);
  Route::put('/maschats/{maschat}', [MasChatController::class, 'update']);
  Route::delete('/maschats/{maschat}', [MasChatController::class, 'destroy']);
});

// Registration routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');
 
Route::post('/register', Register::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');
 
Route::post('/login', Login::class)
    ->middleware('guest');
 
// Logout route
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');
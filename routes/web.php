<?php

use App\Http\Controllers\MasChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Register;

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
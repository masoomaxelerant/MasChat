<?php

use App\Http\Controllers\MasChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MasChatController::class, 'index']);

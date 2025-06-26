<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuitController;
use App\Http\Controllers\AuthController;

Route::get('/', [CuitController::class, 'index'])->name('home')->middleware('auth');

Route::get('/log', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/regis', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

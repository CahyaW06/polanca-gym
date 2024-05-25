<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginUserController;

Route::get('/', [Controller::class, 'home']);

Route::get('/login', [LoginUserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginUserController::class, 'autentificate']);
Route::post('/logout', [LoginUserController::class, 'logout']);
Route::get('/login-adm', [Controller::class, 'loginAdmin']);

Route::resource("/register", RegisterController::class);


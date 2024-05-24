<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginUserController;

Route::get('/', [Controller::class, 'home']);

Route::resource('/login', LoginUserController::class);
Route::get('/login-adm', [Controller::class, 'loginAdmin']);

Route::resource("/register", RegisterController::class);


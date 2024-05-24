<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'home']);

Route::get('/login', [Controller::class, 'loginUser']);
Route::get('/login-adm', [Controller::class, 'loginAdmin']);

Route::get("/register", [Controller::class, 'register']);

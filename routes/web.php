<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginUserController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [Controller::class, 'home']);

Route::get('/login', [LoginUserController::class, 'index'])->middleware("guest");
Route::post('/login', [LoginUserController::class, 'autentificate']);
Route::post('/logout', [LoginUserController::class, 'logout']);

Route::get('/login-adm', [LoginAdminController::class, 'index']);
Route::post('/login-adm', [LoginAdminController::class, 'autentificate']);
Route::post('/logout-adm', [LoginAdminController::class, 'logout']);

Route::resource("/register", RegisterController::class);

// Admin
Route::get('/adm-member', [AdminController::class, 'gotoMember'])->middleware(AdminMiddleware::class);
Route::post('/adm-update-member', [AdminController::class, 'updateMember'])->middleware(AdminMiddleware::class);

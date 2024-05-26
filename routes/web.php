<?php

use App\Http\Controllers\AdmClassController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdmMemberController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\LoginAdminController;

Route::get('/', [Controller::class, 'home']);

Route::get('/login', [LoginUserController::class, 'index'])->middleware("guest");
Route::post('/login', [LoginUserController::class, 'autentificate']);
Route::post('/logout', [LoginUserController::class, 'logout']);

Route::get('/login-adm', [LoginAdminController::class, 'index']);
Route::post('/login-adm', [LoginAdminController::class, 'autentificate']);
Route::post('/logout-adm', [LoginAdminController::class, 'logout']);

Route::resource("/register", RegisterController::class);

// Admin --> member page
Route::get('/adm-member', [AdmMemberController::class, 'gotoMember'])->middleware(AdminMiddleware::class);
Route::post('/adm-member', [AdmMemberController::class, 'gotoMemberWithSearch'])->middleware(AdminMiddleware::class);
Route::post('/adm-update-member', [AdmMemberController::class, 'updateMember'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-apply-letter', [AdmMemberController::class, 'downloadApplyLetter'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-cv', [AdmMemberController::class, 'downloadCV'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-certificates', [AdmMemberController::class, 'downloadCertificates'])->middleware(AdminMiddleware::class);

// Admin --> class page
Route::resource('/adm-set-class', AdmClassController::class)->middleware(AdminMiddleware::class);

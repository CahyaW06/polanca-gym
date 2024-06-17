<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdmMemberController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MemClass;
use App\Http\Controllers\TrainingClassController;
use App\Http\Middleware\MemberMiddleware;

Route::get('/', [Controller::class, 'home']);

Route::get('/login', [LoginUserController::class, 'index'])->middleware("guest");
Route::post('/login', [LoginUserController::class, 'autentificate']);
Route::post('/logout', [LoginUserController::class, 'logout']);

Route::get('/login-adm', [LoginAdminController::class, 'index'])->middleware("guest");
Route::post('/login-adm', [LoginAdminController::class, 'autentificate']);
Route::post('/logout-adm', [LoginAdminController::class, 'logout']);

Route::resource("/register", RegisterController::class)->middleware("guest");

// Admin --> member page
Route::get('/adm-member', [AdmMemberController::class, 'gotoMember'])->middleware(AdminMiddleware::class);
Route::post('/adm-member', [AdmMemberController::class, 'gotoMemberWithSearch'])->middleware(AdminMiddleware::class);
Route::post('/adm-update-member', [AdmMemberController::class, 'updateMember'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-apply-letter', [AdmMemberController::class, 'downloadApplyLetter'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-cv', [AdmMemberController::class, 'downloadCV'])->middleware(AdminMiddleware::class);
Route::post('/down-trainer-certificates', [AdmMemberController::class, 'downloadCertificates'])->middleware(AdminMiddleware::class);

// Admin --> class page
Route::resource('/adm-set-class', TrainingClassController::class)->middleware(AdminMiddleware::class);
Route::post('/adm-set-class/update', [TrainingClassController::class, 'updateClass'])->middleware(AdminMiddleware::class);
Route::post('/adm-set-class/search', [TrainingClassController::class, 'searchClass'])->middleware(AdminMiddleware::class);
Route::post('/see-class-member', [AdmMemberController::class, 'gotoMemberWithSearch'])->middleware(AdminMiddleware::class);

// Admin --> inventory
Route::resource('/inventory', InventoryController::class)->middleware(AdminMiddleware::class);
Route::post('/inventory/update', [InventoryController::class, 'updateItem'])->middleware(AdminMiddleware::class);

// Member --> join class
Route::resource('/join-class', MemClass::class)->middleware(MemberMiddleware::class);

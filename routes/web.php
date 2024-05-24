<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {return view('index');});

Route::get('/login', function() {return view('login.loginUser');});
Route::get('/login-adm', function() {return view('login.loginAdmin');});

Route::get("/register", function() {return view("register.register");});

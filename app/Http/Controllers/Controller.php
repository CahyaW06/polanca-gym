<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home() {
        return view('home.home', [
            "title" => "Home",
        ]);
    }

    public function loginUser() {
        return view("login.loginUser", [
            "title" => "Login"
        ]);
    }

    public function loginAdmin() {
        return view("login.loginAdmin", [
            "title" => "Login Admin"
        ]);
    }

    public function register() {
        return view("register.register", [
            "title" => "Register"
        ]);
    }
}

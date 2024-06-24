<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        return view("login.loginAdmin", [
            "title" => "Login Admin",
            'lastSetting' => Setting::all()->last(),
        ]);
    }

    public function autentificate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (User::where('email', $request->email)->get()->first()->type == "admin") {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }
        else {
            return back()->with('login_error', 'Login failed!');
        }

        return back()->with('login_error', 'Login failed!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

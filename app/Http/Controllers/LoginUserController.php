<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("login.loginUser", [
            "title" => "Login",
            'lastSetting' => Setting::all()->last(),
        ]);
    }

    public function autentificate(Request $request) {
        if ($request->trainerValidation) {
            $credentials = $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required'
            ]);

            if (User::where('email', $request->email)->get()->first()->type == "trainer") {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
            }
            else {
                return back()->with('login_error', 'Login failed!');
            }
        }
        else {
            $credentials = $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required'
            ]);

            if (User::where('email', $request->email)->get()->first()->type == "member") {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
            }
            else {
                return back()->with('login_error', 'Login failed!');
            }
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

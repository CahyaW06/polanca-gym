<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home() {
        if(Auth::user()) {
            if(Auth::user()->type == "admin") {
                return view('home.home', [
                    "title" => "Home",
                    'lastSetting' => Setting::all()->last(),
                    'history' => json_encode(History::all())
                ]);
            }
            else {
                return view('home.home', [
                    "title" => "Home",
                    'lastSetting' => Setting::all()->last(),
                ]);
            }
        }
        else {
            return view('home.home', [
                "title" => "Home",
                'lastSetting' => Setting::all()->last(),
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TrainingClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemSeeClass extends Controller
{
    public function index() {
        $times1 = [
            "00:00",
            "01:00",
            "02:00",
            "03:00",
            "04:00",
            "05:00",
            "06:00",
            "07:00",
            "08:00",
            "09:00",
            "10:00",
            "11:00",
        ];
        $times2 = [
            "12:00",
            "13:00",
            "14:00",
            "15:00",
            "16:00",
            "17:00",
            "18:00",
            "19:00",
            "20:00",
            "21:00",
            "22:00",
            "23:00",
        ];
        $days = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];

        // dd(TrainingClass::first()->users->where('id', Auth::user()->id));
        return view("member.seeClass.index", [
            'title' => "My Class",
            'lastSetting' => Setting::all()->last(),
            'times1' => $times1,
            'times2' => $times2,
            'days' => $days,
            'classes' => TrainingClass::all()
        ]);
    }
}

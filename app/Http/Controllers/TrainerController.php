<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Trainer;
use App\Models\TrainingClass;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view("trainer.class.index", [
            'title' => "My Class",
            'lastSetting' => Setting::all()->last(),
            'times1' => $times1,
            'times2' => $times2,
            'days' => $days,
            'classes' => TrainingClass::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}

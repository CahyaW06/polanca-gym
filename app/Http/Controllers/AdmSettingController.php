<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdmSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.index', [
            "title" => "Gym Settings",
            'lastSetting' => Setting::all()->last(),
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
        $validated =  $request->validate([
            'gym_name' => 'required|max:16',
            'gym_motto' => 'max:32',
            'payment_one' => 'required',
            'payment_three' => 'required',
            'payment_five' => 'required'
        ]);

        Setting::create([
            'gym_name' => $validated['gym_name'],
            'gym_motto' => $validated['gym_motto'],
            'payment_one_month' => $validated['payment_one'],
            'payment_three_month' => $validated['payment_three'],
            'payment_five_month' => $validated['payment_five']
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

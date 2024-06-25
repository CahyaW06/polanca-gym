<?php

namespace App\Http\Controllers;

use App\Mail\ClassPaymentConfirmEmail;
use App\Models\History;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\TrainingClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MemClass extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(TrainingClass::all());
        return view("member.class.index", [
            'title' => "Join Class",
            'lastSetting' => Setting::all()->last(),
            'classes' => TrainingClass::all()
        ]);
    }

    public function classPayment(Request $request) {
        dd($request);
        return view("member.class.payment", [
            'title' => "Join Class",
            'lastSetting' => Setting::all()->last(),
            'class' => TrainingClass::find($request->classId),
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
            'proof' => 'required|mimetypes:image/jpeg',
        ]);

        // save file
        $proof = $request->file('proof');
        $proof->store('class_recipients');

        $history = History::create([
            'user_id' => Auth::user()->id,
            'pay_for' => "class",
            'membership_type' => 1,
            'proof' => $proof->hashName(),
        ]);

        Mail::to('yudhacahyawijaya@gmail.com')->send(new ClassPaymentConfirmEmail($history, Setting::all()->last(), TrainingClass::find($request->classId)));

        TrainingClass::find($request->classId)->users()->attach([Auth::user()->id]);


        return redirect('/payment-done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("member.class.payment", [
            'title' => "Join Class",
            'lastSetting' => Setting::all()->last(),
            'class' => TrainingClass::find($id),
        ]);
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("register.register", [
            "title" => "Register User"
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
        // dd($request);
        if ($request->userValidation) {
            $validated =  $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required|max:255|min:8',
                'repeat_password' => 'required|same:password'
            ]);

            $validated['password'] = Hash::make($validated['password']);

            User::create([
                "first_name" => $validated["first_name"],
                "last_name" => $validated["last_name"],
                "email" => $validated["email"],
                "type" => "member",
                "password" => $validated["password"]
            ]);

            return redirect('/login')->with("register_success", "Succeed to create the account, please login again");
        }
        else if ($request->trainerValidation){
            $validatedAcc =  $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required|max:255|min:8',
                'repeat_password' => 'required|same:password'
            ]);

            $validatedAcc['password'] = Hash::make($validatedAcc['password']);

            $validatedDoc = $request->validate([
                'apply_letter' => 'required|mimes:pdf',
                'cv' => 'required|mimes:pdf',
                'certificates' => 'mimes:pdf'
            ]);

            $apply_letter = $request->file('apply_letter');
            $apply_letter->storeAs('applicant_data', $validatedAcc['email'] + "_apply_letter");


            User::create([
                "first_name" => $validatedAcc["first_name"],
                "last_name" => $validatedAcc["last_name"],
                "email" => $validatedAcc["email"],
                "type" => "trainer",
                "password" => $validatedAcc["password"]
            ]);

            Trainer::create([
                "apply_letter" => $validatedDoc["apply_letter"],
                "cv" => $validatedDoc["cv"],
                "certificates" => $validatedDoc["certificates"],
            ]);

            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

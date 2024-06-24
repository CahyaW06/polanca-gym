<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
            "title" => "Register User",
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
            $validated =  $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users|email:dns',
                'password' => 'required|max:255|min:8',
                'repeat_password' => 'required|same:password',
                'photo' => 'required|mimetypes:image/jpeg',
                'apply_letter' => 'required|mimetypes:application/pdf',
                'cv' => 'required|mimetypes:application/pdf',
                'certificates[]' => 'mimetypes:application/pdf',
            ]);

            $validated['password'] = Hash::make($validated['password']);

            // save file
            $photo = $request->file('photo');
            $photo->store('applicant_datas');

            $apply_letter = $request->file('apply_letter');
            $apply_letter->store('applicant_datas');

            $cv = $request->file('cv');
            $cv->store('applicant_datas');

            $certificates = "";
            foreach($request->file('certificates') as $key => $certificate) {
                $certificate->store('applicant_datas');
                $certificates .= $certificate->hashName();

                if ($key < sizeof($request->file('certificates')) - 1) {
                    $certificates .= ",";
                }
            }

            // save to db
            User::create([
                "first_name" => $validated["first_name"],
                "last_name" => $validated["last_name"],
                "email" => $validated["email"],
                "type" => "trainer",
                "password" => $validated["password"]
            ]);

            $user = User::where('email', $validated['email'])->first();

            Trainer::create([
                "user_id" => $user->id,
                "photo" => $photo->hashName(),
                "apply_letter" => $apply_letter->hashName(),
                "cv" => $cv->hashName(),
                "certificates" => $certificates,
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

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Models\TrainingClass;

class TrainingClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.class.index', [
            "title" => "Class List",
            'lastSetting' => Setting::all()->last(),
            "classes" => TrainingClass::cursorPaginate(10),
            "total_class" => TrainingClass::count(),
            "all_active_member" => User::all()->where('type', 'member'),
            "all_trainer" => Trainer::all()
        ]);
    }

    public function searchClass(Request $request) {
        return view('admin.class.index', [
            "title" => "Class List",
            "classes" => TrainingClass::where('name', 'like', '%'.$request->table_search.'%')->orWhere('id', $request->table_search)->cursorPaginate(10),
            "total_class" => TrainingClass::count(),
            "all_active_member" => User::all()->where('type', 'member'),
            "all_trainer" => Trainer::all()
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
            'new_class_name' => 'required|string',
            'new_max_member' => 'required|numeric',
            'new_max_trainer' => 'required|numeric',
            'new_subs' => 'required|numeric'
        ]);

        TrainingClass::create([
            "name" => $validated["new_class_name"],
            "max_member" => $validated["new_max_member"],
            "max_trainer" => $validated["new_max_trainer"],
            "subs" => $validated["new_subs"]
        ]);

        return redirect('/adm-set-class');

    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingClass $trainingClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingClass $trainingClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $targetClass = TrainingClass::find($id);

        if ($request->type == "member") {
            $size = 0;
            if ($request->prev_member_id && $request->new_member_id) {
                $size = sizeof($request->prev_member_id) + sizeof($request->new_member_id);
            }
            else if ($request->prev_member_id) {$size = sizeof($request->prev_member_id);}
            else if ($request->new_member_id) {$size = sizeof($request->new_member_id);}
            else {
                $targetClass->users()->detach();
                return redirect('/adm-set-class');
            }

            if ($targetClass->max_member >= $size) {
                $targetClass->users()->detach();
                if ($request->prev_member_id) {
                    $targetClass->users()->attach($request->prev_member_id);
                }
                if ($request->new_member_id) {
                    $targetClass->users()->attach($request->new_member_id);
                }
            }
            else {return redirect('/adm-set-class')->with("change_fail", "Set member exceed the limit");}
        }
        else {
            $size = 0;
            if ($request->prev_trainer_id && $request->new_trainer_id) {
                $size = sizeof($request->prev_trainer_id) + sizeof($request->new_trainer_id);
            }
            else if ($request->prev_trainer_id) {$size = sizeof($request->prev_trainer_id);}
            else if ($request->new_trainer_id) {$size = sizeof($request->new_trainer_id);}
            else {
                $targetClass->trainers()->detach();
                return redirect('/adm-set-class');
            }

            if ($targetClass->max_trainer >= $size) {
                $targetClass->trainers()->detach();
                if ($request->prev_trainer_id) {
                    $targetClass->trainers()->attach($request->prev_trainer_id);
                }
                if ($request->new_trainer_id) {
                    $targetClass->trainers()->attach($request->new_trainer_id);
                }
            }
            else {return redirect('/adm-set-class')->with("change_fail", "Set trainer exceed the limit");}
        }

        return redirect('/adm-set-class');
    }

    public function updateClass(Request $request)
    {
        if ($request) {
            $class = TrainingClass::find($request->target_id);
            $class->name = $request->new_class_name;
            $class->max_member = $request->new_max_member;
            $class->max_trainer = $request->new_max_trainer;
            $class->subs = $request->new_subs;
            $class->save();
        }

        return redirect('/adm-set-class');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TrainingClass::find($id)->delete();

        return redirect('/adm-set-class');
    }
}

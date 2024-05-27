<?php

namespace App\Http\Controllers;

use App\Models\TrainingClass;
use Illuminate\Http\Request;

class TrainingClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.class.index', [
            "title" => "Class List",
            "classes" => TrainingClass::cursorPaginate(10),
            "total_class" => TrainingClass::count()
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
    public function update(Request $request, TrainingClass $trainingClass)
    {
        //
    }

    public function updateClass(Request $request) {
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

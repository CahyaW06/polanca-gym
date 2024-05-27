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
        // dd(TrainingClass::cursorPaginate(10));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingClass $trainingClass)
    {
        dd($trainingClass);
        $trainingClass->delete();

        redirect('/adm-set-class');
    }
}

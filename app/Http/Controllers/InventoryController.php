<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trainer;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\TrainingClass;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Models\Setting;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Inventory::first()->trainingClass;
        return view('admin.inventory.index', [
            "title" => "Class List",
            'lastSetting' => Setting::all()->last(),
            "classes" => TrainingClass::cursorPaginate(5),
            "total_class" => TrainingClass::count(),
            "all_inventory" => Inventory::all(),
            "total_inventory" => Inventory::count()
        ]);
    }

    public function updateItem(Request $request)
    {
        if ($request) {
            $item = Inventory::find($request->target_id);
            $item->name = $request->new_item_name;
            // $class->save();
            dd($item);
        }

        return redirect('/adm-set-class');
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
            'new_item_name' => 'required|string',
        ]);

        Inventory::create([
            "name" => $validated["new_item_name"]
        ]);

        return redirect('/inventory');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd(Inventory::whereIn('id', [1, 2, 3])->get());
        $targetClass = TrainingClass::find($id);

        foreach ($targetClass->inventories as $inventory) {
            $inventory->training_class_id = 0;
            $inventory->save();
        }

        if ($request->prev_inv_id || $request->new_inv_id) {
            if ($request->prev_inv_id) {
                foreach (Inventory::whereIn('id', $request->prev_inv_id)->get() as $inv) {
                    $inv->training_class_id = $id;
                    $inv->save();
                }
            }
            if ($request->new_inv_id) {
                foreach (Inventory::whereIn('id', $request->new_inv_id)->get() as $inv) {
                    $inv->training_class_id = $id;
                    $inv->save();
                }
            }
        }

        return redirect('/inventory');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        if ($inventory) {$inventory->delete();}
        return redirect('/inventory');
    }
}

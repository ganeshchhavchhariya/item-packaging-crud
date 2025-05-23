<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Uom;
use App\Models\Packaging;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::with('uom')->get();
        $uoms = Uom::all();

        return view('item_packaging.list', compact('items', 'uoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uom_id' => 'required|exists:uom_master,uom_id',
            'name' => 'required|string|max:100',
        ]);

        Item::create([
            'uom_id' => $request->uom_id,
            'name' => $request->name,
        ]);

        return redirect()->route('item-packaging')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $uoms = Uom::all();

        return view('item_packaging.edit', compact('item', 'uoms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:100',
            'base_uom_id' => 'required|exists:uom_master,uom_id',
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'item_name' => $request->item_name,
            'base_uom_id' => $request->base_uom_id,
        ]);

        return redirect()->route('item-packaging')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('item-packaging')->with('success', 'Item deleted successfully.');
    }
    
    // ItemController.php
    public function ajaxAddItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'uom_id' => 'required|exists:uom_master,uom_id'
        ]);

        $item = Item::create([
            'item_name' => $request->name,
            'base_uom_id' => $request->uom_id
        ]);

        return response()->json([
            'id' => $item->id,
            'name' => $item->item_name,
            'uom_id' => $item->base_uom_id
        ]);
    }

    public function addPackaging(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $packaging = Packaging::create(['packaging_name' => $request->name]);

        return response()->json(['id' => $packaging->id, 'name' => $packaging->packaging_name]);
    }

    public function addUOM(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $uom = Uom::create(['uom_name' => $request->name]);

        return response()->json(['id' => $uom->id, 'name' => $uom->uom_name]);
    }

}




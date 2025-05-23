<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Uom;
use App\Models\ItemUomMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ItemUomMappingController extends Controller
{
    public function create()
    {
        $items = Item::all();
        $uoms = Uom::all();
        return view('item_uom_mapping', compact('items', 'uoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:item_master,item_id',
            'default_uom_id' => 'required|exists:uom_master,uom_id',
        ]);

        ItemUomMapping::updateOrCreate(
            ['item_id' => $request->item_id],
            ['default_uom_id' => $request->default_uom_id]
        );

        return redirect()->route('item-uom-mapping')->with('success', 'Item UOM mapping saved successfully!');
    }

    public function ajaxAddUOM(Request $request)
    {
        $uom = new Uom();
        $uom->uom_name = $request->uom_name;
        $uom->symbol = $request->uom_symbol;
        $uom->save();

        return response()->json([
            'success' => true,
            'uom_id' => $uom->uom_id,
            'name' => $uom->uom_name,
            'symbol' => $uom->symbol
        ]);

    }

}

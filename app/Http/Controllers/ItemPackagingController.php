<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\PackagingType;
use App\Models\Uom;
use App\Models\ItemPackaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ItemPackagingController extends Controller
{
    public function index()
    {
        $itemPackagings = DB::table('item_packaging_master')
            ->join('item_master', 'item_packaging_master.item_id', '=', 'item_master.item_id')
            ->join('packaging_type_master', 'item_packaging_master.packaging_id', '=', 'packaging_type_master.packaging_id')
            ->join('uom_master', 'item_packaging_master.unit_uom_id', '=', 'uom_master.uom_id')
            ->select(
                'item_packaging_master.*',
                'item_master.item_name',
                'packaging_type_master.packaging_name',
                'uom_master.uom_name'
            )
            ->paginate(10);

        return view('item_packaging.list', compact('itemPackagings'));
    }

    public function create()
    {
        $items = Item::all();
        $packagings = PackagingType::all();
        $uoms = Uom::all();

        return view('item_packaging.create', compact('items', 'packagings', 'uoms'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'item_id' => 'required|exists:item_master,item_id',
            'packaging_id' => 'required|exists:packaging_type_master,packaging_id',
            'uom_id' => 'required|exists:uom_master,uom_id',
            'units_per_pack' => 'required|numeric|min:1',
            'unit_quantity' => 'required|numeric|min:1',
        ]);

        // Get the validated data
        $data = [
                'item_id' => $validated['item_id'],
                'packaging_id' => $validated['packaging_id'],
                'unit_uom_id' => $validated['uom_id'],
                'units_per_pack' => $validated['units_per_pack'],
                'unit_quantity' => $validated['unit_quantity'],
                'created_at' => now(),
                'updated_at' => now()
        ];

        try {
            // Insert into item_packaging_master table
            DB::table('item_packaging_master')->insert($data);
            
            // Redirect with success message
            return redirect()->route('item-packaging.index')
                ->with('success', 'Item Packaging saved successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error saving item packaging: ' . $e->getMessage());
            
            // Redirect back with error message
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error saving item packaging. Please try again.');
        }
    }

    public function edit($id)
    {
        $itemPackaging = DB::table('item_packaging_master')
            ->where('item_packaging_master.item_pack_id', $id)
            ->first();
        
        $items = Item::all();
        $packagings = PackagingType::all();
        $uoms = Uom::all();

        return view('item_packaging.edit', compact('itemPackaging', 'items', 'packagings', 'uoms'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'item_id' => 'required|exists:item_master,item_id',
            'packaging_id' => 'required|exists:packaging_type_master,packaging_id',
            'uom_id' => 'required|exists:uom_master,uom_id',
            'units_per_pack' => 'required|numeric|min:1',
            'unit_quantity' => 'required|numeric|min:1',
        ]);

        // Prepare the update data
        $data = [
            'item_id' => $validated['item_id'],
            'packaging_id' => $validated['packaging_id'],
            'unit_uom_id' => $validated['uom_id'],
            'units_per_pack' => $validated['units_per_pack'],
            'unit_quantity' => $validated['unit_quantity'],
            'updated_at' => now()
        ];

        try {
            // Update the record
            DB::table('item_packaging_master')
                ->where('item_packaging_master.item_pack_id', $id)
                ->update($data);

            return redirect()->route('item-packaging.index')
                ->with('success', 'Item Packaging updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating item packaging: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::table('item_packaging_master')
            ->where('item_packaging_master.item_pack_id', $id)
            ->delete();

        return redirect()->route('item-packaging.index')->with('success', 'Item Packaging deleted successfully.');
    }

    
    public function show($id)
    {
        $itemPackaging = DB::table('item_packaging_master')
            ->where('item_packaging_master.item_pack_id', $id)
            ->first();
        $items = Item::all();
        $packagings = PackagingType::all();
        $uoms = Uom::all();

        return view('item_packaging.show', compact('itemPackaging', 'items', 'packagings', 'uoms'));
    }

    public function addUOM(Request $request)
{
    $request->validate([
        'uom_name' => 'required|string|max:255|unique:uom_master,uom_name',
        'symbol' => 'required|string|max:10|unique:uom_master,symbol',
    ]);

    $uom = new Uom();
    $uom->uom_name = $request->uom_name;
    $uom->symbol = $request->symbol;
    $uom->save();

    return response()->json(['success' => true, 'uom' => $uom]);
}


    public function ajaxAddPackaging(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:packaging_type_master,packaging_name',
        ]);

        $packaging = PackagingType::create(['packaging_name' => $request->name]);

        return response()->json([
            'packaging_id' => $packaging->packaging_id,
            'packaging_name' => $packaging->packaging_name,
            'success' => true,
            'message' => 'Packaging added successfully'
        ]);
    }

    
    public function ajaxAddItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:item_master,item_name',
        ]);

        $item = Item::create([
            'item_name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'item_id' => $item->item_id,
            'item_name' => $item->item_name,
            'message' => 'Item added successfully'
        ]);
    }

    public function ajaxEditItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:item_master,item_id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('item_master', 'item_name')->ignore($request->item_id, 'item_id')
            ]
        ]);

        try {
            $item = Item::findOrFail($request->item_id);
            $item->item_name = $request->name;
            $item->save();

            return response()->json([
                'success' => true,
                'message' => 'Item updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating item: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ajaxEditPackaging(Request $request)
    {
        $request->validate([
            'packaging_id' => 'required|exists:packaging_type_master,packaging_id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('packaging_type_master', 'packaging_name')->ignore($request->packaging_id, 'packaging_id')
            ]
        ]);

        try {
            $packaging = PackagingType::findOrFail($request->packaging_id);
            $packaging->packaging_name = $request->name;
            $packaging->save();

            return response()->json([
                'success' => true,
                'message' => 'Packaging updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating packaging: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ajaxEditUom(Request $request)
    {
        $request->validate([
            'uom_id' => 'required|exists:uom_master,uom_id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('uom_master', 'uom_name')->ignore($request->uom_id, 'uom_id')
            ],
            'symbol' => [
                'required',
                'string',
                'max:10',
                Rule::unique('uom_master', 'symbol')->ignore($request->uom_id, 'uom_id')
            ]
        ]);

        try {
            $uom = Uom::findOrFail($request->uom_id);
            $uom->uom_name = $request->name;
            $uom->symbol = $request->symbol;
            $uom->save();

            return response()->json([
                'success' => true,
                'message' => 'UOM updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating UOM: ' . $e->getMessage()
            ], 500);
        }
    }
}

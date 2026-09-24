<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FloorZone;
use Illuminate\Http\Request;

class ProductFloorZoneController extends Controller
{
    public function list($productId)
    {
        return response()->json(FloorZone::where('product_id', $productId)->orderBy('sort_order')->get());
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dims' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
        ]);
        $item = FloorZone::create([
            'product_id' => $productId,
            'name' => $request->name, 'dims' => $request->dims, 'desc' => $request->desc,
            'sort_order' => (int) (FloorZone::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Floor zone added', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dims' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
        ]);
        FloorZone::whereNotNull('product_id')->findOrFail($id)
            ->update($request->only(['name', 'dims', 'desc']));

        return response()->json(['message' => 'Floor zone updated']);
    }

    public function toggleStatus($id)
    {
        $z = FloorZone::whereNotNull('product_id')->findOrFail($id);
        $z->update(['status' => ! $z->status]);

        return response()->json(['message' => 'Status updated']);
    }

    public function destroy($id)
    {
        FloorZone::whereNotNull('product_id')->findOrFail($id)->delete();

        return response()->json(['message' => 'Floor zone deleted']);
    }
}

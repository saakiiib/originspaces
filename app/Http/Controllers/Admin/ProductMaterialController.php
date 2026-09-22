<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    public function list($productId)
    {
        return response()->json(ProductMaterial::where('product_id', $productId)->orderBy('sort_order')->get());
    }

    public function store(Request $request, $productId)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $item = ProductMaterial::create([
            'product_id' => $productId,
            'name' => $request->name,
            'sort_order' => (int) (ProductMaterial::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Material added', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        ProductMaterial::findOrFail($id)->update(['name' => $request->name]);

        return response()->json(['message' => 'Material updated']);
    }

    public function destroy($id)
    {
        ProductMaterial::findOrFail($id)->delete();

        return response()->json(['message' => 'Material deleted']);
    }
}

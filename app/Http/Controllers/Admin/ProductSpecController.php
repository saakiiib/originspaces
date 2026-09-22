<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSpec;
use Illuminate\Http\Request;

class ProductSpecController extends Controller
{
    public function list($productId)
    {
        return response()->json(ProductSpec::where('product_id', $productId)->orderBy('sort_order')->get());
    }

    public function store(Request $request, $productId)
    {
        $request->validate(['point' => 'required|string']);
        $item = ProductSpec::create([
            'product_id' => $productId,
            'point' => $request->point,
            'sort_order' => (int) (ProductSpec::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Spec point added', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['point' => 'required|string']);
        ProductSpec::findOrFail($id)->update(['point' => $request->point]);

        return response()->json(['message' => 'Spec point updated']);
    }

    public function destroy($id)
    {
        ProductSpec::findOrFail($id)->delete();

        return response()->json(['message' => 'Spec point deleted']);
    }
}

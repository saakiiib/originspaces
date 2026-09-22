<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductTechSpec;
use Illuminate\Http\Request;

class ProductTechSpecController extends Controller
{
    public function list($productId)
    {
        return response()->json(ProductTechSpec::where('product_id', $productId)->orderBy('sort_order')->get());
    }

    public function store(Request $request, $productId)
    {
        $request->validate(['label' => 'required|string|max:255', 'value' => 'required|string|max:255']);
        $item = ProductTechSpec::create([
            'product_id' => $productId,
            'label' => $request->label,
            'value' => $request->value,
            'highlight' => $request->boolean('highlight'),
            'sort_order' => (int) (ProductTechSpec::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Tech spec added', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['label' => 'required|string|max:255', 'value' => 'required|string|max:255']);
        ProductTechSpec::findOrFail($id)->update([
            'label' => $request->label,
            'value' => $request->value,
            'highlight' => $request->boolean('highlight'),
        ]);

        return response()->json(['message' => 'Tech spec updated']);
    }

    public function destroy($id)
    {
        ProductTechSpec::findOrFail($id)->delete();

        return response()->json(['message' => 'Tech spec deleted']);
    }
}

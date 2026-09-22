<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductOptionController extends Controller
{
    public function list($productId)
    {
        $query = ProductOption::where('product_id', $productId)->orderBy('sort_order');
        if (request()->filled('group')) {
            $query->where('group', request('group'));
        }

        return response()->json($query->get());
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'group' => ['required', Rule::in(ProductOption::GROUPS)],
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price_delta' => 'nullable|numeric|min:0',
            'swatch_color' => 'nullable|string|max:20',
        ]);

        $item = ProductOption::create([
            'product_id' => $productId,
            'group' => $request->group,
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'price_delta' => $request->price_delta ?: null,
            'swatch_color' => $request->group === 'finish' ? $request->swatch_color : null,
            'is_default' => $request->boolean('is_default'),
            'status' => true,
            'sort_order' => (int) (ProductOption::where('product_id', $productId)->where('group', $request->group)->max('sort_order') ?? 0) + 1,
        ]);

        if ($item->is_default) {
            ProductOption::where('product_id', $productId)->where('group', $item->group)->where('id', '!=', $item->id)->update(['is_default' => false]);
        }

        return response()->json(['message' => 'Option added', 'data' => $item]);
    }

    public function update(Request $request, $id)
    {
        $option = ProductOption::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price_delta' => 'nullable|numeric|min:0',
            'swatch_color' => 'nullable|string|max:20',
        ]);

        // Partial update: only touch keys actually sent (quick-edit sends name only).
        $data = [];
        foreach (['name', 'subtitle', 'price_delta', 'swatch_color'] as $key) {
            if ($request->has($key)) {
                $data[$key] = $request->input($key) ?: null;
            }
        }
        if ($option->group !== 'finish') {
            unset($data['swatch_color']);
        }
        if ($request->has('is_default')) {
            $data['is_default'] = $request->boolean('is_default');
        }
        if ($data !== []) {
            $option->update($data);
        }
        if ($option->is_default) {
            ProductOption::where('product_id', $option->product_id)->where('group', $option->group)->where('id', '!=', $option->id)->update(['is_default' => false]);
        }

        return response()->json(['message' => 'Option updated']);
    }

    public function toggleStatus(Request $request, $id)
    {
        $option = ProductOption::findOrFail($id);
        $option->update(['status' => ! $option->status]);

        return response()->json(['message' => 'Status updated']);
    }

    public function destroy($id)
    {
        ProductOption::findOrFail($id)->delete();

        return response()->json(['message' => 'Option deleted']);
    }
}

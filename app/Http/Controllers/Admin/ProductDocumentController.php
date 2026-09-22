<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDocument;
use Illuminate\Http\Request;

class ProductDocumentController extends Controller
{
    public function list($productId)
    {
        return response()->json(
            ProductDocument::where('product_id', $productId)->orderBy('sort_order')->get()
                ->map(fn ($d) => [...$d->toArray(), 'url' => url($d->file)])
        );
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,dwg,rvt,zip,jpg,jpeg,png,webp|max:20480',
        ]);

        $path = public_path('uploads/products/docs/');
        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $ext = $request->file('file')->getClientOriginalExtension();
        $name = mt_rand(10000000, 99999999).'.'.$ext;
        $request->file('file')->move($path, $name);

        $doc = ProductDocument::create([
            'product_id' => $productId,
            'title' => $request->title,
            'file' => '/uploads/products/docs/'.$name,
            'sort_order' => (int) (ProductDocument::where('product_id', $productId)->max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Document added', 'data' => $doc]);
    }

    public function destroy($id)
    {
        $doc = ProductDocument::findOrFail($id);
        if ($doc->file && file_exists(public_path($doc->file))) {
            @unlink(public_path($doc->file));
        }
        $doc->delete();

        return response()->json(['message' => 'Document deleted']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        $products = Product::with(['brand'])
            ->whereIn('id', array_keys($wishlist))
            ->get();

        return spa('frontend.wishlist', compact('products'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $wishlist = session()->get('wishlist', []);
        $id = $request->id;

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            $added = false;
            $message = 'Removed from wishlist';
        } else {
            $wishlist[$id] = true;
            $added = true;
            $message = 'Added to wishlist';
        }

        session()->put('wishlist', $wishlist);

        $product = Product::find($id);

        return response()->json([
            'success' => true,
            'added' => $added,
            'message' => $added ? ($product->name ?? 'Product').' added to wishlist' : 'Removed from wishlist',
            'count' => count($wishlist),
            'product_name' => $product->name ?? '',
            'product_image' => $product && $product->image ? asset(ltrim($product->image, '/')) : asset('placeholder.webp'),
        ]);
    }

    public function check(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        return response()->json([
            'is_wished' => isset($wishlist[$request->id]),
        ]);
    }

    public function count()
    {
        $wishlist = session()->get('wishlist', []);

        return response()->json(['count' => count($wishlist)]);
    }
}

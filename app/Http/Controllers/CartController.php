<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::with(['brand'])->find($id);
            if ($product && $product->stock_quantity > 0) {
                $price = $product->offer_price ?? $product->regular_price;
                $items[] = ['product' => $product, 'qty' => $qty, 'price' => $price];
                $total += $price * $qty;
            }
        }

        return spa('frontend.cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;
        $qty = $request->qty;

        $product = Product::find($id);
        if (! $product || $product->stock_quantity < $qty) {
            return response()->json(['success' => false, 'message' => 'Insufficient stock'], 400);
        }

        $cart[$id] = ($cart[$id] ?? 0) + $qty;
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $product->name.' added to cart',
            'count' => count($cart),
            'product_name' => $product->name,
            'product_image' => $product->image ? asset(ltrim($product->image, '/')) : asset('placeholder.webp'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);
        $id = $request->id;

        if ($request->qty <= 0) {
            unset($cart[$id]);
        } else {
            $product = Product::find($id);
            if ($product && $product->stock_quantity < $request->qty) {
                return response()->json(['success' => false, 'message' => 'Insufficient stock'], 400);
            }
            $cart[$id] = $request->qty;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'count' => count($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Removed from cart',
            'count' => count($cart),
        ]);
    }

    public function count()
    {
        $cart = session()->get('cart', []);

        return response()->json(['count' => count($cart)]);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json(['success' => true, 'message' => 'Cart cleared']);
    }
}

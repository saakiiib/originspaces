<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSession;
use App\Models\CompanyDetails;
use App\Models\District;
use App\Models\Division;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $items = [];
        $total = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::with(['brand'])->find($id);
            if ($product && $product->stock_quantity >= $qty) {
                $price = $product->offer_price ?? $product->regular_price;
                $items[] = ['product' => $product, 'qty' => $qty, 'price' => $price];
                $total += $price * $qty;
            }
        }

        if (empty($items)) {
            return redirect()->route('cart');
        }

        $divisions = Division::where('status', 1)->get();
        $company = CompanyDetails::first();

        // Auto-fill from auth user
        $authName = '';
        $authPhone = '';
        $authEmail = '';
        $authDivisionId = '';
        $authDistrictId = '';
        $authUpazilaId = '';
        $authAddress = '';
        if (Auth::check()) {
            $user = Auth::user()->load(['division', 'district', 'upazila']);
            $authName = $user->name ?? '';
            $authPhone = $user->phone ?? '';
            $authEmail = $user->email ?? '';
            $authDivisionId = $user->division_id ?? '';
            $authDistrictId = $user->district_id ?? '';
            $authUpazilaId = $user->upazila_id ?? '';
            $authAddress = $user->address ?? '';

            // Record checkout session for abandoned checkout tracking
            $cartSnapshot = collect($items)->map(function ($item) {
                return [
                    'id' => $item['product']->id,
                    'name' => $item['product']->name,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                ];
            })->toArray();

            // Update existing active session or create new one
            $existingSession = CheckoutSession::where('user_id', $user->id)
                ->where('status', 'active')
                ->latest()
                ->first();

            if ($existingSession) {
                $existingSession->update([
                    'cart_snapshot' => $cartSnapshot,
                    'left_at' => null,
                ]);
                $checkoutSessionId = $existingSession->id;
            } else {
                $newSession = CheckoutSession::create([
                    'user_id' => $user->id,
                    'cart_snapshot' => $cartSnapshot,
                    'status' => 'active',
                ]);
                $checkoutSessionId = $newSession->id;
            }
        } else {
            $checkoutSessionId = null;
        }

        return spa('frontend.checkout', compact('items', 'total', 'divisions', 'company', 'authName', 'authPhone', 'authEmail', 'authDivisionId', 'authDistrictId', 'authUpazilaId', 'authAddress', 'checkoutSessionId'));
    }

    public function getDistricts(Request $request)
    {
        $division = Division::with('districts')->find($request->division_id);
        if (! $division) {
            return response()->json(['districts' => []]);
        }

        return response()->json(['districts' => $division->districts]);
    }

    public function getUpazilas(Request $request)
    {
        $district = District::with('upazilas')->find($request->district_id);
        if (! $district) {
            return response()->json(['upazilas' => []]);
        }

        return response()->json(['upazilas' => $district->upazilas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        // Load cart items
        $cartItems = [];
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if ($product && $product->stock_quantity >= $qty) {
                $price = $product->offer_price ?? $product->regular_price;
                $cartItems[] = ['product' => $product, 'qty' => $qty, 'price' => $price];
            }
        }

        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Some items are no longer available');
        }

        // Compute totals
        $subtotal = 0;
        $totalQty = 0;
        foreach ($cartItems as $data) {
            $subtotal += $data['price'] * $data['qty'];
            $totalQty += $data['qty'];
        }

        // Delivery charge: Dhaka division = 60, else = 120
        $dhakaDivision = Division::where('name', 'Dhaka')->first();
        $deliveryCharge = ($request->division_id == $dhakaDivision?->id) ? 60 : 120;

        $totalAmount = $subtotal + $deliveryCharge;

        try {
            DB::beginTransaction();

            // Create order with user_id
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazila_id' => $request->upazila_id,
                'address' => $request->address,
                'payment_method' => 'cod',
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryCharge,
                'total_amount' => $totalAmount,
                'note' => $request->delivery_note,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cartItems as $data) {
                $product = $data['product'];
                $qty = $data['qty'];
                $price = $data['price'];
                $lineTotal = $price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'total' => $lineTotal,
                ]);
            }

            // Create initial status history
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status' => 'pending',
                'note' => 'Order placed',
            ]);

            // Clear cart
            session()->forget('cart');

            // Mark checkout session as completed
            CheckoutSession::where('user_id', Auth::id())
                ->where('status', 'active')
                ->update(['status' => 'completed']);

            DB::commit();

            return redirect()->route('order.confirmation', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to place order'.': '.$e->getMessage());
        }
    }

    public function confirmation($id)
    {
        $order = Order::with(['items.product', 'division', 'district', 'upazila'])
            ->findOrFail($id);

        return spa('frontend.order-confirmation', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::with(['items.product', 'division', 'district', 'upazila'])
            ->findOrFail($id);

        // If logged-in customer, only allow viewing own orders
        if (Auth::check() && auth()->user()->user_type == '0') {
            if ($order->user_id !== Auth::id()) {
                abort(403);
            }
        }

        $company = CompanyDetails::firstOrCreate();

        return view('frontend.order-invoice', compact('order', 'company'));
    }

    public function trackLeave(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['success' => false]);
        }

        $sessionId = $request->input('checkout_session_id');
        if ($sessionId) {
            CheckoutSession::where('id', $sessionId)
                ->where('user_id', Auth::id())
                ->where('status', 'active')
                ->update(['left_at' => now()]);
        }

        return response()->json(['success' => true]);
    }
}

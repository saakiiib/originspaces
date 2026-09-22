<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserPortalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_user']);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');

        return spa('frontend.user.dashboard', compact('user', 'orders', 'totalOrders', 'totalSpent'));
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::with(['items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return spa('frontend.user.orders', compact('user', 'orders'));
    }

    public function orderDetail($id)
    {
        $user = Auth::user();
        $order = Order::with([
            'items.product',
            'division',
            'district',
            'upazila',
            'statusHistory',
        ])
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return spa('frontend.user.order-detail', compact('user', 'order'));
    }

    public function profile()
    {
        $user = Auth::user()->load(['division', 'district', 'upazila']);
        $divisions = Division::where('status', 1)->get();

        return spa('frontend.user.profile', compact('user', 'divisions'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|digits:11|unique:users,phone,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'division_id' => 'nullable|exists:divisions,id',
            'district_id' => 'nullable|exists:districts,id',
            'upazila_id' => 'nullable|exists:upazilas,id',
            'address' => 'nullable|string|max:1000',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'division_id' => $validated['division_id'] ?? null,
            'district_id' => $validated['district_id'] ?? null,
            'upazila_id' => $validated['upazila_id'] ?? null,
            'address' => $validated['address'] ?? null,
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

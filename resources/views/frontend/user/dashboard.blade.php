@extends('frontend.master')
@section('title', 'My Dashboard')

@section('content')
<div class="container page-header">
    <nav class="crumb">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Dashboard</span>
    </nav>
</div>

<section class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.user.partials.sidebar')
        </div>
        <div class="col-lg-9">
            <h4 class="fw-bold mb-4" style="color:#132238">Welcome back, {{ $user->name }}!</h4>

            @if(session('success'))
                <div style="border-radius:14px;border:none;background:rgba(22,163,74,.08);color:#16A34A;font-size:.9rem;padding:1rem 1.2rem;margin-bottom:1rem;display:flex;align-items:center;gap:8px">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Stats --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card-premium text-center" style="padding:1.5rem;background:linear-gradient(135deg,#F7F8FA,#F7F8FA);border-color:rgba(21,147,165,.15)">
                        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,rgba(21,147,165,.15),rgba(31,71,122,.1));display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px">
                            <i class="bi bi-bag" style="font-size:1.3rem;color:#1593A5"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color:#132238">{{ $totalOrders }}</h3>
                        <small style="color:#6B7A94;font-size:.82rem">Total Orders</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-premium text-center" style="padding:1.5rem;background:linear-gradient(135deg,#F0FDF4,#ECFDF5);border-color:rgba(22,163,74,.15)">
                        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,rgba(22,163,74,.15),rgba(22,163,74,.08));display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px">
                            <i class="bi bi-currency-dollar" style="font-size:1.3rem;color:#16A34A"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color:#132238">৳ {{ number_format($totalSpent, 0) }}</h3>
                        <small style="color:#6B7A94;font-size:.82rem">Total Spent</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-premium text-center" style="padding:1.5rem;background:linear-gradient(135deg,#EFF6FF,#F0F7FF);border-color:rgba(15,76,156,.15)">
                        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,rgba(15,76,156,.15),rgba(37,99,235,.08));display:inline-flex;align-items:center;justify-content:center;margin-bottom:12px">
                            <i class="bi bi-calendar-check" style="font-size:1.3rem;color:#0F4C9C"></i>
                        </div>
                        <h3 class="fw-bold mb-0" style="color:#132238;font-size:1rem">{{ $user->created_at->format('M d, Y') }}</h3>
                        <small style="color:#6B7A94;font-size:.82rem">Member Since</small>
                    </div>
                </div>
            </div>

            {{-- Recent Orders --}}
            <div class="card-premium" style="padding:1.5rem">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color:#132238">Recent Orders</h5>
                    <a @spa href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-brand" style="font-size:.82rem;padding:.4rem .9rem;border-radius:10px">View All</a>
                </div>

                @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <div style="width:70px;height:70px;border-radius:50%;background:rgba(21,147,165,.08);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px">
                            <i class="bi bi-bag" style="font-size:1.8rem;color:#1593A5"></i>
                        </div>
                        <h5 class="fw-bold" style="color:#132238">No orders yet</h5>
                        <p style="color:#6B7A94;font-size:.9rem">Start shopping to see your orders here</p>
                        <a @spa href="{{ route('shop') }}" class="btn btn-primary" style="border-radius:12px;padding:.6rem 1.5rem;font-size:.88rem">Browse Products</a>
                    </div>
                @else
                    <div style="overflow-x:auto">
                        <table style="width:100%;border-collapse:collapse">
                            <thead>
                                <tr style="border-bottom:1px solid #E6ECF5">
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;text-align:left">Order</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;text-align:left">Date</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;text-align:center">Status</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;text-align:left">Items</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;text-align:right">Amount</th>
                                    <th style="padding:.8rem 0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @php
                                        $badgeStyles = match($order->status) {
                                            'pending' => 'background:rgba(245,158,11,.12);color:#D97706',
                                            'confirmed' => 'background:rgba(37,99,235,.12);color:#2563EB',
                                            'processing' => 'background:rgba(21,147,165,.12);color:#1593A5',
                                            'shipped' => 'background:rgba(107,122,148,.12);color:#6B7A94',
                                            'delivered' => 'background:rgba(22,163,74,.12);color:#16A34A',
                                            'cancelled' => 'background:rgba(220,38,38,.12);color:#DC2626',
                                            default => 'background:rgba(107,122,148,.12);color:#6B7A94',
                                        };
                                    @endphp
                                    <tr style="border-bottom:1px solid #E6ECF5">
                                        <td style="padding:.9rem 0;font-weight:600;color:#132238;font-size:.88rem">#{{ $order->order_number }}</td>
                                        <td style="padding:.9rem 0;color:#6B7A94;font-size:.85rem">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td style="padding:.9rem 0;text-align:center">
                                            <span style="display:inline-block;padding:.3rem .7rem;border-radius:999px;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;{{ $badgeStyles }}">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td style="padding:.9rem 0;font-size:.85rem;color:#6B7A94">{{ $order->items->count() }} item(s)</td>
                                        <td style="padding:.9rem 0;text-align:right;font-weight:700;color:#132238;font-size:.9rem">৳ {{ number_format($order->total_amount, 0) }}</td>
                                        <td style="padding:.9rem 0;text-align:right">
                                            <a @spa href="{{ route('user.order.detail', $order->id) }}" style="display:inline-flex;align-items:center;gap:4px;padding:5px 12px;border-radius:8px;border:1px solid #E6ECF5;color:#0F4C9C;font-size:.78rem;font-weight:600;text-decoration:none;transition:all .2s" onmouseover="this.style.borderColor='rgba(21,147,165,.35)';this.style.color='#1593A5'" onmouseout="this.style.borderColor='#E6ECF5';this.style.color='#0F4C9C'">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

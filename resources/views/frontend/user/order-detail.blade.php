@extends('frontend.master')
@section('title', 'Order Details')

@section('content')
<div class="container page-header">
    <nav class="crumb">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <a @spa href="{{ route('user.dashboard') }}">Dashboard</a>
        <span class="sep">›</span>
        <a @spa href="{{ route('user.orders') }}">My Orders</a>
        <span class="sep">›</span>
        <span class="cur">#{{ $order->order_number }}</span>
    </nav>
</div>

<section class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.user.partials.sidebar')
        </div>
        <div class="col-lg-9">
            {{-- Order Header --}}
            <div class="card-premium mb-4" style="padding:1.5rem">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                    <div>
                        <h4 class="fw-bold mb-1" style="color:#132238">Order #{{ $order->order_number }}</h4>
                        <small style="color:#6B7A94;font-size:.85rem">
                            <i class="bi bi-calendar3 me-1"></i> Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}
                        </small>
                    </div>
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
                    <span style="display:inline-block;padding:.45rem 1rem;border-radius:999px;font-size:.85rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;{{ $badgeStyles }}">{{ ucfirst($order->status) }}</span>
                    <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="btn btn-primary btn-sm" style="border-radius:10px;padding:.4rem 1rem;font-size:.82rem">
                        <i class="bi bi-download me-1"></i> Invoice
                    </a>
                </div>
            </div>

            <div class="row g-4">
                {{-- Items --}}
                <div class="col-lg-8">
                    <div class="card-premium" style="padding:1.5rem">
                        <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-bag me-2" style="color:#1593A5"></i>Order Items</h5>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr style="border-bottom:1px solid #E6ECF5">
                                        <th style="font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;border:none">Product</th>
                                        <th class="text-center" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;border:none">Qty</th>
                                        <th class="text-end" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;border:none">Price</th>
                                        <th class="text-end" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.08em;color:#6B7A94;font-weight:700;padding:.8rem 0;border:none">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr style="border-bottom:1px solid #E6ECF5">
                                            <td style="padding:.9rem 0">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ asset(ltrim($item->product->image ?? 'placeholder.webp', '/')) }}"
                                                        style="width:50px;height:50px;object-fit:cover;border-radius:10px;border:1px solid #E6ECF5" alt="">
                                                    <div class="fw-semibold" style="color:#132238">{{ $item->product->name ?? 'Product' }}</div>
                                                </div>
                                            </td>
                                            <td class="text-center" style="padding:.9rem 0;font-size:.9rem">{{ $item->quantity }}</td>
                                            <td class="text-end" style="padding:.9rem 0;font-size:.9rem">৳ {{ number_format($item->price, 2) }}</td>
                                            <td class="text-end fw-bold" style="padding:.9rem 0;color:#132238">৳ {{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Summary & Address --}}
                <div class="col-lg-4">
                    {{-- Order Summary --}}
                    <div class="card-premium mb-4" style="padding:1.5rem">
                        <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-receipt me-2" style="color:#1593A5"></i>Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2" style="font-size:.9rem">
                            <span style="color:#6B7A94">Subtotal</span>
                            <span style="color:#132238">৳ {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:.9rem">
                            <span style="color:#6B7A94">Delivery</span>
                            <span style="color:#132238">৳ {{ number_format($order->delivery_fee, 2) }}</span>
                        </div>
                        <hr style="border-color:#E6ECF5;margin:.8rem 0">
                        <div class="d-flex justify-content-between">
                            <span class="fs-5 fw-bold" style="color:#132238">Total</span>
                            <span class="fs-5 fw-bold" style="color:#1593A5">৳ {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    {{-- Delivery Address --}}
                    <div class="card-premium" style="padding:1.5rem">
                        <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-geo-alt me-2" style="color:#1593A5"></i>Delivery Address</h5>
                        <p class="mb-1 fw-semibold" style="color:#132238;font-size:.9rem">{{ $order->customer_name }}</p>
                        <p class="mb-1" style="color:#6B7A94;font-size:.88rem">{{ $order->customer_phone }}</p>
                        <p class="mb-1" style="color:#132238;font-size:.88rem">{{ $order->address }}</p>
                        <p class="mb-0" style="color:#94a3b8;font-size:.82rem">
                            {{ $order->upazila->name ?? '' }}{{ $order->upazila->name && $order->district->name ? ', ' : '' }}{{ $order->district->name ?? '' }}{{ ($order->upazila->name || $order->district->name) && $order->division->name ? ', ' : '' }}{{ $order->division->name ?? '' }}
                        </p>
                        @if($order->note)
                            <div class="mt-3" style="background:#F8FAFC;border-radius:10px;padding:.6rem .8rem">
                                <small style="color:#6B7A94;font-size:.82rem"><i class="bi bi-chat-left-text me-1"></i> {{ $order->note }}</small>
                            </div>
                        @endif
                    </div>

                    {{-- Status History --}}
                    @if($order->statusHistory->count() > 0)
                    <div class="card-premium mt-4" style="padding:1.5rem">
                        <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-clock-history me-2" style="color:#1593A5"></i>Status History</h5>
                        @foreach($order->statusHistory as $history)
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    @php
                                        $dotStyles = match($history->status) {
                                            'pending' => 'background:rgba(245,158,11,.12);color:#D97706',
                                            'confirmed' => 'background:rgba(37,99,235,.12);color:#2563EB',
                                            'processing' => 'background:rgba(21,147,165,.12);color:#1593A5',
                                            'shipped' => 'background:rgba(107,122,148,.12);color:#6B7A94',
                                            'delivered' => 'background:rgba(22,163,74,.12);color:#16A34A',
                                            'cancelled' => 'background:rgba(220,38,38,.12);color:#DC2626',
                                            default => 'background:rgba(107,122,148,.12);color:#6B7A94',
                                        };
                                    @endphp
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;font-size:.7rem;font-weight:700;{{ $dotStyles }}">{{ strtoupper(substr($history->status, 0, 1)) }}</span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mt-0 mb-1" style="color:#132238;font-size:.9rem">{{ ucfirst($history->status) }}</h6>
                                    <p class="mb-0" style="color:#6B7A94;font-size:.82rem">
                                        {{ $history->created_at->format('d M Y, h:i A') }}
                                        @if($history->note)
                                            <br><small style="color:#94a3b8">{{ $history->note }}</small>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

</section>
@endsection

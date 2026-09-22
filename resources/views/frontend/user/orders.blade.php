@extends('frontend.master')
@section('title', 'My Orders')

@section('content')
<div class="container page-header">
    <nav class="crumb">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <a @spa href="{{ route('user.dashboard') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="cur">My Orders</span>
    </nav>
</div>

<section class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.user.partials.sidebar')
        </div>
        <div class="col-lg-9">
            <h4 class="fw-bold mb-4" style="color:#132238">My Orders</h4>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-radius:14px;border:none;background:rgba(22,163,74,.08);color:#16A34A;font-size:.9rem">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
                </div>
            @endif

            @if($orders->isEmpty())
                <div class="card-premium text-center" style="padding:3rem">
                    <div style="width:70px;height:70px;border-radius:50%;background:rgba(21,147,165,.08);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px">
                        <i class="bi bi-bag" style="font-size:1.8rem;color:#1593A5"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#132238">No orders found</h5>
                    <p style="color:#6B7A94;font-size:.9rem">Start shopping to see your orders here</p>
                    <a @spa href="{{ route('shop') }}" class="btn btn-primary" style="border-radius:12px;padding:.6rem 1.5rem;font-size:.88rem">Start Shopping</a>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="card-premium mb-3" style="padding:1.4rem">
                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                            <div>
                                <h6 class="fw-bold mb-1" style="color:#132238">Order #{{ $order->order_number }}</h6>
                                <small style="color:#6B7A94;font-size:.82rem">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                                </small>
                            </div>
                            <div class="text-end">
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
                                <span style="display:inline-block;padding:.35rem .8rem;border-radius:999px;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;{{ $badgeStyles }}">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>

                        <hr style="border-color:#E6ECF5;margin:1rem 0">

                        {{-- Items preview --}}
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            @foreach($order->items->take(3) as $item)
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset(ltrim($item->product->image ?? 'placeholder.webp', '/')) }}"
                                        style="width:42px;height:42px;object-fit:cover;border-radius:10px;border:1px solid #E6ECF5" alt="">
                                    <div>
                                        <div class="fw-semibold" style="font-size:.85rem;color:#132238;max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                            {{ $item->product->name ?? 'Product' }}
                                        </div>
                                        <small style="color:#6B7A94;font-size:.8rem">×{{ $item->quantity }}</small>
                                    </div>
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <div class="d-flex align-items-center">
                                    <small style="color:#6B7A94;font-size:.82rem">+{{ $order->items->count() - 3 }} more</small>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fw-bold" style="color:#132238">Total: ৳ {{ number_format($order->total_amount, 2) }}</div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('order.invoice', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius:10px;padding:.4rem 1rem;font-size:.82rem">
                                    <i class="bi bi-download me-1"></i> Invoice
                                </a>
                                <a @spa href="{{ route('user.order.detail', $order->id) }}" class="btn btn-sm btn-primary" style="border-radius:10px;padding:.4rem 1rem;font-size:.82rem">
                                    View Details <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

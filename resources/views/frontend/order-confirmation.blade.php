@extends('frontend.master')
@section('title', 'Order Confirmed')

@section('content')
<section class="container pb-5 pt-4">
    {{-- Success header --}}
    <div class="text-center mb-5">
        <div style="width:88px;height:88px;border-radius:50%;background:linear-gradient(135deg,#22c55e,#16A34A);display:inline-flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 16px 40px -10px rgba(22,163,74,.45)">
            <i class="bi bi-check-lg" style="font-size:42px;color:#fff"></i>
        </div>
        <h2 style="font-weight:800;color:var(--dark);margin-bottom:6px">Order Placed Successfully!</h2>
        <p style="color:var(--muted);font-size:.95rem;max-width:420px;margin:0 auto">Thank you for your order. We'll contact you shortly to confirm.</p>
        <div style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:999px;background:linear-gradient(135deg,rgba(22,163,74,.08),rgba(22,163,74,.04));border:1px solid rgba(22,163,74,.15)">
            <i class="bi bi-hash" style="color:var(--success);font-weight:700;font-size:1rem"></i>
            <span style="font-weight:700;font-size:.95rem;color:var(--success)">{{ $order->order_number }}</span>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            {{-- Order items --}}
            <div style="padding:1.6rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff;margin-bottom:16px">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.2rem">
                    <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#1593A5,#1F477A);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0"><i class="bi bi-bag-check-fill"></i></span>
                    <h5 style="font-weight:700;font-size:1.05rem;color:var(--dark);margin:0;flex:1">Order Details</h5>
                    <span style="padding:5px 12px;border-radius:999px;background:rgba(21,147,165,.08);color:var(--primary);font-size:.75rem;font-weight:700">Cash on Delivery</span>
                </div>

                <div style="overflow-x:auto">
                    <table style="width:100%;border-collapse:collapse">
                        <thead>
                            <tr style="border-bottom:2px solid var(--border)">
                                <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:.7rem .5rem;text-align:left">Product</th>
                                <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:.7rem .5rem;text-align:center">Qty</th>
                                <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:.7rem .5rem;text-align:right">Price</th>
                                <th style="font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:.7rem .5rem;text-align:right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr style="border-bottom:1px solid var(--border)">
                                <td style="padding:12px .5rem">
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <div style="width:48px;height:48px;border-radius:10px;overflow:hidden;flex-shrink:0;background:linear-gradient(160deg,#F7F8FA,#EAF4FF)">
                                            <img src="{{ asset(ltrim($item->product->image ?? 'placeholder.webp', '/')) }}" alt="{{ $item->product->name ?? '' }}" style="width:100%;height:100%;object-fit:cover">
                                        </div>
                                        <div style="font-weight:600;font-size:.88rem;color:var(--dark)">{{ $item->product->name ?? '' }}</div>
                                    </div>
                                </td>
                                <td style="padding:12px .5rem;text-align:center;font-weight:600;font-size:.9rem;color:var(--dark)">×{{ $item->quantity }}</td>
                                <td style="padding:12px .5rem;text-align:right;font-size:.88rem;color:var(--dark)">৳ {{ number_format($item->price, 0) }}</td>
                                <td style="padding:12px .5rem;text-align:right;font-weight:700;font-size:.9rem;color:var(--primary)">৳ {{ number_format($item->total, 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Address + Summary side by side --}}
            <div class="row g-4">
                <div class="col-md-6">
                    <div style="padding:1.4rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff;height:100%">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:1rem">
                            <span style="width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#0F4C9C,#2563EB);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;flex-shrink:0"><i class="bi bi-geo-alt-fill"></i></span>
                            <span style="font-weight:700;font-size:.9rem;color:var(--dark)">Delivery Address</span>
                        </div>
                        <div style="font-weight:600;font-size:.9rem;color:var(--dark);margin-bottom:4px">{{ $order->customer_name }}</div>
                        <div style="font-size:.85rem;color:var(--muted);margin-bottom:4px">{{ $order->customer_phone }}</div>
                        <div style="font-size:.85rem;color:var(--dark);line-height:1.6">
                            {{ $order->address }},
                            {{ $order->upazila->name ?? '' }},
                            {{ $order->district->name ?? '' }},
                            {{ $order->division->name ?? '' }}
                        </div>
                        @if($order->note)
                            <div style="margin-top:10px;padding:8px 12px;border-radius:10px;background:rgba(15,76,156,.04);font-size:.82rem;color:var(--muted);display:flex;align-items:center;gap:6px">
                                <i class="bi bi-chat-left-text" style="font-size:.8rem"></i> {{ $order->note }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding:1.4rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff;height:100%">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:1rem">
                            <span style="width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#1593A5,#1F477A);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.75rem;flex-shrink:0"><i class="bi bi-receipt"></i></span>
                            <span style="font-weight:700;font-size:.9rem;color:var(--dark)">Order Summary</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;padding:.35rem 0;font-size:.88rem;color:var(--dark)">
                            <span>Subtotal</span>
                            <span style="font-weight:600">৳ {{ number_format($order->subtotal, 0) }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;padding:.35rem 0;font-size:.88rem;color:var(--dark)">
                            <span>Delivery</span>
                            <span style="font-weight:600">৳ {{ number_format($order->delivery_fee, 0) }}</span>
                        </div>
                        <div style="border-top:1px dashed var(--border);margin-top:.5rem;padding-top:.6rem;display:flex;justify-content:space-between;font-weight:800;font-size:1.05rem;color:var(--primary)">
                            <span>Total</span>
                            <span>৳ {{ number_format($order->total_amount, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div style="margin-top:1.5rem;display:flex;flex-wrap:wrap;gap:10px;justify-content:center">
                <a href="{{ route('order.invoice', $order->id) }}" target="_blank"
                    style="display:inline-flex;align-items:center;justify-content:center;gap:.5rem;border:none;border-radius:14px;padding:.8rem 2.5rem;font-weight:700;font-size:.95rem;cursor:pointer;background:linear-gradient(135deg,#0F4C9C,#2563EB);color:#fff;transition:all .35s;text-decoration:none;font-family:inherit"
                    onmouseover="this.style.transform='translateY(-3px) scale(1.02)';this.style.boxShadow='0 18px 40px -14px rgba(15,76,156,.45)'"
                    onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                    <i class="bi bi-download"></i> Download Invoice
                </a>
                <a @spa href="{{ route('shop') }}"
                    style="display:inline-flex;align-items:center;justify-content:center;gap:.5rem;border:none;border-radius:14px;padding:.8rem 2.5rem;font-weight:700;font-size:.95rem;cursor:pointer;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;transition:all .35s;text-decoration:none;font-family:inherit"
                    onmouseover="this.style.transform='translateY(-3px) scale(1.02)';this.style.boxShadow='0 18px 40px -14px rgba(21,147,165,.45)'"
                    onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                    <i class="bi bi-shop"></i> Continue Shopping
                </a>
                <a @spa href="{{ route('home') }}"
                    style="display:inline-flex;align-items:center;justify-content:center;gap:.5rem;border:1.5px solid var(--primary);border-radius:14px;padding:.8rem 2.5rem;font-weight:600;font-size:.95rem;cursor:pointer;background:transparent;color:var(--primary);transition:all .35s;text-decoration:none;font-family:inherit"
                    onmouseover="this.style.background='rgba(21,147,165,.08)';this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.background='transparent';this.style.transform='none'">
                    <i class="bi bi-house"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

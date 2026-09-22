@extends('frontend.master')
@section('title', 'Cart')

@section('content')
<div class="container page-hero">
    <div class="crumbs">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Shopping Cart</span>
    </div>
    <h1 class="mt-3">Shopping Cart</h1>
</div>

<section class="container pb-5">
    <div id="cartContent">
        @if(count($items) > 0)
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card-premium" style="padding:1.4rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff">
                        <div class="table-responsive" style="overflow-x:auto;-webkit-overflow-scrolling:touch">
                        <table class="table align-middle mb-0" id="cartTable" style="min-width:600px">
                            <thead>
                                <tr style="border-bottom:2px solid var(--border)">
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:1rem .75rem">Product</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:1rem .75rem">Price</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:1rem .75rem">Qty</th>
                                    <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);font-weight:700;padding:1rem .75rem">Total</th>
                                    <th style="padding:1rem .75rem"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $data)
                                    @php $product = $data['product']; @endphp
                                    <tr id="cart-row-{{ $product->id }}" data-id="{{ $product->id }}" data-price="{{ $data['price'] }}" data-subtotal="{{ $data['price'] * $data['qty'] }}" style="border-bottom:1px solid var(--border);transition:background .2s">
                                        <td style="padding:1rem .75rem">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width:64px;height:64px;border-radius:14px;overflow:hidden;flex-shrink:0;background:linear-gradient(160deg,#F7F8FA,#EAF4FF)">
                                                    <img src="{{ asset(ltrim($product->image ?? 'placeholder.webp', '/')) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover">
                                                </div>
                                                <div style="min-width:0">
                                                    <a @spa href="{{ route('product.show', $product->slug) }}" style="font-weight:600;font-size:.9rem;color:var(--dark);text-decoration:none;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;transition:color .2s">{{ $product->name }}</a>
                                                    <div style="font-size:.75rem;color:var(--muted);margin-top:2px">{{ $product->brand->name ?? '' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding:1rem .75rem;font-weight:600;font-size:.9rem;color:var(--dark)">৳ {{ number_format($data['price'], 0) }}</td>
                                        <td style="padding:1rem .75rem">
                                            <div class="qty-box" style="display:inline-flex;align-items:center;border:1px solid var(--border);border-radius:12px;overflow:hidden">
                                                <button class="cart-minus" style="border:none;background:transparent;width:36px;height:36px;color:var(--dark);cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;transition:color .2s">−</button>
                                                <input class="cart-qty-input" value="{{ $data['qty'] }}" readonly style="width:40px;border:none;text-align:center;outline:none;font-weight:600;font-size:.9rem">
                                                <button class="cart-plus" style="border:none;background:transparent;width:36px;height:36px;color:var(--dark);cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;transition:color .2s">+</button>
                                            </div>
                                        </td>
                                        <td style="padding:1rem .75rem;font-weight:700;font-size:.95rem;color:var(--primary)" class="cart-item-total">৳ {{ number_format($data['price'] * $data['qty'], 0) }}</td>
                                        <td style="padding:1rem .75rem">
                                            <button class="cart-remove-btn" title="Remove" style="width:36px;height:36px;border-radius:10px;border:1px solid var(--border);background:transparent;color:var(--muted);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s">
                                                <i class="bi bi-trash" style="font-size:.9rem"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="summary-card" style="padding:1.6rem">
                        <h5 style="font-weight:700;font-size:1.1rem;color:var(--dark);margin-bottom:1rem">Order Summary</h5>
                        <div style="display:flex;justify-content:space-between;padding:.5rem 0;font-size:.9rem;color:var(--dark)">
                            <span>Subtotal</span>
                            <span class="fw-bold" id="cartTotal">৳ {{ number_format($total, 0) }}</span>
                        </div>
                        <div style="border-top:1px dashed var(--border);margin-top:.5rem;padding-top:.9rem;display:flex;justify-content:space-between;font-weight:800;font-size:1.05rem;color:var(--primary)">
                            <span>Total</span>
                            <span id="cartTotalBottom">৳ {{ number_format($total, 0) }}</span>
                        </div>
                        <a @spa href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-100" style="display:none;margin-top:1rem;border-radius:14px;padding:.8rem;font-weight:700">
                            <i class="bi bi-lightning-fill"></i> Proceed to Checkout
                        </a>
                        <a @spa href="{{ route('shop') }}" class="btn btn-outline-brand w-100" style="margin-top:.6rem;border-radius:14px;padding:.7rem;font-weight:600;font-size:.9rem">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center p-5">
                <div style="width:80px;height:80px;border-radius:50%;background:rgba(21,147,165,.08);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px">
                    <i class="bi bi-bag" style="font-size:2rem;color:var(--primary)"></i>
                </div>
                <h4 class="mt-2" style="font-weight:700">Your cart is empty</h4>
                <p class="text-muted" style="font-size:.9rem">Add some products to get started</p>
                <a @spa href="{{ route('shop') }}" class="btn btn-primary" style="margin-top:8px;border-radius:14px;padding:.65rem 2rem">Shop Now</a>
            </div>
        @endif
    </div>
</section>
@endsection

@section('script')
<script>
function cartPageInit() {
    // Hover effects for rows
    $('#cartTable tbody tr').off('mouseenter mouseleave').on('mouseenter', function() {
        $(this).css('background', 'rgba(21,147,165,.03)');
    }).on('mouseleave', function() {
        $(this).css('background', 'transparent');
    });
    // Button hover effects
    $('.cart-minus, .cart-plus').off('mouseenter mouseleave').on('mouseenter', function() {
        $(this).css('color', '#1593A5');
    }).on('mouseleave', function() {
        $(this).css('color', 'var(--dark)');
    });
    $('.cart-remove-btn').off('mouseenter mouseleave').on('mouseenter', function() {
        $(this).css({ 'border-color': '#DC2626', 'color': '#DC2626', 'background': 'rgba(220,38,38,.06)' });
    }).on('mouseleave', function() {
        $(this).css({ 'border-color': 'var(--border)', 'color': 'var(--muted)', 'background': 'transparent' });
    });
}
document.addEventListener('DOMContentLoaded', cartPageInit);
document.addEventListener('spa:loaded', cartPageInit);
</script>
@endsection

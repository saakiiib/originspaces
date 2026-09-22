@extends('frontend.master')
@section('title', $product->name ?? 'Product')

@section('style')
<style>
#mainImageWrap { overflow: hidden; position: relative; }
#mainImageWrap img { transition: transform .1s ease-out; transform-origin: center center; }
.gallery-thumb:hover { border-color: #1593A5 !important; }

.tab-collapse-wrap {
    position: relative;
    overflow: hidden;
    transition: max-height 0.4s ease;
}
.tab-collapse-wrap.collapsed {
    max-height: 350px;
}
.tab-collapse-wrap.expanded {
    max-height: 2000px;
}
.tab-collapse-wrap.overflowing.collapsed::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: linear-gradient(transparent, #fff);
    pointer-events: none;
}
.tab-toggle-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    padding: 8px 20px;
    border: 1px solid #E6ECF5;
    border-radius: 10px;
    background: #F8FAFC;
    color: #0F4C9C;
    font-size: .85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s;
}
.tab-toggle-btn:hover {
    background: #0F4C9C;
    color: #fff;
    border-color: #0F4C9C;
}
</style>
@endsection

@php
    $effectivePrice = $product->offer_price ?? $product->regular_price;
    $hasOffer = $product->offer_price && $product->offer_price < $product->regular_price;
    $inStock = $product->stock_quantity > 0;
    $discount = $hasOffer ? round((($product->regular_price - $product->offer_price) / $product->regular_price) * 100) : 0;
    $images = $product->images->sortBy('sort_order');
    $mainImage = $product->image ?? 'placeholder.webp';
    $showPrice = $product->show_price ?? 1;
@endphp

@section('content')
{{-- Breadcrumb --}}
<div class="container page-hero">
    <div class="crumbs">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <a href="{{ route('shop') }}">Shop</a>
        <span class="sep">›</span>
        @if($product->category)
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            <span class="sep">›</span>
        @endif
        <span class="cur">{{ $product->name }}</span>
    </div>
</div>

{{-- Product Main Section --}}
<section class="container pb-5">
    <div class="row g-5">
        {{-- Gallery --}}
        <div class="col-lg-6">
            <div style="position:relative;border-radius:22px;overflow:hidden;background:linear-gradient(160deg,#F7F8FA,#EAF4FF);border:1px solid #E6ECF5;cursor:zoom-in" id="mainImageWrap">
                @if($hasOffer && $discount > 0)
                    <span style="display:none;position:absolute;top:16px;left:16px;background:linear-gradient(135deg,#DC2626,#F59E0B);color:#fff;padding:5px 14px;border-radius:10px;font-size:.75rem;font-weight:700;z-index:2">-{{ $discount }}%</span>
                @elseif($product->is_new_arrival)
                    <span style="position:absolute;top:16px;left:16px;background:linear-gradient(135deg,#16A34A,#22c55e);color:#fff;padding:5px 14px;border-radius:10px;font-size:.75rem;font-weight:700;z-index:2">NEW</span>
                @endif
                <a href="{{ asset(ltrim($mainImage, '/')) }}" class="glightbox product-zoom-link" data-gallery="product-gallery" data-description="{{ $product->name }}">
                    <img id="gMain" src="{{ asset(ltrim($mainImage, '/')) }}" alt="{{ $product->name }}" style="width:100%;aspect-ratio:1;object-fit:cover;display:block">
                </a>
            </div>
            @if($images->count() > 1)
                <div class="d-flex gap-2 mt-3 flex-wrap" id="productThumbs">
                    @foreach($images as $img)
                        <a href="{{ asset(ltrim($img->image_path, '/')) }}" class="glightbox gallery-thumb-link" data-gallery="product-gallery" data-description="{{ $product->name }}">
                            <img src="{{ asset(ltrim($img->image_path, '/')) }}" alt="{{ $product->name }}"
                                 class="gallery-thumb" style="width:80px;height:80px;object-fit:cover;border-radius:12px;cursor:pointer;border:2px solid transparent;transition:all .2s"
                                 onclick="document.getElementById('gMain').src=this.src">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="col-lg-6">
            {{-- Badges --}}
            <div class="d-flex flex-wrap gap-2 mb-3">
                @if($product->is_hot)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#DC2626,#F59E0B);color:#fff;padding:4px 12px;border-radius:999px;font-size:.72rem;font-weight:700"><i class="bi bi-fire"></i> Hot</span>
                @endif
                @if($product->is_trending)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;padding:4px 12px;border-radius:999px;font-size:.72rem;font-weight:700"><i class="bi bi-graph-up-arrow"></i> Trending</span>
                @endif
                @if($product->is_most_selling)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#16A34A,#22c55e);color:#fff;padding:4px 12px;border-radius:999px;font-size:.72rem;font-weight:700"><i class="bi bi-trophy"></i> Best Seller</span>
                @endif
                @if($product->is_new_arrival)
                    <span style="display:inline-flex;align-items:center;gap:4px;background:linear-gradient(135deg,#0F4C9C,#2563EB);color:#fff;padding:4px 12px;border-radius:999px;font-size:.72rem;font-weight:700"><i class="bi bi-stars"></i> New Arrival</span>
                @endif
            </div>

            {{-- Brand --}}
            @if($product->brand)
                <div style="font-size:.8rem;color:#0F4C9C;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:4px">{{ $product->brand->name }}</div>
            @endif

            {{-- Name --}}
            <h1 style="font-weight:800;font-size:1.8rem;color:#132238;line-height:1.2;margin:0 0 8px">{{ $product->name }}</h1>

            {{-- Short description --}}
            @if($product->short_description)
                <div style="color:#6B7A94;font-size:.95rem;margin:0 0 16px">{!! $product->short_description !!}</div>
            @endif

            {{-- Code & Model --}}
            <div class="d-flex flex-wrap gap-3 mb-3" style="font-size:.85rem;color:#6B7A94">
                <span style="display:none"><b style="color:#132238">Code:</b> {{ $product->code }}</span>
                @if($product->model)
                    <span><b style="color:#132238">Model:</b> {{ $product->model }}</span>
                @endif
                @if($product->category)
                    <span><b style="color:#132238">Category:</b> <a href="{{ route('shop', ['category' => $product->category->slug]) }}" style="color:#1593A5;text-decoration:none">{{ $product->category->name }}</a></span>
                @endif
            </div>

            {{-- Price --}}
            @if($showPrice)
            <div style="display:flex;align-items:baseline;gap:12px;margin:16px 0">
                @if($hasOffer)
                    <span style="color:#6B7A94;text-decoration:line-through;font-size:1rem">৳{{ number_format($product->regular_price, 0) }}</span>
                    <span style="font-size:1.8rem;font-weight:800;color:#1593A5">৳{{ number_format($effectivePrice, 0) }}</span>
                    <span style="background:#DC2626;color:#fff;padding:3px 10px;border-radius:8px;font-size:.72rem;font-weight:700">Save ৳{{ number_format($product->regular_price - $effectivePrice, 0) }}</span>
                @else
                    <span style="font-size:1.8rem;font-weight:800;color:#1593A5">৳{{ number_format($effectivePrice, 0) }}</span>
                @endif
            </div>
            @endif

            {{-- Stock --}}
            <div class="mb-3" style="display:none">
                @if($inStock)
                    <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(22,163,74,.1);color:#16A34A;padding:6px 14px;border-radius:10px;font-size:.85rem;font-weight:600"><i class="bi bi-check-circle-fill"></i> In Stock ({{ $product->stock_quantity }} available)</span>
                @else
                    <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,.1);color:#DC2626;padding:6px 14px;border-radius:10px;font-size:.85rem;font-weight:600"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>
                @endif
            </div>

            {{-- Add to Cart & WhatsApp --}}
            @php
                $company = $company ?? \App\Models\CompanyDetails::firstOrCreate();
                $rawWa = $company->whatsapp ?: ($company->phone1 ?? '');
                $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
                if (strlen($cleanWa) === 11 && str_starts_with($cleanWa, '01')) {
                    $cleanWa = '88' . $cleanWa;
                }
                $waMessage = route('product.show', $product->slug) . "\n\nHello, I am interested in this product: " . $product->name;
                $waUrl = "https://wa.me/" . $cleanWa . "?text=" . rawurlencode($waMessage);
                $wishlist = session('wishlist', []);
                $isWished = isset($wishlist[$product->id]);
            @endphp
            <div class="d-flex gap-3 align-items-center mb-4 flex-wrap" id="cartSection">
                {{-- Add to Cart Button (hidden) --}}
                @if($inStock)
                    <div style="display:none">
                        <div style="display:inline-flex;align-items:center;border:1px solid #E6ECF5;border-radius:12px;overflow:hidden">
                            <button onclick="changeQty(-1)" style="width:42px;height:42px;border:none;background:transparent;font-size:1.2rem;cursor:pointer;font-weight:700;color:#132238">−</button>
                            <input type="number" id="qtyInput" value="1" min="1" max="{{ $product->stock_quantity }}" readonly style="width:50px;border:none;text-align:center;font-weight:700;font-size:1rem;outline:none">
                            <button onclick="changeQty(1)" style="width:42px;height:42px;border:none;background:transparent;font-size:1.2rem;cursor:pointer;font-weight:700;color:#132238">+</button>
                        </div>
                        <button class="btn btn-primary btn-lg flex-grow-1" id="addToCartBtn" data-product="{{ $product->id }}" style="border-radius:14px">
                            <i class="bi bi-bag-plus"></i> Add to cart
                        </button>
                    </div>
                @endif

                {{-- Contact for price (WhatsApp) Button --}}
                @if(!empty($cleanWa))
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-2" style="border-radius:14px;padding:0 1.5rem;height:48px;font-weight:700;font-size:.95rem;text-decoration:none;border:none;white-space:nowrap;transition:all .25s" title="Contact for price via WhatsApp">
                        <i class="bi bi-whatsapp" style="font-size:1.25rem"></i>
                        <span>Contact for price</span>
                    </a>
                @endif

                {{-- Wishlist Button (hidden as requested) --}}
                <button class="icon-btn {{ $isWished ? 'active' : '' }}" data-wish="{{ $product->id }}" onclick="toggleWish({{ $product->id }})" style="display:none!important;width:50px;height:50px;border-radius:14px;font-size:1.2rem">
                    <i class="bi bi-heart{{ $isWished ? '-fill' : '' }}"></i>
                </button>
            </div>

            {{-- YouTube Video (inline below product info) --}}
            @if($product->youtube_video_url)
            @php
                $videoUrl = $product->youtube_video_url;
                $videoId = '';
                if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                    $videoId = $matches[1];
                }
            @endphp
            @if($videoId)
            <div style="margin-top:24px">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px">
                    <span style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#DC2626,#F59E0B);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.85rem"><i class="bi bi-play-fill"></i></span>
                    <span style="font-weight:700;font-size:.9rem;color:#132238">Product Video</span>
                </div>
                <div class="ratio ratio-16x9" style="border-radius:16px;overflow:hidden;border:1px solid #E6ECF5">
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="Product Video" allowfullscreen></iframe>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
</section>

{{-- Tabs: Description, Specs, Warranty, Return --}}
<section class="container" style="padding-top:2rem;padding-bottom:3rem;overflow:hidden">
    @php
        $hasDesc = !empty(strip_tags($product->description));
        $hasSpec = !empty(strip_tags($product->specification));
        $hasWarranty = !empty(strip_tags($product->warranty_policy));
        $hasReturn = !empty(strip_tags($product->return_policy));
    @endphp

    @if($hasDesc || $hasSpec || $hasWarranty || $hasReturn)
    <div class="product-tabs" style="overflow:hidden">
        <ul class="nav nav-tabs" id="productTabs" role="tablist" style="border-bottom:none;gap:8px;flex-wrap:wrap;margin-bottom:20px">
            @if($hasDesc)
                <li class="nav-item" role="presentation">
                    <button class="nav-link filter-pill active" data-bs-toggle="tab" data-bs-target="#tabDesc" type="button"><i class="bi bi-file-text me-1"></i>Description</button>
                </li>
            @endif
            @if($hasSpec)
                <li class="nav-item" role="presentation">
                    <button class="nav-link filter-pill {{ !$hasDesc ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tabSpec" type="button"><i class="bi bi-list-check me-1"></i>Specifications</button>
                </li>
            @endif
            @if($hasWarranty)
                <li class="nav-item" role="presentation">
                    <button class="nav-link filter-pill {{ !$hasDesc && !$hasSpec ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tabWarranty" type="button"><i class="bi bi-shield-check me-1"></i>Warranty</button>
                </li>
            @endif
            @if($hasReturn)
                <li class="nav-item" role="presentation">
                    <button class="nav-link filter-pill {{ !$hasDesc && !$hasSpec && !$hasWarranty ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tabReturn" type="button"><i class="bi bi-arrow-return-left me-1"></i>Returns</button>
                </li>
            @endif
        </ul>

        <div class="tab-content" id="productTabContent" style="background:#fff;border:1px solid #E6ECF5;border-radius:0 16px 16px 16px;padding:24px;overflow:hidden;word-wrap:break-word;overflow-wrap:break-word">
            @if($hasDesc)
                <div class="tab-pane fade show active" id="tabDesc" style="min-width:0">
                    <div class="tab-collapse-wrap collapsed" data-tab="tabDesc">
                        <div style="font-size:.95rem;line-height:1.8;color:#1e293b;overflow-wrap:break-word;word-wrap:break-word;max-width:100%">{!! $product->description !!}</div>
                    </div>
                    <button class="tab-toggle-btn" onclick="toggleTab(this, this.previousElementSibling)"><i class="bi bi-chevron-down"></i> Show More</button>
                </div>
            @endif
            @if($hasSpec)
                <div class="tab-pane fade {{ !$hasDesc ? 'show active' : '' }}" id="tabSpec" style="min-width:0">
                    <div class="tab-collapse-wrap collapsed" data-tab="tabSpec">
                        <div style="font-size:.95rem;line-height:1.8;color:#1e293b;overflow-wrap:break-word;word-wrap:break-word;max-width:100%">{!! $product->specification !!}</div>
                    </div>
                    <button class="tab-toggle-btn" onclick="toggleTab(this, this.previousElementSibling)"><i class="bi bi-chevron-down"></i> Show More</button>
                </div>
            @endif
            @if($hasWarranty)
                <div class="tab-pane fade {{ !$hasDesc && !$hasSpec ? 'show active' : '' }}" id="tabWarranty" style="min-width:0">
                    <div class="tab-collapse-wrap collapsed" data-tab="tabWarranty">
                        <div style="font-size:.95rem;line-height:1.8;color:#1e293b;overflow-wrap:break-word;word-wrap:break-word;max-width:100%">{!! $product->warranty_policy !!}</div>
                    </div>
                    <button class="tab-toggle-btn" onclick="toggleTab(this, this.previousElementSibling)"><i class="bi bi-chevron-down"></i> Show More</button>
                </div>
            @endif
            @if($hasReturn)
                <div class="tab-pane fade {{ !$hasDesc && !$hasSpec && !$hasWarranty ? 'show active' : '' }}" id="tabReturn" style="min-width:0">
                    <div class="tab-collapse-wrap collapsed" data-tab="tabReturn">
                        <div style="font-size:.95rem;line-height:1.8;color:#1e293b;overflow-wrap:break-word;word-wrap:break-word;max-width:100%">{!! $product->return_policy !!}</div>
                    </div>
                    <button class="tab-toggle-btn" onclick="toggleTab(this, this.previousElementSibling)"><i class="bi bi-chevron-down"></i> Show More</button>
                </div>
            @endif
        </div>
    </div>
    @endif
</section>

{{-- Related Products --}}
@if($related->isNotEmpty())
<section class="container pb-5">
    <div class="sec-head">
        <div>
            <span class="eyebrow">You may also like</span>
            <h2 class="section-title">Related Products</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-outline-brand btn-sm">View All <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row g-4">
        @foreach($related as $rel)
            <div class="col-lg-3 col-md-6">
                @include('frontend.partials.product-card', ['product' => $rel])
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection

@section('script')
<script>
function toggleTab(btn, wrap) {
    var isCollapsed = wrap.classList.contains('collapsed');

    if (isCollapsed) {
        wrap.classList.remove('collapsed');
        wrap.classList.add('expanded');
        btn.innerHTML = '<i class="bi bi-chevron-up"></i> Show Less';
    } else {
        wrap.classList.remove('expanded');
        wrap.classList.add('collapsed');
        btn.innerHTML = '<i class="bi bi-chevron-down"></i> Show More';
    }
}

document.querySelectorAll('.tab-collapse-wrap').forEach(function(wrap) {
    checkTabOverflow(wrap);
});

document.querySelectorAll('#productTabs button[data-bs-toggle="tab"]').forEach(function(tab) {
    tab.addEventListener('shown.bs.tab', function(e) {
        var target = document.querySelector(e.target.dataset.bsTarget);
        if (target) {
            setTimeout(function() {
                target.querySelectorAll('.tab-collapse-wrap').forEach(function(wrap) {
                    checkTabOverflow(wrap);
                });
            }, 10);
        }
    });
});

function checkTabOverflow(wrap) {
    var btn = wrap.nextElementSibling;
    if (!btn || !btn.classList.contains('tab-toggle-btn')) return;
    wrap.classList.remove('overflowing');
    btn.style.display = '';
    if (wrap.scrollHeight > 350) {
        wrap.classList.add('overflowing');
    } else {
        btn.style.display = 'none';
    }
}

function changeQty(delta) {
    var input = document.getElementById('qtyInput');
    if (!input) return;
    var val = parseInt(input.value) + delta;
    var max = parseInt(input.max) || 999;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}

$(document).on('click', '#addToCartBtn', function() {
    var productId = $(this).data('product');
    var qty = parseInt($('#qtyInput').val()) || 1;
    addToCart(productId, qty);
});

function initProductGallery() {
    if (typeof GLightbox === 'undefined') {
        setTimeout(initProductGallery, 200);
        return;
    }
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        zoomable: true,
        closeButton: true,
        skin: 'clean'
    });
}

window.initProductGallery = initProductGallery;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}

document.addEventListener('spa:loaded', function() {
    initProductGallery();
});

(function() {
    var wrap = document.getElementById('mainImageWrap');
    var img = document.getElementById('gMain');
    if (!wrap || !img) return;

    var zoomLevel = 2.5;

    img.addEventListener('mouseenter', function() {
        img.style.transition = 'transform 0.15s ease-out';
    });

    img.addEventListener('mouseleave', function() {
        img.style.transition = 'transform 0.3s ease-out';
        img.style.transform = 'scale(1)';
        img.style.transformOrigin = 'center center';
    });

    img.addEventListener('mousemove', function(e) {
        var rect = wrap.getBoundingClientRect();
        var x = ((e.clientX - rect.left) / rect.width) * 100;
        var y = ((e.clientY - rect.top) / rect.height) * 100;

        img.style.transition = 'none';
        img.style.transformOrigin = x + '% ' + y + '%';
        img.style.transform = 'scale(' + zoomLevel + ')';
    });
})();
</script>
@endsection

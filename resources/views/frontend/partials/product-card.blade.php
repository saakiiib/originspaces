@props(['product'])

@php
    if (empty($product->slug)) return;
    $brand = $product->brand->name ?? null;
    $effectivePrice = $product->offer_price ?? $product->regular_price;
    $hasOffer = $product->offer_price && $product->offer_price < $product->regular_price;
    $image = $product->image ?? 'placeholder.webp';
    $wishlist = session('wishlist', []);
    $isWished = isset($wishlist[$product->id]);
    $inStock = $product->stock_quantity > 0;
    $discount = $hasOffer ? round((($product->regular_price - $product->offer_price) / $product->regular_price) * 100) : 0;
    $showPrice = $product->show_price ?? 1;
@endphp

<div class="prod-card">
  <div class="prod-img-wrap">
    @if($hasOffer && $discount > 0)
      <span class="badge-sale" style="display:none">-{{ $discount }}%</span>
    @elseif($product->is_new_arrival)
      <span class="badge-new">NEW</span>
    @endif
    <div class="quick-actions">
      <button class="qa-btn {{ $isWished ? 'active' : '' }}" title="Wishlist" data-wish="{{ $product->id }}" onclick="toggleWish({{ $product->id }}); return false;"><i class="bi bi-heart{{ $isWished ? '-fill' : '' }}"></i></button>
      <a @spa href="{{ route('product.show', $product->slug) }}" class="qa-btn" title="Quick view"><i class="bi bi-eye"></i></a>
    </div>
    <a @spa href="{{ route('product.show', $product->slug) }}">
      <img src="{{ asset(ltrim($image, '/')) }}" alt="{{ $product->name }}" loading="lazy">
    </a>
  </div>
  <div class="prod-body">
    @if($brand)
      <div class="prod-brand">{{ $brand }}</div>
    @endif
    <a @spa href="{{ route('product.show', $product->slug) }}" class="prod-title">{{ $product->name }}</a>
    <div class="prod-foot">
      @if($showPrice)
      <div class="prod-price">৳{{ number_format($effectivePrice, 0) }}@if($hasOffer) <span class="old">৳{{ number_format($product->regular_price, 0) }}</span>@endif</div>
      @endif
      <button class="btn btn-ghost btn-icon add-to-cart" style="display:none" title="Add to cart" onclick="addToCart({{ $product->id }}); return false;" {{ !$inStock ? 'disabled' : '' }}><i class="bi bi-cart-plus"></i></button>
    </div>
  </div>
</div>

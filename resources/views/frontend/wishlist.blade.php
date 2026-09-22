@extends('frontend.master')
@section('title', 'Wishlist')

@section('content')
<div class="container page-hero">
    <div class="crumbs">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">My Wishlist</span>
    </div>
    <h1 class="mt-3">My Wishlist</h1>
</div>

<section class="container pb-5">
    <div id="wishlistContent">
        @if($products->isNotEmpty())
            <div class="row g-4" id="wishlistGrid">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6" id="wish-row-{{ $product->id }}">
                        @include('frontend.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-5">
                <i class="bi bi-heart fs-1 text-muted"></i>
                <h4 class="mt-3">Your wishlist is empty</h4>
                <p class="text-muted">Save products you love for later</p>
                <a @spa href="{{ route('shop') }}" class="btn btn-primary">Browse Products</a>
            </div>
        @endif
    </div>
</section>

@endsection

@extends('frontend.master')
@section('title', 'Shop')

@section('style')
<style>
.carousel-control-prev,.carousel-control-next{display:none!important}
.shop-filter-section{border:1px solid #E6ECF5;border-radius:14px;margin-bottom:12px;background:#fff;overflow:hidden}
.shop-filter-header{padding:14px 16px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;font-weight:700;font-size:.9rem;color:#132238;transition:background .2s}
.shop-filter-header:hover{background:rgba(21,147,165,.04)}
.shop-filter-header i.arrow-icon{transition:transform .3s;font-size:.8rem;color:#94a3b8}
.shop-filter-header.open i.arrow-icon{transform:rotate(180deg)}
.shop-filter-body{padding:0 16px;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s ease}
.shop-filter-body.open{max-height:600px;padding:0 16px 16px}
@media(max-width:991px){
  .shop-mobile-toggle{display:none;width:100%;padding:12px;border:1px solid #E6ECF5;border-radius:14px;background:#fff;font-weight:600;font-size:.9rem;color:#132238;cursor:pointer;margin-bottom:16px;text-align:left}
}
@media(min-width:992px){
  .shop-filter-section{border-radius:16px;margin-bottom:16px}
  .shop-mobile-toggle{display:none}
}
</style>
@endsection

@section('content')
<div class="container page-hero">
    <h1 id="pageTitle">
        @if(request('category'))
            @php
                $catSlugs = is_array(request('category')) ? request('category') : [request('category')];
                $catNames = \App\Models\Category::whereIn('slug', $catSlugs)->pluck('name')->implode(', ');
            @endphp
            {{ $catNames ?: 'Products' }}
        @elseif(request('brand'))
            @php
                $brandSlugs = is_array(request('brand')) ? request('brand') : [request('brand')];
                $brandNames = \App\Models\Brand::whereIn('slug', $brandSlugs)->pluck('name')->implode(', ');
            @endphp
            {{ $brandNames ?: 'Products' }}
        @else
            All Products
        @endif
    </h1>
    <div class="crumbs">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Shop</span>
    </div>
</div>

<section class="container pb-5">
    {{-- Mobile filter toggle --}}
    <button class="shop-mobile-toggle" onclick="document.getElementById('filterSidebar').classList.toggle('open');this.textContent=this.textContent.includes('Show Filters')?'Hide Filters':'Show Filters'">
        <i class="bi bi-funnel me-2"></i> Show Filters
    </button>

    <div class="row g-4">
        {{-- Filters Sidebar --}}
        <aside class="col-lg-3" id="filterSidebar">
            {{-- Categories --}}
            <div class="shop-filter-section">
                <div class="shop-filter-header open" onclick="toggleFilter(this)">
                    <span><i class="bi bi-grid-3x3-gap-fill me-2" style="color:#1593A5"></i> Categories</span>
                    <i class="bi bi-chevron-down arrow-icon"></i>
                </div>
                <div class="shop-filter-body open">
                    <div style="max-height:300px;overflow-y:auto">
                        @foreach($categories as $cat)
                            <div style="margin-bottom:4px">
                                <label style="display:flex;align-items:center;gap:8px;padding:7px 8px;border-radius:8px;cursor:pointer;transition:all .2s;font-size:.85rem;font-weight:500;color:#1e293b">
                                    <input type="checkbox" name="cat[]" value="{{ $cat->slug }}" class="filter-cat" {{ in_array($cat->slug, (array)request('category', [])) ? 'checked' : '' }} style="accent-color:#1593A5;width:15px;height:15px">
                                    {{ $cat->name }}
                                    @if($cat->childrenRecursive->count())
                                        <span style="margin-left:auto;font-size:.65rem;color:#94a3b8;background:#F1F5F9;padding:2px 6px;border-radius:6px">{{ $cat->childrenRecursive->count() }}</span>
                                    @endif
                                </label>
                                @if($cat->childrenRecursive->count())
                                    <div style="padding-left:18px">
                                        @foreach($cat->childrenRecursive as $child)
                                            <label style="display:flex;align-items:center;gap:6px;padding:4px 8px;border-radius:6px;cursor:pointer;font-size:.8rem;color:#475569">
                                                <input type="checkbox" name="cat[]" value="{{ $child->slug }}" class="filter-cat" {{ in_array($child->slug, (array)request('category', [])) ? 'checked' : '' }} style="accent-color:#1593A5;width:13px;height:13px">
                                                {{ $child->name }}
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Brands --}}
            @if($brands->isNotEmpty())
            <div class="shop-filter-section">
                <div class="shop-filter-header open" onclick="toggleFilter(this)">
                    <span><i class="bi bi-shop me-2" style="color:#0F4C9C"></i> Brands</span>
                    <i class="bi bi-chevron-down arrow-icon"></i>
                </div>
                <div class="shop-filter-body open">
                    <div style="max-height:250px;overflow-y:auto">
                        @foreach($brands as $brand)
                            <label style="display:flex;align-items:center;gap:8px;padding:6px 8px;border-radius:8px;cursor:pointer;font-size:.85rem;font-weight:500;color:#1e293b">
                                <input type="checkbox" name="brand[]" value="{{ $brand->slug }}" class="filter-brand" {{ in_array($brand->slug, (array)request('brand', [])) ? 'checked' : '' }} style="accent-color:#0F4C9C;width:15px;height:15px">
                                {{ $brand->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Price Range --}}
            @if($priceRange)
            <div class="shop-filter-section">
                <div class="shop-filter-header open" onclick="toggleFilter(this)">
                    <span><i class="bi bi-currency-dollar me-2" style="color:#16A34A"></i> Price Range</span>
                    <i class="bi bi-chevron-down arrow-icon"></i>
                </div>
                <div class="shop-filter-body open">
                    <div style="display:flex;gap:10px;align-items:center">
                        <div style="flex:1">
                            <label style="font-size:.72rem;color:#94a3b8;font-weight:600;display:block;margin-bottom:3px">Min</label>
                            <input type="number" id="minPrice" class="form-control" placeholder="{{ number_format($priceRange->min_price, 0) }}" value="{{ request('min_price', '') }}" style="border-radius:8px;border:1px solid #E6ECF5;padding:7px 10px;font-size:.82rem">
                        </div>
                        <span style="color:#94a3b8;margin-top:14px">—</span>
                        <div style="flex:1">
                            <label style="font-size:.72rem;color:#94a3b8;font-weight:600;display:block;margin-bottom:3px">Max</label>
                            <input type="number" id="maxPrice" class="form-control" placeholder="{{ number_format($priceRange->max_price, 0) }}" value="{{ request('max_price', '') }}" style="border-radius:8px;border:1px solid #E6ECF5;padding:7px 10px;font-size:.82rem">
                        </div>
                    </div>
                    <button type="button" id="priceFilterBtn" style="width:100%;margin-top:10px;padding:9px;border:none;border-radius:10px;background:linear-gradient(135deg,#16A34A,#22c55e);color:#fff;font-weight:600;font-size:.82rem;cursor:pointer">
                        Apply Price
                    </button>
                </div>
            </div>
            @endif

            {{-- Offers --}}
            @if($offers->isNotEmpty())
            <div class="shop-filter-section">
                <div class="shop-filter-header open" onclick="toggleFilter(this)">
                    <span><i class="bi bi-tag me-2" style="color:#DC2626"></i> Offers</span>
                    <i class="bi bi-chevron-down arrow-icon"></i>
                </div>
                <div class="shop-filter-body open">
                    @foreach($offers as $offer)
                        <label style="display:flex;align-items:center;gap:8px;padding:6px 8px;border-radius:8px;cursor:pointer;font-size:.85rem;font-weight:500;color:#1e293b">
                            <input type="radio" name="offer" value="{{ $offer->id }}" class="filter-offer" {{ request('offer') == $offer->id ? 'checked' : '' }} style="accent-color:#DC2626;width:15px;height:15px">
                            {{ $offer->offer_title }}
                        </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Active Filters --}}
            @if(request('category') || request('brand') || request('min_price') || request('max_price') || request('search') || request('offer'))
            <div style="background:#F7F8FA;border:1px solid #8ED8DE;border-radius:14px;padding:14px;margin-bottom:16px">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                    <h6 style="font-weight:700;font-size:.82rem;color:#132238;margin:0">Active Filters</h6>
                    <a href="{{ route('shop') }}" style="font-size:.75rem;color:#1593A5;font-weight:600;text-decoration:none">Clear All</a>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:5px">
                    @if(request('search'))
                        <span style="display:inline-flex;align-items:center;gap:4px;background:#0F4C9C;color:#fff;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600">
                            <i class="bi bi-search" style="font-size:.65rem"></i> {{ request('search') }}
                            <button onclick="window.location.href='{{ route('shop') }}{{ request('category') ? '?'.http_build_query(request()->except('search','page')) : '' }}'" style="background:none;border:none;color:#fff;cursor:pointer;font-size:.75rem;padding:0">×</button>
                        </span>
                    @endif
                    @if(request('category'))
                        @foreach((array)request('category') as $cat)
                            <span style="display:inline-flex;align-items:center;gap:4px;background:#1593A5;color:#fff;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600">
                                {{ \App\Models\Category::where('slug', $cat)->first()->name ?? $cat }}
                                <button onclick="removeFilter('category','{{ $cat }}')" style="background:none;border:none;color:#fff;cursor:pointer;font-size:.75rem;padding:0">×</button>
                            </span>
                        @endforeach
                    @endif
                    @if(request('brand'))
                        @foreach((array)request('brand') as $br)
                            <span style="display:inline-flex;align-items:center;gap:4px;background:#0F4C9C;color:#fff;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600">
                                {{ \App\Models\Brand::where('slug', $br)->first()->name ?? $br }}
                                <button onclick="removeFilter('brand','{{ $br }}')" style="background:none;border:none;color:#fff;cursor:pointer;font-size:.75rem;padding:0">×</button>
                            </span>
                        @endforeach
                    @endif
                    @if(request('min_price') || request('max_price'))
                        <span style="display:inline-flex;align-items:center;gap:4px;background:#16A34A;color:#fff;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600">
                            ৳{{ request('min_price', '0') }} — ৳{{ request('max_price', '∞') }}
                            <button onclick="removeFilter('min_price');removeFilter('max_price')" style="background:none;border:none;color:#fff;cursor:pointer;font-size:.75rem;padding:0">×</button>
                        </span>
                    @endif
                    @if(request('offer'))
                        @php $offerTitle = \App\Models\Offer::find(request('offer'))?->offer_title ?? 'Offer'; @endphp
                        <span style="display:inline-flex;align-items:center;gap:4px;background:#DC2626;color:#fff;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600">
                            <i class="bi bi-tag" style="font-size:.65rem"></i> {{ $offerTitle }}
                            <button onclick="removeFilter('offer')" style="background:none;border:none;color:#fff;cursor:pointer;font-size:.75rem;padding:0">×</button>
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </aside>

        {{-- Products --}}
        <div class="col-lg-9">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                <div class="text-muted">
                    <b>{{ $products->total() }}</b> products found
                    @if(request('search'))
                        for "<b style="color:#132238">{{ request('search') }}</b>"
                        <a href="{{ route('shop') }}" style="font-size:.8rem;color:#1593A5;font-weight:600;text-decoration:none;margin-left:6px"><i class="bi bi-x-circle"></i> Clear</a>
                    @endif
                </div>
                <select id="sortSelect" class="form-select form-select-sm" style="width:auto;border-radius:10px;border:1px solid #E6ECF5;font-size:.85rem">
                    <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
            @if($products->count() > 0)
                <div class="row row-cols-2 row-cols-md-3 g-3 g-md-4">
                    @foreach($products as $product)
                        <div class="col">
                            @include('frontend.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
                <div class="mt-4" id="shopPagination">
                    @if($products->hasPages())
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-0">
                            {{-- Previous --}}
                            @if($products->onFirstPage())
                                <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"><i class="bi bi-chevron-left"></i></a></li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}&{{ http_build_query(request()->except('page')) }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next --}}
                            @if($products->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"><i class="bi bi-chevron-right"></i></a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                    <div class="text-center text-muted small mt-2">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results</div>
                    @endif
                </div>
            @else
                <div class="text-center p-5">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <h4 class="mt-3">No products match</h4>
                    <p class="text-muted">Try adjusting your filters.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary" style="margin-top:12px">Clear Filters</a>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
function toggleFilter(header) {
    var body = header.nextElementSibling;
    header.classList.toggle('open');
    body.classList.toggle('open');
}

function shopInit() {
    // Sort
    $('#sortSelect').off('change').on('change', function() {
        var params = new URLSearchParams(window.location.search);
        params.set('sort', $(this).val());
        shopNav(params);
    });

    // Category checkboxes
    $('.filter-cat').off('change').on('change', function() {
        var params = new URLSearchParams(window.location.search);
        params.delete('category');
        var checked = [];
        $('.filter-cat:checked').each(function() { checked.push($(this).val()); });
        if (checked.length) checked.forEach(function(c) { params.append('category', c); });
        shopNav(params);
    });

    // Brand checkboxes
    $('.filter-brand').off('change').on('change', function() {
        var params = new URLSearchParams(window.location.search);
        params.delete('brand');
        var checked = [];
        $('.filter-brand:checked').each(function() { checked.push($(this).val()); });
        if (checked.length) checked.forEach(function(b) { params.append('brand', b); });
        shopNav(params);
    });

    // Price filter
    $('#priceFilterBtn').off('click').on('click', function() {
        var params = new URLSearchParams(window.location.search);
        params.delete('min_price');
        params.delete('max_price');
        var min = $('#minPrice').val();
        var max = $('#maxPrice').val();
        if (min) params.set('min_price', min);
        if (max) params.set('max_price', max);
        shopNav(params);
    });

    // Offer filter
    $('.filter-offer').off('change').on('change', function() {
        var params = new URLSearchParams(window.location.search);
        params.delete('offer');
        if ($(this).is(':checked')) {
            params.set('offer', $(this).val());
        }
        shopNav(params);
    });

    // Pagination
    $('#shopPagination a').attr('data-spa', '');
}

function shopNav(params) {
    var url = '{{ route("shop") }}?' + params.toString();
    if (typeof window.spaNavigate === 'function') {
        window.spaNavigate(url, {push: true, scroll: true});
    } else {
        window.location.href = url;
    }
}

function removeFilter(key, val) {
    var params = new URLSearchParams(window.location.search);
    if (val) {
        var vals = params.getAll(key);
        params.delete(key);
        vals.filter(function(v) { return v !== val; }).forEach(function(v) { params.append(key, v); });
    } else {
        params.delete(key);
    }
    shopNav(params);
}

$(document).ready(shopInit);
$(document).on('spa:loaded', shopInit);
</script>
@endsection

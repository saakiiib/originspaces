@extends('frontend.master')
@section('title', 'Home')

@section('style')
<style>
.hero-slider{position:relative;border-radius:0;overflow:hidden;width:100%;background:linear-gradient(135deg,#f8f9fa,#e9ecef)}
  .hero-slider img{width:100%;height:auto;max-height:100%;object-fit:cover;display:block}
.hero-slide{position:absolute;inset:0;opacity:0;transform:scale(1.05);transition:opacity .8s ease,transform .8s ease;pointer-events:none;height:100%}
.hero-slide.active{opacity:1;transform:scale(1);pointer-events:auto;position:relative;height:100%}
.hero-slide img{width:100%;height:auto;object-fit:cover;display:block}
.hero-slide a{display:block}
.hero-arrows{position:absolute;top:50%;transform:translateY(-50%);left:0;right:0;display:flex;justify-content:space-between;padding:0 12px;z-index:5;pointer-events:none}
.hero-arrows button{pointer-events:all;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.95);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 4px 16px rgba(0,0,0,.12);font-size:1.1rem;color:#132238;transition:all .3s}
.hero-arrows button:hover{background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;transform:scale(1.1)}
.hero-dots{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px;z-index:5}
.hero-dots button{width:10px;height:10px;border-radius:999px;background:rgba(255,255,255,.4);border:none;padding:0;cursor:pointer;transition:all .3s}
.hero-dots button.active{width:28px;background:linear-gradient(135deg,#1593A5,#1F477A)}
.hero-cat-sub{position:absolute;left:calc(100% + 6px);top:0;background:#fff;border-radius:0 20px 20px 0;box-shadow:0 25px 60px rgba(0,0,0,.18);padding:20px 24px;min-width:280px;max-height:420px;overflow-y:auto;z-index:200;border:1px solid rgba(230,236,245,.8);opacity:0;visibility:hidden;transition:opacity .2s,visibility .2s;pointer-events:none}
.hero-cat-item{position:relative}
.hero-cat-item:hover>.hero-cat-sub{opacity:1;visibility:visible;pointer-events:auto}
.hero-cat-toggle{display:flex;align-items:center;gap:10px;padding:12px 18px;color:rgba(255,255,255,.85);text-decoration:none;font-size:.9rem;font-weight:500;transition:all .25s;border-left:3px solid transparent;cursor:pointer;width:100%}
.hero-cat-toggle:hover{background:rgba(255,255,255,.08);color:#fff;}
.hero-cat-toggle .chev{margin-left:auto;opacity:.4;font-size:.75rem;transition:all .3s}
.hero-cat-item:hover>.hero-cat-toggle .chev{transform:rotate(90deg);opacity:1;color:#1593A5}
.hero-cat-sub a{transition:all .2s}
.hero-cat-sub a:hover{color:#1593A5!important;background:rgba(21,147,165,.06)!important}
.hero-cats{background:linear-gradient(180deg,#0F4C9C,#132238);border-radius:22px;padding:0;box-shadow:0 20px 50px rgba(15,76,156,.4);display:flex;flex-direction:column;height:100%}
.hero-cats .hc-head{flex:0 0 auto}
.hero-cat-item{flex:1;display:flex;min-height:0}
.hero-cat-item>a,.hero-cat-item>.hero-cat-toggle{flex:1;display:flex;align-items:center;padding:0 18px}
.hero-cats .hc-head{border-radius:22px 22px 0 0}
.hero-cats>:last-child a{border-radius:0 0 22px 22px}
.hero-cats .hc-head{display:flex;align-items:center;gap:10px;padding:16px 18px;font-weight:700;font-size:.95rem;border-bottom:1px solid rgba(255,255,255,.1)}
.hero-cats .hc-head i{background:rgba(255,255,255,.12);width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem}
.hero-cats a{display:flex;align-items:center;gap:10px;padding:12px 18px;color:rgba(255,255,255,.85);text-decoration:none;font-size:.9rem;font-weight:500;transition:all .25s;border-left:3px solid transparent}
.hero-cats a:hover{background:rgba(255,255,255,.08);color:#fff;}
.hero-cats a .chev{margin-left:auto;opacity:.4;font-size:.75rem;transition:all .25s}
.hero-cats a:hover .chev{opacity:1;color:#1593A5;transform:translateX(3px)}
.hero-cats a i.cat-ic{color:#1593A5;font-size:.9rem;width:20px;text-align:center}
.hero-slider .hero-arrows{position:absolute;top:50%;transform:translateY(-50%);left:0;right:0;display:flex;justify-content:space-between;padding:0 12px;z-index:5;pointer-events:none}
.hero-slider .hero-arrows button{pointer-events:all;width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,.95);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 4px 16px rgba(0,0,0,.12);font-size:1.1rem;color:#132238;transition:all .3s}
.hero-slider .hero-arrows button:hover{background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;transform:scale(1.1)}
.hero-cat-sub::-webkit-scrollbar{width:4px}
.hero-cat-sub::-webkit-scrollbar-thumb{background:#000;border-radius:8px}
.hero-cat-sub::-webkit-scrollbar-track{background:transparent}
.hero-cats{background:linear-gradient(180deg,#0F4C9C,#132238);border-radius:22px;padding:0;box-shadow:0 20px 50px rgba(15,76,156,.4);display:flex;flex-direction:column;height:100%}
.hero-cats .hc-head{flex:0 0 auto}
.hero-cat-item{flex:1;display:flex;min-height:0}
.hero-cat-item>a,.hero-cat-item>.hero-cat-toggle{flex:1;display:flex;align-items:center;padding:0 18px}
.brand-swiper,.testimonial-swiper{overflow:hidden;padding:0 40px}
.brand-swiper .swiper-button-prev,.brand-swiper .swiper-button-next,.testimonial-swiper .swiper-button-prev,.testimonial-swiper .swiper-button-next{width:36px;height:36px;background:#fff;border:1px solid #E6ECF5;border-radius:50%;box-shadow:0 2px 8px rgba(0,0,0,.08)}
.brand-swiper .swiper-button-prev::after,.brand-swiper .swiper-button-next::after,.testimonial-swiper .swiper-button-prev::after,.testimonial-swiper .swiper-button-next::after{font-size:.85rem}
.brand-swiper .swiper-button-prev,.testimonial-swiper .swiper-button-prev{left:0}
.brand-swiper .swiper-button-next,.testimonial-swiper .swiper-button-next{right:0}
@media (max-width:991.98px){
  .hero-slider{min-height:auto!important}
  .hero-slide img{height:auto;width:100%}
  .hero-slide.active{height:auto}
  .hero-arrows{display:none!important}
}
@media (min-width:992px){
  .hero-section{height:100vh}
  .hero-slider{aspect-ratio:982/500;height:100%;max-height:100vh}
  .hero-slide{height:100%}
  .hero-slide img{height:100%;object-fit:contain}
}

/* Featured Category Icon Grid */
.featured-categories-section{padding:3.5rem 0}
.featured-cat-card{
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;
  padding:22px 12px;background:#fff;border:1px solid var(--border);border-radius:14px;
  text-decoration:none;color:#132238;font-size:.82rem;font-weight:600;
  transition:all .3s ease;text-align:center;height:100%;min-height:130px;
}
.featured-cat-card:hover{transform:translateY(-5px);border-color:var(--primary);box-shadow:0 14px 32px -10px rgba(21,147,165,.3)}
.featured-cat-icon{
  width:56px;height:56px;border-radius:14px;background:linear-gradient(160deg,#F7F8FA,#EAF4FF);
  display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:#1F477A;
}
.featured-cat-icon img{width:50px;height:50px;object-fit:contain}
.featured-cat-name{font-size:.82rem;font-weight:600;color:#2d3748;line-height:1.3;transition:color .3s ease}
.featured-cat-card:hover .featured-cat-name{color:#1593A5}
@media(max-width:576px){
  .featured-cat-card{min-height:110px;padding:16px 8px;border-radius:12px}
  .featured-cat-icon{width:46px;height:46px}
  .featured-cat-icon img{width:40px;height:40px}
  .featured-cat-name{font-size:.76rem}
}
@media(min-width:992px){
  .featured-cat-card{min-height:140px}
}
/* Flush footer right after brands (homepage only) */
.site-footer{margin-top:0!important}

/* Offer countdown section (light) */
.offer-countdown-section{background:linear-gradient(180deg,#EFF9FA 0%,#E1F0F2 100%);border-top:2px solid rgba(21,147,165,.6);border-bottom:2px solid rgba(21,147,165,.6)}
.offer-timer{display:flex;gap:8px;flex-wrap:wrap}
.offer-time-box{min-width:64px;text-align:center;background:linear-gradient(135deg,#1593A5,#1F477A);border-radius:12px;padding:8px 6px;box-shadow:0 8px 20px -8px rgba(21,147,165,.5)}
.offer-time-box b{display:block;font-size:1.25rem;font-weight:800;color:#fff;line-height:1;font-variant-numeric:tabular-nums}
.offer-time-box span{font-size:.65rem;font-weight:600;color:rgba(255,255,255,.85);text-transform:uppercase;letter-spacing:.05em}
@media(max-width:576px){
  .offer-time-box{min-width:58px;padding:7px 5px}
  .offer-time-box b{font-size:1.1rem}
}
.offer-info-card{background:#fff;border:1px solid rgba(21,147,165,.35);border-radius:18px;overflow:hidden;box-shadow:0 18px 40px -20px rgba(21,147,165,.35);display:flex;flex-direction:column;height:100%}
.offer-info-img{width:100%;height:220px;object-fit:cover;display:block;background:linear-gradient(160deg,#F7F8FA,#EAF4FF)}
.offer-info-body{padding:20px}
.offer-product-swiper{overflow:hidden}
.offer-nav-btn{width:44px;height:44px;border-radius:50%;background:#fff;border:1px solid #E6ECF5;box-shadow:0 4px 16px rgba(0,0,0,.10);color:#132238;display:inline-flex;align-items:center;justify-content:center;font-size:1.1rem;cursor:pointer;transition:all .3s;padding:0}
.offer-nav-btn:hover{background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;border-color:transparent}
.offer-nav-btn.swiper-button-disabled{opacity:.35;pointer-events:none}
@media(max-width:576px){
  .offer-info-img{height:170px}
  .offer-info-body{padding:16px}
  .offer-nav-btn{width:40px;height:40px;font-size:1rem}
}
</style>
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="hero-section position-relative">
  <div class="hero-slider" id="heroSlider" data-aos="fade-up">
      @if($sliders->isNotEmpty())
        @foreach($sliders as $i => $slide)
          <div class="hero-slide {{ $i === 0 ? 'active' : '' }}">
            <a @spa href="{{ $slide->btn_url ?? route('shop') }}">
              <img src="{{ asset(ltrim($slide->image, '/')) }}" alt="{{ $slide->title }}">
            </a>
          </div>
        @endforeach
      @else
        <div class="hero-slide active">
          <a @spa href="{{ route('shop') }}">
            <img src="{{ asset('placeholder.webp') }}" alt="Shop Now">
          </a>
        </div>
      @endif

      @if($sliders->count() > 1)
        <div class="hero-arrows">
          <button class="prev"><i class="bi bi-chevron-left"></i></button>
          <button class="next"><i class="bi bi-chevron-right"></i></button>
        </div>
        <div class="hero-dots">
          @foreach($sliders as $i => $slide)
            <button class="{{ $i === 0 ? 'active' : '' }}"></button>
          @endforeach
        </div>
      @endif
    </div>
</section>

{{-- NEW ARRIVALS --}}
@if($newArrivalProducts->isNotEmpty())
<section class="section" style="background:#E8EEF4">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4" data-aos="fade-up">
      <div>
        <div class="eyebrow">Just Arrived</div>
        <h2 class="section-title mt-2">New Arrivals</h2>
      </div>
      <a @spa href="{{ route('shop') }}" class="btn btn-outline-brand btn-sm">View All <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach($newArrivalProducts as $product)
        <div class="col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
          @include('frontend.partials.product-card', ['product' => $product])
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- OFFER COUNTDOWN (image + product slider) --}}
@if(isset($activeOffers) && $activeOffers->isNotEmpty())
@foreach($activeOffers as $offer)
@php
  $offerProducts = $offer->offerItems->pluck('product')->filter()->values()->take(12);
  $offerEnd = $offer->end_date->copy()->endOfDay()->format('Y-m-d H:i:s');
@endphp
@if($offerProducts->isNotEmpty())
<section class="section offer-countdown-section">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-4" data-aos="fade-up">
        <div class="offer-info-card h-100">
          <img src="{{ $offer->image ? asset(ltrim($offer->image, '/')) : asset('placeholder.webp') }}" alt="{{ $offer->offer_title }}" class="offer-info-img">
          <div class="offer-info-body">
            <div class="eyebrow" style="color:#DC2626"><i class="bi bi-lightning-charge-fill me-1"></i>Limited Time Offer</div>
            <h2 class="section-title mt-2" style="color:#17202A;font-size:1.35rem">{{ $offer->offer_title }}</h2>
            @if($offer->description)
            <p class="mb-0 text-muted" style="font-size:.85rem">{{ \Illuminate\Support\Str::limit($offer->description, 110) }}</p>
            @endif
            <div class="text-muted mt-2" style="font-size:.75rem">Ends {{ $offer->end_date->format('d M, Y') }}</div>
            <div class="offer-timer offer-countdown mt-3" data-end="{{ $offerEnd }}">
              <div class="offer-time-box"><b data-d>00</b><span>Days</span></div>
              <div class="offer-time-box"><b data-h>00</b><span>Hours</span></div>
              <div class="offer-time-box"><b data-m>00</b><span>Mins</span></div>
              <div class="offer-time-box"><b data-s>00</b><span>Secs</span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
        <div class="offer-swiper-wrap position-relative h-100">
          @if($offerProducts->count() > 3)
          <div class="d-flex justify-content-end gap-2 mb-3">
            <button type="button" class="offer-nav-btn offer-prev" aria-label="Previous products"><i class="bi bi-chevron-left"></i></button>
            <button type="button" class="offer-nav-btn offer-next" aria-label="Next products"><i class="bi bi-chevron-right"></i></button>
          </div>
          @endif
          <div class="swiper offer-product-swiper">
            <div class="swiper-wrapper">
              @foreach($offerProducts as $product)
              <div class="swiper-slide h-auto">
                @include('frontend.partials.product-card', ['product' => $product])
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@endforeach
@endif
{{-- FEATURED CATEGORIES (Icon Grid) --}}
@if($categories->isNotEmpty())
<section class="section featured-categories-section" style="background:#E8EEF4">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="eyebrow" style="color:var(--primary)">Categories</div>
      <h2 class="section-title mt-2" style="color:#17202A">Get Your Desired Product from Featured Category!</h2>
    </div>
    <div class="row g-3 g-md-4 justify-content-center">
      @foreach($categories as $cat)
      <div class="col-6 col-md-4 col-lg-3 col-xl-2" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 8) * 60 }}">
        <a @spa href="{{ route('shop', ['category' => $cat->slug]) }}" class="featured-cat-card">
          <div class="featured-cat-icon">
            @if($cat->image)
              <img src="{{ asset(ltrim($cat->image, '/')) }}" alt="{{ $cat->name }}">
            @else
              <i class="bi bi-grid-3x3-gap-fill"></i>
            @endif
          </div>
          <div class="featured-cat-name">{{ $cat->name }}</div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- MOST SELLING PRODUCTS --}}
@if($bestSellingProducts->isNotEmpty())
<section class="section" style="background:#fff">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4" data-aos="fade-up">
      <div>
        <div class="eyebrow">Best Sellers</div>
        <h2 class="section-title mt-2">Most Selling <span class="grad-text">Products</span></h2>
      </div>
      <a @spa href="{{ route('shop') }}" class="btn btn-outline-brand btn-sm">View All <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach($bestSellingProducts as $product)
        <div class="col" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
          @include('frontend.partials.product-card', ['product' => $product])
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- WHY US --}}
<section class="section" style="background:#E8EEF4">
  <div class="container">
    <div class="text-center mb-4" data-aos="fade-up">
      <div class="eyebrow">Our Promise</div>
      <h2 class="section-title mt-2">Why Choose Us</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
      <div class="col" data-aos="fade-up" data-aos-delay="100"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#1593A5,#1F477A);font-size:1.4rem"><i class="bi bi-shield-check"></i></div><div class="fw-semibold small">Official Warranty</div></div></div>
      <div class="col" data-aos="fade-up" data-aos-delay="200"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#0F4C9C,#2563EB);font-size:1.4rem"><i class="bi bi-patch-check"></i></div><div class="fw-semibold small">Trusted Dealer</div></div></div>
      <div class="col" data-aos="fade-up" data-aos-delay="300"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#1593A5,#1F477A);font-size:1.4rem"><i class="bi bi-truck"></i></div><div class="fw-semibold small">Fast Delivery</div></div></div>
      <div class="col" data-aos="fade-up" data-aos-delay="400"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#0F4C9C,#2563EB);font-size:1.4rem"><i class="bi bi-arrow-return-left"></i></div><div class="fw-semibold small">Easy Return</div></div></div>
      <div class="col" data-aos="fade-up" data-aos-delay="500"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#1593A5,#1F477A);font-size:1.4rem"><i class="bi bi-credit-card"></i></div><div class="fw-semibold small">EMI Facility</div></div></div>
      <div class="col" data-aos="fade-up" data-aos-delay="600"><div class="card-premium p-4 text-center h-100"><div class="mx-auto mb-3 d-flex align-items-center justify-content-center text-white rounded-3" style="width:56px;height:56px;background:linear-gradient(135deg,#0F4C9C,#2563EB);font-size:1.4rem"><i class="bi bi-headset"></i></div><div class="fw-semibold small">24/7 Support</div></div></div>
    </div>
  </div>
</section>

{{-- TESTIMONIALS --}}
@if($testimonials->isNotEmpty())
<section class="section">
  <div class="container text-center mb-4" data-aos="fade-up">
    <div class="eyebrow">Testimonials</div>
    <h2 class="section-title mt-2">What Our <span class="grad-text">Customers Say</span></h2>
  </div>
  <div class="container position-relative" data-aos="fade-up">
    <div class="swiper testimonial-swiper">
      <div class="swiper-wrapper">
        @foreach($testimonials as $testimonial)
        <div class="swiper-slide h-auto">
          <div class="card-premium p-4 h-100">
            <div class="text-warning small mb-3">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="text-muted small">{{ $testimonial->review }}</p>
            <div class="d-flex align-items-center gap-3 mt-4">
              <img src="{{ $testimonial->image ? asset($testimonial->image) : asset('placeholder.webp') }}" alt="" width="42" height="42" class="rounded-circle" style="object-fit:cover">
              <div>
                <div class="fw-semibold small">{{ $testimonial->name }}</div>
                @if($testimonial->designation)
                <div class="text-muted" style="font-size:.75rem">{{ $testimonial->designation }}</div>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-button-prev testimonial-prev" style="color:#132238"></div>
      <div class="swiper-button-next testimonial-next" style="color:#132238"></div>
    </div>
  </div>
</section>
@endif

{{-- BRANDS --}}
@if($brands->isNotEmpty())
<section class="section-sm border-top border-bottom overflow-hidden" style="background:#E8EEF4;padding-bottom:2.5rem">
  <div class="container text-center mb-4" data-aos="fade-up">
    <div class="eyebrow">Trusted Partners</div>
    <h3 class="fw-bold mt-2">Shop by Brand</h3>
  </div>
  <div class="container position-relative" data-aos="fade-up">
    <div class="swiper brand-swiper">
      <div class="swiper-wrapper">
        @foreach($brands as $brand)
          <div class="swiper-slide">
            <a @spa href="{{ route('shop', ['brand' => $brand->slug]) }}" class="text-decoration-none">
              <div class="brand-logo-card">
                @if($brand->image)
                  <img src="{{ asset(ltrim($brand->image, '/')) }}" alt="{{ $brand->name }}" style="max-height:60px;max-width:120px;object-fit:contain;margin-bottom:8px">
                @else
                  <div style="font-size:1.4rem;font-weight:800;color:#132238;letter-spacing:.05em;margin-bottom:8px">{{ strtoupper($brand->name) }}</div>
                @endif
              </div>
            </a>
          </div>
        @endforeach
      </div>
      <div class="swiper-button-prev brand-prev" style="color:#132238"></div>
      <div class="swiper-button-next brand-next" style="color:#132238"></div>
    </div>
  </div>
  <div class="text-center mt-4"><a @spa href="{{ route('shop') }}" class="btn btn-outline-brand btn-sm">Explore all brands</a></div>
</section>
@endif

@endsection

@section('script')
<script>
function initHeroSlider() {
  var slider = document.getElementById('heroSlider');
  if (!slider) return;
  // Clear any existing timer
  if (slider._timer) clearInterval(slider._timer);

  var slides = slider.querySelectorAll('.hero-slide');
  var dots = slider.querySelectorAll('.hero-dots button');
  var idx = 0;

  if (slides.length < 1) return;

  function go(n) {
    if (!slides[idx]) return;
    slides[idx].classList.remove('active');
    if (dots[idx]) dots[idx].classList.remove('active');
    idx = (n + slides.length) % slides.length;
    slides[idx].classList.add('active');
    if (dots[idx]) dots[idx].classList.add('active');
  }

  slider.querySelector('.prev')?.addEventListener('click', function() { go(idx - 1); });
  slider.querySelector('.next')?.addEventListener('click', function() { go(idx + 1); });
  dots.forEach(function(d, i) { d.addEventListener('click', function() { go(i); }); });

  if (slides.length > 1) {
    slider._timer = setInterval(function() { go(idx + 1); }, 4000);
  }
}

// Init on DOM ready AND on SPA navigation
document.addEventListener('DOMContentLoaded', initHeroSlider);
document.addEventListener('spa:loaded', initHeroSlider);

function initBrandSlider() {
  var el = document.querySelector('.brand-swiper');
  if (!el) return;
  if (el._swiper) { el._swiper.destroy(true, true); }
  el._swiper = new Swiper(el, {
    slidesPerView: 2,
    spaceBetween: 16,
    loop: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
    navigation: { nextEl: '.brand-next', prevEl: '.brand-prev' },
    breakpoints: {
      576: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      992: { slidesPerView: 6 }
    }
  });
}
document.addEventListener('DOMContentLoaded', initBrandSlider);
document.addEventListener('spa:loaded', initBrandSlider);

function initTestimonialSlider() {
  var el = document.querySelector('.testimonial-swiper');
  if (!el) return;
  if (el._swiper) { el._swiper.destroy(true, true); }
  el._swiper = new Swiper(el, {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: { delay: 3000, disableOnInteraction: false },
    navigation: { nextEl: '.testimonial-next', prevEl: '.testimonial-prev' },
    breakpoints: {
      576: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    }
  });
}
document.addEventListener('DOMContentLoaded', initTestimonialSlider);
document.addEventListener('spa:loaded', initTestimonialSlider);

// Search
function doSearch() {
  var q = document.getElementById('searchInput')?.value.trim();
  if (!q) return;
  window.location.href = '{{ route("shop") }}?search=' + encodeURIComponent(q);
}

// Offer countdown (second-wise, SPA-safe, supports multiple offers)
function initOfferCountdowns() {
  if (window._offerTimer) { clearInterval(window._offerTimer); window._offerTimer = null; }
  var timers = document.querySelectorAll('.offer-countdown');
  if (!timers.length) return;
  function pad(n) { return String(n).padStart(2, '0'); }
  function tick() {
    var now = new Date().getTime();
    timers.forEach(function(box) {
      var end = new Date(box.dataset.end.replace(/-/g, '/')).getTime();
      var diff = Math.max(0, Math.floor((end - now) / 1000));
      var d = Math.floor(diff / 86400);
      var h = Math.floor(diff % 86400 / 3600);
      var m = Math.floor(diff % 3600 / 60);
      var s = diff % 60;
      var dEl = box.querySelector('[data-d]');
      var hEl = box.querySelector('[data-h]');
      var mEl = box.querySelector('[data-m]');
      var sEl = box.querySelector('[data-s]');
      if (dEl) dEl.textContent = pad(d);
      if (hEl) hEl.textContent = pad(h);
      if (mEl) mEl.textContent = pad(m);
      if (sEl) sEl.textContent = pad(s);
    });
  }
  tick();
  window._offerTimer = setInterval(tick, 1000);
}
document.addEventListener('DOMContentLoaded', initOfferCountdowns);
document.addEventListener('spa:loaded', initOfferCountdowns);

function initOfferProductSliders() {
  document.querySelectorAll('.offer-swiper-wrap').forEach(function(wrap) {
    var el = wrap.querySelector('.offer-product-swiper');
    if (!el || typeof Swiper === 'undefined') return;
    if (el._swiper) { el._swiper.destroy(true, true); }
    var count = el.querySelectorAll('.swiper-slide').length;
    var next = wrap.querySelector('.offer-next');
    var prev = wrap.querySelector('.offer-prev');
    var opts = {
      slidesPerView: 2,
      spaceBetween: 12,
      loop: count > 3,
      breakpoints: { 768: { slidesPerView: 3, spaceBetween: 16 } }
    };
    if (next && prev) opts.navigation = { nextEl: next, prevEl: prev };
    el._swiper = new Swiper(el, opts);
  });
}
document.addEventListener('DOMContentLoaded', initOfferProductSliders);
document.addEventListener('spa:loaded', initOfferProductSliders);
</script>
@endsection

@extends('frontend.master')
@section('title', 'About Us')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">About Us</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Our Story</span>
        <h1 class="mt-2" style="font-weight:800;color:#132238">About {{ $company->company_name ?? config('app.name') }}</h1>
    </div>
</div>

{{-- About Intro --}}
<section class="container pb-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            @if($company->company_logo)
                <img src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="{{ $company->company_name }}" class="img-fluid" style="border-radius:var(--radius-lg);box-shadow:var(--shadow-glow)">
            @endif
        </div>
        <div class="col-lg-6">
            @if($company->about_us)
                <div style="color:#334155;line-height:1.8">{!! $company->about_us !!}</div>
            @else
                <span class="eyebrow">Who We Are</span>
                <h2 class="mt-2 mb-3" style="font-weight:800;color:#132238">Your Trusted Electronics Partner</h2>
                <p style="font-size:1.05rem;color:#334155;line-height:1.8">Welcome to {{ $company->company_name ?? config('app.name') }}. We are Habiganj's #1 Walton authorized electronics showroom, committed to bringing genuine products with manufacturer warranty right to your doorstep.</p>
                <p style="color:#6B7A94;line-height:1.8">Since our founding, we've served thousands of happy customers with top-quality electronics, transparent pricing, and dedicated after-sales support. Our mission is to make quality electronics accessible to everyone in the region.</p>
            @endif
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="pb-5" style="background:linear-gradient(180deg,rgba(248,250,252,.6),rgba(255,255,255,.4))">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card-premium" style="padding:2rem;height:100%">
                    <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,rgba(21,147,165,.12),rgba(31,71,122,.06));display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                        <i class="bi bi-crosshair" style="font-size:1.4rem;color:#1593A5"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color:#132238">Our Mission</h4>
                    <p style="color:#334155;line-height:1.8">To provide genuine, high-quality electronics at fair prices with exceptional customer service. We aim to be the most trusted electronics destination in Bangladesh, ensuring every customer gets the best value, expert guidance, and reliable after-sales support.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-premium" style="padding:2rem;height:100%">
                    <div style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,rgba(15,76,156,.12),rgba(37,99,235,.06));display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                        <i class="bi bi-eye" style="font-size:1.4rem;color:#0F4C9C"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color:#132238">Our Vision</h4>
                    <p style="color:#334155;line-height:1.8">To become Bangladesh's leading electronics retail chain, recognized for innovation, trust, and customer satisfaction. We envision a future where every household has access to modern technology through our expanding network of showrooms and online presence.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Key Numbers --}}
<section class="container pb-5">
    <div class="sec-head text-center" style="justify-content:center">
        <div>
            <span class="eyebrow">Our Impact</span>
            <h2 class="section-title" style="color:#132238">Numbers That Speak</h2>
        </div>
    </div>
    <div class="row g-3 text-center">
        <div class="col-6 col-md-3">
            <div class="card-premium" style="padding:1.8rem 1rem">
                <h2 class="fw-bold mb-1" style="color:#1593A5;font-size:2rem">5,000+</h2>
                <small style="color:#6B7A94;font-size:.85rem">Happy Customers</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-premium" style="padding:1.8rem 1rem">
                <h2 class="fw-bold mb-1" style="color:#0F4C9C;font-size:2rem">500+</h2>
                <small style="color:#6B7A94;font-size:.85rem">Products Available</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-premium" style="padding:1.8rem 1rem">
                <h2 class="fw-bold mb-1" style="color:#16A34A;font-size:2rem">100%</h2>
                <small style="color:#6B7A94;font-size:.85rem">Genuine Products</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card-premium" style="padding:1.8rem 1rem">
                <h2 class="fw-bold mb-1" style="color:#1593A5;font-size:2rem">24/7</h2>
                <small style="color:#6B7A94;font-size:.85rem">Customer Support</small>
            </div>
        </div>
    </div>
</section>

{{-- Our Values --}}
<section class="container pb-5">
    <div class="sec-head">
        <div>
            <span class="eyebrow">Why Choose Us</span>
            <h2 class="section-title" style="color:#132238">Our Values</h2>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-shield-check"></i></div>
                <h6 class="mb-1">Quality Assurance</h6>
                <small>Genuine products with manufacturer warranty</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-truck"></i></div>
                <h6 class="mb-1">Fast Delivery</h6>
                <small>Free delivery across Habiganj district</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-headset"></i></div>
                <h6 class="mb-1">24/7 Support</h6>
                <small>Always here to help you</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-cash-stack"></i></div>
                <h6 class="mb-1">Best Prices</h6>
                <small>Competitive pricing on all products</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-arrow-return-left"></i></div>
                <h6 class="mb-1">Easy Returns</h6>
                <small>Hassle-free 7-day return policy</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="value-card">
                <div class="ic"><i class="bi bi-credit-card"></i></div>
                <h6 class="mb-1">0% EMI</h6>
                <small>Easy installment plans available</small>
            </div>
        </div>
    </div>
</section>

{{-- Why Shop With Us --}}
<section class="pb-5" style="background:linear-gradient(180deg,rgba(248,250,252,.6),rgba(255,255,255,.4))">
    <div class="container">
        <div class="sec-head text-center" style="justify-content:center">
            <div>
                <span class="eyebrow">Our Promise</span>
                <h2 class="section-title" style="color:#132238">Why Shop With Us?</h2>
            </div>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="d-flex gap-3 mb-4">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(21,147,165,.12),rgba(31,71,122,.06));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-patch-check-fill" style="color:#1593A5;font-size:1.2rem"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#132238">Walton Authorized Dealer</h6>
                        <p style="color:#6B7A94;font-size:.9rem;margin:0;line-height:1.6">We are an officially authorized dealer for Walton products, ensuring you receive genuine items with full manufacturer warranty coverage.</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(22,163,74,.12),rgba(22,163,74,.06));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-geo-alt-fill" style="color:#16A34A;font-size:1.2rem"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#132238">Local Showroom, Personal Touch</h6>
                        <p style="color:#6B7A94;font-size:.9rem;margin:0;line-height:1.6">Visit our showroom to experience products hands-on. Our expert staff helps you choose the right electronics for your needs and budget.</p>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(15,76,156,.12),rgba(37,99,235,.06));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-headset" style="color:#0F4C9C;font-size:1.2rem"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#132238">After-Sales Support</h6>
                        <p style="color:#6B7A94;font-size:.9rem;margin:0;line-height:1.6">Our relationship doesn't end at the sale. We provide dedicated after-sales service, warranty claims, and technical support whenever you need it.</p>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,rgba(220,38,38,.08),rgba(220,38,38,.04));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-heart-fill" style="color:#DC2626;font-size:1.2rem"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color:#132238">Customer First</h6>
                        <p style="color:#6B7A94;font-size:.9rem;margin:0;line-height:1.6">Every decision we make is driven by what's best for our customers. From product selection to delivery, your satisfaction is our top priority.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-premium text-center" style="padding:2.5rem;background:linear-gradient(135deg,#F7F8FA,#F7F8FA);border-color:rgba(21,147,165,.15)">
                    <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#1593A5,#1F477A);display:inline-flex;align-items:center;justify-content:center;margin-bottom:20px;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
                        <i class="bi bi-award-fill" style="font-size:2rem;color:#fff"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color:#132238">Trusted Since Day One</h4>
                    <p style="color:#6B7A94;line-height:1.7;margin-bottom:1.5rem">We believe in building long-term relationships with our customers through honesty, quality, and exceptional service.</p>
                    <a @spa href="{{ route('contact') }}" class="btn btn-primary" style="border-radius:14px;padding:.65rem 1.8rem;font-weight:700;font-size:.9rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
                        <i class="bi bi-chat-dots me-1"></i> Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if($company->google_map)
<section class="pb-5" style="background:linear-gradient(180deg,rgba(248,250,252,.6),rgba(255,255,255,.4))">
    <div class="container">
        <div class="contact-card" style="padding:0;overflow:hidden;border-radius:16px">
            <div style="width:100%;height:400px">{!! $company->google_map !!}</div>
        </div>
    </div>
</section>
@endif

@endsection

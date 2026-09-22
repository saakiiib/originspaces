@extends('frontend.master')
@section('title', 'Terms of Service')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Terms of Service</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Legal</span>
        <h1 class="mt-2" style="font-weight:800;color:#132238">Terms of Service</h1>
        <p style="color:#6B7A94">Last updated: {{ date('F d, Y') }}</p>
    </div>
</div>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-card">
                @if($company && $company->terms_and_conditions)
                    <div style="color:#334155;line-height:1.8">{!! $company->terms_and_conditions !!}</div>
                @else
<h5 class="fw-bold mb-3" style="color:#132238">1. Acceptance of Terms</h5>
                    <p style="color:#334155;line-height:1.7">By accessing and using {{ config('app.name') }}, you agree to be bound by these Terms of Service. If you do not agree, please do not use our services.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">2. Account Registration</h5>
                    <p style="color:#334155;line-height:1.7">You may be required to provide accurate and complete information when creating an account. You are responsible for maintaining the confidentiality of your account credentials.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">3. Products and Pricing</h5>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>All product images are for illustration purposes only</li>
                        <li>Prices are subject to change without prior notice</li>
                        <li>We reserve the right to limit order quantities</li>
                        <li>Product availability is subject to stock</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">4. Orders and Payments</h5>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>An order is confirmed only after phone verification</li>
                        <li>We reserve the right to cancel orders due to stock unavailability or pricing errors</li>
                        <li>Payment is collected Cash on Delivery at the time of delivery</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">5. Delivery</h5>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>Delivery timelines are estimates and not guaranteed</li>
                        <li>Risk of loss transfers to you upon delivery</li>
                        <li>Please inspect products at the time of delivery</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">6. Returns and Refunds</h5>
                    <p style="color:#334155;line-height:1.7">Returns are subject to our Return Policy. Please refer to our <a @spa href="{{ route('returns') }}" style="color:#0F4C9C;font-weight:600;text-decoration:none">Return Policy</a></p>

<h5 class="fw-bold mb-3 mt-4" style="color:#132238">7. Intellectual Property</h5>
                    <p style="color:#334155;line-height:1.7">All content on this website, including text, graphics, logos, and images, is the property of {{ config('app.name') }} and is protected by copyright laws.</p>

<h5 class="fw-bold mb-3 mt-4" style="color:#132238">8. Limitation of Liability</h5>
                    <p style="color:#334155;line-height:1.7">{{ config('app.name') }} shall not be liable for any indirect, incidental, or consequential damages arising from the use of our products or services.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">9. Governing Law</h5>
                    <p style="color:#334155;line-height:1.7">These terms are governed by the laws of Bangladesh. Any disputes shall be resolved in the courts of Dhaka, Bangladesh.</p>

<h5 class="fw-bold mb-3 mt-4" style="color:#132238">10. Contact</h5>
                    <p style="color:#334155;line-height:1.7">For questions about these Terms of Service, contact us at {{ $company->email1 ?? config('app.name') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

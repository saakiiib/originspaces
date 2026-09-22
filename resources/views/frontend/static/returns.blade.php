@extends('frontend.master')
@section('title', 'Return Policy')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Return Policy</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Hassle-Free Returns</span>
        <h1 class="mt-2">Return & Refund Policy</h1>
    </div>
</div>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-card">
                <h5 class="fw-bold mb-3">Return Eligibility</h5>
                <p>{!! 'You can return a product if it meets the following conditions:' !!}</p>
                <ul>
                    <li>The product must be returned within 7 days of delivery</li>
                    <li>The product must be unused and in its original condition</li>
                    <li>Original tags and packaging must be intact</li>
                    <li>Proof of purchase or receipt must be provided</li>
                </ul>

                <h5 class="fw-bold mb-3 mt-4">Non-Returnable Items</h5>
                <ul>
                    <li>Used or damaged products</li>
                    <li>Discounted or clearance items</li>
                    <li>Personal care or hygiene-related products</li>
                    <li>Customized or personalized products</li>
                </ul>

                <h5 class="fw-bold mb-3 mt-4">How to Initiate a Return</h5>
                <ol>
                    <li>Log in to your account and go to order history</li>
                    <li>Select the product you want to return</li>
                    <li>Specify the reason for the return</li>
                    <li>Submit the return request</li>
                    <li>Pack the product and ship it according to our instructions</li>
                </ol>

                <h5 class="fw-bold mb-3 mt-4">Refund Process</h5>
                <p>Your refund process will begin after the product is received and verified.</p>
                <ul>
                    <li>{!! 'The product will go through a quality check before the refund is issued.' !!}</li>
                    <li>{!! 'Refund processing:' !!}</li>
                    <li>{!! 'Refund method:' !!}</li>
                </ul>

                <h5 class="fw-bold mb-3 mt-4">Exchange Policy</h5>
                <p>If you'd like to exchange an item for a different size, color, or model, contact us within 7 days. Subject to availability.</p>

                <div class="p-3 rounded mt-4" style="background:var(--brand-soft);">
                    <h6 class="fw-bold mb-1">Need Help?</h6>
                    <p class="mb-0">Contact our support team for any return or refund queries. We're here to help!</p>
                    <a @spa href="{{ route('contact') }}" class="btn btn-primary btn-sm mt-2">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('frontend.master')
@section('title', 'Shipping Policy')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Shipping Policy</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Delivery Information</span>
        <h1 class="mt-2">Shipping Policy</h1>
    </div>
</div>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-card">
                <h5 class="fw-bold mb-3">Delivery Coverage</h5>
                    <p>We deliver across all 64 districts of Bangladesh. Our delivery partners cover both urban and rural areas.</p>

                    <h5 class="fw-bold mb-3 mt-4">Delivery Timeline</h5>
                    <ul>
                        <li>{!! 'Inside Dhaka: 1-2 business days' !!}</li>
                        <li>{!! 'Outside Dhaka: 3-5 business days' !!}</li>
                        <li>{!! 'Remote areas: 5-7 business days' !!}</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4">Delivery Charges</h5>
                    <ul>
                        <li>{!! 'Inside Dhaka: BDT 60' !!}</li>
                        <li>{!! 'Outside Dhaka: BDT 120' !!}</li>
                        <li>{!! 'Free delivery on orders above a certain amount' !!}</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4">Order Processing</h5>
                    <p>Orders placed before 6:00 PM are processed the same day. Orders placed after 6:00 PM or on holidays will be processed the next business day.</p>

                    <h5 class="fw-bold mb-3 mt-4">Order Confirmation</h5>
                    <p>You will receive a confirmation call within 24 hours of placing your order. Please ensure your phone number is correct and accessible.</p>
            </div>
        </div>
    </div>
</section>
@endsection

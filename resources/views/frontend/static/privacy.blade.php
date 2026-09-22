@extends('frontend.master')
@section('title', 'Privacy Policy')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Privacy Policy</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Legal</span>
        <h1 class="mt-2" style="font-weight:800;color:#132238">Privacy Policy</h1>
        <p style="color:#6B7A94">Last updated: {{ date('F d, Y') }}</p>
    </div>
</div>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-card">
                @if($company && $company->privacy_policy)
                    <div style="color:#334155;line-height:1.8">{!! $company->privacy_policy !!}</div>
                @else
                    <h5 class="fw-bold mb-3" style="color:#132238">1. Information We Collect</h5>
                    <p style="color:#334155;line-height:1.7">We are committed to protecting your personal information. This privacy policy explains how we collect, use, and safeguard your data.</p>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>Name, phone number, and delivery address</li>
                        <li>Email address (if provided)</li>
                        <li>Order history and preferences</li>
                        <li>Communications with our support team</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">2. How We Use Your Information</h5>
                    <p style="color:#334155;line-height:1.7">We may collect various types of information from you, including personal information you voluntarily share with us.</p>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>Process and deliver your orders</li>
                        <li>Send order confirmations and delivery updates</li>
                        <li>Improve our products and services</li>
                        <li>Communicate with you about promotions and offers</li>
                        <li>Provide customer support</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">3. Information Sharing</h5>
                    <p style="color:#334155;line-height:1.7">We use the collected information for various purposes, such as processing your orders, providing customer service, and improving our services.</p>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>Delivery partners (only name, phone, and address for order fulfillment)</li>
                        <li>Payment processors (for transaction processing)</li>
                        <li>Legal authorities (when required by law)</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">4. Data Security</h5>
                    <p style="color:#334155;line-height:1.7">We implement appropriate security measures to protect your personal information. However, no method of transmission over the internet is 100% secure.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">5. Your Rights</h5>
                    <p style="color:#334155;line-height:1.7">We take appropriate security measures to protect your personal information.</p>
                    <ul style="color:#334155;line-height:1.8;padding-left:1.2rem">
                        <li>Access your personal information</li>
                        <li>Correct inaccurate information</li>
                        <li>Request deletion of your information</li>
                        <li>Opt out of marketing communications</li>
                    </ul>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">6. Cookies</h5>
                    <p style="color:#334155;line-height:1.7">We use cookies to improve your browsing experience and analyze website traffic. You can control cookie settings through your browser preferences.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">7. Changes to This Policy</h5>
                    <p style="color:#334155;line-height:1.7">We may update this privacy policy from time to time. Changes will be posted on this page with an updated revision date.</p>

                    <h5 class="fw-bold mb-3 mt-4" style="color:#132238">8. Contact Us</h5>
                    <p style="color:#334155;line-height:1.7">If you have any questions about this privacy policy, please contact us at {{ $company->email1 ?? config('app.name') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

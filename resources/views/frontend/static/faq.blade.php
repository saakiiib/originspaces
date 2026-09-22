@extends('frontend.master')
@section('title', 'Frequently Asked Questions')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">FAQ</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Help Center</span>
        <h1 class="mt-2" style="font-weight:800;color:#132238">Frequently Asked Questions</h1>
        <p class="mx-auto" style="max-width:620px;color:#6B7A94">Find answers to the most common questions about shopping, delivery, payments, and returns.</p>
    </div>
</div>

<section class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Ordering -->
            <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-bag me-2" style="color:#1593A5"></i>Ordering</h5>
            <div class="accordion faq-accordion mb-4" id="faqOrdering">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ordering1">
                            How do I place an order?
                        </button>
                    </h2>
                    <div id="ordering1" class="accordion-collapse collapse" data-bs-parent="#faqOrdering">
                        <div class="accordion-body">
                            Browse our products, add items to your cart, and proceed to checkout. Fill in your delivery details and select Cash on Delivery as your payment method. Click "Place Order" and we'll contact you to confirm.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ordering2">
                            Can I modify my order after placing it?
                        </button>
                    </h2>
                    <div id="ordering2" class="accordion-collapse collapse" data-bs-parent="#faqOrdering">
                        <div class="accordion-body">
                            Please contact us immediately if you need to modify your order. Changes can only be made before the order is dispatched.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ordering3">
                            Do I need an account to order?
                        </button>
                    </h2>
                    <div id="ordering3" class="accordion-collapse collapse" data-bs-parent="#faqOrdering">
                        <div class="accordion-body">
                            No, you can place orders as a guest. However, creating an account allows you to track orders and save your details for faster checkout.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery -->
            <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-truck me-2" style="color:#1593A5"></i>Delivery</h5>
            <div class="accordion faq-accordion mb-4" id="faqDelivery">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#delivery1">
                            How long does delivery take?
                        </button>
                    </h2>
                    <div id="delivery1" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                        <div class="accordion-body">
                            Standard delivery within Dhaka takes 1-2 business days. Outside Dhaka, delivery takes 3-5 business days. You'll receive a confirmation call before dispatch.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#delivery2">
                            What are the delivery charges?
                        </button>
                    </h2>
                    <div id="delivery2" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                        <div class="accordion-body">
                            Delivery inside Dhaka is ৳60. Delivery outside Dhaka is ৳120. Free delivery on orders over ৳2,000.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#delivery3">
                            Can I track my order?
                        </button>
                    </h2>
                    <div id="delivery3" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                        <div class="accordion-body">
                            Yes, once your order is dispatched, you'll receive tracking information via SMS. You can also contact our support team for updates.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment -->
            <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-credit-card me-2" style="color:#1593A5"></i>Payment</h5>
            <div class="accordion faq-accordion mb-4" id="faqPayment">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment1">
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="payment1" class="accordion-collapse collapse" data-bs-parent="#faqPayment">
                        <div class="accordion-body">
                            We currently offer Cash on Delivery (COD) for all orders. bKash and Nagad payment options will be available soon.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment2">
                            Is it safe to pay Cash on Delivery?
                        </button>
                    </h2>
                    <div id="payment2" class="accordion-collapse collapse" data-bs-parent="#faqPayment">
                        <div class="accordion-body">
                            Yes, COD is completely safe. You pay only when you receive and verify your products. No advance payment required.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Returns & Refunds -->
            <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-arrow-return-left me-2" style="color:#1593A5"></i>Returns & Refunds</h5>
            <div class="accordion faq-accordion" id="faqReturns">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#returns1">
                            What is your return policy?
                        </button>
                    </h2>
                    <div id="returns1" class="accordion-collapse collapse" data-bs-parent="#faqReturns">
                        <div class="accordion-body">
                            We offer a 7-day return policy for most products. Items must be unused and in original packaging. Contact us to initiate a return.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#returns2">
                            How do I get a refund?
                        </button>
                    </h2>
                    <div id="returns2" class="accordion-collapse collapse" data-bs-parent="#faqReturns">
                        <div class="accordion-body">
                            Once we receive and inspect the returned item, refunds are processed within 3-5 business days to your original payment method.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@extends('frontend.master')
@section('title', 'Contact Us')

@section('content')
<div class="container page-hero">
    <div class="crumbs d-inline-flex">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span class="cur">Contact Us</span>
    </div>
    <div class="mt-4">
        <span class="eyebrow">Get in Touch</span>
        <h1 class="mt-2" style="font-weight:800;color:#132238">Contact Us</h1>
        <p class="mx-auto" style="max-width:620px;color:#6B7A94">We're here to help — reach out for support, partnership, or vendor onboarding. Our team responds within 24 hours.</p>
    </div>
</div>

<section class="container pb-4">
    <div class="row g-3">
        <div class="col-md-3 col-6"><div class="value-card"><div class="ic"><i class="bi bi-headset"></i></div><h6 class="mb-1">24/7 Support</h6><small>Always available</small></div></div>
        <div class="col-md-3 col-6"><div class="value-card"><div class="ic"><i class="bi bi-chat-dots-fill"></i></div><h6 class="mb-1">Live Chat</h6><small>Instant response</small></div></div>
        <div class="col-md-3 col-6"><div class="value-card"><div class="ic"><i class="bi bi-envelope-fill"></i></div><h6 class="mb-1">Email</h6><small>Within 24h</small></div></div>
        <div class="col-md-3 col-6"><div class="value-card"><div class="ic"><i class="bi bi-telephone-fill"></i></div><h6 class="mb-1">Call Us</h6><small>{{ $company->phone1 ?? '' }}</small>@if($company->phone2)<br><small>{{ $company->phone2 }}</small>@endif</div></div>
    </div>
</section>

<section class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="contact-card">
                <h5 style="font-weight:700;color:#132238">Head Office</h5>
                <ul class="list-unstyled contact-info mb-4">
                    @if($company->address1)
                        <li><span class="ic"><i class="bi bi-geo-alt-fill"></i></span><div><b>{{ $company->address1 }}</b><br><small>{{ $company->address2 ?? '' }}</small></div></li>
                    @endif
                    @if($company->phone1)
                        <li><span class="ic"><i class="bi bi-telephone-fill"></i></span><div><b>{{ $company->phone1 }}</b>@if($company->phone2)<br><small>{{ $company->phone2 }}</small>@endif</div></li>
                    @endif
                    @if($company->email1)
                        <li><span class="ic"><i class="bi bi-envelope-fill"></i></span><div><b>{{ $company->email1 }}</b></div></li>
                    @endif
                </ul>
                <div class="d-flex gap-2">
                    @if($company->facebook)<a href="{{ $company->facebook }}" target="_blank" class="icon-btn" style="background:rgba(21,147,165,.08);color:#1593A5"><i class="bi bi-facebook"></i></a>@endif
                    @if($company->instagram)<a href="{{ $company->instagram }}" target="_blank" class="icon-btn" style="background:rgba(21,147,165,.08);color:#1593A5"><i class="bi bi-instagram"></i></a>@endif
                    @if($company->twitter)<a href="{{ $company->twitter }}" target="_blank" class="icon-btn" style="background:rgba(21,147,165,.08);color:#1593A5"><i class="bi bi-twitter-x"></i></a>@endif
                    @if($company->youtube)<a href="{{ $company->youtube }}" target="_blank" class="icon-btn" style="background:rgba(21,147,165,.08);color:#1593A5"><i class="bi bi-youtube"></i></a>@endif
                    @if($company->linkedin)<a href="{{ $company->linkedin }}" target="_blank" class="icon-btn" style="background:rgba(21,147,165,.08);color:#1593A5"><i class="bi bi-linkedin"></i></a>@endif
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="contact-card">
                <h5 style="font-weight:700;color:#132238">Send Us a Message</h5>
                <form id="contactForm" class="row g-3" data-captcha-answer="{{ $captchaAnswer }}">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Name <span style="color:#DC2626">*</span></label>
                        <input class="form-control" name="name" required style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email</label>
                        <input type="email" class="form-control" name="email" style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Phone</label>
                        <input class="form-control" name="phone" placeholder="+880..." style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Subject <span style="color:#DC2626">*</span></label>
                        <input class="form-control" name="subject" required style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                    </div>
                    <div class="col-12">
                        <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Message <span style="color:#DC2626">*</span></label>
                        <textarea class="form-control" name="message" rows="5" required style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem;resize:vertical"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label id="captchaLabel" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">{{ $captchaQuestion }}</label>
                        <input type="text" class="form-control" name="captcha" id="captchaInput" placeholder="Your answer" required autocomplete="off" style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100" style="border-radius:14px;padding:.75rem;font-weight:700;font-size:.9rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">Send Message <i class="bi bi-send-fill ms-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($company->google_map)
<section class="container pb-5">
    <div class="contact-card" style="padding:0;overflow:hidden;border-radius:16px">
        <div style="width:100%;height:400px">{!! $company->google_map !!}</div>
    </div>
</section>
<style>.contact-card iframe{width:100%!important;height:100%!important;border:none!important}</style>
@endif

@endsection

@section('script')
<script>
$(document).off('submit.contact').on('submit.contact', '#contactForm', function(e) {
    e.preventDefault();
    var form = this;
    var answer = parseInt($('#captchaInput').val());
    if (answer !== parseInt($(form).data('captcha-answer'))) {
        showSmartNotify({ type: 'error', title: 'Error!', message: 'Incorrect answer. Please try again.' });
        return;
    }
    $.ajax({
        url: "{{ route('contact.store') }}",
        type: "POST",
        data: $(form).serialize(),
        success: function(res) {
            showSmartNotify({ type: 'success', title: 'Success!', message: res.message });
            form.reset();
        },
        error: function(xhr) {
            showSmartNotify({ type: 'error', title: 'Error!', message: 'Something went wrong' });
        }
    });
});
</script>
@endsection

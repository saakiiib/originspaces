@extends('frontend.master')
@section('title', 'Page Not Found')

@section('content')
<section class="container pb-5 pt-4">
    <div class="text-center" style="padding:80px 0;">
        <div style="font-size:120px;font-weight:900;color:var(--brand-soft);line-height:1;">404</div>
        <h2 class="fw-bold mt-3">Page Not Found</h2>
        <p class="text-muted mx-auto mt-2" style="max-width:420px;">The page you're looking for doesn't exist or has been moved. Let's get you back on track.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a @spa href="{{ route('home') }}" class="btn btn-brand btn-lg">
                <i class="bi bi-house"></i> Go Home
            </a>
            <a @spa href="{{ route('shop') }}" class="btn btn-outline-brand btn-lg">
                <i class="bi bi-shop"></i> Browse Shop
            </a>
        </div>
    </div>
</section>
@endsection
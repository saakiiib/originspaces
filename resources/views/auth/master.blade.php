@extends('frontend.master')

@section('content')
<section class="auth-shell">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:calc(100vh - 280px)">
            <div class="col-md-6 col-lg-5 col-xl-4">
                @yield('auth-content')
            </div>
        </div>
    </div>
</section>
@endsection

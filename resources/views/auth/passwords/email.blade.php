@extends('auth.master')

@section('title', 'Reset Password')

@section('auth-content')
<div class="auth-card">
    <div class="text-center mb-4">
        <h2 style="font-weight:800;color:#132238;margin-bottom:.35rem">Forgot Password?</h2>
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Enter your email and we'll send you a reset link</p>
    </div>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;background:rgba(22,163,74,.08);color:#16A34A;font-size:.88rem">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;background:rgba(220,38,38,.08);color:#DC2626;font-size:.88rem">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email Address</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('email')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:14px;padding:.75rem;font-weight:700;font-size:.95rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
            <i class="bi bi-send"></i> Send Reset Link
        </button>

        <div class="text-center mt-4 pt-3" style="border-top:1px solid #E6ECF5">
            <a @spa href="{{ route('login') }}" style="color:#0F4C9C;font-weight:700;font-size:.9rem;text-decoration:none">
                <i class="bi bi-arrow-left"></i> Back to Login
            </a>
        </div>
    </form>
</div>
@endsection

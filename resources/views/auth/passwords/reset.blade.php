@extends('auth.master')

@section('title', 'Reset Password')

@section('auth-content')
<div class="auth-card">
    <div class="text-center mb-4">
        <h2 style="font-weight:800;color:#132238;margin-bottom:.35rem">Reset Password</h2>
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Enter your new password below</p>
    </div>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email Address</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autofocus
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('email')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">New Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-lock"></i></span>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Enter new password" required
                    style="border-radius:0;border-color:#E6ECF5;font-size:.9rem">
                <button class="btn" type="button" onclick="togglePass()"
                    style="background:#F8FAFC;border:1px solid #E6ECF5;border-left:none;border-radius:0 12px 12px 0;color:#6B7A94">
                    <i class="bi bi-eye" id="passIcon"></i>
                </button>
            </div>
            @error('password')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password-confirm" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-lock-fill"></i></span>
                <input id="password-confirm" type="password" class="form-control"
                    name="password_confirmation" placeholder="Re-enter new password" required
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:14px;padding:.75rem;font-weight:700;font-size:.95rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
            <i class="bi bi-check-circle"></i> Reset Password
        </button>

        <div class="text-center mt-4 pt-3" style="border-top:1px solid #E6ECF5">
            <a @spa href="{{ route('login') }}" style="color:#0F4C9C;font-weight:700;font-size:.9rem;text-decoration:none">
                <i class="bi bi-arrow-left"></i> Back to Login
            </a>
        </div>
    </form>
</div>

<script>
function togglePass() {
    var input = document.getElementById('password');
    var icon = document.getElementById('passIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>
@endsection

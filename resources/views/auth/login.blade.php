@extends('auth.master')

@section('title', 'Login')

@section('auth-content')
<div class="auth-card">
    <div class="text-center mb-4">
        <h2 style="font-weight:800;color:#132238;margin-bottom:.35rem">Welcome Back</h2>
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Sign in to your account to continue</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;background:rgba(220,38,38,.08);color:#DC2626;font-size:.88rem">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;background:rgba(22,163,74,.08);color:#16A34A;font-size:.88rem">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        @if(request()->has('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
        @endif

        <div class="mb-3">
            <label for="login" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email or Phone</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-person"></i></span>
                <input id="login" type="text"
                    class="form-control @error('login') is-invalid @enderror"
                    name="login" value="{{ old('login') }}" placeholder="Email or 01XXXXXXXXX" required autofocus
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('login')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-lock"></i></span>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Enter your password" required
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

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="border-color:#E6ECF5">
                <label class="form-check-label" for="remember" style="font-size:.88rem;color:#6B7A94">Remember me</label>
            </div>
            @if(Route::has('password.request'))
                <a @spa href="{{ route('password.request') }}" style="font-size:.88rem;color:#0F4C9C;font-weight:600;text-decoration:none">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:14px;padding:.75rem;font-weight:700;font-size:.95rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
            <i class="bi bi-box-arrow-in-right"></i> Sign In
        </button>
    </form>

    <div class="text-center mt-4 pt-3" style="border-top:1px solid #E6ECF5">
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Don't have an account? <a @spa href="{{ route('register') }}" style="color:#0F4C9C;font-weight:700;text-decoration:none">Create one</a></p>
    </div>
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

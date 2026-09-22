@extends('auth.master')

@section('title', 'Register')

@section('auth-content')
<div class="auth-card">
    <div class="text-center mb-4">
        <h2 style="font-weight:800;color:#132238;margin-bottom:.35rem">Create Account</h2>
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Join us to track orders and manage your profile</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;background:rgba(220,38,38,.08);color:#DC2626;font-size:.88rem">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Full Name</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-person"></i></span>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" placeholder="John Doe" required autofocus
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('name')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email Address <small style="color:#94a3b8;font-weight:400">(optional)</small></label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="you@example.com"
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('email')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Phone Number <span style="color:#DC2626">*</span></label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-phone"></i></span>
                <input id="phone" type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required maxlength="11"
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
            @error('phone')
                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Password</label>
            <div class="input-group">
                <span class="input-group-text" style="background:#F8FAFC;border:1px solid #E6ECF5;border-right:none;border-radius:12px 0 0 12px;color:#6B7A94"><i class="bi bi-lock"></i></span>
                <input id="password" type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Min 6 characters" required
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
                <input id="password-confirm" type="password"
                    class="form-control"
                    name="password_confirmation" placeholder="Re-enter password" required
                    style="border-radius:0 12px 12px 0;border-color:#E6ECF5;font-size:.9rem">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:14px;padding:.75rem;font-weight:700;font-size:.95rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
            <i class="bi bi-person-plus"></i> Create Account
        </button>
    </form>

    <div class="text-center mt-4 pt-3" style="border-top:1px solid #E6ECF5">
        <p style="color:#6B7A94;font-size:.9rem;margin-bottom:0">Already have an account? <a @spa href="{{ route('login') }}" style="color:#0F4C9C;font-weight:700;text-decoration:none">Sign In</a></p>
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

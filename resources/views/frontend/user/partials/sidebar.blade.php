@php
    $currentRoute = request()->route()->getName();
@endphp

{{-- Mobile toggle --}}
<div class="d-lg-none mb-3">
    <button class="btn w-100 d-flex align-items-center justify-content-between" type="button"
        data-bs-toggle="collapse" data-bs-target="#portalSidebar" aria-expanded="false"
        style="background:#fff;border:1px solid #E6ECF5;border-radius:14px;padding:.7rem 1rem;font-weight:600;color:#132238">
        <span class="d-flex align-items-center gap-2">
            <i class="bi bi-person-fill" style="color:#1593A5"></i> {{ $user->name }}
        </span>
        <i class="bi bi-three-dots-vertical" style="color:#6B7A94"></i>
    </button>
</div>

{{-- Sidebar --}}
<div class="account-sidebar mb-4 collapse d-lg-block">
    <div class="d-flex align-items-center gap-3 mb-4 pb-3" style="border-bottom:1px solid #E6ECF5">
        <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,#1593A5,#1F477A);display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 8px 20px -6px rgba(21,147,165,.4)">
            <i class="bi bi-person-fill" style="font-size:22px;color:#fff"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold" style="color:#132238;font-size:.95rem">{{ $user->name }}</h6>
            <small style="color:#6B7A94;font-size:.8rem">{{ $user->email }}</small>
        </div>
    </div>

    <nav class="account-menu">
        <a @spa class="{{ str_starts_with($currentRoute, 'user.dashboard') ? 'active' : '' }}"
            href="{{ route('user.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a @spa class="{{ str_starts_with($currentRoute, 'user.orders') || str_starts_with($currentRoute, 'user.order') ? 'active' : '' }}"
            href="{{ route('user.orders') }}">
            <i class="bi bi-bag"></i> My Orders
        </a>
        <a @spa class="{{ str_starts_with($currentRoute, 'user.profile') ? 'active' : '' }}"
            href="{{ route('user.profile') }}">
            <i class="bi bi-person-gear"></i> Profile
        </a>
        <form method="POST" action="{{ route('user.logout') }}" class="mt-2">
            @csrf
            <button type="submit" style="display:flex;align-items:center;gap:.7rem;width:100%;padding:.7rem .8rem;border-radius:12px;border:none;background:rgba(220,38,38,.06);color:#DC2626;font-weight:500;font-size:.9rem;cursor:pointer;transition:all .3s" onmouseover="this.style.background='rgba(220,38,38,.12)'" onmouseout="this.style.background='rgba(220,38,38,.06)'">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </nav>
</div>

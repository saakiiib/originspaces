@extends('frontend.master')
@section('title', 'Checkout')

@section('style')
<style>
.checkout-select .nice-select{width:100%;border-radius:12px;border:1px solid var(--border);height:auto;padding:.65rem 2.5rem .65rem 1rem;font-size:.9rem;line-height:1.4;background:#fff;transition:all .3s}
.checkout-select .nice-select:focus,.checkout-select .nice-select.open{border-color:var(--primary);box-shadow:0 0 0 4px rgba(21,147,165,.12)}
.checkout-select .nice-select .list{border-radius:14px;border:1px solid var(--border);box-shadow:0 20px 50px -12px rgba(15,76,156,.2);padding:.4rem;margin-top:.35rem;max-height:220px;overflow-y:auto}
.checkout-select .nice-select .option{border-radius:8px;font-size:.88rem;padding:.6rem 1rem;line-height:1.4}
.checkout-select .nice-select .option.selected,.checkout-select .nice-select .option:hover{background:rgba(21,147,165,.1);color:var(--primary)}
.checkout-select .nice-select .placeholder{color:var(--muted);font-weight:500}
.checkout-select select.nice-checkout{position:absolute;opacity:0;pointer-events:none;height:0;width:0}
</style>
@endsection

@section('content')
<div class="container page-hero">
    <div class="crumbs">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <a href="{{ route('cart') }}">Cart</a>
        <span class="sep">›</span>
        <span class="cur">Checkout</span>
    </div>
    <h1 class="mt-3">Checkout</h1>
</div>

<section class="container pb-5">
    @if(session('error'))
        <div style="border-radius:14px;border:1px solid #fecaca;background:#fef2f2;color:#991b1b;padding:1rem 1.2rem;font-size:.9rem;margin-bottom:1rem">
            <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
        </div>
    @endif

    @auth
    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf
        <div class="row g-4">
            <div class="col-lg-7">
                <div style="padding:1.6rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.4rem">
                        <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#0F4C9C,#2563EB);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0"><i class="bi bi-geo-alt-fill"></i></span>
                        <h5 style="font-weight:700;font-size:1.05rem;color:var(--dark);margin:0">Delivery Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Full Name <span style="color:var(--danger)">*</span></label>
                            <input type="text" name="customer_name" required
                                value="{{ old('customer_name', $authName) }}" placeholder="Your full name"
                                style="width:100%;border-radius:12px;border:1px solid var(--border);padding:.7rem 1rem;font-size:.9rem;font-family:inherit;transition:all .3s;outline:none"
                                onfocus="this.style.borderColor='var(--primary)';this.style.boxShadow='0 0 0 4px rgba(21,147,165,.12)'"
                                onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
                            @error('customer_name') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Phone Number <span style="color:var(--danger)">*</span></label>
                            <input type="text" name="customer_phone" required
                                placeholder="01XXXXXXXXX" value="{{ old('customer_phone', $authPhone) }}"
                                style="width:100%;border-radius:12px;border:1px solid var(--border);padding:.7rem 1rem;font-size:.9rem;font-family:inherit;transition:all .3s;outline:none"
                                onfocus="this.style.borderColor='var(--primary)';this.style.boxShadow='0 0 0 4px rgba(21,147,165,.12)'"
                                onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">
                            @error('customer_phone') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 checkout-select">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Division <span style="color:var(--danger)">*</span></label>
                            <select name="division_id" id="division" class="nice-checkout">
                                <option value="" data-display="Select Division">Select Division</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ old('division_id', $authDivisionId) == $div->id ? 'selected' : '' }}>
                                        {{ $div->name }} ({{ $div->bn_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 checkout-select">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">District <span style="color:var(--danger)">*</span></label>
                            <select name="district_id" id="district" class="nice-checkout">
                                <option value="" data-display="Select District">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-4 checkout-select">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Upazila / Thana <span style="color:var(--danger)">*</span></label>
                            <select name="upazila_id" id="upazila" class="nice-checkout">
                                <option value="" data-display="Select Upazila">Select Upazila</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Full Address <span style="color:var(--danger)">*</span></label>
                            <textarea name="address" rows="2" required
                                placeholder="House No, Road, Area, Landmark"
                                style="width:100%;border-radius:12px;border:1px solid var(--border);padding:.7rem 1rem;font-size:.9rem;font-family:inherit;transition:all .3s;outline:none;resize:vertical"
                                onfocus="this.style.borderColor='var(--primary)';this.style.boxShadow='0 0 0 4px rgba(21,147,165,.12)'"
                                onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">{{ old('address', $authAddress) }}</textarea>
                            @error('address') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-12">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Order Note (optional)</label>
                            <textarea name="delivery_note" rows="2"
                                placeholder="Any special instructions for delivery..."
                                style="width:100%;border-radius:12px;border:1px solid var(--border);padding:.7rem 1rem;font-size:.9rem;font-family:inherit;transition:all .3s;outline:none;resize:vertical"
                                onfocus="this.style.borderColor='var(--primary)';this.style.boxShadow='0 0 0 4px rgba(21,147,165,.12)'"
                                onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none'">{{ old('delivery_note') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div style="padding:1.6rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff;position:sticky;top:120px">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.2rem">
                        <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#1593A5,#1F477A);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0"><i class="bi bi-bag-check-fill"></i></span>
                        <h5 style="font-weight:700;font-size:1.05rem;color:var(--dark);margin:0">Order Summary</h5>
                    </div>

                    <div style="max-height:300px;overflow-y:auto;margin-bottom:1rem">
                        @foreach($items as $data)
                            @php $product = $data['product']; @endphp
                            <div style="display:flex;align-items:center;gap:10px;padding:10px 0;{{ !$loop->last ? 'border-bottom:1px solid var(--border);' : '' }}">
                                <div style="width:48px;height:48px;border-radius:10px;overflow:hidden;flex-shrink:0;background:linear-gradient(160deg,#F7F8FA,#EAF4FF)">
                                    <img src="{{ asset(ltrim($product->image ?? 'placeholder.webp', '/')) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover">
                                </div>
                                <div style="flex:1;min-width:0">
                                    <div style="font-weight:600;font-size:.82rem;color:var(--dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $product->name }}</div>
                                    <div style="font-size:.72rem;color:var(--muted)">{{ $product->brand->name ?? '' }}</div>
                                </div>
                                <div style="text-align:right;flex-shrink:0">
                                    <div style="font-size:.75rem;color:var(--muted)">×{{ $data['qty'] }}</div>
                                    <div style="font-weight:700;font-size:.85rem;color:var(--primary)">৳ {{ number_format($data['price'] * $data['qty'], 0) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div style="border-top:1px solid var(--border);padding-top:.8rem">
                        <div style="display:flex;justify-content:space-between;padding:.4rem 0;font-size:.9rem;color:var(--dark)">
                            <span>Subtotal</span>
                            <span style="font-weight:700">৳ {{ number_format($total, 0) }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;padding:.4rem 0;font-size:.9rem" id="deliveryRow">
                            <span>Delivery Charge</span>
                            <span id="deliveryAmount" style="font-weight:700;color:var(--muted);font-size:.85rem">Select division first</span>
                        </div>
                        <div style="border-top:1px dashed var(--border);margin-top:.5rem;padding-top:.8rem;display:flex;justify-content:space-between;font-weight:800;font-size:1.1rem;color:var(--primary)">
                            <span>Total</span>
                            <span id="grandTotal">৳ {{ number_format($total, 0) }}</span>
                        </div>
                    </div>

                    <div style="margin-top:1rem;padding:12px 14px;border-radius:14px;background:linear-gradient(135deg,rgba(22,163,74,.06),rgba(22,163,74,.03));border:1px solid rgba(22,163,74,.12)">
                        <div style="display:flex;align-items:center;gap:10px">
                            <span style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#16A34A,#22c55e);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.9rem;flex-shrink:0"><i class="bi bi-cash-stack"></i></span>
                            <div>
                                <div style="font-weight:700;font-size:.88rem;color:var(--dark)">Cash on Delivery</div>
                                <div style="font-size:.75rem;color:var(--muted)">Pay when you receive your order</div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:1rem">
                        <label style="display:flex;align-items:flex-start;gap:8px;cursor:pointer;font-size:.82rem;color:var(--muted);line-height:1.5">
                            <input type="checkbox" id="agreeTerms" required style="accent-color:var(--primary);margin-top:3px;flex-shrink:0">
                            <span>I agree to the <a @spa href="{{ route('terms') }}" style="color:var(--secondary);font-weight:600;text-decoration:none">Terms of Service</a> and <a @spa href="{{ route('privacy') }}" style="color:var(--secondary);font-weight:600;text-decoration:none">Privacy Policy</a></span>
                        </label>
                    </div>

                    <button type="submit" id="placeOrderBtn"
                        style="width:100%;margin-top:1rem;border:none;border-radius:14px;padding:.85rem;font-weight:700;font-size:1rem;cursor:pointer;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;transition:all .35s;font-family:inherit"
                        onmouseover="this.style.transform='translateY(-3px) scale(1.02)';this.style.boxShadow='0 18px 40px -14px rgba(21,147,165,.45)'"
                        onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                        <i class="bi bi-check-circle"></i> Place Order
                    </button>

                    <a @spa href="{{ route('cart') }}"
                        style="display:inline-flex;align-items:center;justify-content:center;gap:.5rem;width:100%;margin-top:.6rem;border:1.5px solid var(--primary);border-radius:14px;padding:.7rem;font-weight:600;font-size:.88rem;text-decoration:none;color:var(--primary);background:transparent;transition:all .35s;font-family:inherit;position:relative;overflow:hidden"
                        onmouseover="this.style.background='rgba(21,147,165,.08)';this.style.transform='translateY(-2px)'"
                        onmouseout="this.style.background='transparent';this.style.transform='none'">
                        <i class="bi bi-arrow-left"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </form>
    @endauth

    @guest
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
            <div style="padding:2rem;border-radius:var(--radius-lg);border:1px solid var(--border);background:#fff">
                {{-- Tabs --}}
                <div style="display:flex;border-bottom:2px solid var(--border);margin-bottom:1.5rem">
                    <button type="button" onclick="switchAuthTab('login')" id="tabLogin"
                        style="flex:1;padding:.7rem 0;border:none;background:transparent;font-weight:700;font-size:.95rem;color:var(--primary);cursor:pointer;border-bottom:2px solid var(--primary);margin-bottom:-2px;transition:all .2s;font-family:inherit">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>
                    <button type="button" onclick="switchAuthTab('register')" id="tabRegister"
                        style="flex:1;padding:.7rem 0;border:none;background:transparent;font-weight:700;font-size:.95rem;color:var(--muted);cursor:pointer;border-bottom:2px solid transparent;margin-bottom:-2px;transition:all .2s;font-family:inherit">
                        <i class="bi bi-person-plus me-1"></i> Register
                    </button>
                </div>

                {{-- Error/Status Messages --}}
                @if(session('error'))
                    <div style="border-radius:12px;background:rgba(220,38,38,.08);color:#DC2626;padding:.7rem 1rem;font-size:.88rem;margin-bottom:1rem">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
                    </div>
                @endif
                @if(session('status'))
                    <div style="border-radius:12px;background:rgba(22,163,74,.08);color:#16A34A;padding:.7rem 1rem;font-size:.88rem;margin-bottom:1rem">
                        <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
                    </div>
                @endif

                {{-- Login Form --}}
                <div id="panelLogin">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ url('/checkout') }}">

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Phone Number <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:12px 0 0 12px;color:var(--muted)"><i class="bi bi-phone"></i></span>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required maxlength="11"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    style="border-radius:0 12px 12px 0;border-color:var(--border);font-size:.9rem">
                            </div>
                            @error('phone') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Password <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:0 0 0 12px;color:var(--muted)"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" placeholder="Enter your password" required
                                    class="form-control @error('password') is-invalid @enderror"
                                    style="border-radius:0;border-color:var(--border);font-size:.9rem">
                                <button class="btn" type="button" onclick="togglePass('loginPass','loginPassIcon')"
                                    style="background:#F8FAFC;border:1px solid var(--border);border-left:none;border-radius:0 12px 12px 0;color:var(--muted)">
                                    <i class="bi bi-eye" id="loginPassIcon"></i>
                                </button>
                            </div>
                            @error('password') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember" style="font-size:.85rem;color:var(--muted)">Remember me</label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:.85rem;color:var(--secondary);font-weight:600;text-decoration:none">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit"
                            style="width:100%;border:none;border-radius:14px;padding:.8rem;font-weight:700;font-size:.95rem;cursor:pointer;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;font-family:inherit;transition:all .35s"
                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 30px -8px rgba(21,147,165,.45)'"
                            onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </button>
                    </form>
                </div>

                {{-- Register Form --}}
                <div id="panelRegister" style="display:none">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="redirect" value="{{ url('/checkout') }}">

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Full Name <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:12px 0 0 12px;color:var(--muted)"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required
                                    class="form-control @error('name') is-invalid @enderror"
                                    style="border-radius:0 12px 12px 0;border-color:var(--border);font-size:.9rem">
                            </div>
                            @error('name') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Email Address <small style="color:var(--muted);font-weight:400">(optional)</small></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:12px 0 0 12px;color:var(--muted)"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                                    class="form-control @error('email') is-invalid @enderror"
                                    style="border-radius:0 12px 12px 0;border-color:var(--border);font-size:.9rem">
                            </div>
                            @error('email') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Phone Number <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:12px 0 0 12px;color:var(--muted)"><i class="bi bi-phone"></i></span>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="01XXXXXXXXX" required maxlength="11"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    style="border-radius:0 12px 12px 0;border-color:var(--border);font-size:.9rem">
                            </div>
                            @error('phone') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Password <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:0 0 0 12px;color:var(--muted)"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" placeholder="Min 6 characters" required
                                    class="form-control @error('password') is-invalid @enderror"
                                    style="border-radius:0;border-color:var(--border);font-size:.9rem">
                                <button class="btn" type="button" onclick="togglePass('regPass','regPassIcon')"
                                    style="background:#F8FAFC;border:1px solid var(--border);border-left:none;border-radius:0 12px 12px 0;color:var(--muted)">
                                    <i class="bi bi-eye" id="regPassIcon"></i>
                                </button>
                            </div>
                            @error('password') <small style="color:var(--danger);font-size:.78rem;margin-top:4px;display:block">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-4">
                            <label style="font-weight:600;font-size:.82rem;color:var(--dark);margin-bottom:6px;display:block">Confirm Password <span style="color:var(--danger)">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#F8FAFC;border:1px solid var(--border);border-right:none;border-radius:0 0 0 12px;color:var(--muted)"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" placeholder="Re-enter password" required
                                    class="form-control"
                                    style="border-radius:0 12px 12px 0;border-color:var(--border);font-size:.9rem">
                            </div>
                        </div>

                        <button type="submit"
                            style="width:100%;border:none;border-radius:14px;padding:.8rem;font-weight:700;font-size:.95rem;cursor:pointer;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;font-family:inherit;transition:all .35s"
                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 30px -8px rgba(21,147,165,.45)'"
                            onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                            <i class="bi bi-person-plus"></i> Create Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endguest
</section>
@endsection

@section('script')
<script>
var deliveryCharges = { 'Dhaka': 60 };
var defaultDelivery = 120;
var subtotal = {{ $total }};

function checkoutInit() {
    // Init NiceSelect only on checkout selects (not .nice which is handled globally)
    if (typeof NiceSelect !== 'undefined') {
        document.querySelectorAll('.checkout-select select.nice-checkout').forEach(function(el) {
            try { NiceSelect.bind(el, { searchable: false }); } catch(e) {}
        });
    }
}

function destroyNice(selector) {
    var el = document.querySelector(selector);
    if (!el) return;
    var ns = el.nextElementSibling;
    if (ns && ns.classList.contains('nice-select')) {
        ns.remove();
    }
    el.style.display = '';
}

function bindNice(selector) {
    if (typeof NiceSelect === 'undefined') return;
    var el = document.querySelector(selector);
    if (el) {
        try { NiceSelect.bind(el, { searchable: false }); } catch(e) {}
    }
}

function recalcTotal() {
    var chargeText = $('#deliveryAmount').text();
    var charge = chargeText.includes('৳') ? parseFloat(chargeText.replace(/[^\d.]/g, '')) : 0;
    var grand = subtotal + charge;
    if (grand < 0) grand = 0;
    $('#grandTotal').text('৳ ' + grand.toFixed(0));
}

// Form validation + prevent double submit
$('#checkoutForm').off('submit').on('submit', function(e) {
    var valid = true;
    if (!$('#division').val()) valid = false;
    if (!$('#district').val()) valid = false;
    if (!$('#upazila').val()) valid = false;

    if (!valid) {
        e.preventDefault();
        showSmartNotify({ type: 'error', title: 'Missing Fields', message: 'Please select division, district and upazila.' });
        return false;
    }
    if ($('#placeOrderBtn').prop('disabled')) {
        e.preventDefault();
        return false;
    }
    $('#placeOrderBtn').prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Processing...');
});

// Cascading dropdowns
$('#division').off('change').on('change', function() {
    var divId = $(this).val();

    // Reset district and upazila
    destroyNice('#district');
    $('#district').html('<option value="">Select District</option>');
    bindNice('#district');

    destroyNice('#upazila');
    $('#upazila').html('<option value="">Select Upazila</option>');
    bindNice('#upazila');

    if (!divId) {
        updateDeliveryCharge(null);
        return;
    }

    $.get('{{ route("checkout.districts") }}', {division_id: divId}, function(res) {
        var html = '<option value="">Select District</option>';
        res.districts.forEach(function(d) {
            html += '<option value="' + d.id + '">' + d.name + ' (' + d.bn_name + ')</option>';
        });
        destroyNice('#district');
        $('#district').html(html);
        bindNice('#district');
    });

    var divText = $('#division option:selected').text();
    var divName = divText.split(' (')[0];
    updateDeliveryCharge(divName);
});

$('#district').off('change').on('change', function() {
    var distId = $(this).val();

    destroyNice('#upazila');
    $('#upazila').html('<option value="">Select Upazila</option>');
    bindNice('#upazila');

    if (!distId) return;

    $.get('{{ route("checkout.upazilas") }}', {district_id: distId}, function(res) {
        var html = '<option value="">Select Upazila</option>';
        res.upazilas.forEach(function(u) {
            html += '<option value="' + u.id + '">' + u.name + ' (' + u.bn_name + ')</option>';
        });
        destroyNice('#upazila');
        $('#upazila').html(html);
        bindNice('#upazila');
    });
});

function updateDeliveryCharge(divName) {
    var charge = deliveryCharges[divName] || defaultDelivery;
    $('#deliveryAmount').text('৳ ' + charge.toFixed(0)).css('color', 'var(--dark)');
    recalcTotal();
}

@guest
// Tab switching
function switchAuthTab(tab) {
    if (tab === 'login') {
        document.getElementById('panelLogin').style.display = '';
        document.getElementById('panelRegister').style.display = 'none';
        document.getElementById('tabLogin').style.color = 'var(--primary)';
        document.getElementById('tabLogin').style.borderBottomColor = 'var(--primary)';
        document.getElementById('tabRegister').style.color = 'var(--muted)';
        document.getElementById('tabRegister').style.borderBottomColor = 'transparent';
    } else {
        document.getElementById('panelLogin').style.display = 'none';
        document.getElementById('panelRegister').style.display = '';
        document.getElementById('tabRegister').style.color = 'var(--primary)';
        document.getElementById('tabRegister').style.borderBottomColor = 'var(--primary)';
        document.getElementById('tabLogin').style.color = 'var(--muted)';
        document.getElementById('tabLogin').style.borderBottomColor = 'transparent';
    }
}

// If there are register validation errors, auto-switch to register tab
@if($errors->has('name') || $errors->has('email'))
    document.addEventListener('DOMContentLoaded', function() { switchAuthTab('register'); });
    document.addEventListener('spa:loaded', function() { switchAuthTab('register'); });
@endif
@endguest

function togglePass(inputId, iconId) {
    var input = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}

// Track when user leaves checkout page (beforeunload)
@auth
var checkoutSessionId = {{ $checkoutSessionId ?? 'null' }};
if (checkoutSessionId) {
    window.addEventListener('beforeunload', function() {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var params = new URLSearchParams();
        params.append('checkout_session_id', checkoutSessionId);
        params.append('_token', token);
        navigator.sendBeacon('{{ route("checkout.trackLeave") }}', params);
    });
}
@endauth

document.addEventListener('DOMContentLoaded', checkoutInit);
document.addEventListener('spa:loaded', checkoutInit);

// Pre-select cascading dropdowns if user has saved address
var savedDivId = '{{ $authDivisionId }}';
var savedDistId = '{{ $authDistrictId }}';
var savedUpaId = '{{ $authUpazilaId }}';
if (savedDivId) {
    // Load districts for saved division
    $.get('{{ route("checkout.districts") }}', {division_id: savedDivId}, function(res) {
        var html = '<option value="">Select District</option>';
        res.districts.forEach(function(d) {
            var sel = (d.id == savedDistId) ? ' selected' : '';
            html += '<option value="' + d.id + '"' + sel + '>' + d.name + ' (' + d.bn_name + ')</option>';
        });
        destroyNice('#district');
        $('#district').html(html);
        bindNice('#district');

        // Update delivery charge based on selected division
        var divText = $('#division option:selected').text();
        var divName = divText.split(' (')[0];
        updateDeliveryCharge(divName);

        // Load upazilas for saved district
        if (savedDistId) {
            $.get('{{ route("checkout.upazilas") }}', {district_id: savedDistId}, function(res2) {
                var html2 = '<option value="">Select Upazila</option>';
                res2.upazilas.forEach(function(u) {
                    var sel = (u.id == savedUpaId) ? ' selected' : '';
                    html2 += '<option value="' + u.id + '"' + sel + '>' + u.name + ' (' + u.bn_name + ')</option>';
                });
                destroyNice('#upazila');
                $('#upazila').html(html2);
                bindNice('#upazila');
            });
        }
    });
}
</script>
@endsection

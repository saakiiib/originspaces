@extends('frontend.master')
@section('title', 'My Profile')

@section('style')
<style>
.profile-select .nice-select{width:100%;border-radius:12px;border:1px solid #E6ECF5;height:auto;padding:.65rem 2.5rem .65rem 1rem;font-size:.9rem;line-height:1.4;background:#fff;transition:all .3s}
.profile-select .nice-select:focus,.profile-select .nice-select.open{border-color:#1593A5;box-shadow:0 0 0 4px rgba(21,147,165,.12)}
.profile-select .nice-select .list{border-radius:14px;border:1px solid #E6ECF5;box-shadow:0 20px 50px -12px rgba(15,76,156,.2);padding:.4rem;margin-top:.35rem;max-height:220px;overflow-y:auto}
.profile-select .nice-select .option{border-radius:8px;font-size:.88rem;padding:.6rem 1rem;line-height:1.4}
.profile-select .nice-select .option.selected,.profile-select .nice-select .option:hover{background:rgba(21,147,165,.1);color:#1593A5}
.profile-select .nice-select .placeholder{color:#94a3b8;font-weight:500}
.profile-select select.nice-profile{position:absolute;opacity:0;pointer-events:none;height:0;width:0}
</style>
@endsection

@section('content')
<div class="container page-header">
    <nav class="crumb">
        <a @spa href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <a @spa href="{{ route('user.dashboard') }}">Dashboard</a>
        <span class="sep">›</span>
        <span class="cur">Profile</span>
    </nav>
</div>

<section class="container pb-5">
    <div class="row g-4">
        <div class="col-lg-3">
            @include('frontend.user.partials.sidebar')
        </div>
        <div class="col-lg-9">
            <h4 class="fw-bold mb-4" style="color:#132238">My Profile</h4>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" style="border-radius:14px;border:none;background:rgba(22,163,74,.08);color:#16A34A;font-size:.9rem">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="font-size:.7rem"></button>
                </div>
            @endif

            <div class="card-premium mb-4" style="padding:1.8rem">
                <h5 class="fw-bold mb-4" style="color:#132238"><i class="bi bi-person-gear me-2" style="color:#1593A5"></i>Edit Profile</h5>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Full Name <span style="color:#DC2626">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                            @error('name')
                                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Email Address <small style="color:#94a3b8;font-weight:400">(optional)</small></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                            @error('email')
                                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Phone Number <span style="color:#DC2626">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $user->phone) }}" placeholder="01XXXXXXXXX" required maxlength="11"
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                            @error('phone')
                                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr style="border-color:#E6ECF5;margin:1.5rem 0">

                    <h6 class="fw-bold mb-3" style="color:#6B7A94;font-size:.9rem">Change Password <small class="fw-normal" style="color:#94a3b8">(leave blank to keep current)</small></h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min 6 characters"
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                            @error('password')
                                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Re-enter password"
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem">
                        </div>
                    </div>

                    <hr style="border-color:#E6ECF5;margin:1.5rem 0">

                    <h6 class="fw-bold mb-3" style="color:#6B7A94;font-size:.9rem"><i class="bi bi-geo-alt me-1" style="color:#1593A5"></i>Delivery Address <small class="fw-normal" style="color:#94a3b8">(optional — used to pre-fill checkout)</small></h6>

                    <div class="row g-3">
                        <div class="col-md-4 profile-select">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Division</label>
                            <select name="division_id" id="profile-division" class="nice-profile">
                                <option value="" data-display="Select Division">Select Division</option>
                                @foreach($divisions as $div)
                                    <option value="{{ $div->id }}" {{ old('division_id', $user->division_id) == $div->id ? 'selected' : '' }}>
                                        {{ $div->name }} ({{ $div->bn_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 profile-select">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">District</label>
                            <select name="district_id" id="profile-district" class="nice-profile">
                                <option value="" data-display="Select District">Select District</option>
                            </select>
                        </div>
                        <div class="col-md-4 profile-select">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Upazila / Thana</label>
                            <select name="upazila_id" id="profile-upazila" class="nice-profile">
                                <option value="" data-display="Select Upazila">Select Upazila</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight:600;color:#132238;font-size:.88rem">Full Address</label>
                            <textarea name="address" rows="2" placeholder="House No, Road, Area, Landmark"
                                class="form-control @error('address') is-invalid @enderror"
                                style="border-radius:12px;border-color:#E6ECF5;font-size:.9rem;padding:.7rem 1rem;resize:vertical">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <small class="text-danger" style="font-size:.8rem">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary" style="border-radius:14px;padding:.7rem 1.8rem;font-weight:700;font-size:.9rem;box-shadow:0 12px 30px -8px rgba(21,147,165,.4)">
                            <i class="bi bi-check-circle me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-premium" style="padding:1.8rem">
                <h5 class="fw-bold mb-3" style="color:#132238"><i class="bi bi-info-circle me-2" style="color:#1593A5"></i>Account Info</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <small style="color:#6B7A94;font-size:.82rem;display:block;margin-bottom:6px">Account Status</small>
                        @if($user->status)
                            <span style="display:inline-block;padding:.3rem .7rem;border-radius:999px;font-size:.78rem;font-weight:700;background:rgba(22,163,74,.12);color:#16A34A">Active</span>
                        @else
                            <span style="display:inline-block;padding:.3rem .7rem;border-radius:999px;font-size:.78rem;font-weight:700;background:rgba(107,122,148,.12);color:#6B7A94">Inactive</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <small style="color:#6B7A94;font-size:.82rem;display:block;margin-bottom:6px">Member Since</small>
                        <span class="fw-semibold" style="color:#132238;font-size:.9rem">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="col-md-4">
                        <small style="color:#6B7A94;font-size:.82rem;display:block;margin-bottom:6px">Last Updated</small>
                        <span class="fw-semibold" style="color:#132238;font-size:.9rem">{{ $user->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
function profileInit() {
    if (typeof NiceSelect !== 'undefined') {
        document.querySelectorAll('.profile-select select.nice-profile').forEach(function(el) {
            try { NiceSelect.bind(el, { searchable: false }); } catch(e) {}
        });
    }
}

function destroyProfileNice(selector) {
    var el = document.querySelector(selector);
    if (!el) return;
    var ns = el.nextElementSibling;
    if (ns && ns.classList.contains('nice-select')) ns.remove();
    el.style.display = '';
}

function bindProfileNice(selector) {
    if (typeof NiceSelect === 'undefined') return;
    var el = document.querySelector(selector);
    if (el) try { NiceSelect.bind(el, { searchable: false }); } catch(e) {}
}

$('#profile-division').off('change').on('change', function() {
    var divId = $(this).val();

    destroyProfileNice('#profile-district');
    $('#profile-district').html('<option value="">Select District</option>');
    bindProfileNice('#profile-district');

    destroyProfileNice('#profile-upazila');
    $('#profile-upazila').html('<option value="">Select Upazila</option>');
    bindProfileNice('#profile-upazila');

    if (!divId) return;

    $.get('{{ route("checkout.districts") }}', {division_id: divId}, function(res) {
        var html = '<option value="">Select District</option>';
        res.districts.forEach(function(d) {
            html += '<option value="' + d.id + '">' + d.name + ' (' + d.bn_name + ')</option>';
        });
        destroyProfileNice('#profile-district');
        $('#profile-district').html(html);
        bindProfileNice('#profile-district');
    });
});

$('#profile-district').off('change').on('change', function() {
    var distId = $(this).val();

    destroyProfileNice('#profile-upazila');
    $('#profile-upazila').html('<option value="">Select Upazila</option>');
    bindProfileNice('#profile-upazila');

    if (!distId) return;

    $.get('{{ route("checkout.upazilas") }}', {district_id: distId}, function(res) {
        var html = '<option value="">Select Upazila</option>';
        res.upazilas.forEach(function(u) {
            html += '<option value="' + u.id + '">' + u.name + ' (' + u.bn_name + ')</option>';
        });
        destroyProfileNice('#profile-upazila');
        $('#profile-upazila').html(html);
        bindProfileNice('#profile-upazila');
    });
});

// On load: if user has saved address, cascade load districts then upazilas
(function() {
    var savedDivision = '{{ old("division_id", $user->division_id) }}';
    var savedDistrict = '{{ old("district_id", $user->district_id) }}';
    var savedUpazila = '{{ old("upazila_id", $user->upazila_id) }}';

    if (savedDivision) {
        $.get('{{ route("checkout.districts") }}', {division_id: savedDivision}, function(res) {
            var html = '<option value="">Select District</option>';
            res.districts.forEach(function(d) {
                var sel = (d.id == savedDistrict) ? ' selected' : '';
                html += '<option value="' + d.id + '"' + sel + '>' + d.name + ' (' + d.bn_name + ')</option>';
            });
            destroyProfileNice('#profile-district');
            $('#profile-district').html(html);
            bindProfileNice('#profile-district');

            if (savedDistrict) {
                $.get('{{ route("checkout.upazilas") }}', {district_id: savedDistrict}, function(res2) {
                    var html2 = '<option value="">Select Upazila</option>';
                    res2.upazilas.forEach(function(u) {
                        var sel = (u.id == savedUpazila) ? ' selected' : '';
                        html2 += '<option value="' + u.id + '"' + sel + '>' + u.name + ' (' + u.bn_name + ')</option>';
                    });
                    destroyProfileNice('#profile-upazila');
                    $('#profile-upazila').html(html2);
                    bindProfileNice('#profile-upazila');
                });
            }
        });
    }
})();

document.addEventListener('DOMContentLoaded', profileInit);
document.addEventListener('spa:loaded', profileInit);
</script>
@endsection

@php
    $company = App\Models\CompanyDetails::firstOrCreate();
@endphp

<footer class="site-footer" style="border-top:2px solid transparent;border-image:linear-gradient(90deg,transparent,#1593A5,#173B67,#1593A5,transparent) 1">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <a class="brand-logo mb-3" @spa href="{{ route('home') }}" style="color:#fff">
          <img src="{{ $company->footer_logo ? asset('uploads/company/' . $company->footer_logo) : asset('placeholder.webp') }}" alt="{{ $company->company_name ?? 'Logo' }}">
        </a>
        <p class="text-white-50 small">
          {{ $company->company_name ?? config('app.name') }} — trusted electronics showroom. Genuine products, manufacturer warranty, doorstep delivery.
        </p>
        <div class="social">
          @if($company->facebook)
            <a href="{{ $company->facebook }}" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
          @endif
          @if($company->youtube)
            <a href="{{ $company->youtube }}" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>
          @endif
          @if($company->whatsapp)
            <a href="https://wa.me/{{ $company->whatsapp }}" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
          @endif
          @if($company->instagram)
            <a href="{{ $company->instagram }}" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
          @endif
          @if($company->twitter)
            <a href="{{ $company->twitter }}" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
          @endif
          @if($company->linkedin)
            <a href="{{ $company->linkedin }}" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
          @endif
          @if($company->tiktok)
            <a href="{{ $company->tiktok }}" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>
          @endif
        </div>
      </div>
      <div class="col-6 col-md-2">
        <h6>Quick Links</h6>
        <ul class="list-unstyled d-grid gap-2">
          <li><a @spa href="{{ route('home') }}">Home</a></li>
          <li><a @spa href="{{ route('shop') }}">Shop</a></li>
          <li><a @spa href="{{ route('about') }}">About Us</a></li>
          <li><a @spa href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-2">
        <h6>Categories</h6>
        <ul class="list-unstyled d-grid gap-2">
          @php
            $footerCats = App\Models\Category::where('status', 1)->whereNull('parent_id')->take(7)->get();
          @endphp
          @foreach($footerCats as $cat)
            <li><a @spa href="{{ route('shop', ['category' => $cat->slug]) }}">{{ $cat->name }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-4">
        <h6>Contact</h6>
        <ul class="list-unstyled d-grid gap-2 text-white-50 small">
          @if($company->address1)
            <li><i class="bi bi-geo-alt-fill me-2" style="color:#8ED8DE"></i>{{ $company->address1 }}, {{ $company->city ?? 'Bangladesh' }}</li>
          @endif
          @if($company->phone1)
            <li><i class="bi bi-telephone-fill me-2" style="color:#8ED8DE"></i>{{ $company->phone1 }}</li>
          @endif
          @if($company->phone2)
            <li><i class="bi bi-telephone-fill me-2" style="color:#8ED8DE"></i>{{ $company->phone2 }}</li>
          @endif
          @if($company->email1)
            <li><i class="bi bi-envelope-fill me-2" style="color:#8ED8DE"></i>{{ $company->email1 }}</li>
          @endif
          <li><i class="bi bi-clock-fill me-2" style="color:#8ED8DE"></i>Sat – Thu, 9:00 AM – 9:00 PM</li>
        </ul>
      </div>
    </div>
    <div class="foot-bottom">
      <div>&copy; {{ date('Y') }} {{ $company->company_name ?? 'Vai Vai Electronics' }}. All rights reserved.</div>
      <div>Designed & Developed by <a href="#" style="color:#8ED8DE;text-decoration:none;font-weight:600">Neutron Tech</a></div>
    </div>
  </div>
</footer>

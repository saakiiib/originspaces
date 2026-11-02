@extends('frontend.layout')
@section('title', 'Contact | OriginSpaces Modular UK')
@section('content')


  <!-- Page Hero -->
  <section class="py-14 md:py-16 px-4 sm:px-6 lg:px-10 border-b border-[#e5e2da] bg-[#FDFBF7]">
    <style>
      .lt{max-width:1100px;margin:0 auto;text-align:center}
      .lt-eyebrow{display:inline-flex;align-items:center;gap:18px;font-family:'Montserrat','Inter',sans-serif;font-size:13px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;color:#9a7b4f}
      .lt-eyebrow:before,.lt-eyebrow:after{content:"";width:36px;height:2px;background:#9a7b4f}
      .lt h1{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(28px,4vw,52px);font-weight:700;line-height:1.15;color:#14213d;margin:22px 0 0}
      .lt h1 em{font-style:italic;font-weight:600;color:#9a7b4f;display:block}
      .lt-p{margin:22px auto 0;max-width:900px;font-size:17px;line-height:1.7;color:#2d3a52}
      .lt-p+.lt-p{margin-top:10px}
      .lt-pills{display:flex;flex-wrap:wrap;justify-content:center;gap:18px;margin-top:36px}
      .lt-pill{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #e8e3d6;border-radius:18px;padding:14px 28px 14px 16px;box-shadow:0 2px 8px rgba(26,29,36,.04)}
      .lt-pill i{width:48px;height:48px;border-radius:50%;background:#f7eedb;display:grid;place-items:center;color:#9a7b4f;flex-shrink:0}
      .lt-pill i svg{width:24px;height:24px}
      .lt-pill span{font-size:17px;font-weight:700;color:#14213d;white-space:nowrap}
      .lt-note{margin:28px 0 0;font-size:14px;font-style:italic;color:#374151}
      @media(max-width:640px){.lt-pill{width:100%}.lt-p{font-size:15px}}
    </style>
    <div class="lt">
      <span class="lt-eyebrow">Get in Touch with Origin Spaces</span>
      <h1>Interested in an Expandable Modular Building? <em>Let’s Talk.</em></h1>
      <p class="lt-p">Our first shipment of expandable modular buildings is available at attractive introductory prices.</p>
      <p class="lt-p">Whether you're looking for a garden office, coffee shop, additional family space or a building for your business, we'd be happy to discuss your requirements.</p>

      <div class="lt-pills">
        <div class="lt-pill">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V9l9-6 9 6v12"/><path d="M7 21v-8h10v8"/><path d="M7 16h10"/></svg></i>
          <span>Available for Delivery</span>
        </div>
        <div class="lt-pill">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8z"/><circle cx="8" cy="8" r="1.5"/></svg></i>
          <span>Introductory Prices</span>
        </div>
        <div class="lt-pill">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/></svg></i>
          <span>Friendly Advice</span>
        </div>
      </div>

      <p class="lt-note">Installation is not included. Delivery and other arrangements can be discussed with our team.</p>
    </div>
  </section>

  <!-- Contact Grid -->
  <section class="py-20 md:py-28 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
      <!-- Info -->
      <div class="lg:col-span-5 space-y-5">
        <div class="bg-white rounded-2xl border border-[#e5e2da] p-6 sm:p-7 shadow-xs">
          <div class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-widest text-[#9a7b4f] font-semibold mb-4">
            <x-icon name="phone" class="w-4 h-4" />
            <span>Contact Us</span>
          </div>
          <p class="font-serif text-2xl text-[#1a1d24] font-semibold">{{ $company->phone1 ?: '+44 (0)20 7946 0880' }}</p>
          @if($company->phone2)<p class="font-serif text-xl text-[#9a7b4f]">{{ $company->phone2 }}</p>@endif
          <p class="text-xs text-[#6b7280] mt-1">{{ $company->opening_time ?: 'Mon–Sat, 10:00–18:00' }}</p>
          @if($company->email1)<p class="text-sm text-[#374151] mt-2"><a href="mailto:{{ $company->email1 }}" class="text-[#9a7b4f] font-semibold hover:underline">{{ $company->email1 }}</a></p>@endif
        </div>
        <div class="bg-white rounded-2xl border border-[#e5e2da] p-6 sm:p-7 shadow-xs">
          <div class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-widest text-[#9a7b4f] font-semibold mb-4">
            <x-icon name="map-pin" class="w-4 h-4" />
            <span>Address</span>
          </div>
          <ul class="space-y-3 text-sm text-[#374151]">
            <li><strong class="text-[#1a1d24] block">Address</strong>{{ $company->address1 ?: 'Mayfair Flagship, 14 Berkeley Square, W1J 6BQ' }}</li>
          </ul>
        </div>
      </div>
      <!-- Form -->
      <div class="lg:col-span-7">
        <form onsubmit="return handleContactSubmit(event)" class="bg-white rounded-2xl border border-[#e5e2da] p-6 sm:p-9 shadow-xs">
          <div id="contact-form-fields" class="space-y-4">
            <!-- Row 1: Full Name -->
            <div>
              <label class="block text-xs font-mono uppercase text-[#6b7280] mb-1.5 font-semibold">Full Name *</label>
              <input type="text" id="contact-name" required placeholder="Jane Smith" class="w-full border border-[#e5e2da] rounded-lg p-3 text-sm text-[#1a1d24] focus:border-[#9a7b4f] focus:outline-none" />
            </div>

            <!-- Row 2: Email / Phone -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-mono uppercase text-[#6b7280] mb-1.5 font-semibold">Email *</label>
                <input type="email" id="contact-email" required placeholder="jane@example.co.uk" class="w-full border border-[#e5e2da] rounded-lg p-3 text-sm text-[#1a1d24] focus:border-[#9a7b4f] focus:outline-none" />
              </div>
              <div>
                <label class="block text-xs font-mono uppercase text-[#6b7280] mb-1.5 font-semibold">Phone *</label>
                <input type="tel" id="contact-phone" required placeholder="+44 7700 900123" pattern="[+]?[0-9\s\-()]{7,}" class="w-full border border-[#e5e2da] rounded-lg p-3 text-sm text-[#1a1d24] focus:border-[#9a7b4f] focus:outline-none" />
              </div>
            </div>

            <!-- Full width -->
            <div>
              <label class="block text-xs font-mono uppercase text-[#6b7280] mb-1.5 font-semibold">Description *</label>
              <textarea id="contact-message" rows="5" required placeholder="Plot size, intended use, timelines — anything that helps us quote accurately." class="w-full border border-[#e5e2da] rounded-lg p-3 text-sm text-[#1a1d24] focus:border-[#9a7b4f] focus:outline-none"></textarea>
            </div>

            <!-- Submit row: Quick Check (left) + button (right) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
              <div>
                <label class="block text-xs font-mono uppercase text-[#6b7280] mb-1.5 font-semibold">Quick Check: <span id="captcha-question" class="text-[#9a7b4f]"></span> *</label>
                <input type="text" id="contact-captcha" required inputmode="numeric" autocomplete="off" placeholder="Your answer" class="w-full h-12 border border-[#e5e2da] rounded-lg px-3 text-sm text-[#1a1d24] focus:border-[#9a7b4f] focus:outline-none" />
              </div>
              <div>
                <label class="hidden sm:block text-xs font-mono uppercase mb-1.5 font-semibold invisible" aria-hidden="true">&nbsp;</label>
                <button type="submit" class="w-full h-12 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-wider transition-all">Send Enquiry</button>
              </div>
            </div>
            <p class="text-[11px] text-center text-[#6b7280]">No spam, no obligation — we reply within one working day.</p>
          </div>
          <div id="contact-form-success" class="hidden text-center py-10">
            <span class="w-14 h-14 rounded-full bg-[#9a7b4f]/10 flex items-center justify-center mx-auto mb-4">
              <x-icon name="check" class="w-6 h-6 text-[#9a7b4f]" />
            </span>
            <h3 class="font-serif text-2xl text-[#1a1d24] font-semibold">Enquiry received.</h3>
            <p class="text-sm text-[#374151] mt-2">Thank you — we will reply within one working day.</p>
          </div>
        </form>
      </div>
    </div>
  </section>

  @if($company->google_map)
  <!-- Showroom Map -->
  <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-10 border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto">
      <div class="flex items-center gap-2 text-[11px] font-mono uppercase tracking-widest text-[#9a7b4f] font-semibold mb-4">
        <x-icon name="map-pin" class="w-4 h-4" />
        <span>Our Location</span>
      </div>
      <div class="contact-map rounded-2xl border border-[#e5e2da] overflow-hidden shadow-xs bg-white">
        <div class="w-full h-[380px] md:h-[440px]">{!! $company->google_map !!}</div>
      </div>
    </div>
  </section>
  <style>.contact-map iframe{width:100%!important;height:100%!important;border:0!important}</style>
  @endif

@endsection
@section('script')
<script>
    /* toggleMobileMenu lives in header partial */
    var captchaAnswer = 0;

    function newCaptcha() {
      var a = Math.floor(Math.random() * 9) + 1;
      var b = Math.floor(Math.random() * 9) + 1;
      var ops = ['+', '-', '×'];
      var op = ops[Math.floor(Math.random() * ops.length)];
      if (op === '-' && b > a) { var t = a; a = b; b = t; }
      captchaAnswer = op === '+' ? a + b : op === '-' ? a - b : a * b;
      var q = document.getElementById('captcha-question');
      var input = document.getElementById('contact-captcha');
      if (q) q.textContent = a + ' ' + op + ' ' + b + ' = ?';
      if (input) input.value = '';
    }

    function handleContactSubmit(e) {
      e.preventDefault();
      var captchaVal = document.getElementById('contact-captcha').value.trim();
      if (parseInt(captchaVal, 10) !== captchaAnswer) {
        if (window.showToast) showToast('Verification failed', 'Please answer the quick check correctly.');
        newCaptcha();
        return false;
      }
      var csrf = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';
      var form = e.target;
      var btn = form.querySelector('button[type="submit"]');
      if (btn) btn.disabled = true;
      fetch("{{ route('contact.store') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
        body: JSON.stringify({
          name: document.getElementById('contact-name').value,
          email: document.getElementById('contact-email').value,
          phone: document.getElementById('contact-phone').value,
          captcha: captchaVal,
          message: document.getElementById('contact-message').value,
        }),
      }).then(function (r) {
        if (btn) btn.disabled = false;
        newCaptcha();
        if (!r.ok) {
          return r.json().catch(function(){ return {}; }).then(function (d) {
            var msg = d.message || (d.errors ? Object.values(d.errors)[0][0] : 'Please check the form.');
            if (window.showToast) showToast('Something went wrong', msg);
          });
        }
        document.getElementById('contact-form-fields').classList.add('hidden');
        document.getElementById('contact-form-success').classList.remove('hidden');
        if (window.lucide) lucide.createIcons();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }).catch(function () {
        if (btn) btn.disabled = false;
        newCaptcha();
        if (window.showToast) showToast('Something went wrong', 'Please try again.');
      });
      return false;
    }

    newCaptcha();
    if (window.lucide) lucide.createIcons();
  </script>
@endsection
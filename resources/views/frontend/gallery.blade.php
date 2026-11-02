@extends('frontend.layout')
@section('title', 'Gallery | OriginSpaces Modular UK')
@section('content')


  <!-- Page Hero -->
  <section class="py-8 md:py-12 px-4 sm:px-6 lg:px-10 border-b border-[#e5e2da]">
    <div class="max-w-3xl mx-auto text-center">
      <span class="text-[11px] uppercase tracking-[0.3em] text-[#9a7b4f] font-mono font-semibold block mb-2">— Gallery</span>
      <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#1a1d24] font-semibold tracking-tight leading-[1.1]">Expanded Living, Documented.</h1>
    </div>
  </section>

  <!-- Gallery -->
  <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button onclick="filterGallery('all', this)" class="gallery-pill px-5 py-2.5 rounded-full bg-[#181b20] text-white text-[13px] font-semibold border border-[#181b20] transition-all">All Products ({{ count($items) }})</button>
        @foreach($productsJson as $pr)
          <button onclick="filterGallery({{ json_encode($pr['name']) }}, this)" class="gallery-pill px-5 py-2.5 rounded-full bg-white border border-[#e5e2da] text-[#6b7280] text-[13px] font-semibold hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all">{{ $pr['name'] }} ({{ collect($items)->where('category', $pr['name'])->count() }})</button>
        @endforeach
      </div>
      <div id="gallery-grid" class="grid grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($items as $gi => $g)
          <a @spa href="/product/{{ $g['slug'] }}" data-cat="{{ $g['category'] }}" class="gallery-item group relative rounded-xl overflow-hidden border border-[#e5e2da] bg-white block">
            @if($g['type'] === 'video')
              <video src="{{ $g['image'] }}" class="w-full aspect-[4/3] object-cover" muted playsinline loop preload="none"></video>
            @else
              <img src="{{ $g['image'] }}" alt="{{ $g['name'] }}" loading="lazy" class="w-full aspect-[4/3] object-cover transition-transform duration-700 group-hover:scale-105" />
            @endif
            <span class="absolute inset-0 bg-gradient-to-t from-black/45 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></span>
            <span class="absolute bottom-2 left-2 text-[10px] font-mono uppercase bg-[#181b20]/80 text-white px-2 py-1 rounded-full">{{ $g['category'] }}</span>
            <div class="p-3.5">
              <h4 class="font-serif text-base sm:text-lg text-[#1a1d24] font-semibold leading-tight group-hover:text-[#9a7b4f] transition-colors">{{ $g['name'] }}</h4>
              <span class="text-[11px] font-mono text-[#6b7280]">{{ $g['modelCode'] }}</span>
            </div>
          </a>
        @empty
          <p class="col-span-full text-center text-sm text-[#6b7280] py-10">Gallery is being curated — check back soon.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- CTA -->
    <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-10 border-b border-[#e5e2da] bg-[#FDFBF7]">
    <style>
        .lt{max-width:1100px;margin:0 auto;text-align:center}
        .lt-eyebrow{display:inline-flex;align-items:center;gap:18px;font-family:'Montserrat','Inter',sans-serif;font-size:13px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;color:#9a7b4f}
        .lt-eyebrow:before,.lt-eyebrow:after{content:"";width:36px;height:2px;background:#9a7b4f}
        .lt h2{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(28px,4vw,52px);font-weight:700;line-height:1.15;color:#14213d;margin:22px 0 0}
        .lt h2 em{font-style:italic;font-weight:600;color:#9a7b4f;display:block}
        .lt-p{margin:22px auto 0;max-width:900px;font-size:17px;line-height:1.7;color:#2d3a52}
        .lt-p+.lt-p{margin-top:10px}
        .lt-pills{display:flex;flex-wrap:wrap;justify-content:center;gap:18px;margin-top:36px}
        .lt-pill{display:flex;align-items:center;gap:14px;background:#fff;border:1px solid #e8e3d6;border-radius:18px;padding:14px 28px 14px 16px;box-shadow:0 2px 8px rgba(26,29,36,.04)}
        .lt-pill i{width:48px;height:48px;border-radius:50%;background:#f7eedb;display:grid;place-items:center;color:#9a7b4f;flex-shrink:0}
        .lt-pill i svg{width:24px;height:24px}
        .lt-pill span{font-size:17px;font-weight:700;color:#14213d;white-space:nowrap}
        .lt-cta{display:inline-flex;align-items:center;justify-content:center;gap:14px;margin-top:40px;min-width:min(100%,440px);background:#9a7b4f;color:#fff;border-radius:16px;padding:20px 32px;font-size:16px;font-weight:700;letter-spacing:.2em;text-transform:uppercase;text-decoration:none;transition:background .2s;box-shadow:0 10px 24px rgba(154,123,79,.28)}
        .lt-cta:hover{background:#7f6540}
        .lt-cta svg{width:22px;height:22px}
        .lt-note{margin:22px 0 0;font-size:14px;font-style:italic;color:#374151}
        @media(max-width:640px){.lt-pill{width:100%}.lt-p{font-size:15px}.lt-cta{letter-spacing:.14em;padding:18px 20px;font-size:14px}}
    </style>
    <div class="lt">
        <span class="lt-eyebrow">Get in Touch with Origin Spaces</span>
        <h2>Interested in an Expandable Modular Building? <em>Let’s Talk.</em></h2>
        <p class="lt-p">Our first shipment of expandable modular buildings is available at attractive introductory prices.</p>
        <p class="lt-p">Whether you're looking for a garden office, coffee shop, additional family space or a building for your business, we'd be happy to discuss your requirements.</p>

        <div class="lt-pills">
        <div class="lt-pill">
            <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V9l9-6 9 6v12"/><path d="M7 21v-8h10v8"/><path d="M7 16h10"/></svg></i>
            <span>UK Warehouse Stock</span>
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

        <a @spa href="{{ route('contact') }}" class="lt-cta">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-12.2 7.5L3 21l2-5.600A8.500 8.500 0 1 1 21 11.500z"/><path d="M8.500 11.500h.01M12 11.500h.01M15.500 11.500h.01"/></svg>
        <span>Speak to Our Team</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>

        <p class="lt-note">Installation is not included. Delivery and other arrangements can be discussed with our team.</p>
    </div>
    </section>

  <!-- Footer -->
  
@endsection
@section('script')
<script>
    /* toggleMobileMenu lives in header partial */

    var activeGalleryCat = 'all';

    function filterGallery(cat, btn) {
      activeGalleryCat = cat;
      document.querySelectorAll('.gallery-pill').forEach(function (p) {
        p.classList.remove('bg-[#181b20]', 'text-white', 'border-[#181b20]');
        p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
      });
      if (btn) {
        btn.classList.remove('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
        btn.classList.add('bg-[#181b20]', 'text-white', 'border', 'border-[#181b20]');
      }
      renderGallery();
    }

    function renderGallery() {
      // Grid is server-rendered; only toggle visibility.
      document.querySelectorAll('#gallery-grid .gallery-item').forEach(function (el) {
        var show = (activeGalleryCat === 'all' || el.getAttribute('data-cat') === activeGalleryCat);
        el.classList.toggle('hidden', !show);
      });
    }

    renderGallery();
    if (window.lucide) lucide.createIcons();
  </script>
@endsection

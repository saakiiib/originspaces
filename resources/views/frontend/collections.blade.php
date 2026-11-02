@extends('frontend.layout')
@section('title', 'Our Collections | OriginSpaces Modular UK')
@section('content')


  <!-- Catalogue -->
  <main class="py-12 md:py-16 px-4 sm:px-6 lg:px-10">
    <div class="max-w-7xl mx-auto">

      <!-- Title + search -->
      <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
        <div>
          <h1 class="font-serif text-3xl sm:text-5xl text-[#1a1d24] font-semibold tracking-tight">Our Collections</h1>
          <p class="mt-3 text-[#374151] max-w-2xl text-sm md:text-[15px] font-semibold leading-relaxed">Explore our expandable modular suites — crafted spaces, tactile details, and atmospheric design for living, working, and gathering.</p>
        </div>
        <div class="relative w-full lg:w-72 shrink-0">
          <x-icon name="search" class="w-4 h-4 text-[#9ca3af] absolute left-3.5 top-1/2 -translate-y-1/2" />
          <input
            type="text"
            id="collection-search-input"
            oninput="handleCollectionSearch(this.value)"
            placeholder="Search model, stone, finish..."
            class="w-full bg-white border border-[#e5e2da] focus:border-[#9a7b4f] text-xs text-[#1a1d24] pl-10 pr-4 py-3 rounded-lg shadow-xs focus:outline-none transition-colors placeholder:text-[#9ca3af]"
          />
        </div>
      </div>

      <!-- Category tabs + refine -->
      <div class="flex items-center justify-between gap-4 border-y border-[#e5e2da] py-3 mb-3">
        <div class="flex items-center gap-5 sm:gap-7 overflow-x-auto no-scrollbar text-[12px] font-mono font-semibold uppercase tracking-wider" id="collection-tabs">
          <button onclick="filterCollection('All', this)" class="collection-tab shrink-0 pb-1 transition-all {{ $activeCategory === 'All' ? 'text-[#1a1d24] border-b-2 border-[#9a7b4f]' : 'text-[#6b7280] border-b-2 border-transparent hover:text-[#1a1d24]' }}">All</button>
          @forelse($categories as $tabCat)
            <button onclick="filterCollection({{ json_encode($tabCat->name) }}, this)" class="collection-tab shrink-0 pb-1 transition-all {{ $activeCategory === $tabCat->name ? 'text-[#1a1d24] border-b-2 border-[#9a7b4f]' : 'text-[#6b7280] border-b-2 border-transparent hover:text-[#1a1d24]' }}">{{ $tabCat->name }}</button>
          @empty
            <button onclick="filterCollection('Kitchen', this)" class="collection-tab shrink-0 pb-1 text-[#6b7280] border-b-2 border-transparent hover:text-[#1a1d24] transition-all">Kitchen</button>
            <button onclick="filterCollection('Expandable Homes', this)" class="collection-tab shrink-0 pb-1 text-[#6b7280] border-b-2 border-transparent hover:text-[#1a1d24] transition-all">Expandable Homes</button>
          @endforelse
        </div>
      </div>

      <!-- Count -->
      <div class="text-xs text-[#6b7280] mb-8">Displaying <strong id="collection-count" class="text-[#1a1d24] font-semibold">{{ count($productsJson) }}</strong> pieces</div>

      <!-- Cards (server-rendered; JS only filters) -->
      <div id="collection-grid" class="space-y-8">
        @forelse($productsJson as $i => $p)
          <div class="collection-card grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="{{ $p['category'] }}" data-search="{{ strtolower($p['name'] . ' ' . $p['modelCode'] . ' ' . ($p['tagline'] ?? '') . ' ' . implode(' ', $p['materials'] ?? [])) }}">
            <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-center space-y-3 order-2 {{ $i % 2 === 1 ? 'lg:order-2' : 'lg:order-1' }}">
              <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">{{ $p['category'] }}</span>
              <h3 class="font-serif text-2xl sm:text-3xl text-[#1a1d24] font-semibold leading-tight">{{ $p['name'] }}</h3>
              <p class="text-sm text-[#374151] leading-relaxed">{{ $p['tagline'] }}</p>
              <div class="pt-3 border-t border-[#f0ede6] text-xs">
                <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] font-semibold">Dimensions</span><span class="font-semibold text-[#1a1d24]">{{ $p['dimensions'] ?: '—' }}</span></div>
              </div>
              <div class="pt-1 flex flex-wrap items-center gap-4">
                <a @spa href="/product/{{ $p['slug'] }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-wider transition-all">Full Details <x-icon name="arrow-right" class="w-3.5 h-3.5" /></a>
              </div>
              <div class="collection-specs hidden pt-4 border-t border-[#f0ede6] space-y-3">
                <div>
                  <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] font-semibold mb-1.5">Primary Materials</span>
                  <div class="flex flex-wrap gap-1.5">@foreach($p['materials'] ?? [] as $m)<span class="text-[11px] px-2.5 py-1 rounded-full bg-[#FAF9F5] border border-[#e5e2da] text-[#374151] font-medium">{{ $m }}</span>@endforeach</div>
                </div>
                <ul class="space-y-1.5">@foreach($p['specs'] ?? [] as $s)<li class="flex gap-2 text-xs text-[#374151]"><x-icon name="check" class="w-3.5 h-3.5 text-[#9a7b4f] shrink-0 mt-0.5" /><span>{{ $s }}</span></li>@endforeach</ul>
                <p class="text-[11px] text-[#6b7280]">{{ $p['warranty'] ?? '' }}</p>
              </div>
            </div>
            <div class="lg:col-span-7 relative min-h-[260px] order-1 {{ $i % 2 === 1 ? 'lg:order-1' : 'lg:order-2' }}">
              <img src="{{ $p['heroImage'] }}" alt="{{ $p['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">{{ $p['modelCode'] }}</span>
            </div>
          </div>
        @empty
          <div class="bg-white rounded-2xl border border-[#e5e2da] p-12 text-center text-sm text-[#6b7280]">No pieces yet — check back soon.</div>
        @endforelse
        <div id="collection-empty" class="hidden bg-white rounded-2xl border border-[#e5e2da] p-12 text-center text-sm text-[#6b7280]">No pieces match your search. Try a different keyword or category.</div>
      </div>

    </div>
  </main>

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

        /* products server-rendered by Blade; JS only filters visible cards */

    var activeCollectionCat = @json($activeCategory);
    var collectionSearch = '';

    function filterCollection(cat, btn) {
      activeCollectionCat = cat;
      document.querySelectorAll('.collection-tab').forEach(b => {
        b.classList.remove('text-[#1a1d24]', 'border-[#9a7b4f]');
        b.classList.add('text-[#6b7280]', 'border-transparent');
      });
      if (btn) {
        btn.classList.remove('text-[#6b7280]', 'border-transparent');
        btn.classList.add('text-[#1a1d24]', 'border-[#9a7b4f]');
      }
      renderCollections();
    }

    function handleCollectionSearch(val) {
      collectionSearch = (val || '').toLowerCase().trim();
      renderCollections();
    }

    function toggleSaved(btn) {
      const on = btn.classList.toggle('bg-[#9a7b4f]');
      btn.classList.toggle('border-[#9a7b4f]', on);
      const icon = btn.querySelector('svg');
      if (icon) {
        icon.classList.toggle('text-white', on);
        icon.classList.toggle('text-[#1a1d24]', !on);
      }
    }

                        function renderCollections() {
      var cards = document.querySelectorAll('#collection-grid .collection-card');
      var shown = 0;
      cards.forEach(function (card) {
        var okCat = (activeCollectionCat === 'All' || card.getAttribute('data-cat') === activeCollectionCat);
        var hay = (card.getAttribute('data-search') || '');
        var okSearch = (!collectionSearch || hay.indexOf(collectionSearch) !== -1);
        var show = okCat && okSearch;
        card.classList.toggle('hidden', !show);
        if (show) shown++;
      });
      var count = document.getElementById('collection-count');
      if (count) count.textContent = shown;
      var empty = document.getElementById('collection-empty');
      if (empty) empty.classList.toggle('hidden', shown !== 0);
    }

    renderCollections();
    if (window.lucide) lucide.createIcons();
  </script>
@endsection
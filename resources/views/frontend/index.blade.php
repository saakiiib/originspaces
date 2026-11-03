@extends('frontend.layout')
@section('title', 'OriginSpaces | Modular Architecture & Direct UK Import')
@section('content')


  <!-- Hero Section - centered video hero brought from collections.html, video bigger -->
  <section id="home" class="relative pt-12 pb-20 md:pt-16 md:pb-24 px-4 sm:px-6 lg:px-10 overflow-hidden border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto">
    <div class="text-center max-w-3xl mx-auto mb-8">
    <!-- Live Telemetry Pill -->
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-[#e5e2da] shadow-xs text-xs font-mono uppercase tracking-wider text-[#374151] mb-4">
        <span class="relative flex h-2 w-2">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
        </span>
        <span>Watch the Expansion &bull; Expandable Modular Buildings</span>
    </div>

    <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl text-[#1a1d24] font-semibold tracking-tight leading-[1.12]">
        See How an Expandable Modular Home
        <span class="italic font-normal text-[#9a7b4f]">Comes to Life</span>
    </h1>

    <p class="mt-4 text-sm sm:text-base text-[#374151] font-normal max-w-2xl mx-auto leading-relaxed">
        Watch how an expandable modular building transforms from a compact transportable unit into a spacious, practical building.
    </p>

    <p class="mt-3 text-sm sm:text-base text-[#374151] font-normal max-w-2xl mx-auto leading-relaxed">
        Discover the possibilities for garden offices, coffee shops, family accommodation, studios and small businesses.
    </p>

    <p class="mt-4 text-sm sm:text-base text-[#9a7b4f] font-semibold tracking-wide max-w-2xl mx-auto leading-relaxed">
        Affordable modular buildings, with introductory pricing on our first shipment.
    </p>

    <p class="mt-6 text-[11px] text-[#6b7280] max-w-2xl mx-auto leading-relaxed">
        Video is for demonstration purposes. Features and specifications may vary by model. Installation is not included and must be arranged separately.
    </p>
    </div>

      <!-- Video Theater Stage - bigger -->
      <div id="hero-video-theater-stage" class="relative bg-white border border-[#e5e2da] shadow-[0_15px_45px_rgba(0,0,0,0.08)] rounded-xl overflow-hidden transition-all duration-500 max-w-6xl mx-auto">
        <!-- Top Video Stage Bar -->
        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 bg-[#FAF9F5] border-b border-[#eae7df] text-xs">
          <div class="flex items-center gap-2.5">
            <span class="flex items-center gap-1.5 font-mono text-[11px] uppercase text-[#9a7b4f] font-semibold tracking-wider">
              <x-icon name="video" class="w-3.5 h-3.5 text-[#9a7b4f]" />
              <span id="hero-stream-badge">Video 1</span>
            </span>
            <span class="hidden sm:inline-block w-1 h-1 rounded-full bg-[#c8c3b7]"></span>
          </div>
          <div class="flex items-center gap-1.5">
            <button id="hero-angle-btn-0" onclick="switchHeroAngle(0)" class="text-[11px] font-mono uppercase px-3 py-1 rounded transition-all border bg-[#9a7b4f] text-white border-[#9a7b4f] font-semibold shadow-xs">Video 1</button>
            <button id="hero-angle-btn-1" onclick="switchHeroAngle(1)" class="text-[11px] font-mono uppercase px-3 py-1 rounded transition-all border bg-white text-[#374151] border-[#e5e2da] hover:text-[#1a1d24] hover:bg-[#faf9f5]">Video 2</button>
            <button id="hero-theater-mode-btn" onclick="toggleHeroTheater()" title="Toggle Full View" class="p-1.5 bg-white hover:bg-[#faf9f5] text-[#374151] hover:text-[#9a7b4f] border border-[#e5e2da] rounded transition-colors ml-1 hidden sm:flex items-center gap-1 text-[11px] font-mono uppercase">
              <x-icon name="maximize-2" class="w-3.5 h-3.5" />
              <span id="hero-theater-text">Full View</span>
            </button>
          </div>
        </div>

        <!-- Video Player -->
        <div id="hero-video-display-box" class="relative w-full bg-black overflow-hidden transition-all duration-500">
          <video id="hero-video-0" class="w-full h-auto block mx-auto" src="/resources/frontend/vidoes/video1.mp4" autoplay muted playsinline loop preload="auto" poster=""></video>
          <video id="hero-video-1" class="w-full h-auto block mx-auto hidden" src="/resources/frontend/vidoes/video2.mp4" muted playsinline loop preload="auto" poster=""></video>
          <button id="hero-quick-unmute-btn" onclick="toggleHeroAudio()" class="absolute top-4 left-4 z-20 flex items-center gap-2 bg-white/95 hover:bg-[#9a7b4f] text-[#1a1d24] hover:text-white border border-[#e5e2da] px-3.5 py-2 font-mono text-[11px] uppercase tracking-wider transition-all duration-300 shadow-md backdrop-blur-md rounded">
            <x-icon name="volume-2" class="w-4 h-4 animate-bounce" />
            <span>Click to listen with audio</span>
          </button>
          <div class="absolute bottom-4 right-4 z-20 flex items-center gap-2">
            <button id="hero-audio-corner-btn" onclick="toggleHeroAudio()" class="flex items-center gap-2 bg-white/95 hover:bg-[#faf9f5] text-[#1a1d24] border border-[#e5e2da] px-3 py-1.5 text-xs font-mono backdrop-blur-md transition-colors rounded shadow-sm">
              <x-icon name="volume-x" class="w-3.5 h-3.5 text-[#9a7b4f]" />
              <span id="hero-corner-audio-text" class="text-[10px] uppercase font-semibold text-[#9a7b4f]">Muted (Click for Sound)</span>
            </button>
          </div>
        </div>

        <!-- Delivery steps (replaces deployment timeline) -->
        <div class="p-5 sm:p-7 bg-[#FAF9F5] border-t border-[#eae7df] osd-in">
          <div class="osd-head">
            <h2 class="osd-title"><span>From Delivery to Your New Space</span></h2>
            <span class="osd-tag">Simple, Flexible &amp; Affordable</span>
          </div>
          <p class="osd-lead">Our expandable modular buildings are supplied for a wide range of home and business uses. Here is a simple overview of how the process works.</p>
  
          <div class="osd-grid">
            <div class="osd-card">
              <span class="osd-icon"><x-icon name="home" /></span>
              <div>
                <span class="osd-step">Step 1</span>
                <h3>Choose Your Modular Building</h3>
                <p>Explore available expandable modular buildings and choose a model that suits your space, budget and intended use. Need something different?</p>
              </div>
            </div>
            <div class="osd-card">
              <span class="osd-icon"><x-icon name="truck" /></span>
              <div>
                <span class="osd-step">Step 2</span>
                <h3>Arrange Delivery</h3>
                <p>Once your order is confirmed, we will discuss delivery availability, costs and arrangements for your location. Buildings are transported in a compact format.</p>
              </div>
            </div>
            <div class="osd-card">
              <span class="osd-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"/><path d="M14 6a6 6 0 0 1 6 6v3"/><path d="M4 15v-3a6 6 0 0 1 6-6"/><rect x="2" y="15" width="20" height="4" rx="1"/></svg></span>
              <div>
                <span class="osd-step">Step 3</span>
                <h3>Prepare Your Site</h3>
                <p>Before delivery, make the necessary arrangements for access, site preparation, foundations, installation and utility connections.</p>
              </div>
            </div>
            <div class="osd-card">
              <span class="osd-icon"><x-icon name="key" /></span>
              <div>
                <span class="osd-step">Step 4</span>
                <h3>Create Your Ideal Space</h3>
                <p>After professional assembly and any required connections or approvals, your building can be prepared for use as an office, café, studio, annexe or other suitable space.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Bar -->
      {{-- <div class="mt-4 flex flex-wrap items-center justify-center gap-2 max-w-6xl mx-auto">
        <a @spa href="{{ route('collections') }}" id="hero-explore-models-btn" class="inline-flex items-center justify-center gap-2.5 bg-[#181b20] hover:bg-[#9a7b4f] text-white font-semibold text-xs uppercase tracking-[0.18em] px-5 py-2.5 transition-all duration-300 rounded-md shadow-xs w-full sm:w-auto">
          <span>Explore Collections</span>
          <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
        <button onclick="openEnquiryModal('General Consultation')" id="hero-request-quote-btn" class="inline-flex items-center justify-center gap-2 border border-[#e5e2da] hover:border-[#9a7b4f] bg-white hover:bg-[#faf9f5] text-[#1a1d24] text-xs uppercase tracking-[0.16em] px-4 py-2.5 rounded-md transition-all font-semibold shadow-2xs w-full sm:w-auto">
          <x-icon name="layout" class="w-4 h-4 text-[#9a7b4f]" />
          <span>Request Quote</span>
        </button>
        <a id="hero-yt-watch-link" href="https://www.youtube.com/watch?v=U7lB7lf-hAk" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto text-[#1a1d24] hover:border-[#9a7b4f] hover:bg-[#faf9f5] text-xs uppercase tracking-[0.16em] px-4 py-2.5 border border-[#e5e2da] rounded-md bg-white transition-all font-semibold shadow-2xs">
          <x-icon name="youtube" class="w-4 h-4 text-[#9a7b4f]" />
          <span>Watch on YouTube</span>
        </a>
      </div> --}}

      <!-- From Delivery to Your New Space (replaces 4-column spec strip) -->
      <style>
        .osd{margin-top:20px;text-align:left}
        .osd-head{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
        .osd-title{display:flex;align-items:center;gap:18px;margin:0}
        .osd-title:before{content:"";width:64px;height:2px;background:#9a7b4f;flex-shrink:0}
        .osd-title span{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(26px,3.4vw,40px);font-weight:600;color:#1a1d24;text-transform:uppercase;line-height:1.1}
        .osd-tag{font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:600;letter-spacing:.18em;color:#9a7b4f}
        .osd-lead{margin:14px 0 24px;font-size:15px;line-height:1.7;color:#374151;max-width:760px}
        .osd-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}
        .osd-card{display:flex;gap:20px;background:#fff;border:1px solid #e5e2da;border-radius:16px;padding:24px}
        .osd-icon{width:56px;height:56px;border-radius:50%;background:rgba(154,123,79,.1);display:grid;place-items:center;flex-shrink:0;color:#9a7b4f}
        .osd-icon svg{width:26px;height:26px}
        .osd-step{font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:700;letter-spacing:.2em;color:#9a7b4f;text-transform:uppercase}
        .osd-card h3{font-family:'Cormorant Garamond',Georgia,serif;font-size:24px;font-weight:600;color:#1a1d24;margin:4px 0 8px;line-height:1.2}
        .osd-card p{margin:0;font-size:14px;line-height:1.65;color:#374151}
        .osd-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:12px;margin-top:20px}
        .osd-btn{display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:12px 22px;border-radius:8px;border:1px solid #e5e2da;background:#fff;color:#1a1d24;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.16em;transition:all .2s;cursor:pointer;text-decoration:none}
        .osd-btn svg{width:16px;height:16px;color:#9a7b4f}
        .osd-btn:hover{border-color:#9a7b4f;background:#faf9f5}
        .osd-btn.dark{background:#181b20;border-color:#181b20;color:#fff}
        .osd-btn.dark svg{color:#fff}
        .osd-btn.dark:hover{background:#9a7b4f;border-color:#9a7b4f}
        .osd-note{margin:18px 0 0;text-align:center;font-size:11.5px;color:#6b7280}
        @media(max-width:760px){.osd-grid{grid-template-columns:1fr}.osd-card{padding:20px;gap:16px}.osd-btn{width:100%}}
      .osd-in .osd-head{margin-bottom:0}
      </style>

    </div>
  </section>

  <!-- UK Applications Showcase Section - light beige, tabbed split card -->
  <section id="applications-section" hidden class="py-20 md:py-28 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-6xl mx-auto">
      <div class="text-center max-w-3xl mx-auto mb-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-[#e5e2da] text-[#9a7b4f] text-[11px] font-mono font-semibold uppercase tracking-[0.2em] mb-4 shadow-xs">
          <x-icon name="target" class="w-3.5 h-3.5" />
          <span>Targeted UK Market Applications</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#1a1d24] font-semibold tracking-tight mb-3">
          One Expandable Chassis. Limitless UK Possibilities.
        </h2>
        <p class="text-sm sm:text-base text-[#374151]">
          Engineered in specialised modular facilities and fully tailored for UK properties, businesses, and commercial landowners.
        </p>
      </div>

      <!-- App Category Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button onclick="selectApplication('annex')" id="app-tab-annex" class="app-tab-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-semibold bg-[#181b20] text-white border border-[#181b20] transition-all whitespace-nowrap">
          <x-icon name="home" class="w-3.5 h-3.5" />
          <span>House Extension</span>
        </button>
        <button onclick="selectApplication('cafe')" id="app-tab-cafe" class="app-tab-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-semibold bg-white text-[#374151] border border-[#e5e2da] hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all whitespace-nowrap">
          <x-icon name="coffee" class="w-3.5 h-3.5" />
          <span>Coffee Shop / Bakery</span>
        </button>
        <button onclick="selectApplication('office')" id="app-tab-office" class="app-tab-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-semibold bg-white text-[#374151] border border-[#e5e2da] hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all whitespace-nowrap">
          <x-icon name="briefcase" class="w-3.5 h-3.5" />
          <span>Garden Office</span>
        </button>
        <button onclick="selectApplication('glamping')" id="app-tab-glamping" class="app-tab-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-semibold bg-white text-[#374151] border border-[#e5e2da] hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all whitespace-nowrap">
          <x-icon name="tent" class="w-3.5 h-3.5" />
          <span>Holiday Home</span>
        </button>
        <button onclick="selectApplication('retail')" id="app-tab-retail" class="app-tab-btn inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-semibold bg-white text-[#374151] border border-[#e5e2da] hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all whitespace-nowrap">
          <x-icon name="store" class="w-3.5 h-3.5" />
          <span>Pop-Up Retail / Salon</span>
        </button>
      </div>

      <!-- Dynamic Application Showcase Card -->
      <div id="application-content" class="bg-white rounded-2xl border border-[#e5e2da] shadow-[0_15px_45px_rgba(0,0,0,0.06)] overflow-hidden">
        <!-- Injected via JavaScript -->
      </div>
    </div>
  </section>

  <!-- Modular Collections Section -->
  <section id="collections-section" class="py-20 md:py-28 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto">
      
      <!-- Section Editorial Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 pb-8 border-b border-[#e5e2da]">
        <div>
          <span class="text-[11px] uppercase tracking-[0.3em] text-[#9a7b4f] font-mono block mb-3 font-semibold">
            — Modular Collections
          </span>
          <h2 class="font-serif text-3xl sm:text-5xl md:text-6xl text-[#1a1d24] font-normal leading-[1.1]">
            Explore Our Collections
          </h2>
        </div>
        <div class="mt-4 md:mt-0 flex md:justify-end">
          <a @spa href="{{ route('collections') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-wider transition-all shadow-xs">
            <span>Explore Products</span>
            <x-icon name="arrow-up-right" class="w-4 h-4" />
          </a>
        </div>
      </div>

      <!-- Dynamic Collection Cards: featured products -->
      @if($featuredCards->count())
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($featuredCards as $fp)
        <a @spa href="/product/{{ $fp['slug'] }}" class="group cursor-pointer relative overflow-hidden bg-white border border-[#e5e2da] hover:border-[#9a7b4f] rounded-2xl shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col">
          <div class="aspect-[16/10] w-full overflow-hidden relative">
            <img src="{{ $fp['heroImage'] }}" srcset="{{ $fp['heroImage'] }} 1200w, {{ str_replace('w=1200', 'w=600', $fp['heroImage']) }} 600w" sizes="(max-width: 768px) 600px, 1200px" alt="{{ $fp['name'] }}" loading="lazy" width="1200" height="750" class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-transparent to-transparent"></div>
            <div class="absolute top-4 left-4 flex items-center gap-2">
              <span class="px-3 py-1.5 rounded-full bg-[#9a7b4f] text-white text-[10px] font-mono uppercase tracking-widest font-semibold shadow">— {{ $fp['category'] }}</span>
              <span class="px-3 py-1.5 rounded-full bg-[#181b20]/80 backdrop-blur-md text-white text-[10px] font-mono uppercase tracking-widest font-semibold border border-white/20">{{ $fp['modelCode'] }}</span>
            </div>
          </div>
          <div class="p-7 sm:p-9 relative bg-white flex-1 flex flex-col">
            <div class="flex items-center justify-between mb-2">
              <span class="text-[11px] uppercase font-mono tracking-[0.25em] text-[#9a7b4f] font-semibold">{{ $fp['category'] }}</span>
              <span class="w-8 h-8 rounded-full border border-[#e5e2da] group-hover:border-[#9a7b4f] group-hover:bg-[#9a7b4f] flex items-center justify-center transition-all duration-300">
                <x-icon name="arrow-up-right" class="w-4 h-4 text-[#9a7b4f] group-hover:text-white transition-colors" />
              </span>
            </div>
            <h3 class="font-serif text-2xl sm:text-3xl text-[#1a1d24] font-semibold group-hover:text-[#9a7b4f] transition-colors">{{ $fp['name'] }}</h3>
            <p class="mt-2 text-sm text-[#374151] leading-relaxed line-clamp-2">{{ $fp['tagline'] }}</p>
            <div class="mt-auto pt-4 flex items-center justify-between">
              
              <span class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] group-hover:text-[#9a7b4f] font-semibold transition-colors">View Details &rarr;</span>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      @else
        <p class="text-center text-sm text-[#6b7280] py-10">Collections are being curated — check back soon.</p>
      @endif

    </div>
  </section>

<!-- Modular Buildings Ready Now -->
<section id="philosophy" class="py-16 md:py-20 px-4 sm:px-6 lg:px-10 bg-[#f4f2ef] border-b border-[#e5e2da]">
  <style>
    .rn{max-width:1280px;margin:0 auto;position:relative;background:linear-gradient(180deg,#fbf9f4,#f7f4ec);border-radius:28px;overflow:hidden;box-shadow:0 20px 50px rgba(26,29,36,.10);min-height:400px}
    .rn-left{position:relative;z-index:3;width:51%;padding:60px 0 52px 56px}
    .rn-eyebrow{display:flex;align-items:center;gap:14px;font-family:'Montserrat','Inter',sans-serif;font-size:12px;font-weight:700;letter-spacing:.28em;text-transform:uppercase;color:#9a7b4f}
    .rn-eyebrow:before{content:"";width:32px;height:2px;background:#9a7b4f}
    .rn h2{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(30px,3.7vw,48px);font-weight:700;line-height:1.1;color:#14213d;margin:22px 0 0;white-space:nowrap}
    .rn h2 em{font-style:italic;font-weight:600;color:#9a7b4f;display:inline-block;position:relative}
    .rn h2 em:after{content:"";position:absolute;left:4%;right:0;bottom:-6px;height:3px;border-radius:3px;background:linear-gradient(90deg,transparent,#9a7b4f 30%,#b8924f);transform:rotate(-1.5deg)}
    .rn-p{margin:26px 0 0;font-size:16px;line-height:1.65;color:#1f2937;max-width:520px}
    .rn-p b{color:#14213d;font-weight:700}
    .rn-icons{display:flex;align-items:center;flex-wrap:nowrap;margin-top:34px}
    .rn-ic{display:flex;align-items:center;gap:12px;padding:0 18px;white-space:nowrap}
    .rn-ic:first-child{padding-left:0}
    .rn-ic+.rn-ic{border-left:1px solid #e0dccf}
    .rn-ic i{width:52px;height:52px;border-radius:50%;background:#dcebd9;display:grid;place-items:center;color:#14452f;flex-shrink:0}
    .rn-ic i svg{width:25px;height:25px}
    .rn-ic span{font-size:14px;font-weight:700;line-height:1.3;color:#14213d}
    .rn-img{position:absolute;top:0;right:0;bottom:0;width:36%;z-index:1}
    .rn-img img{width:100%;height:100%;object-fit:cover;display:block;clip-path:ellipse(100% 135% at 100% 50%)}
    .rn-card-wrap{position:absolute;z-index:4;left:50%;top:50%;transform:translateY(-50%);width:29%;min-width:340px}
    .rn-card{background:#0f4a2a;color:#fff;border-radius:26px;padding:32px 30px 26px;box-shadow:0 24px 50px rgba(0,0,0,.28);transform:skewX(-5deg)}
    .rn-card-in{transform:skewX(5deg)}
    .rn-li{display:flex;align-items:center;gap:14px;font-size:16px;margin-bottom:14px}
    .rn-li i{width:32px;height:32px;border-radius:50%;background:#b8924f;display:grid;place-items:center;flex-shrink:0}
    .rn-li i svg{width:17px;height:17px;color:#fff}
    .rn-li b{font-weight:700}
    .rn-hr{height:1px;background:rgba(255,255,255,.18);margin:20px 0}
    .rn-int{text-align:center;font-size:22px;font-weight:700;margin-bottom:14px}
    .rn-cta{display:flex;align-items:center;justify-content:center;gap:10px;background:#b8924f;color:#fff;border-radius:14px;padding:15px 18px;font-size:15px;font-weight:700;text-decoration:none;transition:background .2s;white-space:nowrap}
    .rn-cta:hover{background:#9a7b4f}
    .rn-cta svg{width:19px;height:19px}
    @media(max-width:1100px){.rn-ic{padding:0 12px}.rn-ic i{width:44px;height:44px}.rn-ic span{font-size:13px}.rn-left{padding-left:36px}}
    @media(max-width:900px){
      .rn{min-height:0}
      .rn-left{width:auto;padding:36px 24px 24px}
      .rn h2{white-space:normal}
      .rn-icons{flex-wrap:wrap;gap:16px}
      .rn-ic,.rn-ic:first-child{padding:0}
      .rn-ic+.rn-ic{border-left:0}
      .rn-img{position:relative;width:auto;height:240px}
      .rn-img img{clip-path:none}
      .rn-card-wrap{position:relative;left:auto;top:auto;transform:none;width:auto;min-width:0;margin:-50px 16px 24px}
      .rn-card,.rn-card-in{transform:none}
    }
  </style>

  <div class="rn">
    <div class="rn-left">
      <span class="rn-eyebrow">Available for UK Delivery</span>
      <h2>Modular Buildings <em>Ready Now</em></h2>
      <p class="rn-p">A simple, cost-effective way to add extra space at home or for your business. Our modular buildings are available with competitive pricing and delivery options.</p>

      <div class="rn-icons">
        <div class="rn-ic">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V9l9-6 9 6v12"/><path d="M7 21v-8h10v8"/><path d="M7 16h10"/></svg></i>
          <span>Direct<br>Delivery</span>
        </div>
        <div class="rn-ic">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="M3 8l9 5 9-5"/><path d="M12 13v8"/></svg></i>
          <span>Ready for<br>Delivery</span>
        </div>
        <div class="rn-ic">
          <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4 13.4 20.6a2 2 0 0 1-2.8 0L3 13V3h10l7.6 7.6a2 2 0 0 1 0 2.8z"/><circle cx="8" cy="8" r="1.5"/></svg></i>
          <span>Very<br>Good Price</span>
        </div>
      </div>
    </div>

    <div class="rn-img">
      <img src="{{ asset('resources/frontend/images/modular-garden-space.jpg') }}" alt="Expandable modular garden building with sliding glass doors" loading="lazy" />
    </div>

    <div class="rn-card-wrap">
      <div class="rn-card">
        <div class="rn-card-in">
          <div class="rn-li"><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></i><span>UK <b>Delivery Ready</b></span></div>
          <div class="rn-li"><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></i><span>Ready for <b>Quick Delivery</b></span></div>
          <div class="rn-li"><i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></i><span>Competitive <b>Pricing</b></span></div>
          <div class="rn-hr"></div>
          <div class="rn-int">Interested?</div>
          <a @spa href="{{ route('contact') }}" class="rn-cta">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C6.5 3 2 6.6 2 11c0 2.4 1.3 4.5 3.4 6L4 21l4.2-2.1c1.1.3 2.5.5 3.8.5 5.5 0 10-3.6 10-8S17.500 3 12 3z"/></svg>
            <span>Discuss with Our Team</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Featured Products - real products flagged Featured in admin; hidden unless 2+ -->
  @if(false && $featuredCards->count() > 1)
  <section id="featured-products" class="py-20 md:py-28 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-7xl mx-auto">
      <div class="mb-12">
        <div>
          <span class="text-[11px] uppercase tracking-[0.3em] text-[#9a7b4f] font-mono font-semibold block mb-3">Curated Catalogue</span>
          <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#1a1d24] font-semibold tracking-tight">Featured Products</h2>
        </div>
      </div>
      <div class="space-y-8">
        @foreach($featuredCards as $fp)
        <div class="featured-card group grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="{{ $fp['categorySlug'] }}">
          <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-center space-y-4 relative order-2 {{ $loop->odd ? 'lg:order-1' : 'lg:order-2' }}">
            <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">{{ $fp['category'] }}</span>
            <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold leading-tight">{{ $fp['name'] }}</h3>
            <p class="text-sm text-[#374151] leading-relaxed">{{ $fp['tagline'] }}</p>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#f0ede6]">
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Dimensions</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">{{ $fp['dimensions'] ?: '—' }}</span></div>
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Lead Time</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">{{ $fp['leadTime'] ?: '—' }}</span></div>
            </div>
            @if(count($fp['materials'] ?? []))
            <div>
              <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] mb-2">Materials</span>
              <div class="flex flex-wrap gap-1.5">@foreach(array_slice($fp['materials'], 0, 4) as $m)<span class="text-[11px] px-2.5 py-1 rounded-full bg-[#FAF9F5] border border-[#e5e2da] text-[#374151] font-medium">{{ $m }}</span>@endforeach</div>
            </div>
            @endif
            <div class="pt-2 flex flex-wrap items-center gap-5">
              <button onclick="enquireProduct('{{ $fp['slug'] }}')" class="px-7 py-4 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center gap-2">Full Specification <x-icon name="arrow-right" class="w-4 h-4" /></button>
              <a @spa href="/product/{{ $fp['slug'] }}" class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] hover:text-[#9a7b4f] font-semibold transition-colors">Full Details &rarr;</a>
              
            </div>
          </div>
          <div class="lg:col-span-7 relative min-h-[280px] lg:min-h-[460px] order-1 {{ $loop->odd ? 'lg:order-2' : 'lg:order-1' }}">
            <img src="{{ $fp['heroImage'] }}" alt="{{ $fp['name'] }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">{{ $fp['modelCode'] }}</span>
          </div>
        </div>
        @endforeach
        {{-- Legacy hardcoded showcase (Aster/Nova/Koto/Sloane) disabled — featured loop above is DB-driven. Safe to delete this @if(false) block. --}}
        @if(false)
        <!-- Aster -->
        <div class="featured-card group grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="homes">
          <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-center space-y-4 relative order-2 lg:order-1">
            <button onclick="enquireProduct('hs-exp-01')" title="Save to portfolio" class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-[#e5e2da] bg-white text-[#6b7280] hover:text-[#9a7b4f] hover:border-[#9a7b4f] flex items-center justify-center transition-all">
              <x-icon name="bookmark" class="w-4 h-4" />
            </button>
            <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">Expandable Homes &middot; Dual-Wing Architecture</span>
            <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold leading-tight">The Aster Expandable Modular Villa</h3>
            <p class="text-sm text-[#9a7b4f] font-semibold">Patented bi-fold chassis &amp; turnkey monocoque architecture</p>
            <p class="text-sm text-[#374151] leading-relaxed">Completely pre-plumbed and pre-wired for permanent residential use under UK Caravan Sites Act dimensions. Unfolds from a road-legal pod into a 415 sq ft residence in minutes.</p>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#f0ede6]">
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Dimensions</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">38.5 m&sup2; (415 sq ft)</span></div>
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Primary Material</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">Galvanized Steel Chassis</span></div>
            </div>
            <div>
              <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] mb-2">Finishes (3)</span>
              <div class="flex gap-2">
                <span class="w-6 h-6 rounded-full bg-[#2d3139] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#a3683a] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#d7c4aa] border border-black/10 shadow-sm"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-wrap items-center gap-5">
              <button onclick="enquireProduct('hs-exp-01')" class="px-7 py-4 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center gap-2">Full Specification <x-icon name="arrow-right" class="w-4 h-4" /></button>
              <a @spa href="/product/hs-exp-01" class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] hover:text-[#9a7b4f] font-semibold transition-colors">Full Details &rarr;</a>
              <span class="text-[11px] font-mono text-[#6b7280] leading-relaxed">Lead time: 8 to 10 weeks<br />from sign-off of survey</span>
            </div>
          </div>
          <div class="lg:col-span-7 relative min-h-[280px] lg:min-h-[460px] order-1 lg:order-2">
            <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=1200&q=85" alt="The Aster Expandable Modular Villa" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">HS-EXP-38/AST</span>
          </div>
        </div>
        <!-- Nova -->
        <div class="featured-card group grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="homes">
          <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-center space-y-4 relative order-2 lg:order-1">
            <button onclick="enquireProduct('hs-exp-03')" title="Save to portfolio" class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-[#e5e2da] bg-white text-[#6b7280] hover:text-[#9a7b4f] hover:border-[#9a7b4f] flex items-center justify-center transition-all">
              <x-icon name="bookmark" class="w-4 h-4" />
            </button>
            <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">Expandable Homes &middot; Flagship Residence</span>
            <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold leading-tight">The Nova Grand Expandable Estate</h3>
            <p class="text-sm text-[#9a7b4f] font-semibold">Dual-wing 3-bedroom residence with cantilever deck</p>
            <p class="text-sm text-[#374151] leading-relaxed">74 m&sup2; of permanent dwelling quality with a full architectural kitchen, master ensuite and secondary wetroom. Our most generous turnkey footprint.</p>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#f0ede6]">
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Dimensions</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">74 m&sup2; (796 sq ft)</span></div>
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Primary Material</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">Thermowood Cladding</span></div>
            </div>
            <div>
              <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] mb-2">Finishes (4)</span>
              <div class="flex gap-2">
                <span class="w-6 h-6 rounded-full bg-[#2d3139] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#8a6f4d] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#d7c4aa] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#5b6570] border border-black/10 shadow-sm"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-wrap items-center gap-5">
              <button onclick="enquireProduct('hs-exp-03')" class="px-7 py-4 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center gap-2">Full Specification <x-icon name="arrow-right" class="w-4 h-4" /></button>
              <a @spa href="/product/hs-exp-03" class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] hover:text-[#9a7b4f] font-semibold transition-colors">Full Details &rarr;</a>
              <span class="text-[11px] font-mono text-[#6b7280] leading-relaxed">Lead time: 8 to 12 weeks<br />from sign-off of survey</span>
            </div>
          </div>
          <div class="lg:col-span-7 relative min-h-[280px] lg:min-h-[460px] order-1 lg:order-2">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=85" alt="The Nova Grand Expandable Estate" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">HS-EXP-74/NOV</span>
          </div>
        </div>
        <!-- Koto -->
        <div class="featured-card group grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="homes">
          <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-center space-y-4 relative order-2 lg:order-2">
            <button onclick="enquireProduct('hs-exp-02')" title="Save to portfolio" class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-[#e5e2da] bg-white text-[#6b7280] hover:text-[#9a7b4f] hover:border-[#9a7b4f] flex items-center justify-center transition-all">
              <x-icon name="bookmark" class="w-4 h-4" />
            </button>
            <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">Expandable Homes &middot; Compact Studio</span>
            <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold leading-tight">The Koto Studio Expandable Pod</h3>
            <p class="text-sm text-[#9a7b4f] font-semibold">Single-wing studio for work, retreat &amp; hospitality</p>
            <p class="text-sm text-[#374151] leading-relaxed">A compact garden pod with high-density acoustic insulation, made for remote work, guest stays and eco-hospitality sites of every scale.</p>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#f0ede6]">
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Dimensions</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">18.5 m&sup2; (199 sq ft)</span></div>
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Primary Material</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">Charred Timber &amp; Aluminium</span></div>
            </div>
            <div>
              <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] mb-2">Finishes (4)</span>
              <div class="flex gap-2">
                <span class="w-6 h-6 rounded-full bg-[#1a1d24] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#6b5d4f] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#c9bfae] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#4b5563] border border-black/10 shadow-sm"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-wrap items-center gap-5">
              <button onclick="enquireProduct('hs-exp-02')" class="px-7 py-4 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center gap-2">Full Specification <x-icon name="arrow-right" class="w-4 h-4" /></button>
              <a @spa href="/product/hs-exp-02" class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] hover:text-[#9a7b4f] font-semibold transition-colors">Full Details &rarr;</a>
              <span class="text-[11px] font-mono text-[#6b7280] leading-relaxed">Lead time: 6 to 8 weeks<br />from sign-off of survey</span>
            </div>
          </div>
          <div class="lg:col-span-7 relative min-h-[280px] lg:min-h-[460px] order-1 lg:order-1">
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=85" alt="The Koto Studio Expandable Pod" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">HS-EXP-18/KOT</span>
          </div>
        </div>
        <!-- Sloane -->
        <div class="featured-card group grid grid-cols-1 lg:grid-cols-12 items-stretch bg-white rounded-2xl border border-[#e5e2da] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-cat="interiors">
          <div class="lg:col-span-5 p-6 sm:p-10 flex flex-col justify-center space-y-4 relative order-2 lg:order-1">
            <button onclick="enquireProduct('hs-ktc-01')" title="Save to portfolio" class="absolute top-5 right-5 w-9 h-9 rounded-lg border border-[#e5e2da] bg-white text-[#6b7280] hover:text-[#9a7b4f] hover:border-[#9a7b4f] flex items-center justify-center transition-all">
              <x-icon name="bookmark" class="w-4 h-4" />
            </button>
            <span class="text-[11px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold">Kitchen &middot; Minimalist Architectural</span>
            <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold leading-tight">The Sloane Kitchen Suite</h3>
            <p class="text-sm text-[#9a7b4f] font-semibold">Monolithic Honed Grigio Carnico &amp; Smoked English Oak</p>
            <p class="text-sm text-[#374151] leading-relaxed">A sculptural centrepiece conceived for London townhouses and contemporary rural estates. The Sloane Suite pairs the geological drama of Italian Grigio Carnico marble with the warmth of quarter-sawn smoked English oak.</p>
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-[#f0ede6]">
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Dimensions</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">3800mm (Standard Modular)</span></div>
              <div><span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280]">Primary Material</span><span class="block text-sm font-semibold text-[#1a1d24] mt-0.5">Grigio Carnico Marble</span></div>
            </div>
            <div>
              <span class="block text-[10px] font-mono uppercase tracking-widest text-[#6b7280] mb-2">Finishes (4)</span>
              <div class="flex gap-2">
                <span class="w-6 h-6 rounded-full bg-[#1a1d24] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#d8d4c7] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#5A4636] border border-black/10 shadow-sm"></span>
                <span class="w-6 h-6 rounded-full bg-[#CBB296] border border-black/10 shadow-sm"></span>
              </div>
            </div>
            <div class="pt-2 flex flex-wrap items-center gap-5">
              <button onclick="enquireProduct('hs-ktc-01')" class="px-7 py-4 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.18em] transition-all inline-flex items-center gap-2">Full Specification <x-icon name="arrow-right" class="w-4 h-4" /></button>
              <a @spa href="/product/hs-ktc-01" class="text-[11px] font-mono uppercase tracking-wider text-[#6b7280] hover:text-[#9a7b4f] font-semibold transition-colors">Full Details &rarr;</a>
              <span class="text-[11px] font-mono text-[#6b7280] leading-relaxed">Lead time: 10 to 14 weeks<br />from sign-off of architectural survey</span>
            </div>
          </div>
          <div class="lg:col-span-7 relative min-h-[280px] lg:min-h-[460px] order-1 lg:order-2">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85" alt="The Sloane Kitchen Suite" loading="lazy" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            <span class="absolute top-4 left-4 px-2.5 py-1 bg-white/90 backdrop-blur text-[10px] font-mono rounded shadow">HS-KTC-01/SLN</span>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>
  @endif

  <section id="faq-section" class="py-20 md:py-28 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-[#e5e2da] text-[#9a7b4f] text-[11px] font-mono font-semibold uppercase tracking-[0.2em] mb-4 shadow-xs">
          <x-icon name="help-circle" class="w-3.5 h-3.5" />
          <span>UK Import &amp; Factory Build Knowledge Base</span>
        </div>
        <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#1a1d24] font-semibold tracking-tight mb-3">
          Frequently Asked Questions
        </h2>
        <p class="text-sm sm:text-[15px] text-[#374151] max-w-2xl mx-auto leading-relaxed">Everything you need to know about purchasing, customizing, shipping, and installing your expandable modular building in the United Kingdom.</p>
      </div>

      <!-- Topic Pills -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
        <button onclick="filterFaq('all', this)" class="faq-topic-pill px-5 py-2.5 rounded-full bg-[#181b20] text-white text-[13px] font-semibold border border-[#181b20] transition-all">All Topics ({{ count($faqsJson) }})</button>
        @forelse($faqCatsJson as $fcSlug => $fcLabel)
          <button onclick="filterFaq({{ json_encode($fcSlug) }}, this)" class="faq-topic-pill px-5 py-2.5 rounded-full bg-white border border-[#e5e2da] text-[#6b7280] text-[13px] font-semibold hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all">{{ $fcLabel }} ({{ collect($faqsJson)->where('cat', $fcSlug)->count() }})</button>
        @empty
          <button onclick="filterFaq('times', this)" class="faq-topic-pill px-5 py-2.5 rounded-full bg-white border border-[#e5e2da] text-[#6b7280] text-[13px] font-semibold hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all">Lead Times &amp; Pricing</button>
          <button onclick="filterFaq('specs', this)" class="faq-topic-pill px-5 py-2.5 rounded-full bg-white border border-[#e5e2da] text-[#6b7280] text-[13px] font-semibold hover:text-[#9a7b4f] hover:border-[#9a7b4f] transition-all">Custom Factory Specs</button>
        @endforelse
      </div>

      <!-- FAQ Accordion (server-rendered; JS only toggles) -->
      <div class="space-y-3" id="faq-accordion-container">
        @forelse($faqsJson as $fi => $faq)
          <div class="faq-item bg-white rounded-xl border {{ $fi === 0 ? 'border-[#9a7b4f] ring-1 ring-[#9a7b4f]/40 shadow-md' : 'border-[#e5e2da]' }} overflow-hidden transition-all" data-cat="{{ $faq['cat'] }}">
            <button type="button" onclick="toggleFaq(this)" class="w-full p-5 sm:p-6 text-left flex items-start justify-between gap-4">
              <div>
                <span class="text-[10px] font-mono uppercase tracking-[0.18em] text-[#9a7b4f] font-bold block mb-1.5">{{ $faqCatsJson[$faq['cat']] ?? $faq['badge'] }}</span>
                <span class="font-serif text-lg sm:text-xl text-[#1a1d24] font-semibold leading-snug block">{{ $faq['q'] }}</span>
              </div>
              <span class="faq-chevron w-8 h-8 shrink-0 rounded-full border {{ $fi === 0 ? 'border-[#9a7b4f] text-[#9a7b4f]' : 'border-[#e5e2da] text-[#6b7280]' }} flex items-center justify-center transition-all">
                <x-icon name="chevron-down" class="w-4 h-4 {{ $fi === 0 ? 'rotate-180' : '' }}" />
              </span>
            </button>
            <div class="faq-answer {{ $fi === 0 ? '' : 'hidden' }} mx-5 sm:mx-6 mb-5 sm:mb-6 pt-4 border-t border-[#f0ede6] text-sm text-[#374151] leading-relaxed">{{ $faq['a'] }}</div>
          </div>
        @empty
          <p class="text-center text-sm text-[#6b7280] py-8">FAQs are being compiled — ask the studio directly.</p>
        @endforelse
      </div>

      <!-- FAQ Help CTA Card -->
      <div class="mt-10 p-6 bg-white rounded-2xl border border-[#e5e2da] flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
          <span class="font-serif text-lg font-semibold text-[#1a1d24] block">Have a specific bespoke site requirement?</span>
          <span class="text-xs text-[#6b7280]">Our UK architectural technical team provides site feasibility reviews within 24 hours.</span>
        </div>
        <a @spa href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-wider transition-all whitespace-nowrap">
          <x-icon name="message-circle" class="w-4 h-4" />
          <span>Talk to Us</span>
        </a>
      </div>
    </div>
  </section>

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
  
@endsection
@section('script')
<script>
    var APPLICATIONS = {
      annex: {
        id: 'annex',
        title: 'Residential Garden Annex',
        badge: 'Modular Annex — Verify Planning Locally',
        desc: 'Purpose-engineered as a self-contained auxiliary dwelling for elderly relatives, adult children, or guests. Verify dimensions and planning requirements with your local authority before installation.',
        dims: '5.9m &times; 6.3m (37m&sup2;) &bull; 1 Bed + Ensuite',
        price: 'Pricing available on request',
        turnaround: 'Lead time available on request',
        img: 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
        eyebrow: 'Garden Extension — Confirm Specifications',
        imgTag: 'Residential & Family',
        imgCaption: 'House Extension & Garden Annex',
        imgSub: 'Unfolds & levels in under 15 mins',
        headline: 'A Luxury 1-2 Bed Self-Contained Home on Your Garden Plot',
        reg: 'Planning and building-regulation requirements vary by site; confirm with your local authority.',
        configLabel: 'Configure House Extension Spec',
        features: [
          'Pre-fitted ensuite with walk-in shower & dual-flush WC',
          'Kitchenette with induction hob & sink',
          'Consumer unit with RCBO breakers',
          'Modular design for flexible installation'
        ]
      },
      office: {
        id: 'office',
        title: 'Executive Garden Studio & Creative Office',
        badge: 'Zero Commute &bull; Acoustic Soundproofed',
        desc: 'High-performance workspace featuring 100mm acoustic wall panels, concealed data conduits, climate inverter heat pump, and panoramic bi-fold glazing overlooking your garden landscape.',
        dims: '5.9m &times; 6.3m (37m&sup2;) &bull; Open-Plan Executive Studio',
        price: 'Pricing available on request',
        turnaround: 'Lead time available on request',
        img: 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1200&q=80',
        eyebrow: 'Acoustic Workspace & Home Office Ready',
        imgTag: 'Work & Wellness',
        imgCaption: 'Executive Garden Studio',
        imgSub: 'Silent, connected, all-season comfort',
        headline: 'A Soundproofed Studio Office Steps From Your Back Door',
        reg: 'Planning rules vary by site; confirm permitted-development status and height restrictions with your local planning authority.',
        configLabel: 'Configure Garden Office Spec',
        features: [
          'Rockwool internal acoustic soundproofing rating',
          'Pre-wired Cat6 Ethernet network sockets',
          'Split-system whisper-quiet heating & cooling heat pump',
          'Floor-to-ceiling double-glazed aluminium patio doors'
        ]
      },
      cafe: {
        id: 'cafe',
        title: 'Commercial Drive-Thru & Parkside Coffee Shop',
        badge: 'Commercial Hospitality — Confirm Licensing',
        desc: 'Turnkey food and beverage unit engineered with hydraulic gas-strut awning serving windows, commercial washable hygiene wall panels, 32A 3-phase electrical prep, and stainless prep counters.',
        dims: '5.9m &times; 6.3m (37m&sup2;) or 9.0m &times; 6.3m (56m&sup2;)',
        price: 'Pricing available on request',
        turnaround: 'Lead time available on request',
        img: 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80',
        eyebrow: 'High-Street & Hospitality Ready',
        imgTag: 'Commercial & Retail',
        imgCaption: 'Coffee Shop & Bakery Pod',
        imgSub: 'Serving hatch live in 48 hours',
        headline: 'Turn Unused Commercial Land into a Thriving Cafe in 48 Hours',
        reg: 'Food-service licensing, planning and building regulations apply; verify with your local authority and environmental health before installation.',
        configLabel: 'Configure Coffee Pod Spec',
        features: [
          'Integrated fold-up commercial serving hatch counter',
          'Heavy-duty non-slip food-grade vinyl flooring',
          'High-capacity grease trap & water heater prep',
          'Fast setup on parking bays or temporary event ground'
        ]
      },
      glamping: {
        id: 'glamping',
        title: 'Luxury Boutique Glamping & Eco-Tourism Pod',
        badge: 'High ADR Tourism &bull; 4-Season Climate',
        desc: 'Designed for farm diversification, country estates, and holiday parks. Delivers luxury hotel-grade guest experience with ensuite bathroom, stargazing skylights, and cedar cladding.',
        dims: '9.0m &times; 6.3m (56m&sup2;) &bull; 2 Beds + Kitchenette',
        price: 'Pricing available on request',
        turnaround: 'Lead time available on request',
        img: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
        eyebrow: 'Tourism & Holiday Park Ready',
        imgTag: 'Leisure & Escape',
        imgCaption: 'Boutique Holiday Home',
        imgSub: '4-season comfort, hotel-grade suites',
        headline: 'A Boutique Holiday Home That Pays for Itself in Bookings',
        reg: 'Site licensing and planning rules vary; confirm with the local planning authority and site operator before installation.',
        configLabel: 'Configure Holiday Home Spec',
        features: [
          'Insulated construction for year-round comfort',
          'Hotel-grade master bedroom with freestanding bathtub prep',
          'Keyless smart door lock system & keycard integration',
          'Integrated exterior architectural accent LED lighting'
        ]
      },
      retail: {
        id: 'retail',
        title: 'Retail Pop-Up, Showroom & Ticket Pavilion',
        badge: 'Relocatable &bull; High Footfall',
        desc: 'Mobile commercial showroom designed for brand activations, exhibition spaces, estate agency sales suites, and festival retail points that can be relocated via flatbed at any time.',
        dims: '5.9m &times; 6.3m (37m&sup2;) &bull; Full Glass Frontage',
        price: 'Pricing available on request',
        turnaround: 'Lead time available on request',
        img: 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&w=1200&q=80',
        eyebrow: 'Brand & High-Footfall Ready',
        imgTag: 'Pop-Up & Showcase',
        imgCaption: 'Retail Salon & Brand Pavilion',
        imgSub: 'Relocatable by flatbed anytime',
        headline: 'A Flagship Retail Salon That Moves With the Crowd',
        reg: 'Temporary-use and relocation rules vary by site; confirm with the local planning authority.',
        configLabel: 'Configure Retail Pod Spec',
        features: [
          'Full-width tempered bi-fold glass commercial display',
          'Concealed overhead track lighting & signage conduits',
          'Secure three-point deadbolt locking doors',
          'Can be folded, craned, and transported to new venue'
        ]
      }
    };

    var CONFIG_USE_CASES = [
      { id: 'annex', name: 'Residential Garden Annex', tag: 'Check Planning Requirements' },
      { id: 'cafe', name: 'Commercial Coffee Shop / Food Kiosk', tag: 'Flip-Up Serving Hatch' },
      { id: 'office', name: 'Acoustic Garden Workspace', tag: 'Soundproof & Cat6' },
      { id: 'glamping', name: 'Luxury Holiday Glamping Suite', tag: 'Confirm Site Licensing' },
      { id: 'retail', name: 'Retail Pop-Up / Brand Pavilion', tag: 'Full Glass Front' }
    ];

    var CONFIG_SIZES = [
      { id: '20ft-compact', name: '20ft Compact Studio', area: '37 m²', dims: '5.9m × 6.3m', basePrice: 'On request' },
      { id: '20ft-bifold', name: '20ft Bi-Fold Extended', area: '42 m²', dims: '5.9m × 7.2m', basePrice: 'On request' },
      { id: '30ft-bifold', name: '30ft Sanctuary Bi-Fold', area: '56 m²', dims: '9.0m × 6.3m', basePrice: 'On request' },
      { id: '40ft-trifold', name: '40ft Tri-Fold Residence', area: '74 m²', dims: '11.8m × 6.3m', basePrice: 'On request' }
    ];

    var CONFIG_INSULATION = [
      { id: 'uk-part-l-100mm', name: '100mm PIR Core (Insulated Construction)', rating: 'U ≤ 0.18 W/m²K &bull; Energy Efficient' },
      { id: 'rockwool-noncombustible', name: '100mm Rockwool (A1 Non-Combustible)', rating: 'Fire-rated insulation &bull; Acoustic dampening' }
    ];

    var CONFIG_FACADES = [
      { id: 'charcoal-composite', name: 'Charcoal Slatted Composite', desc: 'Anthracite contemporary look' },
      { id: 'natural-cedar', name: 'Natural Western Red Cedar', desc: 'Architectural luxury timber' },
      { id: 'textured-sandstone', name: 'Textured Sandstone Panel', desc: 'Mineral aesthetic' }
    ];

    var CONFIG_ADDONS = [
      { id: 'ensuite-bathroom', label: 'Factory Pre-Fitted Ensuite with Shower, Vanity & Dual-Flush WC' },
      { id: 'fitted-kitchenette', label: 'Turnkey Kitchenette / Bar Counter with Sink & Induction' },
      { id: 'uk-consumer-unit', label: 'UK Consumer Unit with RCBO Circuit Breakers' },
      { id: 'inverter-heatpump', label: 'Split-System Heat Pump AC (Whisper-Quiet Heating & Cooling)' },
      { id: 'solar-prep', label: 'Pre-Wired Roof Solar PV Conduits & Inverter Ready' },
      { id: 'acoustic-lining', label: 'Extra Acoustic Rockwool Internal Soundproofing' }
    ];

    var CONFIG_DELIVERY = [
      {
        id: 'warehouse-hiab',
        name: 'Direct UK Site Delivery with Hiab Crane Offload',
        badge: 'Most Popular',
        desc: 'Dispatched directly from our UK central warehouse to your property or plot. Our rigid flatbed truck with on-board hydraulic Hiab crane offloads and positions the unit onto your prepared foundation pads or ground screws.',
        dispatch: 'Dispatched from UK Central Warehouse'
      },
      {
        id: 'turnkey-installation',
        name: 'Full White-Glove Warehouse Delivery',
        badge: 'White-Glove',
        desc: 'Delivery, crane offloading and unfolding assistance included; installation and utility connections remain the customer\'s responsibility and must be arranged separately.',
        dispatch: 'UK Warehouse + On-Site Crew'
      },
      {
        id: 'depot-collection',
        name: 'Client / Haulier Collection from UK Warehouse Depot',
        badge: 'Ex-Warehouse',
        desc: 'Arrange your own haulage or collection directly from our central UK logistics hub. Overhead gantry crane loading onto your transport vehicle is provided free of charge by our depot crew.',
        dispatch: 'Collect at UK Logistics Depot'
      }
    ];

    var FAQS = @json($faqsJson);

    var configState = {
      step: 1,
      useCase: 'annex',
      modelSize: '30ft-bifold',
      insulation: 'uk-part-l-100mm',
      facade: 'charcoal-composite',
      addons: ['ensuite-bathroom', 'uk-consumer-unit', 'fitted-kitchenette'],
      delivery: 'warehouse-hiab',
      postcode: ''
    };

    // Page init runs at the end of this script (see bottom): it must execute
    // on hard load AND on every SPA injection, where DOMContentLoaded never fires.

    function selectApplication(appId) {
      document.querySelectorAll('.app-tab-btn').forEach(btn => {
        btn.classList.remove('bg-[#181b20]', 'text-white', 'border-[#181b20]');
        btn.classList.add('bg-white', 'text-[#374151]', 'border-[#e5e2da]');
      });
      const activeBtn = document.getElementById('app-tab-' + appId);
      if (activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-[#374151]', 'border-[#e5e2da]');
        activeBtn.classList.add('bg-[#181b20]', 'text-white', 'border-[#181b20]');
      }
      renderApplicationShowcase(appId);
    }

    function renderApplicationShowcase(appId) {
      const data = APPLICATIONS[appId] || APPLICATIONS.annex;
      const container = document.getElementById('application-content');
      container.innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2">
          <div class="relative min-h-[280px] lg:min-h-[480px]">
            <img src="${data.img}" alt="${data.title}" class="absolute inset-0 w-full h-full object-cover" />
            <span class="absolute top-4 left-4 bg-[#181b20]/80 backdrop-blur-md text-white font-mono text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full font-semibold">
              ${(data.imgTag || data.title).toUpperCase()}
            </span>
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#181b20]/85 via-[#181b20]/30 to-transparent p-5 pt-12">
              <span class="text-[10px] font-mono uppercase tracking-widest text-[#c5a880] font-semibold block">${(data.imgSub || data.dims).toUpperCase()}</span>
              <span class="font-serif text-lg text-white font-semibold block">${data.imgCaption || data.title}</span>
            </div>
          </div>

          <div class="p-6 sm:p-9 space-y-4">
            <span class="text-[11px] uppercase font-mono tracking-[0.2em] text-[#9a7b4f] font-semibold block">
              ${(data.eyebrow || data.badge).toUpperCase()}
            </span>
            <h3 class="font-serif text-2xl sm:text-[28px] text-[#1a1d24] font-semibold leading-snug">${data.headline || data.title}</h3>
            <p class="text-sm text-[#374151] leading-relaxed">${data.desc}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2.5 pt-1">
              ${data.features.map(f => `
                <div class="flex items-start gap-2 text-[13px] text-[#374151]">
                  <x-icon name="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" />
                  <span>${f}</span>
                </div>
              `).join('')}
            </div>

            <div class="bg-[#FAF8F5] border border-[#e5e2da] rounded-xl p-4 text-[13px] text-[#374151] leading-relaxed">
              <span class="font-semibold text-[#1a1d24]">UK Regulatory Note: </span>${(data.reg || '').replace(/^UK Regulatory Note:\s*/i, '')}
            </div>

            <div class="pt-1 flex flex-wrap items-center gap-4">
              <button onclick="preSelectConfigUseCase('${appId}')" class="px-6 py-3.5 rounded-lg bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-[0.14em] transition-all shadow-xs">
                ${data.configLabel || 'Configure This Spec'}
              </button>
              <button onclick="window.location.href='/collections'" class="text-xs font-mono uppercase tracking-[0.14em] text-[#374151] hover:text-[#9a7b4f] font-semibold transition-colors">
                Explore the collections &rarr;
              </button>
            </div>
          </div>
        </div>
      `;
      if (window.lucide) lucide.createIcons();
    }

    var SPACES = {
      kensington: {
        name: 'The Kensington Townhouse',
        loc: 'London SW7 &middot; United Kingdom &middot; Victorian Restoration + Contemporary Extension',
        desc: 'A sensitive five-storey heritage restoration marrying Grade II listed plaster mouldings with a dramatic double-height kitchen pavilion paved in vein-matched Grigio Carnico marble.',
        img: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=85',
        product: 'The Sloane Kitchen Suite',
        material: 'Monolithic Honed Grigio Carnico & Smoked Oak',
        pins: [
          { top: '36%', left: '28%', product: 'hs-ktc-01', label: 'Kitchen suite' },
          { top: '52%', left: '64%', product: 'hs-lgt-03', label: 'Lighting' }
        ]
      },
      cotswolds: {
        name: 'The Cotswolds Stone Barn',
        loc: 'Cotswolds &middot; England &middot; Barn Conversion + Garden Annexe Pair',
        desc: 'A weathered stone barn given a second life with twin garden sanctuaries in cedar and glass, set for multi-generational living and boutique guest stays.',
        img: 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=1600&q=85',
        product: 'The Aster Expandable Modular Villa',
        material: 'Cedar Cladding & Low-E Argon Glazing',
        pins: [
          { top: '40%', left: '34%', product: 'hs-exp-01', label: 'Expandable villa' },
          { top: '58%', left: '60%', product: 'hs-jnr-04', label: 'Joinery suite' }
        ]
      },
      bath: {
        name: 'The New Town Bath Pavilion',
        loc: 'Edinburgh New Town &middot; Scotland &middot; Georgian Spa Extension',
        desc: 'A light-washed wellness pavilion behind a Georgian terrace, pairing sculptural stone monoliths with brushed brass fittings and warm-dim alabaster light.',
        img: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=1600&q=85',
        product: 'Sanctuary & Bath Collection',
        material: 'Travertine Monoliths & Unlacquered Brass',
        pins: [
          { top: '38%', left: '30%', product: 'hs-bth-02', label: 'Bath suite' },
          { top: '55%', left: '66%', product: 'hs-hrd-05', label: 'Brassware' }
        ]
      }
    };

    function selectSpace(spaceId) {
      document.querySelectorAll('.space-pill').forEach(p => {
        p.classList.remove('bg-[#181b20]', 'text-white', 'border-[#181b20]');
        p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
      });
      const active = document.getElementById('space-pill-' + spaceId);
      if (active) {
        active.classList.remove('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
        active.classList.add('bg-[#181b20]', 'text-white', 'border', 'border-[#181b20]');
      }
      renderSpace(spaceId);
    }

    function renderSpace(spaceId) {
      const d = SPACES[spaceId] || SPACES.kensington;
      const container = document.getElementById('space-showcase');
      if (!container) return;
      container.innerHTML = `
        <div class="relative rounded-2xl overflow-hidden border border-[#e5e2da] shadow-lg">
          <img src="${d.img}" alt="${d.name}" loading="lazy" class="w-full aspect-[21/9] object-cover min-h-[320px]" />
          ${d.pins.map(p => `
            <button onclick="openProductDetailModal('${p.product}')" title="${p.label}" class="absolute z-10" style="top:${p.top};left:${p.left}">
              <span class="relative flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#9a7b4f] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-[#9a7b4f] border-2 border-white shadow"></span>
              </span>
            </button>`).join('')}
          <div class="absolute top-1/3 left-1/2 -translate-x-1/2 bg-white rounded-lg shadow-xl p-3 max-w-[240px] text-xs hidden sm:block">
            <div class="flex items-start gap-2">
              <img src="${d.img.replace('w=1600', 'w=200')}" class="w-12 h-10 object-cover rounded" alt="" />
              <div>
                <div class="font-semibold text-[#1a1d24]">Featured in Space</div>
                <div class="text-[#6b7280]">${d.product}</div>
                <div class="text-[#9a7b4f] font-mono text-[10px] mt-1">${d.material.slice(0, 34)}...</div>
                <button onclick="enquireProduct('${d.product.replace(/'/g, "\\'")}')" class="mt-2 text-[#9a7b4f] font-semibold hover:underline">Explore Product &rarr;</button>
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/70 to-transparent text-white">
            <div class="text-[10px] font-mono uppercase tracking-wider opacity-80 mb-1">${d.loc}</div>
            <h3 class="font-serif text-2xl sm:text-3xl font-semibold">${d.name}</h3>
            <p class="text-sm opacity-90 mt-1 max-w-xl">${d.desc}</p>
          </div>
        </div>`;
      if (window.lucide) lucide.createIcons();
    }

    function preSelectConfigUseCase(ucId) {
      configState.useCase = ucId;
      renderConfiguratorOptions();
      updateLiveBill();
      goToConfigStep(2);
      const target = document.getElementById('custom-build-section');
      if (target) target.scrollIntoView({ behavior: 'smooth' });
    }

    var MATERIALS = {
      stone: {
        origin: 'Friuli-Venezia Giulia, Northern Italy',
        name: 'Grigio Carnico Marble',
        tagline: 'Vein-matched monoliths with alpine weight.',
        desc: 'Quarried in the Italian Alps, each Grigio Carnico slab is vein-matched across monolithic islands and vanities for unbroken geological flow.',
        tactile: 'Cool honed density, crisp mitred edges, deep grey veining.',
        env: 'Stone offcuts reclaimed; water-only finishing with zero resins.',
        img: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=85'
      },
      oak: {
        origin: 'Wiltshire & Hampshire Woodlands, UK',
        name: 'Quarter-Sawn English Smoked Oak',
        tagline: 'Fumed timber with medullary ray figure.',
        desc: 'Slow-grown English oak, quarter-sawn for stability and fumed to a deep smoked tone, finished in hard-wax oil for a living, repairable surface.',
        tactile: 'Silked grain, warm brown depth, waxed hand-feel.',
        env: 'FSC-certified UK woodlands; offcuts reused across joinery.',
        img: 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85'
      },
      brass: {
        origin: 'West Midlands, England',
        name: 'Living Unlacquered Architectural Brass',
        tagline: 'Unlacquered brass that records every touch.',
        desc: 'Solid architectural brass, machined and hand-polished, left unlacquered to acquire a rich living patina unique to each household.',
        tactile: 'Weighty cool metal, softening edges, deepening tone.',
        env: 'Fully recyclable alloy with plastic-free packaging.',
        img: 'https://images.unsplash.com/photo-1558211553-d9326f10c561?auto=format&fit=crop&w=900&q=85'
      },
      glass: {
        origin: 'Cumbria, England',
        name: 'Borosilicate Fluted Optical Glass',
        tagline: 'Mouth-blown cylindrical prisms with calibrated refractive ridge geometry.',
        desc: 'Formulated with silica and boron trioxide for extreme thermal shock resistance and optical clarity; our glassblowers pull each fluted profile by hand using graphite shaping blocks.',
        tactile: 'Rhythmic vertical flute ribs, crisp cylindrical precision, crystal resonance.',
        env: 'Non-toxic, chemically inert, infinitely recyclable with zero plastic additives.',
        img: 'https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?auto=format&fit=crop&w=900&q=85'
      }
    };

    function selectMaterial(matId) {
      document.querySelectorAll('.material-btn').forEach(b => {
        b.classList.remove('border-[#9a7b4f]', 'ring-1', 'ring-[#9a7b4f]/30');
        b.classList.add('border-[#e5e2da]');
        const v = b.querySelector('.material-view');
        if (v) { v.classList.remove('text-[#9a7b4f]'); v.classList.add('text-[#6b7280]'); }
      });
      const active = document.getElementById('material-btn-' + matId);
      if (active) {
        active.classList.remove('border-[#e5e2da]');
        active.classList.add('border-[#9a7b4f]', 'ring-1', 'ring-[#9a7b4f]/30');
        const v = active.querySelector('.material-view');
        if (v) { v.classList.remove('text-[#6b7280]'); v.classList.add('text-[#9a7b4f]'); }
      }
      renderMaterial(matId);
    }

    function renderMaterial(matId) {
      const d = MATERIALS[matId] || MATERIALS.glass;
      const container = document.getElementById('material-detail');
      if (!container) return;
      container.innerHTML = `
        <div class="relative h-52 sm:h-60 shrink-0">
          <img src="${d.img}" alt="${d.name}" loading="lazy" class="absolute inset-0 w-full h-full object-cover" />
          <span class="absolute bottom-3 left-3 px-2.5 py-1 rounded bg-white/90 backdrop-blur text-[10px] font-mono uppercase tracking-wider shadow">Macro Detail</span>
        </div>
        <div class="p-5 sm:p-6 flex-1 min-h-0 lg:overflow-y-auto">
          <div class="text-[10px] font-mono uppercase tracking-[0.2em] text-[#9a7b4f] font-semibold mb-1.5">${d.origin}</div>
          <h3 class="font-serif text-2xl sm:text-3xl font-semibold text-[#1a1d24] leading-tight">${d.name}</h3>
          <p class="text-[13px] text-[#9a7b4f] font-semibold mt-2">${d.tagline}</p>
          <p class="text-sm text-[#374151] mt-2 leading-relaxed">${d.desc}</p>
          <div class="mt-5 pt-5 border-t border-[#f0ede6] grid grid-cols-2 gap-4 text-xs">
            <div>
              <div class="flex items-center gap-1.5 font-mono text-[10px] uppercase text-[#9a7b4f] font-semibold mb-1"><x-icon name="fingerprint" class="w-3.5 h-3.5" /> Tactile Characteristics</div>
              <p class="text-[#374151] leading-relaxed">${d.tactile}</p>
            </div>
            <div>
              <div class="flex items-center gap-1.5 font-mono text-[10px] uppercase text-[#9a7b4f] font-semibold mb-1"><x-icon name="leaf" class="w-3.5 h-3.5" /> Environmental Integrity</div>
              <p class="text-[#374151] leading-relaxed">${d.env}</p>
            </div>
          </div>
        </div>`;
      if (window.lucide) lucide.createIcons();
    }

    var FILES = @json($filesJson);
    var activeFileFormat = 'all';
    var fileSearch = '';

    function filterFiles(format, btn) {
      activeFileFormat = format;
      document.querySelectorAll('.file-format-pill').forEach(p => {
        p.classList.remove('bg-[#9a7b4f]/10', 'border-[#9a7b4f]/50', 'text-[#1a1d24]');
        p.classList.add('bg-[#FAF9F5]', 'border-[#e5e2da]', 'text-[#6b7280]');
      });
      if (btn) {
        btn.classList.remove('bg-[#FAF9F5]', 'border-[#e5e2da]', 'text-[#6b7280]');
        btn.classList.add('bg-[#9a7b4f]/10', 'border-[#9a7b4f]/50', 'text-[#1a1d24]');
      }
      renderFiles();
    }

    function handleFileSearch(val) {
      fileSearch = (val || '').toLowerCase().trim();
      renderFiles();
    }

    function renderFiles() {
      var list = document.getElementById('file-list');
      var count = document.getElementById('file-count');
      if (!list) return;
      var rows = document.querySelectorAll('#file-list .file-row');
      var shown = 0;
      rows.forEach(function (row) {
        var okFormat = (activeFileFormat === 'all' || row.getAttribute('data-format') === activeFileFormat);
        var hay = (row.getAttribute('data-search') || '');
        var okSearch = (!fileSearch || hay.indexOf(fileSearch) !== -1);
        var show = okFormat && okSearch;
        row.classList.toggle('hidden', !show);
        if (show) shown++;
      });
      if (count) count.textContent = shown;
      var empty = document.getElementById('file-empty');
      if (empty) empty.classList.toggle('hidden', shown !== 0);
    }

    function downloadFile(idx) {
      // Legacy request-file helper (rows without a real file link to contact instead).
      if (window.showToast) showToast('Request noted', 'Please use the contact page and the studio will issue the file.');
    }

    function filterTrust(cat, btn) {
      document.querySelectorAll('.trust-pill').forEach(p => {
        p.classList.remove('bg-[#181b20]', 'text-white', 'border-[#181b20]');
        p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
      });
      if (btn) {
        btn.classList.remove('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
        btn.classList.add('bg-[#181b20]', 'text-white', 'border', 'border-[#181b20]');
      }
      document.querySelectorAll('.trust-card').forEach(c => {
        c.classList.toggle('hidden', cat !== 'all' && c.getAttribute('data-cat') !== cat);
      });
    }

    function filterFeatured(cat, btn) {
      document.querySelectorAll('.featured-pill').forEach(p => {
        p.classList.remove('bg-[#181b20]', 'text-white');
        p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]');
      });
      if (btn) {
        btn.classList.remove('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]');
        btn.classList.add('bg-[#181b20]', 'text-white');
      }
      document.querySelectorAll('.featured-card').forEach(c => {
        c.classList.toggle('hidden', c.getAttribute('data-cat') !== cat);
      });
    }

    function filterModels(size) {
      document.querySelectorAll('.model-filter-btn').forEach(btn => {
        btn.classList.remove('bg-[#181b20]', 'text-white');
        btn.classList.add('bg-white', 'text-[#6b7280]', 'hover:text-[#9a7b4f]');
      });
      const activeBtn = document.getElementById('filter-btn-' + size);
      if (activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-[#6b7280]', 'hover:text-[#9a7b4f]');
        activeBtn.classList.add('bg-[#181b20]', 'text-white');
      }

      document.querySelectorAll('.model-card').forEach(card => {
        if (size === 'all' || card.getAttribute('data-size') === size) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    }

    function changeModelFinish(model, finish, imgUrl) {
      const img = document.getElementById('img-model-' + model);
      if (img) {
        img.src = imgUrl;
        showToast('Finish Updated', `Exterior finish set to ${finish.toUpperCase()}`);
      }
    }

    function goToConfigStep(stepNumber) {
      configState.step = stepNumber;
      for (let i = 1; i <= 4; i++) {
        const pane = document.getElementById('config-step-pane-' + i);
        const tab = document.getElementById('config-step-tab-' + i);
        if (pane && tab) {
          if (i === stepNumber) {
            pane.classList.remove('hidden');
            tab.classList.remove('text-[#6b7280]', 'hover:text-[#9a7b4f]');
            tab.classList.add('bg-[#181b20]', 'text-white');
          } else {
            pane.classList.add('hidden');
            tab.classList.remove('bg-[#181b20]', 'text-white');
            tab.classList.add('text-[#6b7280]', 'hover:text-[#9a7b4f]');
          }
        }
      }
    }

    function renderConfiguratorOptions() {
      const ucContainer = document.getElementById('config-usecase-options');
      if (ucContainer) {
        ucContainer.innerHTML = CONFIG_USE_CASES.map(uc => `
          <button 
            type="button"
            onclick="setConfigUseCase('${uc.id}')"
            class="p-4 rounded-xl border text-left transition-all flex items-start justify-between ${
              configState.useCase === uc.id 
                ? 'border-[#9a7b4f] bg-[#FAF9F5] ring-1 ring-[#9a7b4f]/40 font-semibold' 
                : 'border-[#e5e2da] bg-white hover:border-[#c8c3b7]'
            }"
          >
            <div>
              <span class="text-xs text-[#1a1d24] block">${uc.name}</span>
              <span class="text-[10px] font-mono text-[#9a7b4f] font-semibold">${uc.tag}</span>
            </div>
            <div class="w-4 h-4 rounded-full border mt-0.5 flex items-center justify-center ${
              configState.useCase === uc.id ? 'bg-[#9a7b4f] border-[#9a7b4f] text-white' : 'border-[#d1cece]'
            }">
              ${configState.useCase === uc.id ? '&bull;' : ''}
            </div>
          </button>
        `).join('');
      }

      const sizeContainer = document.getElementById('config-size-options');
      if (sizeContainer) {
        sizeContainer.innerHTML = CONFIG_SIZES.map(sz => `
          <button
            type="button"
            onclick="setConfigSize('${sz.id}')"
            class="w-full p-4 rounded-xl border text-left transition-all flex items-center justify-between ${
              configState.modelSize === sz.id
                ? 'border-[#9a7b4f] bg-[#FAF9F5] ring-1 ring-[#9a7b4f]/40'
                : 'border-[#e5e2da] bg-white hover:border-[#c8c3b7]'
            }"
          >
            <div>
              <div class="flex items-center gap-2">
                <strong class="text-xs sm:text-sm text-[#1a1d24]">${sz.name}</strong>
                <span class="text-[10px] font-mono text-[#9a7b4f] font-semibold bg-[#FAF9F5] px-2 py-0.5 rounded border border-[#9a7b4f]/30">${sz.area}</span>
              </div>
              <span class="text-[11px] text-[#6b7280] block mt-0.5">Footprint: ${sz.dims} &bull; Hydraulic Unfolding</span>
            </div>
            <div class="text-right">
              <span class="font-serif text-lg font-bold text-[#1a1d24]">${sz.basePrice}</span>
              <span class="text-[10px] text-[#6b7280] block font-mono">Factory Base</span>
            </div>
          </button>
        `).join('');
      }

      const insContainer = document.getElementById('config-insulation-options');
      if (insContainer) {
        insContainer.innerHTML = CONFIG_INSULATION.map(ins => `
          <button
            type="button"
            onclick="setConfigInsulation('${ins.id}')"
            class="p-3.5 rounded-xl border text-left transition-all ${
              configState.insulation === ins.id
                ? 'border-[#9a7b4f] bg-[#FAF9F5] font-semibold text-[#1a1d24]'
                : 'border-[#e5e2da] bg-white text-[#6b7280]'
            }"
          >
            <span class="text-xs text-[#1a1d24] block">${ins.name}</span>
            <span class="text-[11px] text-[#6b7280] block mt-1 leading-snug">${ins.rating}</span>
          </button>
        `).join('');
      }

      const facContainer = document.getElementById('config-facade-options');
      if (facContainer) {
        facContainer.innerHTML = CONFIG_FACADES.map(fc => `
          <button
            type="button"
            onclick="setConfigFacade('${fc.id}')"
            class="p-3.5 rounded-xl border text-left transition-all ${
              configState.facade === fc.id
                ? 'border-[#9a7b4f] bg-[#FAF9F5] font-semibold text-[#1a1d24]'
                : 'border-[#e5e2da] bg-white text-[#6b7280]'
            }"
          >
            <span class="text-xs text-[#1a1d24] block">${fc.name}</span>
            <span class="text-[11px] text-[#6b7280] block mt-1">${fc.desc}</span>
          </button>
        `).join('');
      }

      const addonsContainer = document.getElementById('config-addons-options');
      if (addonsContainer) {
        addonsContainer.innerHTML = CONFIG_ADDONS.map(ad => {
          const isChecked = configState.addons.includes(ad.id);
          return `
            <button
              type="button"
              onclick="toggleConfigAddon('${ad.id}')"
              class="p-3 rounded-xl border text-left transition-all flex items-start gap-2.5 ${
                isChecked
                  ? 'border-[#9a7b4f] bg-[#FAF9F5] text-[#1a1d24]'
                  : 'border-[#e5e2da] bg-white text-[#6b7280]'
              }"
            >
              <div class="w-4 h-4 rounded border mt-0.5 flex items-center justify-center shrink-0 ${
                isChecked ? 'bg-[#9a7b4f] border-[#9a7b4f] text-white' : 'border-[#d1cece]'
              }">
                ${isChecked ? '&check;' : ''}
              </div>
              <span class="text-xs leading-relaxed font-semibold">${ad.label}</span>
            </button>
          `;
        }).join('');
      }

      const deliveryContainer = document.getElementById('config-delivery-options');
      if (deliveryContainer) {
        deliveryContainer.innerHTML = CONFIG_DELIVERY.map(opt => `
          <button
            type="button"
            onclick="setConfigDelivery('${opt.id}')"
            class="w-full p-4 rounded-xl border text-left transition-all ${
              configState.delivery === opt.id
                ? 'border-[#9a7b4f] bg-[#FAF9F5] ring-1 ring-[#9a7b4f]/40 text-[#1a1d24]'
                : 'border-[#e5e2da] bg-white text-[#374151]'
            }"
          >
            <div class="flex items-start justify-between gap-3">
              <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="text-xs font-bold text-[#1a1d24]">${opt.name}</span>
                  <span class="text-[10px] font-mono uppercase px-2 py-0.5 rounded-full font-semibold ${
                    configState.delivery === opt.id ? 'bg-[#9a7b4f] text-white' : 'bg-[#f0ede6] text-[#6b7280]'
                  }">${opt.badge}</span>
                </div>
                <p class="text-[11px] text-[#6b7280] leading-relaxed">${opt.desc}</p>
                <span class="text-[10px] font-mono text-[#9a7b4f] font-semibold block">&bull; ${opt.dispatch}</span>
              </div>
              <div class="w-4 h-4 rounded-full border mt-1 shrink-0 flex items-center justify-center ${
                configState.delivery === opt.id ? 'bg-[#9a7b4f] border-[#9a7b4f] text-white' : 'border-[#d1cece]'
              }">
                ${configState.delivery === opt.id ? '&bull;' : ''}
              </div>
            </div>
          </button>
        `).join('');
      }
    }

    function setConfigUseCase(id) {
      configState.useCase = id;
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function setConfigSize(id) {
      configState.modelSize = id;
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function setConfigInsulation(id) {
      configState.insulation = id;
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function setConfigFacade(id) {
      configState.facade = id;
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function toggleConfigAddon(id) {
      if (configState.addons.includes(id)) {
        configState.addons = configState.addons.filter(a => a !== id);
      } else {
        configState.addons.push(id);
      }
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function setConfigDelivery(id) {
      configState.delivery = id;
      renderConfiguratorOptions();
      updateLiveBill();
    }

    function updateConfigPostcode(val) {
      configState.postcode = val;
      updateLiveBill();
    }

    function updateLiveBill() {
      const uc = CONFIG_USE_CASES.find(u => u.id === configState.useCase) || CONFIG_USE_CASES[0];
      const sz = CONFIG_SIZES.find(s => s.id === configState.modelSize) || CONFIG_SIZES[2];
      const del = CONFIG_DELIVERY.find(d => d.id === configState.delivery) || CONFIG_DELIVERY[0];

      document.getElementById('bill-usecase').textContent = uc.name.split(' (')[0];
      document.getElementById('bill-chassis').textContent = sz.name;
      document.getElementById('bill-area').textContent = sz.area;
      document.getElementById('bill-insulation').textContent = configState.insulation === 'uk-part-l-100mm' ? '100mm PIR (Part L)' : '100mm Rockwool (A1)';
      document.getElementById('bill-addons').textContent = `${configState.addons.length} Modules Pre-Fitted`;
      document.getElementById('bill-dispatch').textContent = del.name;
      document.getElementById('bill-price').textContent = sz.basePrice;

      const postcodeRow = document.getElementById('bill-postcode-row');
      const postcodeVal = document.getElementById('bill-postcode');
      if (configState.postcode && configState.postcode.trim() !== '') {
        postcodeRow.classList.remove('hidden');
        postcodeVal.textContent = configState.postcode.toUpperCase();
      } else {
        postcodeRow.classList.add('hidden');
      }
    }

    function submitConfiguratorEnquiry() {
      const uc = CONFIG_USE_CASES.find(u => u.id === configState.useCase) || CONFIG_USE_CASES[0];
      const sz = CONFIG_SIZES.find(s => s.id === configState.modelSize) || CONFIG_SIZES[2];
      const del = CONFIG_DELIVERY.find(d => d.id === configState.delivery) || CONFIG_DELIVERY[0];

      const summaryText = `Model: ${sz.name} (${sz.area}) | Use-Case: ${uc.name} | Insulation: ${configState.insulation} | Facade: ${configState.facade} | Fulfillment: Dispatched from UK Central Warehouse (${del.name}) | Base Guide: ${sz.basePrice}`;

      openEnquiryModal(`Custom Factory Order: ${uc.name}`, summaryText, configState.postcode);
    }

    var activeFaqCat = 'all';
    var FAQ_CATS = @json($faqCatsJson);

    function filterFaq(cat, btn) {
      activeFaqCat = cat;
      document.querySelectorAll('.faq-topic-pill').forEach(function (p) {
        p.classList.remove('bg-[#181b20]', 'text-white', 'border-[#181b20]');
        p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
      });
      if (btn) {
        btn.classList.remove('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]', 'hover:text-[#9a7b4f]', 'hover:border-[#9a7b4f]');
        btn.classList.add('bg-[#181b20]', 'text-white', 'border', 'border-[#181b20]');
      }
      // Server-rendered items; only toggle visibility, keep first visible open.
      var firstShown = null;
      document.querySelectorAll('#faq-accordion-container .faq-item').forEach(function (item) {
        var show = (activeFaqCat === 'all' || item.getAttribute('data-cat') === activeFaqCat);
        item.classList.toggle('hidden', !show);
        if (show && !firstShown) firstShown = item;
      });
      if (firstShown) setFaqOpen(firstShown, true);
    }

    function setFaqOpen(item, open) {
      var answer = item.querySelector('.faq-answer');
      var chev = item.querySelector('.faq-chevron');
      var icon = item.querySelector('.faq-chevron svg, .faq-chevron i');
      if (answer) answer.classList.toggle('hidden', !open);
      item.classList.toggle('border-[#9a7b4f]', open);
      item.classList.toggle('ring-1', open);
      item.classList.toggle('shadow-md', open);
      item.classList.toggle('border-[#e5e2da]', !open);
      if (chev) {
        chev.classList.toggle('border-[#9a7b4f]', open);
        chev.classList.toggle('text-[#9a7b4f]', open);
        chev.classList.toggle('border-[#e5e2da]', !open);
        chev.classList.toggle('text-[#6b7280]', !open);
      }
      if (icon) icon.classList.toggle('rotate-180', open);
    }

    function toggleFaq(btn) {
      var item = btn.closest('.faq-item');
      if (!item) return;
      var isOpen = !item.querySelector('.faq-answer').classList.contains('hidden');
      document.querySelectorAll('#faq-accordion-container .faq-item').forEach(function (other) {
        if (other !== item) setFaqOpen(other, false);
      });
      setFaqOpen(item, !isOpen);
    }

    // Bridge to the shared footer modal (real POST to enquiries inbox).
    function openEnquiryModal(title, summary, postcode) {
      if (postcode) {
        var pf = document.getElementById('enquiry-postcode');
        if (pf && !pf.value) pf.value = postcode;
      }
      var looksLikeConfig = typeof summary === 'string' && summary.indexOf('|') !== -1;
      window.__footerOpenEnquiry(title || 'Request Factory Quote & CAD Pack', null, looksLikeConfig ? summary : '');
    }

    var GALLERY = @json($galleryJson);
    var GALLERY_CATS = @json($galleryCatsJson);
    var activeGalleryCat = 'all';
    var galleryView = [];
    var galleryIdx = 0;

        function galleryThumb(g, size) {
      if (g.src) return g.src;
      return 'https://images.unsplash.com/' + g.id + '?auto=format&fit=crop&w=' + size + '&q=80';
    }

    function filterGallery(cat, btn) {
      activeGalleryCat = cat;
      document.querySelectorAll('.gallery-pill').forEach(p => {
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
        el.classList.toggle('hidden', !(activeGalleryCat === 'all' || el.getAttribute('data-cat') === activeGalleryCat));
      });
    }

    function openGallery(globalIdx) {
      galleryView = GALLERY.map((g, i) => ({ ...g, index: i })).filter(g => activeGalleryCat === 'all' || g.cat === activeGalleryCat);
      galleryIdx = Math.max(0, galleryView.findIndex(g => g.index === globalIdx));
      showGalleryItem();
      document.getElementById('lightbox-modal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function showGalleryItem() {
      const g = galleryView[galleryIdx];
      if (!g) return;
      document.getElementById('lightbox-img').src = galleryThumb(g, 1600);
      document.getElementById('lightbox-caption').textContent = g.caption;
      document.getElementById('lightbox-counter').textContent = (galleryIdx + 1) + ' / ' + galleryView.length;
    }

    function lightboxNav(dir) {
      if (!galleryView.length) return;
      galleryIdx = (galleryIdx + dir + galleryView.length) % galleryView.length;
      showGalleryItem();
    }

    function openLightbox(imgUrl) {
      galleryView = [{ id: null, cat: 'exterior', caption: 'Detail view', custom: imgUrl }];
      galleryIdx = 0;
      document.getElementById('lightbox-img').src = imgUrl;
      document.getElementById('lightbox-caption').textContent = 'Detail view';
      document.getElementById('lightbox-counter').textContent = '1 / 1';
      document.getElementById('lightbox-modal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      document.getElementById('lightbox-modal').classList.add('hidden');
      document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
      const modal = document.getElementById('lightbox-modal');
      if (!modal || modal.classList.contains('hidden')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') lightboxNav(1);
      if (e.key === 'ArrowLeft') lightboxNav(-1);
    });

    // Hero video theater - Angle 01 (video1) and Angle 02 (video2) local MP4
    var heroCurrentAngle = 0;
    var heroMuted = true;
    function getHeroVideo(idx) {
      return document.getElementById('hero-video-' + idx);
    }
    function switchHeroAngle(idx) {
      const badge = document.getElementById('hero-stream-badge');
      const b0 = document.getElementById('hero-angle-btn-0');
      const b1 = document.getElementById('hero-angle-btn-1');
      const label = document.getElementById('hero-corner-audio-text');
      const active = ['bg-[#9a7b4f]', 'text-white', 'border-[#9a7b4f]'];
      const idle = ['bg-white', 'text-[#374151]', 'border-[#e5e2da]'];
      heroCurrentAngle = idx;
      heroMuted = true;
      // Update videos via opacity/z-index so preload works
      [0, 1].forEach(i => {
        const v = getHeroVideo(i);
        if (!v) return;
        if (i === idx) {
          v.classList.remove('hidden');
          v.muted = true;
          v.currentTime = 0;
          v.load();
          setTimeout(function() {
            v.play().catch(function() {
              // Autoplay blocked; retry once after brief delay
              setTimeout(function() { v.play().catch(function() {}); }, 300);
            });
          }, 50);
        } else {
          v.classList.add('hidden');
          v.pause();
          v.currentTime = 0;
        }
      });
      if (badge) badge.textContent = idx === 0 ? 'Video 1' : 'Video 2';
      if (label) label.textContent = 'Muted (Click for Sound)';
      [b0, b1].forEach((b, i) => {
        if (!b) return;
        active.forEach(c => b.classList.remove(c));
        idle.forEach(c => b.classList.remove(c));
        (i === idx ? active : idle).forEach(c => b.classList.add(c));
      });
    }

    function toggleHeroAudio() {
      const label = document.getElementById('hero-corner-audio-text');
      heroMuted = !heroMuted;
      const v = getHeroVideo(heroCurrentAngle);
      if (v) v.muted = heroMuted;
      if (!heroMuted) {
        if (v) v.play().catch(() => {});
        if (label) label.textContent = 'Sound on';
      } else {
        if (label) label.textContent = 'Muted (Click for Sound)';
      }
    }

    function setHeroStage(n) {
      for (let i = 1; i <= 4; i++) {
        const card = document.getElementById('hero-stage-card-' + i);
        const lab = document.getElementById('hero-stage-label-' + i);
        if (!card) continue;
        const on = i === n;
        card.className = 'p-4 sm:p-5 text-left border rounded-lg transition-all ' + (on ? 'border-[#9a7b4f] bg-white text-[#1a1d24] shadow-md ring-1 ring-[#9a7b4f]' : 'border-[#e5e2da] bg-white/80 text-[#374151] hover:border-[#c8c3b7] hover:bg-white shadow-2xs');
        if (lab) lab.className = 'text-xs sm:text-[13px] font-bold uppercase tracking-wider ' + (on ? 'text-[#9a7b4f]' : 'text-[#6b7280]');
      }
    }

    var heroTheaterWide = false;
    function toggleHeroTheater() {
      const stage = document.getElementById('hero-video-theater-stage');
      const label = document.getElementById('hero-theater-text');
      heroTheaterWide = !heroTheaterWide;
      if (stage) {
        stage.classList.remove('max-w-6xl', 'max-w-7xl');
        stage.classList.add(heroTheaterWide ? 'max-w-7xl' : 'max-w-6xl');
      }
      if (label) label.textContent = heroTheaterWide ? 'Exit Full View' : 'Full View';
    }

    function downloadHeroSpecPack() {
      openEnquiryModal('Hero Spec Pack (HS-VILLA 38)');
    }

    /* toggleMobileMenu lives in header partial */

    /* handleEnquirySubmit / handleSampleSubmit / showToast live in the footer partial (real POST). */

    // ==========================================
    // ARCHITECTURAL COLLECTIONS & SPECIFICATION DATA
    // ==========================================
    var PRODUCTS = @json($productsJson);


    // Open catalog directly from external button or card
    // Collection card clicks -> filter Featured Products and scroll to them
    function openCollectionsModal(discipline) {
      const interiorCats = ['Kitchen', 'Bath & Wellness', 'Sculptural Lighting', 'Architectural Joinery', 'Hardware & Surfaces'];
      let cat = 'homes';
      if (discipline === 'All') cat = 'all';
      else if (interiorCats.includes(discipline)) cat = 'interiors';
      document.querySelectorAll('.featured-pill').forEach((p, idx) => {
        const shouldActivate = (cat === 'all' && idx === 0) || (cat !== 'all' && ((idx === 0 && cat === 'homes') || (idx === 1 && cat === 'interiors')));
        p.classList.remove('bg-[#181b20]', 'text-white', 'bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]');
        if (shouldActivate) p.classList.add('bg-[#181b20]', 'text-white');
        else p.classList.add('bg-white', 'text-[#6b7280]', 'border', 'border-[#e5e2da]');
      });
      document.querySelectorAll('.featured-card').forEach(c => {
        c.classList.toggle('hidden', cat !== 'all' && c.getAttribute('data-cat') !== cat);
      });
      const target = document.getElementById('featured-products');
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }


    // Open detailed specification modal
    // Resolve a product by numeric id, slug, or name (static cards use slugs).
    function findProduct(key) {
      return PRODUCTS.find(p => p.id === key || p.slug === key || p.name === key) || null;
    }
    // Single consistent entry point: every product-specific enquiry carries its id.
    function enquireProduct(key) {
      var p = findProduct(key);
      if (p) openEnquiryModal(p.name + ' — Spec Pack', p.id, '');
      else openEnquiryModal(key);
    }
    function openProductDetailModal(productId) {
      const product = findProduct(productId);
      if (!product) return;

      const container = document.getElementById('product-detail-content');
      if (!container) return;

      container.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          
          <!-- Product Visual & Gallery -->
          <div class="space-y-4">
            <div class="aspect-[4/3] rounded-xl overflow-hidden border border-[#e5e2da] relative group bg-[#f4f2ef]">
              <img id="detail-main-img" src="${product.heroImage}" alt="${product.name}" class="w-full h-full object-cover" />
            </div>
            
            <div class="p-4 rounded-xl bg-[#FAF9F5] border border-[#e5e2da] text-xs space-y-2">
              <div class="flex items-center justify-between text-[#6b7280]">
                <span>Model Code:</span>
                <span class="font-mono font-semibold text-[#1a1d24]">${product.modelCode}</span>
              </div>
              <div class="flex items-center justify-between text-[#6b7280]">
                <span>Manufacturing &amp; Logistics:</span>
                <span class="font-mono text-[#9a7b4f] font-semibold">${product.leadTime}</span>
              </div>
              <div class="flex items-center justify-between text-[#6b7280]">
                <span>Warranty Coverage:</span>
                <span class="text-[#1a1d24] font-semibold">${product.warranty}</span>
              </div>
            </div>

            <!-- CAD / Sample Triggers -->
            <div class="grid grid-cols-2 gap-3 pt-2">
              <button onclick="closeProductDetailModal(); openSampleModal()" class="py-2.5 px-3 rounded-lg border border-[#d8d4c7] hover:border-[#9a7b4f] text-xs font-semibold text-[#1a1d24] flex items-center justify-center gap-1.5 bg-white">
                <x-icon name="package" class="w-3.5 h-3.5 text-[#9a7b4f]" />
                <span>Order Sample</span>
              </button>
              <button onclick="downloadCadSimulation('${product.modelCode}')" class="py-2.5 px-3 rounded-lg border border-[#d8d4c7] hover:border-[#9a7b4f] text-xs font-semibold text-[#1a1d24] flex items-center justify-center gap-1.5 bg-white">
                <x-icon name="file-code" class="w-3.5 h-3.5 text-[#9a7b4f]" />
                <span>Request DWG/BIM</span>
              </button>
            </div>
          </div>

          <!-- Product Details & Specs -->
          <div class="space-y-6">
            <div>
              <span class="text-[10px] uppercase font-mono tracking-widest text-[#9a7b4f] font-semibold block mb-1">
                ${product.discipline} &middot; Architectural Spec Sheet
              </span>
              <h3 class="font-serif text-3xl sm:text-4xl text-[#1a1d24] font-semibold">
                ${product.name}
              </h3>
              <p class="text-sm text-[#374151] mt-2 leading-relaxed">
                ${product.tagline}
              </p>
            </div>

            <!-- Dimensional Specs -->
            <div class="p-4 rounded-xl bg-white border border-[#e5e2da] shadow-xs space-y-3">
              <span class="text-[11px] uppercase font-mono tracking-wider text-[#9a7b4f] font-semibold block">Dimensions &amp; Footprint</span>
              <div class="text-xs text-[#1a1d24] font-mono font-semibold">${product.dimensions}</div>
            </div>

            <!-- Specified Materials -->
            <div class="space-y-2">
              <span class="text-xs font-semibold text-[#1a1d24] block uppercase tracking-wider font-mono">Specified Materials</span>
              <div class="flex flex-wrap gap-2">
                ${product.materials.map(m => `
                  <span class="px-3 py-1 rounded-lg bg-[#f4f2ef] border border-[#e5e2da] text-xs text-[#374151]">
                    ${m}
                  </span>
                `).join('')}
              </div>
            </div>

            <!-- Engineering Bullet Points -->
            <div class="space-y-2.5">
              <span class="text-xs font-semibold text-[#1a1d24] block uppercase tracking-wider font-mono">Engineering &amp; Compliance Notes</span>
              <ul class="space-y-2 text-xs text-[#374151]">
                ${product.specs.map(s => `
                  <li class="flex items-start gap-2">
                    <x-icon name="check" class="w-4 h-4 text-[#9a7b4f] shrink-0 mt-0.5" />
                    <span>${s}</span>
                  </li>
                `).join('')}
              </ul>
            </div>

            <!-- Main CTA -->
            <div class="pt-4 border-t border-[#e5e2da]">
              <button onclick="closeProductDetailModal(); openEnquiryModal(product.name + ' — Spec Pack', product.id, '')" class="w-full py-3.5 rounded-xl bg-[#181b20] hover:bg-[#9a7b4f] text-white text-xs font-semibold uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                <span>Request Quotation &amp; Specification Pack</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
              </button>
            </div>

          </div>

        </div>
      `;

      const modal = document.getElementById('product-detail-modal');
      if (modal) modal.classList.remove('hidden');
      if (window.lucide) lucide.createIcons();
    }

    function closeProductDetailModal() {
      const modal = document.getElementById('product-detail-modal');
      if (modal) modal.classList.add('hidden');
    }

    function downloadCadSimulation(modelCode) {
      showToast('CAD Package Queued', `Downloading technical BIM/DWG package for ${modelCode}`);
    }

    // Page init: runs on hard load (script sits at body end, DOM ready) and on
    // every SPA injection. DOMContentLoaded would never fire after SPA navigation.
    renderApplicationShowcase('annex');
    renderSpace('kensington');
    renderMaterial('glass');
    renderGallery();
    renderFiles();
    renderConfiguratorOptions();
    updateLiveBill();
    // Hero video init: desktop = video 1, mobile (< 768px) = video 2
    (function initHeroVideo() {
      const isMobile = window.innerWidth < 768;
      switchHeroAngle(isMobile ? 1 : 0);
      // Force play after a moment (browser autoplay delay)
      setTimeout(function() {
        const v = document.getElementById('hero-video-' + (isMobile ? 1 : 0));
        if (v) { v.muted = true; v.play().catch(function() {}); }
      }, 400);
    })();
    if (window.lucide) {
      lucide.createIcons();
    }
  </script>
@endsection
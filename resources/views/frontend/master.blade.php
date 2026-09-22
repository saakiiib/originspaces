<!DOCTYPE html>
<html lang="en">

@php
    $company = App\Models\CompanyDetails::firstOrCreate();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{ $company->company_name ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    @if ($company->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $company->google_analytics_id }}"></script>
        <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '{{ $company->google_analytics_id }}');</script>
    @endif
    <link rel="icon" href="{{ asset('uploads/company/' . $company->fav_icon) }}" sizes="48x48">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2@2.1.0/dist/css/nice-select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('resources/frontend/css/style.css') }}?v={{ filemtime(public_path('resources/frontend/css/style.css')) }}">
    @yield('style')
    <style>
    html{scroll-behavior:smooth}
    ::selection{background:rgba(21,147,165,.2);color:#132238}
    .page-hero{padding:2rem 0 1.5rem;text-align:center}
    .page-hero h1{font-weight:800;font-size:clamp(1.6rem,3vw,2.2rem);margin-bottom:8px;color:#17202A}
    .crumbs{display:flex;align-items:center;justify-content:center;gap:6px;font-size:.85rem;color:#667085;flex-wrap:wrap;background:#fff;padding:10px 16px;border-radius:8px;border:1px solid #E2E6EA;width:fit-content;margin:0 auto 1rem}
    .crumbs a{color:#6B7A94;text-decoration:none;transition:all .2s;font-weight:500;padding:.2rem .5rem;border-radius:6px}
    .crumbs a:hover{color:#173B67;background:#EEF7F8}
    .crumbs .sep{color:#CBD5E1;font-size:.65rem;opacity:.5}
    .crumbs .cur{color:#173B67;font-weight:600;padding:.2rem .5rem;background:#EEF7F8;border-radius:6px}
    .smart-notify{top:24px!important;bottom:auto!important;transform:translateX(120%)!important}
    .smart-notify.show{transform:translateX(0)!important}
    .pagination{display:flex!important;gap:6px!important;justify-content:center!important;flex-wrap:wrap!important}
    .page-item{display:inline-block!important}
    .page-item .page-link{display:inline-flex!important;align-items:center!important;justify-content:center!important;min-width:40px!important;height:40px!important;padding:0 14px!important;border-radius:8px!important;border:1px solid #E2E6EA!important;background:#fff!important;color:#17202A!important;font-weight:600!important;font-size:.88rem!important;text-decoration:none!important;transition:all .2s!important}
    .page-item .page-link:hover{background:#EEF7F8!important;color:#173B67!important;border-color:#173B67!important}
    .page-item.active .page-link{background:#173B67!important;color:#fff!important;border-color:transparent!important;box-shadow:none!important}
    .page-item.disabled .page-link{color:#CBD5E1!important;pointer-events:none!important;background:#F8FAFC!important}
    .carousel-control-prev,.carousel-control-next{display:none!important}
    </style>
    @yield('style')
</head>

<body data-page="home" data-show-price="{{ $company->show_price ?? 1 }}">

@include('frontend.header')

<div @spaContent>
    @yield('content')
</div>

@include('frontend.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/nice-select2@2.1.0/dist/js/nice-select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

@spaEngine

<script src="{{ asset('resources/frontend/js/main.js') }}?v={{ filemtime(public_path('resources/frontend/js/main.js')) }}"></script>
<script src="{{ asset('resources/frontend/js/app.js') }}?v={{ filemtime(public_path('resources/frontend/js/app.js')) }}"></script>

<script>
// Sticky header fallback (CSS sticky broken by overflow-x:hidden on body)
(function(){
  var header = document.querySelector('.site-header');
  if(!header) return;
  header.style.position = 'fixed';
  header.style.top = '0';
  header.style.left = '0';
  header.style.right = '0';
  header.style.zIndex = '1000';
  header.style.width = '100%';
  header.style.background = 'rgba(255,255,255,.92)';
  header.style.backdropFilter = 'blur(14px)';
  header.style.transition = 'all .35s ease';
  // Add spacer AFTER header so content doesn't overlap
  var spacer = document.createElement('div');
  spacer.id = 'headerSpacer';
  spacer.style.height = header.offsetHeight + 'px';
  header.parentNode.insertBefore(spacer, header.nextSibling);
  function updateSpacer(){ spacer.style.height = header.offsetHeight + 'px'; }
  window.addEventListener('scroll', function() {
    var shrinking = window.scrollY > 40;
    header.classList.toggle('shrink', shrinking);
    updateSpacer();
    setTimeout(updateSpacer, 380);
  });
})();
</script>

@yield('script')

<div class="share-float" id="shareFloat">
  <div class="share-panel" id="sharePanel">
    <a class="share-btn" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" title="Messenger">
      <span class="share-label">Messenger</span>
      <i class="bi bi-chat-dots"></i>
    </a>
    <a class="share-btn" href="https://wa.me/{{ $company->whatsapp ?? '' }}?text={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" title="WhatsApp">
      <span class="share-label">WhatsApp</span>
      <i class="bi bi-whatsapp"></i>
    </a>
    <a class="share-btn" href="mailto:{{ $company->email1 ?? '' }}?subject={{ urlencode(request()->url()) }}" title="Email">
      <span class="share-label">Email</span>
      <i class="bi bi-envelope"></i>
    </a>
    <a class="share-btn" href="tel:{{ $company->phone1 ?? '' }}" title="Call">
      <span class="share-label">Call</span>
      <i class="bi bi-telephone"></i>
    </a>
  </div>
  <button class="share-toggle" id="shareToggle" title="Contact Us" aria-label="Contact Us">
    <i class="bi bi-headset"></i>
  </button>
</div>
<style>
.share-float{position:fixed;bottom:90px;right:24px;z-index:9999;display:flex;flex-direction:column;align-items:flex-end;gap:10px}
.share-panel{display:flex;flex-direction:column;gap:8px;opacity:0;visibility:hidden;transform:translateX(20px);transition:all .3s ease;width:fit-content;align-items:flex-end}
.share-float.open .share-panel{opacity:1;visibility:visible;transform:translateX(0)}
.share-btn{display:inline-flex;align-items:center;gap:12px;background:#132238;color:#fff;padding:10px 16px;border-radius:30px;text-decoration:none;font-size:.85rem;font-weight:600;box-shadow:0 4px 14px rgba(0,0,0,.2);transition:all .2s;white-space:nowrap;width:fit-content}
.share-btn:hover{background:linear-gradient(135deg,#1593A5,#1F477A);transform:translateX(-4px)}
.share-btn i{font-size:1.2rem;width:24px;text-align:center}
.share-btn .share-label{color:#fff}
.share-toggle{width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#1593A5,#1F477A);border:none;color:#fff;font-size:1.5rem;cursor:pointer;box-shadow:0 4px 16px rgba(21,147,165,.4);transition:all .25s;display:flex;align-items:center;justify-content:center}
.share-toggle:hover{transform:scale(1.1);box-shadow:0 6px 24px rgba(21,147,165,.5)}
.share-toggle.open{transform:rotate(45deg)}
</style>

<div class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0})">
  <i class="bi bi-arrow-up"></i>
</div>
<style>
.back-to-top{position:fixed;bottom:24px;right:24px;z-index:10000;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;display:flex;align-items:center;justify-content:center;font-size:22px;cursor:pointer;box-shadow:0 4px 16px rgba(21,147,165,.4);opacity:0;visibility:hidden;transform:translateY(-20px);transition:all .25s}
.back-to-top:hover{background:linear-gradient(135deg,#0F4C9C,#132238);transform:scale(1.1);box-shadow:0 6px 24px rgba(21,147,165,.5)}
</style>
<script>
(function(){
  var btn=document.getElementById('backToTop');
  if(!btn)return;
  window.addEventListener('scroll',function(){
    if(window.scrollY>400){btn.style.opacity='1';btn.style.visibility='visible';btn.style.transform='translateY(0)'}else{btn.style.opacity='0';btn.style.visibility='hidden';btn.style.transform='translateY(-20px)'}
  },{passive:true});
})();
</script>

</body>
</html>

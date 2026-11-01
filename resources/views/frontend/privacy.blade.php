@extends('frontend.layout')
@section('title', 'Privacy Policy | OriginSpaces Modular UK')
@section('content')


  <!-- Page Hero -->
  <section class="py-8 md:py-12 px-4 sm:px-6 lg:px-10 border-b border-[#e5e2da]">
    <div class="max-w-3xl mx-auto text-center">
      <span class="text-[11px] uppercase tracking-[0.3em] text-[#9a7b4f] font-mono font-semibold block mb-2">— Legal</span>
      <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl text-[#1a1d24] font-semibold tracking-tight">Privacy Policy.</h1>
    </div>
  </section>

  <!-- Content -->
  <section class="py-16 md:py-24 px-4 sm:px-6 lg:px-10 bg-[#FAF9F5] border-b border-[#e5e2da]">
    @if($company->privacy_policy)
    <div class="max-w-3xl mx-auto bg-white rounded-2xl border border-[#e5e2da] p-6 sm:p-10 shadow-xs text-sm text-[#374151] leading-relaxed mb-8">
      {!! $company->privacy_policy !!}
    </div>
    @endif
  </section>

  <!-- Footer -->
  
@endsection
@section('script')
<script>
    /* toggleMobileMenu lives in header partial */
    if (window.lucide) lucide.createIcons();
  </script>
@endsection

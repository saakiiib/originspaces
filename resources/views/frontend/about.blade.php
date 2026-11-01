@extends('frontend.layout')
@section('title', 'About | OriginSpaces Modular UK')
@section('content')

<style>
  .osab{--brass:#9a7b4f;--brass-d:#866940;--ink:#1a1d24;--body:#374151;--muted:#6b7280;--line:#e5e2da;--cream:#FAF9F5;--alt:#f3f2ee;--dark:#181b20;--dark-t:#c9c4b7;font-family:'Plus Jakarta Sans',sans-serif;color:var(--body);line-height:1.6}
  .osab *{box-sizing:border-box}
  .osab a{text-decoration:none;color:inherit}
  .osab h1,.osab h2,.osab h3,.osab p{margin-top:0}
  .osab .wrap{max-width:1280px;margin:0 auto;padding:0 40px}
  .osab section{padding:96px 0;border-bottom:1px solid var(--line)}
  .osab .eyebrow{display:block;font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:600;letter-spacing:.3em;text-transform:uppercase;color:var(--brass);margin-bottom:14px}
  .osab .eyebrow.on-dark{color:#d9c299}
  .osab h1,.osab h2,.osab h3{font-family:'Cormorant Garamond',Georgia,serif;color:var(--ink);font-weight:600}
  .osab h1{font-size:clamp(40px,5.2vw,68px);line-height:1.08;letter-spacing:-.01em;margin:0 0 20px}
  .osab h1 em,.osab h2 em{font-style:italic;color:var(--brass)}
  .osab h2{font-size:clamp(32px,3.8vw,50px);line-height:1.15;margin:0 0 16px}
  .osab .lead{font-size:16px;max-width:560px}
  .osab .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 22px;border-radius:12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;border:1px solid var(--brass);background:var(--brass);color:#fff;transition:all .2s;cursor:pointer}
  .osab .btn:hover{background:var(--brass-d);border-color:var(--brass-d)}
  .osab .btn.outline{background:transparent;color:var(--brass)}
  .osab .btn.outline:hover{background:var(--brass);color:#fff}
  .osab .btn.light{background:#fff;color:var(--ink);border-color:#fff}
  .osab .btn.light:hover{background:var(--cream)}

  /* launch strip */
  .osab .strip{background:var(--dark);color:var(--dark-t);text-align:center;padding:12px 20px;font-size:13px}
  .osab .strip strong{color:#fff}
  .osab .strip a{color:#d9c299;text-decoration:underline;text-underline-offset:3px;font-weight:600}

  /* hero */
  .osab .hero{background:var(--alt);padding:84px 0}
  .osab .hero-grid{display:grid;grid-template-columns:1.02fr .98fr;gap:56px;align-items:center}
  .osab .hero-actions{display:flex;flex-wrap:wrap;gap:12px;margin:28px 0 22px}
  .osab .mini{display:flex;align-items:center;gap:9px;font-size:13px;font-weight:600;color:var(--body)}
  .osab .mini .dot{width:8px;height:8px;border-radius:50%;background:var(--brass)}

  /* showcase illustration */
  .osab .showcase{position:relative;min-height:420px;border-radius:24px;overflow:hidden;border:1px solid var(--line);background:linear-gradient(155deg,#e9e4d8,#f6f3ec 60%,#d9d2c1);box-shadow:0 24px 50px rgba(26,29,36,.12)}
  .osab .showcase:before{content:"";position:absolute;left:0;right:0;bottom:0;height:34%;background:linear-gradient(170deg,#b9ab8d,#9a8a68)}
  .osab .sun{position:absolute;top:46px;right:60px;width:104px;height:104px;border-radius:50%;background:rgba(154,123,79,.22)}
  .osab .building{position:absolute;bottom:21%;left:10%;width:80%;height:47%;background:#faf9f5;border:9px solid #2a2e37;border-top:17px solid #181b20;transform:skewY(-1deg);box-shadow:20px 22px 0 rgba(24,27,32,.18)}
  .osab .building:before{content:"";position:absolute;left:50%;top:0;bottom:0;width:7px;background:#2a2e37}
  .osab .building .window{position:absolute;left:6%;top:17%;width:36%;height:64%;border:8px solid #2a2e37;background:linear-gradient(145deg,#8fa5b5,#dde7ec)}
  .osab .building .door{position:absolute;right:13%;top:15%;width:23%;height:85%;border:8px solid #2a2e37;background:linear-gradient(135deg,#7f93a2,#c4d3dc)}
  .osab .building .door:after{content:"";position:absolute;top:50%;right:8%;width:5px;height:16px;border-radius:3px;background:var(--brass)}
  .osab .float-note{position:absolute;top:20px;left:18px;background:#fff;border:1px solid var(--line);border-radius:12px;padding:10px 15px;font-size:12px;font-weight:700;color:var(--ink);box-shadow:0 8px 18px rgba(0,0,0,.08)}
  .osab .caption{position:absolute;bottom:15px;left:18px;background:rgba(24,27,32,.75);color:#fff;border-radius:100px;padding:7px 12px;font-size:11px}

  /* uses */
  .osab .uses-bg{background:var(--cream)}
  .osab .uses-intro{max-width:820px;margin-bottom:34px}
  .osab .uses-intro p{font-size:16px;line-height:1.75}
  .osab .tags{display:flex;flex-wrap:wrap;gap:9px;margin-top:20px}
  .osab .tags span{font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:500;color:var(--brass);background:#fff;border:1px solid var(--line);border-radius:999px;padding:7px 13px}
  .osab .uses{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
  .osab .use{display:flex;flex-direction:column;min-height:360px;position:relative;overflow:hidden;background:#fff;border:1px solid var(--line);border-radius:18px;padding:26px;transition:transform .2s,box-shadow .2s,border-color .2s}
  .osab .use:before{content:"";position:absolute;top:0;left:0;right:0;height:3px;background:var(--brass)}
  .osab .use:hover{transform:translateY(-5px);box-shadow:0 18px 34px rgba(26,29,36,.1);border-color:var(--brass)}
  .osab .use-top{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:20px}
  .osab .use-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;font-size:22px;background:rgba(154,123,79,.1);flex-shrink:0}
  .osab .use-num{font-family:'JetBrains Mono',monospace;font-size:10px;font-weight:600;letter-spacing:.1em;color:var(--brass);text-align:right;text-transform:uppercase}
  .osab .use h3{font-size:26px;line-height:1.2;margin:0 0 10px}
  .osab .use-desc{font-size:14px;color:var(--body);margin-bottom:18px}
  .osab .chips{display:flex;flex-wrap:wrap;align-content:flex-start;gap:8px;margin-bottom:22px}
  .osab .chips span{font-size:12px;font-weight:500;line-height:1.3;color:var(--body);background:var(--cream);border:1px solid var(--line);border-radius:9px;padding:8px 10px}
  .osab .use-link{display:flex;justify-content:space-between;gap:12px;margin-top:auto;padding-top:18px;border-top:1px solid var(--line);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--brass)}
  .osab .use-link:hover{color:var(--brass-d)}
  .osab .use.idea{background:var(--dark);border-color:var(--dark)}
  .osab .use.idea h3{color:#fff}
  .osab .use.idea .use-desc{color:var(--dark-t)}
  .osab .use.idea .use-icon{background:rgba(255,255,255,.1)}
  .osab .use.idea .use-link{border-color:rgba(255,255,255,.2);color:#d9c299}
  .osab .callout{font-family:'Cormorant Garamond',Georgia,serif;font-style:italic;font-size:22px;color:#d9c299;margin:4px 0 20px}
  .osab .disclaimer{max-width:960px;margin:24px 0 0;font-size:12px;line-height:1.7;color:var(--muted)}

  /* benefits */
  .osab .benefit-bg{background:var(--alt)}
  .osab .section-head{max-width:710px;margin-bottom:32px}
  .osab .benefits{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
  .osab .benefit{background:#fff;border:1px solid var(--line);border-radius:18px;padding:24px}
  .osab .benefit i{display:block;font-style:normal;font-family:'Cormorant Garamond',Georgia,serif;font-size:32px;color:var(--brass);line-height:1}
  .osab .benefit strong{display:block;margin:14px 0 6px;font-family:'Cormorant Garamond',Georgia,serif;font-size:22px;font-weight:600;color:var(--ink)}
  .osab .benefit p{margin:0;font-size:13px;color:var(--body)}

  /* pricing */
  .osab .pricing-bg{background:var(--cream)}
  .osab .pricing{display:grid;grid-template-columns:1fr 1fr;gap:22px;align-items:stretch}
  .osab .price-card{position:relative;overflow:hidden;background:var(--dark);color:#fff;border-radius:22px;padding:38px}
  .osab .price-card:after{content:"";position:absolute;right:-90px;bottom:-130px;width:260px;height:260px;border:1px solid rgba(255,255,255,.12);border-radius:50%}
  .osab .price-card h2{color:#fff;font-size:clamp(32px,3.6vw,46px)}
  .osab .price{font-family:'Cormorant Garamond',Georgia,serif;font-size:clamp(30px,3.8vw,50px);font-weight:600;color:#d9c299;margin:6px 0 18px}
  .osab .price-card p{color:var(--dark-t);font-size:14px}
  .osab .conditions{background:#fff;border:1px solid var(--line);border-radius:22px;padding:36px}
  .osab .conditions h3{font-size:28px;margin-bottom:12px}
  .osab .conditions ul{margin:0;padding-left:19px;font-size:14px}
  .osab .conditions li{margin:10px 0}
  .osab .conditions li strong{color:var(--ink)}
  .osab .notice{margin:18px 0 0;font-size:13px;background:var(--cream);border-left:3px solid var(--brass);border-radius:6px;padding:13px 16px}

  @media(max-width:900px){
    .osab .hero-grid,.osab .pricing{grid-template-columns:1fr}
    .osab .hero-grid{gap:36px}
    .osab .showcase{min-height:360px}
    .osab .uses,.osab .benefits{grid-template-columns:repeat(2,1fr)}
  }
  @media(max-width:620px){
    .osab .wrap{padding:0 20px}
    .osab section{padding:64px 0}
    .osab .hero{padding:54px 0}
    .osab .showcase{min-height:300px}
    .osab .uses,.osab .benefits{grid-template-columns:1fr}
    .osab .use{min-height:0}
    .osab .price-card,.osab .conditions{padding:26px}
  }
</style>

<div class="osab">

  <!-- Launch strip -->
  <div class="strip"><strong>Introductory prices on our first shipment!</strong> Limited stock may be available — <a @spa href="{{ route('contact') }}">enquire early for current availability</a>.</div>

  <!-- Hero -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow">— Welcome to OriginSpaces UK</span>
        <h1>More space.<br><em>More possibilities.</em></h1>
        <p class="lead">Discover versatile expandable modular buildings for your home, garden or business, offered at introductory prices for our first shipment. Interested in a custom build? Speak to us about your requirements and what options may be possible.</p>
        <div class="hero-actions">
          <a @spa href="{{ route('contact') }}" class="btn">Ask about introductory prices ↗</a>
          <a @spa href="{{ route('contact') }}" class="btn outline">Discuss a custom build</a>
        </div>
        <div class="mini"><span class="dot"></span> Simple information. Clear purchasing terms.</div>
      </div>
      <div class="showcase" role="img" aria-label="Illustrative drawing of an expandable modular building">
        <div class="sun"></div>
        <div class="float-note">One building. Many ideas.</div>
        <div class="building"><div class="window"></div><div class="door"></div></div>
        <span class="caption">Concept illustration</span>
      </div>
    </div>
  </section>

  <!-- Uses -->
  <section id="uses" class="uses-bg" aria-labelledby="uses-title">
    <div class="wrap">
      <div class="uses-intro">
        <span class="eyebrow">— Explore the Possibilities</span>
        <h2 id="uses-title">What could you do with <em>more space?</em></h2>
        <p>From <strong>expandable garden offices</strong> to <strong>modular coffee shops</strong>, discover potential uses for an expandable modular building in the UK. Choose an idea below or tell us what you have in mind.</p>
        <div class="tags" aria-label="Popular modular building ideas">
          <span>#GardenOffice</span><span>#ModularCoffeeShop</span><span>#ExpandableBuilding</span><span>#PopUpRetail</span><span>#Glamping</span>
        </div>
      </div>

      <div class="uses">
        <article class="use">
          <div class="use-top"><span class="use-icon" aria-hidden="true">🏡</span><span class="use-num">01 / Home &amp; Garden</span></div>
          <h3>Garden Rooms &amp; Extra Living Space</h3>
          <p class="use-desc">Make space for the things that matter.</p>
          <div class="chips"><span>Garden office</span><span>Home gym</span><span>Garden studio</span><span>Games room</span><span>Guest annexe</span><span>Family accommodation</span></div>
          <a class="use-link" @spa href="{{ route('contact') }}">Enquire about this use <span aria-hidden="true">↗</span></a>
        </article>

        <article class="use">
          <div class="use-top"><span class="use-icon" aria-hidden="true">☕</span><span class="use-num">02 / Food &amp; Retail</span></div>
          <h3>Coffee Shops &amp; Pop-Up Retail</h3>
          <p class="use-desc">Explore a space for your next business idea.</p>
          <div class="chips"><span>Coffee shop</span><span>Café kiosk</span><span>Takeaway counter</span><span>Pop-up shop</span><span>Farm shop</span><span>Retail showroom</span></div>
          <a class="use-link" @spa href="{{ route('contact') }}">Enquire about this use <span aria-hidden="true">↗</span></a>
        </article>

        <article class="use">
          <div class="use-top"><span class="use-icon" aria-hidden="true">✂️</span><span class="use-num">03 / Creative &amp; Services</span></div>
          <h3>Salons, Studios &amp; Workspaces</h3>
          <p class="use-desc">A flexible starting point for small businesses.</p>
          <div class="chips"><span>Beauty salon</span><span>Barbershop</span><span>Nail studio</span><span>Photo studio</span><span>Consultation room</span><span>Meeting space</span></div>
          <a class="use-link" @spa href="{{ route('contact') }}">Enquire about this use <span aria-hidden="true">↗</span></a>
        </article>

        <article class="use">
          <div class="use-top"><span class="use-icon" aria-hidden="true">🌿</span><span class="use-num">04 / Leisure &amp; Tourism</span></div>
          <h3>Glamping, Farm &amp; Leisure Spaces</h3>
          <p class="use-desc">Consider something different for guests and visitors.</p>
          <div class="chips"><span>Glamping pod</span><span>Holiday cabin</span><span>Campsite reception</span><span>Farm office</span><span>Visitor hub</span><span>Community room</span></div>
          <a class="use-link" @spa href="{{ route('contact') }}">Enquire about this use <span aria-hidden="true">↗</span></a>
        </article>

        <article class="use">
          <div class="use-top"><span class="use-icon" aria-hidden="true">🏗️</span><span class="use-num">05 / Business &amp; Sites</span></div>
          <h3>Modular Offices &amp; Site Facilities</h3>
          <p class="use-desc">Practical space ideas for work and projects.</p>
          <div class="chips"><span>Site office</span><span>Staff room</span><span>Training room</span><span>Project office</span><span>Reception cabin</span><span>Business workspace</span></div>
          <a class="use-link" @spa href="{{ route('contact') }}">Enquire about this use <span aria-hidden="true">↗</span></a>
        </article>

        <article class="use idea">
          <div class="use-top"><span class="use-icon" aria-hidden="true">💡</span><span class="use-num">06 / Custom Ideas</span></div>
          <h3>Have a Different Idea?</h3>
          <p class="use-desc">Thinking of a custom layout, different size or another use? Speak to our team about possible options and specifications.</p>
          <div class="callout">Your idea could be our next project.</div>
          <a class="use-link" @spa href="{{ route('contact') }}">Discuss a custom build <span aria-hidden="true">↗</span></a>
        </article>
      </div>

      <p class="disclaimer"><strong>Important:</strong> These are examples of potential uses, not a claim that a specific model is suitable, approved or ready for each application. Planning permission, building regulations, fit-out, utilities, installation and other approvals may be required. Installation is not included.</p>
    </div>
  </section>

  <!-- Benefits -->
  <section class="benefit-bg">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">— Why OriginSpaces?</span>
        <h2>Keep it simple. <em>Make it yours.</em></h2>
        <p>We want exploring extra space to feel straightforward — with helpful details and no unnecessary promises.</p>
      </div>
      <div class="benefits">
        <div class="benefit"><i>£</i><strong>Cost-conscious options</strong><p>Explore available models and compare their features and overall project costs.</p></div>
        <div class="benefit"><i>▣</i><strong>Expandable design</strong><p>Buildings designed to travel in a compact form and expand at their destination.</p></div>
        <div class="benefit"><i>⌂</i><strong>Many possible uses</strong><p>From a quiet personal workspace to a small commercial project.</p></div>
        <div class="benefit"><i>✓</i><strong>Clear information</strong><p>Know what is included, what is excluded and what you need to arrange.</p></div>
      </div>
    </div>
  </section>

  <!-- Pricing -->
  <section id="pricing" class="pricing-bg">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">— Prices &amp; Purchasing</span>
        <h2>Let's talk about the <em>right building.</em></h2>
        <p>We'll help you understand available models and discuss the total costs relevant to your project.</p>
      </div>
      <div class="pricing">
        <div class="price-card">
          <span class="eyebrow on-dark">Starting prices</span>
          <h2>Expandable modular buildings</h2>
          <div class="price">£[PRICE TO CONFIRM]</div>
          <p>Ask us about introductory pricing for the first shipment. Availability is subject to confirmation and prices depend on the model, specifications and delivery location. Want something different?</p>
          <div class="text-center mt-4"><a class="btn light" @spa href="{{ route('contact') }}">Talk To Us ↗</a></div>
        </div>
        <div class="conditions">
          <h3>Good to know before ordering</h3>
          <ul>
            <li><strong>Building supply only:</strong> Installation is not included.</li>
            <li>Ground preparation, foundations and utility connections are not included.</li>
            <li>Delivery options and charges will be confirmed in your quotation.</li>
            <li>Customers must arrange appropriate installation and check site requirements.</li>
            <li>Availability and exact specifications will be confirmed before purchase.</li>
          </ul>
          <p class="notice">Planning permission, building regulations and other approvals may apply depending on the proposed location and use. Check with your local authority and qualified professionals.</p>
        </div>
      </div>
    </div>
  </section>


</div>

@endsection
@section('script')
<script>
  /* toggleMobileMenu lives in header partial */
  if (window.lucide) lucide.createIcons();
</script>
@endsection
@php
    $company = App\Models\CompanyDetails::firstOrCreate();
    $categories = App\Models\Category::where('status', 1)->whereNull('parent_id')
        ->with('childrenRecursive')
        ->orderBy('sort_order')
        ->get();
@endphp

<header class="site-header">
<!-- Announcement bar (inside header for sticky) -->
<div class="announcement d-none d-md-block">
  <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">
    <div class="d-none d-md-flex align-items-center gap-3">
      <span><i class="bi bi-telephone-fill me-1"></i> {{ $company->phone1 ?: '+880 1712-345678' }}</span>
      <span><i class="bi bi-envelope-fill me-1"></i> {{ $company->email1 ?: '' }}</span>
    </div>
    <div class="ms-auto text-end">
      <span><i class="bi bi-geo-alt-fill me-1"></i> {{ $company->address1 ? ($company->address1 . ', ' . ($company->city ?? '')) : 'Dhaka' }}</span>
    </div>
  </div>
</div>
  <div class="header-top">
    <div class="container d-flex align-items-center gap-3 flex-wrap">
      <a class="brand-logo magnetic" @spa href="{{ route('home') }}">
        <img src="{{ $company->company_logo ? asset('uploads/company/' . $company->company_logo) : asset('placeholder.webp') }}" alt="{{ $company->company_name ?? 'Logo' }}">
      </a>

      <div class="search-wrap d-none d-md-flex" style="position:relative">
        <form class="search-pill" action="{{ route('shop') }}" method="GET" onsubmit="return spaSearch(this)">
          <i class="bi bi-search text-primary-brand"></i>
          <input type="text" name="search" id="searchInput" placeholder="" value="{{ request('search') }}" autocomplete="off">
          <button class="btn btn-primary magnetic" type="submit">Search</button>
        </form>
        <div class="search-dropdown" id="searchDropdown">
          <div class="sd-section" id="sdCategories" style="display:none">
            <div class="sd-label">Categories</div>
            <div id="sdCatList"></div>
          </div>
          <div class="sd-section" id="sdProducts" style="display:none">
            <div class="sd-label">Products</div>
            <div id="sdProdList"></div>
            <a class="sd-view-all" id="sdViewAll" href="#">View all results <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="sd-empty" id="sdEmpty" style="display:none">
            <i class="bi bi-search"></i>
            <span>No results found</span>
          </div>
        </div>
      </div>

      <div class="header-icons d-none d-md-flex">
        <a class="icon-btn magnetic" @spa href="{{ route('wishlist') }}" title="Wishlist" style="display:none">
          <i class="bi bi-heart fs-5"></i><span class="badge-count" data-wish-count>{{ count(session('wishlist', [])) }}</span>
        </a>
        @auth
          <a class="icon-btn magnetic" @spa href="{{ route('user.dashboard') }}" title="Account">
            <i class="bi bi-person-circle fs-5"></i>
          </a>
        @else
          <a class="icon-btn magnetic" @spa href="{{ route('login') }}" title="Account">
            <i class="bi bi-person-circle fs-5"></i>
          </a>
        @endauth
        <a class="cart-mini magnetic" @spa href="{{ route('cart') }}" style="display:none">
          <i class="bi bi-cart3 fs-5"></i>
          <span class="badge-count" data-cart-count-badge>{{ count(session('cart', [])) }}</span>
        </a>
      </div>

      {{-- Mobile icons --}}
      <div class="d-flex align-items-center gap-2 ms-auto mobile-icons">
        <button class="d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSearchOffcanvas" title="Search" style="background:transparent;border:none;border-radius:10px;padding:6px;color:#132238;cursor:pointer;font-size:1.1rem;display:inline-flex;align-items:center">
          <i class="bi bi-search"></i>
        </button>
        <button class="d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileCatOffcanvas" title="All Categories" style="background:linear-gradient(135deg,#1593A5,#1F477A);border:none;border-radius:10px;padding:6px 14px;color:#fff;cursor:pointer;font-size:.82rem;font-weight:700;display:inline-flex;align-items:center;gap:6px;white-space:nowrap;box-shadow:0 3px 10px rgba(21,147,165,.3)">
          <i class="bi bi-grid-3x3-gap-fill"></i> Categories
        </button>
      </div>
    </div>
  </div>
    </div>
  </div>

  {{-- Category navbar row --}}
  <div class="cat-nav-row d-none d-md-block">
    <div class="container d-flex align-items-center">
      <button class="cat-nav-arrow cat-nav-prev" onclick="document.querySelector('.cat-nav').scrollBy({left:-200,behavior:'smooth'})" type="button"><i class="bi bi-chevron-left"></i></button>
      <nav class="cat-nav">
        @foreach($categories as $cat)
          <div class="cat-nav-item {{ request()->routeIs('shop') && request('category') === $cat->slug ? 'active' : '' }}">
            <a @spa href="{{ route('shop', ['category' => $cat->slug]) }}" style="display:flex;align-items:center;gap:.35rem;text-decoration:none;color:inherit">
              {{ $cat->name }}
              @if($cat->childrenRecursive->count())
                <i class="bi bi-chevron-down small" style="font-size:.65rem;opacity:.5"></i>
              @endif
            </a>
            @if($cat->childrenRecursive->count())
              <div class="cat-sub">
                @foreach($cat->childrenRecursive as $child)
                  <div class="cat-sub-item {{ $child->childrenRecursive->count() ? 'has-children' : '' }}">
                    <a @spa href="{{ route('shop', ['category' => $child->slug]) }}">
                      {{ $child->name }}
                      @if($child->childrenRecursive->count())
                        <i class="bi bi-chevron-right sub-arrow"></i>
                      @endif
                    </a>
                    @if($child->childrenRecursive->count())
                      <div class="cat-sub-sub">
                        @foreach($child->childrenRecursive as $grandchild)
                          <a @spa href="{{ route('shop', ['category' => $grandchild->slug]) }}">{{ $grandchild->name }}</a>
                        @endforeach
                      </div>
                    @endif
                  </div>
                @endforeach
                <a @spa href="{{ route('shop', ['category' => $cat->slug]) }}" class="cat-sub-all">
                  View All {{ $cat->name }}
                </a>
              </div>
            @endif
          </div>
        @endforeach
      </nav>
      <button class="cat-nav-arrow cat-nav-next" onclick="document.querySelector('.cat-nav').scrollBy({left:200,behavior:'smooth'})" type="button"><i class="bi bi-chevron-right"></i></button>
    </div>
  </div>
</header>

{{-- Mobile Category Offcanvas --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileCatOffcanvas" style="width:280px">
  <div class="offcanvas-header" style="background:linear-gradient(135deg,#1593A5,#1F477A);color:#fff;padding:1rem 1.2rem">
    <h6 class="offcanvas-title fw-bold" style="font-size:.95rem"><i class="bi bi-grid-3x3-gap-fill me-2"></i>All Categories</h6>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body p-0" style="overflow-y:auto">
    @foreach($categories as $cat)
      <div class="mobile-cat-item" style="border-bottom:1px solid #E6ECF5">
        <a href="{{ $cat->childrenRecursive->count() ? 'javascript:void(0)' : route('shop', ['category' => $cat->slug]) }}"
           class="mobile-cat-toggle"
           style="display:flex;align-items:center;justify-content:space-between;padding:12px 16px;text-decoration:none;color:#132238;font-weight:500;font-size:.9rem;transition:background .2s"
           onmouseover="this.style.background='rgba(21,147,165,.06)'" onmouseout="this.style.background='transparent'"
           data-id="{{ $cat->id }}">
          <span>{{ $cat->name }}</span>
          @if($cat->childrenRecursive->count())
            <i class="bi bi-chevron-right mobile-cat-arrow" style="font-size:.7rem;color:#94a3b8;transition:transform .2s"></i>
          @endif
        </a>
        @if($cat->childrenRecursive->count())
          <div class="mobile-cat-children" data-parent="{{ $cat->id }}" style="display:none;padding:0 16px 10px 28px;background:#FAFBFC">
            @foreach($cat->childrenRecursive as $child)
              <a href="{{ route('shop', ['category' => $child->slug]) }}" style="display:block;padding:5px 0;font-size:.85rem;color:#6B7A94;text-decoration:none;transition:color .2s" onmouseover="this.style.color='#1593A5'" onmouseout="this.style.color='#6B7A94'">{{ $child->name }}</a>
            @endforeach
          </div>
        @endif
      </div>
    @endforeach
  </div>
</div>

{{-- Mobile Search Offcanvas --}}
<div class="offcanvas offcanvas-top" tabindex="-1" id="mobileSearchOffcanvas" style="background:#fff;padding:1rem">
  <div class="offcanvas-header" style="padding:0 0 .8rem">
    <h6 class="offcanvas-title fw-bold" style="font-size:.95rem"><i class="bi bi-search me-2" style="color:#1593A5"></i>Search</h6>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" style="padding:0">
    <form class="search-pill" action="{{ route('shop') }}" method="GET" style="width:100%">
      <i class="bi bi-search text-primary-brand"></i>
      <input type="text" name="search" placeholder="Search products..." autofocus autocomplete="off" style="border:none;background:transparent;outline:none;padding:.5rem .75rem;flex:1;font-size:.9rem">
      <button class="btn btn-primary" type="submit" style="border-radius:999px;padding:.55rem 1.2rem;font-size:.85rem">Search</button>
    </form>
  </div>
</div>

<style>
.mega-wrap:hover .mega-menu{opacity:1!important;visibility:visible!important;transform:translateY(0)!important}
.mega-wrap.mega-disabled .mega-menu{opacity:0!important;visibility:hidden!important;transform:translateY(10px)!important}
.mega-cat-item{padding:11px 16px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:all .2s;border-left:none;border-radius:8px;margin:2px 8px}
.mega-cat-item.has-children{color:#1e293b}
.mega-cat-item.no-children{color:#475569}
.mega-cat-item:hover{background:rgba(21,147,165,.08)!important}
.mega-cat-item.has-children:hover span{color:#1593A5!important;font-weight:600!important}
.mega-cat-item.has-children:hover i{color:#1593A5!important}
.mega-cat-item.no-children:hover{background:rgba(15,76,156,.06)!important;color:#0F4C9C!important;font-weight:600!important}
.mega-cat-item.active{background:rgba(21,147,165,.1)!important}
.mega-cat-item.active span{color:#1593A5!important;font-weight:600!important}
.mega-cat-item.active i{color:#1593A5!important}
.mega-sub-panel h6{color:#1593A5;font-weight:700;font-size:.95rem;margin-bottom:14px;padding-bottom:10px;border-bottom:2px solid #E6ECF5}
.mega-sub-panel a{transition:all .2s;padding:8px 12px;border-radius:8px;display:block;font-size:.88rem;color:#334155;text-decoration:none;font-weight:500}
.mega-sub-panel a:hover{color:#1593A5!important;background:rgba(21,147,165,.06)!important}
.mega-sub-panel .sub-child{padding:5px 12px 5px 24px;font-size:.82rem;color:#64748b}
.mega-sub-panel .sub-child:hover{color:#1593A5!important;background:rgba(21,147,165,.04)!important}

/* Search dropdown */
.search-wrap{position:relative;z-index:200}
.search-dropdown{display:none;position:absolute;top:calc(100% + 8px);left:0;right:0;background:#fff;border:1px solid #E6ECF5;border-radius:18px;box-shadow:0 20px 50px -12px rgba(15,76,156,.2);z-index:9999;overflow:hidden;max-height:420px;overflow-y:auto}
.search-dropdown.show{display:block}
.sd-section{padding:8px 0}
.sd-section + .sd-section{border-top:1px solid #E6ECF5}
.sd-label{padding:8px 16px 4px;font-size:.7rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em}
.sd-empty{padding:24px 16px;text-align:center;color:#94a3b8;font-size:.88rem;display:flex;align-items:center;justify-content:center;gap:8px}
.sd-empty i{font-size:1.2rem}
.sd-prod{display:flex;align-items:center;gap:10px;padding:8px 14px;cursor:pointer;text-decoration:none;transition:background .2s;border-radius:10px;margin:0 6px}
.sd-prod:hover{background:rgba(21,147,165,.06)}
.sd-prod img{width:42px;height:42px;border-radius:10px;object-fit:cover;background:linear-gradient(160deg,#F7F8FA,#EAF4FF);padding:4px}
.sd-prod-info{flex:1;min-width:0}
.sd-prod-name{font-size:.85rem;font-weight:600;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sd-prod-brand{font-size:.72rem;color:#94a3b8;font-weight:500}
.sd-prod-price{font-size:.85rem;font-weight:700;color:#1593A5;white-space:nowrap}
.sd-prod-old{font-size:.72rem;color:#94a3b8;text-decoration:line-through;font-weight:500}
.sd-cat{display:flex;align-items:center;gap:8px;padding:8px 14px;cursor:pointer;text-decoration:none;transition:background .2s;border-radius:10px;margin:0 6px}
.sd-cat:hover{background:rgba(15,76,156,.06)}
.sd-cat-icon{width:28px;height:28px;border-radius:8px;background:linear-gradient(135deg,#0F4C9C,#2563EB);display:flex;align-items:center;justify-content:center;color:#fff;font-size:.7rem;flex-shrink:0}
.sd-cat-name{font-size:.85rem;font-weight:600;color:#1e293b}
.sd-view-all{display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 16px;margin:6px 10px;border-top:1px solid #E6ECF5;color:#0F4C9C;font-size:.85rem;font-weight:600;text-decoration:none;border-radius:10px;transition:all .2s}
.sd-view-all:hover{background:rgba(15,76,156,.06);color:#1593A5}
</style>
@php
  $catJson = $categories->map(function($c) {
      return [
          'id' => $c->id,
          'name' => $c->name,
          'slug' => $c->slug,
          'children' => $c->childrenRecursive->map(function($ch) {
              return [
                  'name' => $ch->name,
                  'slug' => $ch->slug,
                  'children' => $ch->childrenRecursive->map(function($gc) {
                      return ['name' => $gc->name, 'slug' => $gc->slug];
                  })->values(),
              ];
          })->values(),
      ];
  })->values();
@endphp
<script>
document.addEventListener('DOMContentLoaded', function(){
  // ===== MEGA MENU =====
  var catItems = document.querySelectorAll('.mega-cat-item');
  var subPanel = document.querySelector('.mega-sub-panel');

  if(catItems.length && subPanel) {
    var catData = @json($catJson);

    function renderSub(catId){
      var cat = catData.find(function(c){ return c.id == catId; });
      if(!cat || !cat.children || !cat.children.length) return;

      var html = '<div style="margin-bottom:6px">';
      html += '<h6 style="font-size:.82rem;font-weight:700;color:#1593A5;text-transform:uppercase;letter-spacing:.08em;margin-bottom:12px;padding-bottom:10px;border-bottom:2px solid #E6ECF5">'+cat.name+'</h6>';
      html += '</div>';

      html += '<div style="display:flex;flex-direction:column;gap:2px">';
      cat.children.forEach(function(ch){
        html += '<a href="/shop?category='+ch.slug+'" class="mega-sub-link" style="display:flex;align-items:center;justify-content:space-between;padding:9px 12px;border-radius:8px;font-size:.88rem;color:#1e293b;text-decoration:none;font-weight:500;transition:all .2s">';
        html += '<span>'+ch.name+'</span>';
        if(ch.children && ch.children.length){
          html += '<i class="bi bi-chevron-right" style="font-size:.65rem;color:#94a3b8"></i>';
        }
        html += '</a>';
        if(ch.children && ch.children.length){
          ch.children.forEach(function(gc){
            html += '<a href="/shop?category='+gc.slug+'" class="sub-child" style="display:block;padding:6px 12px 6px 28px;font-size:.82rem;color:#64748b;text-decoration:none;transition:all .2s;border-radius:6px">'+gc.name+'</a>';
          });
        }
      });
      html += '</div>';

      html += '<div style="margin-top:16px;padding-top:12px;border-top:1px solid #E6ECF5">';
      html += '<a href="/shop?category='+cat.slug+'" style="display:inline-flex;align-items:center;gap:6px;font-size:.85rem;color:#1593A5;font-weight:600;text-decoration:none;transition:color .2s">Shop All '+cat.name+' <i class="bi bi-arrow-right" style="font-size:.75rem"></i></a>';
      html += '</div>';

      subPanel.innerHTML = html;
    }

    catItems.forEach(function(item){
      item.addEventListener('mouseenter', function(){
        catItems.forEach(function(c){ c.classList.remove('active'); });
        this.classList.add('active');
        renderSub(this.dataset.catId);
        subPanel.querySelectorAll('.mega-sub-link, .sub-child').forEach(function(link){
          link.addEventListener('mouseenter', function(){
            this.style.background = 'rgba(21,147,165,.06)';
            this.style.color = '#1593A5';
          });
          link.addEventListener('mouseleave', function(){
            this.style.background = 'transparent';
            this.style.color = this.classList.contains('sub-child') ? '#64748b' : '#1e293b';
          });
        });
      });
    });

    var firstWithChildren = Array.from(catItems).find(function(item){
      var cat = catData.find(function(c){ return c.id == item.dataset.catId; });
      return cat && cat.children && cat.children.length;
    });
    if(firstWithChildren){
      firstWithChildren.classList.add('active');
      renderSub(firstWithChildren.dataset.catId);
    }
  }

  // Disable mega menu on homepage when scrolled to top
  var megaWrap = document.querySelector('.mega-wrap');
  if(megaWrap) {
    function checkMega(){
      var isHomepage = window.location.pathname === '/' || window.location.pathname === '';
      if(isHomepage && window.scrollY < 300){
        megaWrap.classList.add('mega-disabled');
      } else {
        megaWrap.classList.remove('mega-disabled');
      }
    }
    checkMega();
    window.addEventListener('scroll', checkMega, {passive:true});
    document.addEventListener('spa:loaded', checkMega);
  }

  // ===== SEARCH AUTOCOMPLETE =====
  var searchInput = document.getElementById('searchInput');
  var searchDropdown = document.getElementById('searchDropdown');
  var sdCatList = document.getElementById('sdCatList');
  var sdProdList = document.getElementById('sdProdList');
  var sdCategories = document.getElementById('sdCategories');
  var sdProducts = document.getElementById('sdProducts');
  var sdEmpty = document.getElementById('sdEmpty');
  var searchTimer = null;
  var lastQuery = '';

  if (searchInput && searchDropdown) {
    searchInput.addEventListener('input', function() {
      var q = this.value.trim();
      clearTimeout(searchTimer);
      if (q.length < 2) {
        searchDropdown.classList.remove('show');
        lastQuery = '';
        return;
      }
      if (q === lastQuery) return;
      searchTimer = setTimeout(function() {
        lastQuery = q;
        // Update View All link
        var viewAll = document.getElementById('sdViewAll');
        if (viewAll) viewAll.href = '{{ route("shop") }}?search=' + encodeURIComponent(q);
        fetch('{{ route("search.suggestions") }}?q=' + encodeURIComponent(q))
          .then(function(r) { return r.json(); })
          .then(function(data) {
            var hasProducts = data.products && data.products.length > 0;
            var hasCats = data.categories && data.categories.length > 0;
            if (!hasProducts && !hasCats) {
              sdCategories.style.display = 'none';
              sdProducts.style.display = 'none';
              sdEmpty.style.display = 'flex';
              searchDropdown.classList.add('show');
              return;
            }
            sdEmpty.style.display = 'none';
            // Categories
            if (hasCats) {
              sdCatList.innerHTML = data.categories.map(function(c) {
                return '<a class="sd-cat" href="/shop?category=' + c.slug + '">' +
                  '<span class="sd-cat-icon"><i class="bi bi-grid-3x3-gap-fill"></i></span>' +
                  '<span class="sd-cat-name">' + c.name + '</span></a>';
              }).join('');
              sdCategories.style.display = 'block';
            } else {
              sdCategories.style.display = 'none';
            }
            // Products
            if (hasProducts) {
              sdProdList.innerHTML = data.products.map(function(p) {
                var html = '<a class="sd-prod" href="/product/' + p.slug + '">' +
                  '<img src="' + p.image + '" alt="' + p.name + '">' +
                  '<div class="sd-prod-info"><div class="sd-prod-name">' + p.name + '</div>';
                if (p.brand) html += '<div class="sd-prod-brand">' + p.brand + '</div>';
                html += '</div><div style="text-align:right">';
                if (p.show_price !== 0) {
                  html += '<div class="sd-prod-price">৳' + p.price + '</div>';
                  if (p.old_price) html += '<div class="sd-prod-old">৳' + p.old_price + '</div>';
                }
                html += '</div></a>';
                return html;
              }).join('');
              sdProducts.style.display = 'block';
            } else {
              sdProducts.style.display = 'none';
            }
            searchDropdown.classList.add('show');
          })
          .catch(function() {
            searchDropdown.classList.remove('show');
          });
      }, 250);
    });

    searchInput.addEventListener('focus', function() {
      if (this.value.trim().length >= 2) {
        searchDropdown.classList.add('show');
      }
    });

    // Close dropdown on outside click
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.search-wrap')) {
        searchDropdown.classList.remove('show');
      }
    });

    // Keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        searchDropdown.classList.remove('show');
        this.blur();
      }
    });

    // View All click — clear input on navigation
    searchDropdown.addEventListener('click', function(e) {
      var viewAll = e.target.closest('.sd-view-all');
      if (viewAll) {
        searchInput.value = '';
        lastQuery = '';
        searchDropdown.classList.remove('show');
      }
      // Also close on product/category link click
      if (e.target.closest('.sd-prod, .sd-cat')) {
        searchInput.value = '';
        lastQuery = '';
        searchDropdown.classList.remove('show');
      }
    });

    // Close dropdown when form submits
    var searchForm = searchInput.closest('form');
    if (searchForm) {
      searchForm.addEventListener('submit', function() {
        lastQuery = '';
        searchDropdown.classList.remove('show');
      });
    }

    // Clear search on SPA navigation to shop (header persists, input may show old value)
    document.addEventListener('spa:loaded', function() {
      var onShop = window.location.pathname === '/shop' && !window.location.search.includes('search=');
      if (onShop) {
        searchInput.value = '';
      }
    });
  }

  // ===== MOBILE CATEGORY ACCORDION =====
  document.querySelectorAll('.mobile-cat-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
      var id = this.getAttribute('data-id');
      var children = document.querySelector('.mobile-cat-children[data-parent="' + id + '"]');
      var arrow = this.querySelector('.mobile-cat-arrow');
      if (!children) return;

      e.preventDefault();

      // Close all other open panels
      document.querySelectorAll('.mobile-cat-children').forEach(function(el) {
        if (el.getAttribute('data-parent') !== id) {
          el.style.display = 'none';
          var otherArrow = el.closest('.mobile-cat-item').querySelector('.mobile-cat-arrow');
          if (otherArrow) otherArrow.style.transform = 'rotate(0deg)';
        }
      });

      // Toggle current
      if (children.style.display === 'none') {
        children.style.display = 'block';
        if (arrow) arrow.style.transform = 'rotate(90deg)';
      } else {
        children.style.display = 'none';
        if (arrow) arrow.style.transform = 'rotate(0deg)';
      }
    });
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var nav = document.querySelector('.cat-nav');
  var prev = document.querySelector('.cat-nav-prev');
  var next = document.querySelector('.cat-nav-next');
  if (!nav || !prev || !next) return;

  function checkOverflow() {
    var overflows = nav.scrollWidth > nav.clientWidth + 2;
    nav.classList.toggle('centered', !overflows);
    prev.style.display = overflows ? 'flex' : 'none';
    next.style.display = overflows ? 'flex' : 'none';
    if (overflows) {
      prev.style.display = nav.scrollLeft > 0 ? 'flex' : 'none';
      next.style.display = nav.scrollLeft + nav.clientWidth < nav.scrollWidth - 1 ? 'flex' : 'none';
    }
  }

  checkOverflow();
  nav.addEventListener('scroll', checkOverflow);
  window.addEventListener('resize', checkOverflow);
});
</script>
<script>
(function(){
  // Position dropdowns overlapping the parent (no gap) + clamp inside viewport
  function placeSub(item){
    // for top-level items the .cat-sub is a direct child
    var sub = item.querySelector('.cat-sub');
    if(!sub) return;
    var rect = item.getBoundingClientRect();
    var w = 230;
    var left = Math.min(rect.left, window.innerWidth - w - 8);
    left = Math.max(8, left);
    sub.style.position = 'fixed';
    sub.style.left = left + 'px';
    sub.style.top = (rect.bottom - 2) + 'px';
    sub.style.zIndex = '9999';
  }
  document.querySelectorAll('.cat-nav-item').forEach(function(item){
    var t = null;
    item.addEventListener('mouseenter',function(){
      if(t){ clearTimeout(t); t = null; }
      item.classList.add('keep-open');
      placeSub(item);
    });
    item.addEventListener('mouseleave',function(){
      // grace period so slow diagonal movement to child still works
      t = setTimeout(function(){ item.classList.remove('keep-open'); }, 300);
    });
    var sub = item.querySelector('.cat-sub');
    if(sub){
      sub.addEventListener('mouseenter',function(){
        if(t){ clearTimeout(t); t = null; }
        item.classList.add('keep-open');
      });
      sub.addEventListener('mouseleave',function(){
        t = setTimeout(function(){ item.classList.remove('keep-open'); }, 200);
      });
    }
  });
})();
(function(){
  document.querySelectorAll('.cat-sub-item').forEach(function(item){
    var t = null;
    item.addEventListener('mouseenter',function(){
      if(t){ clearTimeout(t); t = null; }
      item.classList.add('keep-open');
      var sub = item.querySelector('.cat-sub-sub');
      if(!sub) return;
      var rect = item.getBoundingClientRect();
      var w = 210;
      var left;
      if(rect.right + w + 8 > window.innerWidth){
        left = rect.left - w - 2; // open to the left near right edge
      } else {
        left = rect.right - 2; // slight overlap, no gap
      }
      sub.style.position = 'fixed';
      sub.style.left = Math.max(8, left) + 'px';
      sub.style.top = Math.max(8, rect.top - 6) + 'px';
      sub.style.zIndex = '10000';
    });
    item.addEventListener('mouseleave',function(){
      t = setTimeout(function(){ item.classList.remove('keep-open'); }, 300);
    });
  });
})();
</script>

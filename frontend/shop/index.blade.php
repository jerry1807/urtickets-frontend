@extends('frontend.layout')
@section('pageHeading')
  {{ __('Shop') }}
@endsection

@section('hero-section')
<section class="ur-shop__hero">
  <div class="ur-shop__hero-inner">
    <h1 class="ur-shop__hero-title">
      <span class="ur-shop__hero-outline">THE</span>
      <span class="ur-shop__hero-solid">SHOP</span>
    </h1>
    <p class="ur-shop__hero-sub">OFFICIAL UR MERCH & EVENT GEAR</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-shop">

  {{-- FILTER BAR --}}
  <div class="ur-shop__filters">
    <div class="ur-shop__search-row">
      <div class="ur-shop__search">
        <i class="fas fa-search"></i>
        <input type="text" id="shopSearch" placeholder="SEARCH PRODUCTS..." class="ur-shop__search-input">
      </div>
      <select id="sortFilter" class="ur-shop__select">
        <option value="default">DEFAULT SORTING</option>
        <option value="new">LATEST</option>
        <option value="low">PRICE: LOW TO HIGH</option>
        <option value="high">PRICE: HIGH TO LOW</option>
      </select>
      <select id="catFilter" class="ur-shop__select">
        <option value="">ALL CATEGORIES</option>
        <option value="electronics">ELECTRONIC ACCESSORIES</option>
        <option value="fashion">FASHION & BEAUTY</option>
        <option value="home">HOME APPLIANCES</option>
        <option value="books">BOOKS</option>
      </select>
    </div>
  </div>

  {{-- RESULTS BAR --}}
  <div class="ur-shop__results-bar">
    <span class="ur-shop__count" id="shopCount">{{ count($products) }} PRODUCTS</span>
    <div class="ur-shop__cart-indicator">
      <i class="fas fa-shopping-cart"></i>
      <span id="cartCount">0</span>
    </div>
  </div>

  {{-- PRODUCT GRID --}}
  <div class="ur-shop__grid" id="shopGrid">
    @foreach($products as $product)
    <div class="ur-shop__card"
         data-cat="{{ $product->category_slug }}"
         data-price="{{ $product->price }}"
         data-search="{{ strtolower($product->name . ' ' . $product->category) }}">
      <div class="ur-shop__card-img">
        @if($product->old_price > $product->price)
          <div class="ur-shop__card-sale">SALE</div>
        @endif
        <div class="ur-shop__card-overlay">
          <button class="ur-shop__add-cart" data-name="{{ $product->name }}">
            <i class="fas fa-shopping-cart"></i> ADD TO CART
          </button>
        </div>
      </div>
      <div class="ur-shop__card-body">
        <span class="ur-shop__card-cat">{{ strtoupper($product->category) }}</span>
        <h3 class="ur-shop__card-name">{{ $product->name }}</h3>
        <div class="ur-shop__card-pricing">
          <span class="ur-shop__card-price">${{ number_format($product->price, 2) }}</span>
          @if($product->old_price > $product->price)
            <span class="ur-shop__card-old">${{ number_format($product->old_price, 2) }}</span>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="ur-shop__empty" id="shopEmpty" style="display:none;">
    <i class="fas fa-box-open"></i>
    <h3>NO PRODUCTS FOUND</h3>
    <p>TRY ADJUSTING YOUR FILTERS</p>
  </div>

</section>
@endsection

@section('custom-style')
<style>
/* HERO */
.ur-shop__hero { background: var(--bg-black); border-bottom: 2px solid rgba(255,255,255,0.1); padding: 80px 40px 60px; text-align: center; }
.ur-shop__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-shop__hero-outline { font-family: var(--font-display); font-size: 24px; letter-spacing: 10px; color: rgba(255,255,255,0.3); display: block; line-height: 1; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both; }
.ur-shop__hero-solid { font-family: var(--font-display); font-size: 72px; letter-spacing: 12px; color: var(--white); display: block; line-height: 1; margin-top: 4px; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both; }
.ur-shop__hero-sub { font-family: var(--font-display); font-size: 14px; letter-spacing: 6px; color: rgba(255,255,255,0.3); margin-top: 16px; }

/* LAYOUT */
.ur-shop { max-width: 1400px; margin: 0 auto; padding: 0 40px 80px; }
.ur-shop__filters { padding: 32px 0; border-bottom: 1px solid rgba(255,255,255,0.06); margin-bottom: 24px; }
.ur-shop__search-row { display: flex; gap: 12px; align-items: stretch; flex-wrap: wrap; }
.ur-shop__search { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 16px; flex: 1; min-width: 250px; transition: border-color 0.2s; }
.ur-shop__search:focus-within { border-color: var(--white); }
.ur-shop__search i { color: rgba(255,255,255,0.25); font-size: 14px; flex-shrink: 0; }
.ur-shop__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 14px; letter-spacing: 2px; padding: 14px 0; width: 100%; }
.ur-shop__search-input::placeholder { color: rgba(255,255,255,0.15); }
.ur-shop__select { background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 12px 16px; outline: none; cursor: pointer; -webkit-appearance: none; appearance: none; transition: border-color 0.2s; }
.ur-shop__select:focus { border-color: var(--white); }

/* RESULTS */
.ur-shop__results-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.ur-shop__count { font-family: var(--font-display); font-size: 13px; letter-spacing: 3px; color: rgba(255,255,255,0.3); }
.ur-shop__cart-indicator { display: flex; align-items: center; gap: 8px; font-family: var(--font-display); font-size: 14px; letter-spacing: 2px; color: rgba(255,255,255,0.4); border: 2px solid rgba(255,255,255,0.1); padding: 8px 16px; transition: all 0.15s; }
.ur-shop__cart-indicator.has-items { border-color: var(--white); color: var(--white); }

/* GRID */
.ur-shop__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

/* CARD */
.ur-shop__card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); position: relative; transition: all 0.2s; overflow: hidden; }
.ur-shop__card:hover { border-color: var(--white); transform: translate(-3px, -3px); box-shadow: 6px 6px 0 rgba(255,255,255,0.1); }
.ur-shop__card-img { position: relative; height: 220px; background: rgba(255,255,255,0.04); overflow: hidden; }
.ur-shop__card-img::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255,255,255,0.015) 2px, rgba(255,255,255,0.015) 3px); pointer-events: none; }
.ur-shop__card-sale { position: absolute; top: 12px; left: 12px; z-index: 2; font-family: var(--font-display); font-size: 11px; letter-spacing: 3px; padding: 4px 12px; background: var(--white); color: var(--bg-black); }
.ur-shop__card-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(5,5,5,0.85); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.25s; z-index: 3; }
.ur-shop__card:hover .ur-shop__card-overlay { opacity: 1; }
.ur-shop__add-cart { font-family: var(--font-display); font-size: 14px; letter-spacing: 3px; color: var(--white); padding: 12px 24px; border: 2px solid var(--white); background: none; cursor: pointer; transition: all 0.15s; }
.ur-shop__add-cart i { margin-right: 8px; }
.ur-shop__add-cart:hover { background: var(--white); color: var(--bg-black); }

/* CARD BODY */
.ur-shop__card-body { padding: 16px 18px 20px; }
.ur-shop__card-cat { font-family: var(--font-display); font-size: 10px; letter-spacing: 2.5px; color: rgba(255,255,255,0.25); display: block; margin-bottom: 6px; }
.ur-shop__card-name { font-family: var(--font-display); font-size: 18px; letter-spacing: 1px; color: var(--white); margin-bottom: 10px; line-height: 1.2; }
.ur-shop__card-pricing { display: flex; align-items: baseline; gap: 10px; }
.ur-shop__card-price { font-family: var(--font-display); font-size: 22px; letter-spacing: 1px; color: var(--white); }
.ur-shop__card-old { font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: rgba(255,255,255,0.25); text-decoration: line-through; }

/* EMPTY */
.ur-shop__empty { text-align: center; padding: 80px 20px; }
.ur-shop__empty i { font-size: 48px; color: rgba(255,255,255,0.08); margin-bottom: 16px; }
.ur-shop__empty h3 { font-family: var(--font-display); font-size: 24px; letter-spacing: 4px; color: rgba(255,255,255,0.25); margin-bottom: 8px; }
.ur-shop__empty p { font-family: var(--font-display); font-size: 12px; letter-spacing: 3px; color: rgba(255,255,255,0.15); }

/* RESPONSIVE */
@media (max-width: 1100px) { .ur-shop__grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) { .ur-shop__hero-solid { font-size: 48px; letter-spacing: 6px; } .ur-shop__grid { grid-template-columns: repeat(2, 1fr); } .ur-shop { padding: 0 20px 60px; } .ur-shop__hero { padding: 60px 20px 40px; } .ur-shop__search-row { flex-direction: column; } }
@media (max-width: 500px) { .ur-shop__grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var cards = document.querySelectorAll('.ur-shop__card');
  var searchInput = document.getElementById('shopSearch');
  var catFilter = document.getElementById('catFilter');
  var sortFilter = document.getElementById('sortFilter');
  var countEl = document.getElementById('shopCount');
  var emptyEl = document.getElementById('shopEmpty');
  var grid = document.getElementById('shopGrid');
  var cartCount = document.getElementById('cartCount');
  var cartIndicator = document.querySelector('.ur-shop__cart-indicator');
  var cartNum = 0;

  function filterShop() {
    var q = (searchInput ? searchInput.value : '').toLowerCase();
    var cf = catFilter ? catFilter.value : '';
    var visible = 0;
    cards.forEach(function(card) {
      var show = true;
      if (q && (card.dataset.search || '').indexOf(q) === -1) show = false;
      if (cf && card.dataset.cat !== cf) show = false;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    countEl.textContent = visible + ' PRODUCT' + (visible !== 1 ? 'S' : '');
    emptyEl.style.display = visible === 0 ? '' : 'none';
    grid.style.display = visible === 0 ? 'none' : '';
  }

  if (searchInput) searchInput.addEventListener('input', filterShop);
  if (catFilter) catFilter.addEventListener('change', filterShop);

  if (sortFilter) {
    sortFilter.addEventListener('change', function() {
      var arr = Array.from(cards);
      arr.sort(function(a, b) {
        var pa = parseFloat(a.dataset.price) || 0;
        var pb = parseFloat(b.dataset.price) || 0;
        if (sortFilter.value === 'low') return pa - pb;
        if (sortFilter.value === 'high') return pb - pa;
        return 0;
      });
      arr.forEach(function(card) { grid.appendChild(card); });
    });
  }

  document.querySelectorAll('.ur-shop__add-cart').forEach(function(btn) {
    btn.addEventListener('click', function() {
      cartNum++;
      cartCount.textContent = cartNum;
      cartIndicator.classList.add('has-items');
      this.innerHTML = '<i class="fas fa-check"></i> ADDED';
      this.style.background = 'var(--white)';
      this.style.color = 'var(--bg-black)';
      var self = this;
      setTimeout(function() {
        self.innerHTML = '<i class="fas fa-shopping-cart"></i> ADD TO CART';
        self.style.background = ''; self.style.color = '';
      }, 1200);
    });
  });

  cards.forEach(function(card, i) {
    card.style.opacity = '0'; card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    card.style.transitionDelay = (i * 0.05) + 's';
    setTimeout(function() { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

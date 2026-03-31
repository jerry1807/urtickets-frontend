@extends('frontend.layout')
@section('pageHeading')
  {{ __('Events') }}
@endsection

@section('hero-section')
{{-- BRUTALIST HERO BANNER --}}
<section class="ur-events__hero">
  <div class="ur-events__hero-inner">
    <h1 class="ur-events__hero-title">
      <span class="ur-events__hero-outline">DISCOVER</span>
      <span class="ur-events__hero-solid">EVENTS</span>
    </h1>
    <p class="ur-events__hero-sub">FIND YOUR NEXT UNFORGETTABLE EXPERIENCE</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-events">

  {{-- FILTER BAR --}}
  <div class="ur-events__filters">
    {{-- ROW 1: SEARCH --}}
    <div class="ur-events__search-row">
      <div class="ur-events__search">
        <i class="fas fa-search"></i>
        <input type="text" id="eventSearchInput" placeholder="SEARCH BY EVENT NAME, ORGANIZER, OR LOCATION..." class="ur-events__search-input">
      </div>
      <button class="ur-events__filter-toggle" id="filterToggle">
        <i class="fas fa-sliders-h"></i> FILTERS
        <span class="ur-events__filter-badge" id="activeFilterCount" style="display:none;">0</span>
      </button>
    </div>

    {{-- ROW 2: EXPANDABLE FILTERS --}}
    <div class="ur-events__filter-panel" id="filterPanel">
      <div class="ur-events__filter-grid">
        <div class="ur-events__filter-item">
          <label><i class="fas fa-folder"></i> CATEGORY</label>
          <select id="categoryFilter" class="ur-events__select">
            <option value="">ALL CATEGORIES</option>
            <option value="music">MUSIC</option>
            <option value="sports">SPORTS</option>
            <option value="tech">TECHNOLOGY</option>
            <option value="food">FOOD & DRINK</option>
            <option value="wedding">WEDDING</option>
            <option value="career">CAREER</option>
            <option value="conference">CONFERENCE</option>
            <option value="rooms">ROOMS</option>
          </select>
        </div>
        <div class="ur-events__filter-item">
          <label><i class="fas fa-map-pin"></i> CITY</label>
          <select id="cityFilter" class="ur-events__select">
            <option value="">ALL CITIES</option>
            <option value="orlando">ORLANDO</option>
            <option value="miami">MIAMI</option>
            <option value="tampa">TAMPA</option>
            <option value="jacksonville">JACKSONVILLE</option>
            <option value="online">ONLINE ONLY</option>
          </select>
        </div>
        <div class="ur-events__filter-item">
          <label><i class="fas fa-signal"></i> EVENT TYPE</label>
          <select id="typeFilter" class="ur-events__select">
            <option value="">ALL TYPES</option>
            <option value="venue">VENUE</option>
            <option value="online">ONLINE</option>
          </select>
        </div>
        <div class="ur-events__filter-item">
          <label><i class="fas fa-calendar-alt"></i> DATE</label>
          <select id="dateFilter" class="ur-events__select">
            <option value="">ANY DATE</option>
            <option value="this-week">THIS WEEK</option>
            <option value="this-month">THIS MONTH</option>
            <option value="next-month">NEXT MONTH</option>
            <option value="apr">APRIL 2026</option>
            <option value="may">MAY 2026</option>
            <option value="jun">JUNE 2026</option>
          </select>
        </div>
        <div class="ur-events__filter-item">
          <label><i class="fas fa-tag"></i> PRICE</label>
          <select id="priceFilter" class="ur-events__select">
            <option value="">ANY PRICE</option>
            <option value="free">FREE</option>
            <option value="under50">UNDER $50</option>
            <option value="50to100">$50 — $100</option>
            <option value="over100">$100+</option>
          </select>
        </div>
        <div class="ur-events__filter-item ur-events__filter-item--actions">
          <button class="ur-events__clear-btn" id="clearFilters">
            <i class="fas fa-times"></i> CLEAR ALL
          </button>
        </div>
      </div>
    </div>

    {{-- ROW 3: CATEGORY TAGS --}}
    <div class="ur-events__tags">
      <button class="ur-events__tag active" data-cat="">ALL</button>
      <button class="ur-events__tag" data-cat="music"><i class="fas fa-music"></i> MUSIC</button>
      <button class="ur-events__tag" data-cat="sports"><i class="fas fa-running"></i> SPORTS</button>
      <button class="ur-events__tag" data-cat="tech"><i class="fas fa-laptop-code"></i> TECHNOLOGY</button>
      <button class="ur-events__tag" data-cat="food"><i class="fas fa-utensils"></i> FOOD & DRINK</button>
      <button class="ur-events__tag" data-cat="wedding"><i class="fas fa-heart"></i> WEDDING</button>
      <button class="ur-events__tag" data-cat="career"><i class="fas fa-briefcase"></i> CAREER</button>
      <button class="ur-events__tag" data-cat="conference"><i class="fas fa-microphone-alt"></i> CONFERENCE</button>
      <button class="ur-events__tag" data-cat="rooms"><i class="fas fa-bed"></i> ROOMS</button>
    </div>
  </div>

  {{-- RESULTS COUNT --}}
  <div class="ur-events__results-bar">
    <span class="ur-events__count" id="resultCount">{{ count($eventList) }} EVENTS FOUND</span>
    <div class="ur-events__view-toggle">
      <button class="ur-events__view-btn active" data-view="grid" title="Grid"><i class="fas fa-th"></i></button>
      <button class="ur-events__view-btn" data-view="list" title="List"><i class="fas fa-list"></i></button>
    </div>
  </div>

  {{-- EVENT GRID --}}
  <div class="ur-events__grid" id="eventsGrid">
    @foreach($eventList as $event)
    <div class="ur-events__card"
         data-cat="{{ strtolower($event->category_slug) }}"
         data-type="{{ $event->event_type }}"
         data-price="{{ $event->price }}"
         data-city="{{ strtolower(explode(',', $event->location)[0]) }}"
         data-month="{{ strtolower($event->month) }}"
         data-search="{{ strtolower($event->title . ' ' . $event->organizer . ' ' . $event->location) }}">
      <div class="ur-events__card-img">
        <div class="ur-events__card-date">
          <span class="ur-events__card-day">{{ $event->day }}</span>
          <span class="ur-events__card-month">{{ $event->month }}</span>
        </div>
        <div class="ur-events__card-type ur-events__card-type--{{ $event->event_type }}">
          {{ strtoupper($event->event_type) }}
        </div>
        <div class="ur-events__card-overlay">
          <a href="#" class="ur-events__card-cta">SEE MORE</a>
        </div>
      </div>
      <div class="ur-events__card-body">
        <div class="ur-events__card-meta">
          <span><i class="far fa-clock"></i> {{ $event->time }}</span>
          <span><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
        </div>
        <h3 class="ur-events__card-title">{{ $event->title }}</h3>
        <p class="ur-events__card-desc">{{ $event->description }}</p>
        <div class="ur-events__card-footer">
          <span class="ur-events__card-org">BY {{ strtoupper($event->organizer) }}</span>
          <span class="ur-events__card-price {{ $event->price == 0 ? 'ur-events__card-price--free' : '' }}">
            {{ $event->price > 0 ? '$' . number_format($event->price) : 'FREE' }}
          </span>
        </div>
      </div>
      <a href="#" class="ur-events__card-wishlist"><i class="far fa-bookmark"></i></a>
    </div>
    @endforeach
  </div>

  {{-- EMPTY STATE --}}
  <div class="ur-events__empty" id="emptyState" style="display:none;">
    <i class="fas fa-calendar-times"></i>
    <h3>NO EVENTS FOUND</h3>
    <p>TRY ADJUSTING YOUR FILTERS</p>
  </div>

</section>
@endsection

@section('custom-style')
<style>
/* ══════════════════════════════════════
   EVENTS PAGE — BRUTALIST
   ══════════════════════════════════════ */

/* HERO */
.ur-events__hero {
  background: var(--bg-black);
  border-bottom: 2px solid rgba(255,255,255,0.1);
  padding: 80px 40px 60px;
  text-align: center;
}
.ur-events__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-events__hero-outline {
  font-family: var(--font-display);
  font-size: 72px;
  letter-spacing: 12px;
  color: transparent;
  -webkit-text-stroke: 2px rgba(255,255,255,0.3);
  display: block;
  line-height: 1;
  animation: stampIn 0.8s cubic-bezier(0.25, 1, 0.5, 1) both;
}
.ur-events__hero-solid {
  font-family: var(--font-display);
  font-size: 72px;
  letter-spacing: 12px;
  color: var(--white);
  display: block;
  line-height: 1;
  margin-top: -8px;
  animation: stampIn 0.8s cubic-bezier(0.25, 1, 0.5, 1) 0.15s both;
}
.ur-events__hero-sub {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 6px;
  color: rgba(255,255,255,0.3);
  margin-top: 16px;
}

/* FILTERS */
.ur-events {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 40px 80px;
}
.ur-events__filters {
  padding: 32px 0;
  border-bottom: 1px solid rgba(255,255,255,0.06);
  margin-bottom: 24px;
}

/* SEARCH ROW */
.ur-events__search-row {
  display: flex;
  gap: 12px;
  align-items: stretch;
  margin-bottom: 16px;
}
.ur-events__search {
  display: flex;
  align-items: center;
  gap: 10px;
  border: 2px solid rgba(255,255,255,0.1);
  padding: 0 16px;
  flex: 1;
  transition: border-color 0.2s;
}
.ur-events__search:focus-within { border-color: var(--white); }
.ur-events__search i { color: rgba(255,255,255,0.25); font-size: 14px; flex-shrink: 0; }
.ur-events__search-input {
  background: none; border: none; outline: none;
  color: var(--white);
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  padding: 14px 0;
  width: 100%;
}
.ur-events__search-input::placeholder { color: rgba(255,255,255,0.15); }

/* FILTER TOGGLE */
.ur-events__filter-toggle {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 2px;
  padding: 0 24px;
  background: none;
  border: 2px solid rgba(255,255,255,0.12);
  color: rgba(255,255,255,0.5);
  cursor: pointer;
  transition: all 0.15s;
  display: flex;
  align-items: center;
  gap: 10px;
  white-space: nowrap;
  flex-shrink: 0;
}
.ur-events__filter-toggle:hover,
.ur-events__filter-toggle.is-active {
  border-color: var(--white);
  color: var(--white);
}
.ur-events__filter-badge {
  font-size: 10px;
  min-width: 18px;
  height: 18px;
  background: var(--white);
  color: var(--bg-black);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

/* FILTER PANEL */
.ur-events__filter-panel {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.35s cubic-bezier(0.25, 1, 0.5, 1), padding 0.35s;
  padding: 0;
}
.ur-events__filter-panel.is-open {
  max-height: 200px;
  padding: 16px 0;
}
.ur-events__filter-grid {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 12px;
  align-items: end;
}
.ur-events__filter-item label {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
  display: block;
  margin-bottom: 6px;
}
.ur-events__filter-item label i { margin-right: 4px; font-size: 9px; }

.ur-events__select {
  width: 100%;
  background: rgba(255,255,255,0.04);
  border: 2px solid rgba(255,255,255,0.1);
  color: var(--white);
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  padding: 10px 12px;
  outline: none;
  cursor: pointer;
  -webkit-appearance: none; appearance: none;
  transition: border-color 0.2s;
}
.ur-events__select:focus { border-color: var(--white); }

.ur-events__filter-item--actions {
  display: flex;
  align-items: flex-end;
}
.ur-events__clear-btn {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  padding: 10px 16px;
  background: none;
  border: 2px solid rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.3);
  cursor: pointer;
  transition: all 0.15s;
  width: 100%;
  text-align: center;
}
.ur-events__clear-btn:hover { border-color: #ef4444; color: #ef4444; }
.ur-events__clear-btn i { margin-right: 4px; }

/* CATEGORY TAGS */
.ur-events__tags { display: flex; gap: 8px; flex-wrap: wrap; }
.ur-events__tag {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  padding: 8px 18px;
  background: none;
  border: 2px solid rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.35);
  cursor: pointer;
  transition: all 0.15s;
}
.ur-events__tag i { margin-right: 6px; font-size: 10px; }
.ur-events__tag:hover { border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.7); }
.ur-events__tag.active { border-color: var(--white); color: var(--white); background: rgba(255,255,255,0.05); }

/* RESULTS BAR */
.ur-events__results-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}
.ur-events__count {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.3);
}
.ur-events__view-toggle { display: flex; gap: 4px; }
.ur-events__view-btn {
  width: 36px; height: 36px;
  background: none;
  border: 2px solid rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.3);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all 0.15s; font-size: 13px;
}
.ur-events__view-btn:hover { border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.6); }
.ur-events__view-btn.active { border-color: var(--white); color: var(--white); }

/* EVENT GRID */
.ur-events__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.ur-events__grid.is-list {
  grid-template-columns: 1fr;
}
.ur-events__grid.is-list .ur-events__card {
  display: grid;
  grid-template-columns: 280px 1fr auto;
  gap: 0;
}
.ur-events__grid.is-list .ur-events__card-img { height: 200px; }
.ur-events__grid.is-list .ur-events__card-body { padding: 20px 24px; display: flex; flex-direction: column; justify-content: center; }

/* EVENT CARD */
.ur-events__card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  position: relative;
  transition: all 0.2s;
  overflow: hidden;
}
.ur-events__card:hover {
  border-color: var(--white);
  transform: translate(-3px, -3px);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.1);
}

/* CARD IMAGE */
.ur-events__card-img {
  position: relative;
  height: 200px;
  background: rgba(255,255,255,0.04);
  overflow: hidden;
}
.ur-events__card-img::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255,255,255,0.015) 2px, rgba(255,255,255,0.015) 3px);
  pointer-events: none;
}

/* DATE BADGE */
.ur-events__card-date {
  position: absolute; top: 12px; left: 12px;
  background: var(--bg-black);
  border: 2px solid var(--white);
  padding: 8px 12px;
  text-align: center;
  z-index: 2;
}
.ur-events__card-day {
  font-family: var(--font-display);
  font-size: 24px; color: var(--white);
  display: block; line-height: 1;
}
.ur-events__card-month {
  font-family: var(--font-display);
  font-size: 10px; letter-spacing: 2px;
  color: rgba(255,255,255,0.5);
  display: block; margin-top: 2px;
}

/* TYPE BADGE */
.ur-events__card-type {
  position: absolute; top: 12px; right: 12px;
  font-family: var(--font-display);
  font-size: 10px; letter-spacing: 2px;
  padding: 4px 10px;
  border: 2px solid;
  z-index: 2;
}
.ur-events__card-type--venue { border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.6); }
.ur-events__card-type--online { border-color: rgba(100,200,255,0.4); color: rgba(100,200,255,0.7); }

/* HOVER OVERLAY */
.ur-events__card-overlay {
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(5,5,5,0.85);
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transition: opacity 0.25s;
  z-index: 3;
}
.ur-events__card:hover .ur-events__card-overlay { opacity: 1; }
.ur-events__card-cta {
  font-family: var(--font-display);
  font-size: 16px; letter-spacing: 4px;
  color: var(--white);
  padding: 12px 28px;
  border: 2px solid var(--white);
  transition: all 0.15s;
}
.ur-events__card-cta:hover {
  background: var(--white); color: var(--bg-black);
}

/* CARD BODY */
.ur-events__card-body { padding: 18px 18px 20px; }
.ur-events__card-meta {
  display: flex; gap: 16px; margin-bottom: 10px;
}
.ur-events__card-meta span {
  font-family: var(--font-display);
  font-size: 10px; letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
}
.ur-events__card-meta i { margin-right: 4px; font-size: 9px; }
.ur-events__card-title {
  font-family: var(--font-display);
  font-size: 20px; letter-spacing: 1px;
  color: var(--white); margin-bottom: 8px;
  line-height: 1.2;
}
.ur-events__card-desc {
  font-family: var(--font-body);
  font-size: 13px; color: rgba(255,255,255,0.35);
  line-height: 1.5; margin-bottom: 14px;
  display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.ur-events__card-footer {
  display: flex; justify-content: space-between; align-items: center;
  padding-top: 14px;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.ur-events__card-org {
  font-family: var(--font-display);
  font-size: 10px; letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
}
.ur-events__card-price {
  font-family: var(--font-display);
  font-size: 20px; letter-spacing: 1px;
  color: var(--white);
}
.ur-events__card-price--free { font-size: 14px; letter-spacing: 3px; color: #22c55e; }

/* WISHLIST */
.ur-events__card-wishlist {
  position: absolute; top: 0; right: 0;
  width: 0; height: 0;
  border-top: 50px solid rgba(255,255,255,0.1);
  border-left: 50px solid transparent;
  z-index: 4; transition: all 0.2s;
}
.ur-events__card-wishlist i {
  position: absolute; top: -44px; right: 8px;
  font-size: 14px; color: rgba(255,255,255,0.5);
  transition: color 0.2s;
}
.ur-events__card:hover .ur-events__card-wishlist { border-top-color: var(--white); }
.ur-events__card:hover .ur-events__card-wishlist i { color: var(--bg-black); }

/* EMPTY STATE */
.ur-events__empty {
  text-align: center; padding: 80px 20px;
}
.ur-events__empty i { font-size: 48px; color: rgba(255,255,255,0.08); margin-bottom: 16px; }
.ur-events__empty h3 { font-family: var(--font-display); font-size: 24px; letter-spacing: 4px; color: rgba(255,255,255,0.25); margin-bottom: 8px; }
.ur-events__empty p { font-family: var(--font-display); font-size: 12px; letter-spacing: 3px; color: rgba(255,255,255,0.15); }

/* RESPONSIVE */
@media (max-width: 1100px) { .ur-events__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 1100px) {
  .ur-events__filter-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .ur-events__hero-outline, .ur-events__hero-solid { font-size: 48px; letter-spacing: 6px; }
  .ur-events__grid { grid-template-columns: 1fr; }
  .ur-events { padding: 0 20px 60px; }
  .ur-events__hero { padding: 60px 20px 40px; }
  .ur-events__search-row { flex-direction: column; }
  .ur-events__filter-grid { grid-template-columns: repeat(2, 1fr); }
  .ur-events__tags { overflow-x: auto; flex-wrap: nowrap; padding-bottom: 8px; }
  .ur-events__tag { flex-shrink: 0; }
}
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var cards = document.querySelectorAll('.ur-events__card');
  var tags = document.querySelectorAll('.ur-events__tag');
  var searchInput = document.getElementById('eventSearchInput');
  var catFilter = document.getElementById('categoryFilter');
  var cityFilter = document.getElementById('cityFilter');
  var typeFilter = document.getElementById('typeFilter');
  var dateFilter = document.getElementById('dateFilter');
  var priceFilter = document.getElementById('priceFilter');
  var countEl = document.getElementById('resultCount');
  var emptyEl = document.getElementById('emptyState');
  var grid = document.getElementById('eventsGrid');
  var filterBadge = document.getElementById('activeFilterCount');

  var allFilters = [catFilter, cityFilter, typeFilter, dateFilter, priceFilter];

  function countActiveFilters() {
    var n = 0;
    allFilters.forEach(function(f) { if (f && f.value) n++; });
    if (filterBadge) {
      filterBadge.textContent = n;
      filterBadge.style.display = n > 0 ? '' : 'none';
    }
    return n;
  }

  function matchPrice(cardPrice, filterVal) {
    var p = parseFloat(cardPrice) || 0;
    if (filterVal === 'free') return p === 0;
    if (filterVal === 'under50') return p > 0 && p < 50;
    if (filterVal === '50to100') return p >= 50 && p <= 100;
    if (filterVal === 'over100') return p > 100;
    return true;
  }

  function matchDate(cardMonth, filterVal) {
    if (!filterVal) return true;
    var m = (cardMonth || '').toLowerCase();
    if (filterVal === 'apr') return m === 'apr';
    if (filterVal === 'may') return m === 'may';
    if (filterVal === 'jun') return m === 'jun';
    if (filterVal === 'this-month') return m === 'mar';
    if (filterVal === 'next-month') return m === 'apr';
    if (filterVal === 'this-week') return true; // show all for demo
    return true;
  }

  function filterAll() {
    var q = (searchInput ? searchInput.value : '').toLowerCase();
    var activeCat = document.querySelector('.ur-events__tag.active');
    var cat = activeCat ? activeCat.dataset.cat : '';
    var cf = catFilter ? catFilter.value : '';
    var cy = cityFilter ? cityFilter.value : '';
    var tf = typeFilter ? typeFilter.value : '';
    var df = dateFilter ? dateFilter.value : '';
    var pf = priceFilter ? priceFilter.value : '';
    var useCat = cat || cf;
    var visible = 0;

    cards.forEach(function(card) {
      var show = true;
      if (q && (card.dataset.search || '').indexOf(q) === -1) show = false;
      if (useCat && card.dataset.cat !== useCat) show = false;
      if (cy) {
        if (cy === 'online') { if (card.dataset.type !== 'online') show = false; }
        else { if (card.dataset.city !== cy) show = false; }
      }
      if (tf && card.dataset.type !== tf) show = false;
      if (df && !matchDate(card.dataset.month, df)) show = false;
      if (pf && !matchPrice(card.dataset.price, pf)) show = false;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });

    countEl.textContent = visible + ' EVENT' + (visible !== 1 ? 'S' : '') + ' FOUND';
    emptyEl.style.display = visible === 0 ? '' : 'none';
    grid.style.display = visible === 0 ? 'none' : '';
    countActiveFilters();
  }

  // Tags sync with category dropdown
  tags.forEach(function(tag) {
    tag.addEventListener('click', function() {
      tags.forEach(function(t) { t.classList.remove('active'); });
      this.classList.add('active');
      if (catFilter) catFilter.value = this.dataset.cat;
      filterAll();
    });
  });

  // All filter listeners
  if (searchInput) searchInput.addEventListener('input', filterAll);
  allFilters.forEach(function(f) {
    if (f) f.addEventListener('change', function() {
      // Sync tags when category dropdown changes
      if (f === catFilter) {
        tags.forEach(function(t) { t.classList.remove('active'); if (t.dataset.cat === catFilter.value) t.classList.add('active'); });
      }
      filterAll();
    });
  });

  // Filter panel toggle
  var filterToggle = document.getElementById('filterToggle');
  var filterPanel = document.getElementById('filterPanel');
  if (filterToggle && filterPanel) {
    filterToggle.addEventListener('click', function() {
      filterPanel.classList.toggle('is-open');
      filterToggle.classList.toggle('is-active');
    });
  }

  // Clear all filters
  var clearBtn = document.getElementById('clearFilters');
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      allFilters.forEach(function(f) { if (f) f.value = ''; });
      if (searchInput) searchInput.value = '';
      tags.forEach(function(t) { t.classList.remove('active'); });
      tags[0].classList.add('active');
      filterAll();
    });
  }

  // View toggle
  var viewBtns = document.querySelectorAll('.ur-events__view-btn');
  viewBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      viewBtns.forEach(function(b) { b.classList.remove('active'); });
      this.classList.add('active');
      grid.classList.toggle('is-list', this.dataset.view === 'list');
    });
  });

  // Stagger entrance
  cards.forEach(function(card, i) {
    card.style.opacity = '0'; card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    card.style.transitionDelay = (i * 0.06) + 's';
    setTimeout(function() { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

@extends('frontend.layout')
@section('pageHeading')
  {{ __('Organizers') }}
@endsection

@section('hero-section')
<section class="ur-org__hero">
  <div class="ur-org__hero-inner">
    <h1 class="ur-org__hero-title">
      <span class="ur-org__hero-outline">MEET THE</span>
      <span class="ur-org__hero-solid">ORGANIZERS</span>
    </h1>
    <p class="ur-org__hero-sub">THE PEOPLE BEHIND YOUR FAVORITE EVENTS</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-org">

  {{-- SEARCH --}}
  <div class="ur-org__filters">
    <div class="ur-org__search-row">
      <div class="ur-org__search">
        <i class="fas fa-search"></i>
        <input type="text" id="orgSearch" placeholder="SEARCH BY NAME, USERNAME, OR LOCATION..." class="ur-org__search-input">
      </div>
    </div>
    <div class="ur-org__results-bar">
      <span class="ur-org__count" id="orgCount">{{ count($organizers) }} ORGANIZERS</span>
    </div>
  </div>

  {{-- GRID --}}
  <div class="ur-org__grid" id="orgGrid">
    @foreach($organizers as $org)
    <div class="ur-org__card" data-search="{{ strtolower($org->name . ' ' . $org->username . ' ' . $org->location) }}">
      <div class="ur-org__card-avatar">
        <span class="ur-org__card-initial">{{ strtoupper(substr($org->name, 0, 1)) }}</span>
      </div>
      <div class="ur-org__card-body">
        <h3 class="ur-org__card-name">{{ $org->name }}</h3>
        <span class="ur-org__card-username">{{ '@' . $org->username }}</span>
        <div class="ur-org__card-meta">
          <span><i class="fas fa-calendar"></i> {{ $org->events }} EVENTS</span>
          <span><i class="fas fa-map-marker-alt"></i> {{ strtoupper($org->location) }}</span>
        </div>
      </div>
      <div class="ur-org__card-footer">
        <a href="#" class="ur-org__card-btn">VIEW PROFILE <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="ur-org__card-rank" title="{{ $org->events }} events">{{ $org->events }}</div>
    </div>
    @endforeach
  </div>

  <div class="ur-org__empty" id="orgEmpty" style="display:none;">
    <i class="fas fa-users-slash"></i>
    <h3>NO ORGANIZERS FOUND</h3>
    <p>TRY A DIFFERENT SEARCH</p>
  </div>

</section>
@endsection

@section('custom-style')
<style>
/* HERO */
.ur-org__hero {
  background: var(--bg-black);
  border-bottom: 2px solid rgba(255,255,255,0.1);
  padding: 80px 40px 60px;
  text-align: center;
}
.ur-org__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-org__hero-outline {
  font-family: var(--font-display);
  font-size: 24px;
  letter-spacing: 10px;
  color: rgba(255,255,255,0.3);
  display: block;
  line-height: 1;
  animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both;
}
.ur-org__hero-solid {
  font-family: var(--font-display);
  font-size: 72px;
  letter-spacing: 12px;
  color: var(--white);
  display: block;
  line-height: 1;
  margin-top: 4px;
  animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both;
}
.ur-org__hero-sub {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 6px;
  color: rgba(255,255,255,0.3);
  margin-top: 16px;
}

/* FILTERS */
.ur-org {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 40px 80px;
}
.ur-org__filters {
  padding: 32px 0;
  border-bottom: 1px solid rgba(255,255,255,0.06);
  margin-bottom: 24px;
}
.ur-org__search-row { margin-bottom: 16px; }
.ur-org__search {
  display: flex;
  align-items: center;
  gap: 10px;
  border: 2px solid rgba(255,255,255,0.1);
  padding: 0 16px;
  transition: border-color 0.2s;
}
.ur-org__search:focus-within { border-color: var(--white); }
.ur-org__search i { color: rgba(255,255,255,0.25); font-size: 14px; flex-shrink: 0; }
.ur-org__search-input {
  background: none; border: none; outline: none;
  color: var(--white);
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  padding: 14px 0;
  width: 100%;
}
.ur-org__search-input::placeholder { color: rgba(255,255,255,0.15); }
.ur-org__results-bar { display: flex; justify-content: space-between; align-items: center; }
.ur-org__count { font-family: var(--font-display); font-size: 13px; letter-spacing: 3px; color: rgba(255,255,255,0.3); }

/* GRID */
.ur-org__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

/* CARD */
.ur-org__card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 0;
  position: relative;
  transition: all 0.2s;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}
.ur-org__card:hover {
  border-color: var(--white);
  transform: translate(-3px, -3px);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.1);
}

.ur-org__card-avatar {
  height: 100px;
  background: rgba(255,255,255,0.04);
  display: flex;
  align-items: center;
  justify-content: center;
  border-bottom: 2px solid rgba(255,255,255,0.06);
  position: relative;
}
.ur-org__card-avatar::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255,255,255,0.01) 2px, rgba(255,255,255,0.01) 3px);
  pointer-events: none;
}
.ur-org__card-initial {
  font-family: var(--font-display);
  font-size: 42px;
  color: rgba(255,255,255,0.12);
  letter-spacing: 2px;
  transition: color 0.2s;
}
.ur-org__card:hover .ur-org__card-initial { color: var(--white); }

.ur-org__card-body {
  padding: 18px 20px 14px;
  flex: 1;
}
.ur-org__card-name {
  font-family: var(--font-display);
  font-size: 20px;
  letter-spacing: 1px;
  color: var(--white);
  margin-bottom: 2px;
}
.ur-org__card-username {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
  display: block;
  margin-bottom: 12px;
}
.ur-org__card-meta {
  display: flex;
  gap: 16px;
}
.ur-org__card-meta span {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.25);
}
.ur-org__card-meta i { margin-right: 4px; font-size: 9px; }

.ur-org__card-footer {
  padding: 14px 20px;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.ur-org__card-btn {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.35);
  transition: color 0.15s;
}
.ur-org__card-btn i { margin-left: 6px; font-size: 10px; }
.ur-org__card:hover .ur-org__card-btn { color: var(--white); }

.ur-org__card-rank {
  position: absolute;
  top: 12px;
  right: 12px;
  font-family: var(--font-display);
  font-size: 36px;
  color: rgba(255,255,255,0.06);
  line-height: 1;
  z-index: 1;
}
.ur-org__card:hover .ur-org__card-rank { color: rgba(255,255,255,0.15); }

/* EMPTY */
.ur-org__empty { text-align: center; padding: 80px 20px; }
.ur-org__empty i { font-size: 48px; color: rgba(255,255,255,0.08); margin-bottom: 16px; }
.ur-org__empty h3 { font-family: var(--font-display); font-size: 24px; letter-spacing: 4px; color: rgba(255,255,255,0.25); margin-bottom: 8px; }
.ur-org__empty p { font-family: var(--font-display); font-size: 12px; letter-spacing: 3px; color: rgba(255,255,255,0.15); }

/* RESPONSIVE */
@media (max-width: 1100px) { .ur-org__grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) {
  .ur-org__hero-solid { font-size: 48px; letter-spacing: 6px; }
  .ur-org__grid { grid-template-columns: repeat(2, 1fr); }
  .ur-org { padding: 0 20px 60px; }
  .ur-org__hero { padding: 60px 20px 40px; }
}
@media (max-width: 500px) { .ur-org__grid { grid-template-columns: 1fr; } }
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var cards = document.querySelectorAll('.ur-org__card');
  var searchInput = document.getElementById('orgSearch');
  var countEl = document.getElementById('orgCount');
  var emptyEl = document.getElementById('orgEmpty');
  var grid = document.getElementById('orgGrid');

  function filterOrgs() {
    var q = (searchInput ? searchInput.value : '').toLowerCase();
    var visible = 0;
    cards.forEach(function(card) {
      var show = !q || (card.dataset.search || '').indexOf(q) !== -1;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    countEl.textContent = visible + ' ORGANIZER' + (visible !== 1 ? 'S' : '');
    emptyEl.style.display = visible === 0 ? '' : 'none';
    grid.style.display = visible === 0 ? 'none' : '';
  }

  if (searchInput) searchInput.addEventListener('input', filterOrgs);

  cards.forEach(function(card, i) {
    card.style.opacity = '0'; card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    card.style.transitionDelay = (i * 0.05) + 's';
    setTimeout(function() { card.style.opacity = '1'; card.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

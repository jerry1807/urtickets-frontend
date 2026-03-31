@extends('frontend.layout')
@section('pageHeading')
  {{ __('PWA Scanner') }}
@endsection

@section('hero-section')
<style>
.header-area, .header, .ur-header, .main-header { display: none !important; }
.page-wrapper { overflow: visible !important; }
.ur-dash__topbar { display: flex !important; }
</style>
@endsection

@section('content')
<div class="ur-dash">
  {{-- SIDEBAR --}}
  <aside class="ur-dash__sidebar" id="dashSidebar">
    <div class="ur-dash__sidebar-top">
      <div class="ur-dash__sidebar-brand">
        <a href="{{ route('index') }}">
          <div class="ur-landing__right-brand" style="transform: rotate(-2deg); font-size: 16px;">
            <span class="ur-landing__right-brand-ur" style="font-size: 20px;">UR</span><span class="ur-landing__right-brand-reveal">TICKETS</span>
          </div>
        </a>
      </div>
      <button class="ur-dash__collapse" id="sidebarCollapse" title="Toggle sidebar">
        <i class="fas fa-angle-double-left ur-dash__collapse-icon"></i>
      </button>
    </div>
    <div class="ur-dash__sidebar-search">
      <i class="fas fa-search"></i>
      <input type="text" id="navSearch" placeholder="Search menu..." class="ur-dash__nav-search">
    </div>
    <nav class="ur-dash__nav" id="dashNav">
      <a href="{{ route('organizer.dashboard') }}" class="ur-dash__nav-item" data-label="dashboard"><i class="fas fa-th-large"></i> <span>DASHBOARD</span></a>
      <a href="{{ route('organizer.event-management') }}" class="ur-dash__nav-item" data-label="event management"><i class="fas fa-calendar-plus"></i> <span>EVENT MANAGEMENT</span></a>
      <a href="{{ route('organizer.event-bookings') }}" class="ur-dash__nav-item" data-label="event bookings"><i class="fas fa-ticket-alt"></i> <span>EVENT BOOKINGS</span></a>
      <a href="{{ route('organizer.withdraw') }}" class="ur-dash__nav-item" data-label="withdraw"><i class="fas fa-wallet"></i> <span>WITHDRAW</span></a>
      <a href="{{ route('organizer.transactions') }}" class="ur-dash__nav-item" data-label="transactions"><i class="fas fa-exchange-alt"></i> <span>TRANSACTIONS</span></a>
      <a href="{{ route('organizer.pwa-scanner') }}" class="ur-dash__nav-item active" data-label="pwa scanner"><i class="fas fa-qrcode"></i> <span>PWA SCANNER</span></a>
      <a href="{{ route('organizer.support-tickets') }}" class="ur-dash__nav-item" data-label="support tickets"><i class="fas fa-life-ring"></i> <span>SUPPORT TICKETS</span></a>
    </nav>
  </aside>

  {{-- MAIN --}}
  <main class="ur-dash__main">
    <div class="ur-dash__topbar">
      <div>
        <h1 class="ur-sc__heading">
          <span class="ur-sc__heading-label">BOOKING</span>
          <span class="ur-sc__heading-title">SCANNER</span>
          <span class="ur-sc__heading-line"></span>
        </h1>
        <p class="ur-dash__date">{{ strtoupper(date('l, F j, Y')) }}</p>
      </div>
      <div class="ur-dash__topbar-actions">
        <div class="ur-dash__profile" id="profileToggle">
          <div class="ur-dash__avatar">J</div>
          <div class="ur-dash__profile-info"><strong>JHON</strong><span>ORGANIZER</span></div>
          <i class="fas fa-chevron-down ur-dash__profile-arrow"></i>
          <div class="ur-dash__dropdown" id="profileDropdown">
            <a href="#" class="ur-dash__dropdown-item"><i class="fas fa-user-edit"></i> EDIT PROFILE</a>
            <a href="#" class="ur-dash__dropdown-item"><i class="fas fa-shield-alt"></i> SECURITY SETTINGS</a>
            <a href="#" class="ur-dash__dropdown-item"><i class="fas fa-cog"></i> SYSTEM SETTINGS</a>
            <div class="ur-dash__dropdown-divider"></div>
            <a href="{{ route('organizer.logout') }}" class="ur-dash__dropdown-item ur-dash__dropdown-item--logout"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>
          </div>
        </div>
      </div>
    </div>

    {{-- TABS --}}
    <div class="ur-sc__tabs">
      <button class="ur-sc__tab active" data-tab="scanner"><i class="fas fa-qrcode"></i> SCANNER</button>
      <button class="ur-sc__tab" data-tab="history"><i class="fas fa-history"></i> SCAN HISTORY</button>
      <div class="ur-sc__tab-indicator"></div>
    </div>

    {{-- ═══════════════════ SCANNER ═══════════════════ --}}
    <div class="ur-sc__panel active" id="panel-scanner">
      <div class="ur-sc__scanner-layout">

        {{-- SCANNER VIEWPORT --}}
        <div class="ur-sc__viewport-card">
          <div class="ur-sc__viewport" id="scannerViewport">
            <div class="ur-sc__crosshair">
              <div class="ur-sc__crosshair-corner ur-sc__crosshair-corner--tl"></div>
              <div class="ur-sc__crosshair-corner ur-sc__crosshair-corner--tr"></div>
              <div class="ur-sc__crosshair-corner ur-sc__crosshair-corner--bl"></div>
              <div class="ur-sc__crosshair-corner ur-sc__crosshair-corner--br"></div>
              <div class="ur-sc__scanline"></div>
            </div>
            <div class="ur-sc__viewport-status" id="scanStatus">
              <i class="fas fa-video-slash"></i>
              <span>CAMERA INACTIVE</span>
            </div>
          </div>

          <div class="ur-sc__controls">
            <button class="ur-sc__ctrl-btn ur-sc__ctrl-btn--primary" id="cameraBtn">
              <i class="fas fa-video"></i> ACTIVATE CAMERA
            </button>
            <div class="ur-sc__ctrl-divider">OR</div>
            <label class="ur-sc__ctrl-btn ur-sc__ctrl-btn--ghost" id="fileLabel">
              <i class="fas fa-image"></i> UPLOAD QR IMAGE
              <input type="file" accept="image/*" class="ur-sc__file-input" id="qrFileInput">
            </label>
          </div>
        </div>

        {{-- RESULT CARD --}}
        <div class="ur-sc__result-card" id="resultCard">
          <div class="ur-sc__result-header">
            <h3>VERIFICATION RESULT</h3>
            <div class="ur-sc__result-status" id="resultStatus">
              <i class="fas fa-ellipsis-h"></i> WAITING FOR SCAN
            </div>
          </div>

          <div class="ur-sc__result-body" id="resultBody">
            <div class="ur-sc__result-empty">
              <i class="fas fa-qrcode"></i>
              <p>SCAN A QR CODE TO VERIFY</p>
              <span>USE CAMERA OR UPLOAD AN IMAGE</span>
            </div>
          </div>

          {{-- MOCK: shows after scan --}}
          <div class="ur-sc__result-data" id="resultData" style="display:none;">
            <div class="ur-sc__result-row">
              <span>BOOKING ID</span>
              <strong id="rBookingId">#10847</strong>
            </div>
            <div class="ur-sc__result-row">
              <span>EVENT</span>
              <strong id="rEvent">ANITO GETRATIC FESTTALI 20</strong>
            </div>
            <div class="ur-sc__result-row">
              <span>ATTENDEE</span>
              <strong id="rAttendee">MARIA S.</strong>
            </div>
            <div class="ur-sc__result-row">
              <span>TICKETS</span>
              <strong id="rTickets">2</strong>
            </div>
            <div class="ur-sc__result-row">
              <span>DATE</span>
              <strong id="rDate">APR 12, 2026 8:00 PM</strong>
            </div>
            <div class="ur-sc__result-row">
              <span>STATUS</span>
              <strong id="rStatus" class="ur-sc__verified">VERIFIED</strong>
            </div>
            <button class="ur-sc__btn ur-sc__btn--primary" id="scanAgainBtn">
              <i class="fas fa-redo"></i> SCAN AGAIN
            </button>
          </div>
        </div>

      </div>

      {{-- QUICK STATS --}}
      <div class="ur-sc__quick-stats">
        <div class="ur-sc__quick-stat">
          <span class="ur-sc__quick-val">{{ $scanData->total_scans }}</span>
          <span class="ur-sc__quick-lbl">SCANS TODAY</span>
        </div>
        <div class="ur-sc__quick-stat">
          <span class="ur-sc__quick-val ur-sc__quick-val--green">{{ $scanData->verified }}</span>
          <span class="ur-sc__quick-lbl">VERIFIED</span>
        </div>
        <div class="ur-sc__quick-stat">
          <span class="ur-sc__quick-val ur-sc__quick-val--red">{{ $scanData->invalid }}</span>
          <span class="ur-sc__quick-lbl">INVALID</span>
        </div>
        <div class="ur-sc__quick-stat">
          <span class="ur-sc__quick-val">{{ $scanData->duplicate }}</span>
          <span class="ur-sc__quick-lbl">DUPLICATE</span>
        </div>
      </div>
    </div>

    {{-- ═══════════════════ HISTORY ═══════════════════ --}}
    <div class="ur-sc__panel" id="panel-history">

      <div class="ur-sc__toolbar">
        <div class="ur-sc__search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="histSearch" placeholder="SEARCH BOOKING ID..." class="ur-sc__search-input">
        </div>
        <select id="histFilter" class="ur-sc__filter-select">
          <option value="">ALL RESULTS</option>
          <option value="verified">VERIFIED</option>
          <option value="invalid">INVALID</option>
          <option value="duplicate">DUPLICATE</option>
        </select>
      </div>

      <div class="ur-sc__history-list" id="historyList">
        @foreach($scanHistory as $scan)
        <div class="ur-sc__history-item" data-result="{{ $scan->result }}" data-search="{{ strtolower($scan->booking_id . ' ' . $scan->event) }}">
          <div class="ur-sc__history-icon ur-sc__history-icon--{{ $scan->result }}">
            <i class="fas fa-{{ $scan->result === 'verified' ? 'check' : ($scan->result === 'invalid' ? 'times' : 'clone') }}"></i>
          </div>
          <div class="ur-sc__history-info">
            <strong>#{{ $scan->booking_id }} — {{ $scan->event }}</strong>
            <span>{{ $scan->attendee }} &bull; {{ $scan->tickets }} TICKET{{ $scan->tickets > 1 ? 'S' : '' }}</span>
          </div>
          <div class="ur-sc__history-time">{{ $scan->time }}</div>
          <span class="ur-sc__history-badge ur-sc__history-badge--{{ $scan->result }}">{{ strtoupper($scan->result) }}</span>
        </div>
        @endforeach
      </div>
    </div>

  </main>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {

  // TABS
  var tabs = document.querySelectorAll('.ur-sc__tab');
  var panels = document.querySelectorAll('.ur-sc__panel');
  var indicator = document.querySelector('.ur-sc__tab-indicator');
  function setInd(t) { indicator.style.width = t.offsetWidth + 'px'; indicator.style.left = t.offsetLeft + 'px'; }
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabs.forEach(function(t) { t.classList.remove('active'); });
      panels.forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById('panel-' + this.dataset.tab).classList.add('active');
      setInd(this);
    });
  });
  var at = document.querySelector('.ur-sc__tab.active');
  if (at && indicator) setInd(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-sc__tab.active'); if (a && indicator) setInd(a); });

  // MOCK SCAN (camera button simulates a scan)
  var cameraBtn = document.getElementById('cameraBtn');
  var resultBody = document.getElementById('resultBody');
  var resultData = document.getElementById('resultData');
  var resultStatus = document.getElementById('resultStatus');
  var scanStatus = document.getElementById('scanStatus');

  if (cameraBtn) {
    cameraBtn.addEventListener('click', function() {
      // Simulate scanning
      scanStatus.innerHTML = '<i class="fas fa-circle ur-sc__pulse"></i> <span>SCANNING...</span>';
      scanStatus.classList.add('is-active');
      cameraBtn.disabled = true;
      cameraBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> SCANNING...';

      setTimeout(function() {
        scanStatus.innerHTML = '<i class="fas fa-check-circle"></i> <span>SCAN COMPLETE</span>';
        resultBody.style.display = 'none';
        resultData.style.display = '';
        resultStatus.innerHTML = '<i class="fas fa-check-circle"></i> VERIFIED';
        resultStatus.className = 'ur-sc__result-status ur-sc__result-status--verified';
        cameraBtn.disabled = false;
        cameraBtn.innerHTML = '<i class="fas fa-video"></i> ACTIVATE CAMERA';
      }, 1500);
    });
  }

  // Scan again
  var scanAgain = document.getElementById('scanAgainBtn');
  if (scanAgain) {
    scanAgain.addEventListener('click', function() {
      resultBody.style.display = '';
      resultData.style.display = 'none';
      resultStatus.innerHTML = '<i class="fas fa-ellipsis-h"></i> WAITING FOR SCAN';
      resultStatus.className = 'ur-sc__result-status';
      scanStatus.innerHTML = '<i class="fas fa-video-slash"></i> <span>CAMERA INACTIVE</span>';
      scanStatus.classList.remove('is-active');
    });
  }

  // File upload mock
  var fileInput = document.getElementById('qrFileInput');
  if (fileInput) {
    fileInput.addEventListener('change', function() {
      if (this.files.length > 0) {
        scanStatus.innerHTML = '<i class="fas fa-image"></i> <span>PROCESSING IMAGE...</span>';
        setTimeout(function() {
          scanStatus.innerHTML = '<i class="fas fa-check-circle"></i> <span>QR DETECTED</span>';
          resultBody.style.display = 'none';
          resultData.style.display = '';
          resultStatus.innerHTML = '<i class="fas fa-check-circle"></i> VERIFIED';
          resultStatus.className = 'ur-sc__result-status ur-sc__result-status--verified';
        }, 1000);
      }
    });
  }

  // History filter
  var histItems = document.querySelectorAll('.ur-sc__history-item');
  function filterHist() {
    var q = (document.getElementById('histSearch') || {}).value.toLowerCase();
    var f = (document.getElementById('histFilter') || {}).value;
    histItems.forEach(function(item) {
      var show = true;
      if (q && (item.dataset.search || '').indexOf(q) === -1) show = false;
      if (f && item.dataset.result !== f) show = false;
      item.style.display = show ? '' : 'none';
    });
  }
  var hs = document.getElementById('histSearch');
  var hf = document.getElementById('histFilter');
  if (hs) hs.addEventListener('input', filterHist);
  if (hf) hf.addEventListener('change', filterHist);

  // SHARED
  var toggle = document.getElementById('profileToggle');
  var dropdown = document.getElementById('profileDropdown');
  if (toggle && dropdown) {
    toggle.addEventListener('click', function(e) { e.stopPropagation(); dropdown.classList.toggle('is-open'); toggle.classList.toggle('is-open'); });
    document.addEventListener('click', function() { dropdown.classList.remove('is-open'); toggle.classList.remove('is-open'); });
    dropdown.addEventListener('click', function(e) { e.stopPropagation(); });
  }
  var sidebar = document.getElementById('dashSidebar');
  var cb = document.getElementById('sidebarCollapse');
  if (cb && sidebar) { cb.addEventListener('click', function() { sidebar.classList.toggle('is-collapsed'); document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed'); }); }
  var ns = document.getElementById('navSearch');
  if (ns) { ns.addEventListener('input', function() { var q = this.value.toLowerCase(); document.querySelectorAll('.ur-dash__nav-item').forEach(function(i) { i.style.display = (i.getAttribute('data-label') || '').includes(q) ? '' : 'none'; }); }); }
});
</script>
@endsection

@section('custom-style')
<style>
.footer-section { display: none !important; }

/* DASHBOARD SHELL */
.ur-dash { display: flex; min-height: 100vh; background: var(--bg-black); }
.ur-dash__sidebar { width: 240px; flex-shrink: 0; background: var(--bg-black); border-right: 2px solid var(--white); display: flex; flex-direction: column; padding: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; transition: width 0.3s cubic-bezier(0.25,1,0.5,1); }
.ur-dash__sidebar.is-collapsed { width: 60px; }
.sidebar-collapsed .ur-dash__main { margin-left: 0; }
.ur-dash__sidebar-top { display: flex; align-items: center; justify-content: space-between; padding: 16px 16px 12px; border-bottom: 1px solid rgba(255,255,255,0.08); transition: padding 0.3s cubic-bezier(0.25,1,0.5,1), justify-content 0.3s; }
.ur-dash__sidebar-brand a { text-decoration: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-brand { display: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-top { justify-content: center; padding: 16px 0 12px; }
.ur-dash__collapse { width: 34px; height: 34px; background: none; border: 2px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; padding: 0; transition: border-color 0.3s, background 0.3s; }
.ur-dash__collapse:hover { border-color: var(--white); background: rgba(255,255,255,0.06); }
.ur-dash__collapse-icon { font-size: 14px; color: var(--white); display: block; width: 14px; height: 14px; text-align: center; line-height: 14px; transition: transform 0.5s cubic-bezier(0.34,1.56,0.64,1); }
.ur-dash__sidebar.is-collapsed .ur-dash__collapse-icon { transform: rotate(180deg); }
.ur-dash__sidebar-search { padding: 10px 16px; margin-top: 12px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 8px; }
.ur-dash__sidebar-search i { color: rgba(255,255,255,0.25); font-size: 12px; flex-shrink: 0; }
.ur-dash__nav-search { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 12px; letter-spacing: 1.5px; width: 100%; }
.ur-dash__nav-search::placeholder { color: rgba(255,255,255,0.2); }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-search { padding: 10px 0; justify-content: center; }
.ur-dash__sidebar.is-collapsed .ur-dash__nav-search { display: none; }
.ur-dash__nav { flex: 1; padding: 12px 0; display: flex; flex-direction: column; }
.ur-dash__nav-item { display: flex; align-items: center; gap: 12px; padding: 10px 20px; font-family: var(--font-display); font-size: 13px; letter-spacing: 1.5px; color: rgba(255,255,255,0.45); transition: all 0.12s; border-left: 3px solid transparent; overflow: hidden; white-space: nowrap; }
.ur-dash__nav-item:hover { color: var(--white); background: rgba(255,255,255,0.03); border-left-color: rgba(255,255,255,0.3); }
.ur-dash__nav-item.active { color: var(--white); background: rgba(255,255,255,0.06); border-left-color: var(--white); }
.ur-dash__nav-item i { width: 18px; text-align: center; font-size: 14px; }
.ur-dash__nav-item span { display: inline-block; max-width: 180px; opacity: 1; transition: max-width 0.4s cubic-bezier(0.25,1,0.5,1), opacity 0.25s ease, margin 0.4s; overflow: hidden; vertical-align: middle; margin-left: 0; }
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item span { max-width: 0; opacity: 0; margin-left: -4px; }
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item { justify-content: center; padding: 14px 0; }
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item i { margin: 0; font-size: 16px; }
.ur-dash__main { flex: 1; padding: 28px 32px; min-width: 0; overflow-x: hidden; overflow: visible !important; }
.ur-dash__topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; gap: 20px; position: relative; z-index: 50; }
.ur-dash__date { font-family: var(--font-display); font-size: 12px; color: rgba(255,255,255,0.25); letter-spacing: 3px; margin-top: 4px; }
.ur-dash__topbar-actions { display: flex; align-items: center; gap: 16px; }
.ur-dash__profile { display: flex; align-items: center; gap: 10px; padding: 6px 12px; cursor: pointer; position: relative; border: 2px solid transparent; transition: border-color 0.15s; }
.ur-dash__profile:hover, .ur-dash__profile.is-open { border-color: rgba(255,255,255,0.15); }
.ur-dash__avatar { width: 38px; height: 38px; background: var(--white); color: var(--bg-black); font-family: var(--font-display); font-size: 18px; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; }
.ur-dash__profile-info { display: flex; flex-direction: column; }
.ur-dash__profile-info strong { font-family: var(--font-display); font-size: 14px; color: var(--white); letter-spacing: 2px; line-height: 1; }
.ur-dash__profile-info span { font-family: var(--font-display); font-size: 9px; color: rgba(255,255,255,0.35); letter-spacing: 2px; }
.ur-dash__profile-arrow { font-size: 10px; color: rgba(255,255,255,0.4); transition: transform 0.2s; }
.ur-dash__profile.is-open .ur-dash__profile-arrow { transform: rotate(180deg); }
.ur-dash__dropdown { position: absolute; top: calc(100% + 8px); right: 0; width: 220px; background: var(--bg-black); border: 2px solid var(--white); box-shadow: 8px 8px 0 rgba(255,255,255,0.1); z-index: 100; opacity: 0; transform: translateY(-8px) scale(0.97); pointer-events: none; transition: all 0.2s cubic-bezier(0.25,1,0.5,1); }
.ur-dash__dropdown.is-open { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
.ur-dash__dropdown-item { display: flex; align-items: center; gap: 10px; padding: 12px 16px; font-family: var(--font-display); font-size: 13px; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); transition: all 0.1s; border-left: 3px solid transparent; }
.ur-dash__dropdown-item:hover { color: var(--white); background: rgba(255,255,255,0.04); border-left-color: var(--white); }
.ur-dash__dropdown-item i { width: 16px; text-align: center; font-size: 13px; }
.ur-dash__dropdown-divider { height: 1px; background: rgba(255,255,255,0.08); margin: 4px 0; }
.ur-dash__dropdown-item--logout { color: rgba(255,100,100,0.6); }
.ur-dash__dropdown-item--logout:hover { color: #ff4444; border-left-color: #ff4444; }
@media (max-width: 900px) { .ur-dash { flex-direction: column; } .ur-dash__sidebar { width: 100%; height: auto; position: relative; flex-direction: row; flex-wrap: wrap; padding: 12px; border-right: none; border-bottom: 2px solid var(--white); } .ur-dash__nav { flex-direction: row; overflow-x: auto; gap: 0; } .ur-dash__nav-item { white-space: nowrap; border-left: none; border-bottom: 3px solid transparent; padding: 8px 12px; font-size: 11px; } .ur-dash__nav-item.active { border-bottom-color: var(--white); border-left-color: transparent; } }

/* ══════════════════════════════════════ HEADING */
.ur-sc__heading { display: flex; flex-direction: column; }
.ur-sc__heading-label { font-family: var(--font-display); font-size: 12px; letter-spacing: 6px; color: rgba(255,255,255,0.3); line-height: 1; }
.ur-sc__heading-title { font-family: var(--font-display); font-size: 42px; letter-spacing: 4px; color: var(--white); line-height: 1; margin-top: 4px; }
.ur-sc__heading-line { width: 60px; height: 2px; background: var(--white); margin-top: 10px; }

/* ══════════════════════════════════════ TABS */
.ur-sc__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin-bottom: 28px; position: relative; }
.ur-sc__tab { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 28px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-sc__tab i { margin-right: 8px; font-size: 14px; }
.ur-sc__tab:hover { color: rgba(255,255,255,0.7); }
.ur-sc__tab.active { color: var(--white); }
.ur-sc__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25,1,0.5,1), width 0.35s cubic-bezier(0.25,1,0.5,1); }
.ur-sc__panel { display: none; }
.ur-sc__panel.active { display: block; }

/* ══════════════════════════════════════ SCANNER LAYOUT */
.ur-sc__scanner-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }

/* VIEWPORT */
.ur-sc__viewport-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; }
.ur-sc__viewport { position: relative; width: 100%; aspect-ratio: 4/3; background: rgba(0,0,0,0.6); border: 2px solid rgba(255,255,255,0.1); overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }

/* CROSSHAIR */
.ur-sc__crosshair { position: absolute; width: 60%; height: 60%; top: 20%; left: 20%; }
.ur-sc__crosshair-corner { position: absolute; width: 24px; height: 24px; border-color: var(--white); border-style: solid; border-width: 0; }
.ur-sc__crosshair-corner--tl { top: 0; left: 0; border-top-width: 3px; border-left-width: 3px; }
.ur-sc__crosshair-corner--tr { top: 0; right: 0; border-top-width: 3px; border-right-width: 3px; }
.ur-sc__crosshair-corner--bl { bottom: 0; left: 0; border-bottom-width: 3px; border-left-width: 3px; }
.ur-sc__crosshair-corner--br { bottom: 0; right: 0; border-bottom-width: 3px; border-right-width: 3px; }

/* SCANLINE ANIMATION */
.ur-sc__scanline { position: absolute; top: 0; left: 5%; width: 90%; height: 2px; background: var(--white); box-shadow: 0 0 12px rgba(255,255,255,0.5); animation: ur-sc-scan 2.5s ease-in-out infinite; opacity: 0; }
.ur-sc__viewport-status.is-active ~ .ur-sc__crosshair .ur-sc__scanline,
.ur-sc__viewport .ur-sc__scanline { opacity: 0; }
@keyframes ur-sc-scan { 0% { top: 0; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: 100%; opacity: 0; } }

.ur-sc__viewport-status { text-align: center; z-index: 2; }
.ur-sc__viewport-status i { font-size: 32px; color: rgba(255,255,255,0.15); display: block; margin-bottom: 8px; }
.ur-sc__viewport-status span { font-family: var(--font-display); font-size: 13px; letter-spacing: 3px; color: rgba(255,255,255,0.3); }
.ur-sc__viewport-status.is-active i { color: #22c55e; }
.ur-sc__viewport-status.is-active span { color: #22c55e; }
.ur-sc__pulse { animation: ur-sc-pulse 1s infinite; }
@keyframes ur-sc-pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.3; } }

/* CONTROLS */
.ur-sc__controls { display: flex; align-items: center; gap: 16px; }
.ur-sc__ctrl-btn { font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 12px 24px; cursor: pointer; border: 2px solid; transition: all 0.15s; flex: 1; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px; }
.ur-sc__ctrl-btn--primary { background: var(--white); color: var(--bg-black); border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.15); }
.ur-sc__ctrl-btn--primary:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0 rgba(255,255,255,0.2); }
.ur-sc__ctrl-btn--primary:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: 4px 4px 0 rgba(255,255,255,0.15); }
.ur-sc__ctrl-btn--ghost { background: none; color: rgba(255,255,255,0.5); border-color: rgba(255,255,255,0.15); }
.ur-sc__ctrl-btn--ghost:hover { color: var(--white); border-color: var(--white); }
.ur-sc__ctrl-divider { font-family: var(--font-display); font-size: 11px; letter-spacing: 3px; color: rgba(255,255,255,0.2); flex-shrink: 0; }
.ur-sc__file-input { display: none; }

/* RESULT CARD */
.ur-sc__result-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; display: flex; flex-direction: column; }
.ur-sc__result-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-sc__result-header h3 { font-family: var(--font-display); font-size: 16px; letter-spacing: 2px; color: var(--white); }
.ur-sc__result-status { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }
.ur-sc__result-status i { margin-right: 6px; }
.ur-sc__result-status--verified { color: #22c55e; }
.ur-sc__result-status--invalid { color: #ef4444; }

.ur-sc__result-empty { text-align: center; padding: 60px 20px; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.ur-sc__result-empty i { font-size: 48px; color: rgba(255,255,255,0.08); margin-bottom: 16px; }
.ur-sc__result-empty p { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.25); margin-bottom: 4px; }
.ur-sc__result-empty span { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; color: rgba(255,255,255,0.12); }

.ur-sc__result-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-sc__result-row:last-of-type { border-bottom: none; margin-bottom: 20px; }
.ur-sc__result-row span { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; color: rgba(255,255,255,0.35); }
.ur-sc__result-row strong { font-family: var(--font-display); font-size: 14px; letter-spacing: 1.5px; color: var(--white); }
.ur-sc__verified { color: #22c55e !important; }

.ur-sc__btn { font-family: var(--font-display); font-size: 14px; letter-spacing: 3px; padding: 12px 28px; cursor: pointer; border: 2px solid; transition: all 0.15s; width: 100%; text-align: center; }
.ur-sc__btn i { margin-right: 8px; }
.ur-sc__btn--primary { background: var(--white); color: var(--bg-black); border-color: var(--white); }
.ur-sc__btn--primary:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0 rgba(255,255,255,0.2); }

/* QUICK STATS */
.ur-sc__quick-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
.ur-sc__quick-stat { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 20px; text-align: center; transition: all 0.15s; }
.ur-sc__quick-stat:hover { border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-sc__quick-val { font-family: var(--font-display); font-size: 36px; color: var(--white); display: block; line-height: 1; margin-bottom: 4px; }
.ur-sc__quick-val--green { color: #22c55e; }
.ur-sc__quick-val--red { color: #ef4444; }
.ur-sc__quick-lbl { font-family: var(--font-display); font-size: 10px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); }

/* ══════════════════════════════════════ HISTORY */
.ur-sc__toolbar { display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
.ur-sc__search-box { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 14px; transition: border-color 0.2s; flex: 1; min-width: 200px; }
.ur-sc__search-box:focus-within { border-color: var(--white); }
.ur-sc__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-sc__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 0; width: 100%; }
.ur-sc__search-input::placeholder { color: rgba(255,255,255,0.2); }
.ur-sc__filter-select { background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 10px 14px; outline: none; cursor: pointer; -webkit-appearance: none; }

.ur-sc__history-list { display: flex; flex-direction: column; gap: 0; }
.ur-sc__history-item { display: grid; grid-template-columns: 44px 1fr auto auto; gap: 16px; align-items: center; padding: 16px; border: 1px solid rgba(255,255,255,0.04); border-bottom: none; transition: all 0.1s; }
.ur-sc__history-item:last-child { border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-sc__history-item:hover { background: rgba(255,255,255,0.03); transform: translateX(4px); }

.ur-sc__history-icon { width: 36px; height: 36px; border: 2px solid; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.ur-sc__history-icon--verified { border-color: #22c55e; color: #22c55e; }
.ur-sc__history-icon--invalid { border-color: #ef4444; color: #ef4444; }
.ur-sc__history-icon--duplicate { border-color: #f59e0b; color: #f59e0b; }

.ur-sc__history-info strong { font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: var(--white); display: block; }
.ur-sc__history-info span { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }
.ur-sc__history-time { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; color: rgba(255,255,255,0.35); text-align: right; }

.ur-sc__history-badge { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; padding: 3px 10px; border: 2px solid; }
.ur-sc__history-badge--verified { border-color: #22c55e; color: #22c55e; }
.ur-sc__history-badge--invalid { border-color: #ef4444; color: #ef4444; }
.ur-sc__history-badge--duplicate { border-color: #f59e0b; color: #f59e0b; }

/* RESPONSIVE */
@media (max-width: 1200px) { .ur-sc__scanner-layout { grid-template-columns: 1fr; } .ur-sc__quick-stats { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 600px) { .ur-sc__quick-stats { grid-template-columns: 1fr; } .ur-sc__history-item { grid-template-columns: 36px 1fr; } .ur-sc__history-time { display: none; } }
</style>
@endsection

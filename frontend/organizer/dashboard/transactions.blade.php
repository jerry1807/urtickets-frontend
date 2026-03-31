@extends('frontend.layout')
@section('pageHeading')
  {{ __('Transactions') }}
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
      <a href="{{ route('organizer.transactions') }}" class="ur-dash__nav-item active" data-label="transactions"><i class="fas fa-exchange-alt"></i> <span>TRANSACTIONS</span></a>
      <a href="{{ route('organizer.pwa-scanner') }}" class="ur-dash__nav-item" data-label="pwa scanner"><i class="fas fa-qrcode"></i> <span>PWA SCANNER</span></a>
      <a href="{{ route('organizer.support-tickets') }}" class="ur-dash__nav-item" data-label="support tickets"><i class="fas fa-life-ring"></i> <span>SUPPORT TICKETS</span></a>
    </nav>
  </aside>

  {{-- MAIN --}}
  <main class="ur-dash__main">
    {{-- TOPBAR --}}
    <div class="ur-dash__topbar">
      <div>
        <h1 class="ur-tx__heading">
          <span class="ur-tx__heading-label">FINANCIAL</span>
          <span class="ur-tx__heading-title">TRANSACTIONS</span>
          <span class="ur-tx__heading-line"></span>
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

    {{-- SUMMARY STRIP --}}
    <div class="ur-tx__summary">
      <div class="ur-tx__summary-item">
        <span class="ur-tx__summary-val">${{ number_format($txData->total_income) }}</span>
        <span class="ur-tx__summary-lbl">TOTAL INCOME</span>
      </div>
      <div class="ur-tx__summary-divider"></div>
      <div class="ur-tx__summary-item">
        <span class="ur-tx__summary-val">${{ number_format($txData->total_expense) }}</span>
        <span class="ur-tx__summary-lbl">TOTAL EXPENSE</span>
      </div>
      <div class="ur-tx__summary-divider"></div>
      <div class="ur-tx__summary-item">
        <span class="ur-tx__summary-val ur-tx__summary-val--net">${{ number_format($txData->net) }}</span>
        <span class="ur-tx__summary-lbl">NET BALANCE</span>
      </div>
      <div class="ur-tx__summary-divider"></div>
      <div class="ur-tx__summary-item">
        <span class="ur-tx__summary-val">{{ $txData->total_count }}</span>
        <span class="ur-tx__summary-lbl">TOTAL TRANSACTIONS</span>
      </div>
    </div>

    {{-- TABS --}}
    <div class="ur-tx__tabs">
      <button class="ur-tx__tab active" data-tab="ledger"><i class="fas fa-list"></i> LEDGER</button>
      <button class="ur-tx__tab" data-tab="analytics"><i class="fas fa-chart-bar"></i> ANALYTICS</button>
      <div class="ur-tx__tab-indicator"></div>
    </div>

    {{-- ═══════════════════ LEDGER ═══════════════════ --}}
    <div class="ur-tx__panel active" id="panel-ledger">

      {{-- FILTERS --}}
      <div class="ur-tx__toolbar">
        <div class="ur-tx__toolbar-left">
          <div class="ur-tx__search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="txSearch" placeholder="SEARCH TRANSACTION ID..." class="ur-tx__search-input">
          </div>
          <select id="txTypeFilter" class="ur-tx__filter-select">
            <option value="">ALL TYPES</option>
            <option value="booking_income">BOOKING INCOME</option>
            <option value="withdrawal">WITHDRAWAL</option>
            <option value="refund">REFUND</option>
            <option value="commission">COMMISSION</option>
          </select>
        </div>
        <div class="ur-tx__toolbar-right">
          <span class="ur-tx__count">{{ count($transactions) }} RECORDS</span>
        </div>
      </div>

      {{-- TABLE --}}
      <div class="ur-tx__table-wrap">
        <table class="ur-tx__table">
          <thead>
            <tr>
              <th>TRANSACTION ID</th>
              <th>TYPE</th>
              <th>DETAILS</th>
              <th>GATEWAY</th>
              <th>AMOUNT</th>
              <th>DATE</th>
            </tr>
          </thead>
          <tbody id="txBody">
            @foreach($transactions as $tx)
            <tr data-type="{{ $tx->type }}" data-search="{{ strtolower($tx->txn_id . ' ' . $tx->details) }}">
              <td class="ur-tx__id-cell">#{{ $tx->txn_id }}</td>
              <td>
                <span class="ur-tx__type-badge ur-tx__type-badge--{{ $tx->type }}">
                  <i class="fas fa-{{ $tx->type_icon }}"></i> {{ strtoupper(str_replace('_', ' ', $tx->type)) }}
                </span>
              </td>
              <td class="ur-tx__details-cell">{{ $tx->details }}</td>
              <td class="ur-tx__gateway-cell">{{ strtoupper($tx->gateway) }}</td>
              <td class="ur-tx__amount-cell {{ $tx->is_credit ? 'ur-tx__amount--credit' : 'ur-tx__amount--debit' }}">
                {{ $tx->is_credit ? '+' : '-' }}${{ number_format($tx->amount, 2) }}
              </td>
              <td class="ur-tx__date-cell">{{ $tx->date }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- ═══════════════════ ANALYTICS ═══════════════════ --}}
    <div class="ur-tx__panel" id="panel-analytics">

      <div class="ur-tx__analytics-charts">
        <div class="ur-tx__chart-card">
          <h3>INCOME VS EXPENSE (6 MONTHS)</h3>
          <div class="ur-tx__chart-wrap"><canvas id="incomeExpenseChart"></canvas></div>
        </div>
        <div class="ur-tx__chart-card">
          <h3>TRANSACTIONS BY TYPE</h3>
          <div class="ur-tx__chart-wrap"><canvas id="txByTypeChart"></canvas></div>
        </div>
      </div>

      {{-- BREAKDOWN --}}
      <div class="ur-tx__breakdown">
        <h3>TRANSACTION BREAKDOWN</h3>
        <div class="ur-tx__breakdown-grid">
          <div class="ur-tx__breakdown-row">
            <div class="ur-tx__breakdown-bar-bg">
              <div class="ur-tx__breakdown-bar ur-tx__breakdown-bar--income" style="width:{{ $txData->total_income > 0 ? 100 : 0 }}%"></div>
            </div>
            <span class="ur-tx__breakdown-type">BOOKING INCOME</span>
            <span class="ur-tx__breakdown-val">${{ number_format($txData->total_income) }}</span>
          </div>
          <div class="ur-tx__breakdown-row">
            <div class="ur-tx__breakdown-bar-bg">
              <div class="ur-tx__breakdown-bar ur-tx__breakdown-bar--expense" style="width:{{ $txData->total_income > 0 ? round(($txData->total_expense / $txData->total_income) * 100) : 0 }}%"></div>
            </div>
            <span class="ur-tx__breakdown-type">WITHDRAWALS</span>
            <span class="ur-tx__breakdown-val">${{ number_format($txData->total_expense) }}</span>
          </div>
          <div class="ur-tx__breakdown-row">
            <div class="ur-tx__breakdown-bar-bg">
              <div class="ur-tx__breakdown-bar ur-tx__breakdown-bar--refund" style="width:{{ $txData->total_income > 0 ? round(($txData->refund_total / $txData->total_income) * 100) : 0 }}%"></div>
            </div>
            <span class="ur-tx__breakdown-type">REFUNDS</span>
            <span class="ur-tx__breakdown-val">${{ number_format($txData->refund_total) }}</span>
          </div>
          <div class="ur-tx__breakdown-row">
            <div class="ur-tx__breakdown-bar-bg">
              <div class="ur-tx__breakdown-bar ur-tx__breakdown-bar--commission" style="width:{{ $txData->total_income > 0 ? round(($txData->commission_total / $txData->total_income) * 100) : 0 }}%"></div>
            </div>
            <span class="ur-tx__breakdown-type">COMMISSION</span>
            <span class="ur-tx__breakdown-val">${{ number_format($txData->commission_total) }}</span>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

  // TABS
  var tabs = document.querySelectorAll('.ur-tx__tab');
  var panels = document.querySelectorAll('.ur-tx__panel');
  var indicator = document.querySelector('.ur-tx__tab-indicator');
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
  var at = document.querySelector('.ur-tx__tab.active');
  if (at && indicator) setInd(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-tx__tab.active'); if (a && indicator) setInd(a); });

  // SEARCH + FILTER
  var rows = document.querySelectorAll('#txBody tr');
  function filterTx() {
    var q = (document.getElementById('txSearch') || {}).value.toLowerCase();
    var tf = (document.getElementById('txTypeFilter') || {}).value;
    rows.forEach(function(r) {
      var show = true;
      if (q && (r.dataset.search || '').indexOf(q) === -1) show = false;
      if (tf && r.dataset.type !== tf) show = false;
      r.style.display = show ? '' : 'none';
    });
  }
  var si = document.getElementById('txSearch');
  var tf = document.getElementById('txTypeFilter');
  if (si) si.addEventListener('input', filterTx);
  if (tf) tf.addEventListener('change', filterTx);

  // CHARTS
  var gc = 'rgba(255,255,255,0.06)', tc = 'rgba(255,255,255,0.3)', w = '#fff';
  Chart.defaults.color = tc; Chart.defaults.borderColor = gc;
  Chart.defaults.font.family = "'Bebas Neue', sans-serif"; Chart.defaults.font.size = 13;

  new Chart(document.getElementById('incomeExpenseChart'), {
    type: 'bar',
    data: {
      labels: {!! json_encode($txData->chart_months) !!},
      datasets: [
        { label: 'Income', data: {!! json_encode($txData->chart_income) !!}, backgroundColor: w, borderWidth: 0, barPercentage: 0.4, categoryPercentage: 0.8 },
        { label: 'Expense', data: {!! json_encode($txData->chart_expense) !!}, backgroundColor: 'rgba(255,255,255,0.2)', borderWidth: 0, barPercentage: 0.4, categoryPercentage: 0.8 }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { labels: { boxWidth: 12, padding: 20, color: tc } } },
      scales: { y: { grid: { color: gc }, ticks: { callback: function(v) { return '$' + v; } } }, x: { grid: { display: false } } }
    }
  });

  new Chart(document.getElementById('txByTypeChart'), {
    type: 'doughnut',
    data: {
      labels: ['BOOKING INCOME', 'WITHDRAWAL', 'REFUND', 'COMMISSION'],
      datasets: [{
        data: {!! json_encode([$txData->total_income, $txData->total_expense, $txData->refund_total, $txData->commission_total]) !!},
        backgroundColor: [w, 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.2)', 'rgba(255,255,255,0.1)'],
        borderColor: 'rgba(5,5,5,0.8)',
        borderWidth: 3,
      }]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      cutout: '65%',
      plugins: { legend: { position: 'right', labels: { boxWidth: 12, padding: 16, color: tc } } }
    }
  });

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

  // Stagger
  document.querySelectorAll('.ur-tx__chart-card, .ur-tx__breakdown-row').forEach(function(el, i) {
    el.style.opacity = '0'; el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
    el.style.transitionDelay = (i * 0.06) + 's';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

@section('custom-style')
<style>
.footer-section { display: none !important; }

/* DASHBOARD SHELL */
.ur-dash { display: flex; min-height: 100vh; background: var(--bg-black); }
.ur-dash__sidebar { width: 240px; flex-shrink: 0; background: var(--bg-black); border-right: 2px solid var(--white); display: flex; flex-direction: column; padding: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; overflow-x: hidden; transition: width 0.3s cubic-bezier(0.25, 1, 0.5, 1); }
.ur-dash__sidebar.is-collapsed { width: 60px; }
.sidebar-collapsed .ur-dash__main { margin-left: 0; }
.ur-dash__sidebar-top { display: flex; align-items: center; justify-content: space-between; padding: 16px 16px 12px; border-bottom: 1px solid rgba(255,255,255,0.08); transition: padding 0.3s cubic-bezier(0.25, 1, 0.5, 1), justify-content 0.3s; }
.ur-dash__sidebar-brand a { text-decoration: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-brand { display: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-top { justify-content: center; padding: 16px 0 12px; }
.ur-dash__collapse { width: 34px; height: 34px; background: none; border: 2px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; padding: 0; transition: border-color 0.3s, background 0.3s; }
.ur-dash__collapse:hover { border-color: var(--white); background: rgba(255,255,255,0.06); }
.ur-dash__collapse-icon { font-size: 14px; color: var(--white); display: block; width: 14px; height: 14px; text-align: center; line-height: 14px; transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }
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
.ur-dash__nav-item span { display: inline-block; max-width: 180px; opacity: 1; transition: max-width 0.4s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.25s ease, margin 0.4s; overflow: hidden; vertical-align: middle; margin-left: 0; }
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
.ur-dash__dropdown { position: absolute; top: calc(100% + 8px); right: 0; width: 220px; background: var(--bg-black); border: 2px solid var(--white); box-shadow: 8px 8px 0 rgba(255,255,255,0.1); z-index: 100; opacity: 0; transform: translateY(-8px) scale(0.97); pointer-events: none; transition: all 0.2s cubic-bezier(0.25, 1, 0.5, 1); }
.ur-dash__dropdown.is-open { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
.ur-dash__dropdown-item { display: flex; align-items: center; gap: 10px; padding: 12px 16px; font-family: var(--font-display); font-size: 13px; letter-spacing: 1.5px; color: rgba(255,255,255,0.6); transition: all 0.1s; border-left: 3px solid transparent; }
.ur-dash__dropdown-item:hover { color: var(--white); background: rgba(255,255,255,0.04); border-left-color: var(--white); }
.ur-dash__dropdown-item i { width: 16px; text-align: center; font-size: 13px; }
.ur-dash__dropdown-divider { height: 1px; background: rgba(255,255,255,0.08); margin: 4px 0; }
.ur-dash__dropdown-item--logout { color: rgba(255,100,100,0.6); }
.ur-dash__dropdown-item--logout:hover { color: #ff4444; border-left-color: #ff4444; }
@media (max-width: 900px) {
  .ur-dash { flex-direction: column; }
  .ur-dash__sidebar { width: 100%; height: auto; position: relative; flex-direction: row; flex-wrap: wrap; padding: 12px; border-right: none; border-bottom: 2px solid var(--white); }
  .ur-dash__nav { flex-direction: row; overflow-x: auto; gap: 0; }
  .ur-dash__nav-item { white-space: nowrap; border-left: none; border-bottom: 3px solid transparent; padding: 8px 12px; font-size: 11px; }
  .ur-dash__nav-item.active { border-bottom-color: var(--white); border-left-color: transparent; }
}

/* ══════════════════════════════════════ HEADING */
.ur-tx__heading { display: flex; flex-direction: column; }
.ur-tx__heading-label { font-family: var(--font-display); font-size: 12px; letter-spacing: 6px; color: rgba(255,255,255,0.3); line-height: 1; animation: ur-tx-s 0.6s cubic-bezier(0.25,1,0.5,1) both; }
.ur-tx__heading-title { font-family: var(--font-display); font-size: 42px; letter-spacing: 4px; color: var(--white); line-height: 1; margin-top: 4px; animation: ur-tx-s 0.6s cubic-bezier(0.25,1,0.5,1) 0.1s both; }
.ur-tx__heading-line { width: 60px; height: 2px; background: var(--white); margin-top: 10px; animation: ur-tx-l 0.8s cubic-bezier(0.25,1,0.5,1) 0.3s both; transform-origin: left; }
@keyframes ur-tx-s { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
@keyframes ur-tx-l { from { transform:scaleX(0); opacity:0; } to { transform:scaleX(1); opacity:1; } }

/* ══════════════════════════════════════ SUMMARY STRIP */
.ur-tx__summary { display: flex; align-items: center; border: 2px solid var(--white); padding: 20px 32px; margin-bottom: 28px; background: rgba(255,255,255,0.03); gap: 0; }
.ur-tx__summary-item { flex: 1; text-align: center; }
.ur-tx__summary-val { font-family: var(--font-display); font-size: 28px; color: var(--white); letter-spacing: 1px; display: block; line-height: 1; }
.ur-tx__summary-val--net { color: #22c55e; }
.ur-tx__summary-lbl { font-family: var(--font-display); font-size: 10px; letter-spacing: 3px; color: rgba(255,255,255,0.3); display: block; margin-top: 4px; }
.ur-tx__summary-divider { width: 1px; height: 40px; background: rgba(255,255,255,0.1); flex-shrink: 0; }

/* ══════════════════════════════════════ TABS */
.ur-tx__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin-bottom: 28px; position: relative; }
.ur-tx__tab { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 28px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-tx__tab i { margin-right: 8px; font-size: 14px; }
.ur-tx__tab:hover { color: rgba(255,255,255,0.7); }
.ur-tx__tab.active { color: var(--white); }
.ur-tx__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25,1,0.5,1), width 0.35s cubic-bezier(0.25,1,0.5,1); }
.ur-tx__panel { display: none; }
.ur-tx__panel.active { display: block; }

/* ══════════════════════════════════════ TOOLBAR */
.ur-tx__toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; }
.ur-tx__toolbar-left { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
.ur-tx__search-box { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 14px; transition: border-color 0.2s; }
.ur-tx__search-box:focus-within { border-color: var(--white); }
.ur-tx__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-tx__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 0; width: 240px; }
.ur-tx__search-input::placeholder { color: rgba(255,255,255,0.2); }
.ur-tx__filter-select { background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 10px 14px; outline: none; cursor: pointer; -webkit-appearance: none; appearance: none; }
.ur-tx__filter-select:focus { border-color: var(--white); }
.ur-tx__count { font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }

/* ══════════════════════════════════════ TABLE */
.ur-tx__table-wrap { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); overflow-x: auto; }
.ur-tx__table { width: 100%; border-collapse: collapse; }
.ur-tx__table th { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); text-align: left; padding: 14px 16px; border-bottom: 2px solid rgba(255,255,255,0.08); white-space: nowrap; }
.ur-tx__table td { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.7); padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,0.04); white-space: nowrap; }
.ur-tx__table tr { transition: transform 0.1s; }
.ur-tx__table tbody tr:hover { transform: translateX(4px); }
.ur-tx__table tbody tr:hover td { background: rgba(255,255,255,0.03); }

.ur-tx__id-cell { font-family: var(--font-display) !important; font-size: 14px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-tx__details-cell { max-width: 250px; overflow: hidden; text-overflow: ellipsis; }
.ur-tx__gateway-cell { font-family: var(--font-display) !important; font-size: 11px !important; letter-spacing: 2px; color: rgba(255,255,255,0.5) !important; }
.ur-tx__date-cell { font-family: var(--font-display) !important; font-size: 12px !important; letter-spacing: 1.5px; color: rgba(255,255,255,0.5) !important; }
.ur-tx__amount-cell { font-family: var(--font-display) !important; font-size: 16px !important; letter-spacing: 1px; }
.ur-tx__amount--credit { color: #22c55e !important; }
.ur-tx__amount--debit { color: #ef4444 !important; }

.ur-tx__type-badge { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; padding: 4px 10px; border: 2px solid; display: inline-flex; align-items: center; gap: 6px; }
.ur-tx__type-badge i { font-size: 9px; }
.ur-tx__type-badge--booking_income { border-color: #22c55e; color: #22c55e; }
.ur-tx__type-badge--withdrawal { border-color: #f59e0b; color: #f59e0b; }
.ur-tx__type-badge--refund { border-color: #ef4444; color: #ef4444; }
.ur-tx__type-badge--commission { border-color: rgba(255,255,255,0.25); color: rgba(255,255,255,0.5); }

/* ══════════════════════════════════════ ANALYTICS */
.ur-tx__analytics-charts { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
.ur-tx__chart-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 20px; min-width: 0; overflow: hidden; }
.ur-tx__chart-card h3 { font-family: var(--font-display); font-size: 16px; letter-spacing: 2px; color: var(--white); margin-bottom: 16px; }
.ur-tx__chart-wrap { position: relative; height: 260px; width: 100%; }

/* BREAKDOWN */
.ur-tx__breakdown { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; }
.ur-tx__breakdown h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); margin-bottom: 20px; }
.ur-tx__breakdown-grid { display: flex; flex-direction: column; gap: 16px; }
.ur-tx__breakdown-row { display: grid; grid-template-columns: 1fr 160px 100px; gap: 16px; align-items: center; }
.ur-tx__breakdown-bar-bg { height: 6px; background: rgba(255,255,255,0.06); }
.ur-tx__breakdown-bar { height: 100%; transition: width 1s ease; }
.ur-tx__breakdown-bar--income { background: var(--white); }
.ur-tx__breakdown-bar--expense { background: #f59e0b; }
.ur-tx__breakdown-bar--refund { background: #ef4444; }
.ur-tx__breakdown-bar--commission { background: rgba(255,255,255,0.3); }
.ur-tx__breakdown-type { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; color: rgba(255,255,255,0.5); }
.ur-tx__breakdown-val { font-family: var(--font-display); font-size: 16px; letter-spacing: 1px; color: var(--white); text-align: right; }

/* ══════════════════════════════════════ RESPONSIVE */
@media (max-width: 1200px) {
  .ur-tx__analytics-charts { grid-template-columns: 1fr; }
  .ur-tx__summary { flex-wrap: wrap; gap: 16px; }
  .ur-tx__summary-divider { display: none; }
  .ur-tx__summary-item { min-width: 120px; }
}
@media (max-width: 900px) {
  .ur-tx__tabs { overflow-x: auto; }
  .ur-tx__tab { font-size: 13px; padding: 12px 18px; white-space: nowrap; }
  .ur-tx__breakdown-row { grid-template-columns: 1fr; gap: 4px; }
}
</style>
@endsection

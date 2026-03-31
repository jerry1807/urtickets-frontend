@extends('frontend.layout')
@section('pageHeading')
  {{ __('Withdraw') }}
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
      <a href="{{ route('organizer.dashboard') }}" class="ur-dash__nav-item" data-label="dashboard">
        <i class="fas fa-th-large"></i> <span>DASHBOARD</span>
      </a>
      <a href="{{ route('organizer.event-management') }}" class="ur-dash__nav-item" data-label="event management">
        <i class="fas fa-calendar-plus"></i> <span>EVENT MANAGEMENT</span>
      </a>
      <a href="{{ route('organizer.event-bookings') }}" class="ur-dash__nav-item" data-label="event bookings">
        <i class="fas fa-ticket-alt"></i> <span>EVENT BOOKINGS</span>
      </a>
      <a href="{{ route('organizer.withdraw') }}" class="ur-dash__nav-item active" data-label="withdraw">
        <i class="fas fa-wallet"></i> <span>WITHDRAW</span>
      </a>
      <a href="{{ route('organizer.transactions') }}" class="ur-dash__nav-item" data-label="transactions">
        <i class="fas fa-exchange-alt"></i> <span>TRANSACTIONS</span>
      </a>
      <a href="{{ route('organizer.pwa-scanner') }}" class="ur-dash__nav-item" data-label="pwa scanner">
        <i class="fas fa-qrcode"></i> <span>PWA SCANNER</span>
      </a>
      <a href="{{ route('organizer.support-tickets') }}" class="ur-dash__nav-item" data-label="support tickets">
        <i class="fas fa-life-ring"></i> <span>SUPPORT TICKETS</span>
      </a>
    </nav>
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="ur-dash__main">
    {{-- TOP BAR --}}
    <div class="ur-dash__topbar">
      <div>
        <h1 class="ur-wd__heading">
          <span class="ur-wd__heading-label">MY</span>
          <span class="ur-wd__heading-title">WITHDRAWALS</span>
          <span class="ur-wd__heading-line"></span>
        </h1>
        <p class="ur-dash__date">{{ strtoupper(date('l, F j, Y')) }}</p>
      </div>
      <div class="ur-dash__topbar-actions">
        <div class="ur-dash__profile" id="profileToggle">
          <div class="ur-dash__avatar">J</div>
          <div class="ur-dash__profile-info">
            <strong>JHON</strong>
            <span>ORGANIZER</span>
          </div>
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

    {{-- BALANCE BANNER --}}
    <div class="ur-wd__balance-banner">
      <div class="ur-wd__balance-left">
        <span class="ur-wd__balance-label">AVAILABLE BALANCE</span>
        <span class="ur-wd__balance-amount">${{ number_format($withdrawData->balance, 2) }}</span>
      </div>
      <div class="ur-wd__balance-right">
        <div class="ur-wd__balance-stat">
          <span class="ur-wd__balance-stat-val">${{ number_format($withdrawData->total_withdrawn, 2) }}</span>
          <span class="ur-wd__balance-stat-lbl">TOTAL WITHDRAWN</span>
        </div>
        <div class="ur-wd__balance-stat">
          <span class="ur-wd__balance-stat-val">{{ $withdrawData->pending_count }}</span>
          <span class="ur-wd__balance-stat-lbl">PENDING</span>
        </div>
      </div>
    </div>

    {{-- TAB BAR --}}
    <div class="ur-wd__tabs">
      <button class="ur-wd__tab active" data-tab="withdrawals">
        <i class="fas fa-list"></i> WITHDRAWALS
      </button>
      <button class="ur-wd__tab" data-tab="request">
        <i class="fas fa-paper-plane"></i> REQUEST
      </button>
      <button class="ur-wd__tab" data-tab="history">
        <i class="fas fa-chart-line"></i> HISTORY
      </button>
      <div class="ur-wd__tab-indicator"></div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: WITHDRAWALS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-wd__panel active" id="panel-withdrawals">

      {{-- TOOLBAR --}}
      <div class="ur-wd__toolbar">
        <div class="ur-wd__toolbar-left">
          <div class="ur-wd__search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="wdSearch" placeholder="SEARCH WITHDRAWALS..." class="ur-wd__search-input">
          </div>
          <select id="wdStatusFilter" class="ur-wd__filter-select">
            <option value="">ALL STATUS</option>
            <option value="completed">COMPLETED</option>
            <option value="pending">PENDING</option>
            <option value="rejected">REJECTED</option>
          </select>
        </div>
        <div class="ur-wd__toolbar-right">
          <span class="ur-wd__count">{{ count($withdrawals) }} RECORDS</span>
        </div>
      </div>

      {{-- TABLE --}}
      <div class="ur-wd__table-wrap">
        <table class="ur-wd__table">
          <thead>
            <tr>
              <th>WITHDRAW ID</th>
              <th>METHOD</th>
              <th>AMOUNT</th>
              <th>CHARGE</th>
              <th>RECEIVABLE</th>
              <th>STATUS</th>
              <th>DATE</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id="wdBody">
            @foreach($withdrawals as $wd)
            <tr data-status="{{ $wd->status }}" data-search="{{ strtolower($wd->withdraw_id . ' ' . $wd->method) }}">
              <td class="ur-wd__id-cell">#{{ $wd->withdraw_id }}</td>
              <td>
                <span class="ur-wd__method-badge">
                  <i class="fas fa-{{ $wd->method_icon }}"></i> {{ strtoupper($wd->method) }}
                </span>
              </td>
              <td class="ur-wd__amount-cell">${{ number_format($wd->amount, 2) }}</td>
              <td class="ur-wd__charge-cell">${{ number_format($wd->charge, 2) }}</td>
              <td class="ur-wd__receivable-cell">${{ number_format($wd->receivable, 2) }}</td>
              <td><span class="ur-wd__status ur-wd__status--{{ $wd->status }}">{{ strtoupper($wd->status) }}</span></td>
              <td class="ur-wd__date-cell">{{ $wd->date }}</td>
              <td>
                <div class="ur-wd__actions">
                  <button class="ur-wd__action-icon" title="View"><i class="fas fa-eye"></i></button>
                  <button class="ur-wd__action-icon ur-wd__action-icon--danger" title="Cancel"><i class="fas fa-times"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: REQUEST --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-wd__panel" id="panel-request">

      <div class="ur-wd__request-layout">
        {{-- REQUEST FORM --}}
        <div class="ur-wd__section">
          <div class="ur-wd__section-header">
            <span class="ur-wd__section-num">01</span>
            <h3>WITHDRAWAL REQUEST</h3>
          </div>

          <form class="ur-wd__form" id="withdrawForm">
            <div class="ur-wd__field">
              <label>WITHDRAW METHOD</label>
              <select name="method" class="ur-wd__input" id="wdMethodSelect">
                <option value="">SELECT METHOD</option>
                <option value="bitcoin">BITCOIN</option>
                <option value="perfect_money">PERFECT MONEY</option>
                <option value="bank_transfer">BANK TRANSFER</option>
                <option value="paypal">PAYPAL</option>
              </select>
            </div>

            <div class="ur-wd__field">
              <label>WITHDRAW AMOUNT ($)</label>
              <input type="number" name="amount" class="ur-wd__input" placeholder="0.00" step="0.01" id="wdAmountInput">
              <div class="ur-wd__amount-info" id="wdAmountInfo">
                <span>YOU WILL RECEIVE: <strong id="wdReceive">$0.00</strong></span>
                <span>CHARGE: <strong id="wdCharge">$0.00</strong></span>
              </div>
            </div>

            <div class="ur-wd__field">
              <label>ADDITIONAL REFERENCE <span class="ur-wd__optional">(OPTIONAL)</span></label>
              <textarea name="reference" class="ur-wd__input ur-wd__textarea" rows="3" placeholder="ENTER ADDITIONAL REFERENCE..."></textarea>
            </div>

            <button type="submit" class="ur-wd__btn ur-wd__btn--primary" id="sendRequestBtn">
              <i class="fas fa-paper-plane"></i> SEND REQUEST
            </button>
          </form>
        </div>

        {{-- METHOD INFO CARD --}}
        <div class="ur-wd__section ur-wd__method-info" id="methodInfoCard">
          <div class="ur-wd__section-header">
            <span class="ur-wd__section-num">02</span>
            <h3>METHOD DETAILS</h3>
          </div>
          <div class="ur-wd__method-details">
            <div class="ur-wd__method-detail-row">
              <span>MIN WITHDRAWAL</span>
              <strong>$50.00</strong>
            </div>
            <div class="ur-wd__method-detail-row">
              <span>MAX WITHDRAWAL</span>
              <strong>$10,000.00</strong>
            </div>
            <div class="ur-wd__method-detail-row">
              <span>CHARGE TYPE</span>
              <strong>PERCENTAGE</strong>
            </div>
            <div class="ur-wd__method-detail-row">
              <span>CHARGE RATE</span>
              <strong>2.5%</strong>
            </div>
            <div class="ur-wd__method-detail-row">
              <span>PROCESSING TIME</span>
              <strong>1-3 BUSINESS DAYS</strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: HISTORY --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-wd__panel" id="panel-history">

      {{-- STATS --}}
      <div class="ur-wd__history-stats">
        <div class="ur-wd__history-card">
          <div class="ur-wd__history-icon"><i class="fas fa-wallet"></i></div>
          <div class="ur-wd__history-num">${{ number_format($withdrawData->total_withdrawn) }}</div>
          <div class="ur-wd__history-label">TOTAL WITHDRAWN</div>
        </div>
        <div class="ur-wd__history-card">
          <div class="ur-wd__history-icon"><i class="fas fa-check-circle"></i></div>
          <div class="ur-wd__history-num">{{ $withdrawData->completed_count }}</div>
          <div class="ur-wd__history-label">COMPLETED</div>
        </div>
        <div class="ur-wd__history-card">
          <div class="ur-wd__history-icon"><i class="fas fa-clock"></i></div>
          <div class="ur-wd__history-num">{{ $withdrawData->pending_count }}</div>
          <div class="ur-wd__history-label">PENDING</div>
        </div>
        <div class="ur-wd__history-card">
          <div class="ur-wd__history-icon"><i class="fas fa-times-circle"></i></div>
          <div class="ur-wd__history-num">{{ $withdrawData->rejected_count }}</div>
          <div class="ur-wd__history-label">REJECTED</div>
        </div>
      </div>

      {{-- CHART --}}
      <div class="ur-wd__history-chart-card">
        <h3>WITHDRAWAL HISTORY (6 MONTHS)</h3>
        <div class="ur-wd__history-chart-wrap"><canvas id="withdrawHistoryChart"></canvas></div>
      </div>

      {{-- RECENT ACTIVITY --}}
      <div class="ur-wd__recent">
        <h3>RECENT ACTIVITY</h3>
        <div class="ur-wd__recent-list">
          @foreach($withdrawals->take(5) as $wd)
          <div class="ur-wd__recent-item">
            <div class="ur-wd__recent-icon ur-wd__recent-icon--{{ $wd->status }}">
              <i class="fas fa-{{ $wd->status === 'completed' ? 'check' : ($wd->status === 'pending' ? 'clock' : 'times') }}"></i>
            </div>
            <div class="ur-wd__recent-info">
              <strong>#{{ $wd->withdraw_id }} — {{ strtoupper($wd->method) }}</strong>
              <span>{{ $wd->date }}</span>
            </div>
            <div class="ur-wd__recent-amount">${{ number_format($wd->receivable, 2) }}</div>
            <span class="ur-wd__status ur-wd__status--{{ $wd->status }}">{{ strtoupper($wd->status) }}</span>
          </div>
          @endforeach
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

  // TAB SWITCHING
  var tabs = document.querySelectorAll('.ur-wd__tab');
  var panels = document.querySelectorAll('.ur-wd__panel');
  var indicator = document.querySelector('.ur-wd__tab-indicator');
  function setIndicator(tab) { indicator.style.width = tab.offsetWidth + 'px'; indicator.style.left = tab.offsetLeft + 'px'; }
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabs.forEach(function(t) { t.classList.remove('active'); });
      panels.forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById('panel-' + this.dataset.tab).classList.add('active');
      setIndicator(this);
    });
  });
  var at = document.querySelector('.ur-wd__tab.active');
  if (at && indicator) setIndicator(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-wd__tab.active'); if (a && indicator) setIndicator(a); });

  // SEARCH + FILTER
  var rows = document.querySelectorAll('#wdBody tr');
  function filterWd() {
    var q = (document.getElementById('wdSearch') || {}).value || '';
    q = q.toLowerCase();
    var sf = (document.getElementById('wdStatusFilter') || {}).value || '';
    rows.forEach(function(row) {
      var show = true;
      if (q && (row.dataset.search || '').indexOf(q) === -1) show = false;
      if (sf && row.dataset.status !== sf) show = false;
      row.style.display = show ? '' : 'none';
    });
  }
  var si = document.getElementById('wdSearch');
  var sf = document.getElementById('wdStatusFilter');
  if (si) si.addEventListener('input', filterWd);
  if (sf) sf.addEventListener('change', filterWd);

  // AMOUNT CALCULATOR
  var amtInput = document.getElementById('wdAmountInput');
  if (amtInput) {
    amtInput.addEventListener('input', function() {
      var amt = parseFloat(this.value) || 0;
      var charge = amt * 0.025;
      var receive = amt - charge;
      document.getElementById('wdReceive').textContent = '$' + receive.toFixed(2);
      document.getElementById('wdCharge').textContent = '$' + charge.toFixed(2);
    });
  }

  // SEND REQUEST GLITCH
  var sendBtn = document.getElementById('sendRequestBtn');
  if (sendBtn) {
    sendBtn.addEventListener('mouseenter', function() {
      this.classList.add('is-glitch');
      var self = this;
      setTimeout(function() { self.classList.remove('is-glitch'); }, 300);
    });
  }

  // HISTORY CHART
  var gridColor = 'rgba(255,255,255,0.06)';
  var tickColor = 'rgba(255,255,255,0.3)';
  var white = '#ffffff';
  Chart.defaults.color = tickColor;
  Chart.defaults.borderColor = gridColor;
  Chart.defaults.font.family = "'Bebas Neue', sans-serif";
  Chart.defaults.font.size = 13;

  new Chart(document.getElementById('withdrawHistoryChart'), {
    type: 'line',
    data: {
      labels: {!! json_encode($withdrawData->chart_months) !!},
      datasets: [{
        data: {!! json_encode($withdrawData->chart_amounts) !!},
        borderColor: white,
        backgroundColor: 'rgba(255,255,255,0.05)',
        borderWidth: 3,
        pointBackgroundColor: white,
        pointRadius: 5,
        pointHoverRadius: 8,
        fill: true,
        tension: 0.3,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { grid: { color: gridColor }, ticks: { callback: function(v) { return '$' + v; } } },
        x: { grid: { display: false } }
      }
    }
  });

  // SHARED: sidebar, profile, nav search
  var toggle = document.getElementById('profileToggle');
  var dropdown = document.getElementById('profileDropdown');
  if (toggle && dropdown) {
    toggle.addEventListener('click', function(e) { e.stopPropagation(); dropdown.classList.toggle('is-open'); toggle.classList.toggle('is-open'); });
    document.addEventListener('click', function() { dropdown.classList.remove('is-open'); toggle.classList.remove('is-open'); });
    dropdown.addEventListener('click', function(e) { e.stopPropagation(); });
  }
  var sidebar = document.getElementById('dashSidebar');
  var collapseBtn = document.getElementById('sidebarCollapse');
  if (collapseBtn && sidebar) {
    collapseBtn.addEventListener('click', function() { sidebar.classList.toggle('is-collapsed'); document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed'); });
  }
  var navSearch = document.getElementById('navSearch');
  if (navSearch) {
    navSearch.addEventListener('input', function() {
      var q = this.value.toLowerCase();
      document.querySelectorAll('.ur-dash__nav-item').forEach(function(item) { item.style.display = (item.getAttribute('data-label') || '').includes(q) ? '' : 'none'; });
    });
  }

  // Stagger entrance
  document.querySelectorAll('.ur-wd__section, .ur-wd__history-card, .ur-wd__recent-item').forEach(function(el, i) {
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

/* ══════════════════════════════════════
   HEADING
   ══════════════════════════════════════ */
.ur-wd__heading { display: flex; flex-direction: column; }
.ur-wd__heading-label { font-family: var(--font-display); font-size: 12px; letter-spacing: 6px; color: rgba(255,255,255,0.3); line-height: 1; animation: ur-wd-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) both; }
.ur-wd__heading-title { font-family: var(--font-display); font-size: 42px; letter-spacing: 4px; color: var(--white); line-height: 1; margin-top: 4px; animation: ur-wd-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) 0.1s both; }
.ur-wd__heading-line { width: 60px; height: 2px; background: var(--white); margin-top: 10px; animation: ur-wd-line 0.8s cubic-bezier(0.25, 1, 0.5, 1) 0.3s both; transform-origin: left; }
@keyframes ur-wd-slide { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
@keyframes ur-wd-line { from { transform: scaleX(0); opacity: 0; } to { transform: scaleX(1); opacity: 1; } }

/* ══════════════════════════════════════
   BALANCE BANNER
   ══════════════════════════════════════ */
.ur-wd__balance-banner { display: flex; justify-content: space-between; align-items: center; border: 2px solid var(--white); padding: 24px 32px; margin-bottom: 28px; background: rgba(255,255,255,0.03); }
.ur-wd__balance-label { font-family: var(--font-display); font-size: 11px; letter-spacing: 3px; color: rgba(255,255,255,0.35); display: block; }
.ur-wd__balance-amount { font-family: var(--font-display); font-size: 48px; color: var(--white); letter-spacing: 2px; line-height: 1; margin-top: 4px; }
.ur-wd__balance-right { display: flex; gap: 32px; }
.ur-wd__balance-stat { text-align: right; }
.ur-wd__balance-stat-val { font-family: var(--font-display); font-size: 24px; color: var(--white); letter-spacing: 1px; display: block; line-height: 1; }
.ur-wd__balance-stat-lbl { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); display: block; margin-top: 3px; }

/* ══════════════════════════════════════
   TABS
   ══════════════════════════════════════ */
.ur-wd__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin-bottom: 28px; position: relative; }
.ur-wd__tab { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 28px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-wd__tab i { margin-right: 8px; font-size: 14px; }
.ur-wd__tab:hover { color: rgba(255,255,255,0.7); }
.ur-wd__tab.active { color: var(--white); }
.ur-wd__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25, 1, 0.5, 1), width 0.35s cubic-bezier(0.25, 1, 0.5, 1); }
.ur-wd__panel { display: none; }
.ur-wd__panel.active { display: block; }

/* ══════════════════════════════════════
   WITHDRAWALS TABLE
   ══════════════════════════════════════ */
.ur-wd__toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; }
.ur-wd__toolbar-left { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
.ur-wd__search-box { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 14px; transition: border-color 0.2s; }
.ur-wd__search-box:focus-within { border-color: var(--white); }
.ur-wd__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-wd__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 0; width: 220px; }
.ur-wd__search-input::placeholder { color: rgba(255,255,255,0.2); }
.ur-wd__filter-select { background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 10px 14px; outline: none; cursor: pointer; -webkit-appearance: none; appearance: none; }
.ur-wd__filter-select:focus { border-color: var(--white); }
.ur-wd__count { font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }

.ur-wd__table-wrap { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); overflow-x: auto; }
.ur-wd__table { width: 100%; border-collapse: collapse; }
.ur-wd__table th { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); text-align: left; padding: 14px 16px; border-bottom: 2px solid rgba(255,255,255,0.08); white-space: nowrap; }
.ur-wd__table td { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.7); padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,0.04); white-space: nowrap; }
.ur-wd__table tr { transition: transform 0.1s; }
.ur-wd__table tbody tr:hover { transform: translateX(4px); }
.ur-wd__table tbody tr:hover td { background: rgba(255,255,255,0.03); }

.ur-wd__id-cell { font-family: var(--font-display) !important; font-size: 14px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-wd__amount-cell { font-family: var(--font-display) !important; font-size: 16px !important; color: var(--white) !important; }
.ur-wd__charge-cell { font-family: var(--font-display) !important; font-size: 13px !important; color: rgba(255,100,100,0.6) !important; }
.ur-wd__receivable-cell { font-family: var(--font-display) !important; font-size: 16px !important; color: #22c55e !important; }
.ur-wd__date-cell { font-family: var(--font-display) !important; font-size: 12px !important; letter-spacing: 1.5px; color: rgba(255,255,255,0.5) !important; }

.ur-wd__method-badge { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; padding: 4px 10px; border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.6); display: inline-flex; align-items: center; gap: 6px; }
.ur-wd__method-badge i { font-size: 10px; }

.ur-wd__status { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; padding: 3px 10px; border: 2px solid; }
.ur-wd__status--completed { border-color: #22c55e; color: #22c55e; }
.ur-wd__status--pending { border-color: #f59e0b; color: #f59e0b; }
.ur-wd__status--rejected { border-color: #ef4444; color: #ef4444; }

.ur-wd__actions { display: flex; gap: 8px; }
.ur-wd__action-icon { width: 32px; height: 32px; background: none; border: 2px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s; font-size: 12px; }
.ur-wd__action-icon:hover { border-color: var(--white); color: var(--white); transform: translate(-1px, -1px); box-shadow: 2px 2px 0 rgba(255,255,255,0.1); }
.ur-wd__action-icon--danger:hover { border-color: #ef4444; color: #ef4444; box-shadow: 2px 2px 0 rgba(239,68,68,0.2); }

/* ══════════════════════════════════════
   REQUEST TAB
   ══════════════════════════════════════ */
.ur-wd__request-layout { display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px; }
.ur-wd__section { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 28px; position: relative; transition: border-color 0.2s; }
.ur-wd__section:hover { border-color: rgba(255,255,255,0.2); }
.ur-wd__section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px); pointer-events: none; z-index: 0; }
.ur-wd__section > * { position: relative; z-index: 1; }
.ur-wd__section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-wd__section-num { font-family: var(--font-display); font-size: 56px; color: transparent; line-height: 1; letter-spacing: 2px; -webkit-text-stroke: 2px rgba(255,255,255,0.25); }
.ur-wd__section:hover .ur-wd__section-num { -webkit-text-stroke-color: var(--white); transition: -webkit-text-stroke-color 0.2s; }
.ur-wd__section-header h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); }

.ur-wd__field { margin-bottom: 20px; }
.ur-wd__field label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.4); display: block; margin-bottom: 8px; }
.ur-wd__input { width: 100%; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 14px; letter-spacing: 1.5px; padding: 12px 14px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
.ur-wd__input::placeholder { color: rgba(255,255,255,0.15); }
.ur-wd__input:focus { border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
select.ur-wd__input { cursor: pointer; -webkit-appearance: none; appearance: none; }
.ur-wd__textarea { font-family: var(--font-body); letter-spacing: 0.5px; resize: vertical; min-height: 70px; }
.ur-wd__optional { font-size: 9px; color: rgba(255,255,255,0.2); }

.ur-wd__amount-info { display: flex; gap: 24px; margin-top: 10px; font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; color: rgba(255,255,255,0.35); }
.ur-wd__amount-info strong { color: var(--white); }

.ur-wd__btn { font-family: var(--font-display); font-size: 15px; letter-spacing: 3px; padding: 14px 32px; cursor: pointer; border: 2px solid; transition: all 0.15s; }
.ur-wd__btn i { margin-right: 8px; }
.ur-wd__btn--primary { background: var(--white); color: var(--bg-black); border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.15); width: 100%; }
.ur-wd__btn--primary:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0 rgba(255,255,255,0.2); }
.ur-wd__btn--primary.is-glitch { animation: ur-wd-glitch 0.3s; }
@keyframes ur-wd-glitch { 0%, 100% { opacity: 1; transform: translate(-2px, -2px); } 20% { opacity: 0.8; transform: translate(2px, -1px); } 40% { opacity: 1; transform: translate(-1px, 2px); } 60% { opacity: 0.9; transform: translate(1px, -2px); } 80% { opacity: 1; transform: translate(-2px, 1px); } }

/* METHOD DETAILS */
.ur-wd__method-details { display: flex; flex-direction: column; gap: 0; }
.ur-wd__method-detail-row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-wd__method-detail-row:last-child { border-bottom: none; }
.ur-wd__method-detail-row span { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; color: rgba(255,255,255,0.35); }
.ur-wd__method-detail-row strong { font-family: var(--font-display); font-size: 13px; letter-spacing: 1.5px; color: var(--white); }

/* ══════════════════════════════════════
   HISTORY TAB
   ══════════════════════════════════════ */
.ur-wd__history-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.ur-wd__history-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; text-align: center; transition: all 0.15s; }
.ur-wd__history-card:hover { border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-wd__history-icon { font-size: 24px; color: rgba(255,255,255,0.2); margin-bottom: 12px; }
.ur-wd__history-num { font-family: var(--font-display); font-size: 36px; color: var(--white); letter-spacing: 1px; line-height: 1; margin-bottom: 6px; }
.ur-wd__history-label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); }

.ur-wd__history-chart-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 20px; margin-bottom: 24px; min-width: 0; overflow: hidden; }
.ur-wd__history-chart-card h3 { font-family: var(--font-display); font-size: 16px; letter-spacing: 2px; color: var(--white); margin-bottom: 16px; }
.ur-wd__history-chart-wrap { position: relative; height: 240px; width: 100%; }

/* RECENT ACTIVITY */
.ur-wd__recent h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); margin-bottom: 16px; }
.ur-wd__recent-list { display: flex; flex-direction: column; gap: 0; }
.ur-wd__recent-item { display: grid; grid-template-columns: 44px 1fr auto auto; gap: 16px; align-items: center; padding: 16px; border: 1px solid rgba(255,255,255,0.04); border-bottom: none; transition: all 0.1s; }
.ur-wd__recent-item:last-child { border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-wd__recent-item:hover { background: rgba(255,255,255,0.03); transform: translateX(4px); }
.ur-wd__recent-icon { width: 36px; height: 36px; border: 2px solid; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.ur-wd__recent-icon--completed { border-color: #22c55e; color: #22c55e; }
.ur-wd__recent-icon--pending { border-color: #f59e0b; color: #f59e0b; }
.ur-wd__recent-icon--rejected { border-color: #ef4444; color: #ef4444; }
.ur-wd__recent-info strong { font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: var(--white); display: block; }
.ur-wd__recent-info span { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }
.ur-wd__recent-amount { font-family: var(--font-display); font-size: 20px; color: var(--white); letter-spacing: 1px; text-align: right; }

/* ══════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════ */
@media (max-width: 1200px) {
  .ur-wd__history-stats { grid-template-columns: repeat(2, 1fr); }
  .ur-wd__request-layout { grid-template-columns: 1fr; }
  .ur-wd__balance-banner { flex-direction: column; gap: 16px; text-align: center; }
  .ur-wd__balance-right { justify-content: center; }
}
@media (max-width: 900px) {
  .ur-wd__tabs { overflow-x: auto; }
  .ur-wd__tab { font-size: 13px; padding: 12px 18px; white-space: nowrap; }
}
@media (max-width: 600px) {
  .ur-wd__history-stats { grid-template-columns: 1fr; }
  .ur-wd__recent-item { grid-template-columns: 36px 1fr; }
  .ur-wd__recent-amount { display: none; }
}
</style>
@endsection

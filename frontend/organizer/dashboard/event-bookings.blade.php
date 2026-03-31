@extends('frontend.layout')
@section('pageHeading')
  {{ __('Event Bookings') }}
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
      <a href="{{ route('organizer.event-bookings') }}" class="ur-dash__nav-item active" data-label="event bookings">
        <i class="fas fa-ticket-alt"></i> <span>EVENT BOOKINGS</span>
      </a>
      <a href="{{ route('organizer.withdraw') }}" class="ur-dash__nav-item" data-label="withdraw">
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
        <h1 class="ur-eb__heading">
          <span class="ur-eb__heading-label">EVENT</span>
          <span class="ur-eb__heading-title">BOOKINGS</span>
          <span class="ur-eb__heading-line"></span>
        </h1>
        <p class="ur-dash__date">{{ strtoupper(date('l, F j, Y')) }}</p>
      </div>
      <div class="ur-dash__topbar-actions">
        <button class="ur-eb__export-btn" id="exportCsvBtn">
          <i class="fas fa-download"></i> EXPORT CSV
        </button>
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

    {{-- TAB BAR --}}
    <div class="ur-eb__tabs">
      <button class="ur-eb__tab active" data-tab="all-bookings">
        <i class="fas fa-receipt"></i> ALL BOOKINGS
      </button>
      <button class="ur-eb__tab" data-tab="report">
        <i class="fas fa-file-alt"></i> REPORT
      </button>
      <button class="ur-eb__tab" data-tab="analytics">
        <i class="fas fa-chart-bar"></i> ANALYTICS
      </button>
      <div class="ur-eb__tab-indicator"></div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: ALL BOOKINGS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-eb__panel active" id="panel-all-bookings">

      {{-- STATUS PILLS --}}
      <div class="ur-eb__status-pills">
        <button class="ur-eb__pill active" data-status="">
          ALL <span class="ur-eb__pill-count">{{ count($bookings) }}</span>
        </button>
        <button class="ur-eb__pill" data-status="completed">
          <span class="ur-eb__pill-dot ur-eb__pill-dot--completed"></span> COMPLETED
          <span class="ur-eb__pill-count">{{ $bookings->where('payment_status', 'completed')->count() }}</span>
        </button>
        <button class="ur-eb__pill" data-status="pending">
          <span class="ur-eb__pill-dot ur-eb__pill-dot--pending"></span> PENDING
          <span class="ur-eb__pill-count">{{ $bookings->where('payment_status', 'pending')->count() }}</span>
        </button>
        <button class="ur-eb__pill" data-status="rejected">
          <span class="ur-eb__pill-dot ur-eb__pill-dot--rejected"></span> REJECTED
          <span class="ur-eb__pill-count">{{ $bookings->where('payment_status', 'rejected')->count() }}</span>
        </button>
      </div>

      {{-- SEARCH BAR --}}
      <div class="ur-eb__toolbar">
        <div class="ur-eb__toolbar-left">
          <div class="ur-eb__search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="bookingSearch" placeholder="SEARCH ORDER ID OR EVENT..." class="ur-eb__search-input">
          </div>
        </div>
        <div class="ur-eb__toolbar-right">
          <button class="ur-eb__bulk-btn" id="bulkDeleteBtn" style="display:none;">
            <i class="fas fa-trash"></i> DELETE SELECTED
          </button>
        </div>
      </div>

      {{-- BOOKINGS TABLE --}}
      <div class="ur-eb__table-wrap">
        <table class="ur-eb__table">
          <thead>
            <tr>
              <th><label class="ur-eb__check-wrap"><input type="checkbox" id="selectAll"><span class="ur-eb__check-box"></span></label></th>
              <th>ORDER</th>
              <th>EVENT</th>
              <th>BUYER</th>
              <th>EVENT DATE</th>
              <th>QTY</th>
              <th>AMOUNT</th>
              <th>STATUS</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id="bookingsBody">
            @foreach($bookings as $booking)
            <tr data-status="{{ $booking->payment_status }}" data-search="{{ strtolower($booking->order_id . ' ' . $booking->event_title) }}">
              <td><label class="ur-eb__check-wrap"><input type="checkbox" class="booking-check" value="{{ $booking->id }}"><span class="ur-eb__check-box"></span></label></td>
              <td class="ur-eb__order-cell">#{{ $booking->order_id }}</td>
              <td>
                <div class="ur-eb__event-cell">
                  <div class="ur-eb__event-thumb">{{ strtoupper(substr($booking->event_title, 0, 2)) }}</div>
                  <div>
                    <strong class="ur-eb__event-name">{{ $booking->event_title }}</strong>
                    <span class="ur-eb__event-type">{{ strtoupper($booking->event_type) }}</span>
                  </div>
                </div>
              </td>
              <td class="ur-eb__buyer-cell">{{ $booking->buyer }}</td>
              <td class="ur-eb__date-cell">{{ $booking->event_date }}</td>
              <td class="ur-eb__qty-cell">{{ $booking->qty }}</td>
              <td class="ur-eb__amount-cell">${{ number_format($booking->amount, 2) }}</td>
              <td><span class="ur-eb__status ur-eb__status--{{ $booking->payment_status }}">{{ strtoupper($booking->payment_status) }}</span></td>
              <td>
                <div class="ur-eb__actions">
                  <button class="ur-eb__action-icon" title="View Details"><i class="fas fa-eye"></i></button>
                  <button class="ur-eb__action-icon ur-eb__action-icon--danger" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: REPORT --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-eb__panel" id="panel-report">

      <div class="ur-eb__report-filters">
        <div class="ur-eb__section">
          <div class="ur-eb__section-header">
            <span class="ur-eb__section-num">01</span>
            <h3>GENERATE REPORT</h3>
          </div>
          <div class="ur-eb__report-row">
            <div class="ur-eb__field">
              <label>FROM</label>
              <input type="date" name="report_from" class="ur-eb__input">
            </div>
            <div class="ur-eb__field">
              <label>TO</label>
              <input type="date" name="report_to" class="ur-eb__input">
            </div>
            <div class="ur-eb__field">
              <label>PAYMENT METHOD</label>
              <select name="payment_method" class="ur-eb__input">
                <option value="">ALL METHODS</option>
                <option value="stripe">STRIPE</option>
                <option value="paypal">PAYPAL</option>
                <option value="bank_transfer">BANK TRANSFER</option>
                <option value="citibank">CITIBANK</option>
                <option value="bank_of_america">BANK OF AMERICA</option>
              </select>
            </div>
            <div class="ur-eb__field">
              <label>PAYMENT STATUS</label>
              <select name="payment_status" class="ur-eb__input">
                <option value="">ALL STATUS</option>
                <option value="completed">COMPLETED</option>
                <option value="pending">PENDING</option>
              </select>
            </div>
          </div>
          <div class="ur-eb__report-actions">
            <button class="ur-eb__btn ur-eb__btn--primary"><i class="fas fa-search"></i> GENERATE</button>
            <button class="ur-eb__btn ur-eb__btn--ghost"><i class="fas fa-file-csv"></i> EXPORT CSV</button>
          </div>
        </div>
      </div>

      {{-- REPORT SUMMARY CARDS --}}
      <div class="ur-eb__report-summary">
        <div class="ur-eb__report-card">
          <div class="ur-eb__report-card-val">${{ number_format($reportData->total_revenue, 2) }}</div>
          <div class="ur-eb__report-card-label">TOTAL REVENUE</div>
          <div class="ur-eb__report-card-bar">
            <div class="ur-eb__report-card-fill" style="width:100%"></div>
          </div>
        </div>
        <div class="ur-eb__report-card">
          <div class="ur-eb__report-card-val">{{ $reportData->total_bookings }}</div>
          <div class="ur-eb__report-card-label">TOTAL BOOKINGS</div>
          <div class="ur-eb__report-card-bar">
            <div class="ur-eb__report-card-fill" style="width:75%"></div>
          </div>
        </div>
        <div class="ur-eb__report-card">
          <div class="ur-eb__report-card-val">${{ number_format($reportData->avg_order_value, 2) }}</div>
          <div class="ur-eb__report-card-label">AVG ORDER VALUE</div>
          <div class="ur-eb__report-card-bar">
            <div class="ur-eb__report-card-fill" style="width:60%"></div>
          </div>
        </div>
        <div class="ur-eb__report-card">
          <div class="ur-eb__report-card-val">{{ $reportData->completion_rate }}%</div>
          <div class="ur-eb__report-card-label">COMPLETION RATE</div>
          <div class="ur-eb__report-card-bar">
            <div class="ur-eb__report-card-fill" style="width:{{ $reportData->completion_rate }}%"></div>
          </div>
        </div>
      </div>

      {{-- REPORT TABLE --}}
      <div class="ur-eb__section">
        <div class="ur-eb__section-header">
          <span class="ur-eb__section-num">02</span>
          <h3>RESULTS</h3>
        </div>
        <div class="ur-eb__table-wrap">
          <table class="ur-eb__table">
            <thead>
              <tr>
                <th>ORDER</th>
                <th>EVENT</th>
                <th>BUYER</th>
                <th>METHOD</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>DATE</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings->take(5) as $booking)
              <tr>
                <td class="ur-eb__order-cell">#{{ $booking->order_id }}</td>
                <td><strong class="ur-eb__event-name">{{ $booking->event_title }}</strong></td>
                <td class="ur-eb__buyer-cell">{{ $booking->buyer }}</td>
                <td class="ur-eb__method-cell">{{ strtoupper($booking->payment_method) }}</td>
                <td class="ur-eb__amount-cell">${{ number_format($booking->amount, 2) }}</td>
                <td><span class="ur-eb__status ur-eb__status--{{ $booking->payment_status }}">{{ strtoupper($booking->payment_status) }}</span></td>
                <td class="ur-eb__date-cell">{{ $booking->booking_date }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: ANALYTICS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-eb__panel" id="panel-analytics">

      {{-- STAT CARDS --}}
      <div class="ur-eb__analytics-stats">
        <div class="ur-eb__analytics-card">
          <div class="ur-eb__analytics-icon"><i class="fas fa-receipt"></i></div>
          <div class="ur-eb__analytics-num">{{ $reportData->total_bookings }}</div>
          <div class="ur-eb__analytics-label">TOTAL BOOKINGS</div>
        </div>
        <div class="ur-eb__analytics-card">
          <div class="ur-eb__analytics-icon"><i class="fas fa-dollar-sign"></i></div>
          <div class="ur-eb__analytics-num">${{ number_format($reportData->total_revenue) }}</div>
          <div class="ur-eb__analytics-label">TOTAL REVENUE</div>
        </div>
        <div class="ur-eb__analytics-card">
          <div class="ur-eb__analytics-icon"><i class="fas fa-tag"></i></div>
          <div class="ur-eb__analytics-num">${{ number_format($reportData->avg_order_value) }}</div>
          <div class="ur-eb__analytics-label">AVG TICKET PRICE</div>
        </div>
        <div class="ur-eb__analytics-card">
          <div class="ur-eb__analytics-icon"><i class="fas fa-check-circle"></i></div>
          <div class="ur-eb__analytics-num">{{ $reportData->completion_rate }}%</div>
          <div class="ur-eb__analytics-label">COMPLETION RATE</div>
        </div>
      </div>

      {{-- CHARTS --}}
      <div class="ur-eb__analytics-charts">
        <div class="ur-eb__analytics-chart-card">
          <div class="ur-eb__analytics-chart-head">
            <h3>BOOKINGS BY MONTH</h3>
          </div>
          <div class="ur-eb__analytics-chart-wrap"><canvas id="bookingsByMonthChart"></canvas></div>
        </div>
        <div class="ur-eb__analytics-chart-card">
          <div class="ur-eb__analytics-chart-head">
            <h3>REVENUE BY EVENT</h3>
          </div>
          <div class="ur-eb__analytics-chart-wrap"><canvas id="revenueByEventChart"></canvas></div>
        </div>
      </div>

      {{-- TOP EVENTS --}}
      <div class="ur-eb__top-events">
        <h3>TOP EVENTS BY BOOKINGS</h3>
        <div class="ur-eb__top-events-list">
          @foreach($topEvents as $i => $event)
          <div class="ur-eb__top-event-row">
            <div class="ur-eb__top-event-rank">#{{ $i + 1 }}</div>
            <div class="ur-eb__top-event-info">
              <strong>{{ $event->title }}</strong>
              <span>{{ $event->bookings }} BOOKINGS</span>
            </div>
            <div class="ur-eb__top-event-bar-wrap">
              <div class="ur-eb__top-event-bar">
                <div class="ur-eb__top-event-fill" style="width:{{ $topEvents->max('bookings') > 0 ? round(($event->bookings / $topEvents->max('bookings')) * 100) : 0 }}%"></div>
              </div>
            </div>
            <div class="ur-eb__top-event-revenue">${{ number_format($event->revenue) }}</div>
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

  // ────────────────────────────────
  // TAB SWITCHING
  // ────────────────────────────────
  var tabs = document.querySelectorAll('.ur-eb__tab');
  var panels = document.querySelectorAll('.ur-eb__panel');
  var indicator = document.querySelector('.ur-eb__tab-indicator');

  function setIndicator(tab) {
    indicator.style.width = tab.offsetWidth + 'px';
    indicator.style.left = tab.offsetLeft + 'px';
  }

  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      var target = this.dataset.tab;
      tabs.forEach(function(t) { t.classList.remove('active'); });
      panels.forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById('panel-' + target).classList.add('active');
      setIndicator(this);
    });
  });

  var activeTab = document.querySelector('.ur-eb__tab.active');
  if (activeTab && indicator) setIndicator(activeTab);
  window.addEventListener('resize', function() {
    var at = document.querySelector('.ur-eb__tab.active');
    if (at && indicator) setIndicator(at);
  });

  // ────────────────────────────────
  // STATUS PILLS FILTER
  // ────────────────────────────────
  var pills = document.querySelectorAll('.ur-eb__pill');
  var rows = document.querySelectorAll('#bookingsBody tr');

  function filterBookings() {
    var activePill = document.querySelector('.ur-eb__pill.active');
    var statusFilter = activePill ? activePill.dataset.status : '';
    var searchQ = (document.getElementById('bookingSearch') || {}).value || '';
    searchQ = searchQ.toLowerCase();

    rows.forEach(function(row) {
      var status = row.dataset.status || '';
      var search = row.dataset.search || '';
      var show = true;
      if (statusFilter && status !== statusFilter) show = false;
      if (searchQ && search.indexOf(searchQ) === -1) show = false;
      row.style.display = show ? '' : 'none';
    });
  }

  pills.forEach(function(pill) {
    pill.addEventListener('click', function() {
      pills.forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      filterBookings();
    });
  });

  var searchInput = document.getElementById('bookingSearch');
  if (searchInput) searchInput.addEventListener('input', filterBookings);

  // ────────────────────────────────
  // SELECT ALL / BULK DELETE
  // ────────────────────────────────
  var selectAll = document.getElementById('selectAll');
  var bulkBtn = document.getElementById('bulkDeleteBtn');

  function updateBulkBtn() {
    var checked = document.querySelectorAll('.booking-check:checked').length;
    bulkBtn.style.display = checked > 0 ? '' : 'none';
  }

  if (selectAll) {
    selectAll.addEventListener('change', function() {
      document.querySelectorAll('.booking-check').forEach(function(cb) {
        cb.checked = selectAll.checked;
      });
      updateBulkBtn();
    });
  }

  document.querySelectorAll('.booking-check').forEach(function(cb) {
    cb.addEventListener('change', updateBulkBtn);
  });

  // ────────────────────────────────
  // ANALYTICS CHARTS
  // ────────────────────────────────
  var gridColor = 'rgba(255,255,255,0.06)';
  var tickColor = 'rgba(255,255,255,0.3)';
  var white = '#ffffff';

  Chart.defaults.color = tickColor;
  Chart.defaults.borderColor = gridColor;
  Chart.defaults.font.family = "'Bebas Neue', sans-serif";
  Chart.defaults.font.size = 13;

  var months = {!! json_encode($analyticsCharts->months) !!};
  var monthlyBookings = {!! json_encode($analyticsCharts->monthly_bookings) !!};
  var eventNames = {!! json_encode($analyticsCharts->event_names) !!};
  var eventRevenue = {!! json_encode($analyticsCharts->event_revenue) !!};

  new Chart(document.getElementById('bookingsByMonthChart'), {
    type: 'bar',
    data: {
      labels: months,
      datasets: [{
        data: monthlyBookings,
        backgroundColor: white,
        borderWidth: 0,
        borderRadius: 0,
        barPercentage: 0.6,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { grid: { color: gridColor } },
        x: { grid: { display: false } }
      }
    }
  });

  new Chart(document.getElementById('revenueByEventChart'), {
    type: 'bar',
    data: {
      labels: eventNames,
      datasets: [{
        data: eventRevenue,
        backgroundColor: white,
        borderWidth: 0,
        borderRadius: 0,
        barPercentage: 0.6,
      }]
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        x: { grid: { color: gridColor }, ticks: { callback: function(v) { return '$' + v; } } },
        y: { grid: { display: false } }
      }
    }
  });

  // ────────────────────────────────
  // SHARED: sidebar, profile dropdown, entrance animations
  // ────────────────────────────────
  var toggle = document.getElementById('profileToggle');
  var dropdown = document.getElementById('profileDropdown');
  if (toggle && dropdown) {
    toggle.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('is-open');
      toggle.classList.toggle('is-open');
    });
    document.addEventListener('click', function() {
      dropdown.classList.remove('is-open');
      toggle.classList.remove('is-open');
    });
    dropdown.addEventListener('click', function(e) { e.stopPropagation(); });
  }

  var sidebar = document.getElementById('dashSidebar');
  var collapseBtn = document.getElementById('sidebarCollapse');
  if (collapseBtn && sidebar) {
    collapseBtn.addEventListener('click', function() {
      sidebar.classList.toggle('is-collapsed');
      document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed');
    });
  }

  var navSearch = document.getElementById('navSearch');
  if (navSearch) {
    navSearch.addEventListener('input', function() {
      var q = this.value.toLowerCase();
      document.querySelectorAll('.ur-dash__nav-item').forEach(function(item) {
        var label = item.getAttribute('data-label') || '';
        item.style.display = label.includes(q) ? '' : 'none';
      });
    });
  }

  // Stagger entrance
  document.querySelectorAll('.ur-eb__section, .ur-eb__analytics-card, .ur-eb__analytics-chart-card, .ur-eb__report-card, .ur-eb__top-event-row').forEach(function(el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
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

/* ══════════════════════════════════════
   DASHBOARD SHELL (shared sidebar/topbar)
   ══════════════════════════════════════ */
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
.ur-eb__heading { display: flex; flex-direction: column; position: relative; }
.ur-eb__heading-label { font-family: var(--font-display); font-size: 12px; letter-spacing: 6px; color: rgba(255,255,255,0.3); line-height: 1; animation: ur-eb-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) both; }
.ur-eb__heading-title { font-family: var(--font-display); font-size: 42px; letter-spacing: 4px; color: var(--white); line-height: 1; margin-top: 4px; animation: ur-eb-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) 0.1s both; }
.ur-eb__heading-line { width: 60px; height: 2px; background: var(--white); margin-top: 10px; animation: ur-eb-line 0.8s cubic-bezier(0.25, 1, 0.5, 1) 0.3s both; transform-origin: left; }
@keyframes ur-eb-slide { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
@keyframes ur-eb-line { from { transform: scaleX(0); opacity: 0; } to { transform: scaleX(1); opacity: 1; } }

/* EXPORT BTN */
.ur-eb__export-btn { font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 20px; background: none; border: 2px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.5); cursor: pointer; transition: all 0.15s; }
.ur-eb__export-btn:hover { border-color: var(--white); color: var(--white); }
.ur-eb__export-btn i { margin-right: 6px; }

/* ══════════════════════════════════════
   TAB BAR
   ══════════════════════════════════════ */
.ur-eb__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin-bottom: 28px; position: relative; }
.ur-eb__tab { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 28px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-eb__tab i { margin-right: 8px; font-size: 14px; }
.ur-eb__tab:hover { color: rgba(255,255,255,0.7); animation: ur-eb-tab-glitch 0.2s steps(2); }
.ur-eb__tab.active { color: var(--white); }
.ur-eb__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25, 1, 0.5, 1), width 0.35s cubic-bezier(0.25, 1, 0.5, 1); }
@keyframes ur-eb-tab-glitch { 0% { transform: translate(0); } 25% { transform: translate(-1px, 1px); } 50% { transform: translate(1px, -1px); } 75% { transform: translate(-1px, 0); } 100% { transform: translate(0); } }

.ur-eb__panel { display: none; }
.ur-eb__panel.active { display: block; }

/* ══════════════════════════════════════
   STATUS PILLS
   ══════════════════════════════════════ */
.ur-eb__status-pills { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
.ur-eb__pill { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 8px 18px; background: none; border: 2px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.35); cursor: pointer; transition: all 0.15s; display: flex; align-items: center; gap: 8px; }
.ur-eb__pill:hover { border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.6); }
.ur-eb__pill.active { border-color: var(--white); color: var(--white); background: rgba(255,255,255,0.05); }
.ur-eb__pill-dot { width: 8px; height: 8px; border-radius: 50%; }
.ur-eb__pill-dot--completed { background: #22c55e; }
.ur-eb__pill-dot--pending { background: #f59e0b; }
.ur-eb__pill-dot--rejected { background: #ef4444; }
.ur-eb__pill-count { font-size: 10px; padding: 1px 6px; background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); }
.ur-eb__pill.active .ur-eb__pill-count { background: rgba(255,255,255,0.15); color: var(--white); }

/* ══════════════════════════════════════
   TOOLBAR
   ══════════════════════════════════════ */
.ur-eb__toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; }
.ur-eb__toolbar-left { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
.ur-eb__search-box { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 14px; transition: border-color 0.2s; }
.ur-eb__search-box:focus-within { border-color: var(--white); }
.ur-eb__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-eb__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 0; width: 280px; }
.ur-eb__search-input::placeholder { color: rgba(255,255,255,0.2); }
.ur-eb__bulk-btn { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; padding: 8px 16px; background: none; border: 2px solid #ef4444; color: #ef4444; cursor: pointer; transition: all 0.15s; }
.ur-eb__bulk-btn:hover { background: #ef4444; color: var(--bg-black); }
.ur-eb__bulk-btn i { margin-right: 6px; }

/* ══════════════════════════════════════
   TABLE
   ══════════════════════════════════════ */
.ur-eb__table-wrap { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); overflow-x: auto; }
.ur-eb__table { width: 100%; border-collapse: collapse; }
.ur-eb__table th { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); text-align: left; padding: 14px 16px; border-bottom: 2px solid rgba(255,255,255,0.08); white-space: nowrap; }
.ur-eb__table td { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.7); padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,0.04); white-space: nowrap; }
.ur-eb__table tr { transition: transform 0.1s; }
.ur-eb__table tbody tr:hover { transform: translateX(4px); }
.ur-eb__table tbody tr:hover td { background: rgba(255,255,255,0.03); }

/* CHECKBOX */
.ur-eb__check-wrap { display: flex; align-items: center; cursor: pointer; }
.ur-eb__check-wrap input { display: none; }
.ur-eb__check-box { width: 18px; height: 18px; border: 2px solid rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; transition: all 0.15s; }
.ur-eb__check-wrap input:checked + .ur-eb__check-box { background: var(--white); border-color: var(--white); }
.ur-eb__check-wrap input:checked + .ur-eb__check-box::after { content: '\f00c'; font-family: 'Font Awesome 5 Free'; font-weight: 900; font-size: 10px; color: var(--bg-black); }

/* CELL STYLES */
.ur-eb__order-cell { font-family: var(--font-display) !important; font-size: 14px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-eb__event-cell { display: flex; align-items: center; gap: 12px; }
.ur-eb__event-thumb { width: 40px; height: 40px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: var(--white); flex-shrink: 0; }
.ur-eb__event-name { font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: var(--white); display: block; }
.ur-eb__event-type { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }
.ur-eb__buyer-cell { color: rgba(255,255,255,0.6) !important; }
.ur-eb__date-cell { font-family: var(--font-display) !important; font-size: 12px !important; letter-spacing: 1.5px; color: rgba(255,255,255,0.5) !important; }
.ur-eb__qty-cell { font-family: var(--font-display) !important; font-size: 16px !important; color: var(--white) !important; text-align: center; }
.ur-eb__amount-cell { font-family: var(--font-display) !important; font-size: 16px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-eb__method-cell { font-family: var(--font-display) !important; font-size: 11px !important; letter-spacing: 2px; color: rgba(255,255,255,0.5) !important; }

/* STATUS BADGES */
.ur-eb__status { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; padding: 3px 10px; border: 2px solid; }
.ur-eb__status--completed { border-color: #22c55e; color: #22c55e; }
.ur-eb__status--pending { border-color: #f59e0b; color: #f59e0b; }
.ur-eb__status--rejected { border-color: #ef4444; color: #ef4444; }

/* ACTION ICONS */
.ur-eb__actions { display: flex; gap: 8px; }
.ur-eb__action-icon { width: 32px; height: 32px; background: none; border: 2px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s; font-size: 12px; }
.ur-eb__action-icon:hover { border-color: var(--white); color: var(--white); transform: translate(-1px, -1px); box-shadow: 2px 2px 0 rgba(255,255,255,0.1); }
.ur-eb__action-icon--danger:hover { border-color: #ef4444; color: #ef4444; box-shadow: 2px 2px 0 rgba(239,68,68,0.2); }

/* ══════════════════════════════════════
   REPORT TAB
   ══════════════════════════════════════ */
.ur-eb__section { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 28px; margin-bottom: 20px; position: relative; transition: border-color 0.2s; }
.ur-eb__section:hover { border-color: rgba(255,255,255,0.2); }
.ur-eb__section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px); pointer-events: none; z-index: 0; }
.ur-eb__section > * { position: relative; z-index: 1; }
.ur-eb__section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-eb__section-num { font-family: var(--font-display); font-size: 56px; color: transparent; line-height: 1; letter-spacing: 2px; -webkit-text-stroke: 2px rgba(255,255,255,0.25); }
.ur-eb__section:hover .ur-eb__section-num { -webkit-text-stroke-color: var(--white); transition: -webkit-text-stroke-color 0.2s; }
.ur-eb__section-header h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); }

.ur-eb__report-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 20px; }
.ur-eb__field label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.4); display: block; margin-bottom: 8px; }
.ur-eb__input { width: 100%; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 14px; letter-spacing: 1.5px; padding: 12px 14px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
.ur-eb__input::placeholder { color: rgba(255,255,255,0.15); }
.ur-eb__input:focus { border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
select.ur-eb__input { cursor: pointer; -webkit-appearance: none; appearance: none; }

.ur-eb__report-actions { display: flex; gap: 12px; }
.ur-eb__btn { font-family: var(--font-display); font-size: 14px; letter-spacing: 3px; padding: 12px 28px; cursor: pointer; border: 2px solid; transition: all 0.15s; }
.ur-eb__btn i { margin-right: 8px; }
.ur-eb__btn--primary { background: var(--white); color: var(--bg-black); border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.15); }
.ur-eb__btn--primary:hover { transform: translate(-2px, -2px); box-shadow: 8px 8px 0 rgba(255,255,255,0.2); }
.ur-eb__btn--ghost { background: none; color: rgba(255,255,255,0.5); border-color: rgba(255,255,255,0.15); }
.ur-eb__btn--ghost:hover { color: var(--white); border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }

/* REPORT SUMMARY CARDS */
.ur-eb__report-summary { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.ur-eb__report-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; transition: all 0.15s; }
.ur-eb__report-card:hover { border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-eb__report-card-val { font-family: var(--font-display); font-size: 32px; color: var(--white); letter-spacing: 1px; line-height: 1; margin-bottom: 6px; }
.ur-eb__report-card-label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); margin-bottom: 14px; }
.ur-eb__report-card-bar { height: 3px; background: rgba(255,255,255,0.08); }
.ur-eb__report-card-fill { height: 100%; background: var(--white); transition: width 1s ease; }

/* ══════════════════════════════════════
   ANALYTICS TAB
   ══════════════════════════════════════ */
.ur-eb__analytics-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
.ur-eb__analytics-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; text-align: center; transition: all 0.15s; }
.ur-eb__analytics-card:hover { border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-eb__analytics-icon { font-size: 24px; color: rgba(255,255,255,0.2); margin-bottom: 12px; }
.ur-eb__analytics-num { font-family: var(--font-display); font-size: 36px; color: var(--white); letter-spacing: 1px; line-height: 1; margin-bottom: 6px; }
.ur-eb__analytics-label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); }

.ur-eb__analytics-charts { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; }
.ur-eb__analytics-chart-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 20px; min-width: 0; overflow: hidden; }
.ur-eb__analytics-chart-head { margin-bottom: 16px; }
.ur-eb__analytics-chart-head h3 { font-family: var(--font-display); font-size: 16px; letter-spacing: 2px; color: var(--white); }
.ur-eb__analytics-chart-wrap { position: relative; height: 240px; width: 100%; }

/* TOP EVENTS */
.ur-eb__top-events h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); margin-bottom: 16px; }
.ur-eb__top-events-list { display: flex; flex-direction: column; gap: 0; }
.ur-eb__top-event-row { display: grid; grid-template-columns: 50px 1fr 200px 100px; gap: 16px; align-items: center; padding: 16px; border: 1px solid rgba(255,255,255,0.04); border-bottom: none; transition: all 0.1s; }
.ur-eb__top-event-row:last-child { border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-eb__top-event-row:hover { background: rgba(255,255,255,0.03); transform: translateX(4px); }
.ur-eb__top-event-rank { font-family: var(--font-display); font-size: 24px; color: rgba(255,255,255,0.15); text-align: center; }
.ur-eb__top-event-info strong { font-family: var(--font-display); font-size: 15px; letter-spacing: 1px; color: var(--white); display: block; }
.ur-eb__top-event-info span { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); }
.ur-eb__top-event-bar-wrap { padding: 0 8px; }
.ur-eb__top-event-bar { height: 4px; background: rgba(255,255,255,0.08); }
.ur-eb__top-event-fill { height: 100%; background: var(--white); transition: width 1s ease; }
.ur-eb__top-event-revenue { font-family: var(--font-display); font-size: 20px; color: var(--white); text-align: right; letter-spacing: 1px; }

/* ══════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════ */
@media (max-width: 1200px) {
  .ur-eb__analytics-stats { grid-template-columns: repeat(2, 1fr); }
  .ur-eb__report-summary { grid-template-columns: repeat(2, 1fr); }
  .ur-eb__analytics-charts { grid-template-columns: 1fr; }
  .ur-eb__report-row { grid-template-columns: repeat(2, 1fr); }
  .ur-eb__top-event-row { grid-template-columns: 40px 1fr 120px 80px; }
}
@media (max-width: 900px) {
  .ur-eb__tabs { overflow-x: auto; }
  .ur-eb__tab { font-size: 13px; padding: 12px 18px; white-space: nowrap; }
  .ur-eb__report-row { grid-template-columns: 1fr; }
  .ur-eb__top-event-row { grid-template-columns: 1fr; gap: 8px; }
}
@media (max-width: 600px) {
  .ur-eb__analytics-stats { grid-template-columns: 1fr; }
  .ur-eb__report-summary { grid-template-columns: 1fr; }
}
</style>
@endsection

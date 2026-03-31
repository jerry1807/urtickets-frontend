@extends('frontend.layout')
@section('pageHeading')
  {{ __('Dashboard') }}
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
      <a href="{{ route('organizer.dashboard') }}" class="ur-dash__nav-item active" data-label="dashboard">
        <i class="fas fa-th-large"></i> <span>DASHBOARD</span>
      </a>
      <a href="{{ route('organizer.event-management') }}" class="ur-dash__nav-item" data-label="event management">
        <i class="fas fa-calendar-plus"></i> <span>EVENT MANAGEMENT</span>
      </a>
      <a href="{{ route('organizer.event-bookings') }}" class="ur-dash__nav-item" data-label="event bookings">
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
        <h1 class="ur-dash__greeting">WELCOME BACK, <strong>JHON</strong></h1>
        <p class="ur-dash__date">{{ strtoupper(date('l, F j, Y')) }}</p>
      </div>
      <div class="ur-dash__topbar-actions">
        <button class="ur-dash__action-btn" id="newWidgetBtn"><i class="fas fa-plus ur-dash__plus-icon"></i> <span>NEW WIDGET</span></button>
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

    {{-- STAT CARDS --}}
    <div class="ur-dash__stats">
      <div class="ur-dash__stat-card">
        <div class="ur-dash__stat-icon"><i class="fas fa-dollar-sign"></i></div>
        <div class="ur-dash__stat-info">
          <span class="ur-dash__stat-value" data-count="{{ $dashData->balance }}">${{ number_format($dashData->balance) }}</span>
          <span class="ur-dash__stat-label">MY BALANCE</span>
        </div>
      </div>
      <div class="ur-dash__stat-card">
        <div class="ur-dash__stat-icon"><i class="fas fa-calendar"></i></div>
        <div class="ur-dash__stat-info">
          <span class="ur-dash__stat-value">{{ $dashData->events }}</span>
          <span class="ur-dash__stat-label">ACTIVE EVENTS</span>
        </div>
      </div>
      <div class="ur-dash__stat-card">
        <div class="ur-dash__stat-icon"><i class="fas fa-ticket-alt"></i></div>
        <div class="ur-dash__stat-info">
          <span class="ur-dash__stat-value">{{ $dashData->bookings }}</span>
          <span class="ur-dash__stat-label">TOTAL BOOKINGS</span>
        </div>
      </div>
      <div class="ur-dash__stat-card">
        <div class="ur-dash__stat-icon"><i class="fas fa-exchange-alt"></i></div>
        <div class="ur-dash__stat-info">
          <span class="ur-dash__stat-value">{{ $dashData->transactions }}</span>
          <span class="ur-dash__stat-label">TRANSACTIONS</span>
        </div>
      </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="ur-dash__charts">
      <div class="ur-dash__chart-card">
        <div class="ur-dash__chart-header">
          <h3>MONTHLY INCOME (2026)</h3>
          <span class="ur-dash__chart-badge">+24%</span>
        </div>
        <div class="ur-dash__chart-wrap"><canvas id="revenueChart"></canvas></div>
      </div>
      <div class="ur-dash__chart-card">
        <div class="ur-dash__chart-header">
          <h3>EVENT BOOKINGS (2026)</h3>
          <span class="ur-dash__chart-badge">+38%</span>
        </div>
        <div class="ur-dash__chart-wrap"><canvas id="bookingsChart"></canvas></div>
      </div>
    </div>

    {{-- BOTTOM ROW --}}
    <div class="ur-dash__bottom">
      {{-- RECENT BOOKINGS TABLE --}}
      <div class="ur-dash__table-card">
        <div class="ur-dash__table-header">
          <h3>RECENT BOOKINGS</h3>
          <a href="#" class="ur-dash__view-all">VIEW ALL <i class="fas fa-arrow-right"></i></a>
        </div>
        <table class="ur-dash__table">
          <thead>
            <tr>
              <th>EVENT</th>
              <th>BUYER</th>
              <th>QTY</th>
              <th>AMOUNT</th>
              <th>STATUS</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($recentBookings as $booking)
              <tr>
                <td class="ur-dash__table-event">{{ $booking->event }}</td>
                <td>{{ $booking->buyer }}</td>
                <td>{{ $booking->qty }}</td>
                <td>${{ $booking->amount }}</td>
                <td><span class="ur-dash__status ur-dash__status--{{ $booking->status }}">{{ strtoupper($booking->status) }}</span></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- UPCOMING EVENTS --}}
      <div class="ur-dash__events-card">
        <h3>UPCOMING EVENTS</h3>
        <div class="ur-dash__events-list">
          @foreach ($upcomingEvents as $event)
            <div class="ur-dash__event-item">
              <div class="ur-dash__event-info">
                <h4>{{ $event->title }}</h4>
                <span class="ur-dash__event-date">{{ $event->date }}</span>
              </div>
              <div class="ur-dash__event-progress">
                <div class="ur-dash__progress-bar">
                  <div class="ur-dash__progress-fill" style="width: {{ round(($event->sold / $event->capacity) * 100) }}%"></div>
                </div>
                <span class="ur-dash__progress-text">{{ $event->sold }}/{{ $event->capacity }} SOLD</span>
              </div>
              <div class="ur-dash__event-revenue">${{ number_format($event->revenue) }}</div>
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
  var gridColor = 'rgba(255,255,255,0.06)';
  var tickColor = 'rgba(255,255,255,0.3)';
  var white = '#ffffff';

  Chart.defaults.color = tickColor;
  Chart.defaults.borderColor = gridColor;
  Chart.defaults.font.family = "'Bebas Neue', sans-serif";
  Chart.defaults.font.size = 13;

  var months = {!! json_encode($dashData->months) !!};

  new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
      labels: months,
      datasets: [{
        data: {!! json_encode($dashData->revenue_trend) !!},
        backgroundColor: white,
        borderColor: white,
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
        y: { grid: { color: gridColor }, ticks: { callback: function(v) { return '$' + v; } } },
        x: { grid: { display: false } }
      }
    }
  });

  new Chart(document.getElementById('bookingsChart'), {
    type: 'line',
    data: {
      labels: months,
      datasets: [{
        data: {!! json_encode($dashData->booking_trend) !!},
        borderColor: white,
        backgroundColor: 'rgba(255,255,255,0.05)',
        borderWidth: 3,
        pointBackgroundColor: white,
        pointRadius: 4,
        pointHoverRadius: 7,
        fill: true,
        tension: 0.3,
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

  // Stagger card entrance
  document.querySelectorAll('.ur-dash__stat-card, .ur-dash__chart-card, .ur-dash__table-card, .ur-dash__events-card').forEach(function(el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
    el.style.transitionDelay = (i * 0.06) + 's';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });

  // Profile dropdown
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

  // Sidebar collapse - pure CSS driven
  var sidebar = document.getElementById('dashSidebar');
  var collapseBtn = document.getElementById('sidebarCollapse');
  if (collapseBtn && sidebar) {
    collapseBtn.addEventListener('click', function() {
      sidebar.classList.toggle('is-collapsed');
      document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed');
    });
  }

  // Sidebar nav search/filter
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

  // NEW WIDGET spinning plus
  var widgetBtn = document.getElementById('newWidgetBtn');
  if (widgetBtn) {
    widgetBtn.addEventListener('click', function() {
      var icon = this.querySelector('.ur-dash__plus-icon');
      icon.classList.add('is-spinning');
      setTimeout(function() { icon.classList.remove('is-spinning'); }, 600);
    });
  }
});
</script>
@endsection

@section('custom-style')
<style>
.footer-section { display: none !important; }

.ur-dash {
  display: flex;
  min-height: 100vh;
  background: var(--bg-black);
}

/* SIDEBAR */
.ur-dash__sidebar {
  width: 240px;
  flex-shrink: 0;
  background: var(--bg-black);
  border-right: 2px solid var(--white);
  display: flex;
  flex-direction: column;
  padding: 0;
  position: sticky;
  top: 0;
  height: 100vh;
  overflow-y: auto;
  overflow-x: hidden;
  transition: width 0.3s cubic-bezier(0.25, 1, 0.5, 1);
}
.ur-dash__sidebar.is-collapsed { width: 60px; }
.sidebar-collapsed .ur-dash__main { margin-left: 0; }

.ur-dash__sidebar-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 16px 12px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.ur-dash__sidebar-brand a { text-decoration: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-brand { display: none; }

/* Collapse button */
.ur-dash__collapse {
  width: 34px; height: 34px;
  background: none;
  border: 2px solid rgba(255,255,255,0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  flex-shrink: 0;
  padding: 0;
  transition: border-color 0.3s, background 0.3s;
}
.ur-dash__collapse:hover {
  border-color: var(--white);
  background: rgba(255,255,255,0.06);
}
.ur-dash__collapse-icon {
  font-size: 14px;
  color: var(--white);
  display: block;
  width: 14px;
  height: 14px;
  text-align: center;
  line-height: 14px;
  transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.ur-dash__sidebar.is-collapsed .ur-dash__collapse-icon {
  transform: rotate(180deg);
}

/* Fix: keep collapse button centered when sidebar collapses */
.ur-dash__sidebar-top {
  transition: padding 0.3s cubic-bezier(0.25, 1, 0.5, 1), justify-content 0.3s;
}
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-top {
  justify-content: center;
  padding: 16px 0 12px;
}

/* Sidebar search */
.ur-dash__sidebar-search {
  padding: 10px 16px;
  margin-top: 12px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  display: flex;
  align-items: center;
  gap: 8px;
}
.ur-dash__sidebar-search i {
  color: rgba(255,255,255,0.25);
  font-size: 12px;
  flex-shrink: 0;
}
.ur-dash__nav-search {
  background: none;
  border: none;
  outline: none;
  color: var(--white);
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 1.5px;
  width: 100%;
}
.ur-dash__nav-search::placeholder { color: rgba(255,255,255,0.2); }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-search { padding: 10px 0; justify-content: center; }
.ur-dash__sidebar.is-collapsed .ur-dash__nav-search { display: none; }

/* Nav items - smooth collapse transitions */
.ur-dash__nav-item {
  overflow: hidden;
  white-space: nowrap;
}
.ur-dash__nav-item span {
  display: inline-block;
  max-width: 180px;
  opacity: 1;
  transition: max-width 0.4s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.25s ease, margin 0.4s;
  overflow: hidden;
  vertical-align: middle;
  margin-left: 0;
}
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item span {
  max-width: 0;
  opacity: 0;
  margin-left: -4px;
}
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item {
  justify-content: center;
  padding: 14px 0;
}
.ur-dash__sidebar.is-collapsed .ur-dash__nav-item i { margin: 0; font-size: 16px; }
.ur-dash__avatar {
  width: 38px; height: 38px;
  background: var(--white);
  color: var(--bg-black);
  font-family: var(--font-display);
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  flex-shrink: 0;
}
.ur-dash__nav {
  flex: 1;
  padding: 12px 0;
  display: flex;
  flex-direction: column;
}
.ur-dash__nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 20px;
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.45);
  transition: all 0.12s;
  border-left: 3px solid transparent;
}
.ur-dash__nav-item:hover {
  color: var(--white);
  background: rgba(255,255,255,0.03);
  border-left-color: rgba(255,255,255,0.3);
}
.ur-dash__nav-item.active {
  color: var(--white);
  background: rgba(255,255,255,0.06);
  border-left-color: var(--white);
}
.ur-dash__nav-item i { width: 18px; text-align: center; font-size: 14px; }
.ur-dash__nav-item--logout { color: rgba(255,100,100,0.6); }
.ur-dash__nav-item--logout:hover { color: #ff4444; border-left-color: #ff4444; }
.ur-dash__nav-spacer { flex: 1; }
.ur-dash__nav-divider {
  height: 1px;
  background: rgba(255,255,255,0.06);
  margin: 8px 20px;
}

/* MAIN */
.ur-dash__main {
  flex: 1;
  padding: 28px 32px;
  min-width: 0;
  overflow-x: hidden;
}

/* TOPBAR */
.ur-dash__main {
  overflow: visible !important;
}
.ur-dash__topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 28px;
  gap: 20px;
  position: relative;
  z-index: 50;
}
.ur-dash__greeting {
  font-family: var(--font-display);
  font-size: 32px;
  color: rgba(255,255,255,0.6);
  letter-spacing: 2px;
}
.ur-dash__greeting strong { color: var(--white); }
.ur-dash__date {
  font-family: var(--font-display);
  font-size: 12px;
  color: rgba(255,255,255,0.25);
  letter-spacing: 3px;
  margin-top: 4px;
}
.ur-dash__action-btn {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  padding: 10px 20px;
  background: var(--white);
  color: var(--bg-black);
  border: 3px solid var(--white);
  transition: all 0.12s;
  box-shadow: 4px 4px 0 rgba(255,255,255,0.15);
}
.ur-dash__action-btn:hover {
  transform: translate(-2px, -2px);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.2);
}
.ur-dash__action-btn i { margin-right: 6px; }

/* Spinning plus animation */
.ur-dash__plus-icon {
  display: inline-block;
  transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ur-dash__plus-icon.is-spinning {
  transform: rotate(360deg) scale(1.3);
}
.ur-dash__action-btn:hover .ur-dash__plus-icon {
  transform: rotate(90deg);
}

/* PROFILE DROPDOWN */
.ur-dash__topbar-actions {
  display: flex;
  align-items: center;
  gap: 16px;
}
.ur-dash__profile {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 12px;
  cursor: pointer;
  position: relative;
  border: 2px solid transparent;
  transition: border-color 0.15s;
}
.ur-dash__profile:hover,
.ur-dash__profile.is-open {
  border-color: rgba(255,255,255,0.15);
}
.ur-dash__profile-info {
  display: flex;
  flex-direction: column;
}
.ur-dash__profile-info strong {
  font-family: var(--font-display);
  font-size: 14px;
  color: var(--white);
  letter-spacing: 2px;
  line-height: 1;
}
.ur-dash__profile-info span {
  font-family: var(--font-display);
  font-size: 9px;
  color: rgba(255,255,255,0.35);
  letter-spacing: 2px;
}
.ur-dash__profile-arrow {
  font-size: 10px;
  color: rgba(255,255,255,0.4);
  transition: transform 0.2s;
}
.ur-dash__profile.is-open .ur-dash__profile-arrow {
  transform: rotate(180deg);
}
.ur-dash__dropdown {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  width: 220px;
  background: var(--bg-black);
  border: 2px solid var(--white);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.1);
  z-index: 100;
  opacity: 0;
  transform: translateY(-8px) scale(0.97);
  pointer-events: none;
  transition: all 0.2s cubic-bezier(0.25, 1, 0.5, 1);
}
.ur-dash__dropdown.is-open {
  opacity: 1;
  transform: translateY(0) scale(1);
  pointer-events: all;
}
.ur-dash__dropdown-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.6);
  transition: all 0.1s;
  border-left: 3px solid transparent;
}
.ur-dash__dropdown-item:hover {
  color: var(--white);
  background: rgba(255,255,255,0.04);
  border-left-color: var(--white);
}
.ur-dash__dropdown-item i {
  width: 16px;
  text-align: center;
  font-size: 13px;
}
.ur-dash__dropdown-divider {
  height: 1px;
  background: rgba(255,255,255,0.08);
  margin: 4px 0;
}
.ur-dash__dropdown-item--logout { color: rgba(255,100,100,0.6); }
.ur-dash__dropdown-item--logout:hover { color: #ff4444; border-left-color: #ff4444; }

/* STAT CARDS */
.ur-dash__stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}
.ur-dash__stat-card {
  background: rgba(255,255,255,0.03);
  border: 2px solid rgba(255,255,255,0.08);
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all 0.15s;
}
.ur-dash__stat-card:hover {
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
.ur-dash__stat-icon {
  width: 44px; height: 44px;
  border: 2px solid var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  color: var(--white);
  flex-shrink: 0;
}
.ur-dash__stat-value {
  font-family: var(--font-display);
  font-size: 28px;
  color: var(--white);
  display: block;
  line-height: 1;
  letter-spacing: 1px;
}
.ur-dash__stat-label {
  font-family: var(--font-display);
  font-size: 11px;
  color: rgba(255,255,255,0.35);
  letter-spacing: 2px;
  display: block;
  margin-top: 2px;
}

/* CHARTS */
.ur-dash__charts {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 24px;
}
.ur-dash__chart-card {
  background: rgba(255,255,255,0.02);
  border: 2px solid rgba(255,255,255,0.08);
  padding: 20px;
  min-width: 0;
  overflow: hidden;
}
.ur-dash__chart-wrap {
  position: relative;
  height: 220px;
  width: 100%;
}
.ur-dash__chart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.ur-dash__chart-header h3 {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 2px;
  color: var(--white);
}
.ur-dash__chart-badge {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 1px;
  color: var(--bg-black);
  background: var(--white);
  padding: 2px 10px;
}

/* BOTTOM ROW */
.ur-dash__bottom {
  display: grid;
  grid-template-columns: 1.5fr 1fr;
  gap: 16px;
}

/* TABLE */
.ur-dash__table-card {
  background: rgba(255,255,255,0.02);
  border: 2px solid rgba(255,255,255,0.08);
  padding: 20px;
}
.ur-dash__table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.ur-dash__table-header h3 {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 2px;
  color: var(--white);
}
.ur-dash__view-all {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.4);
  transition: color 0.2s;
}
.ur-dash__view-all:hover { color: var(--white); }
.ur-dash__view-all i { margin-left: 4px; font-size: 10px; }
.ur-dash__table {
  width: 100%;
  border-collapse: collapse;
}
.ur-dash__table th {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
  text-align: left;
  padding: 8px 10px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
}
.ur-dash__table td {
  font-family: var(--font-body);
  font-size: 14px;
  color: rgba(255,255,255,0.7);
  padding: 10px;
  border-bottom: 1px solid rgba(255,255,255,0.04);
}
.ur-dash__table-event {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 0.5px;
  color: var(--white) !important;
}
.ur-dash__table tr:hover td { background: rgba(255,255,255,0.02); }
.ur-dash__status {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  padding: 3px 8px;
  border: 2px solid;
}
.ur-dash__status--confirmed { border-color: #22c55e; color: #22c55e; }
.ur-dash__status--pending { border-color: #f59e0b; color: #f59e0b; }
.ur-dash__status--refunded { border-color: #ef4444; color: #ef4444; }

/* UPCOMING EVENTS */
.ur-dash__events-card {
  background: rgba(255,255,255,0.02);
  border: 2px solid rgba(255,255,255,0.08);
  padding: 20px;
}
.ur-dash__events-card h3 {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 2px;
  color: var(--white);
  margin-bottom: 16px;
}
.ur-dash__events-list { display: flex; flex-direction: column; gap: 16px; }
.ur-dash__event-item {
  padding: 16px;
  border: 1px solid rgba(255,255,255,0.06);
  background: rgba(255,255,255,0.02);
  transition: all 0.15s;
}
.ur-dash__event-item:hover {
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.08);
}
.ur-dash__event-info h4 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 1px;
  color: var(--white);
  margin-bottom: 2px;
}
.ur-dash__event-date {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.35);
}
.ur-dash__event-progress { margin: 10px 0 8px; }
.ur-dash__progress-bar {
  height: 4px;
  background: rgba(255,255,255,0.08);
  margin-bottom: 6px;
}
.ur-dash__progress-fill {
  height: 100%;
  background: var(--white);
  transition: width 1s ease;
}
.ur-dash__progress-text {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.5);
}
.ur-dash__event-revenue {
  font-family: var(--font-display);
  font-size: 24px;
  color: var(--white);
  letter-spacing: 1px;
  margin-top: 4px;
}

/* RESPONSIVE */
@media (max-width: 1200px) {
  .ur-dash__stats { grid-template-columns: repeat(2, 1fr); }
  .ur-dash__bottom { grid-template-columns: 1fr; }
}
@media (max-width: 900px) {
  .ur-dash { flex-direction: column; }
  .ur-dash__sidebar {
    width: 100%; height: auto; position: relative;
    flex-direction: row; flex-wrap: wrap; padding: 12px;
    border-right: none; border-bottom: 2px solid var(--white);
  }
  .ur-dash__nav { flex-direction: row; overflow-x: auto; gap: 0; }
  .ur-dash__nav-item { white-space: nowrap; border-left: none; border-bottom: 3px solid transparent; padding: 8px 12px; font-size: 11px; }
  .ur-dash__nav-item.active { border-bottom-color: var(--white); border-left-color: transparent; }
  .ur-dash__nav-divider { display: none; }
  .ur-dash__charts { grid-template-columns: 1fr; }
}
</style>
@endsection

@extends('frontend.layout')
@section('pageHeading')
  {{ __('Support Tickets') }}
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
      <a href="{{ route('organizer.pwa-scanner') }}" class="ur-dash__nav-item" data-label="pwa scanner"><i class="fas fa-qrcode"></i> <span>PWA SCANNER</span></a>
      <a href="{{ route('organizer.support-tickets') }}" class="ur-dash__nav-item active" data-label="support tickets"><i class="fas fa-life-ring"></i> <span>SUPPORT TICKETS</span></a>
    </nav>
  </aside>

  <main class="ur-dash__main">
    <div class="ur-dash__topbar">
      <div>
        <h1 class="ur-st__heading">
          <span class="ur-st__heading-label">SUPPORT</span>
          <span class="ur-st__heading-title">TICKETS</span>
          <span class="ur-st__heading-line"></span>
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
    <div class="ur-st__tabs">
      <button class="ur-st__tab active" data-tab="tickets"><i class="fas fa-list"></i> ALL TICKETS</button>
      <button class="ur-st__tab" data-tab="create"><i class="fas fa-plus-circle"></i> CREATE</button>
      <button class="ur-st__tab" data-tab="overview"><i class="fas fa-chart-pie"></i> OVERVIEW</button>
      <div class="ur-st__tab-indicator"></div>
    </div>

    {{-- ═══════════════════ ALL TICKETS ═══════════════════ --}}
    <div class="ur-st__panel active" id="panel-tickets">

      <div class="ur-st__status-pills">
        <button class="ur-st__pill active" data-status=""><span class="ur-st__pill-count">{{ count($tickets) }}</span> ALL</button>
        <button class="ur-st__pill" data-status="open"><span class="ur-st__pill-dot ur-st__pill-dot--open"></span> OPEN <span class="ur-st__pill-count">{{ $tickets->where('status','open')->count() }}</span></button>
        <button class="ur-st__pill" data-status="pending"><span class="ur-st__pill-dot ur-st__pill-dot--pending"></span> PENDING <span class="ur-st__pill-count">{{ $tickets->where('status','pending')->count() }}</span></button>
        <button class="ur-st__pill" data-status="closed"><span class="ur-st__pill-dot ur-st__pill-dot--closed"></span> CLOSED <span class="ur-st__pill-count">{{ $tickets->where('status','closed')->count() }}</span></button>
      </div>

      <div class="ur-st__toolbar">
        <div class="ur-st__search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="stSearch" placeholder="SEARCH TICKET ID OR SUBJECT..." class="ur-st__search-input">
        </div>
      </div>

      <div class="ur-st__ticket-list" id="ticketList">
        @foreach($tickets as $ticket)
        <div class="ur-st__ticket-row" data-status="{{ $ticket->status }}" data-search="{{ strtolower($ticket->ticket_id . ' ' . $ticket->subject) }}">
          <div class="ur-st__ticket-priority ur-st__ticket-priority--{{ $ticket->priority }}"></div>
          <div class="ur-st__ticket-main">
            <div class="ur-st__ticket-top">
              <span class="ur-st__ticket-id">#{{ $ticket->ticket_id }}</span>
              <span class="ur-st__ticket-badge ur-st__ticket-badge--{{ $ticket->status }}">{{ strtoupper($ticket->status) }}</span>
            </div>
            <h4 class="ur-st__ticket-subject">{{ $ticket->subject }}</h4>
            <div class="ur-st__ticket-meta">
              <span><i class="fas fa-clock"></i> {{ $ticket->date }}</span>
              <span><i class="fas fa-comment"></i> {{ $ticket->replies }} REPLIES</span>
              <span><i class="fas fa-paperclip"></i> {{ $ticket->attachments }} FILES</span>
            </div>
          </div>
          <div class="ur-st__ticket-actions">
            <button class="ur-st__action-icon" title="View"><i class="fas fa-eye"></i></button>
            <button class="ur-st__action-icon ur-st__action-icon--danger" title="Delete"><i class="fas fa-trash"></i></button>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- ═══════════════════ CREATE ═══════════════════ --}}
    <div class="ur-st__panel" id="panel-create">
      <div class="ur-st__create-layout">
        <div class="ur-st__section">
          <div class="ur-st__section-header">
            <span class="ur-st__section-num">01</span>
            <h3>NEW TICKET</h3>
          </div>
          <form class="ur-st__form" id="createTicketForm">
            <div class="ur-st__field">
              <label>EMAIL *</label>
              <input type="email" name="email" class="ur-st__input" placeholder="YOUR EMAIL ADDRESS" value="test.user@example.com">
            </div>
            <div class="ur-st__field">
              <label>SUBJECT *</label>
              <input type="text" name="subject" class="ur-st__input" placeholder="DESCRIBE YOUR ISSUE BRIEFLY">
            </div>
            <div class="ur-st__field">
              <label>DESCRIPTION</label>
              <textarea name="description" class="ur-st__input ur-st__textarea" rows="6" placeholder="PROVIDE DETAILS ABOUT YOUR ISSUE..."></textarea>
            </div>
            <div class="ur-st__field">
              <label>ATTACHMENT <span class="ur-st__optional">(ZIP ONLY, MAX 20MB)</span></label>
              <div class="ur-st__dropzone" id="attachDrop">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>DROP FILE HERE OR CLICK TO BROWSE</p>
                <input type="file" accept=".zip" class="ur-st__file-input">
              </div>
            </div>
            <button type="submit" class="ur-st__btn ur-st__btn--primary" id="submitTicketBtn">
              <i class="fas fa-paper-plane"></i> SUBMIT TICKET
            </button>
          </form>
        </div>

        <div class="ur-st__tips-card">
          <div class="ur-st__section-header">
            <span class="ur-st__section-num">02</span>
            <h3>TIPS</h3>
          </div>
          <div class="ur-st__tip"><i class="fas fa-check"></i> Include your booking/event ID if relevant</div>
          <div class="ur-st__tip"><i class="fas fa-check"></i> Screenshots help us resolve faster</div>
          <div class="ur-st__tip"><i class="fas fa-check"></i> ZIP multiple files before uploading</div>
          <div class="ur-st__tip"><i class="fas fa-check"></i> Expect a response within 24 hours</div>
          <div class="ur-st__tip"><i class="fas fa-check"></i> Check existing tickets before creating new ones</div>
        </div>
      </div>
    </div>

    {{-- ═══════════════════ OVERVIEW ═══════════════════ --}}
    <div class="ur-st__panel" id="panel-overview">
      <div class="ur-st__overview-stats">
        <div class="ur-st__overview-card">
          <div class="ur-st__overview-icon"><i class="fas fa-life-ring"></i></div>
          <div class="ur-st__overview-num">{{ count($tickets) }}</div>
          <div class="ur-st__overview-label">TOTAL TICKETS</div>
        </div>
        <div class="ur-st__overview-card">
          <div class="ur-st__overview-icon"><i class="fas fa-folder-open"></i></div>
          <div class="ur-st__overview-num">{{ $tickets->where('status','open')->count() }}</div>
          <div class="ur-st__overview-label">OPEN</div>
        </div>
        <div class="ur-st__overview-card">
          <div class="ur-st__overview-icon"><i class="fas fa-clock"></i></div>
          <div class="ur-st__overview-num">{{ $tickets->where('status','pending')->count() }}</div>
          <div class="ur-st__overview-label">PENDING</div>
        </div>
        <div class="ur-st__overview-card">
          <div class="ur-st__overview-icon"><i class="fas fa-check-circle"></i></div>
          <div class="ur-st__overview-num">{{ $tickets->where('status','closed')->count() }}</div>
          <div class="ur-st__overview-label">CLOSED</div>
        </div>
      </div>

      <div class="ur-st__overview-chart-card">
        <h3>TICKETS BY MONTH</h3>
        <div class="ur-st__overview-chart-wrap"><canvas id="ticketsByMonthChart"></canvas></div>
      </div>

      <div class="ur-st__avg-response">
        <div class="ur-st__avg-card">
          <span class="ur-st__avg-val">4.2 HRS</span>
          <span class="ur-st__avg-lbl">AVG FIRST RESPONSE</span>
        </div>
        <div class="ur-st__avg-card">
          <span class="ur-st__avg-val">1.8 DAYS</span>
          <span class="ur-st__avg-lbl">AVG RESOLUTION TIME</span>
        </div>
        <div class="ur-st__avg-card">
          <span class="ur-st__avg-val">94%</span>
          <span class="ur-st__avg-lbl">SATISFACTION RATE</span>
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
  var tabs = document.querySelectorAll('.ur-st__tab');
  var panels = document.querySelectorAll('.ur-st__panel');
  var indicator = document.querySelector('.ur-st__tab-indicator');
  function setInd(t) { indicator.style.width = t.offsetWidth+'px'; indicator.style.left = t.offsetLeft+'px'; }
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabs.forEach(function(t){t.classList.remove('active');}); panels.forEach(function(p){p.classList.remove('active');});
      this.classList.add('active'); document.getElementById('panel-'+this.dataset.tab).classList.add('active'); setInd(this);
    });
  });
  var at = document.querySelector('.ur-st__tab.active');
  if (at && indicator) setInd(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-st__tab.active'); if (a && indicator) setInd(a); });

  // STATUS PILLS + SEARCH
  var pills = document.querySelectorAll('.ur-st__pill');
  var rows = document.querySelectorAll('.ur-st__ticket-row');
  function filterSt() {
    var ap = document.querySelector('.ur-st__pill.active');
    var sf = ap ? ap.dataset.status : '';
    var q = (document.getElementById('stSearch')||{}).value||''; q = q.toLowerCase();
    rows.forEach(function(r) {
      var show = true;
      if (sf && r.dataset.status !== sf) show = false;
      if (q && (r.dataset.search||'').indexOf(q) === -1) show = false;
      r.style.display = show ? '' : 'none';
    });
  }
  pills.forEach(function(p) { p.addEventListener('click', function() { pills.forEach(function(x){x.classList.remove('active');}); this.classList.add('active'); filterSt(); }); });
  var si = document.getElementById('stSearch'); if (si) si.addEventListener('input', filterSt);

  // DROPZONE
  var zone = document.getElementById('attachDrop');
  if (zone) {
    ['dragenter','dragover'].forEach(function(e) { zone.addEventListener(e, function(ev) { ev.preventDefault(); zone.classList.add('is-drag'); }); });
    ['dragleave','drop'].forEach(function(e) { zone.addEventListener(e, function(ev) { ev.preventDefault(); zone.classList.remove('is-drag'); }); });
    zone.addEventListener('click', function() { zone.querySelector('.ur-st__file-input').click(); });
  }

  // CHART
  Chart.defaults.color = 'rgba(255,255,255,0.3)'; Chart.defaults.borderColor = 'rgba(255,255,255,0.06)';
  Chart.defaults.font.family = "'Bebas Neue', sans-serif"; Chart.defaults.font.size = 13;
  new Chart(document.getElementById('ticketsByMonthChart'), {
    type: 'bar',
    data: { labels: ['Oct','Nov','Dec','Jan','Feb','Mar'], datasets: [{ data: [3,5,2,4,6,3], backgroundColor: '#fff', borderWidth: 0, barPercentage: 0.6 }] },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { grid: { color: 'rgba(255,255,255,0.06)' } }, x: { grid: { display: false } } } }
  });

  // SHARED
  var toggle = document.getElementById('profileToggle'), dropdown = document.getElementById('profileDropdown');
  if (toggle && dropdown) {
    toggle.addEventListener('click', function(e) { e.stopPropagation(); dropdown.classList.toggle('is-open'); toggle.classList.toggle('is-open'); });
    document.addEventListener('click', function() { dropdown.classList.remove('is-open'); toggle.classList.remove('is-open'); });
    dropdown.addEventListener('click', function(e) { e.stopPropagation(); });
  }
  var sidebar = document.getElementById('dashSidebar'), cb = document.getElementById('sidebarCollapse');
  if (cb && sidebar) { cb.addEventListener('click', function() { sidebar.classList.toggle('is-collapsed'); document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed'); }); }
  var ns = document.getElementById('navSearch');
  if (ns) { ns.addEventListener('input', function() { var q = this.value.toLowerCase(); document.querySelectorAll('.ur-dash__nav-item').forEach(function(i) { i.style.display = (i.getAttribute('data-label')||'').includes(q) ? '' : 'none'; }); }); }

  // Stagger
  document.querySelectorAll('.ur-st__ticket-row, .ur-st__overview-card, .ur-st__avg-card, .ur-st__section').forEach(function(el, i) {
    el.style.opacity = '0'; el.style.transform = 'translateY(20px)'; el.style.transition = 'opacity 0.4s ease, transform 0.4s ease'; el.style.transitionDelay = (i*0.06)+'s';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

@section('custom-style')
<style>
.footer-section { display: none !important; }

/* DASHBOARD SHELL */
.ur-dash{display:flex;min-height:100vh;background:var(--bg-black)}.ur-dash__sidebar{width:240px;flex-shrink:0;background:var(--bg-black);border-right:2px solid var(--white);display:flex;flex-direction:column;padding:0;position:sticky;top:0;height:100vh;overflow-y:auto;overflow-x:hidden;transition:width .3s cubic-bezier(.25,1,.5,1)}.ur-dash__sidebar.is-collapsed{width:60px}.sidebar-collapsed .ur-dash__main{margin-left:0}.ur-dash__sidebar-top{display:flex;align-items:center;justify-content:space-between;padding:16px 16px 12px;border-bottom:1px solid rgba(255,255,255,.08);transition:padding .3s cubic-bezier(.25,1,.5,1),justify-content .3s}.ur-dash__sidebar-brand a{text-decoration:none}.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-brand{display:none}.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-top{justify-content:center;padding:16px 0 12px}.ur-dash__collapse{width:34px;height:34px;background:none;border:2px solid rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;padding:0;transition:border-color .3s,background .3s}.ur-dash__collapse:hover{border-color:var(--white);background:rgba(255,255,255,.06)}.ur-dash__collapse-icon{font-size:14px;color:var(--white);display:block;width:14px;height:14px;text-align:center;line-height:14px;transition:transform .5s cubic-bezier(.34,1.56,.64,1)}.ur-dash__sidebar.is-collapsed .ur-dash__collapse-icon{transform:rotate(180deg)}.ur-dash__sidebar-search{padding:10px 16px;margin-top:12px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:8px}.ur-dash__sidebar-search i{color:rgba(255,255,255,.25);font-size:12px;flex-shrink:0}.ur-dash__nav-search{background:none;border:none;outline:none;color:var(--white);font-family:var(--font-display);font-size:12px;letter-spacing:1.5px;width:100%}.ur-dash__nav-search::placeholder{color:rgba(255,255,255,.2)}.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-search{padding:10px 0;justify-content:center}.ur-dash__sidebar.is-collapsed .ur-dash__nav-search{display:none}.ur-dash__nav{flex:1;padding:12px 0;display:flex;flex-direction:column}.ur-dash__nav-item{display:flex;align-items:center;gap:12px;padding:10px 20px;font-family:var(--font-display);font-size:13px;letter-spacing:1.5px;color:rgba(255,255,255,.45);transition:all .12s;border-left:3px solid transparent;overflow:hidden;white-space:nowrap}.ur-dash__nav-item:hover{color:var(--white);background:rgba(255,255,255,.03);border-left-color:rgba(255,255,255,.3)}.ur-dash__nav-item.active{color:var(--white);background:rgba(255,255,255,.06);border-left-color:var(--white)}.ur-dash__nav-item i{width:18px;text-align:center;font-size:14px}.ur-dash__nav-item span{display:inline-block;max-width:180px;opacity:1;transition:max-width .4s cubic-bezier(.25,1,.5,1),opacity .25s ease,margin .4s;overflow:hidden;vertical-align:middle;margin-left:0}.ur-dash__sidebar.is-collapsed .ur-dash__nav-item span{max-width:0;opacity:0;margin-left:-4px}.ur-dash__sidebar.is-collapsed .ur-dash__nav-item{justify-content:center;padding:14px 0}.ur-dash__sidebar.is-collapsed .ur-dash__nav-item i{margin:0;font-size:16px}.ur-dash__main{flex:1;padding:28px 32px;min-width:0;overflow-x:hidden;overflow:visible!important}.ur-dash__topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;gap:20px;position:relative;z-index:50}.ur-dash__date{font-family:var(--font-display);font-size:12px;color:rgba(255,255,255,.25);letter-spacing:3px;margin-top:4px}.ur-dash__topbar-actions{display:flex;align-items:center;gap:16px}.ur-dash__profile{display:flex;align-items:center;gap:10px;padding:6px 12px;cursor:pointer;position:relative;border:2px solid transparent;transition:border-color .15s}.ur-dash__profile:hover,.ur-dash__profile.is-open{border-color:rgba(255,255,255,.15)}.ur-dash__avatar{width:38px;height:38px;background:var(--white);color:var(--bg-black);font-family:var(--font-display);font-size:18px;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0}.ur-dash__profile-info{display:flex;flex-direction:column}.ur-dash__profile-info strong{font-family:var(--font-display);font-size:14px;color:var(--white);letter-spacing:2px;line-height:1}.ur-dash__profile-info span{font-family:var(--font-display);font-size:9px;color:rgba(255,255,255,.35);letter-spacing:2px}.ur-dash__profile-arrow{font-size:10px;color:rgba(255,255,255,.4);transition:transform .2s}.ur-dash__profile.is-open .ur-dash__profile-arrow{transform:rotate(180deg)}.ur-dash__dropdown{position:absolute;top:calc(100% + 8px);right:0;width:220px;background:var(--bg-black);border:2px solid var(--white);box-shadow:8px 8px 0 rgba(255,255,255,.1);z-index:100;opacity:0;transform:translateY(-8px) scale(.97);pointer-events:none;transition:all .2s cubic-bezier(.25,1,.5,1)}.ur-dash__dropdown.is-open{opacity:1;transform:translateY(0) scale(1);pointer-events:all}.ur-dash__dropdown-item{display:flex;align-items:center;gap:10px;padding:12px 16px;font-family:var(--font-display);font-size:13px;letter-spacing:1.5px;color:rgba(255,255,255,.6);transition:all .1s;border-left:3px solid transparent}.ur-dash__dropdown-item:hover{color:var(--white);background:rgba(255,255,255,.04);border-left-color:var(--white)}.ur-dash__dropdown-item i{width:16px;text-align:center;font-size:13px}.ur-dash__dropdown-divider{height:1px;background:rgba(255,255,255,.08);margin:4px 0}.ur-dash__dropdown-item--logout{color:rgba(255,100,100,.6)}.ur-dash__dropdown-item--logout:hover{color:#ff4444;border-left-color:#ff4444}
@media(max-width:900px){.ur-dash{flex-direction:column}.ur-dash__sidebar{width:100%;height:auto;position:relative;flex-direction:row;flex-wrap:wrap;padding:12px;border-right:none;border-bottom:2px solid var(--white)}.ur-dash__nav{flex-direction:row;overflow-x:auto;gap:0}.ur-dash__nav-item{white-space:nowrap;border-left:none;border-bottom:3px solid transparent;padding:8px 12px;font-size:11px}.ur-dash__nav-item.active{border-bottom-color:var(--white);border-left-color:transparent}}

/* HEADING */
.ur-st__heading{display:flex;flex-direction:column}
.ur-st__heading-label{font-family:var(--font-display);font-size:12px;letter-spacing:6px;color:rgba(255,255,255,.3);line-height:1}
.ur-st__heading-title{font-family:var(--font-display);font-size:42px;letter-spacing:4px;color:var(--white);line-height:1;margin-top:4px}
.ur-st__heading-line{width:60px;height:2px;background:var(--white);margin-top:10px}

/* TABS */
.ur-st__tabs{display:flex;gap:0;border-bottom:2px solid rgba(255,255,255,.1);margin-bottom:28px;position:relative}
.ur-st__tab{font-family:var(--font-display);font-size:16px;letter-spacing:3px;color:rgba(255,255,255,.35);background:none;border:none;padding:14px 28px;cursor:pointer;transition:color .2s;position:relative;z-index:1}
.ur-st__tab i{margin-right:8px;font-size:14px}
.ur-st__tab:hover{color:rgba(255,255,255,.7)}.ur-st__tab.active{color:var(--white)}
.ur-st__tab-indicator{position:absolute;bottom:-2px;height:2px;background:var(--white);transition:left .35s cubic-bezier(.25,1,.5,1),width .35s cubic-bezier(.25,1,.5,1)}
.ur-st__panel{display:none}.ur-st__panel.active{display:block}

/* STATUS PILLS */
.ur-st__status-pills{display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap}
.ur-st__pill{font-family:var(--font-display);font-size:12px;letter-spacing:2px;padding:8px 18px;background:none;border:2px solid rgba(255,255,255,.08);color:rgba(255,255,255,.35);cursor:pointer;transition:all .15s;display:flex;align-items:center;gap:8px}
.ur-st__pill:hover{border-color:rgba(255,255,255,.3);color:rgba(255,255,255,.6)}
.ur-st__pill.active{border-color:var(--white);color:var(--white);background:rgba(255,255,255,.05)}
.ur-st__pill-dot{width:8px;height:8px;border-radius:50%}
.ur-st__pill-dot--open{background:#22c55e}.ur-st__pill-dot--pending{background:#f59e0b}.ur-st__pill-dot--closed{background:rgba(255,255,255,.25)}
.ur-st__pill-count{font-size:10px;padding:1px 6px;background:rgba(255,255,255,.08);color:rgba(255,255,255,.4)}
.ur-st__pill.active .ur-st__pill-count{background:rgba(255,255,255,.15);color:var(--white)}

/* TOOLBAR */
.ur-st__toolbar{display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap}
.ur-st__search-box{display:flex;align-items:center;gap:10px;border:2px solid rgba(255,255,255,.1);padding:0 14px;transition:border-color .2s;flex:1;min-width:200px}
.ur-st__search-box:focus-within{border-color:var(--white)}
.ur-st__search-box i{color:rgba(255,255,255,.25);font-size:13px}
.ur-st__search-input{background:none;border:none;outline:none;color:var(--white);font-family:var(--font-display);font-size:13px;letter-spacing:2px;padding:10px 0;width:100%}
.ur-st__search-input::placeholder{color:rgba(255,255,255,.2)}

/* TICKET ROWS */
.ur-st__ticket-list{display:flex;flex-direction:column;gap:0}
.ur-st__ticket-row{display:grid;grid-template-columns:6px 1fr auto;gap:16px;align-items:center;padding:20px 20px 20px 0;border:2px solid rgba(255,255,255,.06);border-bottom:none;transition:all .15s;position:relative}
.ur-st__ticket-row:last-child{border-bottom:2px solid rgba(255,255,255,.06)}
.ur-st__ticket-row:hover{border-color:rgba(255,255,255,.15);background:rgba(255,255,255,.02);transform:translateX(4px)}
.ur-st__ticket-priority{width:6px;height:100%;position:absolute;left:0;top:0}
.ur-st__ticket-priority--high{background:#ef4444}.ur-st__ticket-priority--medium{background:#f59e0b}.ur-st__ticket-priority--low{background:rgba(255,255,255,.15)}
.ur-st__ticket-main{padding-left:20px}
.ur-st__ticket-top{display:flex;align-items:center;gap:12px;margin-bottom:6px}
.ur-st__ticket-id{font-family:var(--font-display);font-size:13px;letter-spacing:1.5px;color:rgba(255,255,255,.4)}
.ur-st__ticket-badge{font-family:var(--font-display);font-size:10px;letter-spacing:2px;padding:2px 8px;border:2px solid}
.ur-st__ticket-badge--open{border-color:#22c55e;color:#22c55e}.ur-st__ticket-badge--pending{border-color:#f59e0b;color:#f59e0b}.ur-st__ticket-badge--closed{border-color:rgba(255,255,255,.25);color:rgba(255,255,255,.4)}
.ur-st__ticket-subject{font-family:var(--font-display);font-size:18px;letter-spacing:1px;color:var(--white);margin-bottom:8px}
.ur-st__ticket-meta{display:flex;gap:20px}
.ur-st__ticket-meta span{font-family:var(--font-display);font-size:10px;letter-spacing:2px;color:rgba(255,255,255,.25)}
.ur-st__ticket-meta i{margin-right:4px;font-size:9px}
.ur-st__ticket-actions{display:flex;gap:8px;padding-right:16px}
.ur-st__action-icon{width:32px;height:32px;background:none;border:2px solid rgba(255,255,255,.08);color:rgba(255,255,255,.4);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;font-size:12px}
.ur-st__action-icon:hover{border-color:var(--white);color:var(--white);transform:translate(-1px,-1px);box-shadow:2px 2px 0 rgba(255,255,255,.1)}
.ur-st__action-icon--danger:hover{border-color:#ef4444;color:#ef4444;box-shadow:2px 2px 0 rgba(239,68,68,.2)}

/* CREATE TAB */
.ur-st__create-layout{display:grid;grid-template-columns:1.5fr 1fr;gap:20px}
.ur-st__section{border:2px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02);padding:28px;position:relative;transition:border-color .2s}
.ur-st__section:hover{border-color:rgba(255,255,255,.2)}
.ur-st__section::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:repeating-linear-gradient(0deg,transparent,transparent 3px,rgba(255,255,255,.008) 3px,rgba(255,255,255,.008) 4px);pointer-events:none;z-index:0}
.ur-st__section>*{position:relative;z-index:1}
.ur-st__section-header{display:flex;align-items:center;gap:16px;margin-bottom:24px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,.06)}
.ur-st__section-num{font-family:var(--font-display);font-size:56px;color:transparent;line-height:1;letter-spacing:2px;-webkit-text-stroke:2px rgba(255,255,255,.25)}
.ur-st__section:hover .ur-st__section-num{-webkit-text-stroke-color:var(--white);transition:-webkit-text-stroke-color .2s}
.ur-st__section-header h3{font-family:var(--font-display);font-size:18px;letter-spacing:3px;color:var(--white)}
.ur-st__field{margin-bottom:20px}
.ur-st__field label{font-family:var(--font-display);font-size:11px;letter-spacing:2.5px;color:rgba(255,255,255,.4);display:block;margin-bottom:8px}
.ur-st__optional{font-size:9px;color:rgba(255,255,255,.2)}
.ur-st__input{width:100%;background:rgba(255,255,255,.04);border:2px solid rgba(255,255,255,.1);color:var(--white);font-family:var(--font-display);font-size:14px;letter-spacing:1.5px;padding:12px 14px;outline:none;transition:border-color .2s,box-shadow .2s}
.ur-st__input::placeholder{color:rgba(255,255,255,.15)}
.ur-st__input:focus{border-color:var(--white);box-shadow:4px 4px 0 rgba(255,255,255,.1)}
.ur-st__textarea{font-family:var(--font-body);letter-spacing:.5px;resize:vertical;min-height:100px}
.ur-st__dropzone{border:2px dashed rgba(255,255,255,.15);padding:30px;text-align:center;cursor:pointer;transition:all .25s}
.ur-st__dropzone:hover,.ur-st__dropzone.is-drag{border-color:var(--white);background:rgba(255,255,255,.04);transform:translate(-2px,-2px);box-shadow:4px 4px 0 rgba(255,255,255,.08)}
.ur-st__dropzone i{font-size:24px;color:rgba(255,255,255,.2);display:block;margin-bottom:8px}
.ur-st__dropzone p{font-family:var(--font-display);font-size:12px;letter-spacing:2px;color:rgba(255,255,255,.4)}
.ur-st__file-input{display:none}
.ur-st__btn{font-family:var(--font-display);font-size:15px;letter-spacing:3px;padding:14px 32px;cursor:pointer;border:2px solid;transition:all .15s;width:100%;text-align:center}
.ur-st__btn i{margin-right:8px}
.ur-st__btn--primary{background:var(--white);color:var(--bg-black);border-color:var(--white);box-shadow:4px 4px 0 rgba(255,255,255,.15)}
.ur-st__btn--primary:hover{transform:translate(-2px,-2px);box-shadow:8px 8px 0 rgba(255,255,255,.2)}

/* TIPS CARD */
.ur-st__tips-card{border:2px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02);padding:28px;position:relative}
.ur-st__tips-card::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:repeating-linear-gradient(0deg,transparent,transparent 3px,rgba(255,255,255,.008) 3px,rgba(255,255,255,.008) 4px);pointer-events:none;z-index:0}
.ur-st__tips-card>*{position:relative;z-index:1}
.ur-st__tip{font-family:var(--font-display);font-size:12px;letter-spacing:2px;color:rgba(255,255,255,.4);padding:12px 0;border-bottom:1px solid rgba(255,255,255,.04);display:flex;align-items:center;gap:10px}
.ur-st__tip:last-child{border-bottom:none}
.ur-st__tip i{color:rgba(255,255,255,.15);font-size:11px;flex-shrink:0}

/* OVERVIEW */
.ur-st__overview-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.ur-st__overview-card{border:2px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02);padding:24px;text-align:center;transition:all .15s}
.ur-st__overview-card:hover{border-color:var(--white);transform:translate(-2px,-2px);box-shadow:4px 4px 0 rgba(255,255,255,.1)}
.ur-st__overview-icon{font-size:24px;color:rgba(255,255,255,.2);margin-bottom:12px}
.ur-st__overview-num{font-family:var(--font-display);font-size:36px;color:var(--white);letter-spacing:1px;line-height:1;margin-bottom:6px}
.ur-st__overview-label{font-family:var(--font-display);font-size:11px;letter-spacing:2.5px;color:rgba(255,255,255,.3)}
.ur-st__overview-chart-card{border:2px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02);padding:20px;margin-bottom:24px;min-width:0;overflow:hidden}
.ur-st__overview-chart-card h3{font-family:var(--font-display);font-size:16px;letter-spacing:2px;color:var(--white);margin-bottom:16px}
.ur-st__overview-chart-wrap{position:relative;height:220px;width:100%}

.ur-st__avg-response{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.ur-st__avg-card{border:2px solid rgba(255,255,255,.08);background:rgba(255,255,255,.02);padding:24px;text-align:center;transition:all .15s}
.ur-st__avg-card:hover{border-color:var(--white);transform:translate(-2px,-2px);box-shadow:4px 4px 0 rgba(255,255,255,.1)}
.ur-st__avg-val{font-family:var(--font-display);font-size:28px;color:var(--white);letter-spacing:1px;display:block;line-height:1;margin-bottom:6px}
.ur-st__avg-lbl{font-family:var(--font-display);font-size:10px;letter-spacing:2.5px;color:rgba(255,255,255,.3)}

/* RESPONSIVE */
@media(max-width:1200px){.ur-st__overview-stats{grid-template-columns:repeat(2,1fr)}.ur-st__create-layout{grid-template-columns:1fr}.ur-st__avg-response{grid-template-columns:1fr}}
@media(max-width:600px){.ur-st__overview-stats{grid-template-columns:1fr}}
</style>
@endsection

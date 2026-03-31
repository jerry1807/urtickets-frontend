@extends('frontend.layout')
@section('pageHeading')
  {{ __('Event Management') }}
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
      <a href="{{ route('organizer.event-management') }}" class="ur-dash__nav-item active" data-label="event management">
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
        <h1 class="ur-em__heading">
          <span class="ur-em__heading-outline">EVENT</span>
          <span class="ur-em__heading-solid">MANAGEMENT</span>
          <span class="ur-em__heading-line"></span>
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

    {{-- TAB BAR --}}
    <div class="ur-em__tabs">
      <button class="ur-em__tab active" data-tab="create">
        <i class="fas fa-plus-circle"></i> CREATE
      </button>
      <button class="ur-em__tab" data-tab="all-events">
        <i class="fas fa-list"></i> ALL EVENTS
      </button>
      <button class="ur-em__tab" data-tab="analytics">
        <i class="fas fa-chart-bar"></i> ANALYTICS
      </button>
      <button class="ur-em__tab" data-tab="templates">
        <i class="fas fa-layer-group"></i> TEMPLATES
      </button>
      <div class="ur-em__tab-indicator"></div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: CREATE --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-em__panel active" id="panel-create">

      {{-- CREATE TOOLBAR --}}
      <div class="ur-em__create-toolbar">
        {{-- EVENT TYPE TOGGLE --}}
        <div class="ur-em__type-toggle">
          <button class="ur-em__type-btn active" data-type="venue">
            <i class="fas fa-map-marker-alt"></i> VENUE
          </button>
          <button class="ur-em__type-btn" data-type="online">
            <i class="fas fa-video"></i> ONLINE
          </button>
          <div class="ur-em__type-slider"></div>
        </div>

        {{-- DRAFTS & TEMPLATES DROPDOWN --}}
        <div class="ur-em__vault" id="vaultToggle">
          <button class="ur-em__vault-btn" type="button">
            <i class="fas fa-archive"></i> VAULT <i class="fas fa-chevron-down ur-em__vault-arrow"></i>
          </button>
          <div class="ur-em__vault-dropdown" id="vaultDropdown">
            <div class="ur-em__vault-section">
              <div class="ur-em__vault-heading"><i class="fas fa-file-alt"></i> SAVED DRAFTS</div>
              <a href="#" class="ur-em__vault-item">
                <span class="ur-em__vault-name">TECH SUMMIT 2026</span>
                <span class="ur-em__vault-meta">MAR 25</span>
              </a>
              <a href="#" class="ur-em__vault-item">
                <span class="ur-em__vault-name">SUMMER BASH V2</span>
                <span class="ur-em__vault-meta">MAR 20</span>
              </a>
              <a href="#" class="ur-em__vault-item ur-em__vault-item--empty">
                <span class="ur-em__vault-name">UNTITLED EVENT</span>
                <span class="ur-em__vault-meta">MAR 18</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <form class="ur-em__form" id="createEventForm">
        {{-- SECTION: MEDIA --}}
        <div class="ur-em__section">
          <div class="ur-em__section-header">
            <span class="ur-em__section-num">01</span>
            <h3>MEDIA</h3>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field ur-em__field--full">
              <label>GALLERY IMAGES</label>
              <div class="ur-em__dropzone" id="galleryDrop">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>DRAG & DROP IMAGES HERE</p>
                <span>1170 x 570 PX RECOMMENDED</span>
                <input type="file" multiple accept="image/*" class="ur-em__file-input">
              </div>
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>THUMBNAIL IMAGE</label>
              <div class="ur-em__dropzone ur-em__dropzone--sm" id="thumbDrop">
                <i class="fas fa-image"></i>
                <span>320 x 230 PX</span>
                <input type="file" accept="image/*" class="ur-em__file-input">
              </div>
            </div>
          </div>
        </div>

        {{-- SECTION: SCHEDULING --}}
        <div class="ur-em__section">
          <div class="ur-em__section-header">
            <span class="ur-em__section-num">02</span>
            <h3>SCHEDULING</h3>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>DATE TYPE</label>
              <div class="ur-em__toggle-group">
                <button type="button" class="ur-em__toggle active" data-val="single">SINGLE</button>
                <button type="button" class="ur-em__toggle" data-val="multiple">MULTIPLE</button>
              </div>
              <input type="hidden" name="date_type" value="single">
            </div>
            <div class="ur-em__field">
              <label>COUNTDOWN</label>
              <div class="ur-em__toggle-group">
                <button type="button" class="ur-em__toggle active" data-val="active">ACTIVE</button>
                <button type="button" class="ur-em__toggle" data-val="deactive">DEACTIVE</button>
              </div>
              <input type="hidden" name="countdown_status" value="active">
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>START DATE</label>
              <input type="date" name="start_date" class="ur-em__input">
            </div>
            <div class="ur-em__field">
              <label>START TIME</label>
              <input type="time" name="start_time" class="ur-em__input">
            </div>
            <div class="ur-em__field">
              <label>END DATE</label>
              <input type="date" name="end_date" class="ur-em__input">
            </div>
            <div class="ur-em__field">
              <label>END TIME</label>
              <input type="time" name="end_time" class="ur-em__input">
            </div>
          </div>
        </div>

        {{-- SECTION: EVENT DETAILS --}}
        <div class="ur-em__section">
          <div class="ur-em__section-header">
            <span class="ur-em__section-num">03</span>
            <h3>EVENT DETAILS</h3>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field ur-em__field--full">
              <label>EVENT TITLE</label>
              <input type="text" name="title" class="ur-em__input" placeholder="NAME YOUR EVENT">
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>CATEGORY</label>
              <select name="category" class="ur-em__input">
                <option value="">SELECT CATEGORY</option>
                @foreach($eventCategories as $cat)
                  <option value="{{ $cat->id }}">{{ strtoupper($cat->name) }}</option>
                @endforeach
              </select>
            </div>
            <div class="ur-em__field">
              <label>STATUS</label>
              <select name="status" class="ur-em__input">
                <option value="active">ACTIVE</option>
                <option value="draft">DRAFT</option>
                <option value="inactive">INACTIVE</option>
              </select>
            </div>
            <div class="ur-em__field">
              <label>IS FEATURED</label>
              <select name="is_featured" class="ur-em__input">
                <option value="0">NO</option>
                <option value="1">YES</option>
              </select>
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field ur-em__field--full">
              <label>DESCRIPTION</label>
              <textarea name="description" class="ur-em__input ur-em__textarea" rows="6" placeholder="TELL PEOPLE ABOUT YOUR EVENT..."></textarea>
            </div>
          </div>
          {{-- ONLINE-ONLY: MEETING URL --}}
          <div class="ur-em__row ur-em__online-only" style="display:none;">
            <div class="ur-em__field ur-em__field--full">
              <label>MEETING URL <span class="ur-em__badge">ONLINE ONLY</span></label>
              <input type="url" name="meeting_url" class="ur-em__input" placeholder="HTTPS://ZOOM.US/J/...">
            </div>
          </div>
        </div>

        {{-- SECTION: TICKETING --}}
        <div class="ur-em__section">
          <div class="ur-em__section-header">
            <span class="ur-em__section-num">04</span>
            <h3>TICKETING</h3>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>TICKET TYPE</label>
              <div class="ur-em__toggle-group">
                <button type="button" class="ur-em__toggle active" data-val="unlimited">UNLIMITED</button>
                <button type="button" class="ur-em__toggle" data-val="limited">LIMITED</button>
              </div>
              <input type="hidden" name="ticket_type" value="unlimited">
            </div>
            <div class="ur-em__field ur-em__capacity-field" style="display:none;">
              <label>MAX CAPACITY</label>
              <input type="number" name="max_capacity" class="ur-em__input" placeholder="500">
            </div>
          </div>
          <div class="ur-em__row ur-em__row--price">
            <div class="ur-em__field">
              <label>PRICE ($)</label>
              <div class="ur-em__price-wrap">
                <input type="number" name="price" class="ur-em__input" placeholder="0.00" step="0.01" id="priceInput">
                <label class="ur-em__checkbox-label ur-em__free-toggle">
                  <input type="checkbox" name="is_free" id="isFreeCheck">
                  <span class="ur-em__check-box"></span>
                  FREE
                </label>
              </div>
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>EARLY BIRD DISCOUNT</label>
              <div class="ur-em__toggle-group">
                <button type="button" class="ur-em__toggle" data-val="enabled">ENABLED</button>
                <button type="button" class="ur-em__toggle active" data-val="disabled">DISABLED</button>
              </div>
              <input type="hidden" name="early_bird" value="disabled">
            </div>
            <div class="ur-em__field ur-em__earlybird-fields" style="display:none;">
              <label>DISCOUNT %</label>
              <input type="number" name="early_bird_discount" class="ur-em__input" placeholder="10" min="1" max="100">
            </div>
            <div class="ur-em__field ur-em__earlybird-fields" style="display:none;">
              <label>EARLY BIRD DEADLINE</label>
              <input type="date" name="early_bird_date" class="ur-em__input">
            </div>
          </div>
        </div>

        {{-- SECTION: SEO & POLICY --}}
        <div class="ur-em__section">
          <div class="ur-em__section-header">
            <span class="ur-em__section-num">05</span>
            <h3>SEO & POLICY</h3>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field ur-em__field--full">
              <label>REFUND POLICY</label>
              <textarea name="refund_policy" class="ur-em__input ur-em__textarea" rows="3" placeholder="DESCRIBE YOUR REFUND POLICY..."></textarea>
            </div>
          </div>
          <div class="ur-em__row">
            <div class="ur-em__field">
              <label>META KEYWORDS</label>
              <input type="text" name="meta_keywords" class="ur-em__input" placeholder="MUSIC, CONCERT, LIVE">
            </div>
            <div class="ur-em__field">
              <label>META DESCRIPTION</label>
              <input type="text" name="meta_description" class="ur-em__input" placeholder="A BRIEF DESCRIPTION FOR SEARCH ENGINES">
            </div>
          </div>
        </div>

        {{-- SUBMIT --}}
        <div class="ur-em__submit-row">
          <button type="button" class="ur-em__btn ur-em__btn--ghost" id="saveDraftBtn">
            <i class="fas fa-save"></i> SAVE DRAFT
          </button>
          <button type="submit" class="ur-em__btn ur-em__btn--primary" id="publishBtn">
            <i class="fas fa-rocket"></i> PUBLISH EVENT
          </button>
        </div>
      </form>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: ALL EVENTS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-em__panel" id="panel-all-events">

      {{-- TOOLBAR --}}
      <div class="ur-em__toolbar">
        <div class="ur-em__toolbar-left">
          <div class="ur-em__search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="eventSearch" placeholder="SEARCH EVENTS..." class="ur-em__search-input">
          </div>
          <select id="statusFilter" class="ur-em__filter-select">
            <option value="">ALL STATUS</option>
            <option value="active">ACTIVE</option>
            <option value="draft">DRAFT</option>
            <option value="inactive">INACTIVE</option>
            <option value="ended">ENDED</option>
          </select>
          <select id="typeFilter" class="ur-em__filter-select">
            <option value="">ALL TYPES</option>
            <option value="venue">VENUE</option>
            <option value="online">ONLINE</option>
          </select>
        </div>
        <div class="ur-em__toolbar-right">
          <span class="ur-em__event-count">{{ count($allEvents) }} EVENTS</span>
        </div>
      </div>

      {{-- EVENTS TABLE --}}
      <div class="ur-em__table-wrap">
        <table class="ur-em__table">
          <thead>
            <tr>
              <th>EVENT</th>
              <th>TYPE</th>
              <th>DATE</th>
              <th>TICKETS</th>
              <th>REVENUE</th>
              <th>STATUS</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody id="eventsBody">
            @foreach($allEvents as $event)
            <tr data-status="{{ $event->status }}" data-type="{{ $event->type }}" data-name="{{ strtolower($event->title) }}">
              <td>
                <div class="ur-em__event-cell">
                  <div class="ur-em__event-thumb">{{ strtoupper(substr($event->title, 0, 2)) }}</div>
                  <div>
                    <strong class="ur-em__event-title">{{ $event->title }}</strong>
                    <span class="ur-em__event-cat">{{ strtoupper($event->category) }}</span>
                  </div>
                </div>
              </td>
              <td>
                <span class="ur-em__type-badge ur-em__type-badge--{{ $event->type }}">
                  <i class="fas fa-{{ $event->type === 'online' ? 'video' : 'map-marker-alt' }}"></i>
                  {{ strtoupper($event->type) }}
                </span>
              </td>
              <td class="ur-em__date-cell">{{ $event->date }}</td>
              <td>
                <div class="ur-em__tickets-cell">
                  <span>{{ $event->sold }}/{{ $event->capacity }}</span>
                  <div class="ur-em__mini-bar">
                    <div class="ur-em__mini-fill" style="width:{{ $event->capacity > 0 ? round(($event->sold / $event->capacity) * 100) : 0 }}%"></div>
                  </div>
                </div>
              </td>
              <td class="ur-em__revenue-cell">${{ number_format($event->revenue) }}</td>
              <td>
                <span class="ur-em__status ur-em__status--{{ $event->status }}">{{ strtoupper($event->status) }}</span>
              </td>
              <td>
                <div class="ur-em__actions">
                  <button class="ur-em__action-icon" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="ur-em__action-icon" title="Duplicate"><i class="fas fa-copy"></i></button>
                  <button class="ur-em__action-icon ur-em__action-icon--danger" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: ANALYTICS --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-em__panel" id="panel-analytics">

      {{-- OVERVIEW STATS --}}
      <div class="ur-em__analytics-stats">
        <div class="ur-em__analytics-card">
          <div class="ur-em__analytics-icon"><i class="fas fa-calendar-check"></i></div>
          <div class="ur-em__analytics-num">{{ count($allEvents) }}</div>
          <div class="ur-em__analytics-label">TOTAL EVENTS</div>
        </div>
        <div class="ur-em__analytics-card">
          <div class="ur-em__analytics-icon"><i class="fas fa-ticket-alt"></i></div>
          <div class="ur-em__analytics-num">{{ $analyticsData->total_tickets_sold }}</div>
          <div class="ur-em__analytics-label">TICKETS SOLD</div>
        </div>
        <div class="ur-em__analytics-card">
          <div class="ur-em__analytics-icon"><i class="fas fa-dollar-sign"></i></div>
          <div class="ur-em__analytics-num">${{ number_format($analyticsData->total_revenue) }}</div>
          <div class="ur-em__analytics-label">TOTAL REVENUE</div>
        </div>
        <div class="ur-em__analytics-card">
          <div class="ur-em__analytics-icon"><i class="fas fa-percentage"></i></div>
          <div class="ur-em__analytics-num">{{ $analyticsData->avg_fill_rate }}%</div>
          <div class="ur-em__analytics-label">AVG FILL RATE</div>
        </div>
      </div>

      {{-- CHARTS --}}
      <div class="ur-em__analytics-charts">
        <div class="ur-em__analytics-chart-card">
          <div class="ur-em__analytics-chart-head">
            <h3>TICKET SALES BY EVENT</h3>
          </div>
          <div class="ur-em__analytics-chart-wrap"><canvas id="salesByEventChart"></canvas></div>
        </div>
        <div class="ur-em__analytics-chart-card">
          <div class="ur-em__analytics-chart-head">
            <h3>REVENUE TREND (6 MONTHS)</h3>
          </div>
          <div class="ur-em__analytics-chart-wrap"><canvas id="revenueTrendChart"></canvas></div>
        </div>
      </div>

      {{-- TOP PERFORMERS --}}
      <div class="ur-em__top-performers">
        <h3>TOP PERFORMERS</h3>
        <div class="ur-em__performers-grid">
          @foreach($allEvents->sortByDesc('revenue')->take(3) as $i => $event)
          <div class="ur-em__performer-card">
            <div class="ur-em__performer-rank">#{{ $i + 1 }}</div>
            <h4>{{ $event->title }}</h4>
            <div class="ur-em__performer-stats">
              <div>
                <span class="ur-em__performer-val">${{ number_format($event->revenue) }}</span>
                <span class="ur-em__performer-lbl">REVENUE</span>
              </div>
              <div>
                <span class="ur-em__performer-val">{{ $event->sold }}</span>
                <span class="ur-em__performer-lbl">SOLD</span>
              </div>
              <div>
                <span class="ur-em__performer-val">{{ $event->capacity > 0 ? round(($event->sold / $event->capacity) * 100) : 0 }}%</span>
                <span class="ur-em__performer-lbl">FILL RATE</span>
              </div>
            </div>
            <div class="ur-em__performer-bar">
              <div class="ur-em__performer-fill" style="width:{{ $event->capacity > 0 ? round(($event->sold / $event->capacity) * 100) : 0 }}%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- TAB: TEMPLATES --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="ur-em__panel" id="panel-templates">

      <div class="ur-em__tpl-header">
        <div>
          <h2 class="ur-em__tpl-title">EVENT TEMPLATES</h2>
          <p class="ur-em__tpl-sub">START FROM A BLUEPRINT. CUSTOMIZE EVERYTHING.</p>
        </div>
        <button class="ur-em__btn ur-em__btn--primary" id="createTemplateBtn">
          <i class="fas fa-plus ur-em__tpl-plus"></i> NEW TEMPLATE
        </button>
      </div>

      <div class="ur-em__tpl-grid">
        {{-- TEMPLATE CARD: CONCERT --}}
        <div class="ur-em__tpl-card">
          <div class="ur-em__tpl-card-icon"><i class="fas fa-music"></i></div>
          <div class="ur-em__tpl-card-body">
            <h3>CONCERT / LIVE SHOW</h3>
            <p>Venue event with ticketing, gallery, and countdown timer pre-configured.</p>
            <div class="ur-em__tpl-card-tags">
              <span>VENUE</span><span>TICKETED</span><span>COUNTDOWN</span>
            </div>
          </div>
          <div class="ur-em__tpl-card-footer">
            <span class="ur-em__tpl-card-meta"><i class="fas fa-clock"></i> USED 12 TIMES</span>
            <button class="ur-em__tpl-use-btn">USE <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>

        {{-- TEMPLATE CARD: WEBINAR --}}
        <div class="ur-em__tpl-card">
          <div class="ur-em__tpl-card-icon"><i class="fas fa-video"></i></div>
          <div class="ur-em__tpl-card-body">
            <h3>ONLINE WEBINAR</h3>
            <p>Virtual event with meeting URL, unlimited tickets, and free entry defaults.</p>
            <div class="ur-em__tpl-card-tags">
              <span>ONLINE</span><span>FREE</span><span>UNLIMITED</span>
            </div>
          </div>
          <div class="ur-em__tpl-card-footer">
            <span class="ur-em__tpl-card-meta"><i class="fas fa-clock"></i> USED 8 TIMES</span>
            <button class="ur-em__tpl-use-btn">USE <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>

        {{-- TEMPLATE CARD: FOOD POPUP --}}
        <div class="ur-em__tpl-card">
          <div class="ur-em__tpl-card-icon"><i class="fas fa-utensils"></i></div>
          <div class="ur-em__tpl-card-body">
            <h3>FOOD & DRINK POPUP</h3>
            <p>Limited capacity venue with early bird pricing and featured event flag.</p>
            <div class="ur-em__tpl-card-tags">
              <span>VENUE</span><span>LIMITED</span><span>EARLY BIRD</span>
            </div>
          </div>
          <div class="ur-em__tpl-card-footer">
            <span class="ur-em__tpl-card-meta"><i class="fas fa-clock"></i> USED 5 TIMES</span>
            <button class="ur-em__tpl-use-btn">USE <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>

        {{-- TEMPLATE CARD: SPORTS --}}
        <div class="ur-em__tpl-card">
          <div class="ur-em__tpl-card-icon"><i class="fas fa-running"></i></div>
          <div class="ur-em__tpl-card-body">
            <h3>SPORTS / FITNESS</h3>
            <p>Multi-date venue event with capacity limits and tiered ticket pricing.</p>
            <div class="ur-em__tpl-card-tags">
              <span>VENUE</span><span>MULTI-DATE</span><span>TIERED</span>
            </div>
          </div>
          <div class="ur-em__tpl-card-footer">
            <span class="ur-em__tpl-card-meta"><i class="fas fa-clock"></i> USED 3 TIMES</span>
            <button class="ur-em__tpl-use-btn">USE <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>

        {{-- TEMPLATE CARD: CONFERENCE --}}
        <div class="ur-em__tpl-card">
          <div class="ur-em__tpl-card-icon"><i class="fas fa-microphone-alt"></i></div>
          <div class="ur-em__tpl-card-body">
            <h3>CONFERENCE / SUMMIT</h3>
            <p>Multi-day featured event with early bird, high capacity, and SEO pre-filled.</p>
            <div class="ur-em__tpl-card-tags">
              <span>VENUE</span><span>FEATURED</span><span>MULTI-DATE</span>
            </div>
          </div>
          <div class="ur-em__tpl-card-footer">
            <span class="ur-em__tpl-card-meta"><i class="fas fa-clock"></i> USED 2 TIMES</span>
            <button class="ur-em__tpl-use-btn">USE <i class="fas fa-arrow-right"></i></button>
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

  // ────────────────────────────────
  // TAB SWITCHING
  // ────────────────────────────────
  var tabs = document.querySelectorAll('.ur-em__tab');
  var panels = document.querySelectorAll('.ur-em__panel');
  var indicator = document.querySelector('.ur-em__tab-indicator');

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

  // Set indicator on load
  var activeTab = document.querySelector('.ur-em__tab.active');
  if (activeTab && indicator) setIndicator(activeTab);
  window.addEventListener('resize', function() {
    var at = document.querySelector('.ur-em__tab.active');
    if (at && indicator) setIndicator(at);
  });

  // ────────────────────────────────
  // EVENT TYPE TOGGLE (VENUE / ONLINE)
  // ────────────────────────────────
  var typeBtns = document.querySelectorAll('.ur-em__type-btn');
  var typeSlider = document.querySelector('.ur-em__type-slider');
  var onlineFields = document.querySelectorAll('.ur-em__online-only');

  function setTypeSlider(btn) {
    typeSlider.style.width = btn.offsetWidth + 'px';
    typeSlider.style.left = btn.offsetLeft + 'px';
  }

  typeBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      typeBtns.forEach(function(b) { b.classList.remove('active'); });
      this.classList.add('active');
      setTypeSlider(this);
      var isOnline = this.dataset.type === 'online';
      onlineFields.forEach(function(f) {
        f.style.display = isOnline ? '' : 'none';
      });
    });
  });

  var activeType = document.querySelector('.ur-em__type-btn.active');
  if (activeType && typeSlider) setTypeSlider(activeType);

  // ────────────────────────────────
  // TOGGLE GROUPS (date type, countdown, tickets, early bird)
  // ────────────────────────────────
  document.querySelectorAll('.ur-em__toggle-group').forEach(function(group) {
    var hidden = group.nextElementSibling;
    group.querySelectorAll('.ur-em__toggle').forEach(function(btn) {
      btn.addEventListener('click', function() {
        group.querySelectorAll('.ur-em__toggle').forEach(function(b) { b.classList.remove('active'); });
        this.classList.add('active');
        if (hidden && hidden.type === 'hidden') hidden.value = this.dataset.val;

        // Ticket type → show/hide capacity
        if (this.dataset.val === 'limited') {
          var cap = document.querySelector('.ur-em__capacity-field');
          if (cap) cap.style.display = '';
        } else if (this.dataset.val === 'unlimited') {
          var cap = document.querySelector('.ur-em__capacity-field');
          if (cap) cap.style.display = 'none';
        }

        // Early bird → show/hide discount fields
        if (this.dataset.val === 'enabled') {
          document.querySelectorAll('.ur-em__earlybird-fields').forEach(function(f) { f.style.display = ''; });
        } else if (this.dataset.val === 'disabled') {
          document.querySelectorAll('.ur-em__earlybird-fields').forEach(function(f) { f.style.display = 'none'; });
        }
      });
    });
  });

  // ────────────────────────────────
  // FREE TICKETS CHECKBOX
  // ────────────────────────────────
  var freeCheck = document.getElementById('isFreeCheck');
  var priceInput = document.getElementById('priceInput');
  if (freeCheck && priceInput) {
    freeCheck.addEventListener('change', function() {
      priceInput.disabled = this.checked;
      if (this.checked) { priceInput.value = '0'; priceInput.style.opacity = '0.3'; }
      else { priceInput.style.opacity = '1'; }
    });
  }

  // ────────────────────────────────
  // DROPZONE HOVER EFFECTS
  // ────────────────────────────────
  document.querySelectorAll('.ur-em__dropzone').forEach(function(zone) {
    ['dragenter','dragover'].forEach(function(evt) {
      zone.addEventListener(evt, function(e) { e.preventDefault(); zone.classList.add('is-drag'); });
    });
    ['dragleave','drop'].forEach(function(evt) {
      zone.addEventListener(evt, function(e) { e.preventDefault(); zone.classList.remove('is-drag'); });
    });
    zone.addEventListener('click', function() {
      zone.querySelector('.ur-em__file-input').click();
    });
  });

  // ────────────────────────────────
  // ALL EVENTS: SEARCH + FILTER
  // ────────────────────────────────
  var searchInput = document.getElementById('eventSearch');
  var statusFilter = document.getElementById('statusFilter');
  var typeFilter = document.getElementById('typeFilter');
  var rows = document.querySelectorAll('#eventsBody tr');

  function filterEvents() {
    var q = (searchInput ? searchInput.value : '').toLowerCase();
    var sf = statusFilter ? statusFilter.value : '';
    var tf = typeFilter ? typeFilter.value : '';
    rows.forEach(function(row) {
      var name = row.dataset.name || '';
      var status = row.dataset.status || '';
      var type = row.dataset.type || '';
      var show = true;
      if (q && name.indexOf(q) === -1) show = false;
      if (sf && status !== sf) show = false;
      if (tf && type !== tf) show = false;
      row.style.display = show ? '' : 'none';
    });
  }

  if (searchInput) searchInput.addEventListener('input', filterEvents);
  if (statusFilter) statusFilter.addEventListener('change', filterEvents);
  if (typeFilter) typeFilter.addEventListener('change', filterEvents);

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

  var eventNames = {!! json_encode($analyticsData->event_names) !!};
  var eventSales = {!! json_encode($analyticsData->event_sales) !!};
  var trendMonths = {!! json_encode($analyticsData->trend_months) !!};
  var trendRevenue = {!! json_encode($analyticsData->trend_revenue) !!};

  new Chart(document.getElementById('salesByEventChart'), {
    type: 'bar',
    data: {
      labels: eventNames,
      datasets: [{
        data: eventSales,
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
        x: { grid: { color: gridColor }, ticks: { callback: function(v) { return v; } } },
        y: { grid: { display: false } }
      }
    }
  });

  new Chart(document.getElementById('revenueTrendChart'), {
    type: 'line',
    data: {
      labels: trendMonths,
      datasets: [{
        data: trendRevenue,
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

  // ────────────────────────────────
  // DRAFTS & TEMPLATES VAULT DROPDOWN
  // ────────────────────────────────
  var vault = document.getElementById('vaultToggle');
  var vaultDrop = document.getElementById('vaultDropdown');
  if (vault && vaultDrop) {
    vault.querySelector('.ur-em__vault-btn').addEventListener('click', function(e) {
      e.stopPropagation();
      vault.classList.toggle('is-open');
    });
    document.addEventListener('click', function() {
      vault.classList.remove('is-open');
    });
    vaultDrop.addEventListener('click', function(e) { e.stopPropagation(); });
  }

  // ────────────────────────────────
  // SHARED: sidebar, profile dropdown, entrance animations
  // ────────────────────────────────
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

  // Sidebar collapse
  var sidebar = document.getElementById('dashSidebar');
  var collapseBtn = document.getElementById('sidebarCollapse');
  if (collapseBtn && sidebar) {
    collapseBtn.addEventListener('click', function() {
      sidebar.classList.toggle('is-collapsed');
      document.querySelector('.ur-dash').classList.toggle('sidebar-collapsed');
    });
  }

  // Sidebar nav search
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
  document.querySelectorAll('.ur-em__section, .ur-em__analytics-card, .ur-em__analytics-chart-card, .ur-em__performer-card').forEach(function(el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
    el.style.transitionDelay = (i * 0.06) + 's';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });

  // NEW TEMPLATE spin
  var tplBtn = document.getElementById('createTemplateBtn');
  if (tplBtn) {
    tplBtn.addEventListener('click', function() {
      var icon = this.querySelector('.ur-em__tpl-plus');
      icon.classList.add('is-spinning');
      setTimeout(function() { icon.classList.remove('is-spinning'); }, 600);
    });
    tplBtn.addEventListener('mouseenter', function() {
      this.querySelector('.ur-em__tpl-plus').style.transform = 'rotate(90deg)';
    });
    tplBtn.addEventListener('mouseleave', function() {
      this.querySelector('.ur-em__tpl-plus').style.transform = '';
    });
  }

  // Publish button glitch
  var publishBtn = document.getElementById('publishBtn');
  if (publishBtn) {
    publishBtn.addEventListener('mouseenter', function() {
      this.classList.add('is-glitch');
      var self = this;
      setTimeout(function() { self.classList.remove('is-glitch'); }, 300);
    });
  }
});
</script>
@endsection

@section('custom-style')
<style>
.footer-section { display: none !important; }

/* ══════════════════════════════════════
   DASHBOARD SHELL (shared sidebar/topbar)
   ══════════════════════════════════════ */
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
  transition: padding 0.3s cubic-bezier(0.25, 1, 0.5, 1), justify-content 0.3s;
}
.ur-dash__sidebar-brand a { text-decoration: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-brand { display: none; }
.ur-dash__sidebar.is-collapsed .ur-dash__sidebar-top {
  justify-content: center;
  padding: 16px 0 12px;
}

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

/* Nav items */
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
  overflow: hidden;
  white-space: nowrap;
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

/* MAIN */
.ur-dash__main {
  flex: 1;
  padding: 28px 32px;
  min-width: 0;
  overflow-x: hidden;
  overflow: visible !important;
}

/* TOPBAR */
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

/* SIDEBAR RESPONSIVE */
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
}

/* ══════════════════════════════════════
   BRUTALIST HEADING
   ══════════════════════════════════════ */
.ur-em__heading {
  display: flex;
  flex-direction: column;
  position: relative;
}
.ur-em__heading-outline {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 6px;
  color: rgba(255,255,255,0.3);
  line-height: 1;
  animation: ur-heading-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) both;
}
.ur-em__heading-solid {
  font-family: var(--font-display);
  font-size: 42px;
  letter-spacing: 4px;
  color: var(--white);
  line-height: 1;
  margin-top: 4px;
  animation: ur-heading-slide 0.6s cubic-bezier(0.25, 1, 0.5, 1) 0.1s both;
}
.ur-em__heading-line {
  width: 60px;
  height: 2px;
  background: var(--white);
  margin-top: 10px;
  animation: ur-line-grow 0.8s cubic-bezier(0.25, 1, 0.5, 1) 0.3s both;
  transform-origin: left;
}
@keyframes ur-heading-slide {
  from { opacity: 0; transform: translateY(12px); }
  to { opacity: 1; transform: translateY(0); }
}
@keyframes ur-line-grow {
  from { transform: scaleX(0); opacity: 0; }
  to { transform: scaleX(1); opacity: 1; }
}

/* BRUTALIST SECTION SCANLINE OVERLAY */
.ur-em__section::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(
    0deg,
    transparent,
    transparent 3px,
    rgba(255,255,255,0.008) 3px,
    rgba(255,255,255,0.008) 4px
  );
  pointer-events: none;
  z-index: 0;
}
.ur-em__section > * { position: relative; z-index: 1; }

/* BRUTALIST TAB HOVER GLITCH */
.ur-em__tab:hover {
  animation: ur-tab-glitch 0.2s steps(2);
}
@keyframes ur-tab-glitch {
  0% { transform: translate(0); }
  25% { transform: translate(-1px, 1px); }
  50% { transform: translate(1px, -1px); }
  75% { transform: translate(-1px, 0); }
  100% { transform: translate(0); }
}


/* TABLE ROW HOVER SHIFT */
.ur-em__table tr {
  transition: transform 0.1s;
}
.ur-em__table tbody tr:hover {
  transform: translateX(4px);
}

/* TEMPLATE CARD GLITCH ON HOVER */
.ur-em__tpl-card:hover .ur-em__tpl-card-body h3 {
  animation: ur-text-glitch 0.3s steps(3);
}
@keyframes ur-text-glitch {
  0% { transform: translate(0); }
  20% { transform: translate(2px, -1px); clip-path: inset(20% 0 40% 0); }
  40% { transform: translate(-2px, 1px); clip-path: inset(60% 0 10% 0); }
  60% { transform: translate(1px, -2px); clip-path: inset(10% 0 70% 0); }
  80% { transform: translate(-1px, 0); clip-path: none; }
  100% { transform: translate(0); clip-path: none; }
}

/* ══════════════════════════════════════
   EVENT MANAGEMENT - TAB BAR
   ══════════════════════════════════════ */
.ur-em__tabs {
  display: flex;
  gap: 0;
  border-bottom: 2px solid rgba(255,255,255,0.1);
  margin-bottom: 28px;
  position: relative;
}
.ur-em__tab {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.35);
  background: none;
  border: none;
  padding: 14px 28px;
  cursor: pointer;
  transition: color 0.2s;
  position: relative;
  z-index: 1;
}
.ur-em__tab i { margin-right: 8px; font-size: 14px; }
.ur-em__tab:hover { color: rgba(255,255,255,0.7); }
.ur-em__tab.active { color: var(--white); }
.ur-em__tab-indicator {
  position: absolute;
  bottom: -2px;
  height: 2px;
  background: var(--white);
  transition: left 0.35s cubic-bezier(0.25, 1, 0.5, 1), width 0.35s cubic-bezier(0.25, 1, 0.5, 1);
}

/* PANELS */
.ur-em__panel { display: none; }
.ur-em__panel.active { display: block; }

/* ══════════════════════════════════════
   CREATE TAB - TYPE TOGGLE
   ══════════════════════════════════════ */
.ur-em__type-toggle {
  display: inline-flex;
  position: relative;
  border: 2px solid rgba(255,255,255,0.15);
  margin-bottom: 28px;
}
.ur-em__type-btn {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  padding: 12px 32px;
  background: none;
  border: none;
  color: rgba(255,255,255,0.4);
  cursor: pointer;
  position: relative;
  z-index: 1;
  transition: color 0.25s;
}
.ur-em__type-btn i { margin-right: 8px; }
.ur-em__type-btn.active { color: var(--bg-black); }
.ur-em__type-slider {
  position: absolute;
  top: 0; left: 0;
  height: 100%;
  background: var(--white);
  transition: left 0.35s cubic-bezier(0.25, 1, 0.5, 1), width 0.35s cubic-bezier(0.25, 1, 0.5, 1);
  z-index: 0;
}

/* CREATE TOOLBAR */
.ur-em__create-toolbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 28px;
  gap: 16px;
  flex-wrap: wrap;
}

/* DRAFTS & TEMPLATES VAULT */
.ur-em__vault { position: relative; }
.ur-em__vault-btn {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 2px;
  padding: 12px 20px;
  background: none;
  border: 2px solid rgba(255,255,255,0.12);
  color: rgba(255,255,255,0.5);
  cursor: pointer;
  transition: all 0.15s;
  display: flex;
  align-items: center;
  gap: 10px;
}
.ur-em__vault-btn:hover {
  border-color: var(--white);
  color: var(--white);
}
.ur-em__vault-arrow {
  font-size: 10px;
  transition: transform 0.2s;
}
.ur-em__vault.is-open .ur-em__vault-arrow { transform: rotate(180deg); }
.ur-em__vault.is-open .ur-em__vault-btn {
  border-color: var(--white);
  color: var(--white);
}
.ur-em__vault-dropdown {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  width: 320px;
  background: var(--bg-black);
  border: 2px solid var(--white);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.1);
  z-index: 90;
  opacity: 0;
  transform: translateY(-8px) scale(0.97);
  pointer-events: none;
  transition: all 0.2s cubic-bezier(0.25, 1, 0.5, 1);
  max-height: 420px;
  overflow-y: auto;
}
.ur-em__vault.is-open .ur-em__vault-dropdown {
  opacity: 1;
  transform: translateY(0) scale(1);
  pointer-events: all;
}
.ur-em__vault-section { padding: 8px 0; }
.ur-em__vault-heading {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.25);
  padding: 8px 16px 6px;
}
.ur-em__vault-heading i { margin-right: 6px; }
.ur-em__vault-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 16px;
  transition: all 0.1s;
  border-left: 3px solid transparent;
  cursor: pointer;
}
.ur-em__vault-item:hover {
  background: rgba(255,255,255,0.04);
  border-left-color: var(--white);
}
.ur-em__vault-name {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.7);
  flex: 1;
}
.ur-em__vault-item:hover .ur-em__vault-name { color: var(--white); }
.ur-em__vault-meta {
  font-family: var(--font-display);
  font-size: 9px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.2);
}
.ur-em__vault-item--empty .ur-em__vault-name { color: rgba(255,255,255,0.35); font-style: italic; }
.ur-em__vault-tpl-icon {
  width: 16px;
  text-align: center;
  font-size: 12px;
  color: rgba(255,255,255,0.25);
}
.ur-em__vault-item:hover .ur-em__vault-tpl-icon { color: var(--white); }
.ur-em__vault-divider {
  height: 1px;
  background: rgba(255,255,255,0.08);
  margin: 4px 0;
}

/* ══════════════════════════════════════
   CREATE TAB - FORM SECTIONS
   ══════════════════════════════════════ */
.ur-em__section {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 28px;
  margin-bottom: 20px;
  position: relative;
  transition: border-color 0.2s;
}
.ur-em__section:hover {
  border-color: rgba(255,255,255,0.2);
}
.ur-em__section-header {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.ur-em__section-num {
  font-family: var(--font-display);
  font-size: 56px;
  color: transparent;
  line-height: 1;
  letter-spacing: 2px;
  -webkit-text-stroke: 2px rgba(255,255,255,0.25);
  position: relative;
}
.ur-em__section:hover .ur-em__section-num {
  -webkit-text-stroke-color: var(--white);
  transition: -webkit-text-stroke-color 0.2s;
}
.ur-em__section-header h3 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 3px;
  color: var(--white);
}

/* ROWS & FIELDS */
.ur-em__row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
  margin-bottom: 16px;
}
.ur-em__row:last-child { margin-bottom: 0; }
.ur-em__field--full { grid-column: 1 / -1; }

.ur-em__field label {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2.5px;
  color: rgba(255,255,255,0.4);
  display: block;
  margin-bottom: 8px;
}

/* INPUTS */
.ur-em__input {
  width: 100%;
  background: rgba(255,255,255,0.04);
  border: 2px solid rgba(255,255,255,0.1);
  color: var(--white);
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 1.5px;
  padding: 12px 14px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.ur-em__input::placeholder { color: rgba(255,255,255,0.15); }
.ur-em__input:focus {
  border-color: var(--white);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
select.ur-em__input { cursor: pointer; -webkit-appearance: none; appearance: none; }
.ur-em__textarea { font-family: var(--font-body); letter-spacing: 0.5px; resize: vertical; min-height: 80px; }

/* TOGGLE GROUP */
.ur-em__toggle-group {
  display: inline-flex;
  border: 2px solid rgba(255,255,255,0.1);
}
.ur-em__toggle {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  padding: 10px 20px;
  background: none;
  border: none;
  color: rgba(255,255,255,0.3);
  cursor: pointer;
  transition: all 0.2s;
}
.ur-em__toggle.active {
  background: var(--white);
  color: var(--bg-black);
}

/* DROPZONE */
.ur-em__dropzone {
  border: 2px dashed rgba(255,255,255,0.15);
  padding: 40px;
  text-align: center;
  cursor: pointer;
  transition: all 0.25s;
}
.ur-em__dropzone:hover,
.ur-em__dropzone.is-drag {
  border-color: var(--white);
  background: rgba(255,255,255,0.04);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.08);
}
.ur-em__dropzone i {
  font-size: 32px;
  color: rgba(255,255,255,0.2);
  display: block;
  margin-bottom: 10px;
}
.ur-em__dropzone p {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.5);
  margin-bottom: 4px;
}
.ur-em__dropzone span {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.2);
}
.ur-em__dropzone--sm { padding: 24px; }
.ur-em__file-input { display: none; }

/* PRICE WRAP */
.ur-em__price-wrap {
  display: flex;
  align-items: stretch;
  gap: 0;
}
.ur-em__price-wrap .ur-em__input {
  flex: 1;
  border-right: none;
}
.ur-em__free-toggle {
  padding: 0 18px !important;
  margin: 0 !important;
  border: 2px solid rgba(255,255,255,0.1);
  display: flex !important;
  align-items: center;
  gap: 8px !important;
  white-space: nowrap;
  transition: all 0.2s;
}
.ur-em__free-toggle:hover { border-color: rgba(255,255,255,0.3); }
.ur-em__row--price { grid-template-columns: minmax(200px, 400px); }

/* CHECKBOX */
.ur-em__checkbox-label {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.5);
  cursor: pointer;
  padding-bottom: 0;
}
.ur-em__checkbox-label input { display: none; }
.ur-em__check-box {
  width: 22px; height: 22px;
  border: 2px solid rgba(255,255,255,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.15s;
  flex-shrink: 0;
}
.ur-em__checkbox-label input:checked + .ur-em__check-box {
  background: var(--white);
  border-color: var(--white);
}
.ur-em__checkbox-label input:checked + .ur-em__check-box::after {
  content: '\f00c';
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  font-size: 12px;
  color: var(--bg-black);
}

/* BADGE */
.ur-em__badge {
  font-size: 9px;
  letter-spacing: 2px;
  padding: 2px 8px;
  background: rgba(255,255,255,0.1);
  color: rgba(255,255,255,0.5);
  margin-left: 8px;
  vertical-align: middle;
}

/* SUBMIT ROW */
.ur-em__submit-row {
  display: flex;
  gap: 16px;
  justify-content: flex-end;
  margin-top: 8px;
}
.ur-em__btn {
  font-family: var(--font-display);
  font-size: 15px;
  letter-spacing: 3px;
  padding: 14px 32px;
  cursor: pointer;
  border: 2px solid;
  transition: all 0.15s;
}
.ur-em__btn i { margin-right: 8px; }
.ur-em__btn--primary {
  background: var(--white);
  color: var(--bg-black);
  border-color: var(--white);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.15);
}
.ur-em__btn--primary:hover {
  transform: translate(-2px, -2px);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.2);
}
.ur-em__btn--primary.is-glitch {
  animation: ur-glitch-flash 0.3s;
}
.ur-em__btn--ghost {
  background: none;
  color: rgba(255,255,255,0.5);
  border-color: rgba(255,255,255,0.15);
}
.ur-em__btn--ghost:hover {
  color: var(--white);
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}

@keyframes ur-glitch-flash {
  0%, 100% { opacity: 1; transform: translate(-2px, -2px); }
  20% { opacity: 0.8; transform: translate(2px, -1px); }
  40% { opacity: 1; transform: translate(-1px, 2px); }
  60% { opacity: 0.9; transform: translate(1px, -2px); }
  80% { opacity: 1; transform: translate(-2px, 1px); }
}

/* ══════════════════════════════════════
   ALL EVENTS TAB
   ══════════════════════════════════════ */
.ur-em__toolbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  gap: 16px;
  flex-wrap: wrap;
}
.ur-em__toolbar-left { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; }
.ur-em__search-box {
  display: flex;
  align-items: center;
  gap: 10px;
  border: 2px solid rgba(255,255,255,0.1);
  padding: 0 14px;
  transition: border-color 0.2s;
}
.ur-em__search-box:focus-within { border-color: var(--white); }
.ur-em__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-em__search-input {
  background: none;
  border: none;
  outline: none;
  color: var(--white);
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 2px;
  padding: 10px 0;
  width: 200px;
}
.ur-em__search-input::placeholder { color: rgba(255,255,255,0.2); }

.ur-em__filter-select {
  background: rgba(255,255,255,0.04);
  border: 2px solid rgba(255,255,255,0.1);
  color: var(--white);
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  padding: 10px 14px;
  outline: none;
  cursor: pointer;
  -webkit-appearance: none;
  appearance: none;
}
.ur-em__filter-select:focus { border-color: var(--white); }

.ur-em__event-count {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
}

/* TABLE */
.ur-em__table-wrap {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  overflow-x: auto;
}
.ur-em__table {
  width: 100%;
  border-collapse: collapse;
}
.ur-em__table th {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2.5px;
  color: rgba(255,255,255,0.3);
  text-align: left;
  padding: 14px 16px;
  border-bottom: 2px solid rgba(255,255,255,0.08);
  white-space: nowrap;
}
.ur-em__table td {
  font-family: var(--font-body);
  font-size: 14px;
  color: rgba(255,255,255,0.7);
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,0.04);
  white-space: nowrap;
}
.ur-em__table tr:hover td { background: rgba(255,255,255,0.03); }

.ur-em__event-cell { display: flex; align-items: center; gap: 12px; }
.ur-em__event-thumb {
  width: 40px; height: 40px;
  background: rgba(255,255,255,0.08);
  border: 2px solid rgba(255,255,255,0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 1px;
  color: var(--white);
  flex-shrink: 0;
}
.ur-em__event-title {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 1px;
  color: var(--white);
  display: block;
}
.ur-em__event-cat {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
}

.ur-em__type-badge {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  padding: 4px 10px;
  border: 2px solid;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.ur-em__type-badge i { font-size: 9px; }
.ur-em__type-badge--venue { border-color: rgba(255,255,255,0.25); color: rgba(255,255,255,0.6); }
.ur-em__type-badge--online { border-color: rgba(100,200,255,0.4); color: rgba(100,200,255,0.7); }

.ur-em__date-cell {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 1.5px;
  color: rgba(255,255,255,0.5) !important;
}

.ur-em__tickets-cell span {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 1px;
  display: block;
}
.ur-em__mini-bar {
  height: 3px;
  background: rgba(255,255,255,0.08);
  margin-top: 4px;
  width: 80px;
}
.ur-em__mini-fill {
  height: 100%;
  background: var(--white);
  transition: width 0.6s ease;
}

.ur-em__revenue-cell {
  font-family: var(--font-display) !important;
  font-size: 16px !important;
  letter-spacing: 1px;
  color: var(--white) !important;
}

.ur-em__status {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  padding: 3px 10px;
  border: 2px solid;
}
.ur-em__status--active { border-color: #22c55e; color: #22c55e; }
.ur-em__status--draft { border-color: #f59e0b; color: #f59e0b; }
.ur-em__status--inactive { border-color: rgba(255,255,255,0.2); color: rgba(255,255,255,0.3); }
.ur-em__status--ended { border-color: #ef4444; color: #ef4444; }

.ur-em__actions { display: flex; gap: 8px; }
.ur-em__action-icon {
  width: 32px; height: 32px;
  background: none;
  border: 2px solid rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.15s;
  font-size: 12px;
}
.ur-em__action-icon:hover {
  border-color: var(--white);
  color: var(--white);
  transform: translate(-1px, -1px);
  box-shadow: 2px 2px 0 rgba(255,255,255,0.1);
}
.ur-em__action-icon--danger:hover {
  border-color: #ef4444;
  color: #ef4444;
  box-shadow: 2px 2px 0 rgba(239,68,68,0.2);
}

/* ══════════════════════════════════════
   ANALYTICS TAB
   ══════════════════════════════════════ */
.ur-em__analytics-stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}
.ur-em__analytics-card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 24px;
  text-align: center;
  transition: all 0.15s;
}
.ur-em__analytics-card:hover {
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
.ur-em__analytics-icon {
  font-size: 24px;
  color: rgba(255,255,255,0.2);
  margin-bottom: 12px;
}
.ur-em__analytics-num {
  font-family: var(--font-display);
  font-size: 36px;
  color: var(--white);
  letter-spacing: 1px;
  line-height: 1;
  margin-bottom: 6px;
}
.ur-em__analytics-label {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2.5px;
  color: rgba(255,255,255,0.3);
}

.ur-em__analytics-charts {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 24px;
}
.ur-em__analytics-chart-card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 20px;
  min-width: 0;
  overflow: hidden;
}
.ur-em__analytics-chart-head {
  margin-bottom: 16px;
}
.ur-em__analytics-chart-head h3 {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 2px;
  color: var(--white);
}
.ur-em__analytics-chart-wrap {
  position: relative;
  height: 240px;
  width: 100%;
}

/* TOP PERFORMERS */
.ur-em__top-performers h3 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 3px;
  color: var(--white);
  margin-bottom: 16px;
}
.ur-em__performers-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
.ur-em__performer-card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 24px;
  transition: all 0.15s;
  position: relative;
}
.ur-em__performer-card:hover {
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
.ur-em__performer-rank {
  font-family: var(--font-display);
  font-size: 48px;
  color: rgba(255,255,255,0.06);
  position: absolute;
  top: 10px;
  right: 16px;
  line-height: 1;
}
.ur-em__performer-card h4 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 1px;
  color: var(--white);
  margin-bottom: 16px;
}
.ur-em__performer-stats {
  display: flex;
  gap: 20px;
  margin-bottom: 14px;
}
.ur-em__performer-val {
  font-family: var(--font-display);
  font-size: 20px;
  color: var(--white);
  display: block;
  line-height: 1;
}
.ur-em__performer-lbl {
  font-family: var(--font-display);
  font-size: 9px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.3);
  display: block;
  margin-top: 3px;
}
.ur-em__performer-bar {
  height: 4px;
  background: rgba(255,255,255,0.08);
}
.ur-em__performer-fill {
  height: 100%;
  background: var(--white);
  transition: width 1s ease;
}

/* ══════════════════════════════════════
   TEMPLATES TAB
   ══════════════════════════════════════ */
.ur-em__tpl-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 28px;
  gap: 16px;
}
.ur-em__tpl-title {
  font-family: var(--font-display);
  font-size: 28px;
  letter-spacing: 3px;
  color: var(--white);
}
.ur-em__tpl-sub {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.25);
  margin-top: 4px;
}
.ur-em__tpl-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
.ur-em__tpl-card {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  display: flex;
  flex-direction: column;
  transition: all 0.15s;
}
.ur-em__tpl-card:hover {
  border-color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.1);
}
.ur-em__tpl-card-icon {
  padding: 24px 24px 0;
  font-size: 28px;
  color: rgba(255,255,255,0.15);
  transition: color 0.2s;
}
.ur-em__tpl-card:hover .ur-em__tpl-card-icon { color: var(--white); }
.ur-em__tpl-card-body {
  padding: 16px 24px 20px;
  flex: 1;
}
.ur-em__tpl-card-body h3 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 2px;
  color: var(--white);
  margin-bottom: 8px;
}
.ur-em__tpl-card-body p {
  font-family: var(--font-body);
  font-size: 13px;
  color: rgba(255,255,255,0.4);
  line-height: 1.5;
  margin-bottom: 12px;
}
.ur-em__tpl-card-tags {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
}
.ur-em__tpl-card-tags span {
  font-family: var(--font-display);
  font-size: 9px;
  letter-spacing: 2px;
  padding: 3px 8px;
  border: 1px solid rgba(255,255,255,0.12);
  color: rgba(255,255,255,0.35);
}
.ur-em__tpl-card-footer {
  padding: 14px 24px;
  border-top: 1px solid rgba(255,255,255,0.06);
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.ur-em__tpl-card-meta {
  font-family: var(--font-display);
  font-size: 10px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.2);
}
.ur-em__tpl-card-meta i { margin-right: 4px; }
.ur-em__tpl-use-btn {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 2px;
  padding: 6px 16px;
  background: var(--white);
  color: var(--bg-black);
  border: none;
  cursor: pointer;
  transition: all 0.15s;
}
.ur-em__tpl-use-btn:hover {
  transform: translate(-1px, -1px);
  box-shadow: 3px 3px 0 rgba(255,255,255,0.2);
}
.ur-em__tpl-use-btn i { margin-left: 6px; font-size: 10px; }

/* NEW TEMPLATE BUTTON SPIN */
.ur-em__tpl-plus {
  display: inline-block;
  transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ur-em__tpl-plus.is-spinning {
  transform: rotate(360deg) scale(1.3) !important;
}

/* REMOVED: CREATE NEW TEMPLATE CARD - button handles this now */
/* legacy cleanup */
.ur-em__tpl-card--new {
  border-style: dashed;
  border-color: rgba(255,255,255,0.12);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 24px;
  text-align: center;
  cursor: pointer;
  min-height: 220px;
}
.ur-em__tpl-card--new i {
  font-size: 36px;
  color: rgba(255,255,255,0.12);
  margin-bottom: 14px;
  transition: color 0.2s;
}
.ur-em__tpl-card--new:hover i { color: var(--white); }
.ur-em__tpl-card--new h3 {
  font-family: var(--font-display);
  font-size: 16px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.35);
  margin-bottom: 6px;
  transition: color 0.2s;
}
.ur-em__tpl-card--new:hover h3 { color: var(--white); }
.ur-em__tpl-card--new p {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.15);
}

/* ══════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════ */
@media (max-width: 1200px) {
  .ur-em__analytics-stats { grid-template-columns: repeat(2, 1fr); }
  .ur-em__analytics-charts { grid-template-columns: 1fr; }
  .ur-em__performers-grid { grid-template-columns: 1fr; }
  .ur-em__tpl-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 900px) {
  .ur-em__tabs { overflow-x: auto; }
  .ur-em__tab { font-size: 13px; padding: 12px 18px; white-space: nowrap; }
  .ur-em__type-toggle { flex-direction: column; }
  .ur-em__analytics-stats { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
  .ur-em__analytics-stats { grid-template-columns: 1fr; }
  .ur-em__row { grid-template-columns: 1fr; }
}
</style>
@endsection

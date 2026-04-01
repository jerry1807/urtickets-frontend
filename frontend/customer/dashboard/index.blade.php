@extends('frontend.layout')
@section('pageHeading')
  {{ __('My Account') }}
@endsection

@section('hero-section')
<section class="ur-cust__hero">
  <div class="ur-cust__hero-inner">
    <h1 class="ur-cust__hero-title">
      <span class="ur-cust__hero-outline">MY</span>
      <span class="ur-cust__hero-solid">ACCOUNT</span>
    </h1>
    <p class="ur-cust__hero-sub">MANAGE YOUR BOOKINGS, ORDERS & PROFILE</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-cust">

  {{-- TABS --}}
  <div class="ur-cust__tabs">
    <button class="ur-cust__tab active" data-tab="overview"><i class="fas fa-th-large"></i> OVERVIEW</button>
    <button class="ur-cust__tab" data-tab="bookings"><i class="fas fa-ticket-alt"></i> BOOKINGS</button>
    <button class="ur-cust__tab" data-tab="orders"><i class="fas fa-shopping-bag"></i> ORDERS</button>
    <button class="ur-cust__tab" data-tab="wishlist"><i class="fas fa-bookmark"></i> WISHLIST</button>
    <button class="ur-cust__tab" data-tab="support"><i class="fas fa-life-ring"></i> SUPPORT</button>
    <button class="ur-cust__tab" data-tab="settings"><i class="fas fa-cog"></i> SETTINGS</button>
    <div class="ur-cust__tab-indicator"></div>
  </div>

  {{-- ═══════════════════ OVERVIEW ═══════════════════ --}}
  <div class="ur-cust__panel active" id="panel-overview">
    <div class="ur-cust__overview-layout">
      {{-- PROFILE CARD --}}
      <div class="ur-cust__profile-card">
        <div class="ur-cust__profile-avatar">{{ strtoupper(substr($customerData->first_name, 0, 1)) }}{{ strtoupper(substr($customerData->last_name, 0, 1)) }}</div>
        <h3 class="ur-cust__profile-name">{{ $customerData->first_name }} {{ $customerData->last_name }}</h3>
        <span class="ur-cust__profile-username">{{ '@' . $customerData->username }}</span>
        <div class="ur-cust__profile-meta">
          <span><i class="fas fa-envelope"></i> {{ $customerData->email }}</span>
          <span><i class="fas fa-calendar-alt"></i> MEMBER SINCE {{ strtoupper($customerData->joined) }}</span>
        </div>
      </div>

      {{-- QUICK STATS --}}
      <div class="ur-cust__stats">
        <div class="ur-cust__stat-card">
          <span class="ur-cust__stat-val">{{ $customerData->total_bookings }}</span>
          <span class="ur-cust__stat-lbl">BOOKINGS</span>
        </div>
        <div class="ur-cust__stat-card">
          <span class="ur-cust__stat-val">{{ $customerData->total_orders }}</span>
          <span class="ur-cust__stat-lbl">ORDERS</span>
        </div>
        <div class="ur-cust__stat-card">
          <span class="ur-cust__stat-val">{{ $customerData->wishlist_count }}</span>
          <span class="ur-cust__stat-lbl">WISHLIST</span>
        </div>
        <div class="ur-cust__stat-card">
          <span class="ur-cust__stat-val">{{ $customerData->tickets_count }}</span>
          <span class="ur-cust__stat-lbl">TICKETS</span>
        </div>
      </div>
    </div>

    {{-- RECENT BOOKINGS --}}
    <div class="ur-cust__section">
      <div class="ur-cust__section-header">
        <span class="ur-cust__section-num">01</span>
        <h3>RECENT BOOKINGS</h3>
      </div>
      <div class="ur-cust__table-wrap">
        <table class="ur-cust__table">
          <thead><tr><th>EVENT</th><th>ORGANIZER</th><th>DATE</th><th>BOOKED</th><th>STATUS</th></tr></thead>
          <tbody>
            @foreach($customerBookings as $b)
            <tr>
              <td class="ur-cust__cell-title">{{ $b->event }}</td>
              <td>{{ $b->organizer }}</td>
              <td class="ur-cust__cell-date">{{ $b->event_date }}</td>
              <td class="ur-cust__cell-date">{{ $b->booking_date }}</td>
              <td><span class="ur-cust__status ur-cust__status--{{ $b->status }}">{{ strtoupper($b->status) }}</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- ═══════════════════ BOOKINGS ═══════════════════ --}}
  <div class="ur-cust__panel" id="panel-bookings">
    <div class="ur-cust__toolbar">
      <div class="ur-cust__search-box"><i class="fas fa-search"></i><input type="text" id="bkSearch" placeholder="SEARCH BOOKINGS..." class="ur-cust__search-input"></div>
    </div>
    <div class="ur-cust__table-wrap">
      <table class="ur-cust__table">
        <thead><tr><th>EVENT</th><th>BOOKING ID</th><th>EVENT DATE</th><th>BOOKING DATE</th><th>QTY</th><th>AMOUNT</th><th>ACTION</th></tr></thead>
        <tbody id="bkBody">
          @foreach($customerBookings as $b)
          <tr data-search="{{ strtolower($b->event . ' ' . $b->booking_id) }}">
            <td class="ur-cust__cell-title">{{ $b->event }}</td>
            <td class="ur-cust__cell-id">#{{ $b->booking_id }}</td>
            <td class="ur-cust__cell-date">{{ $b->event_date }}</td>
            <td class="ur-cust__cell-date">{{ $b->booking_date }}</td>
            <td>{{ $b->qty }}</td>
            <td class="ur-cust__cell-amount">${{ number_format($b->amount, 2) }}</td>
            <td><button class="ur-cust__action-icon" title="Details"><i class="fas fa-eye"></i></button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- ═══════════════════ ORDERS ═══════════════════ --}}
  <div class="ur-cust__panel" id="panel-orders">
    <div class="ur-cust__table-wrap">
      <table class="ur-cust__table">
        <thead><tr><th>ORDER</th><th>PRODUCT</th><th>QTY</th><th>TOTAL</th><th>DATE</th><th>STATUS</th></tr></thead>
        <tbody>
          @foreach($customerOrders as $o)
          <tr>
            <td class="ur-cust__cell-id">#{{ $o->order_id }}</td>
            <td class="ur-cust__cell-title">{{ $o->product }}</td>
            <td>{{ $o->qty }}</td>
            <td class="ur-cust__cell-amount">${{ number_format($o->total, 2) }}</td>
            <td class="ur-cust__cell-date">{{ $o->date }}</td>
            <td><span class="ur-cust__status ur-cust__status--{{ $o->status }}">{{ strtoupper($o->status) }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- ═══════════════════ WISHLIST ═══════════════════ --}}
  <div class="ur-cust__panel" id="panel-wishlist">
    <div class="ur-cust__wishlist-grid">
      @foreach($customerWishlist as $w)
      <div class="ur-cust__wish-card">
        <div class="ur-cust__wish-img">
          <div class="ur-cust__wish-date"><span>{{ $w->day }}</span><small>{{ $w->month }}</small></div>
        </div>
        <div class="ur-cust__wish-body">
          <h4>{{ $w->title }}</h4>
          <span class="ur-cust__wish-meta"><i class="fas fa-map-marker-alt"></i> {{ $w->location }}</span>
          <div class="ur-cust__wish-footer">
            <span class="ur-cust__wish-price">{{ $w->price > 0 ? '$' . number_format($w->price) : 'FREE' }}</span>
            <button class="ur-cust__wish-remove" title="Remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- ═══════════════════ SUPPORT ═══════════════════ --}}
  <div class="ur-cust__panel" id="panel-support">
    <div class="ur-cust__support-layout">
      <div class="ur-cust__section">
        <div class="ur-cust__section-header">
          <span class="ur-cust__section-num">01</span>
          <h3>NEW TICKET</h3>
        </div>
        <form class="ur-cust__form">
          <div class="ur-cust__field"><label>SUBJECT *</label><input type="text" class="ur-cust__input" placeholder="WHAT DO YOU NEED HELP WITH?"></div>
          <div class="ur-cust__field"><label>MESSAGE *</label><textarea class="ur-cust__input ur-cust__textarea" rows="5" placeholder="DESCRIBE YOUR ISSUE..."></textarea></div>
          <button type="submit" class="ur-cust__btn">
            <i class="fas fa-paper-plane"></i> SUBMIT TICKET
          </button>
        </form>
      </div>
      <div class="ur-cust__section">
        <div class="ur-cust__section-header">
          <span class="ur-cust__section-num">02</span>
          <h3>MY TICKETS</h3>
        </div>
        <div class="ur-cust__ticket-list">
          @foreach($customerTickets as $t)
          <div class="ur-cust__ticket-row">
            <span class="ur-cust__ticket-id">#{{ $t->ticket_id }}</span>
            <span class="ur-cust__ticket-subject">{{ $t->subject }}</span>
            <span class="ur-cust__status ur-cust__status--{{ $t->status }}">{{ strtoupper($t->status) }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════════ SETTINGS ═══════════════════ --}}
  <div class="ur-cust__panel" id="panel-settings">
    <div class="ur-cust__settings-layout">
      <div class="ur-cust__section">
        <div class="ur-cust__section-header">
          <span class="ur-cust__section-num">01</span>
          <h3>EDIT PROFILE</h3>
        </div>
        <form class="ur-cust__form">
          <div class="ur-cust__form-row">
            <div class="ur-cust__field"><label>FIRST NAME</label><input type="text" class="ur-cust__input" value="{{ $customerData->first_name }}"></div>
            <div class="ur-cust__field"><label>LAST NAME</label><input type="text" class="ur-cust__input" value="{{ $customerData->last_name }}"></div>
          </div>
          <div class="ur-cust__field"><label>EMAIL</label><input type="email" class="ur-cust__input" value="{{ $customerData->email }}"></div>
          <div class="ur-cust__field"><label>USERNAME</label><input type="text" class="ur-cust__input" value="{{ $customerData->username }}"></div>
          <button type="submit" class="ur-cust__btn"><i class="fas fa-save"></i> SAVE CHANGES</button>
        </form>
      </div>
      <div class="ur-cust__section">
        <div class="ur-cust__section-header">
          <span class="ur-cust__section-num">02</span>
          <h3>CHANGE PASSWORD</h3>
        </div>
        <form class="ur-cust__form">
          <div class="ur-cust__field"><label>CURRENT PASSWORD</label><input type="password" class="ur-cust__input" placeholder="ENTER CURRENT PASSWORD"></div>
          <div class="ur-cust__form-row">
            <div class="ur-cust__field"><label>NEW PASSWORD</label><input type="password" class="ur-cust__input" placeholder="ENTER NEW PASSWORD"></div>
            <div class="ur-cust__field"><label>CONFIRM PASSWORD</label><input type="password" class="ur-cust__input" placeholder="CONFIRM NEW PASSWORD"></div>
          </div>
          <button type="submit" class="ur-cust__btn ur-cust__btn--ghost"><i class="fas fa-lock"></i> UPDATE PASSWORD</button>
        </form>
      </div>
    </div>
    <div class="ur-cust__danger-zone">
      <h4><i class="fas fa-exclamation-triangle"></i> DANGER ZONE</h4>
      <p>PERMANENTLY DELETE YOUR ACCOUNT AND ALL ASSOCIATED DATA.</p>
      <button class="ur-cust__btn ur-cust__btn--danger"><i class="fas fa-trash"></i> DELETE ACCOUNT</button>
    </div>
  </div>

</section>
@endsection

@section('custom-style')
<style>
/* HERO */
.ur-cust__hero { background: var(--bg-black); border-bottom: 2px solid rgba(255,255,255,0.1); padding: 80px 40px 60px; text-align: center; }
.ur-cust__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-cust__hero-outline { font-family: var(--font-display); font-size: 24px; letter-spacing: 10px; color: rgba(255,255,255,0.3); display: block; line-height: 1; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both; }
.ur-cust__hero-solid { font-family: var(--font-display); font-size: 72px; letter-spacing: 12px; color: var(--white); display: block; line-height: 1; margin-top: 4px; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both; }
.ur-cust__hero-sub { font-family: var(--font-display); font-size: 14px; letter-spacing: 6px; color: rgba(255,255,255,0.3); margin-top: 16px; }

.ur-cust { max-width: 1200px; margin: 0 auto; padding: 0 40px 80px; }

/* TABS */
.ur-cust__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin: 32px 0; position: relative; }
.ur-cust__tab { font-family: var(--font-display); font-size: 15px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 24px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-cust__tab i { margin-right: 8px; font-size: 13px; }
.ur-cust__tab:hover { color: rgba(255,255,255,0.7); }
.ur-cust__tab.active { color: var(--white); }
.ur-cust__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25,1,0.5,1), width 0.35s cubic-bezier(0.25,1,0.5,1); }
.ur-cust__panel { display: none; }
.ur-cust__panel.active { display: block; }

/* OVERVIEW */
.ur-cust__overview-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px; }

/* PROFILE CARD */
.ur-cust__profile-card { border: 2px solid var(--white); padding: 32px; text-align: center; }
.ur-cust__profile-avatar { width: 72px; height: 72px; border: 3px solid var(--white); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-size: 28px; color: var(--white); letter-spacing: 2px; }
.ur-cust__profile-name { font-family: var(--font-display); font-size: 24px; letter-spacing: 2px; color: var(--white); }
.ur-cust__profile-username { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; color: rgba(255,255,255,0.3); display: block; margin-bottom: 16px; }
.ur-cust__profile-meta { display: flex; flex-direction: column; gap: 6px; }
.ur-cust__profile-meta span { font-family: var(--font-display); font-size: 11px; letter-spacing: 2px; color: rgba(255,255,255,0.35); }
.ur-cust__profile-meta i { margin-right: 6px; font-size: 10px; }

/* STATS */
.ur-cust__stats { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.ur-cust__stat-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 24px; text-align: center; transition: all 0.15s; }
.ur-cust__stat-card:hover { border-color: var(--white); transform: translate(-2px,-2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-cust__stat-val { font-family: var(--font-display); font-size: 36px; color: var(--white); display: block; line-height: 1; margin-bottom: 4px; }
.ur-cust__stat-lbl { font-family: var(--font-display); font-size: 10px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); }

/* SECTIONS */
.ur-cust__section { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 28px; margin-bottom: 20px; position: relative; transition: border-color 0.2s; }
.ur-cust__section:hover { border-color: rgba(255,255,255,0.2); }
.ur-cust__section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px); pointer-events: none; z-index: 0; }
.ur-cust__section > * { position: relative; z-index: 1; }
.ur-cust__section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-cust__section-num { font-family: var(--font-display); font-size: 56px; color: transparent; line-height: 1; -webkit-text-stroke: 2px rgba(255,255,255,0.25); }
.ur-cust__section:hover .ur-cust__section-num { -webkit-text-stroke-color: var(--white); transition: -webkit-text-stroke-color 0.2s; }
.ur-cust__section-header h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); }

/* TABLE */
.ur-cust__table-wrap { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); overflow-x: auto; }
.ur-cust__table { width: 100%; border-collapse: collapse; }
.ur-cust__table th { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.3); text-align: left; padding: 14px 16px; border-bottom: 2px solid rgba(255,255,255,0.08); white-space: nowrap; }
.ur-cust__table td { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.7); padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,0.04); white-space: nowrap; }
.ur-cust__table tr { transition: transform 0.1s; }
.ur-cust__table tbody tr:hover { transform: translateX(4px); }
.ur-cust__table tbody tr:hover td { background: rgba(255,255,255,0.03); }
.ur-cust__cell-title { font-family: var(--font-display) !important; font-size: 14px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-cust__cell-id { font-family: var(--font-display) !important; font-size: 13px !important; letter-spacing: 1px; color: var(--white) !important; }
.ur-cust__cell-date { font-family: var(--font-display) !important; font-size: 12px !important; letter-spacing: 1.5px; color: rgba(255,255,255,0.5) !important; }
.ur-cust__cell-amount { font-family: var(--font-display) !important; font-size: 16px !important; color: var(--white) !important; }
.ur-cust__status { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; padding: 3px 10px; border: 2px solid; }
.ur-cust__status--confirmed, .ur-cust__status--completed, .ur-cust__status--open { border-color: #22c55e; color: #22c55e; }
.ur-cust__status--pending { border-color: #f59e0b; color: #f59e0b; }
.ur-cust__status--cancelled, .ur-cust__status--closed { border-color: #ef4444; color: #ef4444; }
.ur-cust__status--processing { border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.5); }
.ur-cust__action-icon { width: 32px; height: 32px; background: none; border: 2px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.4); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.15s; font-size: 12px; }
.ur-cust__action-icon:hover { border-color: var(--white); color: var(--white); transform: translate(-1px,-1px); box-shadow: 2px 2px 0 rgba(255,255,255,0.1); }

/* TOOLBAR */
.ur-cust__toolbar { display: flex; gap: 12px; margin-bottom: 20px; }
.ur-cust__search-box { display: flex; align-items: center; gap: 10px; border: 2px solid rgba(255,255,255,0.1); padding: 0 14px; flex: 1; transition: border-color 0.2s; }
.ur-cust__search-box:focus-within { border-color: var(--white); }
.ur-cust__search-box i { color: rgba(255,255,255,0.25); font-size: 13px; }
.ur-cust__search-input { background: none; border: none; outline: none; color: var(--white); font-family: var(--font-display); font-size: 13px; letter-spacing: 2px; padding: 10px 0; width: 100%; }
.ur-cust__search-input::placeholder { color: rgba(255,255,255,0.2); }

/* WISHLIST */
.ur-cust__wishlist-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
.ur-cust__wish-card { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); overflow: hidden; transition: all 0.2s; }
.ur-cust__wish-card:hover { border-color: var(--white); transform: translate(-3px,-3px); box-shadow: 6px 6px 0 rgba(255,255,255,0.1); }
.ur-cust__wish-img { height: 140px; background: rgba(255,255,255,0.04); position: relative; }
.ur-cust__wish-img::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(255,255,255,0.015) 2px, rgba(255,255,255,0.015) 3px); pointer-events: none; }
.ur-cust__wish-date { position: absolute; top: 10px; left: 10px; background: var(--bg-black); border: 2px solid var(--white); padding: 6px 10px; text-align: center; z-index: 1; }
.ur-cust__wish-date span { font-family: var(--font-display); font-size: 20px; color: var(--white); display: block; line-height: 1; }
.ur-cust__wish-date small { font-family: var(--font-display); font-size: 9px; letter-spacing: 2px; color: rgba(255,255,255,0.5); }
.ur-cust__wish-body { padding: 14px 16px; }
.ur-cust__wish-body h4 { font-family: var(--font-display); font-size: 16px; letter-spacing: 1px; color: var(--white); margin-bottom: 4px; }
.ur-cust__wish-meta { font-family: var(--font-display); font-size: 10px; letter-spacing: 2px; color: rgba(255,255,255,0.3); display: block; margin-bottom: 12px; }
.ur-cust__wish-meta i { margin-right: 4px; }
.ur-cust__wish-footer { display: flex; justify-content: space-between; align-items: center; }
.ur-cust__wish-price { font-family: var(--font-display); font-size: 18px; color: var(--white); }
.ur-cust__wish-remove { width: 28px; height: 28px; background: none; border: 2px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 11px; transition: all 0.15s; }
.ur-cust__wish-remove:hover { border-color: #ef4444; color: #ef4444; }

/* SUPPORT */
.ur-cust__support-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.ur-cust__ticket-list { display: flex; flex-direction: column; gap: 0; }
.ur-cust__ticket-row { display: flex; align-items: center; gap: 12px; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
.ur-cust__ticket-row:last-child { border-bottom: none; }
.ur-cust__ticket-id { font-family: var(--font-display); font-size: 13px; letter-spacing: 1px; color: rgba(255,255,255,0.4); flex-shrink: 0; }
.ur-cust__ticket-subject { font-family: var(--font-display); font-size: 14px; letter-spacing: 1px; color: var(--white); flex: 1; }

/* SETTINGS / FORMS */
.ur-cust__settings-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.ur-cust__form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.ur-cust__field { margin-bottom: 18px; }
.ur-cust__field label { font-family: var(--font-display); font-size: 11px; letter-spacing: 2.5px; color: rgba(255,255,255,0.4); display: block; margin-bottom: 8px; }
.ur-cust__input { width: 100%; background: rgba(255,255,255,0.04); border: 2px solid rgba(255,255,255,0.1); color: var(--white); font-family: var(--font-display); font-size: 14px; letter-spacing: 1.5px; padding: 12px 14px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
.ur-cust__input::placeholder { color: rgba(255,255,255,0.15); }
.ur-cust__input:focus { border-color: var(--white); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-cust__textarea { font-family: var(--font-body); letter-spacing: 0.5px; resize: vertical; min-height: 80px; }
.ur-cust__btn { font-family: var(--font-display); font-size: 14px; letter-spacing: 3px; padding: 12px 28px; background: var(--white); color: var(--bg-black); border: 2px solid var(--white); cursor: pointer; box-shadow: 4px 4px 0 rgba(255,255,255,0.15); transition: all 0.15s; }
.ur-cust__btn i { margin-right: 8px; }
.ur-cust__btn:hover { transform: translate(-2px,-2px); box-shadow: 8px 8px 0 rgba(255,255,255,0.2); }
.ur-cust__btn--ghost { background: none; color: rgba(255,255,255,0.5); border-color: rgba(255,255,255,0.15); }
.ur-cust__btn--ghost:hover { color: var(--white); border-color: var(--white); }
.ur-cust__btn--danger { background: none; color: #ef4444; border-color: #ef4444; box-shadow: 4px 4px 0 rgba(239,68,68,0.15); }
.ur-cust__btn--danger:hover { background: #ef4444; color: var(--bg-black); }

/* DANGER ZONE */
.ur-cust__danger-zone { border: 2px solid rgba(239,68,68,0.2); padding: 24px; margin-top: 20px; }
.ur-cust__danger-zone h4 { font-family: var(--font-display); font-size: 14px; letter-spacing: 2px; color: #ef4444; margin-bottom: 8px; }
.ur-cust__danger-zone h4 i { margin-right: 8px; }
.ur-cust__danger-zone p { font-family: var(--font-display); font-size: 12px; letter-spacing: 2px; color: rgba(255,255,255,0.35); margin-bottom: 16px; }

/* RESPONSIVE */
@media (max-width: 1000px) { .ur-cust__overview-layout { grid-template-columns: 1fr; } .ur-cust__support-layout { grid-template-columns: 1fr; } .ur-cust__settings-layout { grid-template-columns: 1fr; } .ur-cust__wishlist-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) { .ur-cust__hero-solid { font-size: 48px; letter-spacing: 6px; } .ur-cust { padding: 0 20px 60px; } .ur-cust__hero { padding: 60px 20px 40px; } .ur-cust__tabs { overflow-x: auto; } .ur-cust__tab { font-size: 12px; padding: 12px 16px; white-space: nowrap; } .ur-cust__stats { grid-template-columns: 1fr 1fr; } .ur-cust__form-row { grid-template-columns: 1fr; } }
@media (max-width: 500px) { .ur-cust__wishlist-grid { grid-template-columns: 1fr; } .ur-cust__stats { grid-template-columns: 1fr; } }
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // TABS
  var tabs = document.querySelectorAll('.ur-cust__tab');
  var panels = document.querySelectorAll('.ur-cust__panel');
  var indicator = document.querySelector('.ur-cust__tab-indicator');
  function setInd(t) { indicator.style.width = t.offsetWidth+'px'; indicator.style.left = t.offsetLeft+'px'; }
  tabs.forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabs.forEach(function(t){t.classList.remove('active');}); panels.forEach(function(p){p.classList.remove('active');});
      this.classList.add('active'); document.getElementById('panel-'+this.dataset.tab).classList.add('active'); setInd(this);
    });
  });
  var at = document.querySelector('.ur-cust__tab.active');
  if (at && indicator) setInd(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-cust__tab.active'); if (a && indicator) setInd(a); });

  // BOOKING SEARCH
  var bkSearch = document.getElementById('bkSearch');
  if (bkSearch) {
    bkSearch.addEventListener('input', function() {
      var q = this.value.toLowerCase();
      document.querySelectorAll('#bkBody tr').forEach(function(r) {
        r.style.display = !q || (r.dataset.search||'').indexOf(q) !== -1 ? '' : 'none';
      });
    });
  }

  // Stagger
  document.querySelectorAll('.ur-cust__stat-card, .ur-cust__section, .ur-cust__wish-card').forEach(function(el,i) {
    el.style.opacity='0'; el.style.transform='translateY(20px)';
    el.style.transition='opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    el.style.transitionDelay=(i*0.05)+'s';
    setTimeout(function(){ el.style.opacity='1'; el.style.transform='translateY(0)'; },50);
  });
});
</script>
@endsection

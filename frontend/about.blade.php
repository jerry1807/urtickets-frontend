@extends('frontend.layout')
@section('pageHeading')
  {{ __('About') }}
@endsection

@section('hero-section')
<section class="ur-about__hero">
  <div class="ur-about__hero-inner">
    <h1 class="ur-about__hero-title">
      <span class="ur-about__hero-outline">ABOUT</span>
      <span class="ur-about__hero-solid">URTICKETS</span>
    </h1>
    <p class="ur-about__hero-sub">EVERYTHING YOU NEED TO KNOW</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-about">

  {{-- TABS --}}
  <div class="ur-about__tabs">
    <button class="ur-about__tab active" data-tab="story"><i class="fas fa-heart"></i> OUR STORY</button>
    <button class="ur-about__tab" data-tab="faq"><i class="fas fa-question-circle"></i> FAQ</button>
    <button class="ur-about__tab" data-tab="terms"><i class="fas fa-file-contract"></i> TERMS</button>
    <button class="ur-about__tab" data-tab="privacy"><i class="fas fa-shield-alt"></i> PRIVACY</button>
    <div class="ur-about__tab-indicator"></div>
  </div>

  {{-- ═══════════════════ OUR STORY ═══════════════════ --}}
  <div class="ur-about__panel active" id="panel-story">
    <div class="ur-about__story-layout">
      <div class="ur-about__story-main">
        <div class="ur-about__section">
          <div class="ur-about__section-header">
            <span class="ur-about__section-num">01</span>
            <h3>WHO WE ARE</h3>
          </div>
          <p class="ur-about__text">UrTickets is a modern event ticketing platform built for organizers who demand more. We make it simple to create, promote, and sell tickets to events of every type and size — from intimate gatherings to massive festivals.</p>
          <p class="ur-about__text">Based in Orlando, Florida, we're a team of event lovers, engineers, and designers who believe the ticketing experience should be as exciting as the event itself.</p>
        </div>

        <div class="ur-about__section">
          <div class="ur-about__section-header">
            <span class="ur-about__section-num">02</span>
            <h3>OUR MISSION</h3>
          </div>
          <p class="ur-about__text">To democratize event management. Every organizer — whether running a local open mic or a multi-day conference — deserves powerful, beautiful tools without the enterprise price tag.</p>
        </div>

        <div class="ur-about__section">
          <div class="ur-about__section-header">
            <span class="ur-about__section-num">03</span>
            <h3>WHAT WE OFFER</h3>
          </div>
          <div class="ur-about__features">
            <div class="ur-about__feature">
              <div class="ur-about__feature-icon"><i class="fas fa-ticket-alt"></i></div>
              <h4>EASY TICKETING</h4>
              <p>Create and sell tickets in minutes with our simple interface.</p>
            </div>
            <div class="ur-about__feature">
              <div class="ur-about__feature-icon"><i class="fas fa-chart-line"></i></div>
              <h4>REAL-TIME ANALYTICS</h4>
              <p>Track sales, attendance, and revenue as it happens.</p>
            </div>
            <div class="ur-about__feature">
              <div class="ur-about__feature-icon"><i class="fas fa-shield-alt"></i></div>
              <h4>SECURE PAYMENTS</h4>
              <p>Multiple payment gateways with built-in fraud protection.</p>
            </div>
            <div class="ur-about__feature">
              <div class="ur-about__feature-icon"><i class="fas fa-qrcode"></i></div>
              <h4>QR SCANNING</h4>
              <p>Verify tickets at the door with our PWA scanner.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="ur-about__story-side">
        <div class="ur-about__stat-block">
          <div class="ur-about__stat"><span>2,000+</span><label>EVENTS HOSTED</label></div>
          <div class="ur-about__stat"><span>50K+</span><label>TICKETS SOLD</label></div>
          <div class="ur-about__stat"><span>500+</span><label>ORGANIZERS</label></div>
          <div class="ur-about__stat"><span>98%</span><label>SATISFACTION</label></div>
        </div>
        <div class="ur-about__contact-block">
          <h4>REACH US</h4>
          <p><i class="fas fa-map-marker-alt"></i> Orlando, Florida</p>
          <p><i class="fas fa-phone-alt"></i> +1 (917) 544-0004</p>
          <p><i class="fas fa-envelope"></i> info@urtickets.com</p>
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════════ FAQ ═══════════════════ --}}
  <div class="ur-about__panel" id="panel-faq">
    <div class="ur-about__faq-list">
      @foreach([
        ['How do I create an event?', 'Sign up as an organizer, go to Event Management, and click CREATE. Fill in your event details, set ticket pricing, and publish. Your event will be live in minutes.'],
        ['What payment methods do you support?', 'We support Stripe, PayPal, bank transfers, and 15+ other payment gateways including Bitcoin, Perfect Money, and regional options like Razorpay and Paystack.'],
        ['How do I get paid as an organizer?', 'Go to the Withdraw section in your dashboard. Select your preferred method, enter the amount, and submit a request. Most withdrawals are processed within 1-3 business days.'],
        ['Can I create both online and in-person events?', 'Yes. When creating an event, toggle between VENUE and ONLINE. Online events include a meeting URL field for platforms like Zoom, Google Meet, etc.'],
        ['What are the fees?', 'We charge a small percentage per ticket sold. There are no upfront costs or monthly fees. You only pay when you make money.'],
        ['How does the QR scanner work?', 'Each ticket generates a unique QR code. At the venue, use our PWA Scanner to scan and verify tickets in real-time. It works on any smartphone.'],
        ['Can I offer early bird pricing?', 'Yes. In the ticketing section of event creation, enable Early Bird Discount, set the percentage, and the deadline date. Prices automatically adjust.'],
        ['How do I contact support?', 'Use the Support Tickets section in your dashboard to create a ticket. You can also email us at info@urtickets.com. We respond within 24 hours.'],
      ] as $i => $faq)
      <div class="ur-about__faq-item" id="faq-{{ $i }}">
        <button class="ur-about__faq-question" data-faq="{{ $i }}">
          <span>{{ $faq[0] }}</span>
          <i class="fas fa-plus"></i>
        </button>
        <div class="ur-about__faq-answer">
          <p>{{ $faq[1] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- ═══════════════════ TERMS ═══════════════════ --}}
  <div class="ur-about__panel" id="panel-terms">
    <div class="ur-about__legal">
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">01</span>
          <h3>TERMS OF SERVICE</h3>
        </div>
        <p class="ur-about__text">By accessing and using UrTickets, you agree to be bound by these Terms of Service. These terms apply to all visitors, users, and organizers who access or use the platform.</p>
        <p class="ur-about__text ur-about__text--dim">Last updated: March 2026</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">02</span>
          <h3>USER ACCOUNTS</h3>
        </div>
        <p class="ur-about__text">You are responsible for maintaining the confidentiality of your account credentials. You agree to notify us immediately of any unauthorized access. We reserve the right to terminate accounts that violate these terms.</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">03</span>
          <h3>EVENT ORGANIZERS</h3>
        </div>
        <p class="ur-about__text">Organizers are solely responsible for the accuracy of event information, fulfillment of ticket obligations, and compliance with local regulations. UrTickets acts as a platform provider and does not guarantee event quality or attendance.</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">04</span>
          <h3>PAYMENTS & REFUNDS</h3>
        </div>
        <p class="ur-about__text">All payments are processed through third-party payment providers. Refund policies are set by individual organizers. UrTickets charges a service fee per transaction as outlined in our fee schedule.</p>
      </div>
    </div>
  </div>

  {{-- ═══════════════════ PRIVACY ═══════════════════ --}}
  <div class="ur-about__panel" id="panel-privacy">
    <div class="ur-about__legal">
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">01</span>
          <h3>PRIVACY POLICY</h3>
        </div>
        <p class="ur-about__text">Your privacy matters. This policy describes how UrTickets collects, uses, and protects your personal information when you use our platform.</p>
        <p class="ur-about__text ur-about__text--dim">Last updated: March 2026</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">02</span>
          <h3>DATA WE COLLECT</h3>
        </div>
        <p class="ur-about__text">We collect information you provide directly: name, email, payment details for transactions, and event preferences. We also collect usage data including device information, IP address, and browsing patterns to improve our service.</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">03</span>
          <h3>HOW WE USE IT</h3>
        </div>
        <p class="ur-about__text">To process transactions, send booking confirmations, improve platform features, and communicate updates. We never sell your personal data to third parties.</p>
      </div>
      <div class="ur-about__section">
        <div class="ur-about__section-header">
          <span class="ur-about__section-num">04</span>
          <h3>YOUR RIGHTS</h3>
        </div>
        <p class="ur-about__text">You can request access to, correction of, or deletion of your personal data at any time by contacting support@urtickets.com. We will respond within 30 days.</p>
      </div>
    </div>
  </div>

</section>
@endsection

@section('custom-style')
<style>
/* HERO */
.ur-about__hero { background: var(--bg-black); border-bottom: 2px solid rgba(255,255,255,0.1); padding: 80px 40px 60px; text-align: center; }
.ur-about__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-about__hero-outline { font-family: var(--font-display); font-size: 24px; letter-spacing: 10px; color: rgba(255,255,255,0.3); display: block; line-height: 1; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both; }
.ur-about__hero-solid { font-family: var(--font-display); font-size: 72px; letter-spacing: 12px; color: var(--white); display: block; line-height: 1; margin-top: 4px; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both; }
.ur-about__hero-sub { font-family: var(--font-display); font-size: 14px; letter-spacing: 6px; color: rgba(255,255,255,0.3); margin-top: 16px; }

/* LAYOUT */
.ur-about { max-width: 1200px; margin: 0 auto; padding: 0 40px 80px; }

/* TABS */
.ur-about__tabs { display: flex; gap: 0; border-bottom: 2px solid rgba(255,255,255,0.1); margin: 32px 0 32px; position: relative; }
.ur-about__tab { font-family: var(--font-display); font-size: 16px; letter-spacing: 3px; color: rgba(255,255,255,0.35); background: none; border: none; padding: 14px 28px; cursor: pointer; transition: color 0.2s; position: relative; z-index: 1; }
.ur-about__tab i { margin-right: 8px; font-size: 14px; }
.ur-about__tab:hover { color: rgba(255,255,255,0.7); }
.ur-about__tab.active { color: var(--white); }
.ur-about__tab-indicator { position: absolute; bottom: -2px; height: 2px; background: var(--white); transition: left 0.35s cubic-bezier(0.25,1,0.5,1), width 0.35s cubic-bezier(0.25,1,0.5,1); }
.ur-about__panel { display: none; }
.ur-about__panel.active { display: block; }

/* SECTIONS */
.ur-about__section { border: 2px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02); padding: 28px; margin-bottom: 20px; position: relative; transition: border-color 0.2s; }
.ur-about__section:hover { border-color: rgba(255,255,255,0.2); }
.ur-about__section::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px); pointer-events: none; z-index: 0; }
.ur-about__section > * { position: relative; z-index: 1; }
.ur-about__section-header { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-about__section-num { font-family: var(--font-display); font-size: 56px; color: transparent; line-height: 1; letter-spacing: 2px; -webkit-text-stroke: 2px rgba(255,255,255,0.25); }
.ur-about__section:hover .ur-about__section-num { -webkit-text-stroke-color: var(--white); transition: -webkit-text-stroke-color 0.2s; }
.ur-about__section-header h3 { font-family: var(--font-display); font-size: 18px; letter-spacing: 3px; color: var(--white); }
.ur-about__text { font-family: var(--font-body); font-size: 15px; color: rgba(255,255,255,0.55); line-height: 1.8; margin-bottom: 12px; }
.ur-about__text:last-child { margin-bottom: 0; }
.ur-about__text--dim { font-size: 12px; color: rgba(255,255,255,0.25); font-style: italic; }

/* STORY LAYOUT */
.ur-about__story-layout { display: grid; grid-template-columns: 1fr 320px; gap: 32px; }

/* FEATURES GRID */
.ur-about__features { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.ur-about__feature { border: 2px solid rgba(255,255,255,0.06); padding: 20px; transition: all 0.15s; }
.ur-about__feature:hover { border-color: var(--white); transform: translate(-2px, -2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }
.ur-about__feature-icon { font-size: 20px; color: rgba(255,255,255,0.2); margin-bottom: 12px; transition: color 0.2s; }
.ur-about__feature:hover .ur-about__feature-icon { color: var(--white); }
.ur-about__feature h4 { font-family: var(--font-display); font-size: 14px; letter-spacing: 2px; color: var(--white); margin-bottom: 6px; }
.ur-about__feature p { font-family: var(--font-body); font-size: 13px; color: rgba(255,255,255,0.4); line-height: 1.5; }

/* SIDEBAR STATS */
.ur-about__stat-block { border: 2px solid var(--white); padding: 24px; margin-bottom: 20px; }
.ur-about__stat { padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.06); }
.ur-about__stat:last-child { border-bottom: none; }
.ur-about__stat span { font-family: var(--font-display); font-size: 32px; color: var(--white); letter-spacing: 1px; display: block; line-height: 1; }
.ur-about__stat label { font-family: var(--font-display); font-size: 10px; letter-spacing: 3px; color: rgba(255,255,255,0.3); display: block; margin-top: 4px; }

.ur-about__contact-block { border: 2px solid rgba(255,255,255,0.08); padding: 24px; }
.ur-about__contact-block h4 { font-family: var(--font-display); font-size: 14px; letter-spacing: 3px; color: var(--white); margin-bottom: 16px; }
.ur-about__contact-block p { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.45); margin-bottom: 10px; }
.ur-about__contact-block p:last-child { margin-bottom: 0; }
.ur-about__contact-block i { width: 16px; margin-right: 8px; color: rgba(255,255,255,0.25); font-size: 12px; }

/* FAQ */
.ur-about__faq-list { display: flex; flex-direction: column; gap: 0; }
.ur-about__faq-item { border: 2px solid rgba(255,255,255,0.08); border-bottom: none; transition: border-color 0.2s; }
.ur-about__faq-item:last-child { border-bottom: 2px solid rgba(255,255,255,0.08); }
.ur-about__faq-item.is-open { border-color: rgba(255,255,255,0.2); }
.ur-about__faq-question { width: 100%; background: none; border: none; padding: 20px 24px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: background 0.15s; }
.ur-about__faq-question:hover { background: rgba(255,255,255,0.03); }
.ur-about__faq-question span { font-family: var(--font-display); font-size: 16px; letter-spacing: 1px; color: var(--white); text-align: left; }
.ur-about__faq-question i { color: rgba(255,255,255,0.3); font-size: 14px; transition: transform 0.3s, color 0.2s; flex-shrink: 0; margin-left: 16px; }
.ur-about__faq-item.is-open .ur-about__faq-question i { transform: rotate(45deg); color: var(--white); }
.ur-about__faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s cubic-bezier(0.25,1,0.5,1), padding 0.35s; padding: 0 24px; }
.ur-about__faq-item.is-open .ur-about__faq-answer { max-height: 200px; padding: 0 24px 20px; }
.ur-about__faq-answer p { font-family: var(--font-body); font-size: 14px; color: rgba(255,255,255,0.45); line-height: 1.7; }

/* RESPONSIVE */
@media (max-width: 1000px) { .ur-about__story-layout { grid-template-columns: 1fr; } .ur-about__features { grid-template-columns: 1fr; } }
@media (max-width: 768px) { .ur-about__hero-solid { font-size: 48px; letter-spacing: 6px; } .ur-about { padding: 0 20px 60px; } .ur-about__hero { padding: 60px 20px 40px; } .ur-about__tabs { overflow-x: auto; } .ur-about__tab { font-size: 13px; padding: 12px 18px; white-space: nowrap; } }
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // TABS
  var tabs = document.querySelectorAll('.ur-about__tab');
  var panels = document.querySelectorAll('.ur-about__panel');
  var indicator = document.querySelector('.ur-about__tab-indicator');
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
  var at = document.querySelector('.ur-about__tab.active');
  if (at && indicator) setInd(at);
  window.addEventListener('resize', function() { var a = document.querySelector('.ur-about__tab.active'); if (a && indicator) setInd(a); });

  // FAQ ACCORDION
  document.querySelectorAll('.ur-about__faq-question').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = document.getElementById('faq-' + this.dataset.faq);
      var wasOpen = item.classList.contains('is-open');
      document.querySelectorAll('.ur-about__faq-item').forEach(function(f) { f.classList.remove('is-open'); });
      if (!wasOpen) item.classList.add('is-open');
    });
  });

  // Stagger
  document.querySelectorAll('.ur-about__section, .ur-about__feature, .ur-about__faq-item').forEach(function(el, i) {
    el.style.opacity = '0'; el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    el.style.transitionDelay = (i * 0.05) + 's';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

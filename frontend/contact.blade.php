@extends('frontend.layout')
@section('pageHeading')
  {{ __('Contact') }}
@endsection

@section('hero-section')
<section class="ur-contact__hero">
  <div class="ur-contact__hero-inner">
    <h1 class="ur-contact__hero-title">
      <span class="ur-contact__hero-outline">GET IN</span>
      <span class="ur-contact__hero-solid">TOUCH</span>
    </h1>
    <p class="ur-contact__hero-sub">WE'D LOVE TO HEAR FROM YOU</p>
  </div>
</section>
@endsection

@section('content')
<section class="ur-contact">
  <div class="ur-contact__layout">

    {{-- LEFT: CONTACT INFO --}}
    <div class="ur-contact__info">
      <div class="ur-contact__info-card">
        <div class="ur-contact__info-icon"><i class="fas fa-map-marker-alt"></i></div>
        <div>
          <h4>LOCATION</h4>
          <p>{{ $bex->contact_addresses }}</p>
        </div>
      </div>
      <div class="ur-contact__info-card">
        <div class="ur-contact__info-icon"><i class="fas fa-envelope"></i></div>
        <div>
          <h4>EMAIL</h4>
          @foreach(explode(',', $bex->contact_mails) as $mail)
            <a href="mailto:{{ trim($mail) }}">{{ trim($mail) }}</a>
          @endforeach
        </div>
      </div>
      <div class="ur-contact__info-card">
        <div class="ur-contact__info-icon"><i class="fas fa-phone-alt"></i></div>
        <div>
          <h4>PHONE</h4>
          <a href="tel:{{ $bex->contact_numbers }}">{{ $bex->contact_numbers }}</a>
        </div>
      </div>

      {{-- SOCIAL --}}
      <div class="ur-contact__social">
        @foreach($socialMediaInfos as $social)
          <a href="{{ $social->url }}" class="ur-contact__social-link"><i class="{{ $social->icon }}"></i></a>
        @endforeach
      </div>
    </div>

    {{-- RIGHT: FORM --}}
    <div class="ur-contact__form-wrap">
      <div class="ur-contact__section-header">
        <span class="ur-contact__section-num">01</span>
        <h3>SEND A MESSAGE</h3>
      </div>

      <form class="ur-contact__form" id="contactForm">
        <div class="ur-contact__form-row">
          <div class="ur-contact__field">
            <label>FULL NAME *</label>
            <input type="text" name="name" class="ur-contact__input" placeholder="YOUR NAME">
          </div>
          <div class="ur-contact__field">
            <label>EMAIL *</label>
            <input type="email" name="email" class="ur-contact__input" placeholder="YOUR EMAIL">
          </div>
        </div>
        <div class="ur-contact__field">
          <label>SUBJECT *</label>
          <input type="text" name="subject" class="ur-contact__input" placeholder="WHAT'S THIS ABOUT?">
        </div>
        <div class="ur-contact__field">
          <label>MESSAGE *</label>
          <textarea name="message" class="ur-contact__input ur-contact__textarea" rows="6" placeholder="TELL US MORE..."></textarea>
        </div>
        <button type="submit" class="ur-contact__btn" id="sendBtn">
          <i class="fas fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>
    </div>

  </div>
</section>
@endsection

@section('custom-style')
<style>
/* HERO */
.ur-contact__hero {
  background: var(--bg-black);
  border-bottom: 2px solid rgba(255,255,255,0.1);
  padding: 80px 40px 60px;
  text-align: center;
}
.ur-contact__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-contact__hero-outline {
  font-family: var(--font-display);
  font-size: 24px;
  letter-spacing: 10px;
  color: rgba(255,255,255,0.3);
  display: block;
  line-height: 1;
  animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both;
}
.ur-contact__hero-solid {
  font-family: var(--font-display);
  font-size: 72px;
  letter-spacing: 12px;
  color: var(--white);
  display: block;
  line-height: 1;
  margin-top: 4px;
  animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both;
}
.ur-contact__hero-sub {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 6px;
  color: rgba(255,255,255,0.3);
  margin-top: 16px;
}

/* LAYOUT */
.ur-contact {
  max-width: 1200px;
  margin: 0 auto;
  padding: 60px 40px 80px;
}
.ur-contact__layout {
  display: grid;
  grid-template-columns: 1fr 1.8fr;
  gap: 40px;
}

/* INFO CARDS */
.ur-contact__info { display: flex; flex-direction: column; gap: 0; }
.ur-contact__info-card {
  display: flex;
  gap: 16px;
  padding: 24px 0;
  border-bottom: 1px solid rgba(255,255,255,0.06);
  align-items: flex-start;
}
.ur-contact__info-card:first-child { padding-top: 0; }
.ur-contact__info-icon {
  width: 44px; height: 44px;
  border: 2px solid rgba(255,255,255,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  color: rgba(255,255,255,0.4);
  flex-shrink: 0;
  transition: all 0.15s;
}
.ur-contact__info-card:hover .ur-contact__info-icon {
  border-color: var(--white);
  color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
.ur-contact__info-card h4 {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 3px;
  color: var(--white);
  margin-bottom: 6px;
}
.ur-contact__info-card p,
.ur-contact__info-card a {
  font-family: var(--font-body);
  font-size: 14px;
  color: rgba(255,255,255,0.45);
  line-height: 1.6;
  display: block;
  transition: color 0.15s;
}
.ur-contact__info-card a:hover { color: var(--white); }

/* SOCIAL */
.ur-contact__social {
  display: flex;
  gap: 10px;
  margin-top: 32px;
}
.ur-contact__social-link {
  width: 40px; height: 40px;
  border: 2px solid rgba(255,255,255,0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  color: rgba(255,255,255,0.3);
  transition: all 0.15s;
}
.ur-contact__social-link:hover {
  border-color: var(--white);
  color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}

/* FORM */
.ur-contact__form-wrap {
  border: 2px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.02);
  padding: 32px;
  position: relative;
  transition: border-color 0.2s;
}
.ur-contact__form-wrap:hover { border-color: rgba(255,255,255,0.15); }
.ur-contact__form-wrap::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px);
  pointer-events: none;
  z-index: 0;
}
.ur-contact__form-wrap > * { position: relative; z-index: 1; }

.ur-contact__section-header {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 28px;
  padding-bottom: 16px;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.ur-contact__section-num {
  font-family: var(--font-display);
  font-size: 56px;
  color: transparent;
  line-height: 1;
  letter-spacing: 2px;
  -webkit-text-stroke: 2px rgba(255,255,255,0.25);
}
.ur-contact__form-wrap:hover .ur-contact__section-num {
  -webkit-text-stroke-color: var(--white);
  transition: -webkit-text-stroke-color 0.2s;
}
.ur-contact__section-header h3 {
  font-family: var(--font-display);
  font-size: 18px;
  letter-spacing: 3px;
  color: var(--white);
}

.ur-contact__form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
.ur-contact__field { margin-bottom: 20px; }
.ur-contact__field label {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2.5px;
  color: rgba(255,255,255,0.4);
  display: block;
  margin-bottom: 8px;
}
.ur-contact__input {
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
.ur-contact__input::placeholder { color: rgba(255,255,255,0.15); }
.ur-contact__input:focus {
  border-color: var(--white);
  box-shadow: 4px 4px 0 rgba(255,255,255,0.1);
}
.ur-contact__textarea {
  font-family: var(--font-body);
  letter-spacing: 0.5px;
  resize: vertical;
  min-height: 120px;
}

.ur-contact__btn {
  font-family: var(--font-display);
  font-size: 15px;
  letter-spacing: 3px;
  padding: 14px 36px;
  background: var(--white);
  color: var(--bg-black);
  border: 2px solid var(--white);
  cursor: pointer;
  box-shadow: 4px 4px 0 rgba(255,255,255,0.15);
  transition: all 0.15s;
}
.ur-contact__btn i { margin-right: 8px; }
.ur-contact__btn:hover {
  transform: translate(-2px, -2px);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.2);
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .ur-contact__layout { grid-template-columns: 1fr; gap: 32px; }
  .ur-contact { padding: 40px 20px 60px; }
  .ur-contact__hero { padding: 60px 20px 40px; }
  .ur-contact__hero-solid { font-size: 48px; letter-spacing: 6px; }
}
@media (max-width: 600px) {
  .ur-contact__form-row { grid-template-columns: 1fr; }
  .ur-contact__form-wrap { padding: 20px; }
}
</style>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Glitch on send button hover
  var btn = document.getElementById('sendBtn');
  if (btn) {
    btn.addEventListener('mouseenter', function() {
      this.style.animation = 'none';
      void this.offsetHeight;
      this.style.animation = 'ur-glitch-flash 0.3s';
    });
  }

  // Stagger entrance
  document.querySelectorAll('.ur-contact__info-card, .ur-contact__form-wrap').forEach(function(el, i) {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease, border-color 0.2s, box-shadow 0.2s';
    el.style.transitionDelay = (i * 0.1) + 's';
    setTimeout(function() { el.style.opacity = '1'; el.style.transform = 'translateY(0)'; }, 50);
  });
});
</script>
@endsection

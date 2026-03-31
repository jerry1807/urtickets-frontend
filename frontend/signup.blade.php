@extends('frontend.layout')
@section('pageHeading')
  {{ __('Sign Up') }}
@endsection

@section('hero-section')
<style>
  .header-area, .header, header, .ur-header { display: none !important; }
  .footer-section { display: none !important; }
</style>

<section class="ur-login">
  <div class="ur-login__left">
    <div class="ur-login__slideshow">
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1540039155732-6847350257fd?auto=format&fit=crop&q=80&w=1600');"></div>
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=1600'); animation-delay: 5s;"></div>
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&q=80&w=1600'); animation-delay: 10s;"></div>
    </div>
    <div class="ur-login__left-overlay"></div>
    <div class="ur-login__left-content">
      <a href="{{ route('index') }}" class="ur-login__brand">
        <div class="ur-landing__right-brand" style="transform: rotate(-4deg); font-size: 28px;">
          <span class="ur-landing__right-brand-ur" style="font-size: 32px;">UR</span><span class="ur-landing__right-brand-reveal">TICKETS</span>
        </div>
      </a>
      <div class="ur-login__left-text">
        <h1 class="ur-login__hero-title">JOIN<br>THE<br>MOVE<br>MENT</h1>
        <div class="ur-login__hero-line"></div>
        <p class="ur-login__hero-sub">Create your account. Start selling tickets, managing events, and building your audience today.</p>
      </div>
      <div class="ur-login__left-stats">
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">FREE</span>
          <span class="ur-login__stat-label">TO START</span>
        </div>
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">30s</span>
          <span class="ur-login__stat-label">SETUP TIME</span>
        </div>
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">0%</span>
          <span class="ur-login__stat-label">MONTHLY FEE</span>
        </div>
      </div>
    </div>
  </div>

  <div class="ur-login__right">
    <div class="ur-login__right-header">
      <a href="{{ route('index') }}" class="ur-login__back">
        <i class="fas fa-arrow-left"></i> HOME
      </a>
      <a href="{{ url('/login') }}" class="ur-login__switch">
        HAVE AN ACCOUNT? <strong>LOG IN</strong>
      </a>
    </div>

    <div class="ur-login__form-wrap">
      <div class="ur-login__form-header">
        <span class="ur-login__tag">CREATE ACCOUNT</span>
        <h2 class="ur-login__form-title">SIGN<br>UP</h2>
      </div>

      <form id="signup-form" action="{{ route('organizer.create') }}" method="POST" class="ur-login__form">
        @csrf
        <input type="hidden" name="account_type" id="account_type" value="">
        <div class="ur-signup__row">
          <div class="ur-login__field">
            <label class="ur-login__label">FULL NAME</label>
            <div class="ur-login__input-wrap">
              <input type="text" name="name" id="name" value="{{ old('name') }}" class="ur-login__input" placeholder="Your full name" autocomplete="name">
              <div class="ur-login__input-icon"><i class="fas fa-user"></i></div>
            </div>
            @error('name')
              <p class="ur-login__error">{{ $message }}</p>
            @enderror
          </div>

          <div class="ur-login__field">
            <label class="ur-login__label">USERNAME</label>
            <div class="ur-login__input-wrap">
              <input type="text" name="username" id="username" value="{{ old('username') }}" class="ur-login__input" placeholder="Choose a username" autocomplete="username">
              <div class="ur-login__input-icon"><i class="fas fa-at"></i></div>
            </div>
            @error('username')
              <p class="ur-login__error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="ur-login__field">
          <label class="ur-login__label">EMAIL ADDRESS</label>
          <div class="ur-login__input-wrap">
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="ur-login__input" placeholder="your@email.com" autocomplete="email">
            <div class="ur-login__input-icon"><i class="fas fa-envelope"></i></div>
          </div>
          @error('email')
            <p class="ur-login__error">{{ $message }}</p>
          @enderror
        </div>

        <div class="ur-signup__row">
          <div class="ur-login__field">
            <label class="ur-login__label">PASSWORD</label>
            <div class="ur-login__input-wrap">
              <input type="password" name="password" id="password" class="ur-login__input" placeholder="Min 8 characters" autocomplete="new-password">
              <div class="ur-login__input-icon"><i class="fas fa-lock"></i></div>
            </div>
            @error('password')
              <p class="ur-login__error">{{ $message }}</p>
            @enderror
          </div>

          <div class="ur-login__field">
            <label class="ur-login__label">CONFIRM</label>
            <div class="ur-login__input-wrap">
              <input type="password" name="password_confirmation" id="re-password" class="ur-login__input" placeholder="Repeat password" autocomplete="new-password">
              <div class="ur-login__input-icon"><i class="fas fa-check-double"></i></div>
            </div>
          </div>
        </div>

        @if (!empty($basicInfo) && $basicInfo->google_recaptcha_status == 1)
          <div class="ur-login__field">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
              <p class="ur-login__error">{{ $message }}</p>
            @enderror
          </div>
        @endif

        <button type="submit" class="ur-login__submit">
          <span class="ur-login__submit-text">CREATE ACCOUNT</span>
          <span class="ur-login__submit-arrow"><i class="fas fa-arrow-right"></i></span>
        </button>

        <p class="ur-signup__terms">
          By signing up you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.
        </p>
      </form>
    </div>

    <div class="ur-login__right-footer">
      <p>&copy; {{ date('Y') }} URTICKETS. ALL RIGHTS RESERVED.</p>
    </div>
  </div>

  <div class="ur-type-modal" id="typeModal">
    <div class="ur-type-modal__backdrop"></div>
    <div class="ur-type-modal__box">
      <h3 class="ur-type-modal__title">WHO ARE<br>YOU?</h3>
      <p class="ur-type-modal__sub">Choose your path. You can always switch later.</p>
      <div class="ur-type-modal__options">
        <button type="button" class="ur-type-modal__option" data-type="organizer">
          <div class="ur-type-modal__icon"><i class="fas fa-bullhorn"></i></div>
          <h4>ORGANIZER</h4>
          <p>I create and manage events, sell tickets, and build audiences.</p>
        </button>
        <button type="button" class="ur-type-modal__option" data-type="attendee">
          <div class="ur-type-modal__icon"><i class="fas fa-ticket-alt"></i></div>
          <h4>ATTENDEE</h4>
          <p>I discover events, buy tickets, and enjoy unforgettable experiences.</p>
        </button>
      </div>
      <button type="button" class="ur-type-modal__close" id="typeModalClose"><i class="fas fa-times"></i></button>
    </div>
  </div>
</section>
@endsection

@section('content')
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Field entrance animations
  document.querySelectorAll('.ur-login__field').forEach(function(field, i) {
    field.style.opacity = '0';
    field.style.transform = 'translateX(40px)';
    field.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
    field.style.transitionDelay = (0.1 + i * 0.07) + 's';
    setTimeout(function() { field.style.opacity = '1'; field.style.transform = 'translateX(0)'; }, 50);
  });

  // Title stamp-in
  var title = document.querySelector('.ur-login__form-title');
  if (title) {
    title.style.opacity = '0';
    title.style.transform = 'scale(1.5) rotate(-5deg)';
    title.style.transition = 'all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    setTimeout(function() { title.style.opacity = '1'; title.style.transform = 'scale(1) rotate(0deg)'; }, 100);
  }

  // Focus states
  document.querySelectorAll('.ur-login__input').forEach(function(input) {
    input.addEventListener('focus', function() { this.parentElement.classList.add('is-focused'); });
    input.addEventListener('blur', function() { this.parentElement.classList.remove('is-focused'); });
  });

  // ACCOUNT TYPE MODAL
  var form = document.getElementById('signup-form');
  var modal = document.getElementById('typeModal');
  var typeInput = document.getElementById('account_type');
  var closeBtn = document.getElementById('typeModalClose');

  // Intercept form submit -> show modal
  form.addEventListener('submit', function(e) {
    if (!typeInput.value) {
      e.preventDefault();
      modal.classList.add('is-open');
      // Animate options in
      var opts = modal.querySelectorAll('.ur-type-modal__option');
      opts.forEach(function(opt, i) {
        opt.style.opacity = '0';
        opt.style.transform = 'scale(0.8) rotate(-3deg)';
        opt.style.transition = 'all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        opt.style.transitionDelay = (0.15 + i * 0.12) + 's';
        setTimeout(function() { opt.style.opacity = '1'; opt.style.transform = 'scale(1) rotate(0deg)'; }, 50);
      });
    }
  });

  // Option click -> set type + submit
  modal.querySelectorAll('.ur-type-modal__option').forEach(function(opt) {
    opt.addEventListener('click', function() {
      var type = this.getAttribute('data-type');
      typeInput.value = type;
      // Visual feedback
      this.style.transform = 'scale(0.95)';
      this.style.boxShadow = '0 0 0 4px var(--white)';
      setTimeout(function() {
        modal.classList.remove('is-open');
        form.submit();
      }, 300);
    });
    // Glitch hover
    opt.addEventListener('mouseenter', function() {
      this.style.animation = 'glitchFlash 0.2s ease';
      var s = this; setTimeout(function() { s.style.animation = ''; }, 200);
    });
  });

  // Close modal
  closeBtn.addEventListener('click', function() { modal.classList.remove('is-open'); });
  modal.querySelector('.ur-type-modal__backdrop').addEventListener('click', function() { modal.classList.remove('is-open'); });
});
</script>
@endsection

@section('custom-style')
<style>
.ur-login {
  display: flex;
  min-height: 100vh;
  width: 100%;
  background: var(--bg-black);
}
.ur-login__left {
  flex: 1;
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  min-height: 100vh;
}
.ur-login__slideshow { position: absolute; inset: 0; }
.ur-login__slide {
  position: absolute; inset: 0;
  background-size: cover;
  background-position: center;
  opacity: 0;
  animation: bgSlideFade 15s infinite;
}
.ur-login__left-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(180deg, rgba(5,5,5,0.3) 0%, rgba(5,5,5,0.1) 40%, rgba(5,5,5,0.6) 70%, rgba(5,5,5,0.95) 100%);
  z-index: 1;
}
.ur-login__left-content {
  position: relative; z-index: 2; padding: 40px 48px;
  display: flex; flex-direction: column; height: 100%;
}
.ur-login__brand { text-decoration: none; display: inline-block; margin-bottom: auto; }
.ur-login__left-text { margin-bottom: 48px; }
.ur-login__hero-title {
  font-family: var(--font-display);
  font-size: clamp(52px, 7vw, 100px);
  line-height: 0.88; color: var(--white);
  letter-spacing: -1px; margin-bottom: 16px;
}
.ur-login__hero-line { width: 120px; height: 6px; background: var(--white); margin-bottom: 20px; }
.ur-login__hero-sub {
  font-family: var(--font-body); font-size: 16px;
  color: rgba(255,255,255,0.6); max-width: 380px; line-height: 1.5;
}
.ur-login__left-stats {
  display: flex; gap: 40px; padding-top: 32px;
  border-top: 1px solid rgba(255,255,255,0.12);
}
.ur-login__stat-num {
  font-family: var(--font-display); font-size: 32px;
  color: var(--white); display: block; line-height: 1; letter-spacing: 1px;
}
.ur-login__stat-label {
  font-family: var(--font-display); font-size: 11px;
  color: rgba(255,255,255,0.4); letter-spacing: 2px; display: block; margin-top: 4px;
}

.ur-login__right {
  flex: 0 0 520px; max-width: 520px;
  background: var(--bg-black); border-left: 3px solid var(--white);
  display: flex; flex-direction: column; min-height: 100vh;
}
.ur-login__right-header {
  display: flex; justify-content: space-between; align-items: center;
  padding: 20px 36px; border-bottom: 1px solid rgba(255,255,255,0.1);
}
.ur-login__back {
  font-family: var(--font-display); font-size: 14px;
  color: rgba(255,255,255,0.5); letter-spacing: 2px; transition: color 0.2s;
}
.ur-login__back:hover { color: var(--white); }
.ur-login__back i { margin-right: 6px; }
.ur-login__switch {
  font-family: var(--font-body); font-size: 12px;
  color: rgba(255,255,255,0.5); letter-spacing: 0.5px; transition: color 0.2s;
}
.ur-login__switch:hover { color: var(--white); }
.ur-login__switch strong { color: var(--white); border-bottom: 2px solid var(--white); padding-bottom: 1px; }

.ur-login__form-wrap {
  flex: 1; display: flex; flex-direction: column;
  justify-content: center; padding: 36px 36px;
}
.ur-login__form-header { margin-bottom: 32px; }
.ur-login__tag {
  font-family: var(--font-display); font-size: 13px;
  letter-spacing: 3px; color: var(--bg-black);
  background: var(--white); padding: 4px 12px;
  display: inline-block; margin-bottom: 16px;
}
.ur-login__form-title {
  font-family: var(--font-display); font-size: 72px;
  line-height: 0.85; color: var(--white); letter-spacing: 2px;
}

.ur-login__form { display: flex; flex-direction: column; gap: 20px; }

/* Two-column rows for signup */
.ur-signup__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.ur-login__label {
  font-family: var(--font-display); font-size: 12px;
  letter-spacing: 3px; color: rgba(255,255,255,0.5);
  display: block; margin-bottom: 6px;
}
.ur-login__input-wrap {
  position: relative;
  border: 3px solid rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.03);
  transition: border-color 0.2s, box-shadow 0.2s, transform 0.15s;
}
.ur-login__input-wrap.is-focused {
  border-color: var(--white);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.1);
  transform: translate(-2px, -2px);
}
.ur-login__input {
  width: 100%; background: transparent; border: none; outline: none;
  color: var(--white); font-family: var(--font-body);
  font-size: 15px; font-weight: 500;
  padding: 14px 44px 14px 14px; letter-spacing: 0.5px;
}
.ur-login__input::placeholder { color: rgba(255,255,255,0.2); }
.ur-login__input-icon {
  position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
  color: rgba(255,255,255,0.15); font-size: 14px; transition: color 0.2s;
}
.ur-login__input-wrap.is-focused .ur-login__input-icon { color: var(--white); }
.ur-login__error {
  font-family: var(--font-body); font-size: 13px;
  color: #ef4444; margin-top: 6px; font-weight: 600;
}

.ur-login__submit {
  display: flex; align-items: center; justify-content: space-between;
  width: 100%; padding: 16px 24px;
  background: var(--white); color: var(--bg-black);
  border: 4px solid var(--white); font-family: var(--font-display);
  font-size: 20px; letter-spacing: 3px; cursor: pointer;
  transition: all 0.15s cubic-bezier(0.25, 1, 0.5, 1);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.15); margin-top: 4px;
}
.ur-login__submit:hover {
  transform: translate(-3px, -3px);
  box-shadow: 10px 10px 0 rgba(255,255,255,0.2);
}
.ur-login__submit:active {
  transform: translate(2px, 2px);
  box-shadow: 2px 2px 0 rgba(255,255,255,0.1);
}
.ur-login__submit-arrow { font-size: 18px; transition: transform 0.2s; }
.ur-login__submit:hover .ur-login__submit-arrow { transform: translateX(6px); }

.ur-signup__terms {
  font-family: var(--font-body); font-size: 12px;
  color: rgba(255,255,255,0.3); text-align: center;
  line-height: 1.5; margin-top: 0;
}
.ur-signup__terms a {
  color: rgba(255,255,255,0.6);
  text-decoration: underline;
  transition: color 0.2s;
}
.ur-signup__terms a:hover { color: var(--white); }

.ur-login__right-footer {
  padding: 16px 36px; border-top: 1px solid rgba(255,255,255,0.06);
}
.ur-login__right-footer p {
  font-family: var(--font-display); font-size: 11px;
  letter-spacing: 2px; color: rgba(255,255,255,0.2); margin: 0;
}

@media (max-width: 900px) {
  .ur-login { flex-direction: column; }
  .ur-login__left { min-height: 35vh; flex: none; }
  .ur-login__right { flex: none; max-width: 100%; border-left: none; border-top: 3px solid var(--white); min-height: auto; }
  .ur-login__hero-title { font-size: 48px; }
  .ur-login__form-title { font-size: 56px; }
  .ur-login__left-stats { gap: 24px; }
  .ur-signup__row { grid-template-columns: 1fr; }
}
@media (max-width: 480px) {
  .ur-login__form-wrap { padding: 28px 20px; }
  .ur-login__right-header { padding: 16px 20px; }
  .ur-login__left-content { padding: 28px 20px; }
  .ur-type-modal__options { grid-template-columns: 1fr; }
}

/* ACCOUNT TYPE MODAL */
.ur-type-modal {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.25s;
}
.ur-type-modal.is-open {
  opacity: 1;
  pointer-events: all;
}
.ur-type-modal__backdrop {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.85);
  backdrop-filter: blur(6px);
}
.ur-type-modal__box {
  position: relative;
  background: var(--bg-black);
  border: 4px solid var(--white);
  padding: 48px;
  max-width: 620px;
  width: 90%;
  box-shadow: 12px 12px 0 rgba(255,255,255,0.15);
  transform: scale(0.9);
  transition: transform 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ur-type-modal.is-open .ur-type-modal__box {
  transform: scale(1);
}
.ur-type-modal__title {
  font-family: var(--font-display);
  font-size: 56px;
  line-height: 0.88;
  color: var(--white);
  letter-spacing: 2px;
  margin-bottom: 12px;
}
.ur-type-modal__sub {
  font-family: var(--font-body);
  font-size: 14px;
  color: rgba(255,255,255,0.5);
  margin-bottom: 32px;
}
.ur-type-modal__options {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
.ur-type-modal__option {
  background: transparent;
  border: 3px solid rgba(255,255,255,0.15);
  padding: 28px 24px;
  cursor: pointer;
  text-align: left;
  color: var(--white);
  transition: all 0.15s cubic-bezier(0.25, 1, 0.5, 1);
}
.ur-type-modal__option:hover {
  border-color: var(--white);
  transform: translate(-4px, -4px);
  box-shadow: 8px 8px 0 rgba(255,255,255,0.15);
  background: rgba(255,255,255,0.03);
}
.ur-type-modal__icon {
  width: 48px;
  height: 48px;
  border: 2px solid var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
  font-size: 20px;
  transition: background 0.2s, transform 0.2s;
}
.ur-type-modal__option:hover .ur-type-modal__icon {
  background: var(--white);
  color: var(--bg-black);
  transform: rotate(-6deg);
}
.ur-type-modal__option:hover .ur-type-modal__icon i { color: var(--bg-black); }
.ur-type-modal__option h4 {
  font-family: var(--font-display);
  font-size: 26px;
  letter-spacing: 2px;
  margin-bottom: 8px;
}
.ur-type-modal__option p {
  font-family: var(--font-body);
  font-size: 13px;
  color: rgba(255,255,255,0.5);
  line-height: 1.5;
}
.ur-type-modal__option:hover p { color: rgba(255,255,255,0.8); }
.ur-type-modal__close {
  position: absolute;
  top: 16px;
  right: 16px;
  background: none;
  border: 2px solid rgba(255,255,255,0.2);
  color: rgba(255,255,255,0.5);
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 14px;
  transition: all 0.15s;
}
.ur-type-modal__close:hover {
  border-color: var(--white);
  color: var(--white);
  transform: rotate(90deg);
}
</style>
@endsection

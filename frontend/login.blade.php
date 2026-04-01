@extends('frontend.layout')
@section('pageHeading')
  {{ __('Login') }}
@endsection

@section('hero-section')
<style>
  .header-area, .header, header, .ur-header { display: none !important; }
  .footer-section { display: none !important; }
</style>

<section class="ur-login">
  <div class="ur-login__left">
    <div class="ur-login__slideshow">
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&q=80&w=1600');"></div>
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&q=80&w=1600'); animation-delay: 5s;"></div>
      <div class="ur-login__slide" style="background-image: url('https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?auto=format&fit=crop&q=80&w=1600'); animation-delay: 10s;"></div>
    </div>
    <div class="ur-login__left-overlay"></div>
    <div class="ur-login__left-content">
      <a href="{{ route('index') }}" class="ur-login__brand">
        <div class="ur-landing__right-brand" style="transform: rotate(-4deg); font-size: 28px;">
          <span class="ur-landing__right-brand-ur" style="font-size: 32px;">UR</span><span class="ur-landing__right-brand-reveal">TICKETS</span>
        </div>
      </a>
      <div class="ur-login__left-text">
        <h1 class="ur-login__hero-title">YOUR<br>EVENTS<br>AWAIT</h1>
        <div class="ur-login__hero-line"></div>
        <p class="ur-login__hero-sub">One account. Whether you attend or organize — log in and take control.</p>
      </div>
      <div class="ur-login__left-stats">
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">2.4K</span>
          <span class="ur-login__stat-label">ORGANIZERS</span>
        </div>
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">18K</span>
          <span class="ur-login__stat-label">EVENTS LIVE</span>
        </div>
        <div class="ur-login__stat">
          <span class="ur-login__stat-num">$4.2M</span>
          <span class="ur-login__stat-label">PROCESSED</span>
        </div>
      </div>
    </div>
  </div>

  <div class="ur-login__right">
    <div class="ur-login__right-header">
      <a href="{{ route('index') }}" class="ur-login__back">
        <i class="fas fa-arrow-left"></i> HOME
      </a>
      <a href="{{ route('organizer.signup') }}" class="ur-login__switch">
        NO ACCOUNT? <strong>SIGN UP</strong>
      </a>
    </div>

    <div class="ur-login__form-wrap">
      <div class="ur-login__form-header">
        <span class="ur-login__tag">UNIFIED ACCESS</span>
        <h2 class="ur-login__form-title">LOG<br>IN</h2>
      </div>

      @if (Session::has('success'))
        <div class="ur-login__alert ur-login__alert--success">{{ Session::get('success') }}</div>
      @endif
      @if (Session::has('alert'))
        <div class="ur-login__alert ur-login__alert--error">{{ Session::get('alert') }}</div>
      @endif

      <form id="login-form" action="{{ route('organizer.authentication') }}" method="POST" class="ur-login__form">
        @csrf
        <div class="ur-login__field">
          <label class="ur-login__label">EMAIL OR USERNAME</label>
          <div class="ur-login__input-wrap">
            <input type="text" name="username" id="username" class="ur-login__input" placeholder="Enter your email or username" autocomplete="username">
            <div class="ur-login__input-icon"><i class="fas fa-user"></i></div>
          </div>
          @error('username')
            <p class="ur-login__error">{{ $message }}</p>
          @enderror
        </div>

        <div class="ur-login__field">
          <label class="ur-login__label">PASSWORD</label>
          <div class="ur-login__input-wrap">
            <input type="password" name="password" id="password" class="ur-login__input" placeholder="Enter your password" autocomplete="current-password">
            <div class="ur-login__input-icon"><i class="fas fa-lock"></i></div>
          </div>
          @error('password')
            <p class="ur-login__error">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="ur-login__submit">
          <span class="ur-login__submit-text">ENTER</span>
          <span class="ur-login__submit-arrow"><i class="fas fa-arrow-right"></i></span>
        </button>

        <div class="ur-login__links">
          <a href="{{ route('organizer.forget.password') }}" class="ur-login__link">FORGOT PASSWORD?</a>
        </div>

        <div class="ur-login__divider">
          <span>OR</span>
        </div>

        <a href="#" class="ur-login__social ur-login__social--facebook">
          <i class="fab fa-facebook-f"></i> CONTINUE WITH FACEBOOK
        </a>
      </form>
    </div>

    <div class="ur-login__right-footer">
      <p>&copy; {{ date('Y') }} URTICKETS. ALL RIGHTS RESERVED.</p>
    </div>
  </div>
</section>
@endsection

@section('content')
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var fields = document.querySelectorAll('.ur-login__field');
  fields.forEach(function(field, i) {
    field.style.opacity = '0';
    field.style.transform = 'translateX(40px)';
    field.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
    field.style.transitionDelay = (0.15 + i * 0.1) + 's';
    setTimeout(function() {
      field.style.opacity = '1';
      field.style.transform = 'translateX(0)';
    }, 50);
  });

  var title = document.querySelector('.ur-login__form-title');
  if (title) {
    title.style.opacity = '0';
    title.style.transform = 'scale(1.5) rotate(-5deg)';
    title.style.transition = 'all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
    setTimeout(function() {
      title.style.opacity = '1';
      title.style.transform = 'scale(1) rotate(0deg)';
    }, 100);
  }

  var submit = document.querySelector('.ur-login__submit');
  if (submit) {
    submit.addEventListener('mouseenter', function() {
      this.style.animation = 'glitchFlash 0.2s ease';
      var self = this;
      setTimeout(function() { self.style.animation = ''; }, 200);
    });
  }

  document.querySelectorAll('.ur-login__input').forEach(function(input) {
    input.addEventListener('focus', function() {
      this.parentElement.classList.add('is-focused');
    });
    input.addEventListener('blur', function() {
      this.parentElement.classList.remove('is-focused');
    });
  });
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
  background: linear-gradient(180deg,
    rgba(5,5,5,0.3) 0%,
    rgba(5,5,5,0.1) 40%,
    rgba(5,5,5,0.6) 70%,
    rgba(5,5,5,0.95) 100%
  );
  z-index: 1;
}
.ur-login__left-content {
  position: relative;
  z-index: 2;
  padding: 40px 48px;
  display: flex;
  flex-direction: column;
  height: 100%;
}
.ur-login__brand {
  text-decoration: none;
  display: inline-block;
  margin-bottom: auto;
}
.ur-login__left-text { margin-bottom: 48px; }
.ur-login__hero-title {
  font-family: var(--font-display);
  font-size: clamp(60px, 8vw, 110px);
  line-height: 0.88;
  color: var(--white);
  letter-spacing: -1px;
  margin-bottom: 16px;
}
.ur-login__hero-line {
  width: 120px;
  height: 6px;
  background: var(--white);
  margin-bottom: 20px;
}
.ur-login__hero-sub {
  font-family: var(--font-body);
  font-size: 16px;
  color: rgba(255,255,255,0.6);
  max-width: 380px;
  line-height: 1.5;
}
.ur-login__left-stats {
  display: flex;
  gap: 40px;
  padding-top: 32px;
  border-top: 1px solid rgba(255,255,255,0.12);
}
.ur-login__stat-num {
  font-family: var(--font-display);
  font-size: 32px;
  color: var(--white);
  display: block;
  line-height: 1;
  letter-spacing: 1px;
}
.ur-login__stat-label {
  font-family: var(--font-display);
  font-size: 11px;
  color: rgba(255,255,255,0.4);
  letter-spacing: 2px;
  display: block;
  margin-top: 4px;
}

.ur-login__right {
  flex: 0 0 480px;
  max-width: 480px;
  background: var(--bg-black);
  border-left: 3px solid var(--white);
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.ur-login__right-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 36px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}
.ur-login__back {
  font-family: var(--font-display);
  font-size: 14px;
  color: rgba(255,255,255,0.5);
  letter-spacing: 2px;
  transition: color 0.2s;
}
.ur-login__back:hover { color: var(--white); }
.ur-login__back i { margin-right: 6px; }
.ur-login__switch {
  font-family: var(--font-body);
  font-size: 12px;
  color: rgba(255,255,255,0.5);
  letter-spacing: 0.5px;
  transition: color 0.2s;
}
.ur-login__switch:hover { color: var(--white); }
.ur-login__switch strong {
  color: var(--white);
  border-bottom: 2px solid var(--white);
  padding-bottom: 1px;
}

.ur-login__form-wrap {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 48px 36px;
}
.ur-login__form-header { margin-bottom: 40px; }
.ur-login__tag {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 3px;
  color: var(--bg-black);
  background: var(--white);
  padding: 4px 12px;
  display: inline-block;
  margin-bottom: 16px;
}
.ur-login__form-title {
  font-family: var(--font-display);
  font-size: 80px;
  line-height: 0.85;
  color: var(--white);
  letter-spacing: 2px;
}

.ur-login__alert {
  padding: 12px 16px;
  margin-bottom: 20px;
  font-family: var(--font-body);
  font-size: 14px;
  font-weight: 600;
  border: 3px solid;
}
.ur-login__alert--success { border-color: #22c55e; color: #22c55e; background: rgba(34,197,94,0.06); }
.ur-login__alert--error { border-color: #ef4444; color: #ef4444; background: rgba(239,68,68,0.06); }

.ur-login__form { display: flex; flex-direction: column; gap: 24px; }
.ur-login__label {
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.5);
  display: block;
  margin-bottom: 8px;
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
  width: 100%;
  background: transparent;
  border: none;
  outline: none;
  color: var(--white);
  font-family: var(--font-body);
  font-size: 16px;
  font-weight: 500;
  padding: 16px 48px 16px 16px;
  letter-spacing: 0.5px;
}
.ur-login__input::placeholder { color: rgba(255,255,255,0.2); }
.ur-login__input-icon {
  position: absolute;
  right: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: rgba(255,255,255,0.15);
  font-size: 16px;
  transition: color 0.2s;
}
.ur-login__input-wrap.is-focused .ur-login__input-icon { color: var(--white); }
.ur-login__error {
  font-family: var(--font-body);
  font-size: 13px;
  color: #ef4444;
  margin-top: 6px;
  font-weight: 600;
}

.ur-login__submit {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 18px 24px;
  background: var(--white);
  color: var(--bg-black);
  border: 4px solid var(--white);
  font-family: var(--font-display);
  font-size: 22px;
  letter-spacing: 4px;
  cursor: pointer;
  transition: all 0.15s cubic-bezier(0.25, 1, 0.5, 1);
  box-shadow: 6px 6px 0 rgba(255,255,255,0.15);
  margin-top: 8px;
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

.ur-login__links { text-align: center; margin-top: 4px; }
.ur-login__link {
  font-family: var(--font-display);
  font-size: 13px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.35);
  transition: color 0.2s;
}
.ur-login__link:hover { color: var(--white); }

/* DIVIDER */
.ur-login__divider {
  display: flex;
  align-items: center;
  gap: 16px;
}
.ur-login__divider::before,
.ur-login__divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(255,255,255,0.1);
}
.ur-login__divider span {
  font-family: var(--font-display);
  font-size: 12px;
  letter-spacing: 3px;
  color: rgba(255,255,255,0.25);
}

/* SOCIAL LOGIN */
.ur-login__social {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  width: 100%;
  padding: 16px 24px;
  font-family: var(--font-display);
  font-size: 14px;
  letter-spacing: 2px;
  border: 3px solid;
  cursor: pointer;
  transition: all 0.15s cubic-bezier(0.25, 1, 0.5, 1);
  text-decoration: none;
}
.ur-login__social i { font-size: 16px; }
.ur-login__social--facebook {
  border-color: #1877F2;
  color: #1877F2;
  background: transparent;
}
.ur-login__social--facebook:hover {
  background: #1877F2;
  color: var(--white);
  transform: translate(-2px, -2px);
  box-shadow: 6px 6px 0 rgba(24,119,242,0.25);
}

.ur-login__right-footer {
  padding: 16px 36px;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.ur-login__right-footer p {
  font-family: var(--font-display);
  font-size: 11px;
  letter-spacing: 2px;
  color: rgba(255,255,255,0.2);
  margin: 0;
}

@media (max-width: 900px) {
  .ur-login { flex-direction: column; }
  .ur-login__left { min-height: 40vh; flex: none; }
  .ur-login__right { flex: none; max-width: 100%; border-left: none; border-top: 3px solid var(--white); min-height: auto; }
  .ur-login__hero-title { font-size: 56px; }
  .ur-login__form-title { font-size: 60px; }
  .ur-login__left-stats { gap: 24px; }
}
@media (max-width: 480px) {
  .ur-login__form-wrap { padding: 32px 24px; }
  .ur-login__right-header { padding: 16px 24px; }
  .ur-login__left-content { padding: 32px 24px; }
}
</style>
@endsection

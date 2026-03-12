@extends('frontend.layout')
@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->customer_login_page_title ?? __('Customer Login') }}
  @else
    {{ __('Customer Login') }}
  @endif
@endsection
@php
  $metaKeywords = !empty($seo->meta_keyword_customer_login) ? $seo->meta_keyword_customer_login : '';
  $metaDescription = !empty($seo->meta_description_customer_login) ? $seo->meta_description_customer_login : '';
@endphp
@section('meta-keywords', "{{ $metaKeywords }}")
@section('meta-description', "$metaDescription")

@section('hero-section')
  <!-- Page Banner Start -->
  <section class="page-banner overlay pt-120 pb-125 rpt-90 rpb-95 lazy"
    data-bg="{{ asset('assets/admin/img/' . $basicInfo->breadcrumb) }}">
    <div class="container">
      <div class="banner-inner">
        <h2 class="page-title">
          @if (!empty($pageHeading))
            {{ $pageHeading->customer_login_page_title ?? __('Customer Login') }}
          @else
            {{ __('Customer Login') }}
          @endif
        </h2>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">
              @if (!empty($pageHeading))
                {{ $pageHeading->customer_login_page_title ?? __('Customer Login') }}
              @else
                {{ __('Customer Login') }}
              @endif
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </section>
  <!-- Page Banner End -->
@endsection
@section('content')
  <!-- LogIn Area Start -->
  <div class="login-area pt-115 rpt-95 pb-120 rpb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="login-form-wrapper mx-auto">

          @php
            $input = request()->input('redirected');
          @endphp
          @if (!onlyDigitalItemsInCart())
            @if ($input == 'checkout')
              <div class="form-group w-100">
                <a href="{{ route('shop.checkout', ['type' => 'guest']) }}"
                  class="btn btn-success d-block">{{ __('Checkout as Guest') }}</a>
              </div>
            @endif
          @endif

          @php
            $event_setting = App\Models\BasicSettings\Basic::select('event_guest_checkout_status')->first();
          @endphp
          @if ($event_setting->event_guest_checkout_status == 1)
            @if (request()->input('redirectPath') == 'event_checkout')
              <div class="form-group w-100">
                <a href="{{ route('check-out', ['type' => 'guest']) }}"
                  class="btn btn-success d-block">{{ __('Checkout as Guest') }}</a>
              </div>
            @endif
          @endif


          <form id="login-form" name="login_form" class="login-form" action="{{ route('customer.authentication') }}"
            method="POST">
            @csrf


            @if (Session::has('success'))
              <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('alert'))
              <div class="alert alert-danger">{{ Session::get('alert') }}</div>
            @endif

            <div class="form-group">
              <label for="username">{{ __('Username') . ' *' }} </label>
              <input type="text" placeholder="{{ __('Enter Your Username') }}" name="username" id="username"
                value="" class="form-control">
              @error('username')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">{{ __('Password') . ' *' }}</label>
              <div class="input-group" id="show_hide_password">
                <input type="password" name="password" value="" id="password" class="form-control"
                  placeholder="{{ __('Enter Password') }}">
                <div class="input-group-append">
                  <span class="input-group-text" style="cursor:pointer;">
                    <i class="fa fa-eye" id="togglePassword"></i>
                  </span>
                </div>
              </div>
              @error('password')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            @if ($basicInfo->google_recaptcha_status == 1)
              <div class="form-group">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
                @error('g-recaptcha-response')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            @endif

            <div class="form-group mb-0">
              <button class="theme-btn br-30 w-100" type="submit"
                data-loading-text="Please wait...">{{ __('Login') }}</button>
            </div>

            @if ($basicInfo->facebook_login_status == 1 || $basicInfo->google_login_status == 1)
              <div class="form-group overflow-hidden text-center my-4">
                <div class="d-flex justify-content-center gap-3">
                  @if ($basicInfo->facebook_login_status == 1)
                    <a class="social-login-btn bg-facebook d-flex align-items-center justify-content-center mx-2"
                      href="{{ route('auth.facebook', ['redirectPath' => request()->input('redirectPath')]) }}">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  @endif
                  @if ($basicInfo->google_login_status == 1)
                    <a class="social-login-btn bg-google d-flex align-items-center justify-content-center mx-2"
                      href="{{ route('auth.google', ['redirectPath' => request()->input('redirectPath')]) }}">
                      <i class="fab fa-google"></i>
                    </a>
                  @endif
                </div>
              </div>
            @endif

            <div class="form-group mt-3 mb-0 text-center">
              <p>
                {{ __('Don`t have an account') . '?' }}
                <a class="text-info" href="{{ route('customer.signup') }}">{{ __('Signup Now') }}</a>
              </p>
              <p class="mt-2">
                <a href="{{ route('customer.forget.password') }}">{{ __('Lost your password') . '?' }}</a>
              </p>
            </div>
          </form>
          <script>
            document.addEventListener('DOMContentLoaded', function () {
              const togglePassword = document.getElementById('togglePassword');
              const passwordInput = document.getElementById('password');
              if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function () {
                  const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                  passwordInput.setAttribute('type', type);
                  this.classList.toggle('fa-eye');
                  this.classList.toggle('fa-eye-slash');
                });
              }
            });
          </script>
        </div>
      </div>
    </div>
  </div>
  <style>
    .social-login-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 8px;
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: transform 0.15s, box-shadow 0.15s;
        border: none;
    }
    .social-login-btn:hover, .social-login-btn:focus {
        transform: scale(1.08);
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        text-decoration: none;
    }
    .bg-facebook { background: #3b5998 !important; }
    .bg-google { background: #db4437 !important; }
  </style>
  <!-- LogIn Area End -->
@endsection

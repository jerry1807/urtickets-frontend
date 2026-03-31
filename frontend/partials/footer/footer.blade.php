<footer class="footer-section" style="background: var(--bg-black); border-top: 10px solid var(--white);">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5 col-sm-6">
        <div class="footer-widget about-widget">
          <div class="footer-logo" style="margin-bottom: 24px;">
            <a href="{{ route('index') }}" style="text-decoration:none; display: inline-block;">
              <div class="ur-landing__right-brand" style="transform: rotate(2deg); margin-bottom: 16px;">
                <span class="ur-landing__right-brand-ur">UR</span><span class="ur-landing__right-brand-reveal">TICKETS</span>
              </div>
            </a>
          </div>
          <p style="color:var(--gray);font-size:14px;clear:both;">{!! $footerInfo ? $footerInfo->about_company : '' !!}</p>
          <div class="social-style-one mt-30">
            @if (count($socialMediaInfos) > 0)
              @foreach ($socialMediaInfos as $socialMediaInfo)
                <a href="{{ $socialMediaInfo->url }}"><i class="{{ $socialMediaInfo->icon }}"></i></a>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="footer-widget link-widget ml-sm-auto">
          <h5 class="footer-title">{{ __('Quick Links') }}</h5>
          <ul>
            @foreach ($quickLinkInfos as $quickLinkInfo)
              <li><a href="{{ $quickLinkInfo->url }}">{{ $quickLinkInfo->title }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="footer-widget about-widget ml-sm-auto">
          <h5 class="footer-title">{{ __('Contact Us') }}</h5>
          @if (!is_null($bex))
            @php $addresses = explode(PHP_EOL, $bex->contact_addresses); @endphp
            <p class="ip"><i class="fas fa-map-marker-alt"></i>
              @foreach ($addresses as $address)
                {{ $address }}@if (!$loop->last) | @endif
              @endforeach
            </p>
            @php $mails = explode(',', $bex->contact_mails); @endphp
            <p class="ip"><i class="fas fa-envelope"></i>
              @foreach ($mails as $mail)
                <a href="mailto:{{ $mail }}">{{ $mail }}</a>@if (!$loop->last), @endif
              @endforeach
            </p>
            @php $phones = explode(',', $bex->contact_numbers); @endphp
            <p class="ip"><i class="fas fa-mobile-alt"></i>
              @foreach ($phones as $phone)
                <a href="tel:{{ $phone }}">{{ $phone }}</a>@if (!$loop->last), @endif
              @endforeach
            </p>
          @endif
        </div>
      </div>
    </div>
    <div class="copyright-area">
      @php
        $date = Date('Y');
        if (!empty($footerInfo->copyright_text)) {
            $footer_text = str_replace('{year}', $date, $footerInfo->copyright_text);
        }
      @endphp
      <p>{!! !empty($footerInfo->copyright_text) ? $footer_text : '' !!}</p>
    </div>
  </div>
</footer>

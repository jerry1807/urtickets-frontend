@extends('frontend.layout')
@section('pageHeading')
  {{ __('Home') }}
@endsection

@php
  $metaKeywords = !empty($seo->meta_keyword_home) ? $seo->meta_keyword_home : '';
  $metaDescription = !empty($seo->meta_description_home) ? $seo->meta_description_home : '';
@endphp
@section('meta-keywords', "{{ $metaKeywords }}")
@section('meta-description', "$metaDescription")

@section('hero-section')
  <style>
    .header-area, .header, header, .ur-header { display: none !important; }
  </style>
  <section class="ur-landing">
    <div class="ur-landing__left">
      <div class="ur-slideshow">
        <div class="ur-slideshow-img" style="background-image: url('https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&q=80&w=2000'); animation-delay: 0s;"></div>
        <div class="ur-slideshow-img" style="background-image: url('https://images.unsplash.com/photo-1540039155732-6847350257fd?auto=format&fit=crop&q=80&w=2000'); animation-delay: 4.5s;"></div>
        <div class="ur-slideshow-img" style="background-image: url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80&w=2000'); animation-delay: 9s;"></div>
        <div class="ur-slideshow-img" style="background-image: url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=2000'); animation-delay: 13.5s;"></div>
      </div>
      <div class="ur-landing__chrome-overlay"></div>

      <div class="ur-landing__left-content">
        <div class="ur-landing__typography">
           <div class="ur-landing__line">
             <span class="ur-landing__brand-block">
               <span class="ur-landing__brand-ur">UR</span><span class="ur-landing__brand-tickets">TICKETS</span>
             </span>
           </div>
           <div class="ur-landing__line">
             <span class="ur-landing__text-block">FIND YOUR</span>
           </div>
           <div class="ur-landing__line">
             <span class="ur-landing__text-block ur-landing__text-block--last">NEXT EVENT</span>
           </div>
        </div>
      </div>
    </div>

    <div class="ur-landing__right">
      <div class="ur-landing__right-header">
        <div class="ur-landing__right-brand">
          <span class="ur-landing__right-brand-ur">UR</span><span class="ur-landing__right-brand-reveal">TICKETS</span>
        </div>
        <nav class="ur-hero-nav">
          <a href="{{ url('/') }}" class="ur-nav-link">HOME</a>
          <a href="{{ url('/events') }}" class="ur-nav-link">EVENTS</a>
          <a href="{{ url('/organizers') }}" class="ur-nav-link">ORGANIZERS</a>
          <a href="{{ url('/shop') }}" class="ur-nav-link">SHOP</a>
          <a href="{{ url('/about') }}" class="ur-nav-link">ABOUT</a>
          <a href="{{ url('/blog') }}" class="ur-nav-link">BLOG</a>
          <a href="{{ url('/contact') }}" class="ur-nav-link">CONTACT</a>
          <a href="{{ url('/login') }}" class="ur-nav-link ur-nav-link--accent">LOGIN</a>
          <a href="{{ url('/signup') }}" class="ur-nav-link ur-nav-link--accent">SIGN UP</a>
        </nav>
      </div>

      <div class="ur-landing__right-inner">
        <div class="ur-search">
          <form action="{{ route('events') }}" method="get" class="ur-search__form">
            <input type="text" name="search-input" placeholder="SEARCH EVENTS..." class="ur-search__input">
            <button type="submit" class="ur-search__btn"><i class="fas fa-search"></i></button>
          </form>
        </div>

        <div class="ur-tags">
          @foreach ($categories as $category)
            <a href="{{ route('events', ['category' => $category->slug]) }}" class="ur-tag">{{ strtoupper($category->name) }}</a>
          @endforeach
        </div>

        <div class="ur-cards-grid">
          @if (!empty($featuredEvents))
            @php
              $cardBgs = [
                'https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?auto=format&fit=crop&q=80&w=600',
                'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&q=80&w=600',
                'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&q=80&w=600',
                'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&q=80&w=600'
              ];
            @endphp
            @foreach ($featuredEvents->take(4) as $index => $event)
              <div class="ur-card scribble-box">
                <div class="ur-card__cart"><i class="fas fa-shopping-cart"></i><span>SEE MORE</span></div>
                <div class="ur-card-bg" style="background-image: url('{{ $cardBgs[$index % 4] }}')"></div>
                <div class="ur-card__date" style="margin-bottom:auto">
                  <div style="font-family:var(--font-display);color:var(--cyan);letter-spacing:1px;font-size:11px">APRIL</div>
                  <div style="font-family:var(--font-display);color:var(--white);font-size:24px;line-height:1">12</div>
                </div>
                <div class="ur-card__content">
                  <h3 class="ur-card__title">{{ $event->title }}</h3>
                  <p class="ur-card__venue">{{ $event->venue }}</p>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  @if (!empty($secInfo) && $secInfo->about_section_status == 1)
    <section class="ur-bottom-section ur-brutalist-about bg-black text-cyan">
      <div class="ur-container">
        <div class="ur-about-grid ur-about-grid--chaos">
          <div class="ur-about-left ur-glitch-border ur-reveal">
            <h2 class="ur-huge-title">{{ $aboutUsSection->title ?? 'ABOUT URTICKETS' }}</h2>
            <div class="ur-about-text ur-tape-bg">{!! $aboutUsSection->text ?? '' !!}</div>
          </div>
          <div class="ur-about-right ur-noise-panel ur-reveal" style="transition-delay: 0.15s;">
             <h2 class="ur-huge-title text-cyan ur-rotated-title">{{ $howWork->title ?? 'HOW IT WORKS' }}</h2>
             <div class="ur-how-grid ur-how-grid--chaos">
               @if (!empty($howWorkItems))
                 @foreach ($howWorkItems as $i => $item)
                   <div class="ur-how-item ur-how-item--brutal ur-reveal" style="transition-delay: {{ 0.1 * $i }}s;">
                     <span class="ur-how-num-oversized">{{ $item->serial_number }}</span>
                     <div class="ur-how-content">
                       <h4 class="ur-how-title">{{ strtoupper($item->title) }}</h4>
                       <p class="ur-how-desc">{{ $item->text }}</p>
                     </div>
                   </div>
                 @endforeach
               @endif
             </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  @if (!empty($secInfo) && $secInfo->features_section_status == 1)
    <section class="ur-bottom-section ur-power-section text-black">
      <div class="ur-power-marquee">
        <span>NEXT GEN TICKETING /// NFT SECURED /// FIAT ONRAMP /// MOBILE ECOSYSTEM /// NEXT GEN TICKETING /// NFT SECURED /// FIAT ONRAMP /// MOBILE ECOSYSTEM /// </span>
      </div>

      <div class="ur-container ur-power-container">
        <h2 class="ur-power-main-title ur-reveal--stamp">PLATFORM<br>POWER</h2>

        <div class="ur-power-cards">
          <div class="ur-power-card ur-power-3d ur-reveal" style="transition-delay: 0s;">
            <div class="ur-power-card-inner">
              <div class="ur-power-card-icon-float"><i class="fab fa-stripe"></i></div>
              <div class="ur-power-card-header">
                <span class="ur-power-tag">PAYMENTS</span>
              </div>
              <h3 class="ur-power-title">SECURE FIAT ONRAMP</h3>
              <p class="ur-power-desc">Multi-gateway checkout with Stripe, PayPal, and local payment methods. PCI-DSS compliant with instant organizer payouts and real-time revenue dashboards.</p>
              <ul class="ur-power-features">
                <li><i class="fas fa-check"></i> Multi-currency support</li>
                <li><i class="fas fa-check"></i> Instant organizer payouts</li>
                <li><i class="fas fa-check"></i> Fraud detection built-in</li>
              </ul>
            </div>
          </div>

          <div class="ur-power-card ur-power-3d ur-reveal" style="transition-delay: 0.12s;">
            <div class="ur-power-card-inner">
              <div class="ur-power-card-icon-float"><i class="fab fa-ethereum"></i></div>
              <div class="ur-power-card-header">
                <span class="ur-power-tag">WEB3</span>
              </div>
              <h3 class="ur-power-title">NFT TICKETING</h3>
              <p class="ur-power-desc">Blockchain-verified tickets on Polygon. Zero scalping through smart contract enforcement. Collectible NFT stubs as event memorabilia for attendees.</p>
              <ul class="ur-power-features">
                <li><i class="fas fa-check"></i> Polygon smart contracts</li>
                <li><i class="fas fa-check"></i> Anti-scalp enforcement</li>
                <li><i class="fas fa-check"></i> Collectible NFT stubs</li>
              </ul>
            </div>
          </div>

          <div class="ur-power-card ur-power-3d ur-reveal" style="transition-delay: 0.24s;">
            <div class="ur-power-card-inner">
              <div class="ur-power-card-icon-float"><i class="fas fa-mobile-alt"></i></div>
              <div class="ur-power-card-header">
                <span class="ur-power-tag">ECOSYSTEM</span>
              </div>
              <h3 class="ur-power-title">SCAN & GO MOBILE</h3>
              <p class="ur-power-desc">Native iOS and Android apps for attendees and organizers. QR gate verification, live event analytics, push notifications, and offline ticket validation.</p>
              <ul class="ur-power-features">
                <li><i class="fas fa-check"></i> Offline QR validation</li>
                <li><i class="fas fa-check"></i> Live analytics dashboard</li>
                <li><i class="fas fa-check"></i> Push notifications</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  {{-- ANALYTICS SECTION --}}
  <section class="ur-analytics-section">
    <div class="ur-analytics__canvas-wrap">
      <canvas id="analyticsCanvas"></canvas>
      <div class="ur-analytics__scanline"></div>
    </div>
    <div class="ur-analytics__content">
      <div class="ur-container">
        <div class="ur-analytics__header ur-reveal">
          <span class="ur-power-tag" style="font-size:16px; margin-bottom: 16px; display: inline-block;">ANALYTICS ENGINE</span>
          <h2 class="ur-analytics__title">WORLD-CLASS<br>DATA FOR<br>ORGANIZERS</h2>
          <p class="ur-analytics__subtitle">Real-time intelligence. Every ticket, every scan, every dollar - visualized in milliseconds.</p>
        </div>

        <div class="ur-analytics__grid">
          <div class="ur-analytics__stat-card ur-reveal" style="transition-delay: 0s;">
            <div class="ur-analytics__stat-number" data-count="847">0</div>
            <div class="ur-analytics__stat-bar"><div class="ur-analytics__stat-fill" style="--fill-width: 84%;"></div></div>
            <div class="ur-analytics__stat-label">TICKETS SOLD TODAY</div>
          </div>
          <div class="ur-analytics__stat-card ur-reveal" style="transition-delay: 0.08s;">
            <div class="ur-analytics__stat-number" data-count="96">0</div>
            <div class="ur-analytics__stat-bar"><div class="ur-analytics__stat-fill" style="--fill-width: 96%;"></div></div>
            <div class="ur-analytics__stat-label">GATE SCAN RATE %</div>
          </div>
          <div class="ur-analytics__stat-card ur-reveal" style="transition-delay: 0.16s;">
            <div class="ur-analytics__stat-number ur-analytics__stat-number--money" data-count="42850">0</div>
            <div class="ur-analytics__stat-bar"><div class="ur-analytics__stat-fill" style="--fill-width: 71%;"></div></div>
            <div class="ur-analytics__stat-label">REVENUE PROCESSED</div>
          </div>
          <div class="ur-analytics__stat-card ur-reveal" style="transition-delay: 0.24s;">
            <div class="ur-analytics__stat-number" data-count="12">0</div>
            <div class="ur-analytics__stat-bar"><div class="ur-analytics__stat-fill" style="--fill-width: 40%;"></div></div>
            <div class="ur-analytics__stat-label">LIVE EVENTS NOW</div>
          </div>
        </div>

        <div class="ur-analytics__features">
          <div class="ur-analytics__feature ur-reveal" style="transition-delay: 0s;">
            <div class="ur-analytics__feature-icon"><i class="fas fa-chart-line"></i></div>
            <h4>REAL-TIME DASHBOARDS</h4>
            <p>Live ticket sales, revenue curves, and attendee flow. Sub-second refresh with WebSocket streaming. Export to CSV, PDF, or API.</p>
          </div>
          <div class="ur-analytics__feature ur-reveal" style="transition-delay: 0.1s;">
            <div class="ur-analytics__feature-icon"><i class="fas fa-map-marked-alt"></i></div>
            <h4>GEO HEATMAPS</h4>
            <p>See where your attendees come from. Heatmap visualization of ticket purchases by region. Target marketing with precision.</p>
          </div>
          <div class="ur-analytics__feature ur-reveal" style="transition-delay: 0.2s;">
            <div class="ur-analytics__feature-icon"><i class="fas fa-brain"></i></div>
            <h4>PREDICTIVE SELLOUT</h4>
            <p>ML-powered demand forecasting. Know when you'll sell out before it happens. Dynamic pricing recommendations in real-time.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if (!empty($secInfo) && $secInfo->testimonials_section_status == 1)
    <section class="ur-bottom-section bg-black" style="border-top: 10px solid var(--cyan);">
      <div class="ur-container">
        <h2 class="ur-bottom-title ur-reveal--stamp" style="color: var(--white);">{{ strtoupper($testimonialData->title ?? 'What Our Clients Say') }}</h2>
        <div class="ur-testimonials-grid">
          @if (!empty($testimonials))
            @foreach ($testimonials as $i => $testimonial)
              <div class="ur-testimonial-card ur-border-box ur-reveal" style="transition-delay: {{ 0.08 * $i }}s;">
                <p class="ur-testimonial-comment">"{{ $testimonial->comment }}"</p>
                <div class="ur-testimonial-author">
                  <h5 class="ur-testimonial-name">{{ strtoupper($testimonial->name) }}</h5>
                  <span class="ur-testimonial-role">{{ strtoupper($testimonial->occupation) }}</span>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </section>
  @endif
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Hero entrance
    document.querySelectorAll('.ur-card, .ur-tag').forEach(function(el, i) {
      el.style.animationDelay = (i * 0.06) + 's';
      el.classList.add('ur-fade-in');
    });

    // Scroll reveals
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.05, rootMargin: "0px 0px -20px 0px" });
    document.querySelectorAll('.ur-reveal, .ur-reveal--stamp').forEach(function(el) { observer.observe(el); });

    // Glitch hover
    document.querySelectorAll('.ur-how-item--brutal, .ur-power-card').forEach(function(el) {
      el.addEventListener('mouseenter', function() {
        this.style.animation = 'glitchFlash 0.25s ease';
        var s = this; setTimeout(function() { s.style.animation = ''; }, 250);
      });
    });

    // Stat counter animation
    var counterObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var target = parseInt(el.getAttribute('data-count'));
          var isMoney = el.classList.contains('ur-analytics__stat-number--money');
          var duration = 2000;
          var start = performance.now();
          function tick(now) {
            var t = Math.min((now - start) / duration, 1);
            var ease = 1 - Math.pow(1 - t, 4);
            var val = Math.floor(ease * target);
            el.textContent = isMoney ? '$' + val.toLocaleString() : val.toLocaleString();
            if (t < 1) requestAnimationFrame(tick);
          }
          requestAnimationFrame(tick);
          counterObserver.unobserve(el);
        }
      });
    }, { threshold: 0.3 });
    document.querySelectorAll('[data-count]').forEach(function(el) { counterObserver.observe(el); });

    // Stat bar fill animation
    var barObserver = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.style.width = entry.target.style.getPropertyValue('--fill-width');
          barObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });
    document.querySelectorAll('.ur-analytics__stat-fill').forEach(function(el) { barObserver.observe(el); });

    // THREE.JS ANALYTICS SCENE
    var canvas = document.getElementById('analyticsCanvas');
    if (canvas && typeof THREE !== 'undefined') {
      var scene = new THREE.Scene();
      var camera = new THREE.PerspectiveCamera(60, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
      var renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
      renderer.setSize(canvas.clientWidth, canvas.clientHeight);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      // Grid floor
      var gridHelper = new THREE.GridHelper(40, 40, 0x00e5ff, 0x1a1a2e);
      gridHelper.position.y = -4;
      gridHelper.material.opacity = 0.3;
      gridHelper.material.transparent = true;
      scene.add(gridHelper);

      // Animated bar chart
      var bars = [];
      var barData = [5, 8, 3, 7, 9, 4, 6, 8, 5, 7, 10, 6, 8, 4, 9, 7];
      barData.forEach(function(h, i) {
        var geo = new THREE.BoxGeometry(0.6, h * 0.5, 0.6);
        var mat = new THREE.MeshBasicMaterial({
          color: i % 3 === 0 ? 0x00e5ff : 0xffffff,
          transparent: true,
          opacity: 0.7,
          wireframe: true
        });
        var mesh = new THREE.Mesh(geo, mat);
        mesh.position.set((i - 8) * 1.1, h * 0.25 - 4, 0);
        mesh.userData = { baseHeight: h, phase: i * 0.4 };
        scene.add(mesh);
        bars.push(mesh);
      });

      // Floating data particles
      var particleGeo = new THREE.BufferGeometry();
      var pCount = 200;
      var positions = new Float32Array(pCount * 3);
      for (var i = 0; i < pCount * 3; i += 3) {
        positions[i] = (Math.random() - 0.5) * 30;
        positions[i + 1] = Math.random() * 15 - 4;
        positions[i + 2] = (Math.random() - 0.5) * 20;
      }
      particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
      var particleMat = new THREE.PointsMaterial({ color: 0x00e5ff, size: 0.08, transparent: true, opacity: 0.6 });
      var particles = new THREE.Points(particleGeo, particleMat);
      scene.add(particles);

      // Orbiting ring
      var ringGeo = new THREE.TorusGeometry(6, 0.05, 8, 64);
      var ringMat = new THREE.MeshBasicMaterial({ color: 0x00e5ff, transparent: true, opacity: 0.4 });
      var ring = new THREE.Mesh(ringGeo, ringMat);
      ring.rotation.x = Math.PI / 2.5;
      ring.position.y = 1;
      scene.add(ring);

      var ring2 = ring.clone();
      ring2.material = ringMat.clone();
      ring2.material.opacity = 0.2;
      ring2.scale.set(1.3, 1.3, 1.3);
      ring2.rotation.x = Math.PI / 3;
      scene.add(ring2);

      camera.position.set(0, 4, 16);
      camera.lookAt(0, 0, 0);

      var mouseX = 0, mouseY = 0;
      document.addEventListener('mousemove', function(e) {
        mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
        mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
      });

      function animate() {
        requestAnimationFrame(animate);
        var t = performance.now() * 0.001;

        bars.forEach(function(bar) {
          var pulse = Math.sin(t * 1.5 + bar.userData.phase) * 0.3;
          var h = (bar.userData.baseHeight + pulse) * 0.5;
          bar.scale.y = Math.max(0.1, h / (bar.userData.baseHeight * 0.5));
        });

        particles.rotation.y = t * 0.05;
        var pos = particles.geometry.attributes.position.array;
        for (var i = 1; i < pos.length; i += 3) {
          pos[i] += Math.sin(t + i) * 0.003;
        }
        particles.geometry.attributes.position.needsUpdate = true;

        ring.rotation.z = t * 0.3;
        ring2.rotation.z = -t * 0.2;
        ring2.rotation.x = Math.PI / 3 + Math.sin(t * 0.5) * 0.1;

        camera.position.x += (mouseX * 3 - camera.position.x) * 0.02;
        camera.position.y += (4 - mouseY * 2 - camera.position.y) * 0.02;
        camera.lookAt(0, 0, 0);

        renderer.render(scene, camera);
      }
      animate();

      window.addEventListener('resize', function() {
        var w = canvas.parentElement.clientWidth;
        var h = canvas.parentElement.clientHeight;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h);
      });
    }
  });
</script>
@endsection

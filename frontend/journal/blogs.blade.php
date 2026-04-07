@extends('frontend.layout')
@section('pageHeading')
  {{ __('Blog') }}
@endsection

@section('hero-section')
<section class="ur-wip__hero">
  <div class="ur-wip__hero-inner">
    <h1 class="ur-wip__hero-title">
      <span class="ur-wip__hero-outline">THE</span>
      <span class="ur-wip__hero-solid">BLOG</span>
    </h1>
  </div>
</section>
@endsection

@section('content')
<section class="ur-wip">
  <div class="ur-wip__box">
    <div class="ur-wip__icon"><i class="fas fa-hard-hat"></i></div>
    <h2 class="ur-wip__title">UNDER CONSTRUCTION</h2>
    <div class="ur-wip__line"></div>
    <p class="ur-wip__text">WE'RE BUILDING SOMETHING WORTH READING. CHECK BACK SOON.</p>
    <a href="{{ route('index') }}" class="ur-wip__btn"><i class="fas fa-arrow-left"></i> BACK HOME</a>
  </div>
</section>
@endsection

@section('custom-style')
<style>
.ur-wip__hero { background: var(--bg-black); border-bottom: 2px solid rgba(255,255,255,0.1); padding: 80px 40px 60px; text-align: center; }
.ur-wip__hero-inner { max-width: 800px; margin: 0 auto; }
.ur-wip__hero-outline { font-family: var(--font-display); font-size: 24px; letter-spacing: 10px; color: rgba(255,255,255,0.3); display: block; line-height: 1; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) both; }
.ur-wip__hero-solid { font-family: var(--font-display); font-size: 72px; letter-spacing: 12px; color: var(--white); display: block; line-height: 1; margin-top: 4px; animation: stampIn 0.8s cubic-bezier(0.25,1,0.5,1) 0.15s both; }

.ur-wip { max-width: 700px; margin: 0 auto; padding: 80px 40px 120px; text-align: center; }
.ur-wip__box { border: 2px solid rgba(255,255,255,0.1); padding: 60px 40px; position: relative; }
.ur-wip__box::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: repeating-linear-gradient(0deg, transparent, transparent 3px, rgba(255,255,255,0.008) 3px, rgba(255,255,255,0.008) 4px); pointer-events: none; }
.ur-wip__icon { font-size: 48px; color: rgba(255,255,255,0.1); margin-bottom: 24px; }
.ur-wip__title { font-family: var(--font-display); font-size: 32px; letter-spacing: 6px; color: var(--white); margin-bottom: 16px; }
.ur-wip__line { width: 60px; height: 2px; background: var(--white); margin: 0 auto 20px; }
.ur-wip__text { font-family: var(--font-display); font-size: 13px; letter-spacing: 3px; color: rgba(255,255,255,0.3); margin-bottom: 32px; }
.ur-wip__btn { font-family: var(--font-display); font-size: 14px; letter-spacing: 2px; padding: 12px 28px; border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.5); transition: all 0.15s; display: inline-block; }
.ur-wip__btn i { margin-right: 8px; }
.ur-wip__btn:hover { border-color: var(--white); color: var(--white); transform: translate(-2px,-2px); box-shadow: 4px 4px 0 rgba(255,255,255,0.1); }

@media (max-width: 768px) { .ur-wip__hero-solid { font-size: 48px; } .ur-wip { padding: 60px 20px 80px; } .ur-wip__box { padding: 40px 24px; } }
</style>
@endsection

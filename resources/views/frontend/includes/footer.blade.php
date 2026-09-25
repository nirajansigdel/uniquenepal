
@php
  $footerPhone = null;
  if ($sitesetting && !empty($sitesetting->office_contact)) {
      $fc = json_decode($sitesetting->office_contact, true);
      $footerPhone = is_array($fc) ? ($fc[0] ?? null) : $sitesetting->office_contact;
  }
  $footerEmail = null;
  if ($sitesetting && !empty($sitesetting->office_email)) {
      $fe = json_decode($sitesetting->office_email, true);
      $footerEmail = is_array($fe) ? ($fe[0] ?? null) : $sitesetting->office_email;
  }
@endphp

<footer class="footer-section">
    <svg class="footer-doodle" viewBox="0 0 1440 400" preserveAspectRatio="none" aria-hidden="true">
        <path d="M-20,120 C 200,40 380,220 620,140 S 1040,20 1250,110 S 1460,260 1500,180" />
        <circle cx="1180" cy="290" r="70" />
    </svg>
    <div class="container position-relative">
        <div class="row text-md-start mb-5">

            <!-- Column 1: Brand + contact -->
            <div class="col-md-4 mb-4 reveal-up" style="--reveal-delay: 100ms;">
                <div class="footer-logo mb-3">
                    <img src="{{ asset('image/logo.avif') }}" alt="Logo">
                </div>
                <p class="footer-tagline">Unique Nepal <span class="script-accent">Adventure</span></p>
                @if($footerPhone)
                    <a href="tel:{{ $footerPhone }}" class="footer-contact-line">{{ $footerPhone }}</a>
                @endif
                @if($footerEmail)
                    <a href="mailto:{{ $footerEmail }}" class="footer-contact-line">{{ $footerEmail }}</a>
                @endif
            </div>

            <!-- Column 2 -->
            <div class="col-md-4 mb-4 reveal-up" style="--reveal-delay: 200ms;">
                <h5>{{ __('messages.about_us') }}</h5>
                <div class="footer-menu">
                    <a href="{{ route('Service') }}">{{ __('messages.services') }}</a>
                    <a href="{{ route('blogs') }}">{{ __('messages.blogs') }}</a>
                    <a href="{{ route('Contact') }}">{{ __('messages.contact_us') }}</a>
                    <a href="{{ route('Gallery') }}">{{ __('messages.gallery') }}</a>
                </div>
            </div>

            <!-- Column 3 (Social Links) -->
            <div class="col-md-4 mb-4 reveal-up" style="--reveal-delay: 300ms;">
                <h5>{{ __('messages.connect') }}</h5>
                <p class="footer-need-help">{{ __('messages.need_help') }}</p>
                <a href="{{ route('Contact') }}" class="btn cta-button mb-3">{{ __('messages.book_now') }}</a>
                <div class="footer-menu">
                    @if($sitesetting && $sitesetting->facebook_link)
                        <a href="{{ $sitesetting->facebook_link }}">Facebook</a>
                    @endif
                    @if($sitesetting && $sitesetting->instagram_link)
                        <a href="{{ $sitesetting->instagram_link }}">Instagram</a>
                    @endif
                    @if($sitesetting && $sitesetting->linkedin_link)
                        <a href="{{ $sitesetting->linkedin_link }}">LinkedIn</a>
                    @endif
                    @if($sitesetting && $sitesetting->snapchat_link)
                        <a href="{{ $sitesetting->snapchat_link }}">Snapchat</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row align-items-center justify-content-between footer-bottom reveal-up" style="--reveal-delay: 400ms;">
            <div class="col-md-8">
                © Unique Nepal Trek And Expedition {{ now()->year }}. {{ __('messages.alright') }}
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const targets = document.querySelectorAll('.reveal-up');
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            targets.forEach(el => observer.observe(el));
        } else {
            targets.forEach(el => el.classList.add('is-visible'));
        }
    });
</script>


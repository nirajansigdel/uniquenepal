

<section class="section-reveal">
  <div class="container-fluid forpadding">
    <div class="container">
    <div class="row g-0 custom-section-height">
      <!-- Left: Full-height image with play button -->
      <div class="col-lg-6 position-relative d-flex align-items-center reveal-left">
        <div class="w-100 h-100 position-relative">
          <img src="{{ asset('image/destin.jpg') }}" alt="Adventure" class="w-100 h-100 object-fit-cover">
          <!-- Play Button -->
          <a href="{{ route('About') }}" class="position-absolute top-50 start-50 translate-middle btn btn-warning rounded-circle d-flex align-items-center justify-content-center play-button shadow">
            <i class="fas fa-play text-white"></i>
          </a>
        </div>
      </div>

      <!-- Right: Full-height text content -->
      <div class="col-lg-6 d-flex flex-column justify-content-center text-white px-5 rightcol reveal-right position-relative">
        <svg class="section-doodle" viewBox="0 0 720 700" preserveAspectRatio="none" aria-hidden="true">
          <path d="M-20,90 C 140,30 220,190 380,120 S 640,20 760,100" />
          <circle cx="620" cy="560" r="70" />
        </svg>
        <span class="heading" style="color: var(--gold-light);">Cinematic Brand Story</span>
        <h2 class="extralarge" style="color: #fff;">{{ __('messages.what_we_do') }}</h2>
        <h3 class="fw-bold mb-3">{{ __('messages.exploring_world_limits') }}</h3>
        <p class="text-light mb-4">
          {{ __('messages.what_we_do_description') }}
        </p>
        <a href="{{ route("About") }}" class="btn cta-button col-md-4">
          {{ __('messages.learn_more') }} <i class="fas fa-arrow-right ms-2"></i>
        </a>
      </div>

    </div>
  </div>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const targets = document.querySelectorAll('.reveal-left, .reveal-right');
    if (!targets.length) return;
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
    // small stagger
    targets.forEach((el, i) => {
      el.style.transitionDelay = (i * 0.08) + 's';
      observer.observe(el);
    });
  });
  </script>

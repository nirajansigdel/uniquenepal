

<style>
  .travel-styles-section {
    position: relative;
    overflow: hidden;
    color: rgba(255, 255, 255, 0.7);
  }
  .travel-styles-section .extralarger {
    color: #fff;
  }
  .travel-styles-section .service-desc {
    color: rgba(255, 255, 255, 0.65) !important;
  }
  .travel-styles-section .feature-title {
    color: rgba(255, 255, 255, 0.85);
  }
  .travel-styles-section .controlwidth .xs-text-des {
    color: rgba(255, 255, 255, 0.75);
  }
</style>

<section class="container-fluid py-5 travel-styles-section section-reveal">
<svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
  <path d="M-20,540 C 240,470 380,640 640,570 S 1060,450 1290,560 S 1470,650 1500,600" />
  <circle cx="180" cy="120" r="65" />
</svg>
<div class="container py-5">
  <div class="row align-items-center justify-content-between">
    <!-- Left Content -->
    <div class="col-lg-6 mb-4 mb-lg-0" data-stagger-root="service-left">
      <p class="heading stagger-up">Travel Styles</p>
      <p class="extralarger mb-3 stagger-up">{{ __('messages.join_adventure_stories') }}</p>
      <p class="service-desc mb-4 stagger-up">
        {{ __('messages.service_description') }}
      </p>

      <!-- Features -->
      <div class="row text-center mb-4">
        <div class="col-4 text-center stagger-up">
          <img src="{{ asset('image/services-1.svg') }}" alt="" class="iconsimg">
          <div class="feature-title mt-1">{{ __('messages.custom_destinations') }}</div>
        </div>
        <div class="col-4 text-center stagger-up">
          <img src="{{ asset('image/services-2.svg') }}" alt="" class="iconsimg">
          <div class="feature-title mt-2">{{ __('messages.unforgettable_moments') }}</div>
        </div>
        <div class="col-4 text-center stagger-up">
          <img src="{{ asset('image/services-3.svg') }}" alt="" class="iconsimg">
          <div class="feature-title mt-2 ">{{ __('messages.competitive_pricings') }}</div>
        </div>
      </div>

      <!-- CTA -->
      <a href="{{ route("Service") }}" class="btn cta-button stagger-up">{{ __('messages.see_all_services') }}</a>
    </div>

   
    <!-- Right Image -->

    <div class="col-lg-5 position-relative d-flex justify-content-center">
      <div class="col-md-10">
        <!-- Image -->
        <img src="{{ asset('image/destin.jpg') }}" alt="Service" class="img-fluid rounded shadow service-img forthisonly">

        <!-- Experience Badge -->
        <!-- Experience Circle (on top) -->'
        
        <style>
            .forthisonly{
                height: 80vh !important;
            }
        </style>
        <div
          class="position-absolute expercircle text-white rounded-circle d-flex flex-column justify-content-center align-items-center fw-bold"
          style="width:180px; height:180px; bottom:46px; left: -60px; z-index: 2;">
          <div style="font-size:40px;">15+</div>
          <div style="font-size:16px; text-align: center;">{{ __('messages.years_experience') }}</div>
        </div>

        <!-- Customers Banner (under the circle) -->
        <div class="position-absolute text-white text-center py-4 px-3 controlwidth"
          style="background-color: var(--primary-light); border: 1px solid rgba(201,161,90,0.4); bottom: -36px; width:444px; border-radius: 6px; z-index: 1;">
          <div class="fw-bold" style="font-size:40px;">1K+</div>
          <small class="xs-text-des">{{ __('messages.customize_service') }}</small>
        </div>

      </div>
    </div>
  </div>
</div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const root = document.querySelector('[data-stagger-root=\"service-left\"]');
    if (!root) return;
    const sequence = Array.from(root.querySelectorAll('.stagger-up'));
    if (!sequence.length) return;

    const io = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        // reveal items one-by-one from top to bottom
        let i = 0;
        const stepMs = 180; // speed between items
        const revealNext = () => {
          if (i >= sequence.length) { obs.unobserve(entry.target); return; }
          sequence[i++].classList.add('in-view');
          setTimeout(revealNext, stepMs);
        };
        revealNext();
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });

    io.observe(root);
  });
</script>


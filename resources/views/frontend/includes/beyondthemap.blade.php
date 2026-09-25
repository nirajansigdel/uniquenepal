<!-- ============================================================
     NEPAL, BEYOND THE MAP
============================================================= -->

<section class="beyond-map-section section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-20,80 C 220,20 360,180 600,110 S 1020,10 1250,90 S 1460,220 1500,140" />
    <circle cx="120" cy="520" r="90" />
  </svg>
  <div class="container">
    <div class="row align-items-center g-5">

      <!-- Text -->
      <div class="col-lg-6 reveal-left">
        <p class="heading">Nepal, Beyond The Map</p>
        <p class="extralarger mb-4">Where Ancient Trails Meet Endless Horizons</p>

        <div class="beyond-map-feature">
          <div class="beyond-map-feature-icon"><i class="fas fa-user-tie"></i></div>
          <div>
            <h5>Trusted Local Guides</h5>
            <p>Licensed, English-speaking guides who've walked every trail we send you on.</p>
          </div>
        </div>

        <div class="beyond-map-feature">
          <div class="beyond-map-feature-icon"><i class="fas fa-compass"></i></div>
          <div>
            <h5>Our Mission</h5>
            <p>{{ Str::limit(strip_tags($about->getTranslated('description') ?? ''), 130) ?: 'To reveal Nepal beyond the guidebooks — one safe, authentic journey at a time.' }}</p>
          </div>
        </div>

        <div class="beyond-map-cta">
          <a href="{{ route('About') }}" class="btn cta-button">Discover Our Story</a>

          <div class="beyond-map-avatars">
            <div class="avatar-stack">
              @foreach($testimonials->take(3) as $t)
                <img src="{{ asset('uploads/testimonial/' . $t->image) }}" alt="{{ $t->name }}">
              @endforeach
            </div>
            <div class="beyond-map-avatars-text">
              <strong>1000+</strong>
              <span>Happy Trekkers</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Circular visual -->
      <div class="col-lg-6 reveal-right">
        <div class="beyond-map-visual">
          <div class="beyond-map-ring"></div>
          <div class="beyond-map-circle-frame">
            @if($about && $about->image)
              <img src="{{ asset('uploads/about/' . $about->image) }}" alt="{{ $about->title }}">
            @else
              <img src="{{ asset('image/destin.jpg') }}" alt="Nepal">
            @endif
          </div>
          <div class="beyond-map-badge">
            <strong>15+</strong>
            <span>Years Guiding Nepal</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    var targets = document.querySelectorAll('.beyond-map-section .reveal-left, .beyond-map-section .reveal-right');
    if (!targets.length) return;
    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
    targets.forEach(function (el, i) {
      el.style.transitionDelay = (i * 0.08) + 's';
      observer.observe(el);
    });
  });
</script>

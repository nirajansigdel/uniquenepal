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

<style>
  .beyond-map-section {
    position: relative;
    padding: 110px 0;
    color: rgba(255, 255, 255, 0.7);
    overflow: hidden;
  }

  .beyond-map-section .container {
    position: relative;
    z-index: 1;
  }

  .beyond-map-section .extralarger {
    color: #fff;
  }

  .beyond-map-feature {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 1.75rem;
  }

  .beyond-map-feature-icon {
    flex-shrink: 0;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    color: #fff;
    font-size: 1.2rem;
    box-shadow: 0 8px 18px rgba(161, 127, 61, 0.3);
  }

  .beyond-map-feature h5 {
    font-family: var(--font-heading);
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.35rem;
  }

  .beyond-map-feature p {
    font-family: var(--font-family);
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
    line-height: 1.7;
  }

  .beyond-map-cta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.75rem;
    margin-top: 2rem;
  }

  .beyond-map-avatars {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .avatar-stack {
    display: flex;
  }

  .avatar-stack img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--bg-color);
    margin-left: -12px;
  }

  .avatar-stack img:first-child {
    margin-left: 0;
  }

  .beyond-map-avatars-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }

  .beyond-map-avatars-text strong {
    font-family: var(--font-heading);
    color: #fff;
    font-size: 1.1rem;
  }

  .beyond-map-avatars-text span {
    font-family: var(--font-family);
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.6);
  }

  /* Circular visual */
  .beyond-map-visual {
    position: relative;
    max-width: 460px;
    margin: 0 auto;
    padding: 30px;
  }

  .beyond-map-ring {
    position: absolute;
    inset: 0;
    border: 1px dashed rgba(201, 161, 90, 0.5);
    border-radius: 50%;
  }

  .beyond-map-circle-frame {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 30px 60px rgba(2, 31, 65, 0.25);
    border: 6px solid #fff;
  }

  .beyond-map-circle-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .beyond-map-badge {
    position: absolute;
    left: 0;
    bottom: 10px;
    background: var(--primary-light);
    border: 1px solid rgba(201, 161, 90, 0.4);
    color: #fff;
    border-radius: 16px;
    padding: 1.1rem 1.4rem;
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35);
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }

  .beyond-map-badge strong {
    font-family: var(--font-heading);
    font-size: 1.7rem;
    color: var(--gold-light);
  }

  .beyond-map-badge span {
    font-family: var(--font-family);
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.75);
  }

  @media (max-width: 991.98px) {
    .beyond-map-visual {
      max-width: 340px;
    }
  }
</style>

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

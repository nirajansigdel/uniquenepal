<!-- ============================================================
     TRUST / STATS
============================================================= -->

<section class="trust-stats-section section-reveal">
  <div class="trust-stats-panel">
    <svg class="section-doodle" viewBox="0 0 1440 300" preserveAspectRatio="none" aria-hidden="true">
      <path d="M-20,240 C 220,180 380,280 640,210 S 1060,140 1290,220 S 1470,270 1500,230" />
      <circle cx="1300" cy="60" r="55" />
    </svg>
    <div class="container">
      <div class="trust-stats-row">
        <div class="trust-stat-item">
          <div class="trust-stat-icon"><i class="fas fa-mountain"></i></div>
          <div class="trust-stat-value"><span class="trust-stat-number" data-target="15">0</span>+</div>
          <div class="trust-stat-label">Years Guiding Nepal</div>
        </div>
        <div class="trust-stat-item">
          <div class="trust-stat-icon"><i class="fas fa-users"></i></div>
          <div class="trust-stat-value"><span class="trust-stat-number" data-target="1000">0</span>+</div>
          <div class="trust-stat-label">Happy Trekkers</div>
        </div>
        <div class="trust-stat-item">
          <div class="trust-stat-icon"><i class="fas fa-route"></i></div>
          <div class="trust-stat-value"><span class="trust-stat-number" data-target="50">0</span>+</div>
          <div class="trust-stat-label">Trek Routes</div>
        </div>
        <div class="trust-stat-item">
          <div class="trust-stat-icon"><i class="fas fa-star"></i></div>
          <div class="trust-stat-value"><span class="trust-stat-number" data-target="49" data-decimal="10">0</span></div>
          <div class="trust-stat-label">Average Rating</div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  /* A flush, full-width bridge between the hero and the next section —
     no floating card, no overlap, just a clean seam with a gold hairline
     on either edge. */
  .trust-stats-panel {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-top: 1px solid rgba(201, 161, 90, 0.3);
    border-bottom: 1px solid rgba(201, 161, 90, 0.3);
    padding: 3rem 0;
  }

  .trust-stats-row {
    display: flex;
    flex-wrap: wrap;
  }

  .trust-stat-item {
    flex: 1 1 25%;
    text-align: center;
    padding: 0 1.25rem;
    border-left: 1px solid rgba(201, 161, 90, 0.2);
    transition: transform 0.3s ease;
  }

  .trust-stat-item:hover {
    transform: translateY(-4px);
  }

  .trust-stat-item:first-child {
    border-left: none;
  }

  .trust-stat-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    color: var(--charcoal);
    font-size: 1.2rem;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
  }

  .trust-stat-value {
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: clamp(1.9rem, 1.5rem + 1.4vw, 2.6rem);
    color: var(--gold-light);
    line-height: 1;
  }

  .trust-stat-label {
    margin-top: 0.6rem;
    font-family: var(--font-family);
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.75);
  }

  @media (max-width: 767.98px) {
    .trust-stats-panel {
      padding: 2rem 0;
    }
    .trust-stat-item {
      flex: 1 1 50%;
      margin-bottom: 1.75rem;
      border-left: none;
    }
    .trust-stat-icon {
      width: 44px;
      height: 44px;
      font-size: 1rem;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var numbers = document.querySelectorAll('.trust-stat-number');
    if (!numbers.length) return;

    function countTo(el, target, decimal, duration) {
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        el.textContent = decimal ? (target / decimal).toFixed(1) : target;
        return;
      }
      var start = null;
      function step(timestamp) {
        if (!start) start = timestamp;
        var progress = Math.min((timestamp - start) / duration, 1);
        var value = progress * target;
        el.textContent = decimal ? (value / decimal).toFixed(1) : Math.floor(value);
        if (progress < 1) window.requestAnimationFrame(step);
      }
      window.requestAnimationFrame(step);
    }

    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var target = parseInt(el.getAttribute('data-target') || '0', 10);
        var decimal = parseInt(el.getAttribute('data-decimal') || '0', 10) || null;
        countTo(el, target, decimal, 1400);
        obs.unobserve(el);
      });
    }, { threshold: 0.4 });

    numbers.forEach(function (el) { observer.observe(el); });
  });
</script>

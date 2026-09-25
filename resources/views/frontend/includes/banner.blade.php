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

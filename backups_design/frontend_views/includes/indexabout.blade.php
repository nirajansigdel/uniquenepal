<section class="py-5 absolute" style="background-color: var(--bg-color);">
  <div class="container">
    <div class="row align-items-center">


      <!-- LEFT: Text Content -->
    <div class="col-lg-6 mb-4 mb-lg-0">
                <p class="extralarger mb-3">{{ __('messages.about_us') }}</p>
                @php
                    $text = $about->getTranslated('description') ?? 'No description available.';
                    $parts = explode('.', $text);

                    if (count($parts) >= 3) {
                        $first = trim($parts[0]) . '.';
                        $second = trim($parts[1]) . '.';
                        $rest = implode('.', array_slice($parts, 2));
                        $text = $first . ' ' . $second . '<br>' . $rest;
                    }
                @endphp
                <div class="text-muted mb-4 xs-text-des">
                   {!! $text !!}
                </div>

                <!-- CTA -->
                <a href="{{ route("About") }}" class="btn cta-button">{{ __('messages.read_more') }}</a>
            </div>

      <!-- RIGHT: Modern KPI grid with primary and secondary cards -->
      <div class="col-lg-6">
        <div class="kpi-grid">
          <div class="kpi-card kpi-orange kpi-card--primary reveal-up">
            <span class="kpi-emoji" aria-hidden="true">⚙️</span>
            <div class="kpi-value"><span class="kpi-number" data-target="75">0</span><span class="kpi-suffix">%</span>
            </div>
            <div class="kpi-label">{{ __('messages.tour_operations') }}</div>
            <div class="kpi-progress">
              <div class="kpi-progress-bar" style="width:0%"></div>
            </div>
          </div>
          <div class="kpi-card kpi-yellow kpi-card--secondary reveal-up">
            <span class="kpi-emoji" aria-hidden="true">🗂️</span>
            <div class="kpi-value"><span class="kpi-number" data-target="20">0</span><span class="kpi-suffix">%</span>
            </div>
            <div class="kpi-label">{{ __('messages.client_satisfaction') }}</div>
            <div class="kpi-progress">
              <div class="kpi-progress-bar" style="width:0%"></div>
            </div>
          </div>
          <div class="kpi-card kpi-gray kpi-card--secondary reveal-up">
            <span class="kpi-emoji" aria-hidden="true">💸</span>
            <div class="kpi-value"><span class="kpi-number" data-target="5">0</span><span class="kpi-suffix">%</span>
            </div>
            <div class="kpi-label">{{ __('messages.booking_support') }}</div>
            <div class="kpi-progress">
              <div class="kpi-progress-bar" style="width:0%"></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>



  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var rightCol = document.querySelector('.row.align-items-center .col-lg-6 + .col-lg-6');
      if (!rightCol) return;

      var cards = Array.prototype.slice.call(rightCol.querySelectorAll('.reveal-up'));
      cards.forEach(function (el, index) {
        el.style.setProperty('--reveal-delay', (index * 140) + 'ms');
      });

      function countTo(element, target, duration) {
        var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReduced) {
          element.textContent = target;
          return;
        }
        var start = 0;
        var startTime = null;
        function step(timestamp) {
          if (!startTime) startTime = timestamp;
          var progress = Math.min((timestamp - startTime) / duration, 1);
          var value = Math.floor(progress * (target - start) + start);
          element.textContent = value;
          if (progress < 1) {
            window.requestAnimationFrame(step);
          }
        }
        window.requestAnimationFrame(step);
      }

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries, obs) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible');
              var num = entry.target.querySelector('.kpi-number');
              if (num && !num.dataset.counted) {
                num.dataset.counted = 'true';
                var target = parseInt(num.getAttribute('data-target') || '0', 10);
                countTo(num, target, 1200);
              }
              var bar = entry.target.querySelector('.kpi-progress-bar');
              var barTarget = entry.target.querySelector('.kpi-number');
              if (bar && barTarget) {
                var pct = parseInt(barTarget.getAttribute('data-target') || '0', 10);
                bar.style.width = Math.max(0, Math.min(60, pct)) + '%';
              }
              obs.unobserve(entry.target);
            }
          });
        }, { threshold: 0.2, rootMargin: '0px 0px -10% 0px' });

        cards.forEach(function (el) { observer.observe(el); });
      } else {
        cards.forEach(function (el) {
          el.classList.add('is-visible');
          var num = el.querySelector('.kpi-number');
          if (num) num.textContent = num.getAttribute('data-target') || '0';
          var bar = el.querySelector('.kpi-progress-bar');
          if (bar && num) { bar.style.width = (num.getAttribute('data-target') || '0') + '%'; }
        });
      }
    });
  </script>
</section>
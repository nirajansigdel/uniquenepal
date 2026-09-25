

<section class="py-5 traveller-stories-section section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M1460,120 C 1210,60 1070,220 820,150 S 400,40 170,140 S -20,260 -60,190" />
    <circle cx="120" cy="580" r="75" />
  </svg>
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-8">
        <p class="heading">Traveller Stories</p>
        <p class="extralarger">{{ __('messages.hear_happy_travelers') }}</p>

      </div>
    </div>

    <div class="testimonial-carousel">
      @foreach($testimonials as $testimonial)
      <div class="px-2">
        <div class="testimonial-card p-4 text-center rounded d-flex flex-column align-items-center">
          <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}"
               alt="{{ $testimonial->name }}"
               class="rounded-circle mb-3"
               style="width: 100px; height: 100px; object-fit: cover;">

        <h5 class="fw-bold mb-1">{{ $testimonial->name }}</h5>
        <p class="text-muted mb-2">{{ $testimonial->position ?? __('messages.tourist') }}</p>

          <div class="text-warning mb-3">
            @for ($i = 0; $i < 5; $i++)
              <i class="fas fa-star"></i>
            @endfor
          </div>

          <p class="text-muted small">{{ $testimonial->getTranslated('description') }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Slick JS Config -->
<script>
  $(document).ready(function () {
    $('.testimonial-carousel').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 4000,
      responsive: [
        {
          breakpoint: 992, // Tablets
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 768, // Mobile
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true
          }
        }
      ]
    });
  });
</script>

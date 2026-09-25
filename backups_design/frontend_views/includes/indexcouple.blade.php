
<section class="container-fluid coupbg py-4">
  <div class="container my-5">
    <div class="row align-items-center g-4 text-white">
      @foreach ($couplecard->take(1) as $couple)

        <!-- LEFT COLUMN: COUPLES -->
        <div class="col-md-6 reveal-left">
          <h2 class="custom-heading">{{ __('messages.special_offer_couples') }}</h2>
          <h3 class="contenttitle text-white">
            {!! \Illuminate\Support\Str::limit(strip_tags($couple->getTranslated('heading'), '<p><br>'), 200) !!}
          </h3>
          <p class="custom-subtext">
            {!! \Illuminate\Support\Str::limit(strip_tags($couple->getTranslated('content'), '<p><br>'), 200) !!}
          </p>
          <div class="custom-overlay-container shadow">
            <img
              src="{{ (is_array($couple->images) && count($couple->images)) ? asset('uploads/products/' . $couple->images[0]) : asset('images/default-couple.jpg') }}"
              alt="Service Image">
            <div class="custom-overlay p-3  rounded shadow-sm">

              @if($couple->original_price || $couple->discounted_price)
                <div class="mt-3">

                  @if($couple->original_price && $couple->discounted_price)
                    <h6 class="mb-2 text-white fw-semibold">
                      {{ __('messages.package_price') }}
                      <span class="text-decoration-line-through text-light fw-normal" style="font-size: 0.9rem;">
                        $ {{ number_format($couple->original_price) }}
                      </span>
                    </h6>

                    <div class="d-flex flex-column">
                      <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                        {{ __('messages.discounted_price') }} $ {{ number_format($couple->discounted_price) }}
                      </span>
                      <span class="text-white small" style="font-size: 1.3rem;">
                      @php
    $finalPrice = $couple->discounted_price - ($couple->discounted_price * 0.01);
@endphp

{{ __('messages.couples_offer_price') }} ${{ number_format($finalPrice, 2) }}
                      </span>
                    </div>

                  @elseif($couple->discounted_price)
                    <div class="d-flex flex-column">
                      <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                        {{ __('messages.price') }} $ {{ number_format($couple->discounted_price) }}
                      </span>
                    </div>

                  @elseif($couple->original_price)
                    <div class="d-flex flex-column" style="font-size: 1.3rem;">
                      <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                        {{ __('messages.price') }} $ {{ number_format($couple->original_price) }}
                      </span>
                    </div>
                  @endif

                </div>
              @endif


              <div class="mt-4">
                 <a class="overlay-btn text-decoration-none" href="{{ route('products.detail', $couple->id) }}">{{ __('messages.view_more') }}</a>
              </div>
            </div>

          </div>
        </div>
      @endforeach
      <!-- RIGHT COLUMN: ADVENTURE -->
      @foreach ($groupcard->take(1) as $group)
        <div class="col-md-6 reveal-right">
            <div class="custom-overlay-container shadow">
              <img
                src="{{ (is_array($group->images) && count($group->images)) ? asset('uploads/products/' . $group->images[0]) : asset('images/default-couple.jpg') }}"
                alt="Service Image">
              <div class="custom-overlay p-3  rounded shadow-sm">

                @if($group->original_price || $group->discounted_price)
                  <div class="mt-3">

                    @if($group->original_price && $group->discounted_price)
                      <h6 class="mb-2 text-white fw-semibold">
                        Package Price:
                        <span class="text-decoration-line-through text-light fw-normal" style="font-size: 0.9rem;">
                          $ {{ number_format($group->original_price) }}
                        </span>
                      </h6>

                      <div class="d-flex flex-column">
                        <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                          Discounted Price: $ {{ number_format($group->discounted_price) }}
                        </span>
                        <span class="text-white small" style="font-size: 1.3rem;">
                          Group Price :$ {{ number_format($group->discounted_price) }}
                        </span>
                        </span>
                      </div>

                    @elseif($group->discounted_price)
                      <div class="d-flex flex-column">
                        <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                          Price: $ {{ number_format($group->discounted_price) }}
                        </span>
                      </div>

                    @elseif($group->original_price)
                      <div class="d-flex flex-column">
                        <span class="fw-bold text-white mb-1" style="font-size: 1.1rem;">
                          Price: $ {{ number_format($group->original_price) }}
                        </span>
                      </div>
                    @endif

                  </div>
                @endif
                <div class="mt-4">
                  <a class="overlay-btn text-decoration-none" href="{{ route('products.detail', $group->id) }}">View More</a>
                </div>
              </div>

            </div>
         

          <h2 class="custom-heading mt-4">{{ __('messages.special_group_package') }}</h2>
          <h3 class="contenttitle text-white">
            {!! \Illuminate\Support\Str::limit(strip_tags($group->getTranslated('heading'), '<p><br>'), 200) !!}
          </h3>
          <p class="custom-subtext">
            {!! \Illuminate\Support\Str::limit(strip_tags($group->getTranslated('content'), '<p><br>'), 200) !!}
          </p>
        </div>
      @endforeach

    </div>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const targets = document.querySelectorAll('.reveal-left, .reveal-right');
    if (!targets.length) return;
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
    targets.forEach((el, idx) => {
      el.style.transitionDelay = (idx * 0.08) + 's';
      observer.observe(el);
    });
  });
</script>
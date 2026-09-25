<section class="container-fluid tarveloffer py-4">
  <div class="container d-flex flex-column justify-content-center gap-4">
    <div class="row text-center">
      <p class="heading p-0 m-0">{{ __('messages.exclusive_offers') }}</p>
      <p class="extralarger p-0 m-0">{{ __('messages.explore_horizons') }}</p>
    </div>


    <div class="slider-wrapper">
      <div class="slider-track">
        {{-- Loop your offers --}}
        @foreach ($products as $prod)
            <a class="service-card" href="{{ route('products.detail', $prod->id) }}">
              <div class="service-image">
                @if (is_array($prod->images) && count($prod->images))
                  <img src="{{ asset('uploads/products/' . $prod->images[0]) }}" alt="{{ $prod->heading }}" />
                @else
                  <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60" alt="Default Image" />
                @endif
                <span class="service-badge">{{ __('messages.exclusive_offer') }}</span>
              </div>
              <div class="service-content">
                <h3 class="contenttitle text-capitalize text-white">{{ Str::limit(strip_tags($prod->getTranslated('heading')), 26) }}</h3>
                <p class="contentdesc text-white">{!! Str::limit(str_replace('&nbsp;', ' ', strip_tags($prod->getTranslated('content'))), 120) !!}</p>
                
                <!-- Pricing Information -->
                @if($prod->original_price || $prod->discounted_price)
                  <div class="pricing-info mt-2">
                    @if($prod->original_price && $prod->discounted_price)
                      <div class="d-flex align-items-center gap-2">
                        <span class="text-decoration-line-through text-white" style="font-size: 0.9rem;">$ {{ number_format($prod->original_price) }}</span>
                        <span class="fw-bold text-warning" style="font-size: 1.1rem;">$ {{ number_format($prod->discounted_price) }}</span>
                      </div>
                    @elseif($prod->discounted_price)
                      <span class="fw-bold text-white" style="font-size: 1.1rem;">$ {{ number_format($prod->discounted_price) }}</span>
                    @elseif($prod->original_price)
                      <span class="fw-bold text-warning" style="font-size: 1.1rem;">$ {{ number_format($prod->original_price) }}</span>
                    @endif
                  </div>
                @endif
              </div>
            </a>
          
        @endforeach
      </div>
    </div>

    <div class="row d-flex flex-column justify-content-center align-items-center my-4">
      <div class="col-md-3">
        <a href="{{ route('products.index.front') }}">
          <button class="cta-button btn btn-primary px-5">{{ __('messages.view_more') }}</button>
        </a>
      </div>
    </div>
  </div>
</section>

<section class="container-fluid destination py-5 section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-20,600 C 220,660 380,480 640,540 S 1060,660 1290,570 S 1480,420 1500,480" />
    <circle cx="1250" cy="130" r="60" />
  </svg>
  <div class="container destination-content">
    <div class="row mb-4">
      <div class="col-7">
        <p class="heading">Signature Journeys</p>
        <p class="extralarger">Curated Treks, Handpicked For You</p>
      </div>
    </div>

    <div class="row g-4">
      @foreach ($Destinationcard->take(8) as $populardestinationinnepal)
        <a class="col-md-4 col-lg-3" href="{{ route('products.detail', $populardestinationinnepal->id) }}">
          <div class="service-card h-100">
            <div class="service-image">
              <img src="{{ (is_array($populardestinationinnepal->images) && count($populardestinationinnepal->images)) ? asset('uploads/products/' . $populardestinationinnepal->images[0]) : 'https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60' }}" alt="Service Image">
            </div>
            <div class="service-content">
              <h3 class="contenttitle text-white">{{ Str::limit(strip_tags($populardestinationinnepal->getTranslated('heading')), 28) }}</h3>
              <p class="codesc text-white pt-1">
                {!! Str::limit(str_replace('&nbsp;', ' ', strip_tags($populardestinationinnepal->getTranslated('content'))), 120) !!}
              </p>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div class="row mt-5 justify-content-center">
      <div class="col-md-auto">
        <a href="{{ route('products.index.front') }}">
          <button class="btn cta-button px-5">{{ __('messages.view_more') }}</button>
        </a>
      </div>
    </div>
  </div>
</section>




<style>
  .blog-section {
    position: relative;
    overflow: hidden;
  }
  .blog-section .extralarger {
    color: #fff;
  }
</style>

<section class="container-fluid blog-section py-5 section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-20,140 C 230,80 370,240 630,160 S 1050,50 1280,150 S 1470,270 1500,210" />
    <circle cx="1310" cy="560" r="80" />
  </svg>
  <div class="container">
    <div class="row">
      <div class="text-center mb-4">
        <p class="heading justify-content-center">Travel Journal</p>
        <p class="extralarger pb-2">{{ __('messages.collection_blogs') }}</p>
      </div>
    </div>
    <div class="row">
      @foreach ($blogs as $blogs)
        <div class="col-md-4 mb-4">
          <div class="blog-card reveal">
            <div class="blog-image">
              @if ($blogs->image)
                <img src="{{ asset('uploads/blogpostcategory/' . $blogs->image) }}" alt="blog image">
              @else
                <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60" alt="Default Image">
              @endif
              <span class="blog-badge">{{ __('messages.blogs') }}</span>
            </div>
            <div class="blog-content">
              <h3 class="blog-title text-capitalize">{{ Str::limit(strip_tags($blogs->getTranslated('title')), 40) }}</h3>
              <p class="blog-desc">{!! Str::limit(str_replace('&nbsp;', ' ', strip_tags($blogs->getTranslated('content'))), 150) !!}</p>
              <a href="{{ route('blog', $blogs->slug) }}" class="blog-cta">{{ __('messages.view_details') }} <span class="arrow">→</span></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>


    <div class="text-center mt-4">
      <a href="{{ route('blogs') }}">
        <button class="cta-button btn btn-primary px-5">{{ __('messages.view_more') }}</button>
      </a>
    </div>
  </div>
</section>

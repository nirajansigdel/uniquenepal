    
  
  
<section class="container-fluid blog-section  py-5">
  <div class="container">
    <div class="row">
      <div class="text-center mb-4">
        <p class=" xs-text text-uppercase">{{ __('messages.allactivies') }}</p>
        <p class=" extralarger text-capitalize">{{ __('messages.allactivities_sub') }}</p>
      </div>
    </div>
    <div class="row">
      @foreach($products as $product)
        <div class="col-md-4 mb-4">
          <div class="blog-card reveal">
            <div class="blog-image">
              @if(is_array($product->images) && count($product->images))
                <img src="{{ asset('uploads/products/'.$product->images[0]) }}">
            @else
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4">
            @endif
           


@if($product->discounted_price || $product->original_price)
              <span class="blog-badge"> ${{ number_format($product->discounted_price ?? $product->original_price) }}</span>

 @endif


            </div>
            <div class="blog-content">
              <h3 class="blog-title text-capitalize">{{ $product->getTranslated('heading') }}</h3>
              <p class="blog-desc"> {{ Str::limit(strip_tags($product->getTranslated('content')), 120) }}</p>
              <a href="{{ route('products.detail', $product->id) }}" class="blog-cta">{{ __('messages.view_details') }} <span class="arrow">→</span></a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="gallery-section">
  <div class="container">
    <div class="section-header">
      <p class="extralarger blackhighlight">Photo Gallery</p>
      <p class="xs-text">Journey through our moments of inspiration, achievement, and community spirit</p>
    </div>
  <div id="imageContent" class="gallery-wrapper">
            <div class="gallery-masonry">
                @foreach($images->sortByDesc('updated_at') as $image)
                    <div class="gallery-item" data-category="{{ $image->category->slug ?? 'uncategorized' }}">
                        <div class="gallery-inner">
                            @if(!empty($image->img) && is_array($image->img))
                                <img src="{{ asset(last($image->img)) }}" 
                                     alt="{{ $image->title }}"
                                     class="gallery-img">
                            @endif
                            <div class="gallery-content">
                                <h5 class="image-title text-white mb-3">{{ $image->title }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('singleImage', $image->slug) }}" class="view-btn">
                                        View More Images →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

  </div>
</section>

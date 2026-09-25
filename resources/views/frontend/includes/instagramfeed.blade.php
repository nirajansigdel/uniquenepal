<!-- ============================================================
     INSTAGRAM
============================================================= -->

@php
  $igImages = collect($images ?? [])->filter(function ($img) {
      return !empty($img->img) && is_array($img->img) && count($img->img);
  })->take(6);
@endphp

@if($igImages->count())
<section class="ig-section section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-20,560 C 220,620 360,460 620,530 S 1040,640 1270,550 S 1470,410 1500,470" />
    <circle cx="1280" cy="130" r="65" />
  </svg>
  <div class="container">
    <div class="text-center mb-5">
      <p class="heading justify-content-center">Instagram</p>
      <p class="extralarger">Follow The Journey</p>
      @if($sitesetting && $sitesetting->instagram_link)
        <a href="{{ $sitesetting->instagram_link }}" target="_blank" rel="noopener" class="ig-handle">
          <i class="fab fa-instagram"></i> @UniqueNepalAdventure
        </a>
      @endif
    </div>

    <div class="ig-grid">
      @foreach($igImages as $igImage)
        <a
          class="ig-tile"
          href="{{ $sitesetting->instagram_link ?? route('Gallery') }}"
          target="_blank" rel="noopener"
        >
          <img src="{{ asset(last($igImage->img)) }}" alt="{{ $igImage->title }}">
          <span class="ig-overlay"><i class="fab fa-instagram"></i></span>
        </a>
      @endforeach
    </div>
  </div>
</section>

@endif

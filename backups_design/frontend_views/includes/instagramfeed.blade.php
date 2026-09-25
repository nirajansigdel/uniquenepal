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

<style>
  .ig-section {
    position: relative;
    overflow: hidden;
    padding: 100px 0;
  }

  .ig-section .extralarger {
    color: #fff;
  }

  .ig-handle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 0.75rem;
    font-family: var(--font-family);
    font-weight: 600;
    color: var(--gold-light);
    text-decoration: none;
  }

  .ig-handle:hover {
    color: var(--gold-dark);
  }

  .ig-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
  }

  .ig-tile {
    position: relative;
    display: block;
    border-radius: 10px;
    overflow: hidden;
    flex: 0 1 200px;
    aspect-ratio: 1 / 1;
  }

  .ig-tile img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .ig-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(2, 31, 65, 0.55);
    color: var(--gold-light);
    font-size: 1.4rem;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .ig-tile:hover img {
    transform: scale(1.08);
  }

  .ig-tile:hover .ig-overlay {
    opacity: 1;
  }

  @media (max-width: 575.98px) {
    .ig-tile {
      flex-basis: calc(50% - 16px);
    }
  }
</style>
@endif

@extends('frontend.layouts.master')

<head>
    <title>{{ $gallerymeta?->title ?? 'Gallery | Unique Nepal' }}</title>
    <meta name="description" content="{{ $gallerymeta?->description ?? '' }}">
</head>

@section('content')



<div class="premium-gallery-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="premium-gallery-hero">

        <div class="premium-gallery-hero-content">
            <div class="container text-center">

                <div class="gallery-eyebrow">
                    Unique Nepal
                </div>

                <h1>
                    {{ __('messages.gallery_h1') }}
                </h1>

                <div class="gallery-breadcrumb">
                    <span class="home">
                        {{ __('messages.Home') }}
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.gallery') }}
                    </span>
                </div>

            </div>
        </div>

    </section>


    {{-- =====================================================
         INTRO
    ====================================================== --}}

    <section class="gallery-intro">

        <div class="container text-center">

            <div class="gallery-intro-label">
                {{ __('messages.photogallery') }}
            </div>

            <h2 class="gallery-intro-title">
                {{ __('messages.gallery_sub') }}
            </h2>

            <p class="gallery-intro-text">
                Explore moments from the trails, mountains, villages and
                unforgettable journeys across Nepal.
            </p>

        </div>

    </section>


    {{-- =====================================================
         MAIN GALLERY
    ====================================================== --}}

    <section class="gallery-main">

        <div class="container">

            {{-- PHOTO / VIDEO SWITCHER --}}
            <div class="gallery-switcher-wrap">

                <div class="gallery-switcher">

                    <button
                        type="button"
                        id="imageButton"
                        class="active">
                        <i class="fas fa-images me-2"></i>
                        {{ __('messages.photo') }}
                    </button>

                    <button
                        type="button"
                        id="videoButton">
                        <i class="fas fa-play-circle me-2"></i>
                        {{ __('messages.video') }}
                    </button>

                </div>

            </div>


            {{-- =================================================
                 IMAGE CONTENT
            ================================================== --}}

            <div id="imageContent">

                <div class="gallery-grid">

                    @forelse($images->sortByDesc('updated_at') as $index => $image)

                        <article class="gallery-card">

                            <span class="gallery-number">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            @if(!empty($image->img) && is_array($image->img))

                                <img
                                    src="{{ asset(last($image->img)) }}"
                                    alt="{{ $image->title }}"
                                    class="gallery-image"
                                    loading="lazy">

                            @else

                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-mountain text-white fa-3x"></i>
                                </div>

                            @endif


                            <div class="gallery-card-content">

                                <h3 class="gallery-card-title">
                                    {{ $image->title }}
                                </h3>

                                <a
                                    href="{{ route('singleImage', $image->slug) }}"
                                    class="gallery-view">

                                    {{ __('messages.view_details') ?? 'View More Images' }}

                                    <span>→</span>

                                </a>

                            </div>

                        </article>

                    @empty

                        <div class="gallery-empty">

                            <i class="fas fa-images"></i>

                            <h4>
                                No photos available
                            </h4>

                            <p>
                                Our gallery is being updated. Please check back soon.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- =================================================
                 VIDEO CONTENT
            ================================================== --}}

            <div id="videoContent" style="display:none;">

                <div class="video-grid">

                    @forelse($videos as $video)

                        <article class="video-card">

                            <div class="video-frame">

                                <iframe
                                    src="https://www.youtube.com/embed/{{ $video->url }}"
                                    title="{{ $video->title }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>

                            </div>

                            <div class="video-info">

                                <span class="video-label">
                                    Unique Nepal
                                </span>

                                <h3 class="video-title">
                                    {{ $video->title ?? 'Untitled Video' }}
                                </h3>

                            </div>

                        </article>

                    @empty

                        <div class="gallery-empty">

                            <i class="fas fa-video"></i>

                            <h4>
                                No videos available
                            </h4>

                            <p>
                                Check back soon for new travel stories from Nepal.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CTA
    ====================================================== --}}

    <section class="gallery-cta">

        <div class="gallery-cta-inner">

            <div class="gallery-cta-label">
                Unique Nepal
            </div>

            <h2>
                Your journey could be our next story.
            </h2>

            <p>
                Experience the landscapes, culture and adventures of Nepal
                and create moments worth remembering.
            </p>

        </div>

    </section>

</div>


{{-- =========================================================
     PHOTO / VIDEO SWITCH SCRIPT
========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageButton = document.getElementById('imageButton');
    const videoButton = document.getElementById('videoButton');

    const imageContent = document.getElementById('imageContent');
    const videoContent = document.getElementById('videoContent');

    if (!imageButton || !videoButton || !imageContent || !videoContent) {
        return;
    }

    function showImages() {

        imageContent.style.display = 'block';
        videoContent.style.display = 'none';

        imageButton.classList.add('active');
        videoButton.classList.remove('active');

    }

    function showVideos() {

        imageContent.style.display = 'none';
        videoContent.style.display = 'block';

        imageButton.classList.remove('active');
        videoButton.classList.add('active');

    }

    imageButton.addEventListener('click', showImages);
    videoButton.addEventListener('click', showVideos);

});
</script>

@endsection
@extends('frontend.layouts.master')

<head>
    <title>{{ $gallerymeta?->title ?? 'Gallery | Unique Nepal' }}</title>
    <meta name="description" content="{{ $gallerymeta?->description ?? '' }}">
</head>

@section('content')

<style>
    /* =========================================================
       UNIQUE NEPAL — PREMIUM GALLERY
    ========================================================= */

    .premium-gallery-page {
        --forest: #173d2b;
        --forest-dark: #0c281b;
        --forest-light: #2f6849;
        --gold: #b49352;
        --gold-light: #d8c18d;
        --cream: #f7f4ed;
        --soft-bg: #f3f5f1;
        --text: #5d6861;
        --dark-text: #17201b;
        --border: rgba(23, 61, 43, .12);
        background: var(--soft-bg);
    }

    /* =========================================================
       HERO
    ========================================================= */

    .premium-gallery-hero {
        position: relative;
        min-height: 540px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background:
            linear-gradient(
                180deg,
                rgba(12, 40, 27, .15),
                rgba(12, 40, 27, .82)
            ),
            url('{{ asset('image/check.jpg') }}') center center / cover no-repeat;
    }

    .premium-gallery-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                90deg,
                rgba(12, 40, 27, .72),
                transparent 65%
            );
    }

    .premium-gallery-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding-top: 70px;
    }

    .gallery-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: var(--gold-light);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .gallery-eyebrow::before {
        content: "";
        width: 35px;
        height: 1px;
        background: var(--gold-light);
    }

    .premium-gallery-hero h1 {
        max-width: 850px;
        margin: 0 auto;
        color: #fff;
        font-size: clamp(42px, 6vw, 76px);
        line-height: .98;
        font-weight: 700;
        letter-spacing: -2px;
    }

    .gallery-breadcrumb {
        margin-top: 25px;
        color: rgba(255,255,255,.72);
        font-size: 14px;
    }

    .gallery-breadcrumb .home {
        color: #fff;
        font-weight: 600;
    }

    .gallery-breadcrumb i {
        color: var(--gold-light);
        margin: 0 10px;
    }

    /* =========================================================
       INTRO
    ========================================================= */

    .gallery-intro {
        padding: 90px 0 35px;
        background: var(--soft-bg);
    }

    .gallery-intro-label {
        color: var(--gold);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .gallery-intro-title {
        max-width: 720px;
        margin: 0 auto;
        color: var(--forest);
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.12;
        font-weight: 700;
        letter-spacing: -1px;
    }

    .gallery-intro-text {
        max-width: 650px;
        margin: 18px auto 0;
        color: var(--text);
        font-size: 16px;
        line-height: 1.8;
    }

    /* =========================================================
       CONTENT
    ========================================================= */

    .gallery-main {
        padding: 35px 0 110px;
    }

    /* =========================================================
       SWITCHER
    ========================================================= */

    .gallery-switcher-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
    }

    .gallery-switcher {
        display: inline-flex;
        padding: 5px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 100px;
        box-shadow: 0 12px 35px rgba(23, 61, 43, .08);
    }

    .gallery-switcher button {
        border: 0;
        background: transparent;
        color: var(--text);
        padding: 12px 28px;
        min-width: 125px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .4px;
        cursor: pointer;
        transition: all .3s ease;
    }

    .gallery-switcher button:hover {
        color: var(--forest);
    }

    .gallery-switcher button.active {
        background: var(--forest);
        color: #fff;
        box-shadow: 0 7px 20px rgba(23, 61, 43, .22);
    }

    /* =========================================================
       PHOTO GRID
    ========================================================= */

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 22px;
    }

    .gallery-card {
        position: relative;
        overflow: hidden;
        min-height: 330px;
        background: #dfe5df;
        border-radius: 2px;
        isolation: isolate;
    }

    .gallery-card:nth-child(6n + 1) {
        grid-column: span 7;
        min-height: 470px;
    }

    .gallery-card:nth-child(6n + 2) {
        grid-column: span 5;
        min-height: 470px;
    }

    .gallery-card:nth-child(6n + 3),
    .gallery-card:nth-child(6n + 4),
    .gallery-card:nth-child(6n + 5) {
        grid-column: span 4;
        min-height: 350px;
    }

    .gallery-card:nth-child(6n + 6) {
        grid-column: span 8;
        min-height: 350px;
    }

    .gallery-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .8s cubic-bezier(.2,.65,.25,1);
    }

    .gallery-card::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
        background:
            linear-gradient(
                to top,
                rgba(8, 25, 17, .82) 0%,
                rgba(8, 25, 17, .28) 42%,
                rgba(8, 25, 17, 0) 72%
            );
    }

    .gallery-card:hover .gallery-image {
        transform: scale(1.06);
    }

    .gallery-number {
        position: absolute;
        z-index: 3;
        top: 22px;
        left: 22px;
        color: rgba(255,255,255,.9);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .gallery-card-content {
        position: absolute;
        z-index: 3;
        left: 28px;
        right: 28px;
        bottom: 25px;
        color: #fff;
    }

    .gallery-card-title {
        margin: 0 0 13px;
        font-size: 21px;
        line-height: 1.25;
        font-weight: 600;
        color: #fff;
    }

    .gallery-view {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--gold-light);
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        transition: gap .25s ease;
    }

    .gallery-view:hover {
        color: #fff;
        gap: 15px;
    }

    /* =========================================================
       VIDEO GRID
    ========================================================= */

    .video-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
    }

    .video-card {
        background: #fff;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(23, 61, 43, .07);
        transition:
            transform .3s ease,
            box-shadow .3s ease;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 60px rgba(23, 61, 43, .13);
    }

    .video-frame {
        position: relative;
        background: var(--forest-dark);
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .video-frame iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    .video-info {
        padding: 22px 24px 25px;
    }

    .video-label {
        display: block;
        margin-bottom: 8px;
        color: var(--gold);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .video-title {
        margin: 0;
        color: var(--forest);
        font-size: 18px;
        font-weight: 600;
        line-height: 1.4;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .gallery-empty {
        grid-column: 1 / -1;
        padding: 70px 25px;
        text-align: center;
        background: #fff;
        border: 1px solid var(--border);
    }

    .gallery-empty i {
        color: var(--gold);
        font-size: 35px;
        margin-bottom: 18px;
    }

    .gallery-empty h4 {
        color: var(--forest);
        margin-bottom: 8px;
    }

    .gallery-empty p {
        color: var(--text);
        margin: 0;
    }

    /* =========================================================
       CTA
    ========================================================= */

    .gallery-cta {
        position: relative;
        overflow: hidden;
        padding: 85px 20px;
        background:
            linear-gradient(
                100deg,
                rgba(12, 40, 27, .98),
                rgba(23, 61, 43, .92)
            );
        text-align: center;
    }

    .gallery-cta::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        border: 1px solid rgba(212,193,141,.18);
        border-radius: 50%;
        top: -220px;
        left: -120px;
    }

    .gallery-cta::after {
        content: "";
        position: absolute;
        width: 500px;
        height: 500px;
        border: 1px solid rgba(212,193,141,.12);
        border-radius: 50%;
        bottom: -300px;
        right: -150px;
    }

    .gallery-cta-inner {
        position: relative;
        z-index: 2;
    }

    .gallery-cta-label {
        color: var(--gold-light);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
    }

    .gallery-cta h2 {
        color: #fff;
        max-width: 700px;
        margin: 12px auto 15px;
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.15;
    }

    .gallery-cta p {
        max-width: 600px;
        margin: 0 auto;
        color: rgba(255,255,255,.7);
        line-height: 1.8;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .premium-gallery-hero {
            min-height: 480px;
        }

        .gallery-card:nth-child(n) {
            grid-column: span 6;
            min-height: 360px;
        }

        .gallery-card:nth-child(6n + 1),
        .gallery-card:nth-child(6n + 2) {
            min-height: 420px;
        }

        .video-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {

        .premium-gallery-hero {
            min-height: 420px;
        }

        .premium-gallery-hero h1 {
            letter-spacing: -1px;
        }

        .gallery-intro {
            padding: 65px 0 25px;
        }

        .gallery-main {
            padding-bottom: 75px;
        }

        .gallery-switcher-wrap {
            margin-bottom: 30px;
        }

        .gallery-switcher button {
            min-width: 105px;
            padding: 11px 20px;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .gallery-card:nth-child(n) {
            grid-column: span 1;
            min-height: 390px;
        }

        .gallery-card:nth-child(6n + 1),
        .gallery-card:nth-child(6n + 2) {
            min-height: 390px;
        }

        .gallery-card-content {
            left: 22px;
            right: 22px;
            bottom: 21px;
        }

        .gallery-card-title {
            font-size: 19px;
        }

        .video-card {
            border-radius: 0;
        }

        .gallery-cta {
            padding: 70px 20px;
        }
    }

    @media (max-width: 400px) {

        .gallery-switcher button {
            min-width: 95px;
            padding: 10px 15px;
            font-size: 12px;
        }

        .gallery-card:nth-child(n) {
            min-height: 340px;
        }
    }
</style>


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
@extends('frontend.layouts.master')

@section('content')

<style>
    /* =========================================================
       UNIQUE NEPAL — SINGLE GALLERY
    ========================================================= */

    .premium-single-gallery {
        --forest: #173d2b;
        --forest-dark: #0c281b;
        --gold: #b49352;
        --gold-light: #d8c18d;
        --cream: #f7f4ed;
        --soft-bg: #f3f5f1;
        --text: #5d6861;
        --dark-text: #17201b;
        --border: rgba(23, 61, 43, .12);
    }

    /* =========================================================
       HERO
    ========================================================= */

    .single-gallery-hero {
        position: relative;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;

        background:
            linear-gradient(
                180deg,
                rgba(12, 40, 27, .12),
                rgba(12, 40, 27, .88)
            ),
            url('{{ asset('image/events.jpg') }}') center center / cover no-repeat;
    }

    .single-gallery-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(12, 40, 27, .75),
            transparent 70%
        );
    }

    .single-gallery-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding-top: 65px;
    }

    .single-gallery-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: var(--gold-light);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .single-gallery-eyebrow::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--gold-light);
    }

    .single-gallery-hero h1 {
        max-width: 900px;
        margin: 0 auto;
        color: #fff;
        font-size: clamp(40px, 6vw, 70px);
        line-height: 1.02;
        font-weight: 700;
        letter-spacing: -2px;
    }

    .single-gallery-breadcrumb {
        margin-top: 25px;
        color: rgba(255,255,255,.7);
        font-size: 14px;
    }

    .single-gallery-breadcrumb .home {
        color: #fff;
        font-weight: 600;
    }

    .single-gallery-breadcrumb i {
        color: var(--gold-light);
        margin: 0 10px;
        font-size: 11px;
    }

    /* =========================================================
       MAIN
    ========================================================= */

    .single-gallery-main {
        padding: 90px 0 110px;
        background: var(--soft-bg);
    }

    .single-gallery-header {
        max-width: 850px;
        margin: 0 auto 55px;
        text-align: center;
    }

    .single-gallery-label {
        color: var(--gold);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 13px;
    }

    .single-gallery-title {
        color: var(--forest);
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.12;
        font-weight: 700;
        letter-spacing: -1px;
        margin: 0;
    }

    .single-gallery-line {
        width: 55px;
        height: 2px;
        background: var(--gold);
        margin: 22px auto;
    }

    .single-gallery-description {
        max-width: 700px;
        margin: 0 auto;
        color: var(--text);
        font-size: 16px;
        line-height: 1.85;
    }

    /* =========================================================
       PHOTO GRID
    ========================================================= */

    .single-photo-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 18px;
    }

    .single-photo {
        position: relative;
        display: block;
        overflow: hidden;
        background: #dfe5df;
        min-height: 360px;
        text-decoration: none;
        isolation: isolate;
    }

    /*
       Editorial layout
    */

    .single-photo:nth-child(6n + 1) {
        grid-column: span 7;
        min-height: 510px;
    }

    .single-photo:nth-child(6n + 2) {
        grid-column: span 5;
        min-height: 510px;
    }

    .single-photo:nth-child(6n + 3),
    .single-photo:nth-child(6n + 4),
    .single-photo:nth-child(6n + 5) {
        grid-column: span 4;
        min-height: 350px;
    }

    .single-photo:nth-child(6n + 6) {
        grid-column: span 8;
        min-height: 350px;
    }

    .single-photo img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition:
            transform .8s cubic-bezier(.2,.65,.25,1),
            filter .5s ease;
    }

    .single-photo::after {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
        background:
            linear-gradient(
                to top,
                rgba(8, 25, 17, .58),
                transparent 55%
            );
        opacity: .8;
        transition: opacity .4s ease;
    }

    .single-photo:hover img {
        transform: scale(1.06);
        filter: brightness(.82);
    }

    .single-photo:hover::after {
        opacity: 1;
    }

    /* =========================================================
       PHOTO OVERLAY
    ========================================================= */

    .photo-number {
        position: absolute;
        z-index: 3;
        top: 20px;
        left: 22px;
        color: rgba(255,255,255,.9);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .photo-expand {
        position: absolute;
        z-index: 3;
        top: 18px;
        right: 18px;

        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #fff;
        background: rgba(12,40,27,.45);
        border: 1px solid rgba(255,255,255,.3);
        backdrop-filter: blur(7px);

        opacity: 0;
        transform: translateY(-8px);
        transition: all .35s ease;
    }

    .single-photo:hover .photo-expand {
        opacity: 1;
        transform: translateY(0);
    }

    .photo-bottom {
        position: absolute;
        z-index: 3;
        left: 23px;
        right: 23px;
        bottom: 20px;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .photo-bottom span {
        color: rgba(255,255,255,.8);
        font-size: 11px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .photo-bottom i {
        color: var(--gold-light);
        font-size: 13px;
    }

    /* =========================================================
       BACK LINK
    ========================================================= */

    .gallery-back {
        display: flex;
        justify-content: center;
        margin-top: 55px;
    }

    .gallery-back a {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        color: var(--forest);
        border-bottom: 1px solid var(--gold);

        padding-bottom: 7px;

        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;

        transition: gap .25s ease;
    }

    .gallery-back a:hover {
        color: var(--gold);
        gap: 17px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .single-gallery-hero {
            min-height: 450px;
        }

        .single-photo:nth-child(n) {
            grid-column: span 6;
            min-height: 360px;
        }

        .single-photo:nth-child(6n + 1),
        .single-photo:nth-child(6n + 2) {
            min-height: 430px;
        }
    }

    @media (max-width: 767px) {

        .single-gallery-hero {
            min-height: 410px;
        }

        .single-gallery-main {
            padding: 65px 0 80px;
        }

        .single-gallery-header {
            margin-bottom: 35px;
        }

        .single-photo-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .single-photo:nth-child(n) {
            grid-column: span 1;
            min-height: 350px;
        }

        .single-photo:nth-child(6n + 1),
        .single-photo:nth-child(6n + 2) {
            min-height: 400px;
        }

        .photo-expand {
            opacity: 1;
            transform: none;
        }
    }
</style>


<div class="premium-single-gallery">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="single-gallery-hero">

        <div class="single-gallery-hero-content">

            <div class="container text-center">

                <div class="single-gallery-eyebrow">
                    Unique Nepal
                </div>

                <h1>
                    Explore Image
                </h1>

                <div class="single-gallery-breadcrumb">

                    <span class="home">
                        Home
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        Gallery
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ $image->title }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <section class="single-gallery-main">

        <div class="container">

            {{-- HEADER --}}

            <div class="single-gallery-header">

                <div class="single-gallery-label">
                    Photo Story
                </div>

                <h2 class="single-gallery-title">
                    {{ $image->title }}
                </h2>

                <div class="single-gallery-line"></div>

                @if(!empty($image->img_desc))

                    <div class="single-gallery-description">
                        {{ $image->img_desc }}
                    </div>

                @endif

            </div>


            {{-- =================================================
                 IMAGES
            ================================================== --}}

            <div class="single-photo-grid">

                @foreach (array_reverse($image->img) as $index => $imgUrl)

                    <a
                        href="{{ asset($imgUrl) }}"
                        class="single-photo image-link"
                        title="{{ $image->title }}">

                        <img
                            src="{{ asset($imgUrl) }}"
                            alt="{{ $image->title }} - Image {{ $index + 1 }}"
                            loading="{{ $index < 2 ? 'eager' : 'lazy' }}">

                        <span class="photo-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <span class="photo-expand">
                            <i class="fas fa-expand-alt"></i>
                        </span>

                        <span class="photo-bottom">

                            <span>
                                {{ $image->title }}
                            </span>

                            <i class="fas fa-arrow-up-right-from-square"></i>

                        </span>

                    </a>

                @endforeach

            </div>


            {{-- BACK --}}

            <div class="gallery-back">

                <a href="{{ url()->previous() }}">

                    <i class="fas fa-arrow-left"></i>

                    Back to Gallery

                </a>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     MAGNIFIC POPUP
========================================================= --}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">


<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js">
</script>


<script>
    $(document).ready(function () {

        $('.image-link').magnificPopup({

            type: 'image',

            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 2]
            },

            image: {
                titleSrc: 'title'
            },

            removalDelay: 200,

            mainClass: 'mfp-fade',

            closeOnContentClick: false,

            fixedContentPos: true

        });

    });
</script>

@endsection
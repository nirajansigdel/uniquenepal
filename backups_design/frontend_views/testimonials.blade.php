@extends('frontend.layouts.master')

<head>
    <title>{{ $testimonialmeta?->title ?? 'Testimonials | Unique Nepal' }}</title>
    <meta
        name="description"
        content="{{ $testimonialmeta?->description ?? '' }}"
    >
</head>

@section('content')

<style>
    /* =========================================================
       PREMIUM TESTIMONIAL PAGE
    ========================================================= */

    :root {
        --testimonial-green: #173d2b;
        --testimonial-green-dark: #0c281b;
        --testimonial-green-light: #2f6849;

        --testimonial-gold: #b49352;
        --testimonial-gold-light: #d8c18d;

        --testimonial-cream: #f7f4ed;
        --testimonial-soft: #f3f5f1;

        --testimonial-text: #5d6861;
        --testimonial-dark: #17201b;

        --testimonial-border: rgba(23, 61, 43, .12);
    }

    .premium-testimonials-page {
        background: #fff;
        color: var(--testimonial-dark);
        overflow: hidden;
    }


    /* =========================================================
       HERO
    ========================================================= */

    .testimonials-hero {
        min-height: 540px;

        position: relative;

        display: flex;
        align-items: flex-end;

        overflow: hidden;

        background:
            linear-gradient(
                to top,
                rgba(5, 20, 13, .95) 0%,
                rgba(5, 20, 13, .70) 45%,
                rgba(5, 20, 13, .16) 100%
            ),
            url('{{ asset('image/gallery.jpg') }}')
            center center / cover no-repeat;
    }

    .testimonials-hero::after {
        content: "";

        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                90deg,
                rgba(5, 20, 13, .25),
                transparent 65%
            );

        pointer-events: none;
    }

    .testimonials-hero-content {
        position: relative;
        z-index: 2;

        width: 100%;

        padding-bottom: 72px;
    }

    .testimonials-hero-label {
        display: inline-flex;

        align-items: center;

        gap: 12px;

        color: var(--testimonial-gold-light);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.8px;

        margin-bottom: 18px;
    }

    .testimonials-hero-label::before {
        content: "";

        width: 38px;
        height: 1px;

        background: var(--testimonial-gold-light);
    }

    .testimonials-hero-title {
        color: #fff;

        font-size: clamp(48px, 7vw, 80px);

        line-height: 1;

        font-weight: 600;

        letter-spacing: -2px;

        margin: 0 0 23px;
    }

    .testimonials-breadcrumb {
        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 11px;

        color: rgba(255,255,255,.65);

        font-size: 13px;
    }

    .testimonials-breadcrumb i {
        color: var(--testimonial-gold-light);

        font-size: 9px;
    }

    .testimonials-breadcrumb strong {
        color: #fff;
    }


    /* =========================================================
       INTRO
    ========================================================= */

    .testimonials-intro {
        padding: 100px 0 75px;

        background: #fff;
    }

    .testimonials-intro-inner {
        max-width: 850px;

        margin: auto;

        text-align: center;
    }

    .testimonials-intro-label {
        color: var(--testimonial-gold);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.5px;

        margin-bottom: 17px;
    }

    .testimonials-intro-title {
        color: var(--testimonial-green);

        font-size: clamp(36px, 5vw, 60px);

        line-height: 1.1;

        font-weight: 600;

        margin: 0 0 22px;
    }

    .testimonials-intro-line {
        width: 55px;
        height: 2px;

        background: var(--testimonial-gold);

        margin: 0 auto 25px;
    }

    .testimonials-intro-text {
        color: var(--testimonial-text);

        font-size: 16px;

        line-height: 1.9;

        max-width: 720px;

        margin: auto;
    }


    /* =========================================================
       TESTIMONIAL SECTION
    ========================================================= */

    .testimonials-section {
        padding: 30px 0 115px;

        background: var(--testimonial-soft);
    }

    .testimonials-section-heading {
        margin-bottom: 50px;
    }

    .testimonials-section-label {
        color: var(--testimonial-gold);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.4px;

        margin-bottom: 12px;
    }

    .testimonials-section-title {
        color: var(--testimonial-green);

        font-size: clamp(32px, 4vw, 48px);

        line-height: 1.15;

        font-weight: 600;

        margin: 0;
    }


    /* =========================================================
       TESTIMONIAL CARD
    ========================================================= */

    .testimonial-card {
        position: relative;

        height: 100%;

        background: #fff;

        padding: 42px 35px 38px;

        border: 1px solid var(--testimonial-border);

        transition:
            transform .45s ease,
            box-shadow .45s ease;
    }

    .testimonial-card:hover {
        transform: translateY(-8px);

        box-shadow:
            0 25px 60px rgba(20, 48, 34, .13);
    }


    /* =========================================================
       QUOTE
    ========================================================= */

    .testimonial-quote {
        position: absolute;

        top: 22px;
        right: 27px;

        color: var(--testimonial-gold);

        font-family: Georgia, serif;

        font-size: 65px;

        line-height: 1;

        opacity: .28;
    }


    /* =========================================================
       PROFILE
    ========================================================= */

    .testimonial-profile {
        display: flex;

        align-items: center;

        gap: 16px;

        margin-bottom: 25px;
    }

    .testimonial-image-wrap {
        position: relative;
    }

    .testimonial-image {
        width: 75px;
        height: 75px;

        object-fit: cover;

        border-radius: 50%;

        display: block;

        border: 3px solid #fff;

        box-shadow:
            0 5px 18px rgba(0,0,0,.12);
    }

    .testimonial-image-wrap::after {
        content: "";

        position: absolute;

        width: 14px;
        height: 14px;

        right: 0;
        bottom: 3px;

        border-radius: 50%;

        background: var(--testimonial-gold);

        border: 3px solid #fff;
    }

    .testimonial-name {
        color: var(--testimonial-green);

        font-size: 18px;

        font-weight: 700;

        margin: 0 0 4px;
    }

    .testimonial-position {
        color: #89918c;

        font-size: 12px;

        margin: 0;
    }


    /* =========================================================
       RATING
    ========================================================= */

    .testimonial-rating {
        display: flex;

        gap: 4px;

        margin-bottom: 22px;
    }

    .testimonial-rating i {
        color: var(--testimonial-gold);

        font-size: 12px;
    }


    /* =========================================================
       REVIEW
    ========================================================= */

    .testimonial-review {
        position: relative;

        color: var(--testimonial-text);

        font-size: 14px;

        line-height: 1.9;

        margin: 0;
    }

    .testimonial-review::before {
        content: "";

        display: block;

        width: 40px;
        height: 2px;

        background: var(--testimonial-gold);

        margin-bottom: 20px;
    }


    /* =========================================================
       CTA
    ========================================================= */

    .testimonials-cta {
        padding: 110px 0;

        background:
            linear-gradient(
                rgba(12, 39, 26, .94),
                rgba(12, 39, 26, .94)
            ),
            url('{{ asset('image/gallery.jpg') }}')
            center / cover no-repeat;
    }

    .testimonials-cta-inner {
        max-width: 820px;

        margin: auto;

        text-align: center;
    }

    .testimonials-cta-label {
        color: var(--testimonial-gold-light);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.5px;

        margin-bottom: 18px;
    }

    .testimonials-cta-title {
        color: #fff;

        font-size: clamp(40px, 5vw, 64px);

        line-height: 1.08;

        font-weight: 600;

        margin: 0 0 20px;
    }

    .testimonials-cta-text {
        color: rgba(255,255,255,.72);

        font-size: 15px;

        line-height: 1.85;

        max-width: 670px;

        margin: 0 auto 32px;
    }

    .testimonials-cta-button {
        display: inline-flex;

        align-items: center;

        gap: 13px;

        padding: 15px 26px;

        background: var(--testimonial-gold);

        color: #fff !important;

        text-decoration: none;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 1.5px;

        transition: all .3s ease;
    }

    .testimonials-cta-button:hover {
        background: #fff;

        color: var(--testimonial-green) !important;

        transform: translateY(-2px);
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .testimonial-empty {
        padding: 90px 20px;

        text-align: center;
    }

    .testimonial-empty-icon {
        width: 70px;
        height: 70px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 20px;

        background: var(--testimonial-cream);

        color: var(--testimonial-gold);

        border-radius: 50%;

        font-size: 22px;
    }

    .testimonial-empty p {
        color: var(--testimonial-text);

        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .testimonials-hero {
            min-height: 500px;
        }

        .testimonials-intro {
            padding: 75px 0 55px;
        }

        .testimonials-section {
            padding-bottom: 80px;
        }

        .testimonials-cta {
            padding: 85px 0;
        }
    }


    @media (max-width: 767px) {

        .testimonials-hero {
            min-height: 470px;
        }

        .testimonials-hero-content {
            padding-bottom: 50px;
        }

        .testimonials-hero-title {
            font-size: 44px;
            letter-spacing: -1px;
        }

        .testimonials-intro {
            padding: 65px 20px 50px;
        }

        .testimonials-intro-title {
            font-size: 36px;
        }

        .testimonials-intro-text {
            font-size: 14px;
            line-height: 1.8;
        }

        .testimonials-section {
            padding: 25px 15px 65px;
        }

        .testimonials-section-title {
            font-size: 34px;
        }

        .testimonial-card {
            padding: 35px 27px 30px;
        }

        .testimonials-cta {
            padding: 75px 20px;
        }

        .testimonials-cta-title {
            font-size: 40px;
        }
    }
</style>


<div class="premium-testimonials-page">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="testimonials-hero">

        <div class="container">

            <div class="testimonials-hero-content">

                <div class="testimonials-hero-label">
                    Unique Nepal
                </div>

                <h1 class="testimonials-hero-title">
                    {{ __('messages.testimonials') }}
                </h1>

                <div class="testimonials-breadcrumb">

                    <strong>
                        {{ __('messages.Home') }}
                    </strong>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.testimonials') }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         INTRO
    ====================================================== --}}

    <section class="testimonials-intro">

        <div class="container">

            <div class="testimonials-intro-inner">

                <div class="testimonials-intro-label">
                    Traveler Stories
                </div>

                <h2 class="testimonials-intro-title">
                    {{ __('messages.hear_happy_travelers') }}
                </h2>

                <div class="testimonials-intro-line"></div>

                <p class="testimonials-intro-text">
                    Every journey creates a story. Discover what
                    travelers from around the world experienced with
                    Unique Nepal.
                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
         TESTIMONIALS
    ====================================================== --}}

    <section class="testimonials-section">

        <div class="container">


            <div class="testimonials-section-heading">

                <div class="testimonials-section-label">
                    From our travelers
                </div>

                <h2 class="testimonials-section-title">
                    Stories from the journey.
                </h2>

            </div>


            <div class="row g-4">

                @forelse($testimonials as $index => $testimonial)

                    <div
                        class="col-md-6 col-lg-4"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 3) * 100 }}"
                    >

                        <article class="testimonial-card">


                            {{-- QUOTE ICON --}}

                            <div class="testimonial-quote">
                                “
                            </div>


                            {{-- PROFILE --}}

                            <div class="testimonial-profile">

                                <div class="testimonial-image-wrap">

                                    @if(!empty($testimonial->image))

                                        <img
                                            src="{{ asset(
                                                'uploads/testimonial/' .
                                                $testimonial->image
                                            ) }}"
                                            alt="{{ $testimonial->name }}"
                                            class="testimonial-image"
                                            loading="lazy"
                                        >

                                    @else

                                        <div
                                            class="testimonial-image d-flex align-items-center justify-content-center"
                                            style="
                                                background: var(--testimonial-green);
                                                color: var(--testimonial-gold-light);
                                            "
                                        >
                                            <i class="fas fa-user"></i>
                                        </div>

                                    @endif

                                </div>


                                <div>

                                    <h3 class="testimonial-name">
                                        {{ $testimonial->name }}
                                    </h3>

                                    <p class="testimonial-position">
                                        {{ $testimonial->getTranslated('position') ?? 'Traveler' }}
                                    </p>

                                </div>

                            </div>


                            {{-- RATING --}}

                            <div class="testimonial-rating">

                                @for ($i = 0; $i < 5; $i++)

                                    <i class="fas fa-star"></i>

                                @endfor

                            </div>


                            {{-- REVIEW --}}

                            <p class="testimonial-review">
                                {{ $testimonial->getTranslated('description') }}
                            </p>


                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="testimonial-empty">

                            <div class="testimonial-empty-icon">
                                <i class="fas fa-comments"></i>
                            </div>

                            <p>
                                No testimonials available at the moment.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =====================================================
         CTA
    ====================================================== --}}

    <section class="testimonials-cta">

        <div class="container">

            <div class="testimonials-cta-inner">

                <div class="testimonials-cta-label">
                    Your story could be next
                </div>

                <h2 class="testimonials-cta-title">
                    Come experience Nepal.
                </h2>

                <p class="testimonials-cta-text">
                    From the first step on a Himalayan trail to the
                    final sunset over the mountains, create a journey
                    worth remembering.
                </p>

                <a
                    href="{{ route('Service') }}"
                    class="testimonials-cta-button"
                >
                    Start Your Journey
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     AOS
========================================================= --}}

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof AOS !== 'undefined') {

            AOS.init({
                duration: 850,
                once: true,
                offset: 70
            });

        }

    });
</script>

@endsection
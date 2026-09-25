@extends('frontend.layouts.master')

<head>
    <title>{{ $servicemeta?->title ?? 'Our Services | Unique Nepal' }}</title>
    <meta name="description" content="{{ $servicemeta?->description ?? '' }}">
</head>

@section('content')

<style>
    /* =========================================================
       PREMIUM SERVICES PAGE
    ========================================================= */

    :root {
        --service-green: #173d2b;
        --service-green-dark: #0d281c;
        --service-green-light: #2f6849;
        --service-gold: #b49352;
        --service-gold-light: #d8c18d;
        --service-cream: #f7f4ed;
        --service-soft: #f3f5f1;
        --service-text: #5d6861;
        --service-dark: #18201c;
        --service-border: rgba(23, 61, 43, .12);
    }

    .premium-services-page {
        background: #fff;
        color: var(--service-dark);
        overflow: hidden;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .services-hero {
        min-height: 540px;
        position: relative;
        display: flex;
        align-items: flex-end;
        overflow: hidden;

        background:
            linear-gradient(
                to top,
                rgba(6, 22, 14, .95) 0%,
                rgba(6, 22, 14, .70) 45%,
                rgba(6, 22, 14, .15) 100%
            ),
            url('{{ asset('image/gallery.jpg') }}') center center / cover no-repeat;
    }

    .services-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                90deg,
                rgba(7, 26, 17, .25),
                transparent 65%
            );
        pointer-events: none;
    }

    .services-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding-bottom: 72px;
    }

    .services-hero-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        color: var(--service-gold-light);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.8px;

        margin-bottom: 18px;
    }

    .services-hero-label::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--service-gold-light);
    }

    .services-hero-title {
        color: #fff;
        font-size: clamp(48px, 7vw, 80px);
        line-height: 1;
        font-weight: 700;
        letter-spacing: -2px;
        margin: 0 0 23px;
    }

    .services-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 11px;

        color: rgba(255,255,255,.65);
        font-size: 13px;
    }

    .services-breadcrumb i {
        color: var(--service-gold-light);
        font-size: 9px;
    }

    .services-breadcrumb strong {
        color: #fff;
    }


    /* =========================================================
       INTRO
    ========================================================= */

    .services-intro {
        padding: 100px 0 80px;
        background: #fff;
    }

    .services-intro-inner {
        max-width: 900px;
        margin: auto;
        text-align: center;
    }

    .services-intro-label {
        color: var(--service-gold);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        margin-bottom: 17px;
    }

    .services-intro-title {
        color: var(--service-green);
        font-size: clamp(36px, 5vw, 60px);
        line-height: 1.1;
        font-weight: 600;
        margin: 0 0 23px;
    }

    .services-intro-line {
        width: 55px;
        height: 2px;
        background: var(--service-gold);
        margin: 0 auto 25px;
    }

    .services-intro-text {
        color: var(--service-text);
        font-size: 16px;
        line-height: 1.9;
        max-width: 730px;
        margin: auto;
    }


    /* =========================================================
       SERVICES SECTION
    ========================================================= */

    .services-section {
        padding: 30px 0 115px;
        background: var(--service-soft);
    }

    .services-section-heading {
        margin-bottom: 55px;
    }

    .services-section-label {
        color: var(--service-gold);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.4px;
        margin-bottom: 12px;
    }

    .services-section-title {
        color: var(--service-green);
        font-size: clamp(32px, 4vw, 48px);
        line-height: 1.15;
        font-weight: 600;
        margin: 0;
    }


    /* =========================================================
       SERVICE CARD
    ========================================================= */

    .premium-service-card {
        display: block;
        position: relative;
        height: 100%;
        background: #fff;

        text-decoration: none !important;

        overflow: hidden;

        border: 1px solid var(--service-border);

        transition:
            transform .45s ease,
            box-shadow .45s ease;
    }

    .premium-service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(20, 48, 34, .14);
    }


    /* =========================================================
       IMAGE
    ========================================================= */

    .service-image {
        position: relative;
        height: 330px;
        overflow: hidden;
        background: var(--service-green);
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;

        transition:
            transform .8s cubic-bezier(.2,.7,.2,1);
    }

    .premium-service-card:hover .service-image img {
        transform: scale(1.06);
    }

    .service-image-overlay {
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                to top,
                rgba(7, 25, 16, .72),
                transparent 55%
            );
    }


    /* =========================================================
       NUMBER
    ========================================================= */

    .service-number {
        position: absolute;

        top: 20px;
        left: 20px;

        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--service-green);

        color: var(--service-gold-light);

        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;

        z-index: 3;
    }


    /* =========================================================
       CARD CONTENT
    ========================================================= */

    .service-content {
        position: relative;
        padding: 30px 30px 32px;
    }

    .service-content::before {
        content: "";
        position: absolute;

        top: 0;
        left: 30px;

        width: 45px;
        height: 2px;

        background: var(--service-gold);
    }

    .service-title {
        color: var(--service-green);

        font-size: 25px;
        line-height: 1.25;
        font-weight: 600;

        margin: 0 0 14px;

        transition: color .3s ease;
    }

    .premium-service-card:hover .service-title {
        color: var(--service-gold);
    }

    .service-description {
        color: var(--service-text);

        font-size: 14px;
        line-height: 1.8;

        margin: 0 0 22px;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 11px;

        color: var(--service-green);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .service-link i {
        color: var(--service-gold);
        transition: transform .3s ease;
    }

    .premium-service-card:hover .service-link i {
        transform: translateX(5px);
    }


    /* =========================================================
       CTA
    ========================================================= */

    .services-cta {
        position: relative;

        padding: 110px 0;

        background:
            linear-gradient(
                rgba(12, 39, 26, .94),
                rgba(12, 39, 26, .94)
            ),
            url('{{ asset('image/gallery.jpg') }}') center / cover no-repeat;
    }

    .services-cta-inner {
        max-width: 820px;
        margin: auto;
        text-align: center;
    }

    .services-cta-label {
        color: var(--service-gold-light);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.5px;

        margin-bottom: 18px;
    }

    .services-cta-title {
        color: #fff;

        font-size: clamp(40px, 5vw, 64px);
        line-height: 1.08;
        font-weight: 600;

        margin: 0 0 20px;
    }

    .services-cta-text {
        color: rgba(255,255,255,.72);

        font-size: 15px;
        line-height: 1.85;

        max-width: 670px;
        margin: 0 auto 32px;
    }

    .services-cta-button {
        display: inline-flex;
        align-items: center;
        gap: 13px;

        background: var(--service-gold);
        color: #fff !important;

        padding: 15px 26px;

        text-decoration: none;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.5px;

        transition: all .3s ease;
    }

    .services-cta-button:hover {
        background: #fff;
        color: var(--service-green) !important;
        transform: translateY(-2px);
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .services-empty {
        padding: 100px 20px;
        text-align: center;
    }

    .services-empty-icon {
        width: 70px;
        height: 70px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 20px;

        border-radius: 50%;

        background: var(--service-cream);
        color: var(--service-gold);

        font-size: 23px;
    }

    .services-empty p {
        color: var(--service-text);
        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .services-hero {
            min-height: 500px;
        }

        .services-intro {
            padding: 75px 0 60px;
        }

        .services-section {
            padding-bottom: 80px;
        }

        .service-image {
            height: 300px;
        }

        .services-cta {
            padding: 85px 0;
        }
    }


    @media (max-width: 767px) {

        .services-hero {
            min-height: 470px;
        }

        .services-hero-content {
            padding-bottom: 50px;
        }

        .services-hero-title {
            font-size: 44px;
            letter-spacing: -1px;
        }

        .services-intro {
            padding: 65px 20px 50px;
        }

        .services-intro-title {
            font-size: 36px;
        }

        .services-intro-text {
            font-size: 14px;
            line-height: 1.8;
        }

        .services-section {
            padding: 25px 15px 65px;
        }

        .services-section-heading {
            margin-bottom: 35px;
        }

        .services-section-title {
            font-size: 34px;
        }

        .service-image {
            height: 280px;
        }

        .service-content {
            padding: 27px 24px 30px;
        }

        .service-content::before {
            left: 24px;
        }

        .service-title {
            font-size: 23px;
        }

        .service-description {
            font-size: 13px;
        }

        .services-cta {
            padding: 75px 20px;
        }

        .services-cta-title {
            font-size: 40px;
        }
    }
</style>


<div class="premium-services-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="services-hero">

        <div class="container">

            <div class="services-hero-content">

                <div class="services-hero-label">
                    Unique Nepal
                </div>

                <h1 class="services-hero-title">
                    {{ __('messages.our_services') }}
                </h1>

                <div class="services-breadcrumb">

                    <strong>
                        {{ __('messages.Home') }}
                    </strong>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.our_services') }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         INTRO
    ====================================================== --}}

    <section class="services-intro">

        <div class="container">

            <div class="services-intro-inner">

                <div class="services-intro-label">
                    Travel differently
                </div>

                <h2 class="services-intro-title">
                    {{ __('messages.see_list_services') }}
                </h2>

                <div class="services-intro-line"></div>

                <p class="services-intro-text">
                    "{{ __('messages.empower_all_services') }}"
                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
         SERVICES
    ====================================================== --}}

    <section class="services-section">

        <div class="container">

            <div class="services-section-heading">

                <div class="services-section-label">
                    Discover Nepal
                </div>

                <h2 class="services-section-title">
                    Experiences designed around you.
                </h2>

            </div>


            <div class="row g-4">

                @forelse ($services as $index => $service)

                    <div
                        class="col-md-6 col-lg-4"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 3) * 100 }}"
                    >

                        <a
                            href="{{ route('SingleService', ['slug' => $service->slug]) }}"
                            class="premium-service-card"
                        >

                            {{-- IMAGE --}}

                            <div class="service-image">

                                <div class="service-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                @if(!empty($service->image))

                                    <img
                                        src="{{ asset('uploads/service/' . $service->image) }}"
                                        alt="{{ $service->getTranslated('title') }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">

                                        <i
                                            class="fas fa-mountain"
                                            style="font-size:60px;color:var(--service-gold-light);"
                                        ></i>

                                    </div>

                                @endif

                                <div class="service-image-overlay"></div>

                            </div>


                            {{-- CONTENT --}}

                            <div class="service-content">

                                <h3 class="service-title">

                                    {{ Str::limit(
                                        strip_tags($service->getTranslated('title')),
                                        36
                                    ) }}

                                </h3>

                                <p class="service-description">

                                    {!! Str::limit(
                                        str_replace(
                                            '&nbsp;',
                                            ' ',
                                            strip_tags($service->getTranslated('description'))
                                        ),
                                        180
                                    ) !!}

                                </p>

                                <div class="service-link">

                                    {{ __('messages.view_details') }}

                                    <i class="fas fa-arrow-right"></i>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="services-empty">

                            <div class="services-empty-icon">
                                <i class="fas fa-mountain"></i>
                            </div>

                            <p>
                                No services available at the moment.
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

    <section class="services-cta">

        <div class="container">

            <div class="services-cta-inner">

                <div class="services-cta-label">
                    Your journey starts here
                </div>

                <h2 class="services-cta-title">
                    Your Nepal.<br>
                    Your way.
                </h2>

                <p class="services-cta-text">
                    Whether you are looking for a Himalayan adventure,
                    cultural discovery or a journey designed entirely
                    around your interests, we are here to make it happen.
                </p>

                <a
                    href="{{ route('Service') }}"
                    class="services-cta-button"
                >
                    Explore Our Services
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
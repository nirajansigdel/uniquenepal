@extends('frontend.layouts.master')

<head>
    <title>
        {{ $service->getTranslated('title') }}
        {{ $singleservicemeta?->title ?? ' | Unique Nepal' }}
    </title>

    <meta
        name="description"
        content="{{ $singleservicemeta?->description ?? Str::limit(strip_tags($service->getTranslated('description')), 155) }}"
    >
</head>

@section('content')

<style>
    /* =========================================================
       PREMIUM SINGLE SERVICE PAGE
    ========================================================= */

    :root {
        --service-green: #173d2b;
        --service-green-dark: #0c281b;
        --service-green-light: #2f6849;
        --service-gold: #b49352;
        --service-gold-light: #d8c18d;

        --service-cream: #f7f4ed;
        --service-soft: #f3f5f1;

        --service-text: #5d6861;
        --service-dark: #17201b;

        --service-border: rgba(23, 61, 43, .12);
    }

    .premium-service-page {
        background: #fff;
        color: var(--service-dark);
        overflow: hidden;
    }


    /* =========================================================
       HERO
    ========================================================= */

    .single-service-hero {
        min-height: 570px;

        position: relative;
        display: flex;
        align-items: flex-end;

        overflow: hidden;

        background:
            linear-gradient(
                to top,
                rgba(5, 20, 13, .96) 0%,
                rgba(5, 20, 13, .72) 42%,
                rgba(5, 20, 13, .18) 100%
            ),
            url('{{ asset('uploads/service/' . $service->image) }}')
            center center / cover no-repeat;
    }

    .single-service-hero::after {
        content: "";

        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                90deg,
                rgba(5, 20, 13, .28),
                transparent 65%
            );

        pointer-events: none;
    }

    .single-service-hero-content {
        position: relative;
        z-index: 2;

        width: 100%;
        padding-bottom: 72px;
    }

    .single-service-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        color: var(--service-gold-light);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.7px;

        margin-bottom: 18px;
    }

    .single-service-label::before {
        content: "";

        width: 38px;
        height: 1px;

        background: var(--service-gold-light);
    }

    .single-service-hero-title {
        max-width: 1000px;

        color: #fff;

        font-size: clamp(44px, 6.5vw, 76px);
        line-height: 1.03;

        font-weight: 600;

        letter-spacing: -1.5px;

        margin: 0 0 25px;
    }

    .single-service-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 11px;

        color: rgba(255,255,255,.65);

        font-size: 13px;
    }

    .single-service-breadcrumb i {
        color: var(--service-gold-light);
        font-size: 9px;
    }

    .single-service-breadcrumb strong {
        color: #fff;
    }


    /* =========================================================
       MAIN CONTENT
    ========================================================= */

    .service-main {
        padding: 95px 0 120px;
    }

    .service-content-column {
        max-width: 850px;
    }


    /* =========================================================
       FEATURED IMAGE
    ========================================================= */

    .service-featured-image {
        position: relative;

        overflow: hidden;

        margin-bottom: 48px;

        background: var(--service-soft);
    }

    .service-featured-image img {
        display: block;

        width: 100%;
        height: 540px;

        object-fit: cover;

        transition:
            transform .8s cubic-bezier(.2,.7,.2,1);
    }

    .service-featured-image:hover img {
        transform: scale(1.025);
    }

    .service-image-label {
        position: absolute;

        left: 20px;
        bottom: 20px;

        padding: 9px 14px;

        background: rgba(17, 42, 28, .92);

        color: #fff;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.4px;
    }


    /* =========================================================
       CONTENT HEADER
    ========================================================= */

    .service-content-header {
        margin-bottom: 38px;
    }

    .service-content-eyebrow {
        color: var(--service-gold);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.2px;

        margin-bottom: 14px;
    }

    .service-content-title {
        color: var(--service-green);

        font-size: clamp(36px, 5vw, 58px);

        line-height: 1.1;

        font-weight: 600;

        margin: 0 0 20px;
    }

    .service-title-line {
        width: 55px;
        height: 2px;

        background: var(--service-gold);

        margin-bottom: 27px;
    }


    /* =========================================================
       HTML CONTENT
    ========================================================= */

    .service-description {
        color: var(--service-text);

        font-size: 16px;

        line-height: 1.95;

        letter-spacing: .01em;
    }

    .service-description p {
        margin-bottom: 25px;
    }

    .service-description h1,
    .service-description h2,
    .service-description h3,
    .service-description h4 {
        color: var(--service-green);

        line-height: 1.25;

        font-weight: 600;

        margin-top: 45px;
        margin-bottom: 18px;
    }

    .service-description h2 {
        font-size: 34px;
    }

    .service-description h3 {
        font-size: 28px;
    }

    .service-description h4 {
        font-size: 22px;
    }

    .service-description ul,
    .service-description ol {
        margin-bottom: 30px;
        padding-left: 25px;
    }

    .service-description li {
        margin-bottom: 10px;
    }

    .service-description a {
        color: var(--service-green);
        font-weight: 600;
    }

    .service-description img {
        max-width: 100%;
        height: auto;

        display: block;

        margin: 30px 0;
    }

    .service-description blockquote {
        margin: 40px 0;

        padding: 20px 30px;

        background: var(--service-cream);

        border-left: 3px solid var(--service-gold);

        color: var(--service-green);

        font-size: 21px;

        line-height: 1.65;
    }


    /* =========================================================
       SIDEBAR
    ========================================================= */

    .service-sidebar {
        position: sticky;
        top: 105px;
    }

    .service-sidebar-card {
        background: var(--service-cream);

        border: 1px solid var(--service-border);

        padding: 32px;
    }

    .sidebar-eyebrow {
        color: var(--service-gold);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2px;

        margin-bottom: 11px;
    }

    .sidebar-title {
        color: var(--service-green);

        font-size: 30px;

        line-height: 1.2;

        font-weight: 600;

        margin: 0 0 25px;
    }

    .service-list {
        list-style: none;

        padding: 0;
        margin: 0;
    }

    .service-list li {
        border-top: 1px solid var(--service-border);

        padding: 16px 0;
    }

    .service-list li:last-child {
        border-bottom: 1px solid var(--service-border);
    }

    .service-list a {
        display: flex;
        align-items: flex-start;

        gap: 12px;

        color: var(--service-green);

        text-decoration: none;

        font-size: 14px;

        line-height: 1.5;

        transition: all .3s ease;
    }

    .service-list a i {
        color: var(--service-gold);

        font-size: 9px;

        margin-top: 6px;

        transition: transform .3s ease;
    }

    .service-list a:hover {
        color: var(--service-gold);
    }

    .service-list a:hover i {
        transform: translateX(4px);
    }


    /* =========================================================
       SIDEBAR CTA
    ========================================================= */

    .service-sidebar-cta {
        margin-top: 24px;

        padding: 32px;

        background: var(--service-green);

        color: #fff;
    }

    .service-sidebar-cta small {
        color: var(--service-gold-light);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.8px;
    }

    .service-sidebar-cta h4 {
        color: #fff;

        font-size: 28px;

        line-height: 1.25;

        font-weight: 600;

        margin: 12px 0 20px;
    }

    .service-sidebar-cta a {
        display: inline-flex;

        align-items: center;

        gap: 12px;

        color: #fff !important;

        text-decoration: none;

        padding-bottom: 7px;

        border-bottom: 1px solid var(--service-gold);

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 1.4px;
    }

    .service-sidebar-cta a i {
        color: var(--service-gold-light);
    }


    /* =========================================================
       BOTTOM CTA
    ========================================================= */

    .service-bottom-cta {
        padding: 105px 0;

        background:
            linear-gradient(
                rgba(12, 39, 26, .94),
                rgba(12, 39, 26, .94)
            ),
            url('{{ asset('image/gallery.jpg') }}')
            center / cover no-repeat;
    }

    .service-bottom-inner {
        max-width: 800px;

        margin: auto;

        text-align: center;
    }

    .service-bottom-label {
        color: var(--service-gold-light);

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2.5px;

        margin-bottom: 18px;
    }

    .service-bottom-title {
        color: #fff;

        font-size: clamp(40px, 5vw, 62px);

        line-height: 1.08;

        font-weight: 600;

        margin: 0 0 20px;
    }

    .service-bottom-text {
        color: rgba(255,255,255,.72);

        max-width: 650px;

        margin: 0 auto 30px;

        font-size: 15px;

        line-height: 1.85;
    }

    .service-bottom-button {
        display: inline-flex;

        align-items: center;

        gap: 13px;

        padding: 15px 26px;

        background: var(--service-gold);

        color: #fff !important;

        text-decoration: none;

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.5px;

        transition: all .3s ease;
    }

    .service-bottom-button:hover {
        background: #fff;

        color: var(--service-green) !important;

        transform: translateY(-2px);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .single-service-hero {
            min-height: 520px;
        }

        .service-main {
            padding: 70px 0 90px;
        }

        .service-sidebar {
            position: relative;
            top: auto;

            margin-top: 50px;
        }

        .service-featured-image img {
            height: 460px;
        }

        .service-bottom-cta {
            padding: 85px 0;
        }
    }


    @media (max-width: 767px) {

        .single-service-hero {
            min-height: 470px;
        }

        .single-service-hero-content {
            padding-bottom: 50px;
        }

        .single-service-hero-title {
            font-size: 42px;
        }

        .service-main {
            padding: 55px 0 70px;
        }

        .service-featured-image {
            margin-bottom: 35px;
        }

        .service-featured-image img {
            height: 320px;
        }

        .service-content-title {
            font-size: 37px;
        }

        .service-description {
            font-size: 15px;
            line-height: 1.85;
        }

        .service-description blockquote {
            font-size: 19px;
            padding: 18px 20px;
        }

        .service-sidebar-card,
        .service-sidebar-cta {
            padding: 25px;
        }

        .service-bottom-cta {
            padding: 75px 20px;
        }

        .service-bottom-title {
            font-size: 40px;
        }
    }
</style>


<div class="premium-service-page">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="single-service-hero">

        <div class="container">

            <div class="single-service-hero-content">

                <div class="single-service-label">
                    Unique Nepal
                </div>

                <h1 class="single-service-hero-title">
                    {{ $service->getTranslated('title') }}
                </h1>

                <div class="single-service-breadcrumb">

                    <strong>
                        {{ __('messages.Home') }}
                    </strong>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.our_services') }}
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ Str::limit(
                            strip_tags($service->getTranslated('title')),
                            55
                        ) }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         MAIN SERVICE CONTENT
    ====================================================== --}}

    <section class="service-main">

        <div class="container">

            <div class="row gx-lg-5 gy-5">


                {{-- =================================================
                     LEFT CONTENT
                ================================================== --}}

                <div class="col-lg-8">

                    <article class="service-content-column">


                        {{-- FEATURED IMAGE --}}

                        <div class="service-featured-image">

                            @if(!empty($service->image))

                                <img
                                    src="{{ asset('uploads/service/' . $service->image) }}"
                                    alt="{{ $service->getTranslated('title') }}"
                                >

                            @endif

                            <div class="service-image-label">
                                {{ __('messages.our_services') }}
                            </div>

                        </div>


                        {{-- CONTENT HEADER --}}

                        <header class="service-content-header">

                            <div class="service-content-eyebrow">
                                Experience Nepal
                            </div>

                            <h2 class="service-content-title">
                                {{ $service->getTranslated('title') }}
                            </h2>

                            <div class="service-title-line"></div>

                        </header>


                        {{-- DESCRIPTION --}}

                        <div class="service-description">

                            {!! str_replace(
                                ['<o:p>', '</o:p>'],
                                '',
                                html_entity_decode(
                                    $service->getTranslated('description')
                                )
                            ) !!}

                        </div>


                    </article>

                </div>


                {{-- =================================================
                     SIDEBAR
                ================================================== --}}

                <div class="col-lg-4">

                    <aside class="service-sidebar">


                        {{-- RELATED SERVICES --}}

                        <div class="service-sidebar-card">

                            <div class="sidebar-eyebrow">
                                Explore More
                            </div>

                            <h3 class="sidebar-title">
                                More ways to discover Nepal.
                            </h3>

                            <ul class="service-list">

                                @foreach ($listservices as $Service)

                                    <li>

                                        <a
                                            href="{{ route(
                                                'SingleService',
                                                ['slug' => $Service->slug]
                                            ) }}"
                                        >

                                            <i class="fas fa-arrow-right"></i>

                                            <span>
                                                {{ $Service->getTranslated('title') }}
                                            </span>

                                        </a>

                                    </li>

                                @endforeach

                            </ul>

                        </div>


                        {{-- CTA --}}

                        <div class="service-sidebar-cta">

                            <small>
                                Plan your journey
                            </small>

                            <h4>
                                Ready to experience Nepal?
                            </h4>

                            <a href="{{ route('Service') }}">

                                Explore our services

                                <i class="fas fa-arrow-right"></i>

                            </a>

                        </div>


                    </aside>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         BOTTOM CTA
    ====================================================== --}}

    <section class="service-bottom-cta">

        <div class="container">

            <div class="service-bottom-inner">

                <div class="service-bottom-label">
                    Your next adventure
                </div>

                <h2 class="service-bottom-title">
                    Nepal is waiting.
                </h2>

                <p class="service-bottom-text">
                    From the Himalayas to ancient cities and hidden
                    mountain communities, discover experiences that
                    stay with you long after the journey ends.
                </p>

                <a
                    href="{{ route('Service') }}"
                    class="service-bottom-button"
                >
                    Explore Our Services
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>


</div>

@endsection
@extends('frontend.layouts.master')

<head>
    <title>{{ $whymeta?->title ?? 'Why Choose Us | Unique Nepal' }}</title>
    <meta name="description" content="{{ $whymeta?->description ?? '' }}">
</head>

@section('content')

<style>
    /* =========================================================
       PREMIUM WHY US PAGE
    ========================================================= */

    :root {
        --why-green: #173d2b;
        --why-green-dark: #0d281c;
        --why-green-light: #2f6849;
        --why-gold: #b49352;
        --why-gold-light: #d8c18d;
        --why-cream: #f7f4ed;
        --why-soft: #f3f5f1;
        --why-text: #5d6861;
        --why-dark: #18201c;
        --why-border: rgba(23, 61, 43, 0.12);
    }

    .premium-why-page {
        font-family: inherit;
        color: var(--why-dark);
        background: #fff;
        overflow: hidden;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .why-hero {
        min-height: 520px;
        position: relative;
        display: flex;
        align-items: flex-end;
        overflow: hidden;

        background:
            linear-gradient(
                to top,
                rgba(6, 22, 14, .94) 0%,
                rgba(6, 22, 14, .68) 45%,
                rgba(6, 22, 14, .15) 100%
            ),
            url('{{ asset('image/gallery.jpg') }}') center center / cover no-repeat;
    }

    .why-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                90deg,
                rgba(7, 26, 17, .25),
                transparent 60%
            );
        pointer-events: none;
    }

    .why-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding-bottom: 70px;
    }

    .why-hero-label {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        color: var(--why-gold-light);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.8px;

        margin-bottom: 18px;
    }

    .why-hero-label::before {
        content: "";
        width: 38px;
        height: 1px;
        background: var(--why-gold-light);
    }

    .why-hero-title {
        color: #fff;
        font-size: clamp(46px, 7vw, 78px);
        line-height: 1.02;
        font-weight: 700;
        margin: 0 0 22px;
        letter-spacing: -1.5px;
    }

    .why-hero-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 11px;

        color: rgba(255,255,255,.65);
        font-size: 13px;
    }

    .why-hero-breadcrumb i {
        color: var(--why-gold-light);
        font-size: 9px;
    }

    .why-hero-breadcrumb strong {
        color: #fff;
    }


    /* =========================================================
       INTRO
    ========================================================= */

    .why-intro {
        padding: 100px 0 75px;
        background: #fff;
    }

    .why-intro-inner {
        max-width: 850px;
        margin: auto;
        text-align: center;
    }

    .why-small-label {
        color: var(--why-gold);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        margin-bottom: 17px;
    }

    .why-intro-title {
        color: var(--why-green);
        font-size: clamp(35px, 5vw, 58px);
        line-height: 1.12;
        font-weight: 600;
        margin: 0 0 22px;
    }

    .why-intro-line {
        width: 55px;
        height: 2px;
        background: var(--why-gold);
        margin: 0 auto 25px;
    }

    .why-intro-text {
        color: var(--why-text);
        font-size: 16px;
        line-height: 1.9;
        max-width: 720px;
        margin: auto;
    }


    /* =========================================================
       WHY ITEMS
    ========================================================= */

    .why-items-section {
        padding: 30px 0 110px;
        background: var(--why-soft);
    }

    .why-item {
        position: relative;
        margin-top: 70px;
    }

    .why-item:first-child {
        margin-top: 30px;
    }

    .why-item-image-wrap {
        position: relative;
        overflow: visible;
    }

    .why-item-image {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;

        transition:
            transform .7s cubic-bezier(.2,.7,.2,1),
            box-shadow .5s ease;
    }

    .why-item-image-wrap::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 80px;

        border: 1px solid var(--why-gold);

        right: -18px;
        bottom: -18px;

        z-index: 0;
    }

    .why-item-image-wrap img {
        position: relative;
        z-index: 1;
    }

    .why-item:hover .why-item-image {
        transform: scale(1.015);
        box-shadow: 0 25px 55px rgba(16, 35, 25, .16);
    }


    /* =========================================================
       NUMBER
    ========================================================= */

    .why-number {
        position: absolute;
        z-index: 3;

        width: 70px;
        height: 70px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--why-green);
        color: var(--why-gold-light);

        font-size: 16px;
        font-weight: 700;
        letter-spacing: 1px;

        left: -25px;
        top: 35px;

        box-shadow: 0 15px 35px rgba(17, 48, 32, .20);
    }


    /* =========================================================
       CONTENT
    ========================================================= */

    .why-item-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;

        padding: 50px 55px;
    }

    .why-item-eyebrow {
        color: var(--why-gold);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.2px;

        margin-bottom: 14px;
    }

    .why-item-title {
        color: var(--why-green);
        font-size: clamp(32px, 4vw, 48px);
        line-height: 1.12;
        font-weight: 600;

        margin: 0 0 22px;
    }

    .why-item-line {
        width: 48px;
        height: 2px;
        background: var(--why-gold);

        margin-bottom: 24px;
    }

    .why-item-description {
        color: var(--why-text);
        font-size: 15px;
        line-height: 1.9;
        margin: 0;
        max-width: 580px;
    }


    /* =========================================================
       ALTERNATING LAYOUT
    ========================================================= */

    .why-item:nth-child(even) .why-item-image-wrap {
        order: 2;
    }

    .why-item:nth-child(even) .why-item-content {
        order: 1;
    }

    .why-item:nth-child(even) .why-number {
        left: auto;
        right: -25px;
    }


    /* =========================================================
       BOTTOM CTA
    ========================================================= */

    .why-cta {
        position: relative;
        padding: 105px 0;

        background:
            linear-gradient(
                rgba(12, 39, 26, .93),
                rgba(12, 39, 26, .93)
            ),
            url('{{ asset('image/gallery.jpg') }}') center / cover no-repeat;
    }

    .why-cta-inner {
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    .why-cta-label {
        color: var(--why-gold-light);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        margin-bottom: 18px;
    }

    .why-cta-title {
        color: #fff;
        font-size: clamp(38px, 5vw, 62px);
        line-height: 1.08;
        font-weight: 600;

        margin: 0 0 20px;
    }

    .why-cta-text {
        color: rgba(255,255,255,.72);
        font-size: 15px;
        line-height: 1.85;

        max-width: 650px;
        margin: 0 auto 30px;
    }

    .why-cta-button {
        display: inline-flex;
        align-items: center;
        gap: 13px;

        padding: 15px 25px;

        background: var(--why-gold);
        color: #fff !important;

        text-decoration: none;

        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.4px;

        transition: all .3s ease;
    }

    .why-cta-button:hover {
        background: #fff;
        color: var(--why-green) !important;
        transform: translateY(-2px);
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .why-empty {
        padding: 100px 20px;
        text-align: center;
    }

    .why-empty-icon {
        width: 70px;
        height: 70px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 20px;

        background: var(--why-cream);
        color: var(--why-gold);

        border-radius: 50%;
        font-size: 22px;
    }

    .why-empty p {
        color: var(--why-text);
        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .why-hero {
            min-height: 500px;
        }

        .why-intro {
            padding: 75px 0 55px;
        }

        .why-items-section {
            padding-bottom: 80px;
        }

        .why-item {
            margin-top: 65px;
        }

        .why-item-image {
            height: 420px;
        }

        .why-item-content {
            padding: 45px 25px;
        }

        .why-item-image-wrap::after {
            right: -10px;
            bottom: -10px;
        }

        .why-number {
            left: 20px !important;
            right: auto !important;
            top: 20px;
        }

        .why-item:nth-child(even) .why-item-image-wrap,
        .why-item:nth-child(even) .why-item-content {
            order: initial;
        }
    }


    @media (max-width: 767px) {

        .why-hero {
            min-height: 470px;
        }

        .why-hero-content {
            padding-bottom: 50px;
        }

        .why-hero-title {
            font-size: 43px;
        }

        .why-intro {
            padding: 65px 20px 45px;
        }

        .why-intro-title {
            font-size: 36px;
        }

        .why-intro-text {
            font-size: 14px;
            line-height: 1.8;
        }

        .why-items-section {
            padding: 20px 15px 65px;
        }

        .why-item {
            margin-top: 55px;
        }

        .why-item-image {
            height: 320px;
        }

        .why-item-content {
            padding: 35px 10px 15px;
        }

        .why-item-title {
            font-size: 34px;
        }

        .why-item-description {
            font-size: 14px;
            line-height: 1.85;
        }

        .why-number {
            width: 58px;
            height: 58px;
            font-size: 14px;
        }

        .why-item-image-wrap::after {
            width: 55px;
            height: 55px;
        }

        .why-cta {
            padding: 75px 20px;
        }

        .why-cta-title {
            font-size: 39px;
        }
    }
</style>


<div class="premium-why-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="why-hero">

        <div class="container">

            <div class="why-hero-content">

                <div class="why-hero-label">
                    {{ __('messages.why_us') }}
                </div>

                <h1 class="why-hero-title">
                    {{ __('messages.why_us') }}
                </h1>

                <div class="why-hero-breadcrumb">

                    <strong>
                        {{ __('messages.Home') }}
                    </strong>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.why_us') }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         INTRO
    ====================================================== --}}

    <section class="why-intro">

        <div class="container">

            <div class="why-intro-inner">

                <div class="why-small-label">
                    Unique Nepal
                </div>

                <h2 class="why-intro-title">
                    {{ __('messages.why_us') }}
                    <br>
                    <span>Made for meaningful journeys.</span>
                </h2>

                <div class="why-intro-line"></div>

                <p class="why-intro-text">
                    Discover a different way to experience Nepal —
                    thoughtfully planned journeys, local knowledge,
                    personal service and unforgettable moments across
                    the Himalayas.
                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
         WHY US CONTENT
    ====================================================== --}}

    <section class="why-items-section">

        <div class="container">

            @forelse($whyUsData as $index => $why)

                <div class="row align-items-center gx-lg-5 why-item">

                    {{-- IMAGE --}}

                    <div class="col-lg-6 why-item-image-wrap">

                        <div class="why-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        @if(!empty($why->image))

                            <img
                                src="{{ asset('uploads/whyus/' . $why->image) }}"
                                alt="{{ $why->getTranslated('heading') }}"
                                class="why-item-image"
                                loading="lazy"
                            >

                        @else

                            <div
                                class="why-item-image d-flex align-items-center justify-content-center"
                                style="background: var(--why-green);"
                            >
                                <i
                                    class="fas fa-mountain"
                                    style="font-size:70px;color:var(--why-gold-light);"
                                ></i>
                            </div>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="col-lg-6">

                        <div class="why-item-content">

                            <div class="why-item-eyebrow">
                                Why travel with us
                            </div>

                            <h2 class="why-item-title">
                                {{ $why->getTranslated('heading') }}
                            </h2>

                            <div class="why-item-line"></div>

                            <p class="why-item-description">
                                {{ $why->getTranslated('content') }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="why-empty">

                    <div class="why-empty-icon">
                        <i class="fas fa-mountain"></i>
                    </div>

                    <p>
                        No data available at the moment.
                    </p>

                </div>

            @endforelse

        </div>

    </section>


    {{-- =====================================================
         CTA
    ====================================================== --}}

    <section class="why-cta">

        <div class="container">

            <div class="why-cta-inner">

                <div class="why-cta-label">
                    Your Nepal story starts here
                </div>

                <h2 class="why-cta-title">
                    Go beyond the ordinary.
                </h2>

                <p class="why-cta-text">
                    From legendary Himalayan trails to quiet villages
                    and ancient cultural sites, let us create a journey
                    that feels uniquely yours.
                </p>

                <a href="{{ route('Service') }}" class="why-cta-button">
                    Explore Our Journeys
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>

</div>

@endsection
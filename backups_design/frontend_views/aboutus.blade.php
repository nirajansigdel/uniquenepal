@extends('frontend.layouts.master')

<head>
    <title>{{ $aboutmeta?->title ?? 'About Us | Unique Nepal' }}</title>
    <meta name="description" content="{{ $aboutmeta?->description ?? '' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
</head>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Why should I book my trip through Unique Nepal Tour and Travels?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We provide personalized service, expert local advice, exclusive deals, and 24/7 support to ensure your travel experience in Nepal is seamless and memorable."
      }
    },
    {
      "@type": "Question",
      "name": "What is Unique Nepal Tour and Travel?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Unique Nepal Tour and Travel is a trusted travel agency in Nepal offering trekking packages, cultural tours, adventure trips, transportation services, hotel bookings, and customized itineraries for international and domestic travelers."
      }
    },
    {
      "@type": "Question",
      "name": "Do you charge a service fee?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "No, we do not charge any extra service fees. All costs are clearly included in your selected travel package."
      }
    },
    {
      "@type": "Question",
      "name": "Can you customize my travel itinerary?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we customize itineraries based on your interests, budget, group size, and preferred activities across Nepal."
      }
    },
    {
      "@type": "Question",
      "name": "Do you help with visas and travel documents?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we guide you through Nepal visa requirements and assist you with preparing all necessary travel documents."
      }
    }
  ]
}
</script>

@section('content')

<style>
    /* =========================================================
       PREMIUM ABOUT PAGE
       ========================================================= */

    :root {
        --premium-green: #173d2b;
        --premium-green-2: #24583f;
        --premium-gold: #b49352;
        --premium-gold-light: #d5bc82;
        --premium-cream: #f7f4ed;
        --premium-soft: #f2f5f1;
        --premium-dark: #101713;
        --premium-text: #5d665f;
        --premium-border: rgba(23, 61, 43, .12);
    }

    .premium-about-page {
        font-family: "DM Sans", sans-serif;
        color: var(--premium-dark);
        overflow: hidden;
        background: #fff;
    }

    .premium-serif {
        font-family: "Playfair Display", serif;
    }

    /* =========================================================
       HERO
       ========================================================= */

    .premium-about-hero {
        min-height: 650px;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        background:
            linear-gradient(90deg,
                rgba(8, 22, 15, .88) 0%,
                rgba(8, 22, 15, .68) 42%,
                rgba(8, 22, 15, .18) 100%),
            url('{{ asset('image/check.jpg') }}') center/cover no-repeat;
    }

    .premium-about-hero::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 130px;
        background: linear-gradient(to top, #fff, transparent);
        pointer-events: none;
    }

    .hero-content-premium {
        position: relative;
        z-index: 2;
        max-width: 850px;
        padding-top: 70px;
    }

    .hero-eyebrow {
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--premium-gold-light);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }

    .hero-eyebrow::before {
        content: "";
        width: 48px;
        height: 1px;
        background: var(--premium-gold-light);
    }

    .premium-about-hero h1 {
        color: #fff;
        font-family: "Playfair Display", serif;
        font-size: clamp(55px, 7vw, 96px);
        line-height: .98;
        font-weight: 600;
        margin: 0 0 28px;
        letter-spacing: -2px;
    }

    .premium-hero-text {
        max-width: 620px;
        color: rgba(255,255,255,.84);
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 32px;
    }

    .premium-breadcrumb {
        color: rgba(255,255,255,.7);
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .premium-breadcrumb strong {
        color: #fff;
    }

    .premium-breadcrumb i {
        color: var(--premium-gold-light);
        font-size: 11px;
    }

    /* =========================================================
       INTRO STATS
       ========================================================= */

    .premium-intro {
        margin-top: -45px;
        position: relative;
        z-index: 5;
    }

    .premium-stat-box {
        background: #fff;
        border-radius: 2px;
        box-shadow: 0 18px 60px rgba(15, 35, 25, .10);
        border: 1px solid rgba(0,0,0,.04);
        padding: 30px 35px;
    }

    .premium-stat {
        padding: 10px 25px;
        position: relative;
    }

    .premium-stat:not(:last-child)::after {
        content: "";
        position: absolute;
        right: 0;
        top: 10px;
        height: 55px;
        width: 1px;
        background: var(--premium-border);
    }

    .premium-stat-number {
        font-family: "Playfair Display", serif;
        font-size: 42px;
        color: var(--premium-green);
        line-height: 1;
        margin-bottom: 8px;
    }

    .premium-stat-label {
        color: #7a827c;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        font-weight: 700;
    }

    /* =========================================================
       SECTION COMMON
       ========================================================= */

    .premium-section {
        padding: 115px 0;
    }

    .premium-section-label {
        color: var(--premium-gold);
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 2.5px;
        margin-bottom: 18px;
    }

    .premium-section-title {
        font-family: "Playfair Display", serif;
        color: var(--premium-green);
        font-size: clamp(40px, 5vw, 64px);
        line-height: 1.08;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .premium-description {
        color: var(--premium-text);
        font-size: 16px;
        line-height: 1.9;
    }

    /* =========================================================
       MISSION / VISION / VALUES
       ========================================================= */

    .premium-purpose-section {
        background: var(--premium-cream);
        position: relative;
    }

    .premium-purpose-intro {
        max-width: 700px;
        margin: 0 auto 65px;
        text-align: center;
    }

    .premium-purpose-intro .premium-section-title {
        margin-bottom: 20px;
    }

    .purpose-card {
        height: 100%;
        padding: 45px 35px;
        background: #fff;
        border: 1px solid rgba(23,61,43,.08);
        position: relative;
        transition: all .4s ease;
        overflow: hidden;
    }

    .purpose-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 0;
        background: var(--premium-gold);
        transition: height .4s ease;
    }

    .purpose-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(23,61,43,.10);
    }

    .purpose-card:hover::before {
        height: 100%;
    }

    .purpose-number {
        font-family: "Playfair Display", serif;
        color: var(--premium-gold);
        font-size: 17px;
        margin-bottom: 35px;
    }

    .purpose-card h3 {
        color: var(--premium-green);
        font-family: "Playfair Display", serif;
        font-size: 28px;
        margin-bottom: 18px;
    }

    .purpose-card p {
        color: var(--premium-text);
        font-size: 15px;
        line-height: 1.9;
        margin: 0;
    }

    /* =========================================================
       ABOUT STORY
       ========================================================= */

    .premium-story {
        position: relative;
    }

    .story-image-wrap {
        position: relative;
        padding: 0 35px 35px 0;
    }

    .story-image-wrap::before {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        width: 72%;
        height: 72%;
        border: 1px solid var(--premium-gold);
        z-index: 0;
    }

    .story-image {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 600px;
        object-fit: cover;
        display: block;
    }

    .story-badge {
        position: absolute;
        z-index: 3;
        bottom: 0;
        left: -35px;
        width: 165px;
        height: 165px;
        border-radius: 50%;
        background: var(--premium-green);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        border: 8px solid #fff;
        box-shadow: 0 15px 40px rgba(0,0,0,.14);
    }

    .story-badge strong {
        font-family: "Playfair Display", serif;
        font-size: 42px;
        line-height: 1;
        color: var(--premium-gold-light);
    }

    .story-badge span {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-top: 7px;
        max-width: 90px;
        line-height: 1.4;
    }

    .story-content {
        padding-left: 45px;
    }

    .story-content .premium-description {
        margin-bottom: 28px;
    }

    .premium-cta {
        display: inline-flex;
        align-items: center;
        gap: 18px;
        padding: 15px 25px;
        background: var(--premium-green);
        color: #fff !important;
        text-decoration: none;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        font-weight: 700;
        transition: all .3s ease;
    }

    .premium-cta i {
        color: var(--premium-gold-light);
        transition: transform .3s ease;
    }

    .premium-cta:hover {
        background: var(--premium-gold);
    }

    .premium-cta:hover i {
        transform: translateX(5px);
    }

    /* =========================================================
       DIRECTOR / CEO MESSAGE
       ========================================================= */

    .premium-message-section {
        background: var(--premium-green);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .premium-message-section::before {
        content: "NEPAL";
        position: absolute;
        right: -40px;
        top: 50%;
        transform: translateY(-50%);
        font-family: "Playfair Display", serif;
        font-size: 180px;
        font-weight: 700;
        color: rgba(255,255,255,.025);
        pointer-events: none;
    }

    .message-image-frame {
        position: relative;
        padding: 20px 20px 0 0;
    }

    .message-image-frame::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 75%;
        height: 85%;
        border: 1px solid rgba(212,188,130,.5);
    }

    .message-image {
        position: relative;
        z-index: 2;
        width: 100%;
        height: 500px;
        object-fit: cover;
        display: block;
    }

    .message-content {
        padding: 30px 0 30px 55px;
        position: relative;
        z-index: 2;
    }

    .message-content .premium-section-label {
        color: var(--premium-gold-light);
    }

    .message-content .premium-section-title {
        color: #fff;
    }

    .message-quote {
        font-family: "Playfair Display", serif;
        font-size: 25px;
        line-height: 1.7;
        color: rgba(255,255,255,.88);
        position: relative;
        padding-left: 35px;
        border-left: 2px solid var(--premium-gold);
        min-height: 100px;
    }

    .message-signature {
        margin-top: 30px;
        color: var(--premium-gold-light);
        font-family: "Playfair Display", serif;
        font-size: 22px;
    }

    /* =========================================================
       TEAM
       ========================================================= */

    .premium-team-section {
        background: #fff;
    }

    .team-heading {
        max-width: 700px;
        margin: 0 auto 65px;
        text-align: center;
    }

    .premium-team-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--premium-border);
        transition: all .4s ease;
        overflow: hidden;
    }

    .premium-team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 65px rgba(17, 38, 26, .12);
    }

    .team-photo-wrap {
        height: 390px;
        overflow: hidden;
        position: relative;
        background: var(--premium-soft);
    }

    .team-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .7s ease;
    }

    .premium-team-card:hover .team-photo-wrap img {
        transform: scale(1.05);
    }

    .team-info {
        padding: 25px 28px 30px;
        position: relative;
    }

    .team-line {
        width: 35px;
        height: 2px;
        background: var(--premium-gold);
        margin-bottom: 17px;
    }

    .team-name {
        font-family: "Playfair Display", serif;
        color: var(--premium-green);
        font-size: 25px;
        margin-bottom: 8px;
    }

    .team-role {
        color: #7a817c;
        font-size: 12px;
        line-height: 1.8;
        text-transform: uppercase;
        letter-spacing: .8px;
    }

    /* =========================================================
       FAQ
       ========================================================= */

    .premium-faq-section {
        background:
            linear-gradient(rgba(17,39,27,.94), rgba(17,39,27,.94)),
            url('{{ asset('image/check.jpg') }}') center/cover fixed;
    }

    .faq-inner {
        max-width: 1000px;
        margin: auto;
    }

    .faq-heading {
        text-align: center;
        margin-bottom: 55px;
    }

    .faq-heading .premium-section-title {
        color: #fff;
    }

    .faq-heading .premium-description {
        color: rgba(255,255,255,.7);
        max-width: 650px;
        margin: auto;
    }

    .premium-accordion {
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.12);
    }

    .premium-accordion .accordion-item {
        background: transparent;
        border: 0;
        border-bottom: 1px solid rgba(255,255,255,.12);
    }

    .premium-accordion .accordion-item:last-child {
        border-bottom: 0;
    }

    .premium-accordion .accordion-button {
        background: transparent;
        color: #fff;
        box-shadow: none;
        padding: 27px 30px;
        font-size: 16px;
        font-weight: 600;
    }

    .premium-accordion .accordion-button::after {
        filter: brightness(0) invert(1);
    }

    .premium-accordion .accordion-button:not(.collapsed) {
        color: var(--premium-gold-light);
        background: rgba(255,255,255,.04);
    }

    .premium-accordion .accordion-body {
        color: rgba(255,255,255,.7);
        line-height: 1.9;
        padding: 0 30px 30px;
        font-size: 15px;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .premium-about-hero {
            min-height: 580px;
        }

        .premium-section {
            padding: 85px 0;
        }

        .story-content {
            padding-left: 0;
            margin-top: 65px;
        }

        .message-content {
            padding-left: 0;
            margin-top: 50px;
        }

        .premium-message-section::before {
            font-size: 110px;
        }
    }

    @media (max-width: 767px) {

        .premium-about-hero {
            min-height: 560px;
        }

        .hero-content-premium {
            padding-top: 50px;
        }

        .premium-about-hero h1 {
            font-size: 55px;
            letter-spacing: -1px;
        }

        .premium-hero-text {
            font-size: 16px;
        }

        .premium-intro {
            margin-top: -25px;
        }

        .premium-stat-box {
            padding: 20px 10px;
        }

        .premium-stat {
            padding: 18px 10px;
        }

        .premium-stat:not(:last-child)::after {
            display: none;
        }

        .premium-stat-number {
            font-size: 34px;
        }

        .story-image-wrap {
            padding: 0 18px 18px 0;
        }

        .story-image {
            height: 450px;
        }

        .story-badge {
            left: -5px;
            width: 135px;
            height: 135px;
        }

        .story-badge strong {
            font-size: 34px;
        }

        .message-image {
            height: 420px;
        }

        .team-photo-wrap {
            height: 420px;
        }

        .premium-accordion .accordion-button {
            padding: 22px 18px;
            font-size: 15px;
        }

        .premium-accordion .accordion-body {
            padding: 0 18px 24px;
        }
    }
</style>


<div class="premium-about-page">

    {{-- =====================================================
         PREMIUM HERO
         ===================================================== --}}
    <section class="premium-about-hero">

        <div class="container">
            <div class="hero-content-premium">

                <div class="hero-eyebrow">
                    {{ __('messages.about_us') }}
                </div>

                <h1>
                    Discover the<br>
                    <span style="color: var(--premium-gold-light);">Unique</span> Nepal
                </h1>

                <p class="premium-hero-text">
                    Journey beyond destinations and experience Nepal
                    through authentic adventures, local knowledge and
                    thoughtfully crafted travel experiences.
                </p>

                <div class="premium-breadcrumb">
                    <strong>{{ __('messages.Home') }}</strong>
                    <i class="fas fa-chevron-right"></i>
                    <span>{{ __('messages.about_us') }}</span>
                </div>

            </div>
        </div>

    </section>


    {{-- =====================================================
         STATS
         ===================================================== --}}
    <section class="premium-intro">
        <div class="container">

            <div class="premium-stat-box">

                <div class="row align-items-center text-center">

                    <div class="col-6 col-lg-3 premium-stat">
                        <div class="premium-stat-number">15+</div>
                        <div class="premium-stat-label">
                            {{ __('messages.years_experience') }}
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 premium-stat">
                        <div class="premium-stat-number">1K+</div>
                        <div class="premium-stat-label">
                            Travelers Served
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 premium-stat">
                        <div class="premium-stat-number">100%</div>
                        <div class="premium-stat-label">
                            Local Expertise
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 premium-stat">
                        <div class="premium-stat-number">24/7</div>
                        <div class="premium-stat-label">
                            Travel Support
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- =====================================================
         MISSION / VISION / VALUES
         ===================================================== --}}
    <section class="premium-section premium-purpose-section">

        <div class="container">

            <div class="premium-purpose-intro">

                <div class="premium-section-label">
                    What guides us
                </div>

                <h2 class="premium-section-title">
                    Travel with purpose.<br>
                    Explore with meaning.
                </h2>

                <p class="premium-description">
                    Every journey we create is shaped by our connection
                    with Nepal, its people, culture and extraordinary
                    landscapes.
                </p>

            </div>


            <div class="row g-4">

                @foreach ($missionVisionValues as $mvv)

                    <div class="col-md-4"
                         data-aos="fade-up"
                         data-aos-delay="{{ $loop->index * 100 }}">

                        <div class="purpose-card">

                            <div class="purpose-number">
                                0{{ $loop->iteration }}
                            </div>

                            <h3>
                                {{ $mvv->getTranslated('heading') }}
                            </h3>

                            <p>
                                {{ $mvv->getTranslated('description') }}
                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =====================================================
         ABOUT STORY
         ===================================================== --}}
    <section class="premium-section premium-story">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6"
                     data-aos="fade-right">

                    <div class="story-image-wrap">

                        <img
                            src="{{ asset('uploads/about/' . $about->image) }}"
                            alt="Unique Nepal"
                            class="story-image">

                        <div class="story-badge">

                            <strong>15+</strong>

                            <span>
                                {{ __('messages.years_experience') }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="col-lg-6"
                     data-aos="fade-left">

                    <div class="story-content">

                        <div class="premium-section-label">
                            {{ __('messages.about_us') }}
                        </div>

                        <h2 class="premium-section-title">
                            Your Nepal story<br>
                            starts here.
                        </h2>

                        @php
                            $text = $about->getTranslated('description') ?? 'No description available.';
                            $parts = explode('.', $text);

                            if (count($parts) >= 3) {
                                $first = trim($parts[0]) . '.';
                                $second = trim($parts[1]) . '.';
                                $rest = implode('.', array_slice($parts, 2));
                                $text = $first . ' ' . $second . '<br><br>' . $rest;
                            }
                        @endphp

                        <div class="premium-description">
                            {!! $text !!}
                        </div>

                        <a href="#"
                           class="premium-cta">

                            {{ __('messages.view_destination') }}

                            <i class="fas fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CEO / DIRECTOR MESSAGE
         ===================================================== --}}
    <section class="premium-section premium-message-section">

        <div class="container">

            @foreach ($message as $index => $ceoms)

                <div class="row align-items-center">

                    <div class="col-lg-5"
                         data-aos="fade-right">

                        <div class="message-image-frame">

                            <img
                                src="{{ asset('uploads/message/' . $ceoms->image) }}"
                                alt="Leadership Message"
                                class="message-image">

                        </div>

                    </div>


                    <div class="col-lg-7"
                         data-aos="fade-left">

                        <div class="message-content">

                            <div class="premium-section-label">
                                {{ __('messages.CEO_Message') }}
                            </div>

                            <h2 class="premium-section-title">
                                A vision built<br>
                                around Nepal.
                            </h2>

                            <div class="message-quote">

                                {{ $ceoms->getTranslated('message') }}

                            </div>

                            <div class="message-signature">
                                Unique Nepal
                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </section>


    {{-- =====================================================
         TEAM
         ===================================================== --}}
    <section class="premium-section premium-team-section">

        <div class="container">

            <div class="team-heading"
                 data-aos="fade-up">

                <div class="premium-section-label">
                    {{ __('messages.OurTeams') }}
                </div>

                <h2 class="premium-section-title">
                    The people behind<br>
                    your journey.
                </h2>

                <p class="premium-description">
                    {{ __('messages.OurTeams_sub') }}
                </p>

            </div>


            <div class="row g-4 justify-content-center">

                @foreach ($teams as $team)

                    <div class="col-md-6 col-lg-4"
                         data-aos="fade-up"
                         data-aos-delay="{{ $loop->index * 80 }}">

                        <div class="premium-team-card">

                            <div class="team-photo-wrap">

                                <img
                                    src="{{ $team->image
                                        ? asset('uploads/team/' . $team->image)
                                        : asset('images/girl.jpg') }}"
                                    alt="{{ $team->name }}">

                            </div>

                            <div class="team-info">

                                <div class="team-line"></div>

                                <h3 class="team-name">
                                    {{ $team->name }}
                                </h3>

                                <div class="team-role">
                                    {{ $team->getTranslated('position') }}
                                    @if($team->getTranslated('role'))
                                        · {{ $team->getTranslated('role') }}
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- =====================================================
         FAQ
         ===================================================== --}}
    <section class="premium-section premium-faq-section">

        <div class="container">

            <div class="faq-inner">

                <div class="faq-heading">

                    <div class="premium-section-label">
                        Frequently Asked Questions
                    </div>

                    <h2 class="premium-section-title">
                        Everything you need<br>
                        to know.
                    </h2>

                    <p class="premium-description">
                        {{ __('messages.faqs_sub') }}
                    </p>

                </div>


                <div class="accordion premium-accordion"
                     id="premiumFaq">

                    @foreach ($faqs as $index => $faq)

                        <div class="accordion-item">

                            <h2 class="accordion-header"
                                id="premiumHeading{{ $index }}">

                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#premiumCollapse{{ $index }}"
                                    aria-expanded="false"
                                    aria-controls="premiumCollapse{{ $index }}">

                                    <span>
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <span class="ms-4">
                                        {{ $faq->getTranslated('question') }}
                                    </span>

                                </button>

                            </h2>


                            <div
                                id="premiumCollapse{{ $index }}"
                                class="accordion-collapse collapse"
                                aria-labelledby="premiumHeading{{ $index }}"
                                data-bs-parent="#premiumFaq">

                                <div class="accordion-body">

                                    {{ $faq->getTranslated('answer') }}

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     AOS
     ========================================================= --}}
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        AOS.init({
            duration: 900,
            easing: 'ease-out-cubic',
            once: true,
            mirror: false,
            offset: 80
        });

    });
</script>

@endsection
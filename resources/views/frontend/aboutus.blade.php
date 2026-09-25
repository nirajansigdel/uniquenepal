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
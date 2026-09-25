@extends('frontend.layouts.master')

<head>
    <title>{{ $contactmeta?->title ?? 'Contact Us | Unique Nepal' }}</title>
    <meta name="description" content="{{ $contactmeta?->description ?? '' }}">
</head>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How do I get a quote for my trip?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Simply contact us with your travel details, and we will provide a personalized quote based on your preferred itinerary, group size, and budget."
      }
    },
    {
      "@type": "Question",
      "name": "What happens if my flight is delayed or canceled?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Our team monitors flights and will assist with rescheduling your transfers or activities to ensure a smooth travel experience."
      }
    },
    {
      "@type": "Question",
      "name": "Do you offer travel insurance?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we offer comprehensive travel insurance to protect you from unforeseen events during your trip in Nepal."
      }
    },
    {
      "@type": "Question",
      "name": "Do you assist with visas and travel documents?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we guide you through visa requirements and help with preparing all necessary travel documents for Nepal."
      }
    },
    {
      "@type": "Question",
      "name": "What if I need to change or cancel my trip?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We assist with all changes and cancellations, working with you to adjust your itinerary while keeping your convenience in mind."
      }
    },
    {
      "@type": "Question",
      "name": "Can you customize my travel itinerary?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Absolutely! We tailor your itinerary to your preferences, budget, and travel dates to ensure a personalized experience in Nepal."
      }
    },
    {
      "@type": "Question",
      "name": "Do you offer eco-friendly or sustainable travel options?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, we prioritize sustainable tourism and can tailor your trip to minimize environmental impact while supporting local communities."
      }
    },
    {
      "@type": "Question",
      "name": "Can I get assistance with travel vaccinations?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We can advise on required vaccinations based on your travel plans and provide guidance to ensure a safe trip."
      }
    }
  ]
}
</script>


@section('content')

<style>
    /* =========================================================
       UNIQUE NEPAL — PREMIUM CONTACT PAGE
    ========================================================= */

    .premium-contact-page {

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

    .contact-hero {

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
                rgba(12, 40, 27, .88)
            ),
            url('{{ asset('image/contact.webp') }}')
            center center / cover no-repeat;
    }

    .contact-hero::before {

        content: "";

        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                90deg,
                rgba(12,40,27,.75),
                transparent 70%
            );
    }

    .contact-hero-content {

        position: relative;
        z-index: 2;

        width: 100%;

        padding-top: 65px;
    }

    .contact-eyebrow {

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

    .contact-eyebrow::before {

        content: "";

        width: 38px;

        height: 1px;

        background: var(--gold-light);
    }

    .contact-hero h1 {

        max-width: 850px;

        margin: 0 auto;

        color: #fff;

        font-size: clamp(42px, 6vw, 74px);

        line-height: 1;

        font-weight: 700;

        letter-spacing: -2px;
    }

    .contact-breadcrumb {

        margin-top: 25px;

        color: rgba(255,255,255,.7);

        font-size: 14px;
    }

    .contact-breadcrumb .home {

        color: #fff;

        font-weight: 600;
    }

    .contact-breadcrumb i {

        color: var(--gold-light);

        margin: 0 10px;

        font-size: 11px;
    }


    /* =========================================================
       INTRO
    ========================================================= */

    .contact-intro {

        padding: 90px 0 45px;

        background: var(--soft-bg);
    }

    .contact-intro-label {

        color: var(--gold);

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 3px;

        text-transform: uppercase;

        margin-bottom: 14px;
    }

    .contact-intro-title {

        max-width: 720px;

        margin: auto;

        color: var(--forest);

        font-size: clamp(31px, 4vw, 48px);

        line-height: 1.12;

        font-weight: 700;

        letter-spacing: -1px;
    }

    .contact-intro-text {

        max-width: 650px;

        margin: 18px auto 0;

        color: var(--text);

        font-size: 16px;

        line-height: 1.8;
    }


    /* =========================================================
       CONTACT INFORMATION
    ========================================================= */

    .contact-info-section {

        padding: 45px 0 95px;

        background: var(--soft-bg);
    }

    .contact-info-card {

        position: relative;

        height: 100%;

        padding: 32px 28px;

        background: #fff;

        border: 1px solid var(--border);

        box-shadow: 0 18px 50px rgba(23,61,43,.06);

        transition:
            transform .3s ease,
            box-shadow .3s ease;
    }

    .contact-info-card:hover {

        transform: translateY(-6px);

        box-shadow: 0 25px 60px rgba(23,61,43,.12);
    }

    .contact-icon {

        width: 52px;

        height: 52px;

        display: flex;

        align-items: center;

        justify-content: center;

        margin-bottom: 24px;

        color: var(--gold);

        background: rgba(180,148,82,.11);

        border: 1px solid rgba(180,148,82,.25);

        font-size: 19px;
    }

    .contact-card-label {

        color: var(--gold);

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 2px;

        text-transform: uppercase;

        margin-bottom: 8px;
    }

    .contact-info-card h3 {

        color: var(--forest);

        font-size: 19px;

        font-weight: 700;

        margin-bottom: 15px;
    }

    .contact-info-card p {

        color: var(--text);

        font-size: 14px;

        line-height: 1.7;

        margin: 0 0 5px;
    }


    /* =========================================================
       WHATSAPP
    ========================================================= */

    .whatsapp-box {

        margin-top: 30px;

        padding: 22px 24px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        background: var(--forest);

        color: #fff;
    }

    .whatsapp-content {

        display: flex;

        align-items: center;

        gap: 14px;
    }

    .whatsapp-icon {

        width: 43px;

        height: 43px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: rgba(255,255,255,.1);

        color: var(--gold-light);
    }

    .whatsapp-content strong {

        display: block;

        font-size: 14px;

        margin-bottom: 2px;
    }

    .whatsapp-content span {

        font-size: 12px;

        color: rgba(255,255,255,.65);
    }

    .whatsapp-button {

        color: var(--forest);

        background: var(--gold-light);

        padding: 11px 17px;

        text-decoration: none;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: .7px;

        text-transform: uppercase;

        white-space: nowrap;

        transition: all .25s ease;
    }

    .whatsapp-button:hover {

        color: var(--forest);

        background: #fff;
    }


    /* =========================================================
       APPOINTMENT SECTION
    ========================================================= */

    .appointment-section {

        padding: 0 0 110px;

        background: var(--soft-bg);
    }

    .appointment-wrapper {

        display: grid;

        grid-template-columns: .75fr 1.25fr;

        overflow: hidden;

        background: #fff;

        box-shadow: 0 25px 70px rgba(23,61,43,.10);
    }

    .appointment-intro {

        position: relative;

        padding: 55px 42px;

        background:
            linear-gradient(
                145deg,
                var(--forest),
                var(--forest-dark)
            );

        color: #fff;

        overflow: hidden;
    }

    .appointment-intro::after {

        content: "";

        position: absolute;

        width: 350px;

        height: 350px;

        border: 1px solid rgba(216,193,141,.13);

        border-radius: 50%;

        right: -190px;

        bottom: -180px;
    }

    .appointment-label {

        position: relative;

        z-index: 2;

        color: var(--gold-light);

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 3px;

        text-transform: uppercase;
    }

    .appointment-intro h2 {

        position: relative;

        z-index: 2;

        margin: 13px 0 20px;

        color: #fff;

        font-size: 32px;

        line-height: 1.15;

        font-weight: 700;
    }

    .appointment-intro > p {

        position: relative;

        z-index: 2;

        color: rgba(255,255,255,.67);

        font-size: 14px;

        line-height: 1.8;

        margin-bottom: 32px;
    }

    .appointment-list {

        position: relative;

        z-index: 2;

        list-style: none;

        padding: 0;

        margin: 0;
    }

    .appointment-list li {

        display: flex;

        align-items: flex-start;

        gap: 12px;

        margin-bottom: 18px;

        color: rgba(255,255,255,.82);

        font-size: 13px;

        line-height: 1.5;
    }

    .appointment-list i {

        flex-shrink: 0;

        color: var(--gold-light);

        margin-top: 2px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .appointment-form {

        padding: 55px 48px;
    }

    .form-heading {

        margin-bottom: 30px;
    }

    .form-heading span {

        display: block;

        color: var(--gold);

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 3px;

        text-transform: uppercase;

        margin-bottom: 8px;
    }

    .form-heading h3 {

        color: var(--forest);

        font-size: 28px;

        font-weight: 700;

        margin: 0;
    }

    .premium-input {

        width: 100%;

        min-height: 54px;

        padding: 14px 16px;

        border: 1px solid rgba(23,61,43,.14);

        border-radius: 0;

        background: #fafbf9;

        color: var(--dark-text);

        font-size: 14px;

        transition:
            border-color .25s ease,
            box-shadow .25s ease,
            background .25s ease;
    }

    .premium-input:focus {

        outline: none;

        border-color: var(--gold);

        background: #fff;

        box-shadow: 0 0 0 3px rgba(180,148,82,.10);
    }

    textarea.premium-input {

        min-height: 135px;

        resize: vertical;
    }

    .premium-input::placeholder {

        color: #89918c;
    }

    .premium-check {

        width: 16px;

        height: 16px;

        border-radius: 0;

        border-color: rgba(23,61,43,.25);
    }

    .premium-check:checked {

        background-color: var(--forest);

        border-color: var(--forest);
    }

    .premium-check-label {

        color: var(--text);

        font-size: 12px;

        line-height: 1.5;
    }

    .premium-submit {

        display: inline-flex;

        align-items: center;

        gap: 12px;

        padding: 14px 25px;

        border: 0;

        border-radius: 0;

        background: var(--forest);

        color: #fff;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 1px;

        text-transform: uppercase;

        transition: all .3s ease;
    }

    .premium-submit:hover {

        background: var(--gold);

        color: #fff;

        transform: translateY(-2px);
    }


    /* =========================================================
       FAQ
    ========================================================= */

    .faq-section {

        padding: 95px 0 110px;

        background: #fff;
    }

    .faq-heading {

        max-width: 650px;

        margin: 0 auto 50px;

        text-align: center;
    }

    .faq-heading span {

        color: var(--gold);

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 3px;

        text-transform: uppercase;
    }

    .faq-heading h2 {

        color: var(--forest);

        font-size: clamp(30px,4vw,45px);

        font-weight: 700;

        margin: 12px 0 15px;
    }

    .faq-heading p {

        color: var(--text);

        font-size: 14px;

        line-height: 1.8;

        margin: 0;
    }

    .premium-accordion {

        max-width: 850px;

        margin: auto;
    }

    .premium-accordion .accordion-item {

        border: 0;

        border-bottom: 1px solid var(--border);

        border-radius: 0 !important;

        background: transparent;
    }

    .premium-accordion .accordion-button {

        padding: 23px 5px;

        background: transparent;

        box-shadow: none;

        color: var(--forest);

        font-size: 15px;

        font-weight: 700;
    }

    .premium-accordion .accordion-button:not(.collapsed) {

        color: var(--gold);

        background: transparent;
    }

    .premium-accordion .accordion-button::after {

        background-size: 13px;

        transition: transform .25s ease;
    }

    .premium-accordion .accordion-body {

        padding: 0 40px 23px 5px;

        color: var(--text);

        font-size: 14px;

        line-height: 1.8;
    }


    /* =========================================================
       CTA
    ========================================================= */

    .contact-cta {

        position: relative;

        padding: 85px 20px;

        overflow: hidden;

        text-align: center;

        background:
            linear-gradient(
                110deg,
                var(--forest-dark),
                var(--forest)
            );
    }

    .contact-cta::before {

        content: "";

        position: absolute;

        width: 430px;

        height: 430px;

        border: 1px solid rgba(216,193,141,.13);

        border-radius: 50%;

        top: -270px;

        left: -120px;
    }

    .contact-cta::after {

        content: "";

        position: absolute;

        width: 520px;

        height: 520px;

        border: 1px solid rgba(216,193,141,.10);

        border-radius: 50%;

        right: -180px;

        bottom: -320px;
    }

    .contact-cta-inner {

        position: relative;

        z-index: 2;
    }

    .contact-cta-label {

        color: var(--gold-light);

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 3px;

        text-transform: uppercase;
    }

    .contact-cta h2 {

        max-width: 720px;

        margin: 12px auto 15px;

        color: #fff;

        font-size: clamp(30px,4vw,48px);

        line-height: 1.12;
    }

    .contact-cta p {

        max-width: 600px;

        margin: auto;

        color: rgba(255,255,255,.68);

        line-height: 1.8;

        font-size: 14px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .appointment-wrapper {

            grid-template-columns: 1fr;
        }

        .appointment-intro {

            padding: 45px 35px;
        }

        .appointment-form {

            padding: 45px 35px;
        }
    }

    @media (max-width: 767px) {

        .contact-hero {

            min-height: 430px;
        }

        .contact-intro {

            padding: 65px 0 30px;
        }

        .contact-info-section {

            padding: 30px 0 70px;
        }

        .contact-info-card {

            padding: 27px 24px;
        }

        .whatsapp-box {

            align-items: flex-start;

            flex-direction: column;
        }

        .appointment-section {

            padding-bottom: 75px;
        }

        .appointment-intro {

            padding: 40px 25px;
        }

        .appointment-form {

            padding: 40px 22px;
        }

        .faq-section {

            padding: 70px 0 80px;
        }

        .premium-accordion .accordion-button {

            padding: 20px 0;

            font-size: 14px;
        }

        .premium-accordion .accordion-body {

            padding-left: 0;
        }

        .contact-cta {

            padding: 70px 20px;
        }
    }
</style>


<div class="premium-contact-page">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="contact-hero">

        <div class="contact-hero-content">

            <div class="container text-center">

                <div class="contact-eyebrow">
                    Unique Nepal
                </div>

                <h1>
                    Connect With Us
                </h1>

                <div class="contact-breadcrumb">

                    <span class="home">
                        {{ __('messages.Home') }}
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ __('messages.contact_us') }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         INTRO
    ====================================================== --}}

    <section class="contact-intro">

        <div class="container text-center">

            <div class="contact-intro-label">
                {{ __('messages.contact_us') }}
            </div>

            <h2 class="contact-intro-title">
                {{ __('messages.contact_we') }}
                <span>
                    {{ __('messages.contact_love') }}
                </span>
            </h2>

            <p class="contact-intro-text">
                {{ __('messages.contact_always') }}
            </p>

        </div>

    </section>


    {{-- =====================================================
         CONTACT INFORMATION
    ====================================================== --}}

    <section class="contact-info-section">

        <div class="container">

            <div class="row g-4">


                {{-- ADDRESS --}}

                <div class="col-lg-4 col-md-6">

                    <div class="contact-info-card">

                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div class="contact-card-label">
                            Reach Us
                        </div>

                        <h3>
                            {{ __('messages.office_address') }}
                        </h3>

                        @if (!empty($sitesetting->office_address))

                            @foreach ((array) json_decode($sitesetting->office_address) as $address)

                                <p>
                                    {{ $address }}
                                </p>

                            @endforeach

                        @endif

                    </div>

                </div>


                {{-- PHONE --}}

                <div class="col-lg-4 col-md-6">

                    <div class="contact-info-card">

                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div class="contact-card-label">
                            Talk To Us
                        </div>

                        <h3>
                            {{ __('messages.office_contact') }}
                        </h3>

                        @if (!empty($sitesetting->office_contact))

                            @foreach ((array) json_decode($sitesetting->office_contact) as $contact)

                                <p>
                                    {{ $contact }}
                                </p>

                            @endforeach

                        @endif

                    </div>

                </div>


                {{-- EMAIL --}}

                <div class="col-lg-4 col-md-6">

                    <div class="contact-info-card">

                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div class="contact-card-label">
                            Write To Us
                        </div>

                        <h3>
                            {{ __('messages.office_email') }}
                        </h3>

                        @if (!empty($sitesetting->office_email))

                            @foreach ((array) json_decode($sitesetting->office_email) as $email)

                                <p>
                                    {{ $email }}
                                </p>

                            @endforeach

                        @endif

                    </div>

                </div>

            </div>


            {{-- WHATSAPP --}}

            <div class="whatsapp-box">

                <div class="whatsapp-content">

                    <div class="whatsapp-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>

                    <div>

                        <strong>
                            Need a quick answer?
                        </strong>

                        <span>
                            Chat directly with our travel team.
                        </span>

                    </div>

                </div>

                <a
                    href="https://api.whatsapp.com/send?phone=9779808114909"
                    class="whatsapp-button"
                    target="_blank"
                    rel="noopener">

                    <i class="fab fa-whatsapp me-2"></i>

                    {{ __('messages.WhatsApp') }}

                </a>

            </div>

        </div>

    </section>


    {{-- =====================================================
         APPOINTMENT / CONTACT FORM
    ====================================================== --}}

    <section class="appointment-section">

        <div class="container">

            <div class="appointment-wrapper">


                {{-- LEFT --}}

                <div class="appointment-intro">

                    <div class="appointment-label">
                        Plan Your Journey
                    </div>

                    <h2>
                        {{ __('messages.book_virtual_appointment') }}
                    </h2>

                    <p>
                        Tell us what you have in mind.
                        Our team will help shape your Nepal journey
                        around your interests, dates and expectations.
                    </p>

                    <ul class="appointment-list">

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>
                                {{ __('messages.explore_tour_packages') }}
                            </span>
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>
                                {{ __('messages.join_adventure_club') }}
                            </span>
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>
                                {{ __('messages.travel_assistance') }}
                            </span>
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>
                                {{ __('messages.travel_internship_programs') }}
                            </span>
                        </li>

                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>
                                {{ __('messages.sustainable_travel') }}
                            </span>
                        </li>

                    </ul>

                </div>


                {{-- RIGHT FORM --}}

                <div class="appointment-form">

                    <div class="form-heading">

                        <span>
                            Get In Touch
                        </span>

                        <h3>
                            Start Planning
                        </h3>

                    </div>


                    <form
                        id="contactForm"
                        method="POST"
                        action="{{ route('Contact.store') }}">

                        @csrf


                        <div class="row g-3">


                            {{-- NAME --}}

                            <div class="col-md-6">

                                <input
                                    type="text"
                                    name="name"
                                    class="premium-input @error('name') is-invalid @enderror"
                                    placeholder="{{ __('messages.Name') }}"
                                    required
                                    value="{{ old('name') }}">

                                @error('name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- EMAIL --}}

                            <div class="col-md-6">

                                <input
                                    type="email"
                                    name="email"
                                    class="premium-input @error('email') is-invalid @enderror"
                                    placeholder="{{ __('messages.Email') }}"
                                    value="{{ old('email') }}">

                                @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- PHONE --}}

                            <div class="col-md-6">

                                <input
                                    type="tel"
                                    name="phone_no"
                                    id="phoneInput"
                                    class="premium-input @error('phone_no') is-invalid @enderror"
                                    placeholder="{{ __('messages.Phone_Number') }}"
                                    required
                                    value="{{ old('phone_no') }}">

                                @error('phone_no')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- SERVICE --}}

                            <div class="col-md-6">

                                <input
                                    type="text"
                                    name="service"
                                    class="premium-input @error('service') is-invalid @enderror"
                                    placeholder="{{ __('messages.interested_service') }}"
                                    value="{{ old('service') }}">

                                @error('service')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- MESSAGE --}}

                            <div class="col-12">

                                <textarea
                                    name="message"
                                    class="premium-input @error('message') is-invalid @enderror"
                                    rows="5"
                                    placeholder="Message"
                                    required>{{ old('message') }}</textarea>

                                @error('message')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- PRIVACY --}}

                            <div class="col-12">

                                <div class="form-check d-flex align-items-start gap-2">

                                    <input
                                        class="form-check-input premium-check mt-1"
                                        type="checkbox"
                                        id="agree"
                                        required>

                                    <label
                                        class="premium-check-label"
                                        for="agree">

                                        {{ __('messages.i_agree_privacy') }}

                                    </label>

                                </div>

                            </div>


                            {{-- SUBMIT --}}

                            <div class="col-12 pt-2">

                                <button
                                    type="submit"
                                    class="premium-submit">

                                    {{ __('messages.Booknow') }}

                                    <i class="fas fa-arrow-right"></i>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         FAQ
    ====================================================== --}}

    <section class="faq-section">

        <div class="container">

            <div class="faq-heading">

                <span>
                    Travel Questions
                </span>

                <h2>
                    Before You Begin
                </h2>

                <p>
                    A few common questions to help you plan
                    your journey with confidence.
                </p>

            </div>


            <div
                class="accordion premium-accordion"
                id="contactFaq">


                {{-- FAQ 1 --}}

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqOne">

                            How do I get a quote for my trip?

                        </button>

                    </h2>

                    <div
                        id="faqOne"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#contactFaq">

                        <div class="accordion-body">

                            Simply contact us with your travel details,
                            and we will provide a personalized quote
                            based on your preferred itinerary, group size,
                            and budget.

                        </div>

                    </div>

                </div>


                {{-- FAQ 2 --}}

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqTwo">

                            Can you customize my travel itinerary?

                        </button>

                    </h2>

                    <div
                        id="faqTwo"
                        class="accordion-collapse collapse"
                        data-bs-parent="#contactFaq">

                        <div class="accordion-body">

                            Absolutely. We can tailor your itinerary
                            around your preferred travel dates,
                            interests, budget and pace.

                        </div>

                    </div>

                </div>


                {{-- FAQ 3 --}}

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqThree">

                            Do you assist with visas and travel documents?

                        </button>

                    </h2>

                    <div
                        id="faqThree"
                        class="accordion-collapse collapse"
                        data-bs-parent="#contactFaq">

                        <div class="accordion-body">

                            Yes. Our team can guide you through
                            Nepal's visa requirements and the travel
                            documents needed for your journey.

                        </div>

                    </div>

                </div>


                {{-- FAQ 4 --}}

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqFour">

                            What happens if my flight is delayed or canceled?

                        </button>

                    </h2>

                    <div
                        id="faqFour"
                        class="accordion-collapse collapse"
                        data-bs-parent="#contactFaq">

                        <div class="accordion-body">

                            Our team can assist with adjusting transfers
                            and activities when unexpected flight changes
                            affect your travel plans.

                        </div>

                    </div>

                </div>


                {{-- FAQ 5 --}}

                <div class="accordion-item">

                    <h2 class="accordion-header">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqFive">

                            Do you offer sustainable travel options?

                        </button>

                    </h2>

                    <div
                        id="faqFive"
                        class="accordion-collapse collapse"
                        data-bs-parent="#contactFaq">

                        <div class="accordion-body">

                            Yes. We can help design journeys that support
                            local communities and reduce unnecessary
                            environmental impact.

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>


    {{-- =====================================================
         FINAL CTA
    ====================================================== --}}

    <section class="contact-cta">

        <div class="contact-cta-inner">

            <div class="contact-cta-label">
                Unique Nepal
            </div>

            <h2>
                Let's plan something unforgettable.
            </h2>

            <p>
                From Himalayan adventures to cultural discoveries,
                we're here to help you create your Nepal story.
            </p>

        </div>

    </section>


</div>


{{-- =========================================================
     EXTERNAL ASSETS
========================================================= --}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


{{-- =========================================================
     AJAX CONTACT FORM
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('contactForm');

    if (!form) {
        return;
    }

    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        const submitButton = form.querySelector('button[type="submit"]');

        const originalText = submitButton.innerHTML;

        submitButton.disabled = true;

        submitButton.innerHTML =
            'Sending <i class="fas fa-spinner fa-spin"></i>';


        const formData = new FormData(form);

        try {

            const response = await fetch(form.action, {

                method: 'POST',

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },

                body: formData

            });


            const data = await response.json();


            if (data.success) {

                Swal.fire({

                    icon: 'success',

                    title: 'Thank You',

                    text: data.message ||
                        'Your appointment request has been submitted successfully.',

                    confirmButtonColor: '#173d2b'

                });

                form.reset();

            } else {

                Swal.fire({

                    icon: 'error',

                    title: 'Please Check',

                    text: data.message ||
                        'Please check your information and try again.',

                    confirmButtonColor: '#173d2b'

                });

            }


        } catch (error) {

            Swal.fire({

                icon: 'error',

                title: 'Something Went Wrong',

                text: 'Please try again or contact us directly.',

                confirmButtonColor: '#173d2b'

            });

        } finally {

            submitButton.disabled = false;

            submitButton.innerHTML = originalText;

        }

    });

});

</script>

@endsection
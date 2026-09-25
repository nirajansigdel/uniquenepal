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
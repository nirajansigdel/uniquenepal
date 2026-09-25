@extends('frontend.layouts.master')

<head>
    <title>{{ $testimonialmeta?->title ?? 'Testimonials | Unique Nepal' }}</title>
    <meta
        name="description"
        content="{{ $testimonialmeta?->description ?? '' }}"
    >
</head>

@section('content')



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
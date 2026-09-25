@extends('frontend.layouts.master')

<head>
    <title>{{ $servicemeta?->title ?? 'Our Services | Unique Nepal' }}</title>
    <meta name="description" content="{{ $servicemeta?->description ?? '' }}">
</head>

@section('content')



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
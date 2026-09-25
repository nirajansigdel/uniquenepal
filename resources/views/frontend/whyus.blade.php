@extends('frontend.layouts.master')

<head>
    <title>{{ $whymeta?->title ?? 'Why Choose Us | Unique Nepal' }}</title>
    <meta name="description" content="{{ $whymeta?->description ?? '' }}">
</head>

@section('content')



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
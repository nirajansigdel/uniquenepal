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



<div class="premium-service-page">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="single-service-hero" style="--hero-image: url('{{ asset('uploads/service/' . $service->image) }}')">

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
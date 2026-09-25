@extends('frontend.layouts.master')

<head>
    <title>{{ $blogmeta?->title ?? 'Travel Stories | Unique Nepal' }}</title>
    <meta name="description" content="{{ $blogmeta?->description ?? '' }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
    rel="stylesheet">


</head>

@section('content')

<style>
    :root {
        --blog-green: #173d2b;
        --blog-green-light: #285b42;
        --blog-gold: #b49352;
        --blog-gold-light: #d5bc82;
        --blog-cream: #f7f4ed;
        --blog-soft: #f3f5f2;
        --blog-dark: #101713;
        --blog-text: #626b65;
        --blog-border: rgba(23, 61, 43, .12);
    }

    .premium-blog-page {
        font-family: "DM Sans", sans-serif;
        color: var(--blog-dark);
        overflow: hidden;
        background: #fff;
    }

    .premium-blog-page .serif {
        font-family: "Playfair Display", serif;
    }

    /* =========================================================
       HERO
       ========================================================= */

    .blog-premium-hero {
        min-height: 620px;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;

        background:
            linear-gradient(
                90deg,
                rgba(8, 23, 15, .91) 0%,
                rgba(8, 23, 15, .72) 45%,
                rgba(8, 23, 15, .18) 100%
            ),
            url('{{ asset('image/blog.webp') }}') center/cover no-repeat;
    }

    .blog-premium-hero::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 130px;
        background: linear-gradient(to top, #fff, transparent);
        pointer-events: none;
    }

    .blog-hero-content {
        position: relative;
        z-index: 2;
        max-width: 820px;
        padding-top: 65px;
    }

    .blog-eyebrow {
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--blog-gold-light);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }

    .blog-eyebrow::before {
        content: "";
        width: 48px;
        height: 1px;
        background: var(--blog-gold-light);
    }

    .blog-premium-hero h1 {
        font-family: "Playfair Display", serif;
        font-size: clamp(55px, 7vw, 92px);
        line-height: .98;
        font-weight: 600;
        color: #fff;
        letter-spacing: -2px;
        margin: 0 0 28px;
    }

    .blog-premium-hero h1 span {
        color: var(--blog-gold-light);
    }

    .blog-hero-description {
        color: rgba(255,255,255,.82);
        font-size: 17px;
        line-height: 1.8;
        max-width: 620px;
        margin-bottom: 30px;
    }

    .blog-breadcrumb {
        display: flex;
        align-items: center;
        gap: 12px;
        color: rgba(255,255,255,.68);
        font-size: 14px;
    }

    .blog-breadcrumb strong {
        color: #fff;
    }

    .blog-breadcrumb i {
        color: var(--blog-gold-light);
        font-size: 10px;
    }

    /* =========================================================
       INTRO
       ========================================================= */

    .blog-intro {
        margin-top: -55px;
        position: relative;
        z-index: 5;
    }

    .blog-intro-card {
        background: #fff;
        padding: 48px 55px;
        box-shadow: 0 20px 65px rgba(14, 34, 23, .10);
        border: 1px solid rgba(0,0,0,.04);
    }

    .blog-intro-label {
        color: var(--blog-gold);
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .blog-intro-title {
        font-family: "Playfair Display", serif;
        color: var(--blog-green);
        font-size: clamp(32px, 4vw, 48px);
        line-height: 1.15;
        margin-bottom: 15px;
    }

    .blog-intro-text {
        color: var(--blog-text);
        max-width: 720px;
        line-height: 1.85;
        margin: 0;
    }

    /* =========================================================
       BLOG GRID
       ========================================================= */

    .blog-list-section {
        padding: 110px 0;
    }

    .blog-section-heading {
        margin-bottom: 55px;
    }

    .blog-section-label {
        color: var(--blog-gold);
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .blog-section-title {
        font-family: "Playfair Display", serif;
        color: var(--blog-green);
        font-size: clamp(40px, 5vw, 62px);
        line-height: 1.05;
        margin: 0;
    }

    .blog-section-heading-row {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 30px;
    }

    .blog-view-all {
        color: var(--blog-green);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1.3px;
        font-size: 12px;
        font-weight: 700;
        border-bottom: 1px solid var(--blog-gold);
        padding-bottom: 7px;
        white-space: nowrap;
    }

    .blog-view-all:hover {
        color: var(--blog-gold);
    }

    /* =========================================================
       BLOG CARD
       ========================================================= */

    .premium-blog-card {
        height: 100%;
        background: #fff;
        border: 1px solid var(--blog-border);
        transition: all .45s ease;
        overflow: hidden;
        position: relative;
    }

    .premium-blog-card:hover {
        transform: translateY(-9px);
        box-shadow: 0 25px 65px rgba(16, 39, 27, .13);
    }

    .blog-card-image {
        height: 340px;
        overflow: hidden;
        position: relative;
        background: var(--blog-soft);
    }

    .blog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .8s cubic-bezier(.2,.7,.2,1);
    }

    .premium-blog-card:hover .blog-card-image img {
        transform: scale(1.07);
    }

    .blog-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,.05),
            rgba(0,0,0,.35)
        );
    }

    .blog-card-category {
        position: absolute;
        top: 20px;
        left: 20px;
        background: rgba(23,61,43,.94);
        color: #fff;
        padding: 8px 14px;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        font-weight: 700;
    }

    .blog-card-number {
        position: absolute;
        bottom: 17px;
        right: 20px;
        color: rgba(255,255,255,.82);
        font-family: "Playfair Display", serif;
        font-size: 28px;
    }

    .blog-card-content {
        padding: 30px 30px 32px;
    }

    .blog-card-title {
        font-family: "Playfair Display", serif;
        color: var(--blog-green);
        font-size: 27px;
        line-height: 1.25;
        margin-bottom: 15px;
    }

    .blog-card-description {
        color: var(--blog-text);
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 24px;
    }

    .blog-card-link {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--blog-green);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.4px;
    }

    .blog-card-link .arrow {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--blog-gold);
        color: var(--blog-gold);
        transition: all .3s ease;
    }

    .premium-blog-card:hover .blog-card-link .arrow {
        background: var(--blog-green);
        border-color: var(--blog-green);
        color: #fff;
        transform: translateX(4px);
    }

    /* =========================================================
       FEATURED STORY
       ========================================================= */

    .blog-featured-section {
        padding: 105px 0;
        background: var(--blog-cream);
    }

    .featured-layout {
        background: var(--blog-green);
        min-height: 480px;
        display: flex;
        overflow: hidden;
    }

    .featured-image {
        width: 50%;
        min-height: 480px;
        position: relative;
    }

    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .featured-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            transparent 55%,
            rgba(23,61,43,.8)
        );
    }

    .featured-content {
        width: 50%;
        padding: 65px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .featured-label {
        color: var(--blog-gold-light);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .featured-content h2 {
        font-family: "Playfair Display", serif;
        color: #fff;
        font-size: clamp(36px, 4vw, 54px);
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .featured-content p {
        color: rgba(255,255,255,.72);
        line-height: 1.85;
        font-size: 15px;
        margin-bottom: 28px;
    }

    .featured-btn {
        display: inline-flex;
        width: fit-content;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        border-bottom: 1px solid var(--blog-gold);
        padding-bottom: 8px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .featured-btn i {
        color: var(--blog-gold-light);
    }

    /* =========================================================
       FAQ
       ========================================================= */

    .premium-faq-section {
        padding: 110px 0;
        background: #fff;
    }

    .faq-heading {
        max-width: 650px;
        margin: 0 auto 55px;
        text-align: center;
    }

    .faq-heading h2 {
        font-family: "Playfair Display", serif;
        color: var(--blog-green);
        font-size: clamp(40px, 5vw, 58px);
        line-height: 1.1;
        margin-bottom: 18px;
    }

    .faq-heading p {
        color: var(--blog-text);
        line-height: 1.8;
    }

    .premium-faq {
        max-width: 900px;
        margin: auto;
        border-top: 1px solid var(--blog-border);
    }

    .premium-faq-item {
        border-bottom: 1px solid var(--blog-border);
    }

    .premium-faq-question {
        width: 100%;
        border: 0;
        background: transparent;
        padding: 25px 5px;
        display: flex;
        align-items: center;
        text-align: left;
        gap: 22px;
        cursor: pointer;
        color: var(--blog-green);
        font-size: 16px;
        font-weight: 600;
    }

    .faq-number {
        color: var(--blog-gold);
        font-family: "Playfair Display", serif;
        font-size: 17px;
        min-width: 32px;
    }

    .faq-plus {
        margin-left: auto;
        width: 30px;
        height: 30px;
        border: 1px solid var(--blog-border);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .3s ease;
        font-size: 20px;
        font-weight: 400;
    }

    .premium-faq-item.active .faq-plus {
        background: var(--blog-green);
        color: #fff;
        border-color: var(--blog-green);
        transform: rotate(45deg);
    }

    .premium-faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height .4s ease;
    }

    .premium-faq-answer-inner {
        padding: 0 55px 27px;
        color: var(--blog-text);
        font-size: 14px;
        line-height: 1.9;
    }

    /* =========================================================
       CTA
       ========================================================= */

    .blog-bottom-cta {
        padding: 110px 0;
        background:
            linear-gradient(
                rgba(15,40,27,.90),
                rgba(15,40,27,.90)
            ),
            url('{{ asset('image/blog.webp') }}') center/cover no-repeat;
        text-align: center;
    }

    .blog-bottom-cta .label {
        color: var(--blog-gold-light);
        text-transform: uppercase;
        letter-spacing: 2.5px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .blog-bottom-cta h2 {
        font-family: "Playfair Display", serif;
        color: #fff;
        font-size: clamp(40px, 5vw, 64px);
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .blog-bottom-cta p {
        color: rgba(255,255,255,.72);
        max-width: 600px;
        margin: 0 auto 30px;
        line-height: 1.8;
    }

    .blog-cta-button {
        display: inline-flex;
        align-items: center;
        gap: 14px;
        padding: 15px 25px;
        background: var(--blog-gold);
        color: #fff !important;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.3px;
        transition: all .3s ease;
    }

    .blog-cta-button:hover {
        background: #fff;
        color: var(--blog-green) !important;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .blog-premium-hero {
            min-height: 570px;
        }

        .blog-list-section,
        .blog-featured-section,
        .premium-faq-section {
            padding: 80px 0;
        }

        .featured-layout {
            display: block;
        }

        .featured-image,
        .featured-content {
            width: 100%;
        }

        .featured-image {
            min-height: 400px;
        }

        .featured-content {
            padding: 50px 40px;
        }
    }

    @media (max-width: 767px) {

        .blog-premium-hero {
            min-height: 540px;
        }

        .blog-premium-hero h1 {
            font-size: 54px;
            letter-spacing: -1px;
        }

        .blog-hero-description {
            font-size: 15px;
        }

        .blog-intro {
            margin-top: -25px;
        }

        .blog-intro-card {
            padding: 32px 25px;
        }

        .blog-section-heading-row {
            display: block;
        }

        .blog-view-all {
            display: inline-block;
            margin-top: 20px;
        }

        .blog-card-image {
            height: 300px;
        }

        .blog-card-content {
            padding: 25px;
        }

        .blog-card-title {
            font-size: 24px;
        }

        .featured-image {
            min-height: 300px;
        }

        .featured-content {
            padding: 40px 28px;
        }

        .premium-faq-question {
            padding: 22px 0;
            gap: 12px;
            font-size: 14px;
        }

        .premium-faq-answer-inner {
            padding: 0 42px 25px;
        }

        .blog-bottom-cta {
            padding: 80px 20px;
        }
    }
</style>

<div class="premium-blog-page">

{{-- =====================================================
     HERO
     ===================================================== --}}
<section class="blog-premium-hero">

    <div class="container">

        <div class="blog-hero-content">

            <div class="blog-eyebrow">
                {{ __('messages.our_stories') }}
            </div>

            <h1>
                Stories from<br>
                <span>the Himalayas.</span>
            </h1>

            <p class="blog-hero-description">
                {{ __('messages.our_stories_desc') }}
            </p>

            <div class="blog-breadcrumb">
                <strong>{{ __('messages.Home') }}</strong>
                <i class="fas fa-chevron-right"></i>
                <span>{{ __('messages.Blogs') }}</span>
            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     INTRO
     ===================================================== --}}
<section class="blog-intro">

    <div class="container">

        <div class="blog-intro-card"
             data-aos="fade-up">

            <div class="blog-intro-label">
                {{ __('messages.our_stories') }}
            </div>

            <h2 class="blog-intro-title">
                {{ __('messages.our_stories_sub') }}
            </h2>

            <p class="blog-intro-text">
                {{ __('messages.our_stories_desc') }}
            </p>

        </div>

    </div>

</section>


{{-- =====================================================
     BLOG POSTS
     ===================================================== --}}
<section class="blog-list-section">

    <div class="container">

        <div class="blog-section-heading"
             data-aos="fade-up">

            <div class="blog-section-heading-row">

                <div>

                    <div class="blog-section-label">
                        Explore Nepal
                    </div>

                    <h2 class="blog-section-title">
                        Stories worth<br>
                        remembering.
                    </h2>

                </div>

                <a href="{{ route('Service') }}"
                   class="blog-view-all">
                    {{ __('messages.view_more') }}
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>

            </div>

        </div>


        <div class="row g-4">

            @foreach ($blogpostcategories->sortByDesc('created_at') as $blogs)

                <div class="col-md-6 col-lg-4"
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->index * 80 }}">

                    <article class="premium-blog-card">

                        <div class="blog-card-image">

                            @if ($blogs->image)

                                <img
                                    src="{{ asset('uploads/blogpostcategory/' . $blogs->image) }}"
                                    alt="{{ $blogs->getTranslated('title') }}">

                            @else

                                <img
                                    src="{{ asset('image/blog.webp') }}"
                                    alt="{{ $blogs->getTranslated('title') }}">

                            @endif

                            <div class="blog-card-overlay"></div>

                            <div class="blog-card-category">
                                {{ __('messages.Blogs') }}
                            </div>

                            <div class="blog-card-number">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>

                        </div>


                        <div class="blog-card-content">

                            <h3 class="blog-card-title">
                                {{ Str::limit(
                                    strip_tags($blogs->getTranslated('title')),
                                    55
                                ) }}
                            </h3>

                            <p class="blog-card-description">
                                {!! Str::limit(
                                    str_replace(
                                        '&nbsp;',
                                        ' ',
                                        strip_tags($blogs->getTranslated('content'))
                                    ),
                                    145
                                ) !!}
                            </p>

                            <a
                                href="{{ route('blog', $blogs->slug) }}"
                                class="blog-card-link">

                                {{ __('messages.view_details') }}

                                <span class="arrow">
                                    →
                                </span>

                            </a>

                        </div>

                    </article>

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- =====================================================
     FEATURED TRAVEL STORY
     ===================================================== --}}
@if ($blogpostcategories->count() > 0)

    @php
        $featuredBlog = $blogpostcategories
            ->sortByDesc('created_at')
            ->first();
    @endphp

    <section class="blog-featured-section">

        <div class="container">

            <div class="featured-layout"
                 data-aos="fade-up">

                <div class="featured-image">

                    @if ($featuredBlog->image)

                        <img
                            src="{{ asset('uploads/blogpostcategory/' . $featuredBlog->image) }}"
                            alt="{{ $featuredBlog->getTranslated('title') }}">

                    @else

                        <img
                            src="{{ asset('image/blog.webp') }}"
                            alt="Nepal travel story">

                    @endif

                </div>


                <div class="featured-content">

                    <div class="featured-label">
                        Featured Story
                    </div>

                    <h2>
                        {{ Str::limit(
                            strip_tags($featuredBlog->getTranslated('title')),
                            65
                        ) }}
                    </h2>

                    <p>
                        {!! Str::limit(
                            str_replace(
                                '&nbsp;',
                                ' ',
                                strip_tags($featuredBlog->getTranslated('content'))
                            ),
                            230
                        ) !!}
                    </p>

                    <a
                        href="{{ route('blog', $featuredBlog->slug) }}"
                        class="featured-btn">

                        {{ __('messages.view_details') }}

                        <i class="fas fa-arrow-right"></i>

                    </a>

                </div>

            </div>

        </div>

    </section>

@endif


{{-- =====================================================
     FAQ
     ===================================================== --}}
<section class="premium-faq-section">

    <div class="container">

        <div class="faq-heading"
             data-aos="fade-up">

            <div class="blog-section-label">
                Travel Guide
            </div>

            <h2>
                Frequently asked<br>
                questions.
            </h2>

            <p>
                Practical answers to help you prepare for your
                Himalayan adventure.
            </p>

        </div>


        <div class="premium-faq"
             data-aos="fade-up">

            @php
                $faqs = [
                    [
                        'q' => 'What are the best trekking seasons in Nepal?',
                        'a' => 'The ideal times to trek in Nepal are during Spring (March to May) and Autumn (September to November). These seasons generally offer favorable weather conditions and excellent mountain visibility.'
                    ],
                    [
                        'q' => 'How physically demanding is trekking in the Himalayas?',
                        'a' => 'Difficulty depends on the trekking route, altitude, duration and daily walking distance. Routes vary from relatively accessible journeys to demanding high-altitude adventures.'
                    ],
                    [
                        'q' => 'What gear should I pack for trekking in Nepal?',
                        'a' => 'Essential equipment generally includes comfortable trekking shoes, layered clothing, a warm jacket, rain protection, sun protection, a water bottle and other route-specific trekking equipment.'
                    ],
                    [
                        'q' => 'Is altitude sickness a concern?',
                        'a' => 'Altitude-related illness can occur during high-altitude trekking. Gradual acclimatization, appropriate pacing, hydration and awareness of symptoms are important when traveling at elevation.'
                    ],
                    [
                        'q' => 'Can I book a guided trek through Unique Nepal?',
                        'a' => 'Yes. Unique Nepal provides trekking and travel experiences that can be arranged according to route, duration, interests, group size and other travel requirements.'
                    ],
                    [
                        'q' => 'Do I need travel insurance for trekking in Nepal?',
                        'a' => 'Travel insurance is strongly recommended for trekking. Travelers should check that their policy covers the activities, altitude and emergency or evacuation requirements relevant to their itinerary.'
                    ],
                    [
                        'q' => 'Are solo treks possible in Nepal?',
                        'a' => 'Solo travel is possible on many routes, but requirements and conditions can vary by trekking area. Travelers should check current regulations and consider professional local support where appropriate.'
                    ]
                ];
            @endphp


            @foreach ($faqs as $index => $faq)

                <div class="premium-faq-item">

                    <button
                        type="button"
                        class="premium-faq-question">

                        <span class="faq-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <span>
                            {{ $faq['q'] }}
                        </span>

                        <span class="faq-plus">
                            +
                        </span>

                    </button>


                    <div class="premium-faq-answer">

                        <div class="premium-faq-answer-inner">
                            {{ $faq['a'] }}
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- =====================================================
     FINAL CTA
     ===================================================== --}}
<section class="blog-bottom-cta">

    <div class="container">

        <div class="label">
            Your journey awaits
        </div>

        <h2>
            Turn the story<br>
            into an adventure.
        </h2>

        <p>
            Explore Nepal beyond the ordinary with thoughtfully
            designed journeys, local expertise and unforgettable
            Himalayan experiences.
        </p>

        <a href="{{ route('Service') }}"
           class="blog-cta-button">

            Explore Nepal

            <i class="fas fa-arrow-right"></i>

        </a>

    </div>

</section>
```

</div>

{{-- =========================================================
AOS
========================================================= --}}

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        AOS.init({
            duration: 900,
            easing: 'ease-out-cubic',
            once: true,
            offset: 80
        });


        /*
         * Premium FAQ accordion
         */
        const faqItems = document.querySelectorAll('.premium-faq-item');

        faqItems.forEach(function (item) {

            const question = item.querySelector('.premium-faq-question');
            const answer = item.querySelector('.premium-faq-answer');

            question.addEventListener('click', function () {

                const isActive = item.classList.contains('active');

                faqItems.forEach(function (otherItem) {

                    otherItem.classList.remove('active');

                    const otherAnswer =
                        otherItem.querySelector('.premium-faq-answer');

                    otherAnswer.style.maxHeight = null;

                });

                if (!isActive) {

                    item.classList.add('active');

                    answer.style.maxHeight =
                        answer.scrollHeight + 'px';

                }

            });

        });

    });
</script>

@endsection

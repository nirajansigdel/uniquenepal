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

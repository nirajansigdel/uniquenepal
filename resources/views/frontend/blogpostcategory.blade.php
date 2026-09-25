@extends('frontend.layouts.master')

<head>
    <title>
        {{ $blogpostcategory->getTranslated('title') }}
        {{ $singleblogmeta?->title ?? ' | Unique Nepal' }}
    </title>

<meta name="description"
      content="{{ $singleblogmeta?->description ?? Str::limit(strip_tags($blogpostcategory->getTranslated('content')), 155) }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
      rel="stylesheet">

</head>

@section('content')


<div class="premium-article-page">

{{-- =====================================================
     HERO
     ===================================================== --}}

<section class="article-hero" style="--hero-image: url('{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}')">

    <div class="container">

        <div class="article-hero-content">

            <div class="article-hero-category">

                {{ __('messages.Blogs') }}

            </div>


            <h1 class="article-hero-title">

                {{ $blogpostcategory->getTranslated('title') }}

            </h1>


            <div class="article-breadcrumb">

                <strong>
                    {{ __('messages.Home') }}
                </strong>

                <i class="fas fa-chevron-right"></i>

                <span>
                    {{ __('messages.Blogs') }}
                </span>

                <i class="fas fa-chevron-right"></i>

                <span>
                    {{ Str::limit(
                        strip_tags($blogpostcategory->getTranslated('title')),
                        55
                    ) }}
                </span>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     ARTICLE
     ===================================================== --}}

<section class="article-main">

    <div class="container">

        <div class="row gx-lg-5">


            {{-- =================================================
                 MAIN CONTENT
                 ================================================= --}}

            <div class="col-lg-8">

                <article class="article-content-column">


                    {{-- FEATURED IMAGE --}}

                    <div class="article-featured-image">

                        <img
                            src="{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}"
                            alt="{{ $blogpostcategory->getTranslated('title') }}">

                        <div class="article-image-caption">

                            {{ __('messages.Blogs') }}

                        </div>

                    </div>


                    {{-- ARTICLE HEADER --}}

                    <header class="article-heading">

                        <div class="article-category-label">

                            Travel Journal

                        </div>


                        <h2 class="article-title">

                            {{ $blogpostcategory->getTranslated('title') }}

                        </h2>


                        <div class="article-intro-line"></div>

                    </header>


                    {{-- ARTICLE BODY --}}

                    <div class="article-body">

                        {!! str_replace(
                            ['<o:p>', '</o:p>'],
                            '',
                            html_entity_decode(
                                app()->getLocale() === 'ne'
                                    ? $blogpostcategory->content_ne
                                    : $blogpostcategory->getTranslated('content')
                            )
                        ) !!}

                    </div>


                    {{-- SHARE --}}

                    <div class="article-share">

                        <div class="article-share-label">
                            Share this story
                        </div>

                        <div class="article-share-links">

                            <a href="#"
                               aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            <a href="#"
                               aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>

                            <a href="#"
                               aria-label="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                        </div>

                    </div>

                </article>

            </div>


            {{-- =================================================
                 SIDEBAR
                 ================================================= --}}

            <div class="col-lg-4">

                <aside class="article-sidebar">


                    {{-- OTHER STORIES --}}

                    <div class="sidebar-card">

                        <div class="sidebar-label">
                            Continue Exploring
                        </div>

                        <h3 class="sidebar-title">
                            More stories<br>
                            from Nepal.
                        </h3>


                        <ul class="sidebar-list">

                            @foreach ($listblogs as $blog)

                                <li>

                                    <a
                                        href="{{ route('blog', ['slug' => $blog->slug]) }}">

                                        <i class="fas fa-arrow-right"></i>

                                        <span>

                                            {{ app()->getLocale() === 'ne'
                                                ? $blog->getTranslated('title_ne')
                                                : $blog->getTranslated('title') }}

                                        </span>

                                    </a>

                                </li>

                            @endforeach

                        </ul>

                    </div>


                    {{-- TRAVEL CTA --}}

                    <div class="sidebar-cta">

                        <small>
                            Plan your journey
                        </small>

                        <h4>
                            Ready to experience Nepal?
                        </h4>

                        <a href="{{ route('Service') }}">

                            Explore our journeys

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
     ===================================================== --}}

<section class="article-bottom-section">

    <div class="container">

        <div class="article-bottom-inner">

            <div class="article-bottom-label">
                Your next adventure
            </div>

            <h2 class="article-bottom-title">
                Read the story.<br>
                Then live it.
            </h2>

            <p class="article-bottom-text">
                Nepal is more than a destination. From Himalayan
                trails to ancient cities and quiet mountain villages,
                there is always another story waiting to be discovered.
            </p>

            <a
                href="{{ route('Service') }}"
                class="article-bottom-button">

                Explore Nepal

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>

    </div>

</section>


</div>

@endsection

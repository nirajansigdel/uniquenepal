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

<style>

    /* =========================================================
       PREMIUM BLOG DETAIL
       ========================================================= */

    :root {
        --article-green: #173d2b;
        --article-green-2: #285b42;
        --article-gold: #b49352;
        --article-gold-light: #d5bc82;
        --article-cream: #f7f4ed;
        --article-soft: #f3f5f1;
        --article-dark: #101713;
        --article-text: #5f6962;
        --article-border: rgba(23,61,43,.12);
    }

    .premium-article-page {
        font-family: "DM Sans", sans-serif;
        color: var(--article-dark);
        background: #fff;
        overflow: hidden;
    }

    .premium-article-page .serif {
        font-family: "Playfair Display", serif;
    }


    /* =========================================================
       HERO
       ========================================================= */

    .article-hero {
        min-height: 590px;
        position: relative;
        display: flex;
        align-items: flex-end;
        overflow: hidden;

        background:
            linear-gradient(
                to top,
                rgba(7,22,14,.94) 0%,
                rgba(7,22,14,.67) 48%,
                rgba(7,22,14,.15) 100%
            ),
            url('{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}')
            center/cover no-repeat;
    }

    .article-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding-bottom: 75px;
    }

    .article-hero-category {
        display: inline-flex;
        align-items: center;
        gap: 10px;

        color: var(--article-gold-light);

        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;

        margin-bottom: 22px;
    }

    .article-hero-category::before {
        content: "";
        width: 35px;
        height: 1px;
        background: var(--article-gold-light);
    }

    .article-hero-title {
        max-width: 1050px;

        font-family: "Playfair Display", serif;
        font-size: clamp(42px, 6vw, 76px);
        line-height: 1.05;
        font-weight: 600;

        color: #fff;

        margin: 0 0 25px;

        letter-spacing: -1.5px;
    }

    .article-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;

        color: rgba(255,255,255,.65);
        font-size: 13px;
    }

    .article-breadcrumb i {
        color: var(--article-gold-light);
        font-size: 9px;
    }

    .article-breadcrumb strong {
        color: #fff;
    }


    /* =========================================================
       ARTICLE WRAPPER
       ========================================================= */

    .article-main {
        padding: 90px 0 120px;
    }


    /* =========================================================
       MAIN ARTICLE
       ========================================================= */

    .article-content-column {
        max-width: 850px;
    }

    .article-featured-image {
        position: relative;
        overflow: hidden;

        margin-bottom: 45px;

        background: var(--article-soft);
    }

    .article-featured-image img {
        display: block;
        width: 100%;
        height: 550px;
        object-fit: cover;

        transition: transform .8s cubic-bezier(.2,.7,.2,1);
    }

    .article-featured-image:hover img {
        transform: scale(1.025);
    }

    .article-image-caption {
        position: absolute;
        bottom: 18px;
        left: 20px;

        background: rgba(17,40,27,.90);
        color: #fff;

        padding: 8px 13px;

        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }


    /* =========================================================
       ARTICLE HEADER
       ========================================================= */

    .article-heading {
        margin-bottom: 35px;
    }

    .article-category-label {
        color: var(--article-gold);

        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;

        margin-bottom: 15px;
    }

    .article-title {
        font-family: "Playfair Display", serif;

        color: var(--article-green);

        font-size: clamp(36px, 5vw, 58px);
        line-height: 1.1;

        margin: 0 0 20px;
    }

    .article-intro-line {
        width: 55px;
        height: 2px;
        background: var(--article-gold);
        margin-bottom: 25px;
    }


    /* =========================================================
       ARTICLE BODY
       ========================================================= */

    .article-body {
        color: var(--article-text);
        font-size: 16px;
        line-height: 1.95;
    }

    .article-body p {
        margin-bottom: 25px;
    }

    .article-body h1,
    .article-body h2,
    .article-body h3,
    .article-body h4 {
        font-family: "Playfair Display", serif;
        color: var(--article-green);

        line-height: 1.25;

        margin-top: 45px;
        margin-bottom: 18px;
    }

    .article-body h2 {
        font-size: 34px;
    }

    .article-body h3 {
        font-size: 28px;
    }

    .article-body h4 {
        font-size: 23px;
    }

    .article-body img {
        max-width: 100%;
        height: auto;

        margin: 30px 0;

        display: block;
    }

    .article-body a {
        color: var(--article-green);
        font-weight: 600;
    }

    .article-body ul,
    .article-body ol {
        margin-bottom: 30px;
        padding-left: 25px;
    }

    .article-body li {
        margin-bottom: 10px;
    }

    .article-body blockquote {
        border-left: 3px solid var(--article-gold);

        margin: 40px 0;
        padding: 15px 30px;

        background: var(--article-cream);

        color: var(--article-green);

        font-family: "Playfair Display", serif;
        font-size: 23px;
        line-height: 1.6;
    }


    /* =========================================================
       SIDEBAR
       ========================================================= */

    .article-sidebar {
        position: sticky;
        top: 110px;
    }

    .sidebar-card {
        background: var(--article-cream);

        border: 1px solid var(--article-border);

        padding: 30px;
    }

    .sidebar-label {
        color: var(--article-gold);

        font-size: 10px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 2px;

        margin-bottom: 10px;
    }

    .sidebar-title {
        font-family: "Playfair Display", serif;

        color: var(--article-green);

        font-size: 29px;
        line-height: 1.2;

        margin-bottom: 25px;
    }

    .sidebar-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-list li {
        border-top: 1px solid var(--article-border);
        padding: 17px 0;
    }

    .sidebar-list li:last-child {
        border-bottom: 1px solid var(--article-border);
    }

    .sidebar-list a {
        display: flex;
        align-items: flex-start;
        gap: 13px;

        text-decoration: none;

        color: var(--article-green);

        font-size: 14px;
        line-height: 1.5;

        transition: all .3s ease;
    }

    .sidebar-list a i {
        color: var(--article-gold);
        font-size: 10px;
        margin-top: 5px;

        transition: transform .3s ease;
    }

    .sidebar-list a:hover {
        color: var(--article-gold);
    }

    .sidebar-list a:hover i {
        transform: translateX(4px);
    }


    /* =========================================================
       SIDEBAR CTA
       ========================================================= */

    .sidebar-cta {
        margin-top: 25px;

        background: var(--article-green);

        padding: 32px 30px;

        color: #fff;
    }

    .sidebar-cta small {
        color: var(--article-gold-light);

        text-transform: uppercase;
        letter-spacing: 1.5px;

        font-size: 10px;
        font-weight: 700;
    }

    .sidebar-cta h4 {
        font-family: "Playfair Display", serif;

        font-size: 27px;
        line-height: 1.25;

        margin: 12px 0 20px;
    }

    .sidebar-cta a {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        color: #fff;
        text-decoration: none;

        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.4px;
        font-weight: 700;

        border-bottom: 1px solid var(--article-gold);
        padding-bottom: 7px;
    }

    .sidebar-cta a i {
        color: var(--article-gold-light);
    }


    /* =========================================================
       SHARE
       ========================================================= */

    .article-share {
        border-top: 1px solid var(--article-border);

        margin-top: 55px;
        padding-top: 25px;

        display: flex;
        align-items: center;
        gap: 18px;
    }

    .article-share-label {
        color: #8a918c;

        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
    }

    .article-share-links {
        display: flex;
        gap: 8px;
    }

    .article-share-links a {
        width: 35px;
        height: 35px;

        border: 1px solid var(--article-border);

        display: flex;
        align-items: center;
        justify-content: center;

        color: var(--article-green);

        text-decoration: none;

        transition: all .3s ease;
    }

    .article-share-links a:hover {
        background: var(--article-green);
        color: #fff;
        border-color: var(--article-green);
    }


    /* =========================================================
       RELATED CTA
       ========================================================= */

    .article-bottom-section {
        background: var(--article-cream);
        padding: 95px 0;
    }

    .article-bottom-inner {
        max-width: 800px;
        margin: auto;
        text-align: center;
    }

    .article-bottom-label {
        color: var(--article-gold);

        text-transform: uppercase;
        letter-spacing: 2.5px;

        font-size: 11px;
        font-weight: 700;

        margin-bottom: 17px;
    }

    .article-bottom-title {
        font-family: "Playfair Display", serif;

        color: var(--article-green);

        font-size: clamp(38px, 5vw, 60px);

        line-height: 1.08;

        margin-bottom: 20px;
    }

    .article-bottom-text {
        color: var(--article-text);

        line-height: 1.85;

        max-width: 650px;
        margin: 0 auto 30px;
    }

    .article-bottom-button {
        display: inline-flex;
        align-items: center;
        gap: 14px;

        background: var(--article-green);
        color: #fff !important;

        text-decoration: none;

        padding: 15px 25px;

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 1.3px;

        transition: all .3s ease;
    }

    .article-bottom-button:hover {
        background: var(--article-gold);
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .article-hero {
            min-height: 540px;
        }

        .article-main {
            padding: 70px 0 90px;
        }

        .article-sidebar {
            position: relative;
            top: auto;
            margin-top: 55px;
        }

        .article-featured-image img {
            height: 470px;
        }
    }


    @media (max-width: 767px) {

        .article-hero {
            min-height: 500px;
        }

        .article-hero-content {
            padding-bottom: 50px;
        }

        .article-hero-title {
            font-size: 42px;
        }

        .article-main {
            padding: 55px 0 70px;
        }

        .article-featured-image {
            margin-bottom: 32px;
        }

        .article-featured-image img {
            height: 330px;
        }

        .article-title {
            font-size: 37px;
        }

        .article-body {
            font-size: 15px;
            line-height: 1.85;
        }

        .article-body blockquote {
            font-size: 19px;
            padding-left: 20px;
        }

        .sidebar-card,
        .sidebar-cta {
            padding: 25px;
        }

        .article-share {
            align-items: flex-start;
            flex-direction: column;
        }

        .article-bottom-section {
            padding: 75px 20px;
        }
    }

</style>

<div class="premium-article-page">

{{-- =====================================================
     HERO
     ===================================================== --}}

<section class="article-hero">

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

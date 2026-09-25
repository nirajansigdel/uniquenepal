@extends('frontend.layouts.master')

@section('content')



<div class="premium-single-gallery">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="single-gallery-hero">

        <div class="single-gallery-hero-content">

            <div class="container text-center">

                <div class="single-gallery-eyebrow">
                    Unique Nepal
                </div>

                <h1>
                    Explore Image
                </h1>

                <div class="single-gallery-breadcrumb">

                    <span class="home">
                        Home
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        Gallery
                    </span>

                    <i class="fas fa-chevron-right"></i>

                    <span>
                        {{ $image->title }}
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <section class="single-gallery-main">

        <div class="container">

            {{-- HEADER --}}

            <div class="single-gallery-header">

                <div class="single-gallery-label">
                    Photo Story
                </div>

                <h2 class="single-gallery-title">
                    {{ $image->title }}
                </h2>

                <div class="single-gallery-line"></div>

                @if(!empty($image->img_desc))

                    <div class="single-gallery-description">
                        {{ $image->img_desc }}
                    </div>

                @endif

            </div>


            {{-- =================================================
                 IMAGES
            ================================================== --}}

            <div class="single-photo-grid">

                @foreach (array_reverse($image->img) as $index => $imgUrl)

                    <a
                        href="{{ asset($imgUrl) }}"
                        class="single-photo image-link"
                        title="{{ $image->title }}">

                        <img
                            src="{{ asset($imgUrl) }}"
                            alt="{{ $image->title }} - Image {{ $index + 1 }}"
                            loading="{{ $index < 2 ? 'eager' : 'lazy' }}">

                        <span class="photo-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <span class="photo-expand">
                            <i class="fas fa-expand-alt"></i>
                        </span>

                        <span class="photo-bottom">

                            <span>
                                {{ $image->title }}
                            </span>

                            <i class="fas fa-arrow-up-right-from-square"></i>

                        </span>

                    </a>

                @endforeach

            </div>


            {{-- BACK --}}

            <div class="gallery-back">

                <a href="{{ url()->previous() }}">

                    <i class="fas fa-arrow-left"></i>

                    Back to Gallery

                </a>

            </div>

        </div>

    </section>

</div>


{{-- =========================================================
     MAGNIFIC POPUP
========================================================= --}}

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">


<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js">
</script>


<script>
    $(document).ready(function () {

        $('.image-link').magnificPopup({

            type: 'image',

            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 2]
            },

            image: {
                titleSrc: 'title'
            },

            removalDelay: 200,

            mainClass: 'mfp-fade',

            closeOnContentClick: false,

            fixedContentPos: true

        });

    });
</script>

@endsection
@extends('frontend.layouts.master')



<head>
    <title>{{ $ProductfourMeta?->title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $ProductfourMeta?->description ?? '' }}">

</head>

@section('content')
<div class="content-wrapper">

    <!-- HERO SECTION -->
    <section class="position-relative text-white text-center"
        style="background:url('{{ asset('image/destin.jpg') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <p class="fw-bold display-4">{{ __('messages.adventure') }}</p>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('messages.Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('messages.adventure') }}
                </p>
            </div>
        </div>
    </section>

    <div class="container my-4">

        <div class="row">
            <div class="directors-header mb-4 text-center">
                <p class="heading mb-1">{{ __('messages.perfect_for_two') }}</p>
                <p class="extralarger">
                    {{ __('messages.celebrate_togetherness_with_special_deals') }}
                </p>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <h4>No destinations available yet.</h4>
                        <p>Please check back later for new destinations.</p>
                    </div>
                </div>
            </div>
        @else

        <div class="row">
            @foreach($products as $product)
              <div class="col-md-4 mb-4">
    <div class="lang-card position-relative overflow-hidden shadow">

        @if(is_array($product->images) && count($product->images))
            <img src="{{ asset('uploads/products/' . $product->images[0]) }}"
                 alt="{{ $product->heading ?? 'Destination Image' }}"
                 class="w-100 h-100"
                 style="object-fit: cover;">
        @else
            <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60"
                 class="w-100 h-100"
                 style="object-fit: cover;">
        @endif


        <!-- Location (Top Left) -->
        @if($product->getTranslated('location'))
            <div class="position-absolute top-0 start-0 m-3">
                <span class="badge location-badge">
                    <i class="fas fa-map-marker-alt me-1"></i>
                    {{ $product->getTranslated('location') }}
                </span>
            </div>
        @endif


        <!-- Price (Top Right) -->
        @if($product->discounted_price || $product->original_price)
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge price-badge">
                    $ {{ number_format($product->discounted_price ?? $product->original_price) }}
                </span>
            </div>
        @endif


        <!-- Bottom Overlay Content -->
        <div class="position-absolute bottom-0 w-100 lang-overlay p-4">

            <h4 class="text-white fw-bold couple-card-title-clamp">
                {{ $product->getTranslated('heading') ?? 'Untitled Destination' }}
            </h4>

            <p class="text-white small couple-content-clamp mb-3">
                {{ Str::limit(strip_tags($product->getTranslated('content') ?? ''), 130) }}
            </p>

            <a href="{{ route('products.detail', $product->id) }}"
               class="couple-btn btn btn-light rounded-pill px-4 fw-semibold">
                {{ __('messages.view_details') }}
            </a>
        </div>

    </div>
</div>
            @endforeach
        </div>
        @if($products->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        @endif
        @endif
        <!-- EXTRA SPACE -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center text-muted">
                    <hr class="my-4">
                    <p class="mb-0">
                        {{ __('messages.discover_amazing_destinations') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-spacer"></div>
    </div>
</div>
@endsection

@extends('frontend.layouts.master')


<head>
    <title>{{ $ProductfiveMeta?->title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $ProductfiveMeta?->description ?? '' }}">

</head>

@section('content')

<div class="content-wrapper">
    <section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/blog.webp') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">{{ __('messages.dolpa') }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('messages.Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                  {{ __('messages.dolpa') }}
                </p>
            </div>
        </div>
    </section>

    <div class="container my-4">
        <div class="row">
           <div class="directors-header mb-4 text-center mb-5">
            <p class="heading mb-1">{{ __('messages.dolpa') }}</p>
            <p class="extralarger">
                {{ __('messages.brings') }}</p>
        </div>
        </div>

        @if($products->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <h4>No group packages available yet.</h4>
                        <p>Please check back later for new group offers.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($products  as $product)
                    <div class="col-md-4 mb-4">
    <div class="group-card position-relative overflow-hidden shadow-lg">

        @if(is_array($product->images) && count($product->images))
            <img src="{{ asset('uploads/products/' . $product->images[0]) }}"
                 alt="{{ $product->heading ?? 'Group Package Image' }}"
                 class="w-100 h-100"
                 style="object-fit: cover;">
        @else
            <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60"
                 class="w-100 h-100"
                 style="object-fit: cover;">
        @endif

        {{-- LOCATION (TOP LEFT) --}}
        @if($product->getTranslated('location'))
        <div class="position-absolute top-0 start-0 m-3">
            <span class="badge location-badge">
                <i class="fas fa-map-marker-alt me-1"></i>
                {{ $product->getTranslated('location') }}
            </span>
        </div>
        @endif

        {{-- PRICE (TOP RIGHT) --}}
        @if($product->discounted_price || $product->original_price)
        <div class="position-absolute top-0 end-0 m-3">
            <span class="badge price-badge">
                ${{ number_format($product->discounted_price ?? $product->original_price) }}
            </span>
        </div>
        @endif

        {{-- BOTTOM OVERLAY --}}
        <div class="position-absolute bottom-0 w-100 group-overlay p-4">

            <h4 class="text-white fw-bold group-title-clamp">
                {{ $product->getTranslated('heading') ?? 'Untitled Group Package' }}
            </h4>

            <p class="text-white small group-content-clamp mb-3">
                {!! Str::limit($product->getTranslated('content'), 130) !!}
            </p>

            <a href="{{ route('products.detail', $product->id) }}"
               class="btn btn-light rounded-pill px-4 fw-semibold">
                {{ __('messages.view_details') }}
                <i class="bi bi-arrow-right ms-1"></i>
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

        <!-- Footer spacer to ensure proper separation -->
        <div class="footer-spacer"></div>
    </div>
</div>
@endsection


@extends('frontend.layouts.master')
<head>
    <title>{{ $singlemeta?->title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $singlemeta?->description ?? '' }}">

</head>

@section('content')
  <section class="position-relative text-white text-center mb-5"
        style="background: url('{{ asset('image/blog.webp') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">{{ __('messages.activities') }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('messages.Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('messages.activities') }}
                </p>
            </div>
        </div>
    </section>
    
    
    <div class="container my-2"> 
<div class="row">
@foreach($products as $product)
    <div class="col-md-4 mb-4">

        <div class="promo-card shadow">

            {{-- IMAGE --}}
            @if(is_array($product->images) && count($product->images))
                <img src="{{ asset('uploads/products/'.$product->images[0]) }}">
            @else
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4">
            @endif


            {{-- LOCATION --}}
            @if($product->getTranslated('location'))
                <div class="location-badge">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $product->getTranslated('location') }}
                </div>
            @endif


            {{-- PRICE --}}
            @if($product->discounted_price || $product->original_price)
                <div class="price-tag">
                    ${{ number_format($product->discounted_price ?? $product->original_price) }}
                </div>
            @endif


            {{-- OVERLAY CONTENT --}}
            <div class="promo-overlay">

                <div class="promo-content">

                    <h4>
                        {{ $product->getTranslated('heading') }}
                        @if($product->date)
                            – {{ $product->date }}
                        @endif
                    </h4>

                    <p>
                        {{ Str::limit(strip_tags($product->getTranslated('content')), 120) }}
                    </p>


                    <a href="{{ route('products.detail', $product->id) }}"
                       class="promo-btn">
                        View More
                    </a>

                </div>

            </div>

        </div>

    </div>
@endforeach
</div>
</div>

@endsection

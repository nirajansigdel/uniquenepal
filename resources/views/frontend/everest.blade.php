@extends('frontend.layouts.master')


<head>
    <title>{{ $ProductoneMeta?->title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $ProductoneMeta?->description ?? '' }}">

</head>

@section('content')
<div class="content-wrapper">

    <!-- HERO -->
    <section class="position-relative text-white text-center mb-5"
        style="background: url('{{ asset('image/blog.webp') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>
        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">{{ __('messages.everest') }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('messages.Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('messages.everest') }}
                </p>
            </div>
        </div>
    </section>


    <!-- DESTINATION CARDS -->
    <div class="container my-5">

    @if($products->isEmpty())

        <p class="text-center">No destinations available</p>

    @else

    <div class="dest-grid">

        @foreach($products as $product)

            @php
                if (\Illuminate\Support\Facades\Route::has('products.detail')) {
                    $viewUrl = route('products.detail', $product->id);
                } elseif (!empty($product->slug)) {
                    $viewUrl = url('/products/'.$product->slug);
                } else {
                    $viewUrl = url('/products/'.$product->id);
                }

                $desc = $product->getTranslated('description')
                    ?? $product->getTranslated('content')
                    ?? '';
            @endphp

            <div class="dest-card">

                {{-- IMAGE --}}
                @if(is_array($product->images) && count($product->images))
                    <img src="{{ asset('uploads/products/'.$product->images[0]) }}"
                         alt="{{ $product->getTranslated('heading') }}">
                @else
                    <img src="https://via.placeholder.com/600x800"
                         alt="{{ $product->getTranslated('heading') }}">
                @endif

                {{-- OVERLAY CONTENT --}}
                <div class="dest-overlay">

                    <h3 class="dest-title">
                        {{ $product->getTranslated('heading') ?? 'Untitled Destination' }}
                    </h3>

                    <p class="dest-desc">
                        {{ Str::limit(strip_tags($desc), 110) }}
                    </p>

                    <a href="{{ $viewUrl }}" class="dest-btn">
                        View More
                    </a>


                </div>

            </div>

        @endforeach

    </div>

    @endif

    </div>

</div>
@endsection

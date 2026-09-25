@extends('frontend.layouts.master')


<head>
    <title>{{ $ProductthreeMeta?->title ?? 'Default Title' }}</title>
    <meta name="description" content="{{ $ProductthreeMeta?->description ?? '' }}">

</head>

@section('content')
<div class="content-wrapper">

    <!-- HERO -->
    <section class="position-relative text-white text-center mb-4"
        style="background:url('{{ asset('image/blog.webp') }}') center/cover no-repeat;height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div>
                <h1 class="fw-bold display-4">{{ __('messages.langtang') }}</h1>
                <p>
                    {{ __('messages.Home') }}
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('messages.langtang') }}
                </p>
            </div>
        </div>
    </section>


    <div class="container py-3">
        <div class="text-center mb-5">
            <h2 class="fw-bold">{{ __('messages.festival_special') }}</h2>
            <p>{{ __('messages.festive_message') }}</p>
        </div>

        @if($products->isEmpty())
            <div class="alert alert-info text-center">
                No festivals available yet.
            </div>
        @else

        <div class="row g-4">

            @foreach($products as $product)
            <div class="col-md-4">

                <div class="festival-card">

                    @if(is_array($product->images) && count($product->images))
                        <img src="{{ asset('uploads/products/' . $product->images[0]) }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470">
                    @endif

                    <div class="festival-overlay">
                        <div class="festival-content">

                            <h3>
                                {{ $product->getTranslated('heading') ?? 'Untitled Festival' }}
                            </h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit( strip_tags($product->getTranslated('content') ?? ''), 120) }}
                            </p>

                            <a class="festival-btn" href="{{ route('products.detail',$product->id) }}">
                                View More →
                            </a>


                        </div>
                    </div>

                </div>

            </div>
            @endforeach

        </div>

        @endif

    </div>
</div>
@endsection

@extends('frontend.layouts.master')


@section('content')
<div class="content-wrapper">

    <!-- HERO SECTION -->
    <section class="position-relative text-white text-center mb-5"
        style="background: url('{{ asset('image/blog.webp') }}') center center / cover no-repeat; height:400px;">

        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">{{ __('messages.activities') }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">Home</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('messages.activities') }}
                </p>
            </div>
        </div>

    </section>


    <!-- CONTENT -->
    <div class="container">

        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Special Offer for Everyone</h2>
                <p class="text-muted">
                    Enjoy exclusive deals made just for you.
                </p>
            </div>
        </div>

        @if($products->isEmpty())

            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <h4>No travel posts available yet.</h4>
                        <p>Please check back later for our latest travel stories.</p>
                    </div>
                </div>
            </div>

        @else

            <div class="row">

                @foreach($products as $product)

                    <div class="col-md-4 mb-4">

                        <div class="festival-card">

                            @if(is_array($product->images) && count($product->images))
                                <img src="{{ asset('uploads/products/' . $product->images[0]) }}">
                            @else
                                <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500">
                            @endif

                            <div class="festival-overlay">

                                <h5>
                                    {{ $product->getTranslated('heading') ?? 'Untitled Post' }}
                                </h5>

                                @if($product->getTranslated('subtitle'))
                                    <p>
                                        {{ Str::limit($product->getTranslated('subtitle'), 90) }}
                                    </p>
                                @endif

                                <a href="{{ route('products.detail',$product->id) }}"
                                   class="festival-btn">
                                    View More →
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            @if($products->hasPages())
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif

        @endif


        <div class="row mt-5">
            <div class="col-12 text-center text-muted">
                <hr>
                <p class="mb-0">
                    Discover amazing travel stories and insights from our adventures.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection

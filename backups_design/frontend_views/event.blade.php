@extends('frontend.layouts.master')

@section('content')
<section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/events.jpg') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <p class="fw-bold display-4">NEWS & Events</p>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">Home</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    Updates
                </p>
            </div>
        </div>
    </section>

<!-- ======= Blog Hero Section ======= -->



<section class="container-fluid bg-light">

<div class="container py-5 ">
    <div class="directors-header mb-5 text-center">
            <p class="heading mb-1">Collection of Events</p>
            <p class="extralarger">
             Shaping a better for tomorrow.
            </p>
        </div>
    <div class="row">
        @foreach ($events as $event)
  <div class="col-md-4">
        <img src="{{ asset('uploads/events/' . $event->image) }}" class="card-img-top blog-img" alt="Traveller">
        <div class="card-body px-0 mt-1">
          <small class="text-uppercase fw-semibold content-topheading">Traveller Events</small>
          <h5 class="card-title fw-semibold mt-2 text-dark content-heading text-capitalize">{{ $event->heading }}</h5>
          <p class="card-text text-muted mt-2">{{ \Illuminate\Support\Str::limit(strip_tags($event->content), 150) }}</p>
          <a href="{{ route('singleevents', $event->slug) }}" class="text-dark fw-semibold  text-decoration-none content-button">
            Read More <i class="bi bi-arrow-right"></i>
          </a>
        </div>
    </div>
        @endforeach
    </div>
</div>
</section>
@endsection



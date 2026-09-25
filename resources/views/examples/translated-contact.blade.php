@extends('frontend.layouts.master')

@section('content')
<section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/contact.webp') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">{{ __('connect with us') }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ __('Contact') }}
                </p>
            </div>
        </div>
    </section>

<!-- Hero Contact Section -->
<section class=" container-fluid py-5 bg-white">
  <div class="container">
    <div class="row align-items-center g-4">
      <!-- Left Text -->
      <div class="col-md-5">
        <p class="heading  mb-2">{{ __('Contact Us') }}</p>
        <h2 class="fw-bold">{{ __('We Would') }} <span class="text-orange">{{ __('Love To Connect!') }}</span></h2>
        <p class="content-desc">{{ __('Always here to support, guide, and connect with you. Feel free to reach out.') }}</p>
        <a href="https://api.whatsapp.com/send?phone=9779851222693" class=" btn cta-button px-4 py-3 d-inline-flex align-items-center">
          <i class="bi bi-whatsapp me-2"></i> {{ __('Whatsapp') }}
        </a>
      </div>

      <!-- Right Image -->
      <div class="col-md-7 text-center row">
            <div class="col-md-4 text-center bg-white rounded shadow-sm p-4 mb-2" data-aos="zoom-in">
        <i class="fa-solid fa-location-dot  fa-2x mb-2"></i>
        <h5 class="fw-semibold mb-2">{{ __('Office Address') }}</h5>
        @if (!empty($sitesetting->office_address))
            <p class="text-muted">{{ $sitesetting->office_address }}</p>
        @else
            <p class="text-muted">{{ __('No address available') }}</p>
        @endif
      </div>

      <div class="col-md-4 text-center bg-white rounded shadow-sm p-4 mb-2" data-aos="zoom-in">
        <i class="fa-solid fa-phone fa-2x mb-2"></i>
        <h5 class="fw-semibold mb-2">{{ __('Office Contact') }}</h5>
        @if (!empty($sitesetting->office_contact))
            <p class="text-muted">{{ $sitesetting->office_contact }}</p>
        @else
            <p class="text-muted">{{ __('No contact available') }}</p>
        @endif
      </div>

      <div class="col-md-4 text-center bg-white rounded shadow-sm p-4 mb-2" data-aos="zoom-in">
        <i class="fa-solid fa-envelope fa-2x mb-2"></i>
        <h5 class="fw-semibold mb-2">{{ __('Office Email') }}</h5>
        @if (!empty($sitesetting->office_email))
            <p class="text-muted">{{ $sitesetting->office_email }}</p>
        @else
            <p class="text-muted">{{ __('No email available') }}</p>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- Contact Form Section -->
<section class="container-fluid py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="text-center mb-5">
          <h2 class="fw-bold">{{ __('Get In Touch') }}</h2>
          <p class="text-muted">{{ __('Send us a message and we\'ll get back to you as soon as possible.') }}</p>
        </div>
        
        <form action="{{ route('Contact.store') }}" method="POST" class="bg-white p-4 rounded shadow">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-12">
              <label for="subject" class="form-label">{{ __('Subject') }} <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="col-12">
              <label for="message" class="form-label">{{ __('Message') }} <span class="text-danger">*</span></label>
              <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="privacy" required>
                <label class="form-check-label" for="privacy">
                  {{ __('I agree with the Privacy Policy.') }}
                </label>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary px-5 py-2">
                <i class="bi bi-send me-2"></i>{{ __('Send Message') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

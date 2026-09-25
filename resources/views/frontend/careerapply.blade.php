@extends('frontend.layouts.master')
@section('content')
   <section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/q.avif') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <p class="fw-bold display-4">About us</p>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">Home</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    About
                </p>
            </div>
        </div>
    </section>
    
    jjkll


<div class="container">
    <p class="text-center mt-5">Apply to Volunteer</p>
    <p class="text-center mb-4">Fill out the form below to apply for the Community Clean-Up Volunteer opportunity.</p>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                   <form action="#" method="POST" enctype="multipart/form-data">
    {{-- @csrf --}}
    
    {{-- Name --}}
    <div class="mb-3">
        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
        <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" required>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
        <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
    </div>

    {{-- Phone --}}
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" id="phone" name="phone" class="form-control" placeholder="(123) 456-7890">
    </div>

    {{-- Availability --}}
    <div class="mb-3">
        <label for="availability" class="form-label">Availability</label>
        <textarea id="availability" name="availability" rows="3" class="form-control" placeholder="Let us know when you're available"></textarea>
    </div>

    {{-- Motivation --}}
    <div class="mb-3">
        <label for="message" class="form-label">Why do you want to volunteer?</label>
        <textarea id="message" name="message" rows="4" class="form-control" placeholder="Tell us why you're interested in this opportunity"></textarea>
    </div>

    {{-- CV Upload --}}
    <div class="mb-3">
        <label for="cv" class="form-label">Upload CV / Resume <span class="text-danger">*</span></label>
        <input type="file" id="cv" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
    </div>

    {{-- Academic Certificates --}}
    <div class="mb-3">
        <label for="certificate" class="form-label">Upload Academic Certificates</label>
        <input type="file" id="certificate" name="certificate" class="form-control" accept=".pdf,.jpg,.png,.jpeg">
    </div>

    {{-- Additional Documents --}}
    <div class="mb-3">
        <label for="additional_docs" class="form-label">Upload Additional Documents (if any)</label>
        <input type="file" id="additional_docs" name="additional_docs[]" class="form-control" accept=".pdf,.jpg,.png,.jpeg" multiple>
    </div>

    {{-- Submit --}}
    <div class="text-end flex ">
        <button type="submit" class="btn cta-button px-4">Submit Application</button>
        <a href="{{ route('career') }}" class="btn btn-outline-secondary ms-2 my-2">Back to Opportunities</a>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>







@endsection
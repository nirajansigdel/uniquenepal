@extends('frontend.layouts.master')
@section('content')


<section class="position-relative bg-dark text-white d-flex align-items-center justify-content-center mb-5"
    style="height: 50vh;">
    <!-- Background Image & Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-image"
        style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1400&q=80'); background-size: cover; background-position: center;">
        <div class="w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);"></div>
    </div>

    <!-- Content -->
    <div class="container text-center position-relative z-1 ">
        <h1 class="fw-bold display-5">Volunteer Opportunities</h1>
        <p class="text-white-50 text-uppercase small mt-2">Home /Volunteer Opportunities</p>
    </div>
</section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h3 class="card-title text-primary mb-3">Community Clean-Up Volunteer</h3>

                    <ul class="list-unstyled mb-3">
                        <li><strong>Location:</strong> Downtown City Park</li>
                        <li><strong>Date:</strong> August 10, 2025</li>
                        <li><strong>Time:</strong> 9:00 AM – 1:00 PM</li>
                        <li><strong>Spots Available:</strong> 25</li>
                    </ul>

                    <p class="card-text">
                        Help us beautify our city by volunteering for our monthly community clean-up day.
                        Tasks will include picking up litter, planting flowers, and helping with recycling efforts.
                        No prior experience needed — just bring your energy and enthusiasm!
                    </p>

                    <p><strong>Requirements:</strong> Comfortable clothing, water bottle, and willingness to work outdoors.</p>

                    <div class="mt-4 text-end">
                        <a href="{{ route('applycareer') }}" class="btn cta-button px-4">Apply Now</a>
                        <a href="#" class="btn btn-outline-secondary ms-2 my-2">Back to Opportunities</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
@endsection
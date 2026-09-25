@extends('frontend.layouts.master')

<head>
    <title>Find Jobs That Match Your Age & Skills</title>
    <meta name="description" content="Looking for jobs by age? Discover entry-level, mid-career, and senior roles tailored to your experience and skills. Browse openings and apply now.

Find the best job opportunities for every age group. Sea">

</head>


@section('content')
   <section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/q.avif') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h1 class="fw-bold display-4">  {{ $career->title }}</h1>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">{{ __('messages.Home') }}</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    {{ $career->title }}
                </p>
            </div>
        </div>
    </section>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="text-center mb-0">Apply to {{ $career->title }} </h2>
                </div>
                <div class="card-body">
                    <p class="text-center text-muted mb-4">
                        Fill out the form below to apply for the {{ $career->title }} opportunity.
                    </p>

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('career-applications.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ $career->id }}">

                        <div class="form-group mb-3">
                            <label for="full_name">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="availability">Availability</label>
                            <textarea name="availability" id="availability" class="form-control @error('availability') is-invalid @enderror" rows="3" placeholder="Let us know when you're available">{{ old('availability') }}</textarea>
                            @error('availability')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="why_volunteer">Why do you want to volunteer?</label>
                            <textarea name="why_volunteer" id="why_volunteer" class="form-control @error('why_volunteer') is-invalid @enderror" rows="3" placeholder="Tell us why you're interested in this opportunity">{{ old('why_volunteer') }}</textarea>
                            @error('why_volunteer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="cv_resume">Upload CV / Resume *</label>
                            <input type="file" name="cv_resume" id="cv_resume" class="form-control @error('cv_resume') is-invalid @enderror" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 2MB)</small>
                            @error('cv_resume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="academic_certificates">Upload Academic Certificates</label>
                            <input type="file" name="academic_certificates" id="academic_certificates" class="form-control @error('academic_certificates') is-invalid @enderror" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)</small>
                            @error('academic_certificates')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="additional_documents">Upload Additional Documents (if any)</label>
                            <input type="file" name="additional_documents" id="additional_documents" class="form-control @error('additional_documents') is-invalid @enderror" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX, JPG, PNG (Max: 2MB)</small>
                            @error('additional_documents')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn cta-button">Submit Application</button>
                            <a href="{{ route('career') }}" class="btn btn-outline-secondary">Back To Opportunities</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
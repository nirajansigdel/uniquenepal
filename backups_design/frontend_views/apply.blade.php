
@extends('frontend.layouts.master')
@section('content')

    <section class="position-relative text-white text-center"
        style="background: url('{{ asset('image/blog.webp') }}') center center / cover no-repeat; height:400px;">
        <div class="herosectionoverlay"></div>

        <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative">
            <div class="mt-5 pt-5">
                <h3 class="fw-bold display-4">Our POst </h3>
                <p class="mt-2 fs-5">
                    <span class="fw-semibold">Home</span>
                    <i class="fas fa-angle-double-right mx-2 text-warning"></i>
                    Posts
                </p>
            </div>
        </div>
    </section>

<!-- Success and Error Alert Messages -->
@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="container my-5">
  <div class="card shadow-lg border-0">
    <div class="card-body p-5">
        <h2 class="mb-4 fw-bold text-warning">Apply for: <span class="text-dark">{{ $product->heading }}</span></h2>

        <form id="applicationForm" action="{{ route('apply.store', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Full Name -->
                <div class="col-md-4">
                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                           id="address" name="address" value="{{ old('address') }}">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone_no" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                           id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
                    @error('phone_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- WhatsApp -->
                <div class="col-md-6">
                    <label for="whatsapp_no" class="form-label">WhatsApp Number</label>
                    <input type="tel" class="form-control @error('whatsapp_no') is-invalid @enderror"
                           id="whatsapp_no" name="whatsapp_no" value="{{ old('whatsapp_no') }}">
                    @error('whatsapp_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Message -->
                <div class="col-md-12">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write something if you wish...">{{ old('message') }}</textarea>
                </div>

                <!-- File Upload -->
                <div class="col-md-12">
                    <label for="document_proof" class="form-label">
                        Upload Document <span class="text-danger">*</span>
                        <small class="text-muted">(Citizenship, License, etc. — PDF, JPG, PNG, DOC)</small>
                    </label>
                    <input type="file" class="form-control @error('document_proof') is-invalid @enderror"
                           id="document_proof" name="document_proof" required>
                    @error('document_proof')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn cta-button px-4 py-2 fw-semibold">
                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

</div>

    <!-- Custom CSS -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection







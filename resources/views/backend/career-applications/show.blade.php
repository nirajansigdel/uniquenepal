@extends('backend.layouts.master')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">📋 Application Details</h4>
                    <a href="{{ route('admin.career-applications.index') }}" class="btn btn-light btn-sm">Back to List</a>
                </div>

                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Applicant Info --}}
                    <div class="mb-4">
                        <h5 class="mb-3 border-bottom pb-2">👤 Applicant Information</h5>
                        <table class="table table-borderless">
                            <tr clas><td><strong>Name:</strong></td><td>{{ $application->full_name }}</td></tr>
                            <tr><td><strong>Email:</strong></td><td>{{ $application->email }}</td></tr>
                            <tr><td><strong>Phone:</strong></td><td>{{ $application->phone ?: 'Not provided' }}</td></tr>
                            <tr><td><strong>Applied for:</strong></td><td>{{ $application->career->title }}</td></tr>
                            <tr><td><strong>Applied Date:</strong></td><td>{{ $application->created_at->format('M d, Y \a\t g:i A') }}</td></tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span class="badge {{ $application->status_badge }}">{{ $application->status_text }}</span></td>
                            </tr>
                        </table>
                    </div>

                    {{-- Optional Sections --}}
                    @if($application->availability)
                        <div class="mb-4">
                            <h5 class="mb-2 text-secondary">📅 Availability</h5>
                            <p class="mb-0">{{ $application->availability }}</p>
                        </div>
                    @endif

                    @if($application->why_volunteer)
                        <div class="mb-4">
                            <h5 class="mb-2 text-secondary">🤝 Why Volunteer?</h5>
                            <p class="mb-0">{{ $application->why_volunteer }}</p>
                        </div>
                    @endif

                    @if($application->admin_notes)
                        <div class="mb-4">
                            <h5 class="mb-2 text-secondary">📝 Admin Notes</h5>
                            <p class="mb-0">{{ $application->admin_notes }}</p>
                        </div>
                    @endif

                    {{-- Documents --}}
                    <div class="mb-4">
                        <h5 class="mb-3 border-bottom pb-2">📎 Documents</h5>
                        <div class="d-flex flex-column gap-2">
                            @if($application->cv_resume)
                                <a href="{{ Storage::url($application->cv_resume) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-alt me-1"></i> Download CV/Resume
                                </a>
                            @endif
                            @if($application->academic_certificates)
                                <a href="{{ Storage::url($application->academic_certificates) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-alt me-1"></i> Download Certificates
                                </a>
                            @endif
                            @if($application->additional_documents)
                                <a href="{{ Storage::url($application->additional_documents) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-file-alt me-1"></i> Download Additional Documents
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Update Form --}}
                    <div class="mt-5">
                        <h5 class="mb-3 border-bottom pb-2">🔧 Update Status</h5>
                        <form action="{{ route('admin.career-applications.update-status', $application->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="completed" selected>Completed</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection

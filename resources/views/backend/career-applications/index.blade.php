@extends('backend.layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">📄 Career Applications Report</h4>
                </div>

                <div class="card-body">
                    {{-- Alerts --}}
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Table --}}
                    @if ($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>Applicant Name</th>
                                        <th>Position</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Applied On</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $index => $application)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $application->full_name }}</strong></td>
                                            <td>{{ $application->career->title }}</td>
                                            <td>{{ $application->email }}</td>
                                            <td>{{ $application->phone ?: 'N/A' }}</td>
                                            <td>
                                                <span class="badge rounded-pill {{ $application->status_badge }}">
                                                    {{ $application->status_text }}
                                                </span>
                                            </td>
                                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.career-applications.show', $application->id) }}" class="btn btn-sm btn-outline-info me-1">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <form action="{{ route('admin.career-applications.destroy', $application->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this application?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($applications->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $applications->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3"></i>
                            <p>No applications found at this time.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

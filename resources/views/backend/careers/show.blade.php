@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <div class="page-header">
            <div class="page-title">
                <h2><i class="fas fa-briefcase"></i> Career Opportunity Details</h2>
                <p class="breadcrumb">Dashboard / Career Opportunities / View</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.careers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-briefcase"></i> {{ $career->title }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="career-details">
                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-map-marker-alt"></i> Location:</label>
                                <span class="detail-value">{{ $career->location }}</span>
                            </div>

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-calendar"></i> Date:</label>
                                <span class="detail-value">{{ $career->formatted_date }}</span>
                            </div>

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-clock"></i> Time:</label>
                                <span class="detail-value">{{ $career->time }}</span>
                            </div>

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-users"></i> Spots Available:</label>
                                <span class="detail-value">{{ $career->spots_available }}</span>
                            </div>

                            @if($career->salary)
                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-money-bill-wave"></i> Salary:</label>
                                <span class="detail-value">{{ $career->salary }}</span>
                            </div>
                            @endif

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-toggle-on"></i> Status:</label>
                                <span class="detail-value">
                                    <span class="badge {{ $career->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $career->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </span>
                            </div>

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-align-left"></i> Description:</label>
                                <div class="detail-value">
                                    <p>{{ $career->description }}</p>
                                </div>
                            </div>

                            <div class="detail-group">
                                <label class="detail-label"><i class="fas fa-list-check"></i> Requirements:</label>
                                <div class="detail-value">
                                    <p>{{ $career->requirements }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        @if ($career->image && file_exists(public_path('uploads/careers/' . $career->image)))
                            <div class="career-image">
                                <label class="detail-label"><i class="fas fa-image"></i> Job Image:</label>
                                <div class="image-container">
                                    <img src="{{ asset('uploads/careers/' . $career->image) }}" 
                                         alt="{{ $career->title }}" 
                                         class="career-image-preview">
                                </div>
                            </div>
                        @else
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                                <p>No image uploaded</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="career-meta">
                    <div class="meta-item">
                        <label class="meta-label">Created:</label>
                        <span class="meta-value">{{ $career->created_at->format('M d, Y \a\t g:i A') }}</span>
                    </div>
                    <div class="meta-item">
                        <label class="meta-label">Last Updated:</label>
                        <span class="meta-value">{{ $career->updated_at->format('M d, Y \a\t g:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.career-details {
    margin-bottom: 30px;
}

.detail-group {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.detail-group:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

.detail-value {
    color: #6c757d;
    font-size: 16px;
}

.detail-value p {
    margin: 0;
    line-height: 1.6;
}

.career-image {
    margin-top: 20px;
}

.image-container {
    margin-top: 10px;
}

.career-image-preview {
    width: 100%;
    max-width: 300px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.no-image {
    text-align: center;
    padding: 40px 20px;
    background: #f8f9fa;
    border-radius: 8px;
    color: #6c757d;
}

.no-image i {
    font-size: 48px;
    margin-bottom: 10px;
    opacity: 0.5;
}

.career-meta {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 30px;
}

.meta-item {
    flex: 1;
}

.meta-label {
    font-weight: 600;
    color: #495057;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.meta-value {
    color: #6c757d;
    font-size: 14px;
}

.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.bg-success {
    background-color: #28a745;
    color: white;
}

.bg-secondary {
    background-color: #6c757d;
    color: white;
}
</style>
@endsection 
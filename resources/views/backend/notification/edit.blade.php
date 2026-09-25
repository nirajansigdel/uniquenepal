@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Notification</h4>
                </div>
                <div class="card-body">
                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Success --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.notifications.update', $notification->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Notification Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $notification->title) }}" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Notification Image</label>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*">
                            <div class="form-text">Leave empty to keep current image</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Current Image --}}
                        @if ($notification->image && file_exists(public_path('uploads/notifications/' . $notification->image)))
                            <div class="mb-3 text-center">
                                <label class="form-label">Current Image:</label>
                                <img src="{{ asset('uploads/notifications/' . $notification->image) }}" 
                                     alt="Current Image" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                            </div>
                        @endif

                        {{-- Status --}}
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" 
                                   {{ old('status', $notification->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active (On/Off)</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

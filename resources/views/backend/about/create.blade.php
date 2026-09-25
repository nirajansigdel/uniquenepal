@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}" class="back-button">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $page_title }}</li>
            </ol>
        </nav>

        <!-- Form -->
        <div class="form-container">
            <form method="POST" action="{{ route('admin.about-us.store') }}" enctype="multipart/form-data" id="crudForm">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        Add New About Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">
                                Title <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter title" 
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <input type="text" 
                                   name="subtitle" 
                                   class="form-control @error('subtitle') is-invalid @enderror" 
                                   placeholder="Enter subtitle" 
                                   value="{{ old('subtitle') }}">
                            @error('subtitle')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Image <span class="required">*</span>
                            </label>
                            <input type="file" 
                                   name="image" 
                                   class="form-control @error('image') is-invalid @enderror"
                                   onchange="previewImage(event, 'preview')"
                                   required>
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <img id="preview" class="image-preview" style="display: none;">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Description <span class="required">*</span>
                            </label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Enter description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Content <span class="required">*</span>
                            </label>
                            <textarea name="content" 
                                      id="summernote"
                                      class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Auto-Translate Section -->
                        <x-auto-translate-section-create 
                            :fields="['title', 'subtitle', 'description', 'content']"
                            routeName="admin.translations.translate"
                        />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Create
                        </button>
                        <a href="{{ url('admin') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview function
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById(previewId);
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Initialize Summernote editor
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    });
</script>
@endsection

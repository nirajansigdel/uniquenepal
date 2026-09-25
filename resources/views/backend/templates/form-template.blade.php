@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title ?? 'Form' }}</h1>
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
                <li class="breadcrumb-item active">{{ $page_title ?? 'Form' }}</li>
            </ol>
        </nav>

        <!-- Form -->
        <div class="form-container">
            <form method="POST" action="{{ $form_action }}" enctype="multipart/form-data" id="crudForm">
                @csrf
                @if(isset($item) && $item->id)
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        {{ isset($item) ? 'Edit Information' : 'Add New Information' }}
                    </div>
                    <div class="card-body">
                        @foreach($form_fields as $field)
                            <div class="form-group">
                                <label class="form-label">
                                    {{ $field['label'] }}
                                    @if($field['required'] ?? false)
                                        <span class="required">*</span>
                                    @endif
                                </label>

                                @if($field['type'] === 'text')
                                    <input type="text" 
                                           name="{{ $field['name'] }}" 
                                           class="form-control @error($field['name']) is-invalid @enderror"
                                           placeholder="{{ $field['placeholder'] ?? '' }}"
                                           value="{{ old($field['name'], $item->{$field['name']} ?? '') }}"
                                           @if($field['required'] ?? false) required @endif>
                                    @error($field['name'])
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                @elseif($field['type'] === 'textarea')
                                    <textarea name="{{ $field['name'] }}" 
                                              class="form-control @error($field['name']) is-invalid @enderror"
                                              rows="{{ $field['rows'] ?? 4 }}"
                                              placeholder="{{ $field['placeholder'] ?? '' }}"
                                              @if($field['required'] ?? false) required @endif>{{ old($field['name'], $item->{$field['name']} ?? '') }}</textarea>
                                    @error($field['name'])
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                @elseif($field['type'] === 'file')
                                    <input type="file" 
                                           name="{{ $field['name'] }}" 
                                           class="form-control @error($field['name']) is-invalid @enderror"
                                           @if($field['required'] ?? false) required @endif
                                           onchange="previewImage(event, '{{ $field['preview_id'] ?? 'preview' }}')">
                                    @error($field['name'])
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    
                                    @if(isset($item) && $item->{$field['name']})
                                        <img id="{{ $field['preview_id'] ?? 'preview' }}" 
                                             src="{{ asset($field['path'] . $item->{$field['name']}) }}" 
                                             class="image-preview">
                                    @else
                                        <img id="{{ $field['preview_id'] ?? 'preview' }}" 
                                             class="image-preview" style="display: none;">
                                    @endif

                                @elseif($field['type'] === 'select')
                                    <select name="{{ $field['name'] }}" 
                                            class="form-control @error($field['name']) is-invalid @enderror"
                                            @if($field['required'] ?? false) required @endif>
                                        <option value="">Select {{ $field['label'] }}</option>
                                        @foreach($field['options'] as $value => $label)
                                            <option value="{{ $value }}" 
                                                    {{ old($field['name'], $item->{$field['name']} ?? '') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error($field['name'])
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                @elseif($field['type'] === 'summernote')
                                    <textarea name="{{ $field['name'] }}" 
                                              id="{{ $field['name'] }}"
                                              class="form-control @error($field['name']) is-invalid @enderror">{{ old($field['name'], $item->{$field['name']} ?? '') }}</textarea>
                                    @error($field['name'])
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ isset($item) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ $cancel_url ?? url('admin') }}" class="btn btn-secondary">
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

    // Initialize Summernote editors
    $(document).ready(function() {
        $('textarea[id]').each(function() {
            if ($(this).hasClass('summernote') || $(this).attr('id').includes('content')) {
                $(this).summernote({
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true
                });
            }
        });
    });
</script>
@endsection 
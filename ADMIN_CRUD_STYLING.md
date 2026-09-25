# Admin CRUD Styling Guide

This document explains how to use the consistent styling system for all admin CRUD (Create, Read, Update, Delete) pages.

## Overview

We've created a unified CSS styling system that provides clean, consistent design across all admin pages. The styling includes:

- **Simple and clean design**
- **Responsive layout**
- **Consistent form styling**
- **Professional table design**
- **Unified button styles**
- **Proper error handling**

## CSS File

The main CSS file is located at: `public/adminassets/css/admin-crud.css`

This file contains all the styling classes used across admin pages.

## Key CSS Classes

### Container Classes
- `.admin-container` - Main wrapper for admin pages
- `.admin-content` - Content area with white background and shadow
- `.form-container` - Wrapper for forms with max-width

### Header Classes
- `.page-header` - Page title and action buttons container
- `.page-title` - Main page heading
- `.back-button` - Styled back button

### Alert Classes
- `.alert` - Base alert styling
- `.alert-success` - Success messages
- `.alert-danger` - Error messages
- `.alert-warning` - Warning messages

### Form Classes
- `.form-group` - Form field wrapper
- `.form-label` - Field labels
- `.form-control` - Input fields
- `.required` - Required field indicator (red asterisk)
- `.error-message` - Validation error messages

### Table Classes
- `.data-table` - Main table styling
- `.table-image` - Images in table cells
- `.action-buttons` - Container for action buttons

### Button Classes
- `.btn` - Base button styling
- `.btn-primary` - Primary actions
- `.btn-success` - Create/Save actions
- `.btn-warning` - Edit actions
- `.btn-danger` - Delete actions
- `.btn-sm` - Small buttons
- `.btn-lg` - Large buttons

### Card Classes
- `.card` - Card container
- `.card-header` - Card header
- `.card-body` - Card content
- `.card-footer` - Card footer

## Page Structure Template

### Index Page Structure
```blade
@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title }}</h1>
            <div class="action-buttons">
                <a href="{{ route('admin.your-module.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New
                </a>
                <a href="{{ url('admin') }}" class="back-button">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
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

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Column 1</th>
                        <th>Column 2</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->field1 }}</td>
                            <td>{{ $item->field2 }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.your-module.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.your-module.destroy', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
```

### Create/Edit Form Structure
```blade
@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title }}</h1>
            <a href="{{ route('admin.your-module.index') }}" class="back-button">
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
                <li class="breadcrumb-item"><a href="{{ route('admin.your-module.index') }}">Your Module</a></li>
                <li class="breadcrumb-item active">{{ $page_title }}</li>
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
                        <div class="form-group">
                            <label class="form-label">
                                Field Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="field_name" 
                                   class="form-control @error('field_name') is-invalid @enderror" 
                                   placeholder="Enter field value" 
                                   value="{{ old('field_name', $item->field_name ?? '') }}"
                                   required>
                            @error('field_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Add more form fields as needed -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> {{ isset($item) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('admin.your-module.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview function (if needed)
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById(previewId);
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Initialize Summernote editor (if needed)
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
```

## Form Field Types

### Text Input
```blade
<div class="form-group">
    <label class="form-label">
        Field Name <span class="required">*</span>
    </label>
    <input type="text" 
           name="field_name" 
           class="form-control @error('field_name') is-invalid @enderror" 
           placeholder="Enter value" 
           value="{{ old('field_name', $item->field_name ?? '') }}"
           required>
    @error('field_name')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>
```

### Textarea
```blade
<div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" 
              class="form-control @error('description') is-invalid @enderror"
              rows="4"
              placeholder="Enter description">{{ old('description', $item->description ?? '') }}</textarea>
    @error('description')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>
```

### File Upload with Image Preview
```blade
<div class="form-group">
    <label class="form-label">Image</label>
    <input type="file" 
           name="image" 
           class="form-control @error('image') is-invalid @enderror"
           onchange="previewImage(event, 'preview')"
           accept="image/*">
    @error('image')
        <div class="error-message">{{ $message }}</div>
    @enderror
    <img id="preview" class="image-preview" style="display: none;">
</div>
```

### Select Dropdown
```blade
<div class="form-group">
    <label class="form-label">Category</label>
    <select name="category" 
            class="form-control @error('category') is-invalid @enderror">
        <option value="">Select Category</option>
        <option value="option1" {{ old('category', $item->category ?? '') == 'option1' ? 'selected' : '' }}>Option 1</option>
        <option value="option2" {{ old('category', $item->category ?? '') == 'option2' ? 'selected' : '' }}>Option 2</option>
    </select>
    @error('category')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>
```

### Summernote Editor
```blade
<div class="form-group">
    <label class="form-label">Content</label>
    <textarea name="content" 
              id="summernote"
              class="form-control @error('content') is-invalid @enderror">{{ old('content', $item->content ?? '') }}</textarea>
    @error('content')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>
```

## Best Practices

1. **Always use the CSS classes** - Don't use inline styles
2. **Include error handling** - Always add `@error` directives for form validation
3. **Use proper form structure** - Include CSRF tokens and method overrides
4. **Add image preview** - For file uploads, include the preview function
5. **Use consistent button styling** - Green for create/save, yellow for edit, red for delete
6. **Include breadcrumbs** - Help users navigate
7. **Add confirmation dialogs** - For delete actions
8. **Use proper icons** - FontAwesome icons for better UX

## Responsive Design

The CSS includes responsive design for mobile devices:
- Tables become scrollable on small screens
- Buttons stack vertically on mobile
- Form fields remain readable
- Images scale appropriately

## Customization

To customize the styling:
1. Edit `public/adminassets/css/admin-crud.css`
2. Add new classes as needed
3. Maintain consistency across all pages
4. Test on different screen sizes

## Examples

See the updated About module pages for examples:
- `resources/views/backend/about/index.blade.php`
- `resources/views/backend/about/create.blade.php`
- `resources/views/backend/about/update.blade.php`

And the Products example:
- `resources/views/backend/products/index.blade.php`
- `resources/views/backend/products/create.blade.php` 
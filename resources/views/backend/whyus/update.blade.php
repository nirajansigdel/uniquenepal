@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Why Us</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.whyus.update', $whyus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Heading</label>
            <input type="text" name="heading" class="form-control" value="{{ old('heading', $whyus->heading) }}" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $whyus->subtitle) }}">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content', $whyus->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control mb-2">
            
            @if($whyus->image)
                <div>
                    <img src="{{ asset('uploads/whyus/' . $whyus->image) }}" alt="Current Image" width="100">
                </div>
            @endif
        </div>

        <!-- Auto-Translate Section -->
        <x-auto-translate-section 
            :model="$whyus" 
            :fields="['heading', 'subtitle', 'content']"
            routeName="admin.whyus.translate"
            :modelId="$whyus->id"
        />

        <button class="btn btn-success">Update</button>
        <a href="{{ route('backend.whyus.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

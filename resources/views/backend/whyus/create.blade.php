@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Add Why Us</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('backend.whyus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Heading</label>
            <input type="text" name="heading" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Auto-Translate Section -->
        <x-auto-translate-section-create 
            :fields="['heading', 'subtitle', 'content']"
            routeName="admin.translations.translate"
        />

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection

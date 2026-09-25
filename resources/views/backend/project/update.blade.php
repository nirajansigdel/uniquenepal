@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Edit Project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        

        <div class="form-group mb-3">
            <label for="heading">Heading</label>
            <input type="text" name="heading" class="form-control" value="{{ $project->heading }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="subtitle">Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ $project->subtitle }}">
        </div>

        <div class="form-group mb-3">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" rows="6" required>{{ $project->content }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Current Image:</label><br>
            @if ($project->image)
                <img src="{{ asset($project->image) }}" width="150"><br><br>
            @else
                <span>No image</span><br>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="image">Replace Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

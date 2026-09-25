@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Add New Project</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="heading">Heading</label>
            <input type="text" name="heading" id="heading" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="subtitle">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="6" class="form-control" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="image">Project Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection

@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h2>Create New Event</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Please fix the following errors:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('backend.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading') }}" required>
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle') }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Event Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection

@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h2>Edit Event</h2>

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

    <form action="{{ route('backend.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading', $event->heading) }}" required />
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $event->subtitle) }}" />
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $event->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Event Image</label><br />
            @if ($event->image)
                <img src="{{ asset('uploads/events/' . $event->image) }}" alt="Event Image" width="150" class="mb-2" /><br />
            @endif
            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
            <small class="text-muted">Upload new image if you want to replace the existing one.</small>
        </div>

        <button type="submit" class="btn btn-success">Update Event</button>
    </form>
</div>
@endsection 
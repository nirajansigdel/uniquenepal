@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h2>Events List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('backend.event.create') }}" class="btn btn-success mb-3">Create New Event</a>

    @if($events->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Heading</th>
                    <th>Subtitle</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->heading }}</td>
                    <td>{{ $event->subtitle }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($event->content, 50) }}</td>
                    <td>
                        @if($event->image)
                            <img src="{{ asset('uploads/events/' . $event->image) }}" alt="Image" width="80" />
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $event->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('backend.event.edit', $event->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('backend.event.destroy', $event->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $events->links() }}

    @else
        <p>No events found.</p>
    @endif
</div>
@endsection

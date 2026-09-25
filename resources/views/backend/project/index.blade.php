@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Projects List</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Heading</th>
                <th>Subtitle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        @if ($project->image)
                            <img src="{{ asset($project->image) }}" width="100">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>{{ $project->heading }}</td>
                    <td>{{ $project->subtitle }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this project?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection

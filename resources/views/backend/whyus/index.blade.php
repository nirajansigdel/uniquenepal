@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Why Us</h2>
        <a href="{{ route('backend.whyus.create') }}" class="btn btn-primary">Add New</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Heading</th>
                <th>Subtitle</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($whyus as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->heading }}</td>
                    <td>{{ $item->subtitle }}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('uploads/whyus/' . $item->image) }}" width="80" alt="Why Us Image">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('backend.whyus.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('backend.whyus.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $whyus->links() }}
    </div>
</div>
@endsection
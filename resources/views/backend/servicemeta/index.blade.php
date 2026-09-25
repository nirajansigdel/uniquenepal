@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Service Meta</h3>
        @if($items->total() == 0)
            <a href="{{ route('admin.servicemeta.create') }}" class="btn btn-primary">Add New</a>
        @endif
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('warning'))<div class="alert alert-warning">{{ session('warning') }}</div>@endif
    @if($items->count())
        <table class="table table-bordered"><thead><tr><th>ID</th><th>Title</th><th>Description</th><th>Actions</th></tr></thead><tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ \Illuminate\Support\Str::limit($item->description, 120) }}</td>
                <td>
                    <a href="{{ route('admin.servicemeta.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.servicemeta.destroy', $item->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button></form>
                </td>
            </tr>
        @endforeach
        </tbody></table>
        {{ $items->links() }}
    @else
        <p>No service meta found.</p>
    @endif
</div>
@endsection

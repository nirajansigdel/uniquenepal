@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Mission/Vision/Value List</h4>
                    <a href="{{ route('admin.missionvisionvalue.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($missionvisionvalues as $index => $item)
                                <tr>
                                    <td>{{ $missionvisionvalues->firstItem() + $index }}</td>
                                    <td>{{ $item->heading }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($item->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.missionvisionvalue.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.missionvisionvalue.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if($missionvisionvalues->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">No records found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $missionvisionvalues->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

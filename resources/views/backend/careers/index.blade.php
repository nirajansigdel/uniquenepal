@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Career Opportunities Management</span>
                    <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">Add New Career Opportunity</a>
                </div>

                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if ($careers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Spots</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careers as $index => $career)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><strong>{{ $career->title }}</strong></td>
                                            <td>{{ $career->location }}</td>
                                            <td>{{ $career->formatted_date }}</td>
                                            <td>{{ $career->spots_available }}</td>
                                            <td>{{ $career->salary ?: 'Not specified' }}</td>
                                            <td>
                                                <form action="{{ route('admin.careers.toggle-status', $career->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $career->status ? 'btn-success' : 'btn-secondary' }}">
                                                        {{ $career->status ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $career->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.careers.show', $career->id) }}" class="btn btn-info btn-sm">View</a>
                                                <form action="{{ route('admin.careers.destroy', $career->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this career opportunity?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($careers->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $careers->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center">
                            <p class="text-muted">No career opportunities found.</p>
                            <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">Create First Career Opportunity</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
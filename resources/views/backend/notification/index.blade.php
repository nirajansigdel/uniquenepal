@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Notifications Management</h4>
                        <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Notification
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($notifications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="25%">Title</th>
                                        <th width="15%">Image</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Created At</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $index => $notification)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $notification->title }}</strong>
                                            </td>
                                            <td>
                                                @if ($notification->image && file_exists(public_path('uploads/notifications/' . $notification->image)))
                                                    <a href="{{ asset('uploads/notifications/' . $notification->image) }}" target="_blank" title="View Full Image">
                                                        <img src="{{ asset('uploads/notifications/' . $notification->image) }}" 
                                                             alt="Notification Image" 
                                                             class="img-thumbnail" 
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    </a>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fas fa-image"></i> No image
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.notifications.toggle-status', $notification->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $notification->status ? 'btn-success' : 'btn-secondary' }}" 
                                                            title="{{ $notification->status ? 'Active - Click to deactivate' : 'Inactive - Click to activate' }}">
                                                        <i class="fas {{ $notification->status ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                        {{ $notification->status ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $notification->created_at->format('M d, Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.notifications.edit', $notification->id) }}" 
                                                       class="btn btn-sm btn-warning" 
                                                       title="Edit Notification">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger" 
                                                                title="Delete Notification">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($notifications->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-bell fa-3x text-muted"></i>
                            </div>
                            <h5 class="text-muted">No Notifications Found</h5>
                            <p class="text-muted">Start by creating your first notification.</p>
                            <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create First Notification
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.img-thumbnail {
    border: 2px solid #dee2e6;
    transition: transform 0.2s;
}

.img-thumbnail:hover {
    transform: scale(1.1);
    border-color: #007bff;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}
</style>
@endsection

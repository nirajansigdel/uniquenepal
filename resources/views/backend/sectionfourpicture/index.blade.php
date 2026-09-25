
@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Section Four Pictures</h1>
            <a href="{{ route('admin.sectionfourpicture.create') }}">
                <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sectionfourpictures as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->title ?? '-' }}</td>
                            <td>
                                <img src="{{ asset($item->image_path) }}" style="max-width:100px; max-height:100px;">
                            </td>
                            <td>
                                <a href="{{ route('admin.sectionfourpicture.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.sectionfourpicture.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No pictures found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

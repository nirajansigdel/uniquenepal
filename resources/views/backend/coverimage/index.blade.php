@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('admin.cover-images.create') }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button>
            </a>
            <a href="{{ url('admin') }}">
                <button class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = ($coverimages->currentPage() - 1) * $coverimages->perPage() + 1;
            @endphp

            @foreach ($coverimages as $coverimage)
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td>{{ $coverimage->title }}</td>
                    <td>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach ($coverimage->image as $img)
                                <img src="{{ asset('uploads/coverimage/' . $img) }}" alt="Cover Image"
                                     style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc; padding: 3px;">
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            <a href="{{ route('admin.cover-images.edit', $coverimage->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.cover-images.destroy', $coverimage->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $coverimages->links() }}
    </div>
@endsection

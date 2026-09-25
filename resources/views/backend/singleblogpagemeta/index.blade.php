@extends('backend.layouts.master')

@section('title', 'Single Blog Page Meta')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Single Blog Page Meta</h2>
            </div>
            @if(!$meta)
            <div class="col-auto">
                <a href="{{ route('admin.singleblogpagemeta.create') }}" class="btn btn-primary">Add New</a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="container-xl">
        @if ($meta)
        <div class="card">
            <div class="card-body">
                <h3>{{ $meta->title }}</h3>
                <p>{{ $meta->description }}</p>
                <a href="{{ route('admin.singleblogpagemeta.edit', $meta->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.singleblogpagemeta.destroy', $meta->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-info">No record found. <a href="{{ route('admin.singleblogpagemeta.create') }}">Create one</a></div>
        @endif
    </div>
</div>
@endsection

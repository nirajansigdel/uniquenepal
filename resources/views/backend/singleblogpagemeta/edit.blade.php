@extends('backend.layouts.master')

@section('title', 'Edit Single Blog Page Meta')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Edit Single Blog Page Meta</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
				<form action="{{ route('admin.singleblogpagemeta.update', $singleblogpagemeta) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $singleblogpagemeta->title) }}">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $singleblogpagemeta->description) }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.singleblogpagemeta.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

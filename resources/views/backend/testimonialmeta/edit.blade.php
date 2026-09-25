@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h3>Edit Testimonial Meta</h3>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('warning'))<div class="alert alert-warning">{{ session('warning') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <form action="{{ route('admin.testimonialmeta.update', $item->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required></div>
        <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4">{{ old('description', $item->description) }}</textarea></div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.testimonialmeta.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

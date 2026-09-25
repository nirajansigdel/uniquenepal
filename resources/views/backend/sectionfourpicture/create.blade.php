
@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Add Section Four Picture</h1>
            <a href="{{ route('admin.sectionfourpicture.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.sectionfourpicture.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Optional title">
            </div>

            <div class="form-group">
                <label>Image</label> <span class="text-danger">*</span>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" required>
            </div>

            <img id="preview" style="max-width: 400px; max-height: 400px; display:none;" />
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
        }
    </script>
@stop

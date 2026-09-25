
@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Section Two Picture</h1>
            <a href="{{ route('admin.sectiontwopicture.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.sectiontwopicture.update', $sectiontwopicture->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $sectiontwopicture->title) }}">
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label>Current Image:</label><br>
                @if ($sectiontwopicture->image_path)
                    <img src="{{ asset($sectiontwopicture->image_path) }}" alt="Current Image"
                         style="max-width: 400px; max-height:400px;">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <img id="preview" style="max-width: 400px; max-height: 400px; display:none;" />
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update</button>
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

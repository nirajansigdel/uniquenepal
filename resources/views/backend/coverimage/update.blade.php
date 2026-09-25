@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
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

    <!-- Content Header (Page header) -->
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('admin.cover-images.index') }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('admin.cover-images.update', $coverimage->id) }}"
                enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ old('title', $coverimage->title) }}">
                </div>

                <div class="form-group">
                    <label>Current Images</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        @if(is_array($coverimage->image))
                            @foreach($coverimage->image as $img)
                                <div style="position: relative;">
                                    <img src="{{ asset('uploads/coverimage/' . $img) }}" alt="Image"
                                        style="max-width: 150px; max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                                    <!-- You can add a delete button here if you implement deletion -->
                                </div>
                            @endforeach
                        @else
                            <img src="{{ asset('uploads/coverimage/' . $coverimage->image) }}" alt="Image"
                                style="max-width: 150px; max-height: 150px; border: 1px solid #ddd; padding: 5px;">
                        @endif
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="images">Upload New Images (You can select multiple)</label>
                    <input type="file" name="images[]" class="form-control" id="images" multiple accept="image/*"
                        onchange="previewImages(event)">
                </div>

                <div id="preview-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>

                <!-- Auto-Translate Section -->
                <x-auto-translate-section 
                    :model="$coverimage" 
                    :fields="['title']"
                    routeName="admin.cover-images.translate"
                    :modelId="$coverimage->id"
                />

                <div class="card-footer mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function validateForm() {
            const input = document.getElementById('images');
            for (let i = 0; i < input.files.length; i++) {
                const fileSizeInMB = input.files[i].size / (1024 * 1024); // MB
                if (fileSizeInMB > 2) {
                    alert(`Image "${input.files[i].name}" exceeds 2MB size limit.`);
                    return false; // prevent form submit
                }
            }
            return true;
        }

        const previewImages = (event) => {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Clear previous previews

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ddd';
                    img.style.padding = '5px';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        };
    </script>
@endsection

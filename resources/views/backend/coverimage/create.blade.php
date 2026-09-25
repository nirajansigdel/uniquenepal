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

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.cover-images.store') }}"
        enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title </label><span style="color:red; font-size:large"> *</span>
                <input  type="text" name="title" class="form-control" id="title"
                    value="{{ old('title') }}" placeholder="Title" required>
            </div>

            <div class="form-group">
                <label for="images">Images</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="images[]" class="form-control" id="images" multiple accept="image/*" onchange="previewImages(event)" required>
            </div>

            <!-- Preview container -->
            <div id="preview-container" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>

            <!-- Auto-Translate Section -->
            <x-auto-translate-section-create 
                :fields="['title']"
                routeName="admin.translations.translate"
            />
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
        function validateForm() {
            const input = document.getElementById('images');
            for(let i = 0; i < input.files.length; i++) {
                const fileSizeInMB = input.files[i].size / (1024 * 1024); // MB
                if(fileSizeInMB > 2) {
                    alert(`Image "${input.files[i].name}" exceeds 2MB size limit.`);
                    return false; // prevent form submit
                }
            }
            return true;
        }

        const previewImages = (event) => {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Clear existing previews

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
@stop

@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Edit Career Opportunity</div>

                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.careers.update', $career->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Job Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $career->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Job Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $career->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $career->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $career->date->format('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="text" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', $career->time) }}" required>
                            @error('time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="spots_available">Spots Available</label>
                            <input type="number" name="spots_available" id="spots_available" class="form-control @error('spots_available') is-invalid @enderror" value="{{ old('spots_available', $career->spots_available) }}" min="1" required>
                            @error('spots_available')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary (Optional)</label>
                            <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $career->salary) }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="requirements">Requirements</label>
                            <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="3" required>{{ old('requirements', $career->requirements) }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group pt-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control-file" onchange="previewImage(event)">
                            <div id="imagePreview"></div>
                        </div>

                        @if ($career->image && file_exists(public_path('uploads/careers/' . $career->image)))
                            <div class="form-group">
                                <label>Current Image:</label>
                                <img src="{{ asset('uploads/careers/' . $career->image) }}" 
                                     alt="Current Image" style="max-width: 200px; max-height: 200px;">
                            </div>
                        @endif

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" value="1" {{ old('status', $career->status) ? 'checked' : '' }}> Active
                            </label>
                        </div>

                        <!-- Auto-Translate Section -->
                        <x-auto-translate-section 
                            :model="$career" 
                            :fields="['title', 'description', 'requirements']"
                            routeName="admin.careers.translate"
                            :modelId="$career->id"
                        />

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('imagePreview');

        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                preview.appendChild(img);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
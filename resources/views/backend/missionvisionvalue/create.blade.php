@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Mission/Vision/Value</div>
                <div class="card-body">
                    <form action="{{ route('admin.missionvisionvalue.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading') }}" required>
                            @error('heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Auto-Translate Section -->
                        <x-auto-translate-section-create 
                            :fields="['heading', 'description']"
                            routeName="admin.translations.translate"
                        />

                        <button type="submit" class="btn btn-success">Create</button>
                        <a href="{{ route('admin.missionvisionvalue.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

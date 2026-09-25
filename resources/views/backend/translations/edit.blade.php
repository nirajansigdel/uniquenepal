@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Manage Translations - {{ ucfirst($modelType) }} #{{ $modelId }}</h1>
            <a href="{{ url('admin') }}" class="back-button">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Alert Messages -->
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

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                @php
                    $routeName = 'admin.' . $modelType . 's.index';
                    $routeExists = Route::has($routeName);
                @endphp
                @if($routeExists)
                    <li class="breadcrumb-item"><a href="{{ route($routeName) }}">{{ ucfirst($modelType) }}s</a></li>
                @endif
                <li class="breadcrumb-item active">Translations</li>
            </ol>
        </nav>

        <!-- Translation Form -->
        <div class="form-container">
            <form method="POST" action="{{ route('admin.translations.update', [$modelType, $modelId]) }}">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h5>Translate Content</h5>
                        <p class="text-muted mb-0">Add translations for different languages. The original content is shown as reference.</p>
                    </div>
                    <div class="card-body">
                        @foreach($translatableFields as $field)
                            <div class="translation-field-group mb-4">
                                <h6 class="field-label mb-3">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $field)) }}</strong>
                                    <small class="text-muted">(Original: {{ $model->getAttribute($field) ?? 'N/A' }})</small>
                                </h6>
                                
                                <div class="row">
                                    @foreach($availableLocales as $locale)
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="translations[{{ $field }}][{{ $locale }}]" class="form-label">
                                                    {{ config('app.available_locales')[$locale] ?? $locale }}
                                                    @if($locale === config('app.locale'))
                                                        <span class="badge badge-primary">Default</span>
                                                    @endif
                                                </label>
                                                @if(in_array($field, ['content', 'description', 'answer']))
                                                    <textarea 
                                                        name="translations[{{ $field }}][{{ $locale }}]" 
                                                        id="translations_{{ $field }}_{{ $locale }}"
                                                        class="form-control" 
                                                        rows="5"
                                                        placeholder="Enter {{ config('app.available_locales')[$locale] ?? $locale }} translation for {{ $field }}"
                                                    >{{ $translations[$locale][$field] ?? '' }}</textarea>
                                                @else
                                                    <input 
                                                        type="text" 
                                                        name="translations[{{ $field }}][{{ $locale }}]" 
                                                        id="translations_{{ $field }}_{{ $locale }}"
                                                        class="form-control" 
                                                        value="{{ $translations[$locale][$field] ?? '' }}"
                                                        placeholder="Enter {{ config('app.available_locales')[$locale] ?? $locale }} translation for {{ $field }}"
                                                    >
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Translations
                        </button>
                        @php
                            $routeName = 'admin.' . $modelType . 's.index';
                            $routeExists = Route::has($routeName);
                        @endphp
                        @if($routeExists)
                            <a href="{{ route($routeName) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        @else
                            <a href="{{ url('admin') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.translation-field-group {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 5px;
    border-left: 4px solid #007bff;
}

.field-label {
    color: #333;
    font-size: 1.1rem;
}

.field-label small {
    font-size: 0.85rem;
    font-weight: normal;
}

.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.badge-primary {
    background-color: #007bff;
    color: white;
}
</style>
@endsection


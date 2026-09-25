@extends('backend.layouts.master')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">{{ $page_title }}</h1>
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
                <li class="breadcrumb-item active">{{ $page_title }}</li>
            </ol>
        </nav>

        <!-- Form -->
        <div class="form-container">
            <form method="POST" action="{{ route('admin.about-us.update', $about->id) }}" enctype="multipart/form-data" id="crudForm">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        Edit About Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">
                                Title <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   placeholder="Enter title" 
                                   value="{{ old('title', $about->title) }}"
                                   required>
                            @error('title')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subtitle</label>
                            <input type="text" 
                                   name="subtitle" 
                                   class="form-control @error('subtitle') is-invalid @enderror" 
                                   placeholder="Enter subtitle" 
                                   value="{{ old('subtitle', $about->subtitle) }}">
                            @error('subtitle')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Image</label>
                            <input type="file" 
                                   name="image" 
                                   class="form-control @error('image') is-invalid @enderror"
                                   onchange="previewImage(event, 'preview')">
                            @error('image')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <img id="preview" 
                                 src="{{ asset('uploads/about/' . $about->image) }}" 
                                 class="image-preview">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Description <span class="required">*</span>
                            </label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Enter description">{{ old('description', $about->description) }}</textarea>
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Content <span class="required">*</span>
                            </label>
                            <textarea name="content" 
                                      id="summernote"
                                      class="form-control @error('content') is-invalid @enderror">{{ old('content', $about->content) }}</textarea>
                            @error('content')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Auto-Translate Section -->
                        <div class="form-group mt-4 p-3" style="background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 5px;">
                            <div class="d-flex align-items-center mb-3">
                                <input type="checkbox" 
                                       id="auto_translate" 
                                       name="auto_translate" 
                                       value="1"
                                       class="me-2"
                                       onchange="toggleTranslationPreview()">
                                <label for="auto_translate" class="form-label mb-0" style="font-weight: 600; color: #007bff;">
                                    <i class="fas fa-language"></i> Auto-Translate to Spanish
                                </label>
                            </div>
                            <small class="text-muted d-block mb-3">
                                When enabled, your English content will be automatically translated to Spanish when you save. 
                                You can review and edit the translations below before saving.
                            </small>

                            <!-- Translation Preview Section -->
                            <div id="translation_preview" style="display: none;">
                                <h6 class="mb-3" style="color: #28a745;">
                                    <i class="fas fa-check-circle"></i> Spanish Translations Preview
                                </h6>
                                
                                <div class="translation-item mb-3">
                                    <label class="form-label small text-muted">Title (Spanish)</label>
                                    <input type="text" 
                                           id="translated_title" 
                                           name="translations[title][es]"
                                           class="form-control form-control-sm" 
                                           placeholder="Spanish translation will appear here..."
                                           value="{{ $about->getTranslated('title', 'es') }}">
                                    <small class="text-info">
                                        <i class="fas fa-info-circle"></i> You can edit this translation before saving
                                    </small>
                                </div>

                                <div class="translation-item mb-3">
                                    <label class="form-label small text-muted">Subtitle (Spanish)</label>
                                    <input type="text" 
                                           id="translated_subtitle" 
                                           name="translations[subtitle][es]"
                                           class="form-control form-control-sm" 
                                           placeholder="Spanish translation will appear here..."
                                           value="{{ $about->getTranslated('subtitle', 'es') }}">
                                </div>

                                <div class="translation-item mb-3">
                                    <label class="form-label small text-muted">Description (Spanish)</label>
                                    <textarea id="translated_description" 
                                              name="translations[description][es]"
                                              class="form-control form-control-sm" 
                                              rows="3"
                                              placeholder="Spanish translation will appear here...">{{ $about->getTranslated('description', 'es') }}</textarea>
                                </div>

                                <div class="translation-item mb-3">
                                    <label class="form-label small text-muted">Content (Spanish)</label>
                                    <textarea id="translated_content" 
                                              name="translations[content][es]"
                                              class="form-control form-control-sm" 
                                              rows="5"
                                              placeholder="Spanish translation will appear here...">{{ $about->getTranslated('content', 'es') }}</textarea>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-lightbulb"></i> 
                                    <strong>Tip:</strong> Review the translations above. You can edit them if needed. 
                                    The translations will be saved automatically when you click "Update".
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ url('admin') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview function
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById(previewId);
            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Initialize Summernote editor
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        // Check if translations exist and show preview
        @if($about->getTranslated('title', 'es') || $about->getTranslated('description', 'es'))
            document.getElementById('auto_translate').checked = true;
            document.getElementById('translation_preview').style.display = 'block';
        @endif
    });

    // Toggle translation preview
    function toggleTranslationPreview() {
        const checkbox = document.getElementById('auto_translate');
        const preview = document.getElementById('translation_preview');
        
        if (checkbox.checked) {
            preview.style.display = 'block';
            // Auto-translate on the fly when checkbox is checked
            autoTranslateFields();
        } else {
            preview.style.display = 'none';
        }
    }

    // Auto-translate fields using AJAX
    function autoTranslateFields() {
        const title = document.querySelector('input[name="title"]').value;
        const subtitle = document.querySelector('input[name="subtitle"]').value;
        const description = document.querySelector('textarea[name="description"]').value;
        const content = document.querySelector('#summernote').value || $('#summernote').summernote('code');

        // Show loading state
        const preview = document.getElementById('translation_preview');
        preview.innerHTML = '<div class="text-center p-3"><i class="fas fa-spinner fa-spin"></i> Translating...</div>';

        // Make AJAX request to translate
        fetch('{{ route("admin.about-us.translate", $about->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                title: title,
                subtitle: subtitle,
                description: description,
                content: content
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Translation response:', data);
            
            if (data.success && data.translations) {
                // Update translation fields if they exist
                if (data.translations.title && document.getElementById('translated_title')) {
                    document.getElementById('translated_title').value = data.translations.title;
                }
                if (data.translations.subtitle && document.getElementById('translated_subtitle')) {
                    document.getElementById('translated_subtitle').value = data.translations.subtitle;
                }
                if (data.translations.description && document.getElementById('translated_description')) {
                    document.getElementById('translated_description').value = data.translations.description;
                }
                if (data.translations.content && document.getElementById('translated_content')) {
                    document.getElementById('translated_content').value = data.translations.content;
                }
                
                // Restore preview HTML
                preview.innerHTML = `
                    <h6 class="mb-3" style="color: #28a745;">
                        <i class="fas fa-check-circle"></i> Spanish Translations Preview
                    </h6>
                    
                    <div class="translation-item mb-3">
                        <label class="form-label small text-muted">Title (Spanish)</label>
                        <input type="text" 
                               id="translated_title" 
                               name="translations[title][es]"
                               class="form-control form-control-sm" 
                               placeholder="Spanish translation will appear here..."
                               value="${data.translations.title || ''}">
                        <small class="text-info">
                            <i class="fas fa-info-circle"></i> You can edit this translation before saving
                        </small>
                    </div>

                    <div class="translation-item mb-3">
                        <label class="form-label small text-muted">Subtitle (Spanish)</label>
                        <input type="text" 
                               id="translated_subtitle" 
                               name="translations[subtitle][es]"
                               class="form-control form-control-sm" 
                               placeholder="Spanish translation will appear here..."
                               value="${data.translations.subtitle || ''}">
                    </div>

                    <div class="translation-item mb-3">
                        <label class="form-label small text-muted">Description (Spanish)</label>
                        <textarea id="translated_description" 
                                  name="translations[description][es]"
                                  class="form-control form-control-sm" 
                                  rows="3"
                                  placeholder="Spanish translation will appear here...">${data.translations.description || ''}</textarea>
                    </div>

                    <div class="translation-item mb-3">
                        <label class="form-label small text-muted">Content (Spanish)</label>
                        <textarea id="translated_content" 
                                  name="translations[content][es]"
                                  class="form-control form-control-sm" 
                                  rows="5"
                                  placeholder="Spanish translation will appear here...">${data.translations.content || ''}</textarea>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i> 
                        <strong>Tip:</strong> Review the translations above. You can edit them if needed. 
                        The translations will be saved automatically when you click "Update".
                    </div>
                `;
            } else {
                preview.innerHTML = `<div class="alert alert-warning">${data.message || 'Translation failed. Please try again.'}</div>`;
            }
        })
        .catch(error => {
            console.error('Translation error:', error);
            preview.innerHTML = `
                <div class="alert alert-danger">
                    <strong>Translation Error:</strong> ${error.message || 'Unknown error occurred'}
                    <br><small>Check browser console for details. You can still manually enter translations below.</small>
                </div>
                <div class="translation-item mb-3">
                    <label class="form-label small text-muted">Title (Spanish)</label>
                    <input type="text" id="translated_title" name="translations[title][es]" class="form-control form-control-sm" placeholder="Enter Spanish translation manually...">
                </div>
                <div class="translation-item mb-3">
                    <label class="form-label small text-muted">Subtitle (Spanish)</label>
                    <input type="text" id="translated_subtitle" name="translations[subtitle][es]" class="form-control form-control-sm" placeholder="Enter Spanish translation manually...">
                </div>
                <div class="translation-item mb-3">
                    <label class="form-label small text-muted">Description (Spanish)</label>
                    <textarea id="translated_description" name="translations[description][es]" class="form-control form-control-sm" rows="3" placeholder="Enter Spanish translation manually..."></textarea>
                </div>
                <div class="translation-item mb-3">
                    <label class="form-label small text-muted">Content (Spanish)</label>
                    <textarea id="translated_content" name="translations[content][es]" class="form-control form-control-sm" rows="5" placeholder="Enter Spanish translation manually..."></textarea>
                </div>
            `;
        });
    }
</script>
@endsection

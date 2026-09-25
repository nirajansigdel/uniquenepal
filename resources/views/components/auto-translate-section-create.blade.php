@props(['fields', 'routeName', 'modelId' => 'new'])

<!-- Auto-Translate Section -->
<div class="form-group mt-4 p-3" style="background-color: #f8f9fa; border-left: 4px solid #007bff; border-radius: 5px;">
    <div class="d-flex align-items-center mb-3">
        <input type="checkbox" 
               id="auto_translate_create" 
               name="auto_translate" 
               value="1"
               class="me-2"
               onchange="toggleTranslationPreviewCreate()">
        <label for="auto_translate_create" class="form-label mb-0" style="font-weight: 600; color: #007bff;">
            <i class="fas fa-language"></i> Auto-Translate to Spanish
        </label>
    </div>
    <small class="text-muted d-block mb-3">
        When enabled, your English content will be automatically translated to Spanish when you save. 
        You can review and edit the translations below before saving.
    </small>

    <!-- Translation Preview Section -->
    <div id="translation_preview_create" style="display: none;">
        <h6 class="mb-3" style="color: #28a745;">
            <i class="fas fa-check-circle"></i> Spanish Translations Preview
        </h6>
        
        @foreach($fields as $field)
            <div class="translation-item mb-3">
                <label class="form-label small text-muted">{{ ucfirst(str_replace('_', ' ', $field)) }} (Spanish)</label>
                @if(in_array($field, ['content', 'description', 'answer', 'bio', 'requirements']))
                    <textarea 
                        id="translated_{{ $field }}_create" 
                        name="translations[{{ $field }}][es]"
                        class="form-control form-control-sm" 
                        rows="5"
                        placeholder="Spanish translation will appear here..."></textarea>
                @else
                    <input 
                        type="text" 
                        id="translated_{{ $field }}_create" 
                        name="translations[{{ $field }}][es]"
                        class="form-control form-control-sm" 
                        placeholder="Spanish translation will appear here...">
                @endif
                @if($loop->first)
                    <small class="text-info">
                        <i class="fas fa-info-circle"></i> You can edit this translation before saving
                    </small>
                @endif
            </div>
        @endforeach

        <div class="alert alert-info">
            <i class="fas fa-lightbulb"></i> 
            <strong>Tip:</strong> Review the translations above. You can edit them if needed. 
            The translations will be saved automatically when you click "Create".
        </div>
    </div>
</div>

<script>
    // Toggle translation preview
    function toggleTranslationPreviewCreate() {
        const checkbox = document.getElementById('auto_translate_create');
        const preview = document.getElementById('translation_preview_create');
        
        if (checkbox.checked) {
            preview.style.display = 'block';
            autoTranslateFieldsCreate();
        } else {
            preview.style.display = 'none';
        }
    }

    // Auto-translate fields using AJAX (for create - we'll use a dummy ID)
    function autoTranslateFieldsCreate() {
        const preview = document.getElementById('translation_preview_create');
        preview.innerHTML = '<div class="text-center p-3"><i class="fas fa-spinner fa-spin"></i> Translating...</div>';

        // Collect field values
        const fieldData = {};
        @foreach($fields as $field)
            @if($field === 'includes')
                // Handle includes array field
                const includesInputs = document.querySelectorAll('input[name="includes[]"]');
                const includesArray = [];
                includesInputs.forEach(input => {
                    if (input.value && input.value.trim()) {
                        includesArray.push(input.value.trim());
                    }
                });
                fieldData['{{ $field }}'] = includesArray;
            @elseif(in_array($field, ['content', 'description', 'answer', 'bio', 'requirements']))
                // Try Summernote first, then regular textarea
                if (typeof $ !== 'undefined' && $('#summernote').length && $('#summernote').summernote('code')) {
                    fieldData['{{ $field }}'] = $('#summernote').summernote('code') || '';
                } else if (typeof $ !== 'undefined' && $('#description').length && $('#description').summernote('code')) {
                    fieldData['{{ $field }}'] = $('#description').summernote('code') || '';
                } else {
                    fieldData['{{ $field }}'] = document.querySelector('textarea[name="{{ $field }}"]')?.value || 
                                                document.querySelector('#descriptionInput')?.value || '';
                }
            @else
                fieldData['{{ $field }}'] = document.querySelector('input[name="{{ $field }}"]')?.value || 
                                            document.querySelector('textarea[name="{{ $field }}"]')?.value || '';
            @endif
        @endforeach

        // Use generic translation endpoint for create pages
        fetch('{{ route("admin.translations.translate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(fieldData)
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
                // Build the preview HTML with translations
                let previewHtml = `
                    <h6 class="mb-3" style="color: #28a745;">
                        <i class="fas fa-check-circle"></i> Spanish Translations Preview
                    </h6>
                `;
                
                @foreach($fields as $field)
                    @if($field === 'includes')
                        const translatedIncludes = data.translations['{{ $field }}'] || [];
                        if (Array.isArray(translatedIncludes) && translatedIncludes.length > 0) {
                            previewHtml += `
                                <div class="translation-item mb-3">
                                    <label class="form-label small text-muted">{{ ucfirst(str_replace('_', ' ', $field)) }} (Spanish)</label>
                                    <ul class="list-unstyled">`;
                            translatedIncludes.forEach((item, index) => {
                                previewHtml += `
                                    <li class="mb-2">
                                        <input 
                                            type="text" 
                                            name="translations[{{ $field }}][es][]"
                                            class="form-control form-control-sm" 
                                            placeholder="Translated item ${index + 1}"
                                            value="${item}"
                                        >
                                    </li>`;
                            });
                            previewHtml += `</ul></div>`;
                        }
                    @else
                        previewHtml += `
                            <div class="translation-item mb-3">
                                <label class="form-label small text-muted">{{ ucfirst(str_replace('_', ' ', $field)) }} (Spanish)</label>
                                @if(in_array($field, ['content', 'description', 'answer', 'bio', 'requirements']))
                                    <textarea 
                                        id="translated_{{ $field }}_create" 
                                        name="translations[{{ $field }}][es]"
                                        class="form-control form-control-sm" 
                                        rows="5"
                                        placeholder="Spanish translation will appear here...">${data.translations['{{ $field }}'] || ''}</textarea>
                                @else
                                    <input 
                                        type="text" 
                                        id="translated_{{ $field }}_create" 
                                        name="translations[{{ $field }}][es]"
                                        class="form-control form-control-sm" 
                                        placeholder="Spanish translation will appear here..."
                                        value="${data.translations['{{ $field }}'] || ''}">
                                @endif
                                @if($loop->first)
                                    <small class="text-info">
                                        <i class="fas fa-info-circle"></i> You can edit this translation before saving
                                    </small>
                                @endif
                            </div>
                        `;
                    @endif
                @endforeach
                
                previewHtml += `
                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb"></i> 
                        <strong>Tip:</strong> Review the translations above. You can edit them if needed. 
                        The translations will be saved automatically when you click "Create".
                    </div>
                `;
                
                preview.innerHTML = previewHtml;
            } else {
                preview.innerHTML = `<div class="alert alert-warning">${data.message || 'Translation failed. Please try again.'}</div>`;
            }
        })
        .catch(error => {
            console.error('Translation error:', error);
            // Fallback: show manual input fields
            preview.innerHTML = `
                <div class="alert alert-warning">
                    <strong>Note:</strong> Auto-translation is not available during creation. 
                    You can manually enter Spanish translations below or translate after creating the item.
                </div>
                @foreach($fields as $field)
                    <div class="translation-item mb-3">
                        <label class="form-label small text-muted">{{ ucfirst(str_replace('_', ' ', $field)) }} (Spanish)</label>
                        @if(in_array($field, ['content', 'description', 'answer', 'bio', 'requirements']))
                            <textarea id="translated_{{ $field }}_create" name="translations[{{ $field }}][es]" class="form-control form-control-sm" rows="5" placeholder="Enter Spanish translation manually..."></textarea>
                        @else
                            <input type="text" id="translated_{{ $field }}_create" name="translations[{{ $field }}][es]" class="form-control form-control-sm" placeholder="Enter Spanish translation manually...">
                        @endif
                    </div>
                @endforeach
            `;
        });
    }

</script>


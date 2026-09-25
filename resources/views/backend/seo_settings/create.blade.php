@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>Create SEO Setting</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the errors below:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.seo_settings.store') }}" method="POST">
        @csrf

        {{-- Meta Title --}}
        <div class="form-group mb-3">
            <label>Meta Title</label>
            <div id="meta_title_wrapper">
                <div class="input-group mb-2">
                    <input type="text" name="meta_title[]" class="form-control" placeholder="Meta Title">
                    <button type="button" class="btn btn-success btn-add-meta-title">+</button>
                </div>
            </div>
        </div>

        {{-- Meta Description --}}
        <div class="form-group mb-3">
            <label>Meta Description</label>
            <div id="meta_description_wrapper">
                <div class="input-group mb-2">
                    <input type="text" name="meta_description[]" class="form-control" placeholder="Meta Description">
                    <button type="button" class="btn btn-success btn-add-meta-description">+</button>
                </div>
            </div>
        </div>

        {{-- Meta Keywords --}}
        <div class="form-group mb-3">
            <label>Meta Keywords</label>
            <div id="meta_keywords_wrapper">
                <div class="input-group mb-2">
                    <input type="text" name="meta_keywords[]" class="form-control" placeholder="Meta Keywords">
                    <button type="button" class="btn btn-success btn-add-meta-keywords">+</button>
                </div>
            </div>
        </div>

        {{-- Canonical URL --}}
        <div class="form-group mb-3">
            <label>Canonical URL</label>
            <div id="canonical_url_wrapper">
                <div class="input-group mb-2">
                    <input type="url" name="canonical_url[]" class="form-control" placeholder="Canonical URL">
                    <button type="button" class="btn btn-success btn-add-canonical-url">+</button>
                </div>
            </div>
        </div>

        {{-- Schema JSON --}}
        <div class="form-group mb-3">
            <label>Schema JSON</label>
            <div id="schema_json_wrapper">
                <div class="input-group mb-2">
                    <textarea name="schema_json[]" class="form-control" rows="3" placeholder="Schema JSON"></textarea>
                    <button type="button" class="btn btn-success btn-add-schema-json">+</button>
                </div>
            </div>
        </div>

        {{-- Heading H1 --}}
        <div class="form-group mb-3">
            <label>Heading H1</label>
            <div id="heading_h1_wrapper">
                <div class="input-group mb-2">
                    <input type="text" name="heading_h1[]" class="form-control" placeholder="Heading H1">
                    <button type="button" class="btn btn-success btn-add-heading-h1">+</button>
                </div>
            </div>
        </div>

        {{-- Image Description --}}
        <div class="form-group mb-3">
            <label>Image Description</label>
            <div id="image_description_wrapper">
                <div class="input-group mb-2">
                    <textarea name="image_description[]" class="form-control" rows="3" placeholder="Image Description"></textarea>
                    <button type="button" class="btn btn-success btn-add-image-description">+</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create SEO Setting</button>
        <a href="{{ route('backend.seo_settings.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

{{-- Scripts --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    function dynamicInput(wrapperId, addBtnClass, isTextarea = false) {
        const wrapper = document.getElementById(wrapperId);

        wrapper.addEventListener('click', function(e) {
            if(e.target.classList.contains(addBtnClass)) {
                e.preventDefault();

                const newInputGroup = document.createElement('div');
                newInputGroup.classList.add('input-group', 'mb-2');

                let inputHtml = '';
                if (isTextarea) {
                    inputHtml = `<textarea name="${wrapperId.replace('_wrapper', '')}[]" class="form-control" rows="3" placeholder="${wrapperId.replace('_wrapper', '').replace(/_/g,' ').toUpperCase()}"></textarea>`;
                } else if(wrapperId === 'canonical_url_wrapper') {
                    inputHtml = `<input type="url" name="${wrapperId.replace('_wrapper', '')}[]" class="form-control" placeholder="Canonical URL">`;
                } else {
                    inputHtml = `<input type="text" name="${wrapperId.replace('_wrapper', '')}[]" class="form-control" placeholder="${wrapperId.replace('_wrapper', '').replace(/_/g,' ').toUpperCase()}">`;
                }

                newInputGroup.innerHTML = `
                    ${inputHtml}
                    <button type="button" class="btn btn-danger btn-remove">-</button>
                `;

                wrapper.appendChild(newInputGroup);
            }

            if(e.target.classList.contains('btn-remove')) {
                e.preventDefault();
                e.target.parentElement.remove();
            }
        });
    }

    dynamicInput('meta_title_wrapper', 'btn-add-meta-title');
    dynamicInput('meta_description_wrapper', 'btn-add-meta-description');
    dynamicInput('meta_keywords_wrapper', 'btn-add-meta-keywords');
    dynamicInput('canonical_url_wrapper', 'btn-add-canonical-url');
    dynamicInput('schema_json_wrapper', 'btn-add-schema-json', true);
    dynamicInput('heading_h1_wrapper', 'btn-add-heading-h1');
    dynamicInput('image_description_wrapper', 'btn-add-image-description', true);
});
</script>
@endsection

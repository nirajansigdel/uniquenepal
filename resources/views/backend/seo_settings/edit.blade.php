@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>Edit SEO Setting</h1>

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

    <form action="{{ route('backend.seo_settings.update', $seoSetting->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Helper to output multiple inputs --}}
        @php
            function renderInputs($values, $name, $isTextarea = false) {
                $values = is_array($values) ? $values : [];
                if (count($values) === 0) {
                    $values = [''];
                }
                foreach($values as $idx => $val) {
                    echo '<div class="input-group mb-2">';
                    if ($isTextarea) {
                        echo '<textarea name="'.$name.'[]" class="form-control" rows="3" placeholder="'.ucwords(str_replace('_', ' ', $name)).'">'.e($val).'</textarea>';
                    } else if ($name === 'canonical_url') {
                        echo '<input type="url" name="'.$name.'[]" class="form-control" placeholder="Canonical URL" value="'.e($val).'">';
                    } else {
                        echo '<input type="text" name="'.$name.'[]" class="form-control" placeholder="'.ucwords(str_replace('_', ' ', $name)).'" value="'.e($val).'">';
                    }
                    echo $idx === 0 
                        ? '<button type="button" class="btn btn-success btn-add-'.$name.'">+</button>' 
                        : '<button type="button" class="btn btn-danger btn-remove">-</button>';
                    echo '</div>';
                }
            }
        @endphp

        {{-- Meta Title --}}
        <div class="form-group mb-3">
            <label>Meta Title</label>
            <div id="meta_title_wrapper">
                {!! renderInputs(old('meta_title', json_decode($seoSetting->meta_title ?? '[]', true)), 'meta_title') !!}
            </div>
        </div>

        {{-- Meta Description --}}
        <div class="form-group mb-3">
            <label>Meta Description</label>
            <div id="meta_description_wrapper">
                {!! renderInputs(old('meta_description', json_decode($seoSetting->meta_description ?? '[]', true)), 'meta_description') !!}
            </div>
        </div>

        {{-- Meta Keywords --}}
        <div class="form-group mb-3">
            <label>Meta Keywords</label>
            <div id="meta_keywords_wrapper">
                {!! renderInputs(old('meta_keywords', json_decode($seoSetting->meta_keywords ?? '[]', true)), 'meta_keywords') !!}
            </div>
        </div>

        {{-- Canonical URL --}}
        <div class="form-group mb-3">
            <label>Canonical URL</label>
            <div id="canonical_url_wrapper">
                {!! renderInputs(old('canonical_url', json_decode($seoSetting->canonical_url ?? '[]', true)), 'canonical_url') !!}
            </div>
        </div>

        {{-- Schema JSON --}}
        <div class="form-group mb-3">
            <label>Schema JSON</label>
            <div id="schema_json_wrapper">
                {!! renderInputs(old('schema_json', json_decode($seoSetting->schema_json ?? '[]', true)), 'schema_json', true) !!}
            </div>
        </div>

        {{-- Heading H1 --}}
        <div class="form-group mb-3">
            <label>Heading H1</label>
            <div id="heading_h1_wrapper">
                {!! renderInputs(old('heading_h1', json_decode($seoSetting->heading_h1 ?? '[]', true)), 'heading_h1') !!}
            </div>
        </div>

        {{-- Image Description --}}
        <div class="form-group mb-3">
            <label>Image Description</label>
            <div id="image_description_wrapper">
                {!! renderInputs(old('image_description', json_decode($seoSetting->image_description ?? '[]', true)), 'image_description', true) !!}
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update SEO Setting</button>
        <a href="{{ route('backend.seo_settings.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

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

    dynamicInput('meta_title_wrapper', 'btn-add-meta_title');
    dynamicInput('meta_description_wrapper', 'btn-add-meta_description');
    dynamicInput('meta_keywords_wrapper', 'btn-add-meta_keywords');
    dynamicInput('canonical_url_wrapper', 'btn-add-canonical_url');
    dynamicInput('schema_json_wrapper', 'btn-add-schema_json', true);
    dynamicInput('heading_h1_wrapper', 'btn-add-heading_h1');
    dynamicInput('image_description_wrapper', 'btn-add-image_description', true);
});
</script>
@endsection

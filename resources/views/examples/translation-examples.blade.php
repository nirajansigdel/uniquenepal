{{-- 
    TRANSLATION EXAMPLES FOR LARAVEL BILINGUAL SYSTEM
    
    This file demonstrates various ways to use translations in Laravel
--}}

@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <h1>{{ __('Translation Examples') }}</h1>
    
    {{-- Method 1: Using __() helper function --}}
    <section class="mb-5">
        <h2>{{ __('Method 1: Using __() helper') }}</h2>
        <p>{{ __('Welcome to our website') }}</p>
        <p>{{ __('Get started') }}</p>
        <p>{{ __('Learn more') }}</p>
    </section>

    {{-- Method 2: Using @lang directive --}}
    <section class="mb-5">
        <h2>{{ __('Method 2: Using @lang directive') }}</h2>
        <p>@lang('Welcome to our website')</p>
        <p>@lang('Get started')</p>
        <p>@lang('Learn more')</p>
    </section>

    {{-- Method 3: Using translation keys with dots --}}
    <section class="mb-5">
        <h2>{{ __('Method 3: Using translation keys with dots') }}</h2>
        <p>{{ __('menu.home') }}</p>
        <p>{{ __('menu.about') }}</p>
        <p>{{ __('menu.contact') }}</p>
        <p>{{ __('forms.submit') }}</p>
        <p>{{ __('forms.cancel') }}</p>
    </section>

    {{-- Method 4: Using translation with parameters --}}
    <section class="mb-5">
        <h2>{{ __('Method 4: Using translation with parameters') }}</h2>
        <p>{{ __('Hello :name, welcome to our website!', ['name' => 'John']) }}</p>
        <p>{{ __('You have :count messages', ['count' => 5]) }}</p>
    </section>

    {{-- Method 5: Using JSON translations --}}
    <section class="mb-5">
        <h2>{{ __('Method 5: Using JSON translations') }}</h2>
        <p>{{ __('Welcome to our website') }}</p>
        <p>{{ __('Get started') }}</p>
        <p>{{ __('Contact us') }}</p>
    </section>

    {{-- Method 6: Using conditional translations --}}
    <section class="mb-5">
        <h2>{{ __('Method 6: Using conditional translations') }}</h2>
        @if(app()->getLocale() === 'en')
            <p>{{ __('Welcome to our English website') }}</p>
        @else
            <p>{{ __('Bienvenido a nuestro sitio web en español') }}</p>
        @endif
    </section>

    {{-- Method 7: Using translation in forms --}}
    <section class="mb-5">
        <h2>{{ __('Method 7: Using translation in forms') }}</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('forms.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ __('forms.name') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('forms.email') }}</label>
                <input type="email" class="form-control" id="email" placeholder="{{ __('forms.email') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('forms.submit') }}</button>
            <button type="button" class="btn btn-secondary">{{ __('forms.cancel') }}</button>
        </form>
    </section>

    {{-- Method 8: Using translation in navigation --}}
    <section class="mb-5">
        <h2>{{ __('Method 8: Using translation in navigation') }}</h2>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ __('menu.home') }}</a>
                <div class="navbar-nav">
                    <a class="nav-link" href="#">{{ __('menu.about') }}</a>
                    <a class="nav-link" href="#">{{ __('menu.services') }}</a>
                    <a class="nav-link" href="#">{{ __('menu.contact') }}</a>
                </div>
            </div>
        </nav>
    </section>

    {{-- Method 9: Using translation with pluralization --}}
    <section class="mb-5">
        <h2>{{ __('Method 9: Using translation with pluralization') }}</h2>
        <p>{{ trans_choice('You have :count message|You have :count messages', 1, ['count' => 1]) }}</p>
        <p>{{ trans_choice('You have :count message|You have :count messages', 5, ['count' => 5]) }}</p>
    </section>

    {{-- Method 10: Using translation in JavaScript --}}
    <section class="mb-5">
        <h2>{{ __('Method 10: Using translation in JavaScript') }}</h2>
        <button onclick="showAlert()" class="btn btn-info">{{ __('Show Alert') }}</button>
    </section>

    {{-- Current language display --}}
    <section class="mb-5">
        <h2>{{ __('Current Language Information') }}</h2>
        <p><strong>{{ __('Current Language') }}:</strong> {{ app()->getLocale() }}</p>
        <p><strong>{{ __('Available Languages') }}:</strong> {{ implode(', ', array_keys(config('app.available_locales'))) }}</p>
    </section>
</div>

<script>
function showAlert() {
    // Using Laravel's translation in JavaScript
    alert('{{ __("This is a translated alert message!") }}');
}
</script>
@endsection

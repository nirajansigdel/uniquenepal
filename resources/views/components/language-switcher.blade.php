@props(['class' => '', 'showFlags' => true, 'showText' => true])

@php
    $currentLocale = app()->getLocale();
    $availableLocales = config('app.available_locales');
@endphp

<div class="language-switcher {{ $class }}">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if($showFlags)
                @if($currentLocale === 'en')
                    🇺🇸
                @elseif($currentLocale === 'es')
                    🇪🇸
                @endif
            @endif
            @if($showText)
                {{ $availableLocales[$currentLocale] ?? strtoupper($currentLocale) }}
            @endif
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            @foreach($availableLocales as $locale => $name)
                <li>
                    <a class="dropdown-item {{ $currentLocale === $locale ? 'active' : '' }}" 
                       href="{{ route('language.switch', $locale) }}">
                        @if($showFlags)
                            @if($locale === 'en')
                                🇺🇸
                            @elseif($locale === 'es')
                                🇪🇸
                            @endif
                        @endif
                        {{ $name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<style>
.language-switcher .dropdown-item.active {
    background-color: #0d6efd;
    color: white;
}

.language-switcher .dropdown-item:hover {
    background-color: #f8f9fa;
}

.language-switcher .dropdown-item.active:hover {
    background-color: #0b5ed7;
}
</style>

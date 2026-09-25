@php
    $currentLocale = app()->getLocale();
    $availableLocales = config('app.available_locales');
@endphp

<div class="simple-language-switcher">
    @foreach($availableLocales as $locale => $name)
        <a href="{{ route('language.switch', $locale) }}" 
           class="language-link {{ $currentLocale === $locale ? 'active' : '' }}"
           title="{{ __('Change language') }}">
            @if($locale === 'en')
                🇺🇸 EN
            @elseif($locale === 'es')
                🇪🇸 ES
            @else
                {{ strtoupper($locale) }}
            @endif
        </a>
        @if(!$loop->last)
            <span class="separator">|</span>
        @endif
    @endforeach
</div>

<style>
.simple-language-switcher {
    display: inline-block;
    font-size: 14px;
}

.simple-language-switcher .language-link {
    text-decoration: none;
    color: #6c757d;
    padding: 2px 6px;
    border-radius: 3px;
    transition: all 0.2s ease;
}

.simple-language-switcher .language-link:hover {
    color: #495057;
    background-color: #f8f9fa;
}

.simple-language-switcher .language-link.active {
    color: #0d6efd;
    font-weight: bold;
    background-color: #e7f3ff;
}

.simple-language-switcher .separator {
    color: #dee2e6;
    margin: 0 4px;
}
</style>

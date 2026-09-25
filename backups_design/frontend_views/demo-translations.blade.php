@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">{{ __('Translation Demo') }}</h1>
            
            <!-- Current Language Display -->
            <div class="alert alert-info">
                <h4>{{ __('Current Language') }}: {{ app()->getLocale() }}</h4>
                <p>{{ __('Available Languages') }}: {{ implode(', ', array_keys(config('app.available_locales'))) }}</p>
            </div>
            
            <!-- Hero Section Demo -->
            <section class="mb-5">
                <h2>{{ __('Hero Section') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <h1 class="display-4">{{ __('hero_title_outline') }}</h1>
                        <h1 class="display-4">{{ __('hero_title_solid') }}</h1>
                        <p class="lead">{{ __('hero_description') }}</p>
                        <button class="btn btn-primary">{{ __('discover_now') }}</button>
                    </div>
                </div>
            </section>
            
            <!-- Banner Section Demo -->
            <section class="mb-5">
                <h2>{{ __('Banner Section') }}</h2>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ __('map_location') }}</h5>
                                <p>{{ __('map_location_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ __('traveling_bag') }}</h5>
                                <p>{{ __('traveling_bag_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ __('photography') }}</h5>
                                <p>{{ __('photography_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>{{ __('affordable_prices') }}</h5>
                                <p>{{ __('affordable_prices_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Why Us Section Demo -->
            <section class="mb-5">
                <h2>{{ __('Why Us Section') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('why_choose_us') }}</h3>
                        <h4>{{ __('beauty_of_world') }}</h4>
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h5>{{ __('tour_and_travel') }}</h5>
                                <p>{{ __('tour_and_travel_desc') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>{{ __('campus') }}</h5>
                                <p>{{ __('campus_desc') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>{{ __('adventure_tour') }}</h5>
                                <p>{{ __('adventure_tour_desc') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>{{ __('photography') }}</h5>
                                <p>{{ __('photography_desc_why') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Contact Section Demo -->
            <section class="mb-5">
                <h2>{{ __('Contact Section') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <h3>{{ __('start_planning') }} <span class="text-warning">{{ __('get_discount') }}</span></h3>
                        <p>{{ __('contact_description') }}</p>
                        <button class="btn btn-primary">{{ __('book_now') }}</button>
                    </div>
                </div>
            </section>
            
            <!-- Language Switcher Demo -->
            <section class="mb-5">
                <h2>{{ __('Language Switcher') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <p>{{ __('Switch between languages to see the content change dynamically:') }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('language.switch', 'en') }}" class="btn btn-outline-primary">🇺🇸 English</a>
                            <a href="{{ route('language.switch', 'es') }}" class="btn btn-outline-primary">🇪🇸 Español</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

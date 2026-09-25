@extends('frontend.layouts.master')

@php
    $productPageTitle = ($product->getTranslated('heading') ?? $product->heading) . ($singleproductpagemeta?->title ?? ' | Unique Nepal');
    $ogTitle = $product->getTranslated('heading') ?? ($product->heading ?? config('app.name'));
    $rawDesc = $product->getTranslated('content') ?? $singleproductpagemeta?->description ?? '';
    $ogDesc = \Illuminate\Support\Str::limit(strip_tags($rawDesc), 160);
    $ogImage = (is_array($product->images) && count($product->images))
        ? asset('uploads/products/' . $product->images[0])
        : asset('image/service.jpg');
    $ogUrl = request()->fullUrl();
@endphp

@section('title', $productPageTitle)

@section('meta')
    <meta name="description" content="{{ $singleproductpagemeta?->description ?? $ogDesc }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ $ogUrl }}">
    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endsection

@section('content')
    @php
        /**
         * Real, non-fabricated day-by-day itinerary support.
         *
         * The `products` table has no dedicated itinerary/difficulty/altitude/
         * season/accommodation columns — but several products' long-form
         * `content` field was authored with "Day 1:", "Day 2:" ... headings
         * (h2/h3) followed by a paragraph that already contains inline
         * Accommodation/Meals/Trek details. Where that pattern exists we
         * parse it into a real, structured itinerary. Where it doesn't, we
         * fall back to showing the full description with a read-more toggle
         * and simply omit the itinerary section — nothing here is invented.
         */
        function uniqueExtractItinerary(?string $html): ?array
        {
            if (!$html || !preg_match('/Day\s*1\s*:/i', $html)) {
                return null;
            }

            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            // DOMDocument's HTML parser assumes Latin-1 unless told otherwise,
            // which mangles multi-byte UTF-8 (curly quotes, accents, etc.).
            $xmlEncodingDecl = '<' . '?xml encoding="UTF-8"?' . '>';
            $dom->loadHTML($xmlEncodingDecl . '<div>' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $root = $dom->getElementsByTagName('div')->item(0);
            if (!$root) {
                return null;
            }

            $overviewHtml = '';
            $days = [];
            $dayIndex = -1;
            $dayPattern = '/^\s*Day\s*(\d+)\s*:?\s*(.*)$/is';

            foreach ($root->childNodes as $node) {
                $tag = strtolower($node->nodeName);
                $text = trim(preg_replace('/\s+/', ' ', $node->textContent ?? ''));
                // Word-exported bullet list paragraphs prefix the real text
                // with an auto-generated bullet glyph (·, -, etc.) and stray
                // whitespace, which would otherwise defeat the anchored match.
                $textForDayCheck = preg_replace('/^[^A-Za-z0-9]+/u', '', $text);

                // Three real-world authoring patterns all appear in the data:
                // (1) a heading "Day N: Title" followed by separate detail
                //     paragraphs, (2) a single plain paragraph whose own text
                // starts with "Day N: ...", which IS the whole day, or
                // (3) the same but as a bulleted list paragraph.
                if (preg_match($dayPattern, $textForDayCheck, $m)) {
                    // Paragraph-style days carry their whole content in the
                    // title itself, so the node isn't also added to the body.
                    $days[] = [
                        'number' => (int) $m[1],
                        'title' => trim($m[2]),
                        'html' => '',
                    ];
                    $dayIndex++;
                    continue;
                }

                if ($tag === 'hr') {
                    continue;
                }
                if ($tag === 'div' && $node instanceof DOMElement && $text === '' && $node->getElementsByTagName('hr')->length > 0) {
                    continue;
                }

                $outer = $dom->saveHTML($node);
                if ($outer === false) {
                    continue;
                }

                if ($dayIndex === -1) {
                    $overviewHtml .= $outer;
                } else {
                    $days[$dayIndex]['html'] .= $outer;
                }
            }

            if (empty($days)) {
                return null;
            }

            return ['overview' => $overviewHtml, 'days' => $days];
        }

        $translatedContent = $product->getTranslated('content');
        $itinerary = uniqueExtractItinerary($translatedContent);
        $overviewHtml = $itinerary['overview'] ?? $translatedContent;

        $heroImage = (is_array($product->images) && count($product->images))
            ? asset('uploads/products/' . $product->images[0])
            : asset('image/service.jpg');

        $locationLabel = $product->getTranslated('location');
        $categoryLabel = is_array($product->product_types) && count($product->product_types)
            ? $product->product_types[0]
            : null;

        // Only a real subtitle field is used here — the raw `content` field is
        // long-form HTML (often starting with a quick-facts block), so
        // truncating it for the hero produced garbled, inconsistent text.
        // The full description already gets its own proper section below.
        $heroSubtitle = $product->getTranslated('subtitle');

        $includes = $product->getTranslated('includes', app()->getLocale());
        if (!is_array($includes)) {
            $includes = $product->includes ?? [];
        }
        $includes = array_values(array_filter(array_map('trim', is_array($includes) ? $includes : []), fn ($i) => $i !== ''));

        $excludes = $product->getTranslated('excludes', app()->getLocale());
        if (!is_array($excludes)) {
            $excludes = $product->excludes ?? [];
        }
        $excludes = array_values(array_filter(array_map('trim', is_array($excludes) ? $excludes : []), fn ($i) => $i !== ''));

        // Real contact details already configured for the site — nothing invented.
        $enquiryPhone = null;
        if ($sitesetting && !empty($sitesetting->office_contact)) {
            $decodedPhone = json_decode($sitesetting->office_contact, true);
            $enquiryPhone = is_array($decodedPhone) ? ($decodedPhone[0] ?? null) : $sitesetting->office_contact;
        }
        $enquiryEmail = null;
        if ($sitesetting && !empty($sitesetting->office_email)) {
            $decodedEmail = json_decode($sitesetting->office_email, true);
            $enquiryEmail = is_array($decodedEmail) ? ($decodedEmail[0] ?? null) : $sitesetting->office_email;
        }
        $enquiryWhatsapp = $sitesetting->whatsapp_number ?? null;
        $whatsappMessage = 'Hello Unique Nepal, I would like to enquire about the "' . ($product->getTranslated('heading') ?? $product->heading) . '" trip.';
    @endphp

    <!-- ============================================================
         PREMIUM HERO
    ============================================================= -->
    <section class="trip-hero">
        <img src="{{ $heroImage }}" alt="{{ $product->getTranslated('heading') ?? $product->heading }}" class="trip-hero-image">
        <div class="trip-hero-overlay"></div>

        <div class="container trip-hero-content">
            <p class="trip-hero-breadcrumb">
                <a href="{{ route('index') }}">Home</a>
                <span>/</span>
                <a href="{{ route('products.index.front') }}">Activities</a>
                <span>/</span>
                <span>{{ \Illuminate\Support\Str::limit($product->getTranslated('heading') ?? $product->heading, 40) }}</span>
            </p>

            <p class="heading" style="color: var(--gold-light);">
                NEPAL @if($locationLabel) &middot; {{ strtoupper($locationLabel) }} @endif
            </p>

            <h1 class="trip-hero-title">{{ $product->getTranslated('heading') ?? $product->heading }}</h1>

            @if($heroSubtitle)
                <p class="trip-hero-subtitle">{{ $heroSubtitle }}</p>
            @endif

            <div class="trip-hero-meta">
                @if($product->duration)
                    <span><i class="fas fa-clock"></i> {{ $product->duration }}</span>
                @endif
                @if($locationLabel)
                    <span><i class="fas fa-map-marker-alt"></i> {{ $locationLabel }}</span>
                @endif
                @if($product->original_price || $product->discounted_price)
                    <span class="trip-hero-price">
                        @if($product->original_price && $product->discounted_price)
                            <s>${{ number_format($product->original_price) }}</s> ${{ number_format($product->discounted_price) }}
                        @else
                            From ${{ number_format($product->discounted_price ?? $product->original_price) }}
                        @endif
                    </span>
                @endif
            </div>

            <div class="trip-hero-actions">
                <a href="{{ route('apply', $product->id) }}" class="btn cta-button px-4">
                    Plan Your Journey
                </a>
                @if($itinerary)
                    <a href="#itinerary" class="trip-btn-outline">View Itinerary</a>
                @else
                    <a href="#gallery-anchor" class="trip-btn-outline">View Gallery</a>
                @endif
            </div>
        </div>
    </section>

    <!-- ============================================================
         MAIN CONTENT + STICKY ENQUIRY SIDEBAR
    ============================================================= -->
    <section class="trip-body">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-8">

                    <!-- TRIP AT A GLANCE -->
                    @php
                        $glance = [];
                        if ($product->duration) $glance[] = ['icon' => 'fa-clock', 'label' => 'Duration', 'value' => $product->duration];
                        if ($locationLabel) $glance[] = ['icon' => 'fa-mountain', 'label' => 'Region', 'value' => $locationLabel];
                        if ($product->people) $glance[] = ['icon' => 'fa-users', 'label' => 'Group Size', 'value' => $product->people];
                        if ($product->getTranslated('package')) $glance[] = ['icon' => 'fa-box', 'label' => 'Package', 'value' => $product->getTranslated('package')];
                        if ($product->getTranslated('transportation')) $glance[] = ['icon' => 'fa-route', 'label' => 'Transport', 'value' => $product->getTranslated('transportation')];
                        if ($product->date) $glance[] = ['icon' => 'fa-calendar-alt', 'label' => 'Departure', 'value' => $product->date->format('M d, Y')];
                    @endphp

                    @if(count($glance))
                        <div class="trip-glance">
                            @foreach($glance as $item)
                                <div class="trip-glance-item">
                                    <i class="fas {{ $item['icon'] }}"></i>
                                    <div>
                                        <small>{{ $item['label'] }}</small>
                                        <strong>{{ $item['value'] }}</strong>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- OVERVIEW / SHORT DESCRIPTION -->
                    @if($overviewHtml && trim(strip_tags($overviewHtml)))
                        <div class="trip-section">
                            <p class="heading">Overview</p>
                            <p class="extralarger mb-3">{{ $itinerary ? 'A Journey Through The Himalayas' : 'About This Journey' }}</p>

                            <div class="trip-description" id="tripDescription">
                                {!! $overviewHtml !!}
                            </div>
                            <button type="button" class="trip-readmore" id="tripReadMoreBtn" data-more="Read Full Story" data-less="Show Less">
                                Read Full Story <span>↓</span>
                            </button>
                        </div>
                    @endif

                    <!-- ITINERARY -->
                    @if($itinerary)
                        @php
                            $firstDay = $itinerary['days'][0];
                            $firstDayHasBody = trim(strip_tags($firstDay['html'])) !== '';
                            $remainingDays = array_slice($itinerary['days'], 1);
                        @endphp
                        <div class="trip-section" id="itinerary">
                            <p class="heading">Day By Day</p>
                            <p class="extralarger mb-4">Your Itinerary</p>

                            <div class="trip-timeline">
                                {{-- Day 1's title is always visible; its detail collapses/expands
                                     the same way every other day does, just like a normal question
                                     with its answer hidden until asked. --}}
                                <div class="trip-day trip-day-first {{ $firstDayHasBody ? '' : 'trip-day-flat' }} {{ count($remainingDays) === 0 ? 'trip-day-only' : '' }}">
                                    @if($firstDayHasBody)
                                        <button type="button" class="trip-day-header">
                                            <span class="trip-day-number">{{ str_pad($firstDay['number'], 2, '0', STR_PAD_LEFT) }}</span>
                                            <span class="trip-day-title">{{ $firstDay['title'] ?: ('Day ' . $firstDay['number']) }}</span>
                                            <span class="trip-day-toggle">+</span>
                                        </button>
                                        <div class="trip-day-body">
                                            <div class="trip-day-body-inner">
                                                {!! $firstDay['html'] !!}
                                            </div>
                                        </div>
                                    @else
                                        <div class="trip-day-header">
                                            <span class="trip-day-number">{{ str_pad($firstDay['number'], 2, '0', STR_PAD_LEFT) }}</span>
                                            <span class="trip-day-title">{{ $firstDay['title'] ?: ('Day ' . $firstDay['number']) }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Remaining days stay out of view until requested, so the
                                     page never dumps the full itinerary by default --}}
                                @if(count($remainingDays))
                                    <div class="trip-itinerary-rest" id="itineraryRest">
                                        @foreach($remainingDays as $day)
                                            @php $dayHasBody = trim(strip_tags($day['html'])) !== ''; @endphp
                                            <div class="trip-day {{ $dayHasBody ? '' : 'trip-day-flat' }}">
                                                @if($dayHasBody)
                                                    <button type="button" class="trip-day-header">
                                                        <span class="trip-day-number">{{ str_pad($day['number'], 2, '0', STR_PAD_LEFT) }}</span>
                                                        <span class="trip-day-title">{{ $day['title'] ?: ('Day ' . $day['number']) }}</span>
                                                        <span class="trip-day-toggle">+</span>
                                                    </button>
                                                    <div class="trip-day-body">
                                                        <div class="trip-day-body-inner">
                                                            {!! $day['html'] !!}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="trip-day-header">
                                                        <span class="trip-day-number">{{ str_pad($day['number'], 2, '0', STR_PAD_LEFT) }}</span>
                                                        <span class="trip-day-title">{{ $day['title'] ?: ('Day ' . $day['number']) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" class="trip-itinerary-toggle" id="itineraryToggleBtn"
                                            data-more="View Full Itinerary ({{ count($remainingDays) }} more {{ \Illuminate\Support\Str::plural('day', count($remainingDays)) }})"
                                            data-less="Show Less">
                                        View Full Itinerary ({{ count($remainingDays) }} more {{ \Illuminate\Support\Str::plural('day', count($remainingDays)) }}) <span>→</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- WHAT'S INCLUDED / NOT INCLUDED -->
                    @if(count($includes) || count($excludes))
                        <div class="trip-section">
                            <p class="heading">Good To Know</p>
                            <p class="extralarger mb-4">What's Included</p>

                            <div class="row g-4">
                                @if(count($includes))
                                    <div class="{{ count($excludes) ? 'col-md-6' : 'col-12' }}">
                                        @if(count($excludes))
                                            <p class="trip-inex-label trip-inex-label-yes">Included</p>
                                        @endif
                                        <ul class="trip-includes {{ count($includes) > 4 ? 'trip-inex-collapsed' : '' }}" id="includesList">
                                            @foreach($includes as $include)
                                                <li><i class="fas fa-check-circle"></i> {{ $include }}</li>
                                            @endforeach
                                        </ul>
                                        @if(count($includes) > 4)
                                            <button type="button" class="trip-inex-more" data-target="includesList" data-more="Show all {{ count($includes) }} items" data-less="Show less">
                                                Show all {{ count($includes) }} items <span>↓</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif

                                @if(count($excludes))
                                    <div class="{{ count($includes) ? 'col-md-6' : 'col-12' }}">
                                        <p class="trip-inex-label trip-inex-label-no">Not Included</p>
                                        <ul class="trip-excludes {{ count($excludes) > 4 ? 'trip-inex-collapsed' : '' }}" id="excludesList">
                                            @foreach($excludes as $exclude)
                                                <li><i class="fas fa-times-circle"></i> {{ $exclude }}</li>
                                            @endforeach
                                        </ul>
                                        @if(count($excludes) > 4)
                                            <button type="button" class="trip-inex-more" data-target="excludesList" data-more="Show all {{ count($excludes) }} items" data-less="Show less">
                                                Show all {{ count($excludes) }} items <span>↓</span>
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- GALLERY -->
                    @if(is_array($product->images) && count($product->images) > 1)
                        <div class="trip-section" id="gallery-anchor">
                            <p class="heading">Gallery</p>
                            <p class="extralarger mb-4">Moments From The Trail</p>

                            <div class="trip-gallery" id="tripGallery">
                                @foreach($product->images as $idx => $gimg)
                                    <a href="{{ asset('uploads/products/' . $gimg) }}"
                                       class="trip-gallery-item {{ $idx === 0 ? 'trip-gallery-featured' : '' }}"
                                       data-lightbox-trigger>
                                        <img src="{{ asset('uploads/products/' . $gimg) }}"
                                             alt="{{ ($product->getTranslated('heading') ?? $product->heading) . ' - photo ' . ($idx + 1) }}" loading="lazy">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- VIDEO HIGHLIGHTS -->
                    @if(is_array($product->videos) && count($product->videos))
                        <div class="trip-section" id="video-anchor">
                            <p class="heading">Watch</p>
                            <p class="extralarger mb-4">The Journey In Motion</p>

                            <div class="trip-videos">
                                @foreach($product->videos as $vid)
                                    <video src="{{ asset('uploads/products/videos/' . $vid) }}"
                                           class="trip-video-item"
                                           muted loop playsinline preload="metadata"
                                           onmouseover="this.play()" onmouseout="this.pause()"
                                           onclick="this.paused ? this.play() : this.pause()"
                                           controls>
                                    </video>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- ============================================================
                     PREMIUM ENQUIRY SIDEBAR (replaces "Related Offer")
                ============================================================= -->
                <div class="col-lg-4">
                    <div class="trip-enquiry-card">
                        <p class="heading" style="color: var(--gold-light);">Plan Your Journey</p>
                        <h3>Interested In This Experience?</h3>
                        <p class="trip-enquiry-copy">
                            Tell us your preferred dates, group size and travel preferences —
                            our Nepal travel specialists will help tailor this journey for you.
                        </p>

                        <a href="{{ route('apply', $product->id) }}" class="btn cta-button w-100 mb-2">
                            Plan This Trip
                        </a>

                        @if($enquiryWhatsapp)
                            <a href="https://wa.me/{{ $enquiryWhatsapp }}?text={{ urlencode($whatsappMessage) }}"
                               target="_blank" rel="noopener" class="trip-enquiry-whatsapp">
                                <i class="fab fa-whatsapp"></i> WhatsApp Us
                            </a>
                        @endif

                        @if($enquiryPhone || $enquiryEmail)
                            <div class="trip-enquiry-divider">
                                <span>Prefer to talk directly?</span>
                            </div>

                            <div class="trip-enquiry-contacts">
                                @if($enquiryPhone)
                                    <a href="tel:{{ $enquiryPhone }}"><i class="fas fa-phone-alt"></i> {{ $enquiryPhone }}</a>
                                @endif
                                @if($enquiryEmail)
                                    <a href="mailto:{{ $enquiryEmail }}"><i class="fas fa-envelope"></i> {{ $enquiryEmail }}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         SHARE & DISCUSS (final content section, per request)
    ============================================================= -->
    <section class="trip-discuss" id="comments">
        <div class="container">
            <div class="trip-discuss-inner">
                <p class="heading" style="color: var(--gold-dark);">Share The Journey</p>
                <p class="extralarger mb-4">Loved This Trip? Spread The Word</p>

                <div class="trip-share trip-share-final">
                    @include('frontend.includes.share', ['shareTitle' => $product->getTranslated('heading') ?? $product->heading])
                </div>

                @if(session('comment_success'))
                    <div class="trip-comment-success">{{ session('comment_success') }}</div>
                @endif

                @php $comments = $product->comments; @endphp

                <div class="trip-comments-list">
                    <p class="trip-comments-count">
                        {{ $comments->count() }} {{ \Illuminate\Support\Str::plural('Comment', $comments->count()) }}
                    </p>

                    @forelse($comments as $comment)
                        <div class="trip-comment">
                            <div class="trip-comment-avatar">{{ strtoupper(substr($comment->name, 0, 1)) }}</div>
                            <div>
                                <p class="trip-comment-meta"><strong>{{ $comment->name }}</strong> &middot; {{ $comment->created_at->diffForHumans() }}</p>
                                <p class="trip-comment-text">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="trip-comments-empty">Be the first to share your thoughts about this trip.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('products.comments.store', $product->id) }}" class="trip-comment-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required maxlength="255">
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="comment" class="form-control" placeholder="Share your thoughts about this trip..." value="{{ old('comment') }}" required maxlength="2000">
                        </div>
                    </div>
                    @error('name')<small class="text-danger d-block mt-2">{{ $message }}</small>@enderror
                    @error('comment')<small class="text-danger d-block mt-2">{{ $message }}</small>@enderror
                    <button type="submit" class="btn cta-button mt-3">Post Comment</button>
                </form>
            </div>
        </div>
    </section>

    <!-- ============================================================
         FINAL CTA
    ============================================================= -->
    <section class="trip-final-cta">
        <div class="container text-center">
            <p class="heading justify-content-center" style="color: var(--gold-light);">Every Journey Is Different</p>
            <p class="extralarger mb-3" style="color: #fff;">Talk To A Travel Specialist</p>
            <p class="trip-final-cta-copy">
                Tell us what you have in mind and our local travel specialists will help
                create the right experience for you.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('apply', $product->id) }}" class="btn cta-button px-5">Enquire Now</a>
                @if($enquiryWhatsapp)
                    <a href="https://wa.me/{{ $enquiryWhatsapp }}?text={{ urlencode($whatsappMessage) }}"
                       target="_blank" rel="noopener" class="trip-btn-outline">
                        <i class="fab fa-whatsapp"></i> WhatsApp Us
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Mobile sticky CTA -->
    <div class="trip-mobile-cta">
        <a href="{{ route('apply', $product->id) }}">Enquire About This Trip</a>
    </div>

    <!-- Lightbox -->
    <div class="trip-lightbox" id="tripLightbox">
        <button type="button" class="trip-lightbox-close" id="tripLightboxClose" aria-label="Close">&times;</button>
        <img src="" alt="" id="tripLightboxImage">
    </div>

    <style>
        /* =========================================================
           HERO
        ========================================================= */
        .trip-hero {
            position: relative;
            /* min-height (not a fixed height) with the content in normal flow
               below: a long title naturally grows the section downward
               instead of overflowing upward into the fixed navbar. This is
               what keeps every product's hero visually consistent — the
               image + overlay always stretch to fit whatever height the
               real content ends up needing. */
            min-height: 620px;
            display: flex;
            align-items: flex-end;
            padding: 150px 0 60px;
            overflow: hidden;
        }
        .trip-hero-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .trip-hero-overlay {
            position: absolute;
            inset: 0;
            /* Two stacked layers so contrast stays consistent regardless of
               how bright or dark the product's own photo is: a directional
               gradient for the text zone at the bottom, plus a flat vignette
               near the top so the nav stays legible over light skies too. */
            background:
                linear-gradient(to bottom, rgba(1, 15, 32, 0.55) 0%, rgba(1, 15, 32, 0) 180px),
                linear-gradient(to top, rgba(1, 15, 32, 0.94) 0%, rgba(1, 15, 32, 0.72) 45%, rgba(1, 15, 32, 0.5) 100%);
        }
        .trip-hero-content {
            position: relative;
            width: 100%;
            color: #fff;
        }
        .trip-hero-breadcrumb {
            font-family: var(--font-family);
            font-size: 0.8rem;
            color: rgba(255,255,255,0.6);
            margin-bottom: 1.25rem;
        }
        .trip-hero-breadcrumb a { color: rgba(255,255,255,0.75); }
        .trip-hero-breadcrumb a:hover { color: var(--gold-light); }
        .trip-hero-breadcrumb span { margin: 0 6px; }
        .trip-hero-title {
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: clamp(2.2rem, 1.6rem + 2.6vw, 3.75rem);
            color: #fff;
            max-width: 820px;
            margin: 0.25rem 0 1rem;
        }
        .trip-hero-subtitle {
            max-width: 640px;
            font-family: var(--font-family);
            color: rgba(255,255,255,0.85);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .trip-hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.75rem;
            font-family: var(--font-family);
            font-size: 0.9rem;
            letter-spacing: 0.4px;
            color: rgba(255,255,255,0.85);
            margin-bottom: 2rem;
        }
        .trip-hero-meta i { color: var(--gold-light); margin-right: 6px; }
        .trip-hero-price {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--gold-light);
        }
        .trip-hero-price s { color: rgba(255,255,255,0.5); font-weight: 400; margin-right: 6px; }
        .trip-hero-actions { display: flex; flex-wrap: wrap; gap: 1rem; }
        .trip-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.75rem 1.75rem;
            border: 1px solid rgba(255,255,255,0.5);
            color: #fff;
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.4px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color .3s ease, border-color .3s ease;
        }
        .trip-btn-outline:hover { background: rgba(255,255,255,0.12); border-color: #fff; color: #fff; }

        /* =========================================================
           BODY
        ========================================================= */
        .trip-body { padding: 80px 0 40px; background: var(--bg-color); }
        .trip-section { margin-bottom: 3.5rem; }

        .trip-glance {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            background: #fff;
            border: 1px solid rgba(201,161,90,0.2);
            border-radius: 10px;
            padding: 1.75rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 24px rgba(2,31,65,0.06);
        }
        .trip-glance-item { display: flex; align-items: flex-start; gap: 12px; }
        .trip-glance-item i { color: var(--gold-dark); font-size: 1.2rem; margin-top: 3px; }
        .trip-glance-item small {
            display: block;
            font-family: var(--font-family);
            font-size: 0.72rem;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #8a8880;
        }
        .trip-glance-item strong {
            display: block;
            font-family: var(--font-heading);
            color: var(--text-color);
            font-size: 1.02rem;
        }

        .trip-description {
            max-height: 5.4em;
            overflow: hidden;
            position: relative;
            font-family: var(--font-family);
            color: #55534d;
            line-height: 1.85;
            transition: max-height 0.6s cubic-bezier(0.16, 0.84, 0.44, 1);
        }
        .trip-description::after {
            content: "";
            position: absolute;
            left: 0; right: 0; bottom: 0;
            height: 60px;
            background: linear-gradient(transparent, var(--bg-color));
            transition: opacity 0.3s ease;
        }
        .trip-description.expanded { max-height: 4000px; }
        .trip-description.expanded::after { opacity: 0; }
        .trip-readmore {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 1rem;
            background: none;
            border: none;
            padding: 0;
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.4px;
            color: var(--gold-dark);
            cursor: pointer;
        }
        .trip-readmore span { transition: transform 0.3s ease; }
        .trip-readmore.expanded span { transform: rotate(180deg); }

        .trip-share {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem 0;
            margin-bottom: 3rem;
            border-top: 1px solid rgba(201,161,90,0.2);
            border-bottom: 1px solid rgba(201,161,90,0.2);
            font-family: var(--font-family);
            font-size: 0.85rem;
            color: #6b6a65;
        }

        /* Timeline / itinerary */
        .trip-timeline { position: relative; }
        .trip-day { position: relative; padding-left: 62px; margin-bottom: 4px; }
        .trip-day::before {
            content: "";
            position: absolute;
            left: 22px; top: 40px; bottom: -4px;
            width: 1px;
            background: rgba(201,161,90,0.3);
        }
        .trip-day:last-child::before { display: none; }
        .trip-day-flat .trip-day-header { cursor: default; }
        .trip-day-first { margin-bottom: 0.5rem; }
        .trip-day-only::before { display: none; }

        .trip-itinerary-rest {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.7s cubic-bezier(0.16, 0.84, 0.44, 1);
        }
        .trip-itinerary-rest.expanded { max-height: 20000px; }

        .trip-itinerary-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 1.5rem 0 0 62px;
            padding: 0.75rem 1.5rem;
            border: 1px solid rgba(201,161,90,0.5);
            border-radius: 4px;
            background: none;
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.4px;
            color: var(--gold-dark);
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .trip-itinerary-toggle:hover { background: var(--bg-color); border-color: var(--gold); }
        .trip-itinerary-toggle span { transition: transform 0.3s ease; display: inline-block; }
        .trip-itinerary-toggle.expanded span { transform: rotate(90deg); }
        @media (max-width: 575.98px) {
            .trip-itinerary-toggle { margin-left: 0; }
        }
        .trip-day-header {
            position: relative;
            display: flex;
            align-items: center;
            gap: 16px;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: 0.9rem 0;
            cursor: pointer;
        }
        .trip-day-number {
            position: absolute;
            left: -62px;
            width: 44px; height: 44px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 0.95rem;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: var(--charcoal);
            flex-shrink: 0;
        }
        .trip-day-title {
            flex: 1;
            font-family: var(--font-heading);
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--text-color);
        }
        .trip-day-toggle {
            width: 30px; height: 30px;
            border-radius: 50%;
            border: 1px solid rgba(201,161,90,0.5);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-dark);
            font-size: 1.2rem;
            transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
            flex-shrink: 0;
        }
        .trip-day.open .trip-day-toggle {
            background: var(--gold);
            color: var(--charcoal);
            transform: rotate(135deg);
        }
        .trip-day-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.16, 0.84, 0.44, 1);
        }
        .trip-day-body-inner {
            padding: 0 0 1.75rem 0;
            font-family: var(--font-family);
            color: #55534d;
            line-height: 1.8;
            font-size: 0.95rem;
        }
        .trip-day-body-inner strong { color: var(--text-color); }

        .trip-includes { list-style: none; padding: 0; margin: 0; }
        .trip-includes li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 0.6rem 0;
            border-bottom: 1px dashed rgba(201,161,90,0.25);
            font-family: var(--font-family);
            color: #55534d;
            line-height: 1.6;
        }
        .trip-includes li:last-child { border-bottom: none; }
        .trip-includes li i { color: var(--gold-dark); margin-top: 4px; }

        .trip-excludes { list-style: none; padding: 0; margin: 0; }
        .trip-excludes li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 0.6rem 0;
            border-bottom: 1px dashed rgba(201,161,90,0.25);
            font-family: var(--font-family);
            color: #55534d;
            line-height: 1.6;
        }
        .trip-excludes li:last-child { border-bottom: none; }
        .trip-excludes li i { color: #b95c50; margin-top: 4px; }

        .trip-inex-label {
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.78rem;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }
        .trip-inex-label-yes { color: var(--gold-dark); }
        .trip-inex-label-no { color: #b95c50; }

        .trip-inex-collapsed li:nth-child(n+5) { display: none; }
        .trip-inex-collapsed.expanded li:nth-child(n+5) { display: flex; }

        .trip-inex-more {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 0.85rem;
            background: none;
            border: none;
            padding: 0;
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.4px;
            color: var(--gold-dark);
            cursor: pointer;
        }
        .trip-inex-more span { transition: transform 0.3s ease; }
        .trip-inex-more.expanded span { transform: rotate(180deg); }

        .trip-videos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 14px;
        }
        .trip-video-item {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 8px;
            background: #000;
            cursor: pointer;
        }

        .trip-gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 140px;
            gap: 10px;
        }
        .trip-gallery-item { display: block; overflow: hidden; border-radius: 6px; }
        .trip-gallery-featured { grid-column: span 2; grid-row: span 2; }
        .trip-gallery-item img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.5s ease;
        }
        .trip-gallery-item:hover img { transform: scale(1.06); }

        @media (max-width: 575.98px) {
            .trip-gallery { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 130px; }
            .trip-gallery-featured { grid-column: span 2; grid-row: span 1; }
        }

        /* Enquiry sidebar */
        .trip-enquiry-card {
            position: sticky;
            top: 100px;
            background: #fff;
            border: 1px solid rgba(201,161,90,0.25);
            border-radius: 10px;
            box-shadow: 0 16px 40px rgba(2,31,65,0.1);
            padding: 2rem;
        }
        .trip-enquiry-card h3 {
            font-family: var(--font-heading);
            font-size: 1.4rem;
            color: var(--text-color);
            margin-bottom: 0.75rem;
        }
        .trip-enquiry-copy {
            font-family: var(--font-family);
            font-size: 0.9rem;
            color: #6b6a65;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .trip-enquiry-whatsapp {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 0.7rem;
            border: 1px solid rgba(201,161,90,0.4);
            border-radius: 4px;
            color: var(--text-color);
            font-family: var(--font-family);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        .trip-enquiry-whatsapp i { color: #25D366; }
        .trip-enquiry-whatsapp:hover { background: var(--bg-color); border-color: var(--gold); }
        .trip-enquiry-divider {
            text-align: center;
            margin: 1.5rem 0 1rem;
            font-family: var(--font-family);
            font-size: 0.78rem;
            letter-spacing: 0.5px;
            color: #a8a69c;
            position: relative;
        }
        .trip-enquiry-divider::before, .trip-enquiry-divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: rgba(201,161,90,0.25);
        }
        .trip-enquiry-divider::before { left: 0; }
        .trip-enquiry-divider::after { right: 0; }
        .trip-enquiry-contacts { display: flex; flex-direction: column; gap: 0.65rem; }
        .trip-enquiry-contacts a {
            display: flex; align-items: center; gap: 10px;
            font-family: var(--font-family);
            font-size: 0.9rem;
            color: var(--text-color);
            text-decoration: none;
        }
        .trip-enquiry-contacts a i { color: var(--gold-dark); width: 16px; }
        .trip-enquiry-contacts a:hover { color: var(--gold-dark); }

        /* Share & Discuss */
        .trip-discuss {
            padding: 70px 0;
            background: #fff;
            border-top: 1px solid rgba(201,161,90,0.2);
        }
        .trip-discuss-inner { max-width: 760px; margin: 0 auto; }
        .trip-share-final {
            border: none;
            padding: 0 0 2.5rem;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid rgba(201,161,90,0.2);
        }
        .trip-comment-success {
            background: rgba(37, 211, 102, 0.1);
            border: 1px solid rgba(37, 211, 102, 0.35);
            color: #1c7a44;
            padding: 0.85rem 1.1rem;
            border-radius: 6px;
            font-family: var(--font-family);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .trip-comments-count {
            font-family: var(--font-family);
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 1.25rem;
        }
        .trip-comments-empty {
            font-family: var(--font-family);
            color: #8a8880;
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        .trip-comment {
            display: flex;
            gap: 14px;
            padding: 1rem 0;
            border-bottom: 1px dashed rgba(201,161,90,0.25);
        }
        .trip-comment-avatar {
            flex-shrink: 0;
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
            color: var(--charcoal);
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-heading);
            font-weight: 700;
        }
        .trip-comment-meta {
            font-family: var(--font-family);
            font-size: 0.82rem;
            color: #8a8880;
            margin-bottom: 0.3rem;
        }
        .trip-comment-meta strong { color: var(--text-color); }
        .trip-comment-text {
            font-family: var(--font-family);
            color: #55534d;
            line-height: 1.6;
            margin: 0;
        }
        .trip-comment-form { margin-top: 2rem; }
        .trip-comment-form .form-control {
            border-radius: 6px;
            border-color: rgba(201,161,90,0.3);
            padding: 0.7rem 0.9rem;
            font-family: var(--font-family);
        }
        .trip-comment-form .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(201,161,90,0.15);
        }

        /* Final CTA */
        .trip-final-cta {
            padding: 90px 0;
            background: var(--primary-dark);
        }
        .trip-final-cta-copy {
            max-width: 560px;
            margin: 0 auto 2rem;
            color: rgba(255,255,255,0.7);
            font-family: var(--font-family);
            line-height: 1.8;
        }

        /* Mobile sticky CTA */
        .trip-mobile-cta { display: none; }
        @media (max-width: 767.98px) {
            .trip-mobile-cta {
                display: block;
                position: fixed;
                left: 0; right: 0; bottom: 0;
                z-index: 999;
                background: var(--primary-dark);
                padding: 12px 16px;
                box-shadow: 0 -6px 20px rgba(0,0,0,0.25);
            }
            .trip-mobile-cta a {
                display: block;
                text-align: center;
                background: var(--gold);
                color: var(--charcoal);
                font-family: var(--font-family);
                font-weight: 600;
                letter-spacing: 0.4px;
                padding: 0.85rem;
                border-radius: 4px;
                text-decoration: none;
            }
            .trip-enquiry-card { position: static; margin-bottom: 2rem; }
            .trip-hero { min-height: 460px; padding: 110px 0 30px; }
            body { padding-bottom: 70px; }
        }

        /* Lightbox */
        .trip-lightbox {
            display: none;
            position: fixed; inset: 0;
            background: rgba(1,15,32,0.94);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .trip-lightbox.open { display: flex; }
        .trip-lightbox img { max-width: 100%; max-height: 90vh; border-radius: 4px; }
        .trip-lightbox-close {
            position: absolute; top: 24px; right: 32px;
            background: none; border: none;
            color: #fff; font-size: 2.5rem; line-height: 1;
            cursor: pointer;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Read more / show less
            var desc = document.getElementById('tripDescription');
            var moreBtn = document.getElementById('tripReadMoreBtn');
            if (desc && moreBtn) {
                moreBtn.addEventListener('click', function () {
                    var expanded = desc.classList.toggle('expanded');
                    moreBtn.classList.toggle('expanded', expanded);
                    moreBtn.innerHTML = (expanded ? moreBtn.dataset.less : moreBtn.dataset.more) + ' <span>↓</span>';
                });
            }

            // Includes / Excludes "show more" toggle
            document.querySelectorAll('.trip-inex-more').forEach(function (btn) {
                var list = document.getElementById(btn.dataset.target);
                if (!list) return;
                btn.addEventListener('click', function () {
                    var expanded = list.classList.toggle('expanded');
                    btn.classList.toggle('expanded', expanded);
                    btn.innerHTML = (expanded ? btn.dataset.less : btn.dataset.more) + ' <span>↓</span>';
                });
            });

            // View Full Itinerary toggle (days 2+ stay hidden until requested)
            var itineraryToggleBtn = document.getElementById('itineraryToggleBtn');
            var itineraryRest = document.getElementById('itineraryRest');
            if (itineraryToggleBtn && itineraryRest) {
                itineraryToggleBtn.addEventListener('click', function () {
                    var expanded = itineraryRest.classList.toggle('expanded');
                    itineraryToggleBtn.classList.toggle('expanded', expanded);
                    itineraryToggleBtn.innerHTML = (expanded ? itineraryToggleBtn.dataset.less : itineraryToggleBtn.dataset.more) + ' <span>→</span>';
                    if (!expanded) {
                        itineraryToggleBtn.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            }

            // Itinerary accordion — every day (including Day 1) starts
            // collapsed; only the title is visible until it's clicked open.
            document.querySelectorAll('.trip-day-header').forEach(function (header) {
                var day = header.closest('.trip-day');
                var body = day.querySelector('.trip-day-body');
                if (!body) return;

                function setOpen(isOpen) {
                    day.classList.toggle('open', isOpen);
                    body.style.maxHeight = isOpen ? body.scrollHeight + 'px' : '0px';
                }

                setOpen(day.classList.contains('open'));

                header.addEventListener('click', function () {
                    setOpen(!day.classList.contains('open'));
                });
            });

            // Recalculate open panel heights after images inside load
            window.addEventListener('load', function () {
                document.querySelectorAll('.trip-day.open .trip-day-body').forEach(function (body) {
                    body.style.maxHeight = body.scrollHeight + 'px';
                });
            });

            // Lightbox
            var lightbox = document.getElementById('tripLightbox');
            var lightboxImg = document.getElementById('tripLightboxImage');
            var closeBtn = document.getElementById('tripLightboxClose');
            document.querySelectorAll('[data-lightbox-trigger]').forEach(function (trigger) {
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();
                    lightboxImg.src = trigger.getAttribute('href');
                    lightboxImg.alt = trigger.querySelector('img') ? trigger.querySelector('img').alt : '';
                    lightbox.classList.add('open');
                });
            });
            function closeLightbox() { lightbox.classList.remove('open'); lightboxImg.src = ''; }
            if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
            if (lightbox) lightbox.addEventListener('click', function (e) { if (e.target === lightbox) closeLightbox(); });

            // Smooth scroll for in-page anchors
            document.querySelectorAll('a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var target = document.querySelector(link.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>

@endsection

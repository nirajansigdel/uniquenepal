
<!DOCTYPE html>
<html lang="en">
<head>
 
    
  @php
$faqSchema = [
    "@context" => "https://schema.org",
    "@type" => "FAQPage",
    "mainEntity" => [
        [
            "@type" => "Question",
            "name" => "How much does trekking in Nepal cost?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "Trekking in Nepal costs typically range from USD 800 to USD 4,500 depending on the trek, duration, season, permits, accommodation, and guide services."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "What is included in the Himalaya trekking cost?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "Himalaya trekking cost usually includes permits, licensed guide, accommodation, meals during the trek, transportation, and basic logistics. International flights are generally not included."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "Is a trip to the Himalayas expensive?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "A trip to the Himalayas can be affordable or luxury depending on your travel style. Nepal offers budget-friendly trekking options as well as premium guided Himalayan expeditions."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "Can Unique Nepal customize trekking packages based on budget?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "Yes, Unique Nepal customizes trekking and tour packages based on your budget, travel dates, group size, and preferred Himalayan destinations."
            ]
        ],
        [
            "@type" => "Question",
            "name" => "Do you charge any hidden or extra service fees?",
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => "No, we do not charge hidden fees. All trekking and tour costs are clearly explained before booking, ensuring full price transparency."
            ]
        ]
    ]
];
@endphp


    <meta charset="UTF-8">
    <meta name="viewport" content="{{ $seoSetting->viewport ?? 'width=device-width, initial-scale=1.0' }}">
    <title>@yield('title', $seoSetting->meta_title ?? config('app.name'))</title>
    <meta name="keywords" content="{{ $seoSetting->meta_keywords ?? '' }}">
    <meta name="author" content="{{ $seoSetting->meta_author ?? '' }}">
    @yield('meta')

    {{-- Canonical --}}
    @if(!empty($seoSetting->canonical_url))
        <link rel="canonical" href="{{ $seoSetting->canonical_url }}">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    {{-- Schema --}}
    <script type="application/ld+json">
        {!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>


    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ file_exists(public_path('css/style.css')) ? filemtime(public_path('css/style.css')) : time() }}">
    
    
    

    {{-- Favicon --}}
    @if($favicon)
        @if($favicon->favicon_ico)
            <link rel="icon" type="image/png" href="{{ asset('uploads/favicon/' . $favicon->favicon_ico) }}">
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/' . $favicon->favicon_ico) }}">
        @endif
        @if($favicon->apple_touch_icon)
            <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . $favicon->apple_touch_icon) }}">
        @endif
        @if($favicon->favicon_thirtyTwo)
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' . $favicon->favicon_thirtyTwo) }}">
        @endif
        @if($favicon->favicon_sixteen)
            <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' . $favicon->favicon_sixteen) }}">
        @endif
    @else
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    @endif

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6QWHD99TZQ"></script>


<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6QWHD99TZQ');
</script>

</head>


<body>


</body>
</html>

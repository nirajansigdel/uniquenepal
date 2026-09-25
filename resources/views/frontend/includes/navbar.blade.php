<!-- Bootstrap CSS is already loaded once in includes.head; this duplicate,
     older CDN copy used to load after style.css in DOM order and silently
     reset the theme's custom color tokens back to Bootstrap defaults. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<!-- Navbar -->
@php
  use App\Models\Product;
  use App\Models\Service;
  use App\Models\WhyUs;
  use App\Models\About;
  use App\Models\CoverImage;
use App\Models\BlogPostsCategory;
  use App\Models\Career;
  use App\Models\Testimonial;

  // Helper to get first product image url
  $firstProductImage = function (?Product $p) {
    if (!$p) return null;
    $imgs = is_array($p->images) ? $p->images : [];
    if (count($imgs) > 0) {
      return asset('uploads/products/' . $imgs[0]);
    }
    return null;
  };

  // Offer thumbnails (one latest item per type)
  $promoProd = Product::where('status', true)->hasType('Post')->latest()->first();
  $promoThumb = $firstProductImage($promoProd);
  
    $destination = Product::where('status', true)->hasType('Destination')->latest()->first();
  $generaldestination = $firstProductImage($destination);

  $generalProd = Product::where('status', true)->hasType('General')->latest()->first();
  $generalThumb = $firstProductImage($generalProd);

  $festivalProd = Product::where('status', true)->hasType('Festival')->latest()->first();
  $festivalThumb = $firstProductImage($festivalProd);

  $coupleProd = Product::where('status', true)->hasType('Couple')->latest()->first();
  $coupleThumb = $firstProductImage($coupleProd);

  $groupProd = Product::where('status', true)->hasType('Group')->latest()->first();
  $groupThumb = $firstProductImage($groupProd);

  // Introduction thumbnails
  $service = Service::latest()->first();
  $serviceThumb = $service && $service->image ? asset('uploads/service/' . $service->image) : null;

  $why = WhyUs::latest()->first();
  $whyThumb = $why && $why->image ? asset('uploads/whyus/' . $why->image) : null;

  $about = About::first();
  $aboutThumb = $about && $about->image ? asset('uploads/about/' . $about->image) : null;

  $cover = CoverImage::latest()->first();
  $homeThumb = null;
  if ($cover) {
    $coverImgs = is_array($cover->image) ? $cover->image : [];
    if (count($coverImgs) > 0) {
      $homeThumb = asset('uploads/coverimage/' . $coverImgs[0]);
    }
  }

  // Updates thumbnails
   $blog = BlogPostsCategory::latest()->first();
  $blogsThumb = $blog && $blog->image ? asset('uploads/blogpostcategory/' . $blog->image) : null;

  $careerItem = Career::where('status', true)->latest()->first();
  $careerThumb = $careerItem ? $careerItem->image_url : null;

  $testi = Testimonial::latest()->first();
  $testimonialThumb = $testi && $testi->image ? asset('uploads/testimonial/' . $testi->image) : null;
@endphp
<nav class="navbar navbar-expand-md">
  <div class="container d-flex align-items-center justify-content-between">
    <!-- Logo -->
    <a class="navbar-brand toplogo" href="{{ route('index') }}">
      <img src="{{ asset('image/logo1.png') }}" alt="Logo" />
      
    </a>

    <!-- Language Toggle (mobile) -->
    <div class="lang-toggle-mobile d-flex align-items-center">
      <div class="position-relative lang-toggle px-1 py-1 rounded-pill" style="width: 100px; background-color: transparent;">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
          <a href="{{ route('language.switch', 'es') }}" id="langSpa" class="lang-option flex-fill text-center py-1 fw-semibold {{ app()->getLocale() === 'es' ? 'lang-active' : 'lang-inactive' }}">SPA</a>
          <a href="{{ route('language.switch', 'en') }}" id="langEng" class="lang-option flex-fill text-center py-1 fw-semibold {{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}">ENG</a>
        </div>
      </div>
    </div>

    <!-- Hamburger Button -->
    <button class="navbar-toggler" style="color:white"  type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
      aria-controls="mobileMenu">
      <span class="navbar-toggler-icon " style="color:white"></span>
    </button>

    <div class="navbar-divider d-none d-lg-block"></div>

    <!-- Desktop Menu -->
    <div class="collapse navbar-collapse justify-content-between d-none d-md-flex">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark " href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            {{ __('messages.introduction') }}
          </a>
          <div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">
            <div class="container-fluid mega-inner">
              <div class="mega-card-grid">
                <a class="mega-card" href="{{ route('index') }}">
                  <div class="mega-thumb" @if($homeThumb) style="background-image: url('{{ $homeThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.Home') }}</div>
                </a>
                <a class="mega-card" href="{{ route('whyus') }}">
                  <div class="mega-thumb" @if($whyThumb) style="background-image: url('{{ $whyThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.why_us') }}</div>
                </a>
                <a class="mega-card" href="{{ route('Service') }}">
                  <div class="mega-thumb" @if($serviceThumb) style="background-image: url('{{ $serviceThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.services') }}</div>
                </a>
                <a class="mega-card" href="{{ route('About') }}">
                  <div class="mega-thumb" @if($aboutThumb) style="background-image: url('{{ $aboutThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.about') }}</div>
                </a>
              </div>
            </div>
          </div>
        </li>
        
       
         <li class="nav-item"><a class="nav-link text-dark" href="{{ route('blogs') }}">{{ __('messages.blogs') }}</a></li>
        <li class="nav-item"><a class="nav-link text-dark "
            href=" {{ route('products.index.front') }}">{{ __('messages.activities') }}</a></li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark " href="#" id="offerDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
     {{ __('messages.trekking') }}
          </a>
          <div class="dropdown-menu mega-menu" aria-labelledby="offerDropdown">
            <div class="container-fluid mega-inner">
              <div class="mega-card-grid">
                <a class="mega-card" href="{{ route('destinations.index.front') }}">
                  <div class="mega-thumb" @if($generaldestination) style="background-image: url('{{ $generaldestination }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.everest') }}</div>
                </a>
                <a class="mega-card" href="{{ route('general.index.front') }}">
                  <div class="mega-thumb" @if($generalThumb) style="background-image: url('{{ $generalThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.annapurna') }}</div>
                </a>
                <a class="mega-card" href="{{ route('festivals.index.front') }}">
                  <div class="mega-thumb" @if($festivalThumb) style="background-image: url('{{ $festivalThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.langtang') }}</div>
                </a>
                <a class="mega-card" href="{{ route('couples.index.front') }}">
                  <div class="mega-thumb" @if($coupleThumb) style="background-image: url('{{ $coupleThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.adventure') }}</div>
                </a>
                <a class="mega-card" href="{{ route('groups.index.front') }}">
                  <div class="mega-thumb" @if($groupThumb) style="background-image: url('{{ $groupThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.dolpa') }}</div>
                </a>
              </div>
            </div>
          </div>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link text-dark" href="#" data-bs-toggle="dropdown">Updates</a>
          <div class="dropdown-menu mega-menu">
            <div class="container-fluid mega-inner">
              <div class="mega-card-grid">
                <a class="mega-card" href="{{ route('career') }}">
                  <div class="mega-thumb" @if($careerThumb) style="background-image: url('{{ $careerThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.careernav')}}</div>
                </a>
                <a class="mega-card" href="{{ route('testimonails') }}">
                  <div class="mega-thumb" @if($testimonialThumb) style="background-image: url('{{ $testimonialThumb }}'); background-size: cover; background-position: center;" @endif></div>
                  <div class="mega-card-title">{{ __('messages.testimonials') }}</div>
                </a>
              </div>
            </div>
          </div>
        </li>
         <li class="nav-item"><a class="nav-link text-dark" href="{{ route('Gallery') }}">{{ __('messages.gallery') }}</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href=" {{ route('Contact') }}">{{ __('messages.contact') }}</a></li>
      </ul>

      <!-- Language Toggle + CTA (desktop) -->
      <div class="d-flex align-items-center gap-4">
        <div class="lang-switch lang-toggle">
          <a href="{{ route('language.switch', 'es') }}" id="langSpa" class="{{ app()->getLocale() === 'es' ? 'lang-active' : 'lang-inactive' }}">ES</a>
          <a href="{{ route('language.switch', 'en') }}" id="langEng" class="{{ app()->getLocale() === 'en' ? 'lang-active' : 'lang-inactive' }}">EN</a>
        </div>
        <a href="{{ route('Contact') }}" class="btn navbar-book-btn">{{ __('messages.book_now') }}</a>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
    <button type="button" class="btn-close white-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index.front') }}?type=Post">{{ __('messages.activities')}}</a>
      </li> <li class="nav-item">
        <a class="nav-link" href="{{ route('destinations.index.front') }}?type=Destination">{{ __('messages.everest')}}</a>
      </li> <li class="nav-item">
        <a class="nav-link" href="{{ route('festivals.index.front') }}?type=General">{{ __('messages.langtang') }}</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('general.index.front') }}?type=Festival">{{ __('messages.annapurna') }}</a>
      </li>
      </li> <li class="nav-item">
        <a class="nav-link" href="{{ route('couples.index.front') }}?type=Couple">{{ __('messages.adventure') }}</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('groups.index.front') }}?type=Group">{{ __('messages.dolpa') }}</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
          Information
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('About') }}">About Us</a></li>
          <li><a class="dropdown-item" href="{{ route('Service') }}">{{ __('messages.services') }}</a></li>
          <li><a class="dropdown-item" href="{{ route('events') }}" >News & Events</a></li>
          <li><a class="dropdown-item"  href="{{ route('whyus') }}" >Why Us</a></li>
          <li><a class="dropdown-item"  href="{{ route('Gallery') }}">Gallery</a></li>
          <li><a class="dropdown-item" href="{{ route('career') }}" >Opportunity</a></li>
        </ul>
      </li> 
      
       <li class="nav-item">
        <a class="nav-link" href="{{ route('Contact') }}">Contact Us</a>
      </li>
    </ul>
  </div>
</div>

<!-- Language toggle styling -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Solid/glass navbar on scroll — the nav is fixed so it stays visible
    // the whole way down the page instead of just scrolling away with the hero.
    var navbarEl = document.querySelector('.navbar');
    if (navbarEl) {
      function updateNavbarScrolled() {
        navbarEl.classList.toggle('navbar-scrolled', window.scrollY > 60);
      }
      updateNavbarScrolled();
      window.addEventListener('scroll', updateNavbarScrolled, { passive: true });
    }

    document.querySelectorAll('.lang-toggle').forEach(function (container) {
      var spa = container.querySelector('#langSpa') || container.querySelector('a[href*="language.switch"][href*="es"]');
      var eng = container.querySelector('#langEng') || container.querySelector('a[href*="language.switch"][href*="en"]');
      if (!spa || !eng) return;

      function activate(target) {
        if (target === spa) {
          spa.classList.add('lang-active');
          spa.classList.remove('lang-inactive');
          eng.classList.remove('lang-active');
          eng.classList.add('lang-inactive');
        } else {
          eng.classList.add('lang-active');
          eng.classList.remove('lang-inactive');
          spa.classList.remove('lang-active');
          spa.classList.add('lang-inactive');
        }
      }

      spa.addEventListener('click', function () { activate(spa); }, { passive: true });
      eng.addEventListener('click', function () { activate(eng); }, { passive: true });
    });
  });
</script>
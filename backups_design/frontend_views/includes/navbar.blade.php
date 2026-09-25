<!-- Bootstrap CSS is already loaded once in includes.head; this duplicate,
     older CDN copy used to load after style.css in DOM order and silently
     reset the theme's custom color tokens back to Bootstrap defaults. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<style>
  .navbar {
    background: transparent;
    border-top: 2px solid var(--gold);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    position: fixed;
    left: 0;
    width: 100%;
    top: 0px !important;
    z-index: 1000;
    padding: 1.1rem 0;
    transition: background-color 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease, padding 0.4s ease;
  }

  .navbar.navbar-scrolled {
    background: rgba(1, 15, 32, 0.94);
    backdrop-filter: blur(16px);
    border-bottom-color: rgba(201, 161, 90, 0.25);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
    padding: 0.55rem 0;
  }

  .navbar-brand-wordmark {
    display: flex;
    flex-direction: column;
    line-height: 1.1;
  }

  .navbar-brand-wordmark strong {
    font-family: var(--font-heading);
    font-size: 1.5rem;
    letter-spacing: 0.3px;
    color: #fff;
  }

  .navbar-brand-wordmark span {
    font-family: var(--font-family);
    font-size: 0.62rem;
    font-weight: 500;
    letter-spacing: 3.5px;
    text-transform: uppercase;
    color: var(--gold-light);
  }

  @media (max-width: 991.98px) {
    .navbar-brand-wordmark {
      display: none;
    }
  }

  /* Thin vertical hairline separating the brand from the primary nav */
  .navbar-divider {
    width: 1px;
    align-self: stretch;
    background: rgba(255, 255, 255, 0.18);
    margin: 0 2.25rem;
  }

  @media (max-width: 991.98px) {
    .navbar-divider {
      display: none;
    }
  }

  .navbar-book-btn {
    background: transparent !important;
    color: var(--gold-light) !important;
    font-size: 0.72rem !important;
    font-weight: 500 !important;
    letter-spacing: 2px;
    text-transform: uppercase;
    border-radius: 0 !important;
    padding: 0.6rem 1.5rem !important;
    border: 1px solid var(--gold-light) !important;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
  }

  .navbar-book-btn:hover {
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark)) !important;
    border-color: var(--gold-light) !important;
    color: var(--charcoal) !important;
  }

  /* Language switch styled like the Book Now button: one bordered,
     rectangular control instead of plain text links. */
  .lang-switch {
    display: flex;
    align-items: stretch;
    border: 1px solid var(--gold-light);
  }

  .lang-switch a {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 0.9rem;
    font-family: var(--font-family);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .lang-switch a + a {
    border-left: 1px solid var(--gold-light);
  }

  .lang-switch a:hover {
    color: #fff;
  }

  .lang-switch a.lang-active {
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    color: var(--charcoal);
  }

  .toplogo {
    width: auto;
    height: 58px;
    display: flex;
    align-items: center;
    gap: 18px;
  }

  .toplogo img {
    width: auto;
    height: 100%;
    object-fit: cover;
  }

  .header.sticky {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
  }

  .header {
    position: sticky;
    top: 0;
    background-color: #eeedf3;
    z-index: 1000;
  }

  .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.85) !important;
    font-family: var(--font-family);
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 1.6px;
    text-transform: uppercase;
    margin: 0 1.1rem;
    padding: 0.3rem 0 !important;
    position: relative;
  }

  .navbar-nav .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: -2px;
    height: 1px;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.35s ease;
  }

  .navbar-nav .nav-link:hover {
    color: var(--gold-light) !important;
    font-weight: 500;
  }

  .navbar-nav .nav-link:hover::after {
    transform: scaleX(1);
  }

  .navbar-nav .nav-link.active {
    color: var(--gold-light) !important;
    font-weight: 500;
    background: transparent !important;
  }

  .navbar-nav .nav-link.active::after {
    transform: scaleX(1);
  }

  .badge.bg-danger {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 600;
    padding: 0;
    border: 2px solid white;
  }

  .offcanvas-body .nav-link {
    font-size: 18px;
    padding: 6px 0 !important;
    color: black !important;
  }

  .offcanvas-body .nav-link:hover {
    color: var(--gold-dark);
  }

  @media (max-width: 767.98px) {
    .navbar-collapse.d-none.d-md-flex {
      display: none !important;
    }

    .lang-toggle-mobile {
      display: inline-flex !important;
      margin-right: 10px;
    }
  }

  @media (min-width: 768px) {
    .lang-toggle-mobile {
      display: none !important;
    }
  }

  @media (min-width: 992px) {
    /* Allow mega menu to be positioned relative to the full navbar width */
    .navbar .nav-item.dropdown {
      position: static;
    }
    .navbar .dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }

    .navbar .dropdown-toggle::after {
      transform: rotate(180deg);
    }
    /* Mega dropdown styles for desktop */
    /* Mega menu wrapper */
.dropdown-menu.mega-menu {
    width: 100%;
max-width: 100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 30px 0;
    background: transparent;
    border: none;
    margin-top: 20px;
}

/* Glassmorphic inner container */
.mega-menu .mega-inner {
    background: rgba(2, 31, 65, 0.55);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 28px;
    width: 100%;
    max-width: 1250px;
    margin: 0 auto;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    justify-content: center;
    gap: 22px;
    height: auto;
    border: 1px solid rgba(255,255,255,0.25);
    animation: megaFadeIn .3s ease;
}

/* Fade-in animation */
@keyframes megaFadeIn {
    from { opacity:0; transform:translateY(10px);}
    to {opacity:1; transform:translateY(0);}
}

/* Card grid */
.mega-card-grid {
    display: flex;
    gap: 22px;
    justify-content: center;
    align-items: stretch;
    width: 100%;
}

/* Actual card */
.mega-card {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 260px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 4px;
    overflow: hidden;
    text-decoration: none;
    color: #fff;

    /* Glow border */
    border: 1px solid rgba(201, 161, 90, 0.2);
    background-clip: padding-box;

    /* Shadow */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);

    /* Animation */
    transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
}

/* Hover lift + glow */
.mega-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 32px rgba(0, 0, 0, 0.3);
    border-color: var(--gold);   /* Golden glow */
}

/* Card image */
.mega-thumb {
    width: 100%;
    height: 150px;
    background-size: cover;
    background-position: center;
    border-bottom: 1px solid rgba(201, 161, 90, 0.2);
}

/* Title */
.mega-card-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 600;
    margin: 16px 18px 6px;
    color: #fff;
}

/* Description */
.mega-card-desc {
    font-size: 0.88rem;
    color: rgba(255, 255, 255, 0.55);
    margin: 0 18px 14px;
    line-height: 1.35;
}

/* Button */
.mega-card-btn {
    margin: 0 18px 18px;
    padding: 10px 12px;
    background: linear-gradient(135deg, var(--gold-light), var(--gold-dark));
    color: var(--charcoal);
    text-align: center;
    border-radius: 10px;
    font-weight: 600;
    transition: all .25s ease;
}

.mega-card-btn:hover {
    background: linear-gradient(135deg, var(--gold), var(--gold-dark));
    box-shadow: 0 4px 14px rgba(201, 161, 90, 0.45);
}

/* Premium label tag */
.mega-label {
    position: absolute;
    top: 14px;
    left: 14px;
    background: rgba(0,0,0,0.65);
    padding: 5px 12px;
    color: #fff;
    font-size: .8rem;
    font-weight: 600;
    border-radius: 50px;
    backdrop-filter: blur(6px);
}

/* Mobile responsiveness */
@media(max-width: 992px){
    .mega-menu .mega-inner {
        flex-wrap: wrap;
        height: auto;
        padding: 20px;
    }
    .mega-card {
        width: 100%;
        max-width: 350px;
    }
    .mega-thumb {
        height: 160px;
    }
}
</style>

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
<style>
  .navbar-toggler, .btn-close {
    border-color: white; /* white border */
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }
  .btn-close{
    color: white !important;
    border-color: #ef6b20;
  }
</style>

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
<style>
  .offcanvas-header {
    background: var(--primary);
    color: white;
  }

   .btn-close.white-close {
    filter: invert(1) grayscale(100%) brightness(200%);
  } 
  
</style>

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
<style>
  .lang-option {
    text-decoration: none;
    color: inherit;
    display: block;
  }
  
  .lang-option:hover {
    text-decoration: none;
    color: inherit;
  }
  
  .lang-option.lang-active {
    background: var(--gold);
    color: var(--charcoal);
  }
  
  .lang-option.lang-inactive {
    background: var(--primary);
    color: #ffffff;
  }
</style>

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
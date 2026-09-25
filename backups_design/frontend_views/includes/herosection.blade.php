
<!-- =========================================================
     PREMIUM TOUR & TRAVEL HERO SECTION
========================================================= -->

<section class="premium-travel-hero">

    <div id="heroCarousel"
         class="carousel slide carousel-fade"
         data-bs-ride="carousel"
         data-bs-interval="6000"
         data-bs-pause="false">

        <!-- =================================================
             CAROUSEL INDICATORS
        ================================================== -->

        <div class="carousel-indicators">

            @php
                $slideIndex = 0;
            @endphp

            @foreach($coverImages as $cover)

                @foreach($cover->image as $img)

                    <button
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="{{ $slideIndex }}"
                        class="{{ $slideIndex === 0 ? 'active' : '' }}"
                        aria-current="{{ $slideIndex === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $slideIndex + 1 }}">
                    </button>

                    @php
                        $slideIndex++;
                    @endphp

                @endforeach

            @endforeach

        </div>


        <!-- =================================================
             CAROUSEL SLIDES
        ================================================== -->

        <div class="carousel-inner">

            @php
                $slideIndex = 0;
            @endphp


            @foreach($coverImages as $cover)

                @foreach($cover->image as $img)

                    <div class="carousel-item
                        {{ $slideIndex === 0 ? 'active' : '' }}">

                        <!-- HERO IMAGE -->

                        <img
                            src="{{ asset('uploads/coverimage/' . $img) }}"
                            class="premium-hero-image"
                            alt="Unique Nepal Adventure">


                        <!-- DARK CINEMATIC OVERLAY -->

                        <div class="premium-overlay"></div>


                        <!-- =================================================
                             HERO CONTENT
                        ================================================== -->

                        <div class="premium-hero-content">

                            <!-- Small Label -->

                            <div class="travel-label">

                                <span></span>

                                DISCOVER NEPAL

                                <span></span>

                            </div>


                            <!-- Main Heading -->

                            <h1>

                                {{ __('messages.hero_title_outline') }}

                                <strong>
                                    {{ __('messages.hero_title_solid') }}
                                </strong>

                            </h1>

                            <span class="script-accent hero-script-accent">Adventure Awaits</span>

                            <!-- Description -->

                            <p class="hero-description">

                                {{ $cover->getTranslated('title') ?? __('messages.hero_description') }}

                            </p>


                            <!-- Buttons -->

                            <div class="hero-buttons">

                                <a
                                    href="{{ route('products.index.front') }}"
                                    class="premium-btn primary-btn">

                                    {{ __('messages.discover_now') }}

                                    <span>→</span>

                                </a>


                                <a
                                    href="{{ route('products.index.front') }}"
                                    class="premium-btn secondary-btn">

                                    View Destinations

                                </a>

                            </div>

                        </div>


                        <!-- =================================================
                             BOTTOM INFORMATION
                        ================================================== -->

                        <div class="hero-bottom-info">

                            <div>

                                <small>
                                    DESTINATION
                                </small>

                                <strong>
                                    NEPAL
                                </strong>

                            </div>

                            <div class="hero-info-divider"></div>

                            <div>

                                <small>
                                    EXPERIENCE
                                </small>

                                <strong>
                                    ADVENTURE
                                </strong>

                            </div>

                            <div class="hero-info-divider"></div>

                            <div>

                                <small>
                                    JOURNEY
                                </small>

                                <strong>
                                    UNFORGETTABLE
                                </strong>

                            </div>

                        </div>

                        <!-- Scroll cue -->
                        <div class="hero-scroll-cue">
                            <span class="hero-scroll-line"></span>
                            <span class="hero-scroll-text">SCROLL</span>
                        </div>

                    </div>


                    @php
                        $slideIndex++;
                    @endphp

                @endforeach

            @endforeach

        </div>


        <!-- =================================================
             SLIDE COUNTER
        ================================================== -->

        <div class="hero-slide-count">

            <span id="heroSlideCurrent">
                01
            </span>

            <div class="count-line"></div>

            <span>
                {{ str_pad($slideIndex, 2, '0', STR_PAD_LEFT) }}
            </span>

        </div>

    </div>

</section>



<!-- =========================================================
     PREMIUM HERO CSS
========================================================= -->

<style>

/* =========================================================
   HERO MAIN
========================================================= */

.premium-travel-hero {

    position: relative;

    width: 100%;

    height: 92vh;

    min-height: 650px;

    overflow: hidden;

    background: var(--primary-dark, #010f20);

}

/* Thin inset frame — a quiet editorial-poster touch */
.premium-travel-hero::after {

    content: "";

    position: absolute;

    inset: 22px;

    border: 1px solid rgba(255, 255, 255, 0.25);

    pointer-events: none;

    z-index: 6;

}

@media (max-width: 768px) {

    .premium-travel-hero::after {

        inset: 12px;

    }

}


/* =========================================================
   CAROUSEL
========================================================= */

.premium-travel-hero .carousel {

    width: 100%;

    height: 100%;

}

.premium-travel-hero .carousel-inner {

    width: 100%;

    height: 100%;

}

.premium-travel-hero .carousel-item {

    position: relative;

    width: 100%;

    height: 100%;

}


/* =========================================================
   HERO IMAGE
========================================================= */

.premium-hero-image {

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    object-fit: cover;

    object-position: center;

    transform: scale(1.02);

    transition:

        transform 7s ease-in-out;

}


/* IMAGE ZOOM */

.carousel-item.active .premium-hero-image {

    transform: scale(1.08);

}


/* =========================================================
   CINEMATIC OVERLAY
========================================================= */

.premium-overlay {

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    z-index: 1;

    background:

        linear-gradient(

            90deg,

            rgba(2, 15, 32, 0.90) 0%,

            rgba(2, 15, 32, 0.62) 35%,

            rgba(2, 15, 32, 0.25) 70%,

            rgba(2, 15, 32, 0.38) 100%

        ),

        linear-gradient(

            to top,

            rgba(2, 31, 65, 0.85) 0%,

            rgba(2, 31, 65, 0.20) 45%,

            transparent 75%

        );

}


/* =========================================================
   HERO CONTENT
========================================================= */

.premium-hero-content {

    position: absolute;

    top: 50%;

    left: 9%;

    transform: translateY(-50%);

    max-width: 720px;

    z-index: 5;

    color: #ffffff;

}

/* Entrance animation — each piece rises in with a short stagger the
   moment the page loads, rather than the hero just appearing static. */
.premium-hero-content > * {

    opacity: 0;

    transform: translateY(22px);

    animation: heroRise 0.9s cubic-bezier(0.16, 0.84, 0.44, 1) forwards;

}

.premium-hero-content .travel-label { animation-delay: 0.15s; }
.premium-hero-content h1 { animation-delay: 0.32s; }
.premium-hero-content .hero-script-accent { animation-delay: 0.5s; }
.premium-hero-content .hero-description { animation-delay: 0.62s; }
.premium-hero-content .hero-buttons { animation-delay: 0.78s; }

@keyframes heroRise {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    .premium-hero-content > * {
        opacity: 1;
        transform: none;
        animation: none;
    }
}


/* =========================================================
   LABEL
========================================================= */

.travel-label {

    display: flex;

    align-items: center;

    gap: 14px;

    margin-bottom: 25px;

    color: var(--gold-light, #e3c383);

    font-size: 12px;

    font-weight: 600;

    letter-spacing: 4px;

}


.travel-label span {

    width: 35px;

    height: 1px;

    background: var(--gold, #c9a15a);

    display: block;

}


/* =========================================================
   HEADING
========================================================= */

.premium-hero-content h1 {

    margin: 0;

    font-size: clamp(50px, 6vw, 88px);

    line-height: 1.02;

    font-weight: 300;

    letter-spacing: -2px;

    color: #ffffff;

}


.premium-hero-content h1 strong {

    display: block;

    font-weight: 700;

    color: var(--gold-light, #e3c383);

}

.hero-script-accent {

    display: block;

    margin: 6px 0 18px;

}


/* =========================================================
   DESCRIPTION
========================================================= */

.hero-description {

    max-width: 610px;

    margin-top: 28px;

    margin-bottom: 35px;

    font-size: 17px;

    line-height: 1.8;

    font-weight: 300;

    color: rgba(255,255,255,0.88);

}


/* =========================================================
   BUTTON CONTAINER
========================================================= */

.hero-buttons {

    display: flex;

    align-items: center;

    gap: 15px;

}


/* =========================================================
   BUTTON
========================================================= */

.premium-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 15px;

    padding: 14px 28px;

    border-radius: 2px;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    letter-spacing: 1.5px;

    transition: all 0.35s ease;

}


/* =========================================================
   PRIMARY BUTTON
========================================================= */

.primary-btn {

    background: var(--gold, #c9a15a);

    border: 1px solid var(--gold, #c9a15a);

    color: var(--primary-dark, #010f20);

}


.primary-btn span {

    font-size: 20px;

    line-height: 1;

    transition: transform 0.3s ease;

}


.primary-btn:hover {

    background: #ffffff;

    border-color: #ffffff;

    color: var(--primary-dark, #010f20);

}


.primary-btn:hover span {

    transform: translateX(5px);

}


/* =========================================================
   SECONDARY BUTTON
========================================================= */

.secondary-btn {

    background: rgba(255,255,255,0.05);

    border: 1px solid rgba(255,255,255,0.55);

    color: #ffffff;

    backdrop-filter: blur(8px);

}


.secondary-btn:hover {

    background: rgba(255,255,255,0.15);

    border-color: #ffffff;

    color: #ffffff;

}


/* =========================================================
   BOTTOM INFORMATION
========================================================= */

.hero-bottom-info {

    position: absolute;

    left: 9%;

    bottom: 45px;

    display: flex;

    align-items: center;

    gap: 60px;

    z-index: 5;

}


.hero-bottom-info div {

    display: flex;

    flex-direction: column;

    gap: 5px;

}


.hero-bottom-info small {

    font-size: 9px;

    letter-spacing: 2px;

    color: rgba(255,255,255,0.55);

}


.hero-bottom-info strong {

    font-size: 12px;

    letter-spacing: 2px;

    font-weight: 500;

    color: #ffffff;

}

.hero-info-divider {

    width: 1px;

    height: 28px;

    background: rgba(255, 255, 255, 0.2);

}

/* =========================================================
   SCROLL CUE
========================================================= */

.hero-scroll-cue {

    position: absolute;

    right: 55px;

    bottom: 100px;

    display: flex;

    flex-direction: column;

    align-items: center;

    gap: 10px;

    z-index: 5;

    color: rgba(255, 255, 255, 0.6);

}

.hero-scroll-line {

    width: 1px;

    height: 42px;

    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.05), var(--gold, #c9a15a));

    animation: heroScrollPulse 2s ease-in-out infinite;

}

.hero-scroll-text {

    font-size: 10px;

    font-weight: 600;

    letter-spacing: 3px;

}

@keyframes heroScrollPulse {
    0%, 100% { opacity: 0.4; transform: scaleY(0.85); }
    50% { opacity: 1; transform: scaleY(1); }
}

@media (max-width: 768px) {

    .hero-scroll-cue {

        display: none;

    }

}


/* =========================================================
   SLIDE COUNTER
========================================================= */

.hero-slide-count {

    position: absolute;

    right: 55px;

    bottom: 45px;

    display: flex;

    align-items: center;

    gap: 14px;

    z-index: 10;

    color: #ffffff;

    font-size: 11px;

    letter-spacing: 2px;

}


.count-line {

    width: 55px;

    height: 1px;

    background: rgba(255,255,255,0.5);

}


/* =========================================================
   BOOTSTRAP INDICATORS
========================================================= */

.carousel-indicators {

    display: none;

}


/* =========================================================
   CAROUSEL FADE
========================================================= */

.carousel-fade .carousel-item {

    opacity: 0;

    transition-property: opacity;

    transform: none;

}


.carousel-fade .carousel-item.active {

    opacity: 1;

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .premium-travel-hero {

        height: 85vh;

        min-height: 600px;

    }


    .premium-overlay {

        background:

            linear-gradient(

                to bottom,

                rgba(2, 31, 65, 0.35),

                rgba(2, 31, 65, 0.88)

            );

    }


    .premium-hero-content {

        left: 7%;

        right: 7%;

        top: 48%;

        max-width: none;

    }


    .travel-label {

        font-size: 10px;

        letter-spacing: 3px;

        gap: 10px;

    }


    .travel-label span {

        width: 25px;

    }


    .premium-hero-content h1 {

        font-size: 48px;

        letter-spacing: -1px;

    }


    .hero-description {

        font-size: 14px;

        line-height: 1.7;

        margin-top: 20px;

        margin-bottom: 25px;

    }


    .hero-buttons {

        flex-wrap: wrap;

        gap: 10px;

    }


    .premium-btn {

        padding: 12px 20px;

        font-size: 11px;

    }


    .hero-bottom-info {

        left: 7%;

        bottom: 25px;

        gap: 25px;

    }


    .hero-bottom-info > *:not(:first-child) {

        display: none;

    }


    .hero-slide-count {

        right: 20px;

        bottom: 25px;

    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .premium-travel-hero {

        min-height: 570px;

    }


    .premium-hero-content {

        top: 45%;

    }


    .premium-hero-content h1 {

        font-size: 40px;

    }


    .hero-description {

        font-size: 13px;

    }


    .secondary-btn {

        display: none;

    }


    .hero-bottom-info {

        bottom: 20px;

    }


    .hero-slide-count {

        bottom: 20px;

    }

}

</style>



<!-- =========================================================
     BOOTSTRAP 5.3
========================================================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var heroCarousel = document.getElementById('heroCarousel');
    var counterEl = document.getElementById('heroSlideCurrent');
    if (!heroCarousel || !counterEl) return;

    heroCarousel.addEventListener('slide.bs.carousel', function (event) {
      counterEl.textContent = String(event.to + 1).padStart(2, '0');
    });
  });
</script>


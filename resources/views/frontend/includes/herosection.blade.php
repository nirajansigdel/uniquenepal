
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


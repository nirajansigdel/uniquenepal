
  <!-- AOS Animation (already loaded/initialized globally in master.blade.php) -->

<style>
  .why-unique-section {
    position: relative;
    overflow: hidden;
  }
  .why-unique-section .container {
    position: relative;
    z-index: 1;
  }
  .why-card {
    width: 100%;
  }
  .why-card .icon-circle {
    flex-shrink: 0;
  }
  .why-card .card-body p {
    flex: 1;
  }
</style>

<!-- CARDS SECTION -->
<section class="py-5 section-reveal why-unique-section" style="color: rgba(255, 255, 255, 0.7);">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-20,40 C 240,110 400,-30 660,50 S 1080,150 1300,60 S 1470,-20 1500,40" />
    <circle cx="1360" cy="480" r="85" />
  </svg>
  <div class="container">
    <div class="text-center mb-5">
      <p class="heading justify-content-center">Why Unique Nepal</p>
      <p class="extralarger" style="color: #fff;">{{ __('messages.beauty_of_world') }}</p>
    </div>
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="card card-bg why-card border-0 text-center p-4">
          <div class="icon-circle">
            <i class="fas fa-plane"></i>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="fw-bold text-warning">{{ __('messages.tour_and_travel') }}</h5>
            <p class="text-muted mb-0">{{ __('messages.tour_and_travel_desc') }}</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="200">
        <div class="card card-bg why-card border-0 text-center p-4">
          <div class="icon-circle">
            <i class="fas fa-user-tie"></i>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="fw-bold text-warning">Expert Local Guides</h5>
            <p class="text-muted mb-0">Licensed, English-speaking guides who know every trail and mountain pass firsthand.</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="300">
        <div class="card card-bg why-card border-0 text-center p-4">
          <div class="icon-circle">
            <i class="fas fa-hiking"></i>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="fw-bold text-warning">{{ __('messages.adventure_tour') }}</h5>
            <p class="text-muted mb-0">{{ __('messages.adventure_tour_desc') }}</p>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-6 col-lg-3 d-flex" data-aos="fade-up" data-aos-delay="400">
        <div class="card card-bg why-card border-0 text-center p-4">
          <div class="icon-circle">
            <i class="fas fa-camera"></i>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="fw-bold text-warning">{{ __('messages.photography') }}</h5>
            <p class="text-muted mb-0">{{ __('messages.photography_desc_why') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


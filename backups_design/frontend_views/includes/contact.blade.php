<!-- ============================================================
     PLAN YOUR JOURNEY
============================================================= -->

@php
  $planCards = [
    [
      'label' => 'Solo & Couples',
      'desc' => 'Intimate journeys built for two, or a getaway just for you.',
      'card' => $couplecard->first() ?? null,
      'link' => route('products.index.front') . '?type=Couple',
    ],
    [
      'label' => 'Group Adventures',
      'desc' => 'Trek together — friends, colleagues, or a community of strangers turned family.',
      'card' => $groupcard->first() ?? null,
      'link' => route('products.index.front') . '?type=Group',
    ],
    [
      'label' => 'Festival Journeys',
      'desc' => 'Time your trip with Nepal\'s living culture and celebrations.',
      'card' => $festivaloffer->first() ?? null,
      'link' => route('products.index.front') . '?type=Festival',
    ],
  ];
@endphp

<section class="plan-journey-section section-reveal">
  <svg class="section-doodle" viewBox="0 0 1440 700" preserveAspectRatio="none" aria-hidden="true">
    <path d="M1460,610 C 1200,560 1060,660 800,600 S 380,520 150,590 S -20,650 -60,610" />
    <circle cx="90" cy="140" r="70" />
  </svg>
  <div class="container">
    <div class="text-center mb-5">
      <p class="heading justify-content-center">Plan Your Journey</p>
      <p class="extralarger mb-3" style="color: #fff;">
        {{ __('messages.start_planning') }} <span style="color: var(--gold-light);">{{ __('messages.get_discount') }}</span>
      </p>
      <p class="plan-journey-sub">{{ __('messages.contact_description') }}</p>
    </div>

    <div class="row g-4 justify-content-center">
      @foreach($planCards as $plan)
        <div class="col-md-4">
          <a href="{{ $plan['link'] }}" class="plan-card">
            <div class="plan-card-image">
              @php $img = $plan['card'] && is_array($plan['card']->images) && count($plan['card']->images) ? asset('uploads/products/' . $plan['card']->images[0]) : asset('image/destin.jpg'); @endphp
              <img src="{{ $img }}" alt="{{ $plan['label'] }}">
              <span class="plan-card-overlay"></span>
            </div>
            <div class="plan-card-body">
              <h5>{{ $plan['label'] }}</h5>
              <p>{{ $plan['desc'] }}</p>
              <span class="plan-card-cta">Explore <span>→</span></span>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('Contact') }}" class="btn cta-button px-5">{{ __('messages.book_now') }}</a>
    </div>
  </div>
</section>

<style>
  .plan-journey-section {
    position: relative;
    overflow: hidden;
    padding: 100px 0;
  }

  .plan-journey-sub {
    max-width: 620px;
    margin: 0 auto;
    color: rgba(255, 255, 255, 0.65);
    font-family: var(--font-family);
    line-height: 1.8;
  }

  .plan-card {
    display: block;
    border-radius: 14px;
    overflow: hidden;
    text-decoration: none;
    background: var(--bg-color);
    box-shadow: 0 10px 24px rgba(2, 31, 65, 0.08);
    border: 1px solid rgba(201, 161, 90, 0.15);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }

  .plan-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 36px rgba(2, 31, 65, 0.16);
  }

  .plan-card-image {
    position: relative;
    height: 200px;
  }

  .plan-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
  }

  .plan-card:hover .plan-card-image img {
    transform: scale(1.06);
  }

  .plan-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(2, 31, 65, 0.55), transparent 60%);
  }

  .plan-card-body {
    padding: 1.5rem;
  }

  .plan-card-body h5 {
    font-family: var(--font-heading);
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.5rem;
  }

  .plan-card-body p {
    font-family: var(--font-family);
    font-size: 0.9rem;
    color: #6b6a65;
    margin-bottom: 1rem;
    min-height: 42px;
  }

  .plan-card-cta {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-family);
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.4px;
    color: var(--gold-dark);
  }

  .plan-card-cta span {
    transition: transform 0.3s ease;
  }

  .plan-card:hover .plan-card-cta span {
    transform: translateX(4px);
  }
</style>

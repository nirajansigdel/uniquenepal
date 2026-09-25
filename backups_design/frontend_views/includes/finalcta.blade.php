<!-- ============================================================
     FINAL CINEMATIC CTA
============================================================= -->

@php
  $ctaBgProduct = collect($products ?? [])->first(function ($p) {
      return is_array($p->images) && count($p->images);
  });
  $ctaBgImage = $ctaBgProduct ? asset('uploads/products/' . $ctaBgProduct->images[0]) : asset('image/destin.jpg');
@endphp

<section class="final-cta-section section-reveal" style="background-image: url('{{ $ctaBgImage }}');">
  <div class="final-cta-overlay"></div>
  <div class="container position-relative text-center">
    <p class="heading justify-content-center" style="color: var(--gold-light);">Ready When You Are</p>
    <h2 class="final-cta-heading">Your Himalayan Story<br><span>Starts Here</span></h2>
    <p class="final-cta-sub">
      No two journeys are the same. Tell us where you want to go, and we'll handle the rest —
      permits, guides, logistics, and every detail in between.
    </p>
    @php
      $ctaPhone = null;
      if ($sitesetting && !empty($sitesetting->office_contact)) {
          $contacts = json_decode($sitesetting->office_contact, true);
          $ctaPhone = is_array($contacts) ? ($contacts[0] ?? null) : $sitesetting->office_contact;
      }
    @endphp
    <div class="final-cta-actions">
      <a href="{{ route('Contact') }}" class="btn cta-button px-5 py-3">Start Planning Your Trip</a>
      @if($ctaPhone)
        <a href="tel:{{ $ctaPhone }}" class="final-cta-phone">
          <i class="fas fa-phone-alt"></i> {{ $ctaPhone }}
        </a>
      @endif
    </div>
  </div>
</section>

<style>
  .final-cta-section {
    position: relative;
    padding: 140px 0;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    overflow: hidden;
  }

  .final-cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(rgba(2, 31, 65, 0.72), rgba(2, 31, 65, 0.82));
  }

  .final-cta-heading {
    position: relative;
    font-family: var(--font-heading);
    font-weight: 600;
    font-size: clamp(2.2rem, 1.6rem + 2.6vw, 3.75rem);
    color: #fff;
    line-height: 1.2;
    margin: 0 auto 1.5rem;
  }

  .final-cta-heading span {
    color: var(--gold-light);
    font-style: italic;
  }

  .final-cta-sub {
    position: relative;
    max-width: 560px;
    margin: 0 auto 2.25rem;
    color: rgba(255, 255, 255, 0.8);
    font-family: var(--font-family);
    line-height: 1.8;
  }

  .final-cta-actions {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
  }

  .final-cta-phone {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #fff;
    font-family: var(--font-family);
    font-weight: 600;
    text-decoration: none;
    border-bottom: 1px solid rgba(255, 255, 255, 0.4);
    padding-bottom: 3px;
    transition: color 0.3s ease, border-color 0.3s ease;
  }

  .final-cta-phone:hover {
    color: var(--gold-light);
    border-color: var(--gold-light);
  }

  @media (max-width: 767.98px) {
    .final-cta-section {
      padding: 90px 0;
      background-attachment: scroll;
    }
  }
</style>

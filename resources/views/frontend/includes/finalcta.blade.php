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


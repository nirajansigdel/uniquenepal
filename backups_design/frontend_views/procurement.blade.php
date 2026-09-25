@extends('frontend.layouts.master')

@section('content')

<section class="container-fluid my-5">
  <h2 class="section-title text-center mb-4">Faqs </h2>
  <div class="container">

    @forelse($faqs as $index => $faq)
      <div class="border mb-4">
        <!-- Header -->
        <div class="d-flex align-items-center procurement-header"
             data-target="content-{{ $index }}">
          <div class="procurement-check">✓</div>
          <div class="procurement-question ms-3">{{ $faq->heading }}</div>
        </div>

        <!-- Content -->
        <div id="content-{{ $index }}" class="procurement-content px-4">
          <div class="row align-items-center">
            <div class="col-md-7">
              <h4 class="fw-bold">{{ $faq->question }}</h4>
              <p class="xs-text-des">{!! nl2br(e($faq->answer)) !!}</p>
              @if(!empty($faq->image))
                <a type="button"
                        class="open-image-modal py-3 px-3 classgreen"
                        data-bs-toggle="modal"
                        data-bs-target="#imageModal"
                        data-img="{{ asset('storage/' . $faq->image) }}"
                        style="text-decoration:none;">
                  See Details
                </a>
              @endif
            </div>
            <div class="col-md-5 text-center">
              @if(!empty($faq->image))
                <img src="{{ asset('storage/' . $faq->image) }}" alt="procurement image"
                     class="img-fluid" style="max-width: 200px;">
              @endif
            </div>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted text-center">No  FAQs available.</p>
    @endforelse

  </div>
</section>

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content bg-dark text-white position-relative">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" alt="Preview" class="img-fluid" style="max-height: 70vh;">
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <a id="downloadImage" href="#" download class="btn cta-button">
          <i class="bi bi-download"></i> Download
        </a>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <i class="bi bi-x-lg"></i> Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Accordion toggle
    document.querySelectorAll('.procurement-header').forEach(header => {
      header.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const content = document.getElementById(targetId);
        const isActive = content.classList.contains('active');

        // Close all
        document.querySelectorAll('.procurement-content').forEach(c => c.classList.remove('active'));
        // Toggle current
        if (!isActive) content.classList.add('active');
      });
    });

    // Modal functionality
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const downloadLink = document.getElementById('downloadImage');

    imageModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const imgUrl = button.getAttribute('data-img');
      modalImage.src = imgUrl;
      downloadLink.href = imgUrl;
    });

    imageModal.addEventListener('hidden.bs.modal', function () {
      modalImage.src = '';
      downloadLink.href = '#';
    });
  });
</script>
@endsection
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    

@php

@endphp



@include('frontend.includes.head')

<body @if(request()->routeIs('index')) class="home-gradient-bg" @endif>


    @include('frontend.includes.navbar')

    @yield('content')
    @include('frontend.includes.footer')

    <style>
        .whatsapp-chat-container {
            position: fixed;
            bottom: 1%;
            right: 1%;
            z-index: 999;
            transition: transform 0.3s ease-in-out;
            transform: scale(1);
        }

        .whatsapp-chat {
            display: block;
        }

        .whatsapp-chat img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out;
        }

        .whatsapp-chat img:hover {
            transform: scale(1.1);
        }

        /* Ensure proper spacing between content and footer */
        .pb-8 {
            padding-bottom: 5rem !important;
        }

        .pt-8 {
            padding-top: 5rem !important;
        }

        /* Add minimum height to main content area */
        main {
            min-height: calc(100vh - 400px); /* Adjust based on your header/footer heights */
        }

        /* Ensure footer doesn't stick to content */
        .footer-spacer {
            height: 3rem;
            background: transparent;
        }

        /* Additional spacing utilities */
        .mb-footer {
            margin-bottom: 4rem !important;
        }

        .pb-footer {
            padding-bottom: 4rem !important;
        }

    
    </style>

    
    <!-- WhatsApp Chat Button -->
  <!-- WhatsApp Chat Button -->
<div class="whatsapp-chat-container" id="whatsappChatContainer">
    <a href="https://api.whatsapp.com/send?phone=9779808114909"
       target="_blank"
       rel="noopener noreferrer"
       class="whatsapp-chat"
       aria-label="Chat with us on WhatsApp">

        <i class="fab fa-whatsapp"></i>

    </a>
</div>

    <!-- Join Form Modal -->
    <div class="modal fade" id="joinFormModal" tabindex="-1" aria-labelledby="joinFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    @include('frontend.includes.joinform')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            var scrollPosition = window.scrollY;

            if (scrollPosition > 100) {
                document.getElementById('whatsappChatContainer').style.display = 'block';
            } else {
                document.getElementById('whatsappChatContainer').style.display = 'none';
            }
        });

        // Handle all "Join Now" buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listener to all elements with join-now-btn class
            document.querySelectorAll('.join-now-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const modal = new bootstrap.Modal(document.getElementById('joinFormModal'));
                    modal.show();
                });
            });
            
            // Initialize AOS (Animate On Scroll)
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true
                });
            }

            // Section-level scroll reveal: each section rises into place,
            // one by one, as it enters the viewport while scrolling.
            var sectionRevealTargets = document.querySelectorAll('.section-reveal');
            if (sectionRevealTargets.length) {
                if ('IntersectionObserver' in window) {
                    var sectionRevealObserver = new IntersectionObserver(function (entries, obs) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('in-view');
                                obs.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

                    sectionRevealTargets.forEach(function (el) {
                        sectionRevealObserver.observe(el);
                    });
                } else {
                    sectionRevealTargets.forEach(function (el) {
                        el.classList.add('in-view');
                    });
                }
            }
        });
    </script>

</body>

</html>

<STYle>
    /* ==============================
   WHATSAPP FLOATING BUTTON
============================== */

.whatsapp-chat-container {
    position: fixed;
    right: 25px;
    bottom: 25px;
    z-index: 9999;
}

.whatsapp-chat {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #25D366;
    color: #ffffff;

    border-radius: 50%;

    text-decoration: none;

    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);

    transition: all 0.3s ease;
}

.whatsapp-chat i {
    font-size: 32px;
}

.whatsapp-chat:hover {
    color: #ffffff;
    transform: scale(1.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
}


/* Mobile */

@media (max-width: 576px) {

    .whatsapp-chat-container {
        right: 15px;
        bottom: 15px;
    }

    .whatsapp-chat {
        width: 52px;
        height: 52px;
    }

    .whatsapp-chat i {
        font-size: 28px;
    }

}
</STYle>
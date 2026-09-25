

<section id="faqs" class="svw-faq-section">

    <svg class="svw-faq-doodle" viewBox="0 0 600 500" preserveAspectRatio="none" aria-hidden="true">
        <path d="M20,480 C 140,420 160,300 280,320 S 460,420 560,320" />
        <circle cx="500" cy="150" r="55" />
    </svg>

    <div class="svw-container">

        <div class="svw-faq-layout">

            {{-- =====================================================
                 LEFT SIDE
            ====================================================== --}}

            <div class="svw-faq-intro reveal">

                <span class="svw-eyebrow svw-eyebrow-left">
                    <span class="svw-eyebrow-line"></span>
                    HAVE QUESTIONS?
                </span>

                <h2>
                    Frequently Asked
                    <span>Questions</span>
                </h2>

                <p>
                    Find answers to some of the most common questions
                    about our wellness programs, Ayurvedic approach,
                    yoga, meditation, and online services.
                </p>

                <div class="svw-faq-decoration">

                    <div class="svw-faq-leaf leaf-one">
                        ✦
                    </div>

                    <div class="svw-faq-circle"></div>

                    <div class="svw-faq-leaf leaf-two">
                        ✦
                    </div>

                </div>

                <div class="svw-faq-contact">

                    <div class="svw-faq-contact-icon">
                        ?
                    </div>

                    <div>

                        <strong>
                            Still have questions?
                        </strong>

                        <span>
                            We're here to help you.
                        </span>

                    </div>

                    <a
                        href="{{ route('Contact') }}"
                        aria-label="Contact us"
                    >
                        →
                    </a>

                </div>

            </div>

            {{-- =====================================================
                 RIGHT SIDE - DATABASE FAQS
            ====================================================== --}}

            <div class="svw-faq-list reveal">

                @if(isset($faqs) && $faqs->count() > 0)

                    @foreach($faqs as $index => $item)

                        <div class="svw-faq-item {{ $index === 0 ? 'active' : '' }}">

                            <button
                                type="button"
                                class="svw-faq-question"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            >

                                <span class="svw-faq-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <span class="svw-faq-title">
                                    {{ $item->question }}
                                </span>

                                <span
                                    class="svw-faq-icon"
                                    aria-hidden="true"
                                >
                                    +
                                </span>

                            </button>

                            <div class="svw-faq-answer">

                                <div class="svw-faq-answer-inner">

                                    {!! $item->answer !!}

                                </div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <div class="svw-faq-empty">

                        <p>
                            No FAQs available at the moment.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

<script>
(function () {

    function initializeFAQs() {

        const section =
            document.getElementById('faqs');

        if (!section) {
            return;
        }

        const faqItems =
            section.querySelectorAll('.svw-faq-item');

        faqItems.forEach(function (item) {

            const button =
                item.querySelector('.svw-faq-question');

            if (!button) {
                return;
            }

            button.addEventListener('click', function () {

                const wasActive =
                    item.classList.contains('active');

                faqItems.forEach(function (faqItem) {

                    faqItem.classList.remove('active');

                    const faqButton =
                        faqItem.querySelector(
                            '.svw-faq-question'
                        );

                    if (faqButton) {

                        faqButton.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                    }

                });

                if (!wasActive) {

                    item.classList.add('active');

                    button.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | Reveal animation
        |--------------------------------------------------------------------------
        */

        const revealElements =
            section.querySelectorAll('.reveal');

        if ('IntersectionObserver' in window) {

            const observer =
                new IntersectionObserver(
                    function (entries) {

                        entries.forEach(function (entry) {

                            if (entry.isIntersecting) {

                                entry.target.classList.add(
                                    'is-visible'
                                );

                                observer.unobserve(
                                    entry.target
                                );

                            }

                        });

                    },
                    {
                        threshold: 0.08,
                        rootMargin: '0px 0px -30px 0px'
                    }
                );

            revealElements.forEach(function (element) {

                observer.observe(element);

            });

        } else {

            revealElements.forEach(function (element) {

                element.classList.add('is-visible');

            });

        }

    }

    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            initializeFAQs
        );

    } else {

        initializeFAQs();

    }

})();
</script>
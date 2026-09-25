
<style>
/* =========================================================
   FAQ SECTION — dark navy panel, matching the site's premium
   navy + gold theme
========================================================= */

.svw-faq-section {
    position: relative;
    padding: 110px 0;
    background: var(--primary-light);
    overflow: hidden;
}

/* faint decorative arc, top-left */
.svw-faq-section::before {
    content: "";
    position: absolute;
    top: -220px;
    left: -220px;
    width: 620px;
    height: 620px;
    border-radius: 50%;
    border: 1px solid rgba(201, 161, 90, 0.15);
    pointer-events: none;
}

.svw-faq-doodle {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 40%;
    max-width: 600px;
    height: 100%;
    opacity: 0.3;
    pointer-events: none;
}

.svw-faq-doodle path,
.svw-faq-doodle circle {
    fill: none;
    stroke: rgba(201, 161, 90, 0.5);
    stroke-width: 1;
}

.svw-container {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.svw-faq-layout {
    display: grid;
    grid-template-columns: 0.85fr 1.15fr;
    gap: 70px;
    align-items: start;
}

/* -------------------- Reveal animation -------------------- */

.svw-faq-section .reveal {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease-out, transform 0.7s ease-out;
}

.svw-faq-section .reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}

/* -------------------- Left: intro column -------------------- */

.svw-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: var(--font-family);
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--gold-light);
    margin-bottom: 1rem;
}

.svw-eyebrow-line {
    display: inline-block;
    width: 28px;
    height: 2px;
    background: var(--gold);
}

.svw-faq-intro h2 {
    font-family: var(--font-heading);
    font-size: clamp(2rem, 1.5rem + 2vw, 2.75rem);
    font-weight: 600;
    line-height: 1.2;
    color: #ffffff;
    margin: 0 0 1.25rem;
}

.svw-faq-intro h2 span {
    display: block;
    color: var(--gold-light);
    font-style: italic;
}

.svw-faq-intro > p {
    font-family: var(--font-family);
    color: rgba(255, 255, 255, 0.65);
    line-height: 1.8;
    max-width: 420px;
    margin: 0 0 2.5rem;
}

/* Decorative flourish */

.svw-faq-decoration {
    display: flex;
    align-items: center;
    gap: 22px;
    margin-bottom: 2.5rem;
}

.svw-faq-leaf {
    color: var(--gold);
    font-size: 1.1rem;
    opacity: 0.85;
}

.svw-faq-circle {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    border: 1px solid rgba(201, 161, 90, 0.45);
}

/* "Still have questions" callout card */

.svw-faq-contact {
    display: flex;
    align-items: center;
    gap: 18px;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(201, 161, 90, 0.25);
    color: #fff;
    border-radius: 16px;
    padding: 1.5rem;
}

.svw-faq-contact-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 1px solid rgba(201, 161, 90, 0.45);
    background: transparent;
    color: var(--gold-light);
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1.25rem;
}

.svw-faq-contact div:not(.svw-faq-contact-icon) {
    display: flex;
    flex-direction: column;
    gap: 2px;
    margin-right: auto;
}

.svw-faq-contact strong {
    font-family: var(--font-family);
    font-size: 0.95rem;
}

.svw-faq-contact span {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.55);
}

.svw-faq-contact a {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 1px solid rgba(201, 161, 90, 0.45);
    background: transparent;
    color: var(--gold-light);
    font-weight: 700;
    text-decoration: none;
    transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease;
}

.svw-faq-contact a:hover {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--primary-dark);
    transform: translateX(4px);
}

/* -------------------- Right: FAQ list -------------------- */

.svw-faq-list {
    border-top: 1px solid rgba(255, 255, 255, 0.12);
}

.svw-faq-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}

.svw-faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 22px;
    background: transparent;
    border: none;
    text-align: left;
    padding: 1.6rem 0.5rem;
    cursor: pointer;
}

.svw-faq-number {
    flex-shrink: 0;
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: 1rem;
    color: var(--gold-light);
    min-width: 28px;
}

.svw-faq-title {
    flex: 1;
    font-family: var(--font-family);
    font-weight: 600;
    font-size: 1.05rem;
    color: #fff;
    transition: color 0.3s ease;
}

.svw-faq-item.active .svw-faq-title {
    color: var(--gold-light);
}

.svw-faq-icon {
    flex-shrink: 0;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 1px solid rgba(201, 161, 90, 0.45);
    color: var(--gold-light);
    font-size: 1.1rem;
    line-height: 1;
    transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
}

.svw-faq-item.active .svw-faq-icon {
    background: var(--gold);
    border-color: var(--gold);
    color: var(--primary-dark);
    transform: rotate(135deg);
}

.svw-faq-answer {
    max-height: 0;
    opacity: 0;
    overflow: hidden;
    transition: max-height 0.45s ease, opacity 0.35s ease;
}

.svw-faq-item.active .svw-faq-answer {
    max-height: 600px;
    opacity: 1;
}

.svw-faq-answer-inner {
    padding: 0 0.5rem 1.6rem 3.75rem;
    font-family: var(--font-family);
    color: rgba(255, 255, 255, 0.6);
    line-height: 1.75;
}

.svw-faq-empty {
    text-align: center;
    padding: 3rem 1.5rem;
    color: rgba(255, 255, 255, 0.6);
    background: rgba(255, 255, 255, 0.03);
    border: 1px dashed rgba(201, 161, 90, 0.35);
    border-radius: 12px;
}

/* -------------------- Responsive -------------------- */

@media (max-width: 900px) {
    .svw-faq-section {
        padding: 70px 0;
    }

    .svw-faq-layout {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .svw-faq-intro > p {
        max-width: none;
    }
}

@media (max-width: 480px) {
    .svw-faq-question {
        gap: 12px;
        padding: 1.1rem 1.1rem;
    }

    .svw-faq-answer-inner {
        padding-left: 1.1rem;
    }
}
</style>

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
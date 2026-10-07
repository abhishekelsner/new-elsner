<?php
/**
 * Pricing FAQ Section
 * ACF Fields: title (Text), faq (Repeater) -> question (Text), answer (Text)
 */

$title = get_sub_field('title');
$faqs  = get_sub_field('faq');

if ( ! $faqs ) return;
?>

<section class="pricing-faq">
    <div class="pricing-faq__container container">

        <?php if ( $title ) : ?>
            <h2 class="pricing-faq__title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <!-- Left rail: vertical blue line + red dots -->
        <div class="pricing-faq__layout">

            <div class="pricing-faq__rail">
                <div class="pricing-faq__rail-line"></div>
            </div>

            <div class="pricing-faq__list">
                <?php foreach ( $faqs as $index => $item ) :
                    $question = $item['question'] ?? '';
                    $answer   = $item['answer']   ?? '';
                    if ( ! $question ) continue;
                    $is_first = ( $index === 0 );
                ?>
                <div class="pricing-faq__item<?php echo $is_first ? ' pricing-faq__item--open' : ''; ?>"
                    data-faq-item
                    data-faq-index="<?php echo $index; ?>">

                    <!-- dot is NOW inside the item, not the rail -->
                    <span class="pricing-faq__dot" data-faq-dot="<?php echo $index; ?>"></span>

                    <div class="pricing-faq__accent-bar"></div>

                    <button class="pricing-faq__trigger"
                            aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                            data-faq-trigger>
                        <span class="pricing-faq__question"><?php echo esc_html( $question ); ?></span>
                        <span class="pricing-faq__chevron" aria-hidden="true">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6L8 11L13 6" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </button>

                    <div class="pricing-faq__body" data-faq-body>
                        <div class="pricing-faq__answer">
                            <?php echo wp_kses_post( $answer ); ?>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</section>

<script>
(function () {
    'use strict';

    const OPEN_CLASS = 'pricing-faq__item--open';

    function positionDots(section) {
        const items = section.querySelectorAll('[data-faq-item]');
        const rail  = section.querySelector('.pricing-faq__rail');
        if (!rail) return;

        const railTop = rail.getBoundingClientRect().top + window.scrollY;

        items.forEach(function (item) {
            const idx  = parseInt(item.dataset.faqIndex, 10);
            const dot  = rail.querySelector('[data-faq-dot="' + idx + '"]');
            if (!dot) return;

            const trigger  = item.querySelector('[data-faq-trigger]');
            const itemTop  = item.getBoundingClientRect().top + window.scrollY;
            const triggerH = trigger ? trigger.offsetHeight : 60;

            const dotTop = (itemTop - railTop) + (triggerH / 2) - 4.5;
            dot.style.top = dotTop + 'px';
        });
    }

    function initFaq(section) {
        const items = section.querySelectorAll('[data-faq-item]');
        const rail  = section.querySelector('.pricing-faq__rail');

        // Set initial open item height
        items.forEach(function (item) {
            const body = item.querySelector('[data-faq-body]');
            if (item.classList.contains(OPEN_CLASS)) {
                body.style.maxHeight = body.scrollHeight + 'px';
            }
        });

        // Double rAF ensures browser has fully painted before measuring
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                positionDots(section);
            });
        });

        window.addEventListener('resize', function () { positionDots(section); });
        window.addEventListener('load',   function () { positionDots(section); });

        section.addEventListener('click', function (e) {
        const trigger = e.target.closest('[data-faq-trigger]');
        if (!trigger) return;

        const item   = trigger.closest('[data-faq-item]');
        const body   = item.querySelector('[data-faq-body]');
        const isOpen = item.classList.contains(OPEN_CLASS);

        // Close all
        items.forEach(function (el) {
            el.classList.remove(OPEN_CLASS);
            el.querySelector('[data-faq-trigger]').setAttribute('aria-expanded', 'false');
            el.querySelector('[data-faq-body]').style.maxHeight = '0';

            const dotIdx = el.dataset.faqIndex;
            const dot    = rail ? rail.querySelector('[data-faq-dot="' + dotIdx + '"]') : null;
            if (dot) dot.classList.remove('is-active');
        });

        // Open clicked
        if (!isOpen) {
            item.classList.add(OPEN_CLASS);
            trigger.setAttribute('aria-expanded', 'true');
            body.style.maxHeight = body.scrollHeight + 'px';

            const dotIdx = item.dataset.faqIndex;
            const dot    = rail ? rail.querySelector('[data-faq-dot="' + dotIdx + '"]') : null;
            if (dot) dot.classList.add('is-active');
        }

        // Animate dots continuously during the transition (every 16ms = 60fps)
        const duration = 350;
        const start    = performance.now();

        function animateDots(now) {
            positionDots(section);
            if (now - start < duration) {
                requestAnimationFrame(animateDots);
            }
        }

        requestAnimationFrame(animateDots);
    });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.pricing-faq').forEach(initFaq);
        });
    } else {
        document.querySelectorAll('.pricing-faq').forEach(initFaq);
    }
})();
</script>
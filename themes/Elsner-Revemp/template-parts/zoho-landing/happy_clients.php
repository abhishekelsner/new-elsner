<?php
/**
 * Flexible Content Layout: Happy Clients Testimonials
 * File: template-parts/flexible/happy_clients.php
 *
 * NOTE: All testimonials are rendered in the DOM.
 * Your existing slider/drag JS handles display.
 */

$heading      = get_sub_field('heading');
$testimonials = get_sub_field('testimonials');

if (!$testimonials) return;
?>

<style>
</style>

<section class="lp-happy">
    <div class="lp-container container">

        <?php if ($heading) : ?>
            <div class="lp-happy__header">
                <h2 class="lp-happy__heading"><?php echo esc_html($heading); ?></h2>
            </div>
        <?php endif; ?>

        <div class="lp-happy__slider-wrap">
            <!-- All items rendered — your existing slider JS handles drag/display -->
            <div class="lp-happy__slider">
                <?php foreach ($testimonials as $testimonial_post) :

                    $testimonial_id = $testimonial_post->ID;

                    $name   = get_the_title($testimonial_id);
                    $text   = get_post_field('post_content', $testimonial_id);

                    $photo  = get_field('client_photo', $testimonial_id);
                    $rating = get_field('rating', $testimonial_id);

                    $initial = $name ? strtoupper(substr($name, 0, 1)) : '?';

                ?>
                    <div class="lp-happy__card">

                        <?php if ($rating) : ?>
                            <div class="lp-happy__stars" aria-label="<?php echo esc_attr($rating); ?> out of 5 stars">
                                <?php for ($s = 1; $s <= 5; $s++) : ?>
                                    <span class="lp-happy__star <?php echo $s > $rating ? 'lp-happy__star--empty' : ''; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="lp-happy__text"><?php echo esc_html(wp_trim_words($text, 25, '...')); ?></p>
                        <?php endif; ?>

                        <div class="lp-happy__author">

                            <?php if (!empty($photo)) : ?>
                                <img
                                    class="lp-happy__author-photo"
                                    src="<?php echo esc_url($photo['url']); ?>"
                                    alt="<?php echo esc_attr($photo['alt'] ?: $name); ?>">
                            <?php else : ?>
                                <div class="lp-happy__author-placeholder">
                                    <?php echo esc_html($initial); ?>
                                </div>
                            <?php endif; ?>

                            <p class="lp-happy__author-name">
                                <?php echo esc_html($name); ?>
                            </p>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
<!-- Slick CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" integrity="sha384-MUdXdzn1OB/0zkr4yGLnCqZ/n9ut5N7Ifes9RP2d5xKsTtcPiuiwthWczWuiqFOn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" integrity="sha384-3wRRg17hVCopINZVYCqnfbgXE7aFPSvawmLWNPSiUPVx+HxY+yxb5Cwp5mT7RXPD" crossorigin="anonymous">

<!-- jQuery (only if not already loaded by WordPress theme) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<!-- Slick JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" integrity="sha384-YGnnOBKslPJVs35GG0TtAZ4uO7BHpHlqJhs0XK3k6cuVb6EBtl+8xcvIIOKV5wB+" crossorigin="anonymous"></script>
<!-- Init -->
<script>
window.addEventListener('load', function () {

    if (typeof jQuery === 'undefined' || typeof jQuery.fn.slick === 'undefined') {
        console.log('jQuery or Slick not loaded');
        return;
    }

    jQuery('.lp-happy__slider').each(function () {

        if (!jQuery(this).hasClass('slick-initialized')) {

            jQuery(this).slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    { breakpoint: 1100, settings: { slidesToShow: 3 } },
                    { breakpoint: 760, settings: { slidesToShow: 2 } },
                    { breakpoint: 520, settings: { slidesToShow: 1 } }
                ]
            });

        }

    });

});
</script>

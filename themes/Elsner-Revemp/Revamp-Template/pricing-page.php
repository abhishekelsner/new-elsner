<?php
/**
 * Template Name: Pricing Page
 * @package YourTheme
 */

get_header(); ?>

<main id="primary" class="pricing-page">

    <?php
    while ( have_rows( 'pricing_page' ) ) : the_row();
        get_template_part( 'template-parts/pricing-page/' . get_row_layout() );
    endwhile;
    ?>

</main>

<?php get_footer();
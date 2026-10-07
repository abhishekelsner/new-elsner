<?php
/**
 * Template Name: Landing Page (No Nav)
 *
 * Uses default theme header/footer.
 * Renders ACF flexible content sections from template-parts/zoho-landing/.
 */
get_header();
?>

<main id="lp-main">
    <?php
    if (have_rows('landing_page_sections')) :
        while (have_rows('landing_page_sections')) : the_row();

            $layout   = get_row_layout();
            $template = get_template_directory() . "/template-parts/zoho-landing/{$layout}.php";

            if (file_exists($template)) {
                include $template;
            } elseif (defined('WP_DEBUG') && WP_DEBUG) {
                echo "<!-- Missing flexible template: {$layout}.php -->";
            }

        endwhile;
    endif;
    ?>
</main>

<?php
get_footer();
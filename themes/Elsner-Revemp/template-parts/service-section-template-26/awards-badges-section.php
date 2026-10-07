<?php
/**
 * Section: Awards & Badges
 * Layout key: awards_badges_section
 *
 * Badge images come from the ACF Options panel (global).
 * An optional title override can be set per-page in the layout.
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout        = $args['layout'];
$title_override = $layout['awards_section_title'] ?? '';
$section_title  = $title_override ?: 'Awards & Recognition';

if ( ! function_exists( 'have_rows' ) ) {
    return;
}

if ( ! have_rows( 'clutch_badges_repeater_section', 'option' ) ) {
    return;
}
?>

<section class="awards-badges-section">
    <div class="clutch-badges">

        <div class="block-title text-center max-700">
            <h2><?php echo esc_html( $section_title ); ?></h2>
        </div>

        <div class="row clutch-badges-slider slick-slider">
            <?php while ( have_rows( 'clutch_badges_repeater_section', 'option' ) ) : the_row();
                $image_id = get_sub_field( 'clutch_badges_images', 'option' );
                if ( ! $image_id ) {
                    continue;
                }
                $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            ?>
                <div class="clutch-awards-badges">
                    <div class="clutch-badges-image">
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php echo esc_attr( $image_alt ); ?>"
                             title="<?php echo esc_attr( $image_alt ); ?>"
                             width="450"
                             height="550"
                             loading="lazy">
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
</section>

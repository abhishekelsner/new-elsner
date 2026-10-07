<?php
/**
 * Section: B2B CTA
 * Layout key: b2b_cta_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout      = $args['layout'];
$title       = $layout['b2b_cta_title']       ?? '';
$button_name = $layout['b2b_cta_button_name'] ?? '';
$image_url   = $layout['b2b_cta_image']       ?? '';

if ( ! $title && ! $button_name ) {
    return;
}
?>

<section class="get-touch b2b-get-in-touch">
    <div class="container">
        <div class="row alinc">

            <div class="col-md-7">
                <div class="brew-content">
                    <?php if ( $title ) : ?>
                        <h2><?php echo wp_kses_post( $title ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $button_name ) : ?>
                        <a href="#b2b-contact-form" class="btn btn-secondary">
                            <?php echo esc_html( $button_name ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( $image_url ) : ?>
                <div class="col-md-5 b2b-cta-bg-image">
                    <div class="brew-gif">
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php echo esc_attr( $title ); ?>">
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

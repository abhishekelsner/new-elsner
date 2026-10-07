<?php
/**
 * Section: B2B Contact / Form
 * Layout key: b2b_contact_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout             = $args['layout'];
$heading            = $layout['b2b_contact_heading']      ?? '';
$description        = $layout['b2b_contact_description']  ?? '';
$commitment_text    = $layout['b2b_commitment_text']      ?? '';
$commitment_points  = $layout['b2b_commitment_repeater']  ?? array();
$form_shortcode     = $layout['b2b_contact_form']         ?? '';

if ( ! $heading && ! $form_shortcode ) {
    return;
}
?>

<section class="services-banner maintenance-banner b2b-contact-block" id="b2b-contact-form">
    <div class="container">
        <div class="row">

            <div class="col-md-5 b2b-contact-left">
                <div class="services-heading">

                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/b2b-marketing/contact-smile.png' ); ?>"
                         alt="">

                    <?php if ( $heading ) : ?>
                        <h2><?php echo wp_kses_post( $heading ); ?></h2>
                    <?php endif; ?>

                    <?php if ( $description ) : ?>
                        <p><?php echo wp_kses_post( $description ); ?></p>
                    <?php endif; ?>

                    <?php if ( $commitment_text || ! empty( $commitment_points ) ) : ?>
                        <div class="b2b-commitment">
                            <?php if ( $commitment_text ) : ?>
                                <h3><?php echo esc_html( $commitment_text ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $commitment_points ) ) : ?>
                                <ul>
                                    <?php foreach ( $commitment_points as $point ) :
                                        $point_title = $point['b2b_commitment_repeater_title'] ?? '';
                                    ?>
                                        <?php if ( $point_title ) : ?>
                                            <li><?php echo esc_html( $point_title ); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-md-7 b2b-contact-right">
                <div class="b2b-form">
                    <?php if ( $form_shortcode ) : ?>
                        <?php echo do_shortcode( $form_shortcode ); ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

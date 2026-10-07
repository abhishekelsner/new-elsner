<?php
/**
 * Section: Banner
 * Layout key: banner_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$banner_title           = $layout['banner_title'] ?? '';
$bg_image_id            = $layout['service_background_image'] ?? '';
$service_image_id       = $layout['service_image'] ?? '';
$service_image_alt      = $layout['service_image_alt_tag'] ?? '';
$label_image_1          = $layout['services_label_images'] ?? '';
$label_image_2          = $layout['services_label_images2'] ?? '';
$banner_button_text  = $layout[ 'banner_button_text' ] ?? '';
$banner_button_link  = $layout[ 'banner_button_link'] ?? '';

// Resolve background image URL.
$bg_image_url = '';
if ( $bg_image_id ) {
    $bg_src       = wp_get_attachment_image_src( $bg_image_id, 'full' );
    $bg_image_url = $bg_src ? $bg_src[0] : '';
}

// Resolve service image.
$service_image_url = '';
if ( $service_image_id ) {
    $img_src           = wp_get_attachment_image_src( $service_image_id, 'full' );
    $service_image_url = $img_src ? $img_src[0] : '';

    // Fall back to alt text stored in attachment meta if not explicitly set.
    if ( empty( $service_image_alt ) ) {
        $service_image_alt = get_post_meta( $service_image_id, '_wp_attachment_image_alt', true );
    }
}
?>

<section class="services-banner">

    <?php if ( $bg_image_url ) : ?>
        <img class="service-bg"
             src="<?php echo esc_url( $bg_image_url ); ?>"
             alt=""
             role="presentation"
             width="1920"
             height="1080">
    <?php endif; ?>

    <div class="container-full">
        <div class="row alinc">

            <div class="col-md-6">
                <div class="services-heading">

                    <div class="breadcrumb-wrapper">
                        <?php
                        if ( function_exists( 'custom_breadcrumbs' ) ) {
                            custom_breadcrumbs();
                        }
                        ?>
                    </div>

                    <?php if ( $banner_title ) : ?>
                        <h1><?php echo wp_kses_post( $banner_title ); ?></h1>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>

                    <a href="<?php echo esc_url( $banner_button_link ); ?>"
                       class="btn btn-primary">
                        <?php echo esc_html( $banner_button_text ); ?>
                    </a>

                    <?php if ( $label_image_1 || $label_image_2 ) : ?>
                        <div class="service-label">
                            <?php if ( $label_image_1 ) : ?>
                                <img src="<?php echo esc_url( $label_image_1 ); ?>"
                                     alt="service labels"
                                     width="500"
                                     height="88"
                                     loading="lazy">
                            <?php endif; ?>
                            <?php if ( $label_image_2 ) : ?>
                                <img src="<?php echo esc_url( $label_image_2 ); ?>"
                                     alt="service labels"
                                     width="500"
                                     height="88"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div><!-- .col-md-6 left -->

            <div class="col-md-6">
                <?php if ( $is_ai_landing ) : ?>
                    <div class="ai-new-ppc-landing-form-wrapper">
                        <div class="ai-new-ppc-landing-form">
                            <?php echo do_shortcode( $lead_form_shortcode ); ?>
                        </div>
                    </div>
                <?php elseif ( $service_image_url ) : ?>
                    <div class="services-image">
                        <img src="<?php echo esc_url( $service_image_url ); ?>"
                             alt="<?php echo esc_attr( $service_image_alt ); ?>"
                             width="1200"
                             height="920"
                             loading="lazy">
                    </div>
                <?php endif; ?>
            </div><!-- .col-md-6 right -->

        </div>
    </div>
</section>

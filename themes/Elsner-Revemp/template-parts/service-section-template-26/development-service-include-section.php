<?php
/**
 * Section: Development Service Include
 * Layout key: development_service_include_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout          = $args['layout'];
$heading         = $layout['service_list_heading'] ?? '';
$service_items   = $layout['service_list_item'] ?? array();

if ( empty( $service_items ) ) {
    return;
}
?>

<section class="services-section padding-80">
    <div class="container">

        <?php if ( $heading ) : ?>
            <div class="block-title text-center max-700">
                <h2><?php echo wp_kses_post( $heading ); ?></h2>
            </div>
        <?php endif; ?>

        <div class="service-wrapper">
            <div class="row">
                <?php foreach ( $service_items as $service ) :
                    $image_url = $service['service_list_image'] ?? '';
                    $title     = $service['service_list_title'] ?? '';
                    $text      = $service['service_list_text'] ?? '';
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="service-list-item">

                            <?php if ( $image_url ) : ?>
                                <div class="service-list-image">
                                    <img src="<?php echo esc_url( $image_url ); ?>"
                                         alt="<?php echo esc_attr( $title ); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="service-list-content">
                                <?php if ( $title ) : ?>
                                    <h4><?php echo esc_html( $title ); ?></h4>
                                <?php endif; ?>
                                <?php if ( $text ) : ?>
                                    <p><?php echo esc_html( $text ); ?></p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

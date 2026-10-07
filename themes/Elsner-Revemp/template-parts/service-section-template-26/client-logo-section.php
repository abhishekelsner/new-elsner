<?php
/**
 * Section: Client Logo
 * Layout key: client_logo_section
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$layout       = $args['layout'];
$client_title = $layout['client_title'] ?? '';
$client_logos = $layout['clients_logo_item'] ?? array();

if ( empty( $client_logos ) ) {
    return;
}
?>

<div class="container">
    <div class="clients-logo-wrapper">

        <?php if ( $client_title ) : ?>
            <div class="client-tile">
                <h3><?php echo esc_html( $client_title ); ?></h3>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php foreach ( $client_logos as $logo ) :
                $logo_image      = $logo['logos'] ?? array();
                $logo_hover      = $logo['logo_hover_logo'] ?? array();
                $default_url     = $logo_image['url'] ?? '';
                $default_alt     = $logo_image['alt'] ?? '';
                $hover_url       = $logo_hover['url'] ?? '';
            ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 w-slide">
                    <div class="client-logo">
                        <?php if ( $default_url && $hover_url ) : ?>
                            <img class="default-logo"
                                 src="<?php echo esc_url( $default_url ); ?>"
                                 alt="<?php echo esc_attr( $default_alt ); ?>"
                                 data-hover="<?php echo esc_url( $hover_url ); ?>"
                                 data-default="<?php echo esc_url( $default_url ); ?>">
                        <?php elseif ( $default_url ) : ?>
                            <img src="<?php echo esc_url( $default_url ); ?>"
                                 alt="<?php echo esc_attr( $default_alt ); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

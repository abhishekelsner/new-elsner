<?php

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$cta_title        = $layout['title']            ?? '';
$cta_button_text  = $layout['button_text']      ?? '';
$cta_button_link  = $layout['button_link']['url']      ?? '';  // ACF URL field — returns plain string
$cta_image        = $layout['image']            ?? '';
$background_image = $layout['background_image'] ?? '';

// ACF image fields — handle both URL string and array return formats.
$bg_image_url  = is_array( $background_image ) ? ( $background_image['url'] ?? '' ) : $background_image;
$cta_image_url = is_array( $cta_image )        ? ( $cta_image['url']        ?? '' ) : $cta_image;
?>

<section class="cta-banner">
    <div class="container">
        <div class="cta-banner__inner"
            <?php if ( $bg_image_url ) : ?>
                style="background-image: url('<?php echo esc_url( $bg_image_url ); ?>');"
            <?php endif; ?>>

            <div class="cta-banner__content">

                <?php if ( $cta_title ) : ?>
                    <h2 class="cta-banner__title">
                        <?php echo wp_kses_post( $cta_title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $cta_button_text && $cta_button_link ) : ?>
                    <a href="<?php echo esc_url( $cta_button_link ); ?>"
                       class="btn btn-cta">
                        <?php echo esc_html( $cta_button_text ); ?>
                    </a>
                <?php endif; ?>

            </div><!-- .cta-banner__content -->

            <?php if ( $cta_image_url ) : ?>
                <div class="cta-banner__image">
                    <img src="<?php echo esc_url( $cta_image_url ); ?>"
                         alt="Development"
                         width="500"
                         height="400"
                         loading="lazy">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php
/**
 * Flexible Content Layout: Pricing Clients
 * ACF Fields: title (text), images (repeater > image)
 */

$title  = get_sub_field( 'title' );
$images = get_sub_field( 'images' );
?>

<section class="pc-clients">
    <?php if ( $title ) : ?>
        <h2 class="pc-clients__title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <?php if ( $images ) : ?>
        <div class="pc-clients__grid container">
            <?php foreach ( $images as $row ) :
                $img = $row['image'];
                if ( ! $img ) continue;
                $src = is_array( $img ) ? $img['url'] : wp_get_attachment_image_url( $img, 'medium' );
                $alt = is_array( $img ) ? $img['alt'] : get_post_meta( $img, '_wp_attachment_image_alt', true );
            ?>
                <div class="pc-clients__item">
                    <img src="<?php echo esc_url( $src ); ?>"
                         alt="<?php echo esc_attr( $alt ); ?>"
                         loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
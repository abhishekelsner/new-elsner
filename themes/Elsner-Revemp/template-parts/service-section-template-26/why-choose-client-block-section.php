<?php
/**
 * Section: Why Choose
 * Layout key: why_choose
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$title       = $layout['title']              ?? '';
$description = $layout['description']        ?? '';
$button_text = $layout['button_text']        ?? '';
$button_link = $layout['button_link']['url'] ?? '';
$image       = $layout['image']              ?? '';
$stats       = $layout['client_block']              ?? []; // Repeater: number, text

// Resolve image — ACF image field returns array.
$image_url = is_array( $image ) ? ( $image['url'] ?? '' ) : $image;
$image_alt = is_array( $image ) ? ( $image['alt'] ?? '' ) : '';

$stats_count = count( $stats );
?>

<section class="why-choose">
    <div class="container">
        <div class="why-choose__inner">

            <div class="why-choose__content">

                <?php if ( $title ) : ?>
                    <h2 class="why-choose__title">
                        <?php echo wp_kses_post( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $description ) : ?>
                    <p class="why-choose__description">
                        <?php echo wp_kses_post( $description ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( $button_text && $button_link ) : ?>
                    <a href="<?php echo esc_url( $button_link ); ?>"
                       class="btn btn-secondary">
                        <?php echo esc_html( $button_text ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( ! empty( $stats ) ) : ?>
                    <div class="why-choose__client-block">
                        <?php foreach ( $stats as $index => $stat ) :
                            $number  = $stat['number'] ?? '';
                            $label   = $stat['text']   ?? '';
                            $is_last = ( $index === $stats_count - 1 );
                        ?>
                            <div class="why-choose__client-item <?php echo $is_last ? 'why-choose__client-item--last' : ''; ?>">

                                <?php if ( $number ) : ?>
                                    <span class="why-choose__client-number">
                                        <?php echo esc_html( $number ); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ( $label ) : ?>
                                    <span class="why-choose__client-label">
                                        <?php echo esc_html( $label ); ?>
                                    </span>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div><!-- .why-choose__content -->

            <?php if ( $image_url ) : ?>
                <div class="why-choose__image">
                    <img src="<?php echo esc_url( $image_url ); ?>"
                         alt="<?php echo esc_attr( $image_alt ); ?>"
                         width="600"
                         height="480"
                         loading="lazy">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
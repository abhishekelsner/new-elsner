<?php
/**
 * Section: Development Services
 * Layout key: development_service
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$section_title = $layout['title'] ?? '';
$cards         = $layout['card_section']  ?? [];
?>

<section class="development-services">
    <div class="container">

        <?php if ( $section_title ) : ?>
            <div class="development-services__heading">
                <h2><?php echo wp_kses_post( $section_title ); ?></h2>
                <span class="heading-underline"></span>
            </div>
        <?php endif; ?>

        <?php if ( ! empty( $cards ) ) : ?>
            <div class="development-services__grid">
                <?php foreach ( $cards as $card ) :
                    $icon     = $card['icon']        ?? '';
                    $card_title  = $card['title']        ?? '';
                    $description = $card['description']  ?? '';

                    $icon_url = $icon['url'] ?? '';
                    $alt = $icon['alt'] ?? $card_title;
                ?>
                    <div class="service-card">

                        <?php if ( $icon_url ) : ?>
                            <div class="service-card__icon">
                                <img src="<?php echo esc_url( $icon_url ); ?>"
                                     alt="<?php echo esc_attr( $card_title ); ?>"
                                     width="48"
                                     height="48"
                                     loading="lazy">
                            </div>
                        <?php endif; ?>

                        <?php if ( $card_title ) : ?>
                            <h3 class="service-card__title">
                                <?php echo esc_html( $card_title ); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( $description ) : ?>
                            <div class="service-card__description">
                                <?php echo wp_kses_post( $description ); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

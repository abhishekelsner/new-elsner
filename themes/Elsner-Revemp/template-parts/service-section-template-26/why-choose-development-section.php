<?php
/**
 * Section: Why Choose Development
 * Layout key: why_choose_development
 *
 * @var array $args['post_id'] int
 * @var array $args['layout']  ACF flexible content row
 */

$post_id = $args['post_id'];
$layout  = $args['layout'];

// Field values from layout row.
$title            = $layout['title']            ?? '';
$description      = $layout['description']      ?? '';
$development_list = $layout['development_list'] ?? []; // Repeater: title, description
?>

<section class="why-development">
    <div class="container">

        <div class="why-development__header">
            <?php if ( $title ) : ?>
                <h2 class="why-development__title">
                    <?php echo wp_kses_post( $title ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( $description ) : ?>
                <p class="why-development__description">
                    <?php echo wp_kses_post( $description ); ?>
                </p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $development_list ) ) : ?>
            <div class="why-development__grid">
                <?php foreach ( $development_list as $item ) :
                    $item_title = $item['title']       ?? '';
                    $item_desc  = $item['description'] ?? '';
                ?>
                    <div class="why-development__card">
                        <?php if ( $item_title ) : ?>
                            <h3 class="why-development__card-title">
                                <?php echo esc_html( $item_title ); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( $item_desc ) : ?>
                            <div class="why-development__card-description">
                                <?php echo wp_kses_post( $item_desc ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
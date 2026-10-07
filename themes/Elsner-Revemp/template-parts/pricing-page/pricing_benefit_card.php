<?php
/**
 * Pricing Benefit Card Section
 * ACF Fields: title (Text), benefit_card (Repeater) -> image (Image), title (Text), content (Text)
 */

$title = get_sub_field('title');
$cards = get_sub_field('benefit_card');

if ( ! $cards ) return;
?>

<section class="benefit-cards">
    <div class="benefit-cards__container container">

        <?php if ( $title ) : ?>
            <h2 class="benefit-cards__title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="benefit-cards__grid">
            <?php foreach ( $cards as $card ) :
                $image   = $card['image']   ?? '';
                $heading = $card['title']   ?? '';
                $content = $card['content'] ?? '';
            ?>
            <div class="benefit-cards__card">
                <?php if ( $image ) : ?>
                <div class="benefit-cards__icon">
                    <img src="<?php echo esc_url( is_array($image) ? $image['url'] : $image ); ?>"
                         alt="<?php echo esc_attr( is_array($image) ? $image['alt'] : '' ); ?>"
                         width="48" height="48" loading="lazy">
                </div>
                <?php endif; ?>

                <?php if ( $heading ) : ?>
                <h3 class="benefit-cards__card-title"><?php echo esc_html( $heading ); ?></h3>
                <?php endif; ?>

                <?php if ( $content ) : ?>
                <p class="benefit-cards__card-content"><?php echo esc_html( $content ); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

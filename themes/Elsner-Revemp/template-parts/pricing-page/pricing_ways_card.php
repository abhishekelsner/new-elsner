<?php
/**
 * Pricing Ways Card Section
 * ACF Fields: title (Text), ways_card (Repeater) -> image (Image), title (Text), content (Text), link (Link)
 */

$title = get_sub_field('title');
$cards = get_sub_field('ways_card');

if ( ! $cards ) return;
?>

<section class="ways-cards">
    <div class="ways-cards__container container">

        <?php if ( $title ) : ?>
            <h2 class="ways-cards__title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <div class="ways-cards__grid">
            <?php foreach ( $cards as $card ) :
                $image   = $card['image']   ?? '';
                $heading = $card['title']   ?? '';
                $content = $card['content'] ?? '';
                $link    = $card['link']    ?? '';

                $link_url    = is_array($link) ? $link['url']    : $link;
                $link_title  = is_array($link) ? $link['title']  : 'View Solution';
                $link_target = is_array($link) ? $link['target'] : '_self';
                $link_title  = $link_title ?: 'View Solution';
            ?>
            <div class="ways-cards__card">

                <!-- Blue left accent bar -->
                <div class="ways-cards__accent"></div>

                <!-- Icon -->
                <?php if ( $image ) : ?>
                <div class="ways-cards__icon">
                    <img src="<?php echo esc_url( is_array($image) ? $image['url'] : $image ); ?>"
                         alt="<?php echo esc_attr( is_array($image) ? $image['alt'] : '' ); ?>"
                         width="40" height="40" loading="lazy">
                </div>
                <?php endif; ?>

                <!-- Title -->
                <?php if ( $heading ) : ?>
                <h3 class="ways-cards__card-title"><?php echo esc_html( $heading ); ?></h3>
                <?php endif; ?>

                <!-- Content -->
                <?php if ( $content ) : ?>
                <p class="ways-cards__card-content"><?php echo esc_html( $content ); ?></p>
                <?php endif; ?>

                <!-- Link -->
                <?php if ( $link_url ) : ?>
                <a class="ways-cards__link"
                   href="<?php echo esc_url( $link_url ); ?>"
                   target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?> &rarr;
                </a>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
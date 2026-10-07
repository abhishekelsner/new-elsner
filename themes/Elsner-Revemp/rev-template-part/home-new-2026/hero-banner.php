<?php
/**
 * Page Builder Layout: Hero Banner (hero_banner)
 * Fields: badge_text, heading (wysiwyg), description, cta_buttons (repeater:
 *   label, url, style), rating_review (group: review_platform_icons repeater
 *   [icon], rating_value, review_text), background_video (file),
 *   hero_image_top, hero_image_center, hero_image_bottom (image)
 *
 * Fully standalone — no functions, no closures, no shared files.
 * Assumes ACF image fields use the default "Array" return format
 * (ACF → your field group → each image field → Return Format = Array).
 * That gives you $field['url'] and $field['alt'] directly, no lookup needed.
 */

$badge_text  = get_sub_field( 'badge_text' );
$heading     = get_sub_field( 'heading' ); // wysiwyg, output raw
$description = get_sub_field( 'description' );
$bg_video    = get_sub_field( 'background_video' );
$img_top     = get_sub_field( 'hero_image_top' );
$img_center  = get_sub_field( 'hero_image_center' );
$img_bottom  = get_sub_field( 'hero_image_bottom' );
?>
<section class="hero" id="hero">

	<?php if ( ! empty( $bg_video['url'] ) ) : ?>
		<video class="hero-bg-video" autoplay muted loop playsinline>
			<source src="<?php echo esc_url( $bg_video['url'] ); ?>" type="video/mp4">
		</video>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-7 hero-content">

				<?php if ( $badge_text ) : ?>
					<div class="eyebrow"><?php echo esc_html( $badge_text ); ?></div>
				<?php endif; ?>

				<?php if ( $heading ) : ?>
					<h1 id="heroH1"><?php echo $heading; // wysiwyg, contains <span class="highlight"> etc ?></h1>
				<?php endif; ?>

				<?php if ( $description ) : ?>
					<p class="sub"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>

			<?php if ( have_rows( 'cta_buttons' ) ) : ?>
    <div class="hero-cta">
        <?php while ( have_rows( 'cta_buttons' ) ) : the_row();

            $label = get_sub_field( 'label' );
            $url   = get_sub_field( 'url' );
            $style = get_sub_field( 'style' );

            $btn_class = 'btn';

            if ( $style === 'primary' ) {
                $btn_class .= ' primary';
            }
        ?>
            <a class="<?php echo esc_attr( $btn_class ); ?>" href="<?php echo esc_url( $url ?: '#' ); ?>" target="_blank" rel="noopener noreferrer">
                <?php echo esc_html( $label ); ?>

                <?php if ( $style === 'primary' ) : ?>
                    <span class="circle">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h13M13 6l6 6-6 6"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </span>
                <?php endif; ?>
            </a>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<?php
$rating_group = get_sub_field( 'rating_review' );

if ( ! empty( $rating_group ) ) :
    $rating_val  = $rating_group['rating_value'] ?? '';
    $review_text = $rating_group['review_text'] ?? '';
    $icons       = $rating_group['review_platform_icons'] ?? [];
?>
<div class="clutch">

    <?php if ( ! empty( $icons ) ) : ?>
        <div class="avatars">
            <?php foreach ( $icons as $icon_row ) :
                $icon = $icon_row['icon'] ?? null;
                if ( empty( $icon['url'] ) ) {
                    continue;
                }
            ?>
                <div class="avatar">
                    <img src="<?php echo esc_url( $icon['url'] ); ?>"
                        alt="<?php echo esc_attr( $icon['alt'] ?? '' ); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="review-content">

        <div class="review-top">
            <?php if ( $rating_val ) : ?>
                <span class="rating"><strong><?php echo esc_html( $rating_val ); ?> / 5</strong></span>
            <?php endif; ?>

            <span class="stars">★★★★★</span>
        </div>

        <?php if ( $review_text ) : ?>
            <div class="review-bottom">
                <?php echo esc_html( $review_text ); ?>
            </div>
        <?php endif; ?>

    </div>

</div>
<?php endif; ?>

			</div>

			<div class="col-12 col-lg-5 hero-visual"></div>
		</div>
	</div>

	<?php if ( ! empty( $img_top['url'] ) || ! empty( $img_center['url'] ) || ! empty( $img_bottom['url'] ) ) : ?>
		<div class="hero-image-wrapper">
			<?php if ( ! empty( $img_top['url'] ) ) : ?>
				<div class="hero-badge b2"><img src="<?php echo esc_url( $img_top['url'] ); ?>" alt="<?php echo esc_attr( $img_top['alt'] ?? '' ); ?>" /></div>
			<?php endif; ?>
			<?php if ( ! empty( $img_center['url'] ) ) : ?>
				<div class="hero-badge b1"><img src="<?php echo esc_url( $img_center['url'] ); ?>" alt="<?php echo esc_attr( $img_center['alt'] ?? '' ); ?>" /></div>
			<?php endif; ?>
			<?php if ( ! empty( $img_bottom['url'] ) ) : ?>
				<div class="hero-badge b3"><img src="<?php echo esc_url( $img_bottom['url'] ); ?>" alt="<?php echo esc_attr( $img_bottom['alt'] ?? '' ); ?>" /></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</section>

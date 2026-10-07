<?php
/**
 * Section: Focus cards (ACF layout "focus")
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="london-event-focus-section">
	<div class="container">
		<div class="london-event-focus-section-wrapper">

			<div class="row">
				<div class="col-12">
					<div class="london-event-focus-head text-center">
						<?php if ( get_sub_field( 'eyebrow' ) ) : ?>
							<span class="london-event-focus-eyebrow"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></span>
						<?php endif; ?>
						<?php if ( get_sub_field( 'heading' ) ) : ?>
							<h2 class="london-event-focus-title"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'description' ) ) : ?>
							<p class="london-event-focus-desc"><?php echo get_sub_field( 'description' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( have_rows( 'cards' ) ) : ?>
				<div class="row london-event-focus-list">
					<?php
					while ( have_rows( 'cards' ) ) :
						the_row();
						$icon = get_sub_field( 'icon' );
						$link = get_sub_field( 'link' );
						?>
						<?php if (is_page('uk-ecommerce-expo-2026')) : ?>
							<div class="col-12 col-sm-6 col-lg-4 col-xl-3 london-event-focus-col">
						<?php else : ?>
							<div class="col-12 col-sm-6 col-lg-4 col-xl-4 london-event-focus-col">
						<?php endif; ?>
							<?php
							$tag  = $link ? 'a' : 'div';
							$attr = $link ? ' href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ? $link['target'] : '_self' ) . '"' : '';
							?>
							<<?php echo $tag; ?> class="london-event-focus-card"<?php echo $attr; ?>>
								<?php if ( ! empty( $icon['url'] ) ) : ?>
									<div class="london-event-focus-card-arrow-wrapper"
									<span class="london-event-focus-icon">
										<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" loading="lazy" />
									</span>
								<?php endif; ?>
								<span class="london-event-focus-card-arrow" aria-hidden="true"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 30 30" fill="none">
<rect width="30" height="30" fill="url(#pattern0_2316_7372)"/>
<defs>
<pattern id="pattern0_2316_7372" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0_2316_7372" transform="scale(0.00666667)"/>
</pattern>
<image id="image0_2316_7372" width="150" height="150" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
</defs>
</svg></span>
								</div>
								<h3 class="london-event-focus-card-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
								<p class="london-event-focus-card-desc"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
							</<?php echo $tag; ?>>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
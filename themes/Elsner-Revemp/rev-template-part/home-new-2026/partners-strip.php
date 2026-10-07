<?php
/**
 * Page Builder Layout: Partners Strip (partners_strip)
 * Fields: sub_heading, heading, logos (repeater: logo)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$sub_heading = get_sub_field( 'sub_heading' );
$heading     = get_sub_field( 'heading' );
?>
<div class="logostrip on-dark" id="partners">
	<div class="container">

		<div class="head reveal">
			<?php if ( $sub_heading ) : ?>
				<div class="eyebrow"><?php echo esc_html( $sub_heading ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
				<h2><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
		</div>

		<?php if ( have_rows( 'logos' ) ) : ?>
			<div class="marquee">
				<div class="mtrack">
					<?php while ( have_rows( 'logos' ) ) : the_row();
						$logo = get_sub_field( 'logo' );
						if ( empty( $logo['url'] ) ) continue;
						?>
						<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="Partner logo" aria-hidden="true" />
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</div>

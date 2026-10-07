<?php
/**
 * Page Builder Layout: Featured In (featured_in)
 * Fields: heading, logos (repeater: logo)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$heading = get_sub_field( 'heading' );
?>
<section class="logostrip on-dark">
	<div class="container">

		<div class="head reveal">
			<?php if ( $heading ) : ?><h2><?php echo esc_html( $heading ); ?></h2><?php endif; ?>
		</div>

		<?php if ( have_rows( 'logos' ) ) : ?>
			<div class="marquee">
				<div class="mtrack">
					<?php while ( have_rows( 'logos' ) ) : the_row();
						$logo = get_sub_field( 'logo' );
						if ( empty( $logo['url'] ) ) continue;
						?>
						<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="Featured in media" aria-hidden="true" />
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>

	</div>
</section>

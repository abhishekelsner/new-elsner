<?php
/**
 * Page Builder Layout: Trusted By Logos (trusted_by_logos)
 * Fields: title (text), logos (repeater: image)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$title = get_sub_field( 'title' );
?>
<section class="logostrip" id="clients">
	<div class="container">
		<div class="logostrip-content">

			<?php if ( $title ) : ?>
				<div class="logostrip-label">
					<h3 class="trusted-label"><?php echo wp_kses_post( nl2br( $title ) ); ?></h3>
				</div>
			<?php endif; ?>

			<?php if ( have_rows( 'logos' ) ) : ?>
				<div class="clients-slider">
					<?php while ( have_rows( 'logos' ) ) : the_row();
						$image = get_sub_field( 'image' );
						if ( empty( $image['url'] ) ) continue;
						?>
						<div class="client-logo-item">
							<img class="client-logo" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?? '' ); ?>" />
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>

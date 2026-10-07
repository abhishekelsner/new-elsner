<?php
/**
 * Page Builder Layout: Industries Served (industries_served)
 * Fields: heading, industries (repeater: icon, title, description, link)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$heading = get_sub_field( 'heading' );
?>
<section class="industries-section pad" id="industries">
	<div class="container">

		<div class="sec-head reveal">
			<?php if ( $heading ) : ?><h2 ><?php echo wp_kses_post( $heading ); ?></h2><?php endif; ?>
		</div>

		<?php if ( have_rows( 'industries' ) ) : ?>
			<div class="cards6">
				<?php
				$idx = 0;
				while ( have_rows( 'industries' ) ) : the_row();
					$icon        = get_sub_field( 'icon' );
					$title       = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$link        = get_sub_field( 'link' ); // ACF link field
					?>
					<div class="icard reveal" <?php if ( $idx ) echo 'data-d="' . esc_attr( $idx ) . '"'; ?>>
						<?php if ( ! empty( $icon['url'] ) ) : ?>
							<img class="ic" src="<?php echo esc_url( $icon['url'] ); ?>" alt="" />
						<?php endif; ?>
						<?php if ( $title ) : ?><h4><?php echo esc_html( $title ); ?></h4><?php endif; ?>
						<?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
						<?php if ( $link && ! empty( $link['url'] ) ) : ?>
							<a class="morelink" href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer" <?php echo ! empty( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
								<?php echo esc_html( $link['title'] ?: 'Explore More' ); ?>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none">
									<path d="M5 12h13M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
								</svg>
							</a>
						<?php endif; ?>
					</div>
					<?php
					$idx++;
				endwhile;
				?>
			</div>
		<?php endif; ?>

	</div>
</section>

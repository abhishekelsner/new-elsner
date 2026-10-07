<?php
/**
 * Page Builder Layout: Capabilities Section (capabilities_section)
 * Fields: section_label, heading, capabilities (repeater: number, title,
 *   description, image)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$section_label = get_sub_field( 'section_label' );
$heading       = get_sub_field( 'heading' );
?>
<section class="capabilities-section" id="capabilities">
	<div class="container">

		<div class="capabilities-header">
			<?php if ( $section_label ) : ?>
				<div class="eyebrow"><?php echo esc_html( $section_label ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
				<h2 class="section-title"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php endif; ?>
		</div>

		<?php if ( have_rows( 'capabilities' ) ) : ?>
			<div class="capabilities-stack">
				<?php
				$i = 0;
				while ( have_rows( 'capabilities' ) ) : the_row();
					$number      = get_sub_field( 'number' );
					$title       = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$image       = get_sub_field( 'image' );
					$link        = get_sub_field( 'link' );
					?>
					<article class="capability-card" data-index="<?php echo esc_attr( $i ); ?>">
						<div class="row align-items-center gx-4 gx-lg-5">
							<div class="col-12 col-lg-4">
								<div class="card-heading">
									<div class="card-number"><?php echo wp_kses_post( $number ); ?></div>
									<h3 class="card-title"><?php echo wp_kses_post( $title ); ?></h3>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<p class="card-description"><?php echo esc_html( $description ); ?></p>
								<?php if ( $link && ! empty( $link['url'] ) ) : ?>
									<a class="morelink" href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer" <?php echo ! empty( $link['target'] ) ? 'target="' . esc_attr( $link['target'] ) . '"' : ''; ?>>
										<?php echo esc_html( $link['title'] ?: 'Explore More' ); ?>
										<svg width="14" height="14" viewBox="0 0 24 24" fill="none">
											<path d="M5 12h13M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
										</svg>
									</a>
								<?php endif; ?>
							</div>
							<div class="col-12 col-lg-4">
								<div class="card-image">
									<?php if ( ! empty( $image['url'] ) ) : ?>
										<img class="capability-image" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ?: $title ); ?>" />
									<?php endif; ?>
								</div>
							</div>
						</div>
					</article>
					<?php
					$i++;
				endwhile;
				?>
			</div>
		<?php endif; ?>

	</div>
</section>

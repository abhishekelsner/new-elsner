<?php
/**
 * Page Builder Layout: Process Timeline (process_timeline)
 * Fields: subheading, heading, description, steps (repeater: step_number,
 *   title, description, phone_mockup_image)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */

$subheading  = get_sub_field( 'subheading' );
$heading     = get_sub_field( 'heading' );
$description = get_sub_field( 'description' );
?>
<section class="process-section">
	<div class="container">

		<div class="sec-head reveal">
			<?php if ( $subheading ) : ?><div class="eyebrow"><?php echo esc_html( $subheading ); ?></div><?php endif; ?>
			<?php if ( $heading ) : ?><h2 ><?php echo wp_kses_post( $heading ); ?></h2><?php endif; ?>
			<?php if ( $description ) : ?><p class="lead"><?php echo esc_html( $description ); ?></p><?php endif; ?>
		</div>

		<?php if ( have_rows( 'steps' ) ) : ?>
			<div class="process-section__grid">
				<?php
				$idx = 0;
				while ( have_rows( 'steps' ) ) : the_row();
					$step_number = get_sub_field( 'step_number' );
					$title       = get_sub_field( 'title' );
					$step_desc   = get_sub_field( 'description' );
					$phone_image = get_sub_field( 'phone_mockup_image' );
					?>
					<div class="process-section__card reveal" <?php if ( $idx ) echo 'data-d="' . esc_attr( $idx ) . '"'; ?>>
							<div class="process-card-body">
							<?php if ( $step_number ) : ?><div class="step-number"><?php echo wp_kses_post( $step_number ); ?></div><?php endif; ?>
							<?php if ( $title ) : ?><h4><?php echo esc_html( $title ); ?></h4><?php endif; ?>
							<?php if ( $step_desc ) : ?><p><?php echo esc_html( $step_desc ); ?></p><?php endif; ?>
						</div>
						<?php if ( ! empty( $phone_image['url'] ) ) : ?>
							<img src="<?php echo esc_url( $phone_image['url'] ); ?>" alt="<?php echo esc_attr( $phone_image['alt'] ?: $title ); ?>" />
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

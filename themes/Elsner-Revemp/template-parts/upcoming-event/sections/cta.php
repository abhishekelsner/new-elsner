<?php
/**
 * Section: Call to Action
 * ACF Layout: cta
 *
 * @package YourTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ACF Fields.
 */
$cta_eyebrow     = get_sub_field( 'eyebrow' );
$cta_heading     = get_sub_field( 'heading' );
$cta_description = get_sub_field( 'description' );
$cta_primary     = get_sub_field( 'primary_button' );
$cta_secondary   = get_sub_field( 'secondary_button' );
?>

<section class="london-event-cta-section">
	<div class="container">
		<div class="london-event-cta-section-wrapper">

			<div class="row justify-content-center">
				<div class="col-12">

					<div class="london-event-cta-inner text-center">

						<?php if ( ! empty( $cta_eyebrow ) ) : ?>
							<span class="london-event-cta-eyebrow">
								<?php echo esc_html( $cta_eyebrow ); ?>
							</span>
						<?php endif; ?>

						<?php if ( ! empty( $cta_heading ) ) : ?>
							<h2 class="london-event-cta-title">
								<?php echo esc_html( $cta_heading ); ?>
							</h2>
						<?php endif; ?>

						<?php if ( ! empty( $cta_description ) ) : ?>
							<div class="london-event-cta-desc">
								<?php echo wp_kses_post( $cta_description ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $cta_primary ) || ! empty( $cta_secondary ) ) : ?>
							<div class="london-event-cta-buttons">

								<?php if ( ! empty( $cta_primary['url'] ) && ! empty( $cta_primary['title'] ) ) : ?>
									<?php
									$primary_target = ! empty( $cta_primary['target'] )
										? $cta_primary['target']
										: '_self';
									?>
									<a
										class="london-event-cta-btn london-event-cta-btn-primary"
										href="<?php echo esc_url( $cta_primary['url'] ); ?>"
										target="<?php echo esc_attr( $primary_target ); ?>"
										<?php echo '_blank' === $primary_target ? ' rel="noopener noreferrer"' : ''; ?>
									>
										<?php echo esc_html( $cta_primary['title'] ); ?>
									</a>
								<?php endif; ?>

								<?php if ( ! empty( $cta_secondary['url'] ) && ! empty( $cta_secondary['title'] ) ) : ?>
									<?php
									$secondary_target = ! empty( $cta_secondary['target'] )
										? $cta_secondary['target']
										: '_self';
									?>
									<a
										class="london-event-cta-btn london-event-cta-btn-secondary"
										href="<?php echo esc_url( $cta_secondary['url'] ); ?>"
										target="<?php echo esc_attr( $secondary_target ); ?>"
										<?php echo '_blank' === $secondary_target ? ' rel="noopener noreferrer"' : ''; ?>
									>
										<?php echo esc_html( $cta_secondary['title'] ); ?>
									</a>
								<?php endif; ?>

							</div>
						<?php endif; ?>

					</div>

				</div>
			</div>

		</div>
	</div>
</section>
<?php
/**
 * Section: Stats (ACF layout "stats")
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="london-event-stats-section">
	<div class="container">
		<div class="london-event-stats-section-wrapper">

			<div class="row">
				<div class="col-12">
					<div class="london-event-stats-head text-center">
						<?php if ( get_sub_field( 'heading' ) ) : ?>
							<h2 class="london-event-stats-title"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'subheading_lead' ) || get_sub_field( 'subheading_rest' ) ) : ?>
							<p class="london-event-stats-subtitle">
								<strong><?php echo esc_html( get_sub_field( 'subheading_lead' ) ); ?></strong>
								<?php echo esc_html( get_sub_field( 'subheading_rest' ) ); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( have_rows( 'items' ) ) : ?>
				<div class="row london-event-stats-list">
					<?php while ( have_rows( 'items' ) ) : the_row(); ?>
						<div class="col-12 col-sm-6 col-lg-3">
							<div class="london-event-stat-item">
								<span class="london-event-stat-number"><?php echo esc_html( get_sub_field( 'number' ) ); ?></span>
								<span class="london-event-stat-label"><?php echo esc_html( get_sub_field( 'label' ) ); ?></span>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
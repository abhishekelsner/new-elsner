<?php
/**
 * Section: Case studies (ACF layout "case_studies")
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="london-event-cases-section">
	<div class="container">
		<div class="london-event-cases-section-wrapper">

			<div class="row">
				<div class="col-12">
					<div class="london-event-cases-head text-center">
						<?php if ( get_sub_field( 'eyebrow' ) ) : ?>
							<span class="london-event-cases-eyebrow"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></span>
						<?php endif; ?>
						<?php if ( get_sub_field( 'heading' ) ) : ?>
							<h2 class="london-event-cases-title"><?php echo wp_kses( get_sub_field( 'heading' ), array( 'br' => array() ) ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'description' ) ) : ?>
							<p class="london-event-cases-desc"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( have_rows( 'items' ) ) : ?>
				<div class="row london-event-cases-list">
					<?php
					while ( have_rows( 'items' ) ) :
						the_row();
						$link       = get_sub_field( 'link' );
						$link_label = get_sub_field( 'link_label' );
						?>
						<div class="col-12 col-md-6 col-xl-4 london-event-case-wrapper ">
							<div class="london-event-case-card">
								<div class="london-event-case-top">
									<span class="london-event-case-category"><?php echo esc_html( get_sub_field( 'category' ) ); ?></span>
									<span class="london-event-case-number"><?php echo esc_html( get_sub_field( 'number' ) ); ?></span>
								</div>
								<h3 class="london-event-case-title"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
								<p class="london-event-case-desc"><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
								<?php if ( $link ) : ?>
									<a class="london-event-case-link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
										<?php echo esc_html( $link_label ? $link_label : $link['title'] ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
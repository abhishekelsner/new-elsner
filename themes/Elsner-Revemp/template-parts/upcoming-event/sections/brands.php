<?php
/**
 * Section: Brands (ACF layout "brands")
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="london-event-brands-section">
	<div class="container">
		<div class="london-event-brands-section-wrapper">

			<div class="row">
				<div class="col-12">
					<?php if ( get_sub_field( 'heading' ) ) : ?>
						<p class="london-event-brands-title text-center"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<?php
			$logos = array();
			if ( have_rows( 'logos' ) ) :
				while ( have_rows( 'logos' ) ) :
					the_row();
					$logos[] = array(
						'image' => get_sub_field( 'logo_image' ),
						'name'  => get_sub_field( 'logo_name' ),
					);
				endwhile;
			endif;
			?>

			<?php if ( $logos ) : ?>
				<div class="london-event-brands-slider">
					<?php
				
					$min_slides = 8;
					$render     = $logos;
					while ( count( $render ) < $min_slides ) {
						$render = array_merge( $render, $logos );
					}
					foreach ( $render as $pass => $logo ) :
						$image = $logo['image'];
						$name  = $logo['name'];
						?>
						<div class="london-event-brand-item"<?php echo $pass < count( $logos ) ? '' : ' aria-hidden="true"'; ?>>
							<?php if ( ! empty( $image['url'] ) ) : ?>
								<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $name ? $name : $image['alt'] ); ?>" loading="lazy" />
							<?php elseif ( $name ) : ?>
								<span class="london-event-brand-name"><?php echo esc_html( $name ); ?></span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>

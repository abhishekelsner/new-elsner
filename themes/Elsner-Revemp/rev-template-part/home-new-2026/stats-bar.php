<?php
/**
 * Page Builder Layout: Stats Bar (stats_bar)
 * Fields: stats (repeater: number, label)
 * Standalone — the "6,200+" -> data-to/data-suffix/data-comma parsing is
 * done inline in the loop below (no shared function).
 */
?>
<section class="stats-section" id="stats">
	<div class="container">

		<?php if ( have_rows( 'stats' ) ) : ?>
			<div class="stats-section__grid">
				<?php while ( have_rows( 'stats' ) ) : the_row();
					$number = trim( (string) get_sub_field( 'number' ) );
					$label  = get_sub_field( 'label' );

					// inline parse: "6,200+" -> value=6200, suffix=+, comma=1
					$has_comma  = ( strpos( $number, ',' ) !== false );
					$data_value = preg_replace( '/[^0-9]/', '', $number );
					$data_value = $data_value !== '' ? $data_value : '0';
					$data_suffix = preg_replace( '/[0-9,]/', '', $number );
					?>
					<div class="stats-section__item">
						<div class="stats-section__number"
							data-to="<?php echo esc_attr( $data_value ); ?>"
							data-suffix="<?php echo esc_attr( $data_suffix ); ?>"
							<?php if ( $has_comma ) echo 'data-comma="1"'; ?>>0</div>
						<div class="stats-section__label"><?php echo esc_html( $label ); ?></div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>

	</div>
</section>

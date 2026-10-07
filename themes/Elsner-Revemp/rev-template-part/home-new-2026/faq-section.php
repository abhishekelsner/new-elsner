<?php
/**
 * Page Builder Layout: FAQ Section (faq_section)
 * Fields: heading, faqs (repeater: question, answer [wysiwyg])
 * Standalone — no shared function. The FAQ column markup is written out
 * twice below (once per column) instead of being pulled from a function.
 * Faqs split evenly across two columns; the very first FAQ opens by default.
 */

$heading = get_sub_field( 'heading' );
$faqs    = get_sub_field( 'faqs' );

$col_count = ! empty( $faqs ) ? ceil( count( $faqs ) / 2 ) : 0;
$col1      = $col_count ? array_slice( $faqs, 0, $col_count ) : array();
$col2      = $col_count ? array_slice( $faqs, $col_count ) : array();
?>
<section class="faq-section pad" id="faq">
	<div class="container">

		<div class="sec-head reveal">
			<div class="eyebrow">Got Questions?</div>
			<?php if ( $heading ) : ?><h2><?php echo wp_kses_post( $heading ); ?></h2><?php endif; ?>
		</div>

		<?php if ( ! empty( $faqs ) ) : ?>
			<div class="faq-grid">

				<div class="faq-col reveal">
					<?php foreach ( $col1 as $i => $faq ) :
						$open = ( $i === 0 ); // first FAQ in column 1 opens by default
						?>
						<div class="faq<?php echo $open ? ' open' : ''; ?>">
							<div class="q"><?php echo esc_html( $faq['question'] ); ?><span class="pm"><?php echo $open ? '−' : '+'; ?></span></div>
							<div class="a">
								<div class="inner"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="faq-col reveal" data-d="1">
					<?php foreach ( $col2 as $faq ) : ?>
						<div class="faq">
							<div class="q"><?php echo esc_html( $faq['question'] ); ?><span class="pm">+</span></div>
							<div class="a">
								<div class="inner"><?php echo wp_kses_post( $faq['answer'] ); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		<?php endif; ?>

	</div>
</section>

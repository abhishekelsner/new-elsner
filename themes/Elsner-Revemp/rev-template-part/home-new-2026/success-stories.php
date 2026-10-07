<?php
/**
 * Page Builder Layout: Success Stories (success_stories)
 * Fields: section_label, heading, stories (repeater: client_logo, stats
 *   [repeater: value, label], title, excerpt, link), button (link)
 * Standalone — assumes ACF image fields use the default "Array" return format.
 */
if(is_page(61372)){
	$section_label = get_field( 'section_label' );
	$heading       = get_field( 'heading' );
	$button        = get_field( 'button' );
}
else{
	$section_label = get_sub_field( 'section_label' );
	$heading       = get_sub_field( 'heading' );
	$button        = get_sub_field( 'button' ); // ACF link field -> array(url, title, target)
}
?>
<section class="stories-section" id="stories">
	<div class="container">

		<div class="sec-head reveal">
			<?php if ( $section_label ) : ?><div class="eyebrow"><?php echo esc_html( $section_label ); ?></div><?php endif; ?>
			<?php if ( $heading ) : ?><h2><?php echo wp_kses_post( $heading ); ?></h2><?php endif; ?>
		</div>

		<?php if ( have_rows( 'stories' ) ) : ?>
			<div class="stories-section__grid">
				<?php
				$idx = 0;
				while ( have_rows( 'stories' ) ) : the_row();
					$client_logo = get_sub_field( 'client_logo' );
					$tag         = get_sub_field( 'tag' );
					$title       = get_sub_field( 'title' );
					$excerpt     = get_sub_field( 'excerpt' );
					$link        = get_sub_field( 'link' );
					$stats       = get_sub_field( 'stats' ); // nested repeater array
					?>
					<a class="stories-section__card reveal" <?php if ( $idx ) echo 'data-d="' . esc_attr( $idx ) . '"'; ?> href="<?php echo esc_url( $link ?: '#' ); ?>" target="_blank" rel="noopener noreferrer">
						<?php if ( ! empty( $client_logo['url'] ) ) : ?>
							<div class="story-logo">
								<img src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo esc_attr( $client_logo['alt'] ?? '' ); ?>" />
								<?php if ( $tag ) : ?><span class="story-tag"><?php echo esc_html( $tag ); ?></span><?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $stats ) ) : ?>
							<div class="story-stats">
								<?php foreach ( $stats as $stat ) : ?>
									<div class="story-stat">
										<b><?php echo esc_html( $stat['value'] ); ?></b>
										<span><?php echo esc_html( $stat['label'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php if ( $title ) : ?><h4><?php echo esc_html( $title ); ?></h4><?php endif; ?>
						<?php if ( $excerpt ) : ?><p><?php echo esc_html( $excerpt ); ?></p><?php endif; ?>

						<span class="story-cta">
							Read Case Study
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none">
								<path d="M5 12h13M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</span>
					</a>
					<?php
					$idx++;
				endwhile;
				?>
			</div>
		<?php endif; ?>

		<?php if ( $button && ! empty( $button['url'] ) ) : ?>
			<div class="center-cta reveal">
				<a class="btn ghost" href="<?php echo esc_url( $button['url'] ); ?>" target="_blank" rel="noopener noreferrer" <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
					<?php echo esc_html( $button['title'] ?: 'Explore Our Success Studies' ); ?>
					<span class="circle">
						<svg width="15" height="15" viewBox="0 0 24 24" fill="none">
							<path d="M5 12h13M13 6l6 6-6 6" stroke="#0E86C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</span>
				</a>
			</div>
		<?php endif; ?>

	</div>
</section>

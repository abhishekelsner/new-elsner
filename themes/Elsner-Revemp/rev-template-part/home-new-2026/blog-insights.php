<?php
/**
 * Page Builder Layout: Blog Insights (blog_insights)
 * Fields: section_label, heading, button (link)
 * Posts are now pulled automatically: latest 4 published blog posts.
 * First post renders as the big "featured" card, the rest as the
 * list on the right (matches original static markup).
 */

$section_label = get_sub_field( 'section_label' );
$heading       = get_sub_field( 'heading' );
$button        = get_sub_field( 'button' );

$blog_query = new WP_Query( array(
	'post_type'              => 'post',
	'post_status'            => 'publish',
	'posts_per_page'         => 4,
	'orderby'                => 'date',
	'order'                  => 'DESC',
	'ignore_sticky_posts'    => true,
	'no_found_rows'          => true,
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
) );

$posts = $blog_query->posts; // array of WP_Post objects

$featured_post = ! empty( $posts ) ? array_shift( $posts ) : null; // remaining $posts = the list
?>
<section class="blog-section" id="blog">
	<div class="container">

		<div class="sec-head reveal">
			<?php if ( $section_label ) : ?><div class="eyebrow"><?php echo esc_html( $section_label ); ?></div><?php endif; ?>
			<?php if ( $heading ) : ?><h2 ><?php echo wp_kses_post( $heading ); ?></h2><?php endif; ?>
		</div>

		<div class="blog-section__grid">

			<?php if ( $featured_post ) :
				$cats = get_the_category( $featured_post );
				?>
				<a class="blog-section__featured reveal" href="<?php echo esc_url( get_permalink( $featured_post ) ); ?>" target="_blank" rel="noopener noreferrer">
					<?php if ( ! empty( $cats ) ) : ?>
						<div class="ov"><span class="tag" style="background:#fff"><?php echo esc_html( $cats[0]->name ); ?></span></div>
					<?php endif; ?>
					<?php echo get_the_post_thumbnail( $featured_post, 'large', array( 'alt' => esc_attr( get_the_title( $featured_post ) ) ) ); ?>
					<div class="cap">
						<h3><?php echo esc_html( get_the_title( $featured_post ) ); ?></h3>
						<div class="meta"><?php echo esc_html( get_the_date( 'M j, Y', $featured_post ) ); ?> &nbsp;•&nbsp; By <?php echo esc_html( get_the_author_meta( 'display_name', get_post_field( 'post_author', $featured_post ) ) ); ?></div>
					</div>
				</a>
			<?php endif; ?>

			<?php if ( ! empty( $posts ) ) : ?>
				<div class="blog-section__list">
					<?php
					$idx = 1;
					foreach ( $posts as $post_item ) :
						$cats = get_the_category( $post_item );
						?>
						<a class="blog-section__item reveal" data-d="<?php echo esc_attr( $idx ); ?>" href="<?php echo esc_url( get_permalink( $post_item ) ); ?>" target="_blank" rel="noopener noreferrer">
							<div class="thumb"><?php echo get_the_post_thumbnail( $post_item, 'medium', array( 'alt' => esc_attr( get_the_title( $post_item ) ) ) ); ?></div>
							<div>
								<?php if ( ! empty( $cats ) ) : ?><span class="tag"><?php echo esc_html( $cats[0]->name ); ?></span><?php endif; ?>
								<h4><?php echo esc_html( get_the_title( $post_item ) ); ?></h4>
								<div class="meta"><?php echo esc_html( get_the_date( 'M j, Y', $post_item ) ); ?> &nbsp;•&nbsp; By <?php echo esc_html( get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_item ) ) ); ?></div>
							</div>
						</a>
						<?php
						$idx++;
					endforeach;
					?>
				</div>
			<?php endif; ?>

		</div>

		<?php if ( $button && ! empty( $button['url'] ) ) : ?>
			<div class="center-cta reveal">
				<a class="btn primary" href="<?php echo esc_url( $button['url'] ); ?>" target="_blank" rel="noopener noreferrer" <?php echo ! empty( $button['target'] ) ? 'target="' . esc_attr( $button['target'] ) . '"' : ''; ?>>
					<?php echo esc_html( $button['title'] ?: 'Explore More Articles' ); ?>
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

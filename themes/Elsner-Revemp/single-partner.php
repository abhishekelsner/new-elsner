<?php

/**

 * The template for displaying all single posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post

 *

 * @package WordPress

 * @subpackage Twenty_Seventeen

 * @since 1.0

 * @version 1.0

 */

get_header(); ?>



<!-- <section class="section-padding white_block blog_detail_block partner-block">

	<div class="container">



		<div class="row">

			<div class="col-md-12">

				<div class="blog_wrapper">



				<div class="social-floating-btn">

					<?php echo do_shortcode('[addtoany]'); ?>

				</div>

				<?php while (have_posts()) : the_post(); ?>

					<?php if ('' !== get_the_post_thumbnail()) : ?>

					<div class="blog_inner_wrapper blog_image_wrapper partner-single-page"><div class=""><?php the_post_thumbnail('large'); ?></div></div>

					<?php endif; ?>

					<div class="blog_inner_wrapper blog_content_bar">

						<?php the_content(); ?>

						<div class="blog_tag_row d-flex">

							<?php echo get_the_tag_list(); ?>

						</div>							





					</div>			

					

					<?php wp_reset_postdata();
				endwhile; ?>

				</div>

			</div>

		</div>

	</div>

</section>
 -->


<?php

get_footer();

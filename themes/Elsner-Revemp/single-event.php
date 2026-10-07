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

<section class="section-padding white_block blog_detail_block">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="blog_wrapper">
				<?php while ( have_posts() ) : the_post();$author_url = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );?>
					<div class="blog_inner_wrapper blog_title_bar dark_text">
						<h1 class="banners-headding"><?php the_title();?></h1>
						<div class="author_bio_box">
							<div class="author_thumbnail">
								<div class="thumb_cover">
									<?php echo get_avatar( get_the_author_meta('user_email'), $size = '50');?>
								</div>
								<div class="author_info">
									<h6><a href="<?=$author_url;?>"><?php echo get_the_author();?></a></h6>
									<span><?php the_time("F d, Y");?></span>
								</div>
							</div>
						</div>
					</div>
					<?php if ( '' !== get_the_post_thumbnail()) : ?>
					<div class="blog_inner_wrapper blog_image_wrapper"><div class="blog_img_col"><?php the_post_thumbnail( 'full' );?></div></div>
					<?php endif;?>
					<div class="blog_inner_wrapper blog_content_bar">
						<?php the_content();?>
						<div class="blog_tag_row d-flex">
							<?php echo get_the_tag_list();?>
						</div>							

						<div class="blog_footer">
							<div class="blog_footer_cover d-flex justify-content-between align-items-center">
								<div class="author_bio_box">
									<div class="author_thumbnail">
										<div class="thumb_cover">
											<?php echo get_avatar( get_the_author_meta('user_email'), $size = '50');?>
										</div>
										<div class="author_info">
											<h6><a href="<?=$author_url;?>"><?php echo get_the_author();?></a></h6>
											<span><?php the_time("F d, Y");?></span>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>	
					
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

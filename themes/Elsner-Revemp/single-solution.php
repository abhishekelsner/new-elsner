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

$clap_count = get_post_meta(get_the_ID(), 'clap_count', true);

if (!$clap_count) {
	$clap_count = rand(100, 1000);
}

get_header();

while (have_posts()) : the_post();

	get_template_part('template-parts/single-solution/work-detail-banner', 'section');
	get_template_part('template-parts/single-solution/work-detail-img', 'section');
	get_template_part('template-parts/single-solution/challenge', 'section');
		// pree custom code
		get_template_part('template-parts/single-solution/solution-option', 'section');
		get_template_part('template-parts/single-solution/featured2', 'section');
		// pree custom code end 
	// get_template_part('template-parts/single-solution/solution-provided', 'section');
	// get_template_part('template-parts/single-solution/project-making', 'section');
	// get_template_part('template-parts/single-solution/project-team', 'section');

endwhile;


get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

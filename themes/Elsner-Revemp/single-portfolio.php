<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage ElsnerRevamp
 * @since 1.0
 * @version 1.0
 */

$clap_count = get_post_meta(get_the_ID(), 'clap_count', true);

if (!$clap_count) {
    $clap_count = random_int(100, 1000);
}

get_header();
$id = '';
while (have_posts()) : the_post();

    get_template_part('template-parts/single-portfolio/work-detail-banner', 'section');
    get_template_part('template-parts/single-portfolio/work-detail-img', 'section');
    get_template_part('template-parts/single-portfolio/challenge', 'section');
    // get_template_part('template-parts/single-portfolio/request-quote', 'section', array('post_id' => get_the_ID()));
    //get_template_part('template-parts/single-portfolio/project-making', 'section');
    get_template_part('template-parts/single-portfolio/solution-provided', 'section');
    get_template_part('template-parts/single-portfolio/work-idea', 'section', array('post_id' => get_the_ID()));
    //get_template_part('template-parts/single-portfolio/project-team', 'section');
endwhile;

//get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

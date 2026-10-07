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
    $clap_count = rand(100, 1000);
}

get_header();
$id = '';
while (have_posts()) : the_post();


   


if (have_rows('weekmate')) :
    while (have_rows('weekmate')) : the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/WeekMate/sections/' . $layout);
    endwhile;
endif;

    
endwhile;



get_footer();
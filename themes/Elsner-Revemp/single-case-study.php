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

   
    $checked_display = (array) get_field('checked_display_new');

    if ( in_array('yes', $checked_display, true) ) {

            if ( have_rows('case_study_sections') ) {
                while ( have_rows('case_study_sections') ) : the_row();

                    // Dynamically include template file based on layout name
                    $layout = get_row_layout();
                    get_template_part('template-parts/single-case-study/' . $layout);

                endwhile;
            }

    } else {
        // If not checked => fallback old sections
        get_template_part('template-parts/single-case-study/portfolio-new-banner', 'section', ['post_id' => get_the_ID()]);
        get_template_part('template-parts/single-case-study/portfolio-new-tech-stack', 'section', ['post_id' => get_the_ID()]);
        get_template_part('template-parts/single-case-study/text-contetnt', 'section', ['post_id' => get_the_ID()]);
        get_template_part('template-parts/single-case-study/portfolio-new-form', 'section', ['post_id' => get_the_ID()]);
        get_template_part('template-parts/single-case-study/solution', 'section', ['post_id' => get_the_ID()]);
        get_template_part('template-parts/single-case-study/recent-new-portfolio-projects', 'section', ['post_id' => get_the_ID()]);
    }

endwhile;


get_footer();

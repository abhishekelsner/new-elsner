<?php
/* Template Name: Our portfolio */
get_header();


if (have_rows('page_sections')) :
    while (have_rows('page_sections')) : the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/tmp-new-case-study/sections/' . $layout);
    endwhile;
endif;

// get_template_part('template-parts/our-portfolio/banner', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/our-portfolio/category-filter', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/our-portfolio/work-idea', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/our-portfolio/work-slider', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

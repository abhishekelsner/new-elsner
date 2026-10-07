<?php
/* Template Name: Career */
get_header();

get_template_part('template-parts/career/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/career/hiring', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/career/work-and-play', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/career/perk-benefits', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/career/requirement-process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/career/get-in-touch', 'section', array('post_id' => get_the_ID()));
//get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

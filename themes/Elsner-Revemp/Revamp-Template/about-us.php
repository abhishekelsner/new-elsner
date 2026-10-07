<?php
/* Template Name: About us */

get_header();


get_template_part('template-parts/about/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/about/who-we-are', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/about/value', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/about/achive', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/about/leader', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/about/venture', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

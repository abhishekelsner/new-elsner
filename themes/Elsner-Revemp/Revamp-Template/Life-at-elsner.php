<?php
/* Template Name: Life elsner */
get_header();


get_template_part('template-parts/life-at-elsner/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/life-at-elsner/events', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

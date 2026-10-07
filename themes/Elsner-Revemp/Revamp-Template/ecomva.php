<?php
/* Template Name: Ecomva */

get_header();


get_template_part('template-parts/ecomva/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/ecomva/services', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/ecomva/benefit', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/ecomva/feature', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/ecomva/virtual-service', 'section', array('post_id' => get_the_ID()));

get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/ecomva/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

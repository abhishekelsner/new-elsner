<?php
/* Template Name: Web Hosting Service */

get_header();

get_template_part('template-parts/web-hosting/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/web-hosting/business-plan', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/web-hosting/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/web-hosting/why-choose', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/web-hosting/other-solution', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

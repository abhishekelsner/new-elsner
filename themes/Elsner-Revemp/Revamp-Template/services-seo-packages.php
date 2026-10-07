<?php
/* Template Name: Services seo packages Template */
get_header();

get_template_part('template-parts/services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/seo-package', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
//get_template_part('template-parts/services/why-choose', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();
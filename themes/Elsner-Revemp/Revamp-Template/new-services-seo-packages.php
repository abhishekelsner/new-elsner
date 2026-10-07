<?php
/* Template Name: New services seo packages template */
get_header();

get_template_part('template-parts/services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/amc-benefits', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/seo-package', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));

get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();
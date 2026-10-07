<?php
/* Template Name: Shopify Growth Plan Template */

get_header();

get_template_part('template-parts/b2b-services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/shopify-growth-solution', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/shopify-growth-services', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/b2b-services/shopify-growth-plan', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-contact', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/shopify-growth-cta', 'section', array('post_id' => get_the_ID()));

get_footer();
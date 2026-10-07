<?php
/* Template Name: Ecommerce Maintenance packages template */
get_header();

get_template_part('template-parts/services/ecommerce-maintenance-banner', 'section', array('post_id' => get_the_ID()));
//get_template_part('template-parts/services/amc-benefits', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/ecommerce-seo-package-plan', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/awards-badges', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/ecommerce-cta', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_footer();
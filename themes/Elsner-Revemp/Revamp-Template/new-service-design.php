<?php
/* Template Name: New Services Design Template */
$wordpress_development_page = is_page('wordpress-development');
$template_part = $wordpress_development_page ? 'template-parts/Industries/industries-cta' : 'template-parts/global-template/get-in-touch';
get_header();

get_template_part('template-parts/services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/why-choose', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/services-by-elsner', 'section', array('post_id' => get_the_ID()));

get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/build-team', 'section', array('post_id' => get_the_ID()));

get_template_part('template-parts/services/package-plan', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/local-seo-agency', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/awards-badges', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/seo-package', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part($template_part, 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));

get_footer();
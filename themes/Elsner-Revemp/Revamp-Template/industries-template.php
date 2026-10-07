<?php
/* Template Name: Industries Template */
get_header();
$testimonials_form_section = is_page('jewelry-e-commerce-development') || is_page('fashion-e-commerce-development') ? 'template-parts/Industries/testimonials-form' : 'template-parts/Industries/industries-cta';

get_template_part('template-parts/Industries/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Industries/request-section', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Industries/healthcare', 'section', array('post_id' => get_the_ID()));
if(is_page('tiles-ecommerce-services')):
// get_template_part('template-parts/services/ecommerce-seo-package-plan', 'section', array('post_id' => get_the_ID()));
endif;
get_template_part('template-parts/Industries/process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Industries/why-elsner-tech', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/awards-badges', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => 5)); 
get_template_part($testimonials_form_section, 'section', array('post_id' => get_the_ID()));
if(!is_page(61372)){
get_template_part('template-parts/Industries/recent-project-industries', 'section', array('post_id' => null));
}
if(is_page(61372)){
get_template_part('rev-template-part/home-new-2026/success-stories', 'section', array('post_id' => get_the_ID()));
}
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
if(is_page(61372)){
get_template_part('template-parts/b2b-services/b2b-contact-section', 'section', array('post_id' => get_the_ID()));
}
get_footer();
<?php
/* Template Name: B2B Template */

get_header();

get_template_part('template-parts/b2b-services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/services-tab', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/healthcare-b2b', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-cta', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/b2b-clients', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-contact', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/faq', 'section', array('post_id' => get_the_ID()));

get_footer();
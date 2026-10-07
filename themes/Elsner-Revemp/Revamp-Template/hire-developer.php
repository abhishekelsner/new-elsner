<?php
/* Template Name: Hire developer */

get_header();

get_template_part('template-parts/global-template/hire-developer-banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/hire-developer/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/hire-developer/developer-hiring', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/hiring-step', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/talk-to-us', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/why-hire', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/hire-developer/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

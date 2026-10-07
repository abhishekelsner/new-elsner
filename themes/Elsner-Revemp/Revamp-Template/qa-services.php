<?php
/* Template Name: QA Services*/
get_header();

get_template_part('template-parts/testing-services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/testing-capability', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/business-benefits', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/testing-approach', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/testing-services/testing-group-table', 'section', array('post_id' => get_the_ID()));


get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

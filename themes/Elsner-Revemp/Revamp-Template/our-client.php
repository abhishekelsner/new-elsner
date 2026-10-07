<?php
/* Template Name: Our client */
get_header();

get_template_part('template-parts/Our-client/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Our-client/clients', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

<?php
/* Template Name: Engagement modals */
get_header();

get_template_part('template-parts/engagement/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/engagement/modals', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/engagement/technology', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

<?php

/* Template Name: News Room */

get_header();

get_template_part('template-parts/news-room/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/news-room/news-room-section', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/news-room/contact-form-section', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/news-room/our-client-section', 'section', array('post_id' => get_the_ID()));

get_footer();
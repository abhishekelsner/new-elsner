<?php
get_header();

get_template_part('template-parts/solution/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/solution/category-filter', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/our-portfolio/work-idea', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/our-portfolio/work-slider', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

<?php
/* Template Name: SkillSets */
get_header();

get_template_part('template-parts/skillsets/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/skillsets/skill-sets', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

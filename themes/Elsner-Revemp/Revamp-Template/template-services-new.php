<?php
/* Template Name: New Service */

get_header();

if (have_rows('new_services_template')) :
    while (have_rows('new_services_template')) : the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/tmp-new-services/sections/' . $layout);
    endwhile;
endif;

get_footer();
<?php

get_header();

if (have_rows('weekmate')) :
    while (have_rows('weekmate')) : the_row();
        $layout = get_row_layout();
        get_template_part('template-parts/WeekMate/sections' . $layout);
    endwhile;
endif;

get_footer();

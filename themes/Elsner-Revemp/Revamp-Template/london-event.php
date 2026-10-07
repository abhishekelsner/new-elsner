<?php
/* Template Name: Upcoming Events */

get_header();

if ( have_rows( 'page_sections' ) ) :

    while ( have_rows( 'page_sections' ) ) :
        the_row();

        $layout = get_row_layout();

        get_template_part(
            'template-parts/upcoming-event/sections/' . $layout
        );

    endwhile;

endif;

get_footer();
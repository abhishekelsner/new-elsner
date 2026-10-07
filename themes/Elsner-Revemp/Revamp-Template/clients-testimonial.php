<?php
/* Template Name: Clients and Testimonials */
get_header();
?>

<?php
get_template_part('template-parts/Clients-testimonial/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Clients-testimonial/testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

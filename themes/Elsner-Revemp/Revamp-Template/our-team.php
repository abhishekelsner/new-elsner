<?php
/* Template Name: our team */
get_header();
?>

<?php
get_template_part('template-parts/our-team/team-banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/our-team/team-member', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));


get_template_part('template-parts/our-team/choose-us', 'section', array('post_id' => get_the_ID()));
// get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-client-testimonial', 'section', array('post_id' => get_the_ID()));


get_template_part('template-parts/our-team/b2b-contact', 'section', array('post_id' => get_the_ID())); 

// get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

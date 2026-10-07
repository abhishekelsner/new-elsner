<?php
/* Template Name: Partner and alliances */
get_header();
?>

<?php
get_template_part('template-parts/partner-alliances/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/partner-alliances/partner-data', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();

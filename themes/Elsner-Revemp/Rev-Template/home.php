<?php
/**
 * Template Name: Home New Rev
 * 
 * This template uses the ACF Flexible Content field 'home'
 * to dynamically render sections based on what's configured in the page editor.
 * 
 * The template gets sections from rev-template-part/Home/ folder
 */
get_header();
?>

<?php
// Loop through and render all flexible content sections from rev-template-part/Home/
get_template_part('rev-template-part/Home/flexible-content-loop', null, array('post_id' => get_the_ID()));
?>

<?php
get_footer();
?>


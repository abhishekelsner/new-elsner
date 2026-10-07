<?php
/* Template Name: New Service Template 2025 */

get_header();
get_template_part('template-parts/services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/new-services/client-logo', 'section');
get_template_part('template-parts/new-services/right-image-leftcontent', 'section');
get_template_part('template-parts/new-services/developement-service-include', 'section');
get_template_part('template-parts/new-services/why-choose', 'section');
// Conditional check for page slug
if (is_page('zoho-development-services')) {
    get_template_part('template-parts/services/why-choose', 'section', array('post_id' => get_the_ID()));
}

if (is_page('ecommerce-development')) {
    get_template_part('template-parts/new-services/technology-section', 'section');
}
get_template_part('template-parts/new-services/newservice-clutch-section', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/awards-badges', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/new-services/tabination', 'section');
get_template_part('template-parts/new-services/recent-casestudy-projects', 'section');
get_template_part('template-parts/b2b-services/b2b-cta', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/new-services/website-workflow', 'section');
get_template_part('template-parts/b2b-services/b2b-client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/new-services/dedicated-team', 'section');
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/b2b-services/b2b-contact', 'section', array('post_id' => get_the_ID()));






get_footer();

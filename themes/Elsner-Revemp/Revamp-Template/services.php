<?php
/* Template Name: Services Template */
$ppc_supportplan_pages = is_page(array(36808, 36741, 36811, 36816, 36823));
$pimcore_development_page = is_page('pimcore-development');
$template_part = $pimcore_development_page ? 'template-parts/services/ecommerce-cta' : 'template-parts/global-template/get-in-touch';
get_header();

get_template_part('template-parts/services/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/service-request-quote', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
if ( is_page( 'odoo-development' ) ) {
    get_template_part( 'template-parts/services/odoo-apps', 'section', array( 'post_id' => get_the_ID() ) );
}
get_template_part('template-parts/services/why-choose', 'section', array('post_id' => get_the_ID()));

if (is_page('wordpress-support-plan')) {
/*if ( isset($_GET['testingssss']) ) {
    echo is_page('wordpress-support-plan');*/
    get_template_part('template-parts/SEO-package/seo-new-price-package', 'section', array('post_id' => get_the_ID()));
} else {
    get_template_part('template-parts/services/package-plan', 'section', array('post_id' => get_the_ID()));
}

get_template_part('template-parts/services/services-by-elsner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-project', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/process', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/local-seo-agency', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/build-team', 'section', array('post_id' => get_the_ID()));
if (!$ppc_supportplan_pages){
    // get_template_part('template-parts/global-template/premium-scalable', 'section', array('post_id' => get_the_ID()));
}
get_template_part('template-parts/services/awards-badges', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/client-testimonial', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/feature-post', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
get_template_part($template_part, 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
// get_footer();

// Get the current post ID
global $post;
$current_post_id = $post->ID;
$target_page_id = 36808; 
if ($current_post_id == $target_page_id) {
    get_footer('service');
} else {
    get_footer();
}
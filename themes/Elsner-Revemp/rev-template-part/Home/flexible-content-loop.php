<?php
/**
 * Flexible Content Loop Template
 * 
 * This template loops through the ACF flexible content field 'home'
 * and includes the appropriate template for each layout.
 * 
 * Usage: Include this file in your page template
 * get_template_part('rev-template-part/Home/flexible-content-loop');
 */

// Retrieve the post ID from the $args array (if passed) or use current post
$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

// Check if flexible content field exists
if (have_rows('home', $post_id)) :
    while (have_rows('home', $post_id)) : the_row();
        
        // Get the current layout name
        $layout = get_row_layout();
        
        // Map layout names to template files
        $template_map = array(
            'hero_section' => 'hero-section',
            'client_logos' => 'client-logos',
            'counter_section' => 'counter-section',
            'our_expertise' => 'our-expertise',
            'cta_banner' => 'cta-banner',
            'why_choose_elsner' => 'why-choose-elsner',
            'success_stories' => 'success-stories',
            'industries_served' => 'industries-served',
            'featured_in' => 'featured-in',
            'meet_our_experts' => 'meet-our-experts',
            'technology_partners' => 'technology-partners',
            'testimonials' => 'testimonials',
            'business_contact_detail' => 'business-contact-detail',
            'tech_stack' => 'tech-stack',
            'home_page_faq_section' => 'home-page-faq-section',
        );
        
        // Get the template file name
        $template_name = isset($template_map[$layout]) ? $template_map[$layout] : null;
        
        // Include the template if it exists
        if ($template_name) {
            $template_path = 'rev-template-part/Home/' . $template_name;
            get_template_part($template_path, null, array('post_id' => $post_id));
        }
        
    endwhile;
endif;
?>


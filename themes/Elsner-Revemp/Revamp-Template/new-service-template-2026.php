<?php
/**
 * Template Name: New Service Template 2026
 *
 * Flexible content driven template. All sections are managed via ACF
 * "Page Sections" flexible content field. Each layout maps to a dedicated
 * partial in template-parts/service-section-template-26/.
 *
 * @package YourTheme
 */

get_header();

$post_id       = get_the_ID();
$page_sections = get_field( 'page_sections', $post_id );

if ( ! empty( $page_sections ) ) :
    foreach ( $page_sections as $layout ) :

        // Pass the full layout row + post_id into every partial.
        $section_args = array(
            'post_id' => $post_id,
            'layout'  => $layout,
        );

        switch ( $layout['acf_fc_layout'] ) {

            case 'banner_section':
                get_template_part(
                    'template-parts/service-section-template-26/banner',
                    'section',
                    $section_args
                );
                break;

            case 'client_logo_section':
                get_template_part(
                    'template-parts/service-section-template-26/client-logo',
                    'section',
                    $section_args
                );
                break;

            case 'right_image_leftcontent_section':
                get_template_part(
                    'template-parts/service-section-template-26/right-image-leftcontent',
                    'section',
                    $section_args
                );
                break;

            case 'development_service_include_section':
                get_template_part(
                    'template-parts/service-section-template-26/development-service-include',
                    'section',
                    $section_args
                );
                break;

            case 'why_choose_new_section':
                get_template_part(
                    'template-parts/service-section-template-26/why-choose-new',
                    'section',
                    $section_args
                );
                break;

            case 'why_choose_blue_section':
                get_template_part(
                    'template-parts/service-section-template-26/why-choose-blue',
                    'section',
                    $section_args
                );
                break;

            case 'new_service_clutch_section':
                get_template_part(
                    'template-parts/service-section-template-26/new-service-clutch',
                    'section',
                    $section_args
                );
                break;

            case 'awards_badges_section':
                get_template_part(
                    'template-parts/service-section-template-26/awards-badges',
                    'section',
                    $section_args
                );
                break;

            case 'tabination_section':
                get_template_part(
                    'template-parts/service-section-template-26/tabination',
                    'section',
                    $section_args
                );
                break;

            case 'recent_casestudy_section':
                get_template_part(
                    'template-parts/service-section-template-26/recent-casestudy',
                    'section',
                    $section_args
                );
                break;

            case 'b2b_cta_section':
                get_template_part(
                    'template-parts/service-section-template-26/b2b-cta',
                    'section',
                    $section_args
                );
                break;

            case 'website_workflow_section':
                get_template_part(
                    'template-parts/service-section-template-26/website-workflow',
                    'section',
                    $section_args
                );
                break;

            case 'b2b_testimonial_section':
                get_template_part(
                    'template-parts/service-section-template-26/b2b-testimonial',
                    'section',
                    $section_args
                );
                break;

            case 'dedicated_team_section':
                get_template_part(
                    'template-parts/service-section-template-26/dedicated-team',
                    'section',
                    $section_args
                );
                break;

            case 'blog_section':
                get_template_part(
                    'template-parts/service-section-template-26/blog',
                    'section',
                    $section_args
                );
                break;

            case 'faq_section':
                get_template_part(
                    'template-parts/service-section-template-26/faq',
                    'section',
                    $section_args
                );
                break;

            case 'b2b_contact_section':
                get_template_part(
                    'template-parts/service-section-template-26/b2b-contact',
                    'section',
                    $section_args
                );
                break;
            
            case 'development_service_section':
                get_template_part(
                    'template-parts/service-section-template-26/development-service',
                    'section',
                    $section_args
                );
                break;

            case 'development_cta_section':
                get_template_part(
                    'template-parts/service-section-template-26/development-cta',
                    'section',
                    $section_args
                );
                break;

            case 'why_choose_client_block_section':
                get_template_part(
                    'template-parts/service-section-template-26/why-choose-client-block',
                    'section',
                    $section_args
                );
                break;

            case 'why_choose_development_section':
                get_template_part(
                    'template-parts/service-section-template-26/why-choose-development-section',
                    'section',
                    $section_args
                );
                break;

            case 'workflow_website_development_section':
                get_template_part(
                    'template-parts/service-section-template-26/workflow-website-development',
                    'section',
                    $section_args
                );
                break;

            case 'magento_tab_integration_section':
                get_template_part(
                    'template-parts/service-section-template-26/magento-tab-integration',
                    'section',
                    $section_args
                );
                break;
        }

    endforeach;
endif;

get_footer();

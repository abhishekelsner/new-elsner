<?php

/* Template Name: Industry Page Template */
get_header();
get_template_part('template-parts/industry-page/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/jewellery-logo', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/service-integration', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/industry-page-listing', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/industry-feature', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/client', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/our-achievements', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/faq', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/industry-page/b2b-contact', 'section', array('post_id' => get_the_ID()));
get_footer();
?>

<!-- <style>
    body.page-template.page-template-Revamp-Template.page-template-industries-page-template .main-wrapper {
        overflow: unset;
    }

    section.industry-page.awards-badges-section {
        position: relative;
        overflow: hidden;
    }

    .feature-grid .feature-grid__wrapper {
        align-items: flex-start;
    }

    .feature-grid .feature-grid__wrapper .feature-grid__image-box.col-lg-6,
    .services-integration__menu {
        position: sticky;
        top: 100px;
    }


    @media (max-width:992px) {

        .feature-grid .feature-grid__wrapper .feature-grid__image-box.col-lg-6,
        .services-integration__menu {
            position: static;
        }
    }
</style> -->
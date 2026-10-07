<?php
/* Template Name: Pricing package */
get_header();

get_template_part('template-parts/SEO-package/banner', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/SEO-package/seo-package', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/SEO-package/seo-audit-form', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));

get_footer();

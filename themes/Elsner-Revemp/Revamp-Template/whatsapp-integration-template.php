<?php
/* Template Name: Whatsapp Integration Template */
$magento_free_upgrade_page = is_page('magento-free-upgrade');
$template_part_banner = $magento_free_upgrade_page ? 'template-parts/Industries/banner' : 'template-parts/services/banner';
$template_part_service_request = $magento_free_upgrade_page ? 'template-parts/Industries/request-section' : 'template-parts/services/service-request-quote';

get_header();
get_template_part($template_part_banner, 'section' , array('post_id' => get_the_ID()));
get_template_part('template-parts/home/expertise', 'section', array('post_id' => get_the_ID()));
get_template_part($template_part_service_request, 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/development-include', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/whatsapp-page/business-benefit', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/home/industries', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/whatsapp-page/built-trust', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/Industries/industries-cta', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/faq', 'section', array('post_id' => get_the_ID()));
//get_template_part('template-parts/global-template/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/services/ecommerce-cta', 'section', array('post_id' => get_the_ID()));
get_template_part('template-parts/global-template/acknowledgement', 'section', array('post_id' => get_the_ID()));

get_footer();
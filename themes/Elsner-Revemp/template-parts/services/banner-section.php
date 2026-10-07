<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$attachment_id = get_field('service_image', $post_id);
$size = "full"; // (thumbnail, medium, large, full or custom size)
$service_image = get_field('service_background_image', $post_id);
$service_image_alt_tag = get_field('service_image_alt_tag', $post_id);
$service_background_image = wp_get_attachment_image_src($service_image, $size);
$ppc_supportplan_pages = is_page(array(36808, 36741, 36811, 36816, 36823));
?>
<section class="services-banner">
    <?php if (get_field('service_background_image')) : ?>
        <img class="service-bg" src="<?php echo  $service_background_image[0]; ?>" alt="background image" width="1920"
            height="1080">
    <?php endif; ?>
    <div class="container-full">
        <div class="row alinc">
            <div class="col-md-6">
                <div class="services-heading">
                    <div class="breadcrumb-wrapper">
                        <?php custom_breadcrumbs(); ?>
                    </div>
                    <h1><?php echo get_field('banner_title', $post_id); ?></h1>
                    <div class="comtent">
                        <?php the_content(); ?>
                    </div>
                    <?php
                    $contact_link = $ppc_supportplan_pages ? esc_url('#wpcf7-f29778-o2') : esc_url($contact_us_link);
                    // $get_a_quote_button = (is_page(36998)) ? 'view plans' : 'Get a Free Quote';
                    $get_a_quote_button = (is_page(36998) || is_page(36808)) ? 'view plans' : 
                    ((is_page(35323)) ? 'Choose Your Package' : 
                    ((is_page(4304)) ? 'Schedule A Free Consultation' : 
                    ((is_page(46395)) ? 'Get Free Shopify Quote' : 
                    ((is_page(15223)) ? 'Request a Free Quote' : 
                    ((is_page(4290)) ? 'Get Free Magento Quote' : 
                    ((is_page(44949)) ? 'Get a Quote' : 
                    ((is_page(36223) || is_page(45931)) ? 'LEAD MARKET WITH PIMCORE' :
                    ((is_page(45743)) ? 'Get Free Magento Quote':
                    ((is_page(46073)) ? 'GET A WOOCOMMERCE QUOTE' : 'Get Free Quote')))))))));

                    // $get_a_quote_button = (is_page(36998) || is_page(36808)) ? 'view plans' : ((is_page(35323)) ? 'Choose Your Package' : ((is_page(4304)) ? 'Schedule A Free Consultation' : ((is_page(4312)) ? 'Get Free Shopify Quote' : ((is_page(15223)) ? 'Request a Free Quote' : ((is_page(4290)) ? 'Get Free Magento Quote' : 'Get Free Quote')))));
                    $contact_link = (is_page(36998)) ? esc_url('#service-package-section') : ((is_page(36808)) ? esc_url('#package-plan-section') : $contact_link);
                    $contact_link = (is_page(36998)) ? esc_url('#service-package-section') : $contact_link;

                    $banner_cta_link = get_field('banner_cta_link');
                    if( $banner_cta_link ){
                      $contact_link = esc_url($banner_cta_link['url']);
                      $get_a_quote_button = esc_html($banner_cta_link['title']);
                      $contact_link_target = !empty($banner_cta_link['target']) ? ' target="' . esc_attr($banner_cta_link['target']) . '"' : '';
                    }

                    $banner_button_class = (is_page(36998)) ? 'btn btn-secondary' : 'btn btn-primary';
                    ?>
                    <a href="<?php echo esc_url($contact_link); ?>"
                        class="<?php echo $banner_button_class; ?>"><?php echo $get_a_quote_button; ?></a>
                    <?php $hyva_class = is_page('hyva-theme-development-services') || is_page('magento-upgrade-service') || is_page('magento-2-migration-services') || is_page('magento-support-plan') ? 'service-label logo-small' : 'service-label'; ?>
                    <div class="<?= $hyva_class ?>">
                        <?php if (get_field('services_label_images')) : ?>
                            <img src="<?php echo get_field('services_label_images', $post_id); ?>" alt="service labels"
                                width="500" height="88" loading="lazy">
                        <?php endif; ?>
                        <?php if (get_field('services_label_images2')) : ?>
                            <img src="<?php echo get_field('services_label_images2', $post_id); ?>" alt="service labels"
                                width="500" height="88" loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php $services_image_class = (is_page(28656)) ? 'services-image extension' : 'services-image'; 
                $attachment_id = get_field('service_image', $post_id);
                $alt = get_field('service_image_alt_tag', $post_id);
                
                if (!$alt) {
                    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                }
                ?>
                <div class="<?php echo $services_image_class; ?>">
                    <?php

                    $image = wp_get_attachment_image_src($attachment_id, $size);
                    ?>
                    <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr($alt); ?>" width="1200" height="920" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
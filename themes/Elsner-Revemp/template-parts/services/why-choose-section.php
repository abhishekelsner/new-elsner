<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$show_section  = get_field('show_yesno_request_business', $post_id);
$why_choose_section_image_alt_tag = get_field('why_choose_section_image_alt_tag', $post_id);


if ($show_section === true) {
?>

    <section class="why-choose-section blue-section">
        <div class="row m-0">
            <div class="col-md-6 p-0">
                <div class="why-choose-block request-quoteHead">
                    <h2 class="Redhat-font"><?php echo get_field('why_choose_heading', $post_id); ?></h2>
                    <div class="why-choose-content">
                        <?php echo get_field('why_choose_description', $post_id); ?>
                    </div>
                    <div class="counting-stats">
                        <div class="row">
                            <?php if (have_rows('counter', $post_id)) : ?>
                                <?php while (have_rows('counter', $post_id)) : the_row(); ?>
                                    <div class="col-sm-6 service-stats">
                                        <div class="counter-col">
                                            <span class="timer"
                                                data-count="<?php echo esc_html(get_sub_field('counter_number', $post_id)); ?>">
                                                <?php echo esc_html(get_sub_field('counter_number', $post_id)); ?>
                                            </span>
                                            <span><?php echo esc_html(get_sub_field('counter_symbol', $post_id)); ?></span>
                                            <h5><?php echo esc_html(get_sub_field('counter_text', $post_id)); ?></h5>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $contact_us_button_link = (is_page(36998)) ? '#service-package-section' : esc_url($contact_us_link);
                    if (is_page('wordpress-development')) {
                        $contact_us_button_link = '#get-touch-digital';
                    }
                    // Change URL to SEO Packages for page ID 4180
                    if (is_page(24621)) {
                        $contact_us_button_link = 'https://www.elsner.com/seo-packages/';
                    }
                    if (!is_page('whatsapp-chatbot-integration')) { ?>
                        <?php $why_choose_section_cta_link = get_field('why_choose_section_cta_link');
                        if( $why_choose_section_cta_link ){
                          $contact_us_button_link = esc_url($why_choose_section_cta_link['url']);
                          $contact_us_button_title = esc_html($why_choose_section_cta_link['title']);
                          $contact_us_button_target = !empty($why_choose_section_cta_link['target']) ? ' target="' . esc_attr($why_choose_section_cta_link['target']) . '"' : '';
                          ?>
                            <a href="<?php echo $contact_us_button_link; ?>" class="btn btn-secondary"><?php echo $contact_us_button_title; ?></a>
                        <?php }else{ ?>
                            <a href="<?php echo $contact_us_button_link; ?>" class="btn btn-secondary">
                                <?php if (is_page(36998)) {
                                    echo "View Plans";
                                } elseif (is_page('wordpress-development')) { 
                                    echo "Get Custom WordPress Quote"; // Text for the WordPress Development page
                                }elseif (is_page('shopify-development')) { 
                                    echo "Hire Shopify Expert"; // Text for the Shopify Development page
                                } elseif (is_page('magento-development')) { 
                                    echo "Hire Our Magento Expert"; // Text for the Magento Expert Development page
                                }elseif (is_page('magento-2-migration-services')) { 
                                    echo "Migrate Your Magento Store"; // Text for the Magento Development page
                                }elseif (is_page('odoo-development')) { 
                                    echo "Hire Our Odoo Expert"; // Text for the Hire Our Odoo Expert page
                                }elseif (is_page('pimcore-development')) { 
                                    echo "LET'S MAP YOUR SUCCESS"; // Text for the WordPress Development page
                                }  
                                else {
                                    echo "Start Project";
                                } ?></a>

                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="why-choose-image">
                    <img src="<?php echo get_field('why_choose_section_image', $post_id); ?>" alt="<?php echo $why_choose_section_image_alt_tag; ?>"
                        width="950" height="100%">
                </div>
            </div>
        </div>
    </section>

<?php
}
?>
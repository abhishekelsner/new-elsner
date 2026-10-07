<?php
// Retrieve the post ID from the $args array
global $contact_us_link, $contact_form;
$post_id = $args['post_id'];
$show_section  = get_field('show_yesno_request', $post_id);
$show_hidden_content = get_field('show_hidden_content', $post_id);
$request_quote_image_alt_tag = get_field('request_quote_image_alt_tag', $post_id);

// $service_banner_title   = get_field('service_banner_title', $post_id);
if ($show_section == true) {
?>

<section class="request-quote blue-section padding-120" id="service-request-quote">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="request-quoteHead">
                    <h2 class="Redhat-font"><?php echo get_field('request_quote_heading', $post_id); ?></h2>
                    <div class="content">
                        <?php echo get_field('request_quote_content', $post_id); ?>
                        <div class="hidden-content">
                            <?php if ($show_hidden_content == true) {
                                    echo get_field('request_quote_hidden_content', $post_id);
                                } ?>
                        </div>
                        <?php
                            $current_page_id = get_the_ID();
                            if ($current_page_id === 24621) {
                                // echo '<a href="#" class="btn btn-secondary read-more-btn">Read More</a>';
                            }
                            ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (is_page('whatsapp-chatbot-integration') || is_page('erpnext-solutions')){ ?>
                <div class="request-form1">
                <?php }else{ ?>
                <div class="request-form">
                 
                    <?php
                }
                    if (is_page(36998)) {
                        // Check if it's the specific page
                        $request_quote_title = 'Contact Us';
                        echo '<h3>' . esc_html($request_quote_title) . '</h3>';
                        echo '<div class="form-quote">' . do_shortcode($contact_form) . '</div>';
                    } elseif (is_page('whatsapp-chatbot-integration')) {
                        // Check if it's the page with the slug 'whatsapp-chatbot-integration'
                        echo '<img src="https://www.elsner.com/wp-content/uploads/2024/02/Personalization.png" alt="'.$request_quote_image_alt_tag.'">';
                    }
                    elseif (is_page('erpnext-solutions')) {
                        // Check if it's the page with the slug 'whatsapp-chatbot-integration'
                        echo '<img src="https://www.elsner.com/wp-content/uploads/2024/02/Unique-needs-being-fulfilled-with-ERPnext.svg" alt="Your Image Alt Text">';}
                         else {
                        // Default case (Request a Free Quote)
                        $request_quote_title = 'Request a Free Quote';
                        echo '<h3>' . esc_html($request_quote_title) . '</h3>';
                        echo '<div class="form-quote">' . do_shortcode($contact_form) . '</div>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
}
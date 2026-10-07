<?php
// Retrieve the post ID from the $args array
global $contact_us_link, $contact_form;
$post_id = $args['post_id'];
$show_section  = get_field('show_yesno_request', $post_id);
// $service_banner_title   = get_field('service_banner_title', $post_id);
if ($show_section == true) {
?>

    <section class="request-quote blue-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="request-quoteHead">
                        <h2 class="Redhat-font"><?php echo get_field('request_quote_heading', $post_id); ?></h2>
                        <div class="content">
                            <?php echo get_field('request_quote_content', $post_id); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="request-form">
                        <h3>Request a Free Quote</h3>
                        <div class="form-quote">
                            <?php echo do_shortcode($contact_form); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}

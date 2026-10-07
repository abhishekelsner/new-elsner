<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$partner_button_text = get_field('partner_button_text', $post_id);
global $contact_us_link;
?>

<section class="partner-alliances-section">
    <div class="container">
        <div class="partner-row">
            <div class="row">
            
            <?php
                $partners = get_transient('partners_query');

                if (!$partners) {
                    $partners = new WP_Query(array(
                        'post_type' => 'partner',
                        'posts_per_page' => '-1',
                    ));

                    set_transient('partners_query', $partners_query, DAY_IN_SECONDS);
                }

                if ($partners->have_posts()) {
                    $count = 0;
                    while ($partners->have_posts()) {
                        $partners->the_post();
                        $partner_label = get_the_title();
                        $partner_image = get_the_post_thumbnail_url();
                        $partner_image_id = get_post_thumbnail_id();
                        $partner_image_alt = get_post_meta($partner_image_id, '_wp_attachment_image_alt', true);

                        if (empty($partner_image_alt)) {
                            $partner_image_alt = 'partner logo';
                        }
                        $partner_description = get_the_content();
                        $partner_label_color      = get_field('color', get_the_ID());
                        if (!$partner_label_color) {
                            $partner_label_color = '#4C8CCA';
                        }
                        ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="partner-card">
                                    <div class="partner-label" style="background: <?php echo $partner_label_color; ?>"><?php echo $partner_label; ?></div>
                                    <img  src="<?php echo $partner_image; ?>" alt="<?php echo esc_attr($partner_image_alt); ?>" height="60" width="100%" loading="lazy">
                                    <p><?php echo $partner_description; ?></p>
                                </div>
                            </div>

                        <?php
                    $count++;
                    }
                    wp_reset_postdata();
                }
            ?>
            </div>
            <div class="view-all text-center">
                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary"><?php echo $partner_button_text; ?></a>
            </div>
        </div>
    </div>
</section>
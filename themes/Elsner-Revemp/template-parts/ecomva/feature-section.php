<?php
// Retrieve the post ID from the $args array
$post_id                = $args['post_id'];
$heading_feature        = get_field('heading_feature', $post_id);
$feature_app_desc            = get_field('description', $post_id);
$show                   = get_field('show_mobile', $post_id);
$feature_image          = get_field('feature_image', $post_id);
$full_image             = wp_get_attachment_image_src($feature_image, 'full');
if ($show != true) {
    return;
}
?>
<section class="virtual-service-section padding-80 blue-section">
    <div class="container">
        <div class="virtual-service-wrapper">
            <div class="row alinc">
                <div class="col-md-6">
                    <div class="request-quoteHead">
                        <h2 class="Redhat-font"><?php echo esc_html($heading_feature); ?></h2>
                        <?php echo get_the_content(); ?>
                        <div class="service-data">
                            <?php echo $feature_app_desc; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="virtual-image">
                        <img src="<?php echo $full_image[0]; ?>" alt="Virtual image" width="600" height="400">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
$post_id                = $args['post_id'];
$heading_virtual        = get_field('heading_virtual', $post_id);
$sub_heading_virtual    = get_field('sub_heading_virtual', $post_id);
$image                  = get_field('image', $post_id);
$full_image             = wp_get_attachment_image_src($image, 'full');
$show                 = get_field('show_virtual', $post_id);
if ($show != true) {
    return;
}
?>
<section class="virtual-service-section padding-80">
    <div class="container">
        <div class="virtual-service-wrapper">
            <div class="row alinc">
                <div class="col-md-6">
                    <div class="request-quoteHead">
                        <h2 class="Redhat-font"><?php echo $heading_virtual; ?></h2>
                        <div class="service-data">
                            <?php echo $sub_heading_virtual; ?>
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
<?php
// Retrieve the post ID from the $args array
$post_id              = $args['post_id'];
$banner_image         = get_field('banner_image', $post_id);
$heading_wrapper      = get_field('headings', $post_id);
$full_image = wp_get_attachment_image_src($banner_image, 'full');
$show                 = get_field('show', $post_id);
if ($show != true) {
    return;
}
?>
<section class="ecomva-banner-section padding-120" style="background-image: url(<?php echo $full_image[0]; ?>;);">
    <div class="container">
        <div class="ecomva-banner-wrapper">
            <div class="ecomva-logos">
                <?php
                if (have_rows('logos')) :
                    while (have_rows('logos')) : the_row();
                        $logo = get_sub_field('logo', $post_id);
                        $full_image = wp_get_attachment_image_src($logo, 'full');
                ?>
                        <img src="<?php echo $full_image[0]; ?>" alt="logo" width="120" height="120" loading="lazy">

                <?php
                    endwhile;
                endif;
                ?>
            </div>
            <div class="heading-wrapper white-text">
                <?php echo $heading_wrapper; ?>
            </div>
        </div>
    </div>
</section>
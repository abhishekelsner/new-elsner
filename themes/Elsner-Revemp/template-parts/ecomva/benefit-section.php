<?php
// Retrieve the post ID from the $args array
$post_id                = $args['post_id'];
$heading_benefit        = get_field('heading_benefit', $post_id);
$sub_heading_benefit    = get_field('sub_heading_benefit', $post_id);
$show                 = get_field('show_benefit', $post_id);
if ($show != true) {
    return;
}
?>
<section class="benefit-ecomva-section blue-section padding-80">
    <div class="container">
        <div class="heading-wrapper white-text mb-4">
            <h2><?php echo esc_html($heading_benefit); ?></h2>
            <h6><?php echo esc_html($sub_heading_benefit); ?></h6>
        </div>
        <div class="benefit-wrapper">
            <div class="row">
                <?php
                if (have_rows('benefit_list')) :
                    while (have_rows('benefit_list')) : the_row();
                        $title = get_sub_field('title', $post_id);
                        $content = get_sub_field('content', $post_id);
                        $service_icon = get_sub_field('image', $post_id);
                        $full_image = wp_get_attachment_image_src($service_icon, 'full');
                ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="ecomva-benefit-box">
                                <img src="<?php echo $full_image[0]; ?>" alt="services Icon" width="60" height="50">
                                <h5 class="Redhat-font"><?php echo esc_html($title); ?></h5>
                                <p><?php echo esc_html($content); ?></p>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
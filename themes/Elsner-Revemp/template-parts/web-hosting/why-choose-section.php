<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading_service    = get_field('heading_service', $post_id);
$heading_wrapper    = get_field('headings', $post_id);
$show                 = get_field('show_service', $post_id);
if ($show != true) {
    return;
}
?>
<section class="services-section padding-80 ecomva-service-section">
    <div class="container">
        <div class="block-title text-center width-900">
            <h2><?php echo $heading_service; ?></h2>
        </div>
        <div class="service-wrapper">
            <div class="row">
                <?php
                $count = 1;
                if (have_rows('service_list')) :
                    while (have_rows('service_list')) : the_row();
                        $title = get_sub_field('title', $post_id);
                        $content = get_sub_field('content', $post_id);
                        $service_icon = get_sub_field('image', $post_id);
                        $full_image = wp_get_attachment_image_src($service_icon, 'full');
                ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-list">
                                <div class="service-list-content">
                                    <img src="<?php echo $full_image[0]; ?>" alt="services Icon" width="60" height="50">
                                    <h3><?php echo esc_html($title); ?></h3>
                                    <p><?php echo esc_html($content); ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                        $count++;
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
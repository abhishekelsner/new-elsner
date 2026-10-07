<?php
$post_id = $args['post_id'];
$process_heading = get_field('heading_process', $post_id);
$process_image = get_field('process_image', $post_id);
$full_image = wp_get_attachment_image_src($process_image, 'full');
?>
<section class="process-service padding-80">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo esc_html($process_heading); ?></h2>
        </div>
        <div class="process-image-service">
            <img src="<?php echo $full_image[0]; ?>" alt="Process image" width="1200" height="600" loading="lazy">
        </div>
    </div>
</section>
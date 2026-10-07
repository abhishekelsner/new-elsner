<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$attachment_id = get_field('service_image', $post_id);
$size = "full";
$service_image = get_field('service_background_image', $post_id);
$service_background_image = wp_get_attachment_image_src($service_image, $size);

$button_text = get_field('button_text', $post_id);
if (!$button_text) {
    $button_text = 'Get a Free Quote';
}

?>
<section class="services-banner">
    <?php if (get_field('service_background_image')) : ?>
        <img class="service-bg" src="<?php echo  $service_background_image[0]; ?>" alt="background image" width="1920" height="1080">
    <?php endif; ?>
    <div class="container-full">
        <div class="row alinc">
            <div class="col-md-6">
                <div class="services-heading">
                    <h1><?php echo get_field('qa_heading', $post_id); ?></h1>
                    <div class="comtent">
                        <?php the_content(); ?>
                    </div>
                    <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-primary"><?php echo $button_text; ?></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="services-image">
                    <?php
                    $image = wp_get_attachment_image_src($attachment_id, $size);
                    ?>
                    <img src="<?php echo $image[0]; ?>" alt=" services-image" width="1200" height="920" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
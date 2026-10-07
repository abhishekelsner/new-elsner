<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$gradient_color_1 = get_field('gradient_color_1', $post_id);
$gradient_color_2 = get_field('gradient_color_2', $post_id);
$gradient_angle = get_field('gradient_angle', $post_id);
?>
<section class="expertise-section b2b-brands-logos padding-80 section " id="section1">
    <div class="brands">
        <div class="heading-wrapper">
            <h2 class="head text-center">Our Clients</h2>
        </div>
        <ul class="b2b-client-logos-slider slick-slider">
            <?php if (have_rows('b2b_clients_repeater', 'option')) : ?>
            <?php while (have_rows('b2b_clients_repeater', 'option')) : the_row(); ?>
            <?php $image_id = get_sub_field('b2b_clients_logos', 'option'); ?>
            <li>
                <img class="lazy" src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>"
                    alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                    title="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                    style="width: 100%; height: 100%;" loading="lazy">
            </li>
            <?php endwhile; ?>
            <?php endif; ?>
        </ul>

    </div>
</section>
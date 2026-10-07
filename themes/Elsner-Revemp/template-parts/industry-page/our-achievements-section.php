<?php
$post_id = $args['post_id'];
$achievements_title = get_field('industry_page_our_achievements_title');
 ?>
<section class="industry-page awards-badges-section">
    <div class="clutch-badges">
        <div class="block-title text-center max-700">
            <h2><?php echo esc_html($achievements_title); ?></h2>
        </div>
        <div class="row clutch-badges-slider slick-slider">
            <?php if (have_rows('clutch_badges_repeater_section', 'option')) : ?>
            <?php while (have_rows('clutch_badges_repeater_section', 'option')) : the_row(); ?>
            <?php $image_id = get_sub_field('clutch_badges_images', 'option');?>

            <div class="clutch-awards-badges">
                <div class="clutch-badges-image">
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>"
                        alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                        title="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                        width="450" height="550" loading="lazy">
                </div>

            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
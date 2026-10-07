<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$banner_heading   = get_field('heading', $post_id);
$banner_subheading   = get_field('subheading', $post_id);
$banner_content = get_field('banner-content', $post_id);
$certified_block = get_field('certified_block', $post_id);
?>

<section class="awrads-banner-section">
    <div class="container">
        <div class="awrads-banner-wrapper white-text">
            <div class="row alinc">
                <div class="col-lg-4 col-md-5">
                    <div class="heading">
                        <?php echo $banner_heading; ?>
                        <?php echo $banner_subheading; ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="awrads-banner-content">
                        <p><?php echo esc_html($banner_content); ?> </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="clutch-badges">
            <div class="row">
                <?php if (have_rows('clutch_badges_repeater_section', 'option')) : ?>
                <?php while (have_rows('clutch_badges_repeater_section', 'option')) : the_row(); ?>
                <?php $image_id = get_sub_field('clutch_badges_images', 'option');?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="clutch-awards-badges">
                        <div class="clutch-badges-image">
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>"
                            alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                            title="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                            width="450" height="550" loading="lazy">
                        </div>
                        <div class="clutch-badges-title">
                            <h4 class="Redhat-font">
                                <?php echo esc_html(get_sub_field('clutch_badges_title', 'option')); ?></h4>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="certified-grid">
            <?php if (have_rows('certified_block', $post_id)) : ?>
            <?php while (have_rows('certified_block', $post_id)) : the_row(); ?>
            <div class="certified-block">
                <div class="certified-logo">
                    <img src="<?php echo esc_url(get_sub_field('certified_image', $post_id)); ?>" alt="logo"
                        loading="lazy" width="110" height="auto">
                </div>
                <div class="certified-content">
                    <h4><?php echo esc_html(get_sub_field('certified_title', $post_id)); ?></h4>
                    <p><?php echo esc_html(get_sub_field('certified_content', $post_id)); ?></p>
                </div>
            </div>

            <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</section>
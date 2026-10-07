<?php
/**
 * Archive News Letter Banner
 */

$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

$banner_image   = get_field('news_letter_banner_image', $post_id);
$banner_title   = get_field('news_letter_banner_title', $post_id);
$banner_content = get_field('news_letter_banner_content', $post_id);

// Stop rendering if nothing is set
if (!$banner_image && !$banner_title && !$banner_content) {
    return;
}

// Image URL fallback safety
$bg_url = is_array($banner_image) ? $banner_image['url'] : $banner_image;
?>

<section class="news-hub-hero">
    <div class="container">
        <div class="news-hub-hero__bg"
            style="background-image: url('<?php echo esc_url($bg_url); ?>');">

            <div class="news-hub-hero__panel">
                <?php if ($banner_title): ?>
                    <h1 class="news-hub-hero__title">
                        <?php echo esc_html($banner_title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ($banner_content): ?>
                    <p class="news-hub-hero__text">
                        <?php echo esc_html($banner_content); ?>
                    </p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>


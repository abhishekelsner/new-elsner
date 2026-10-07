<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$background_image = get_sub_field('background_image');
$bg_video = get_sub_field('background_video_desktop'); // or get_field()
$cta_button = get_sub_field('cta_button');
$button_url = get_sub_field('button_url');
$bg_image_url = $bg_image ? $bg_image['url'] : '';

// Get background image URL safely
$bg_image_url = '';
if ( $background_image ) {
    $bg_image_url = is_array($background_image)
        ? $background_image['url']
        : $background_image;
}
?>
<section class="hero-section section blue-section"
    style="<?php echo (!$bg_video && $bg_image_url) ? 'background-image:url(' . esc_url($bg_image_url) . ');' : ''; ?>">

    <?php if ( $bg_video ): ?>
        <video 
            class="hero-bg-video" 
            autoplay 
            muted 
            loop 
            playsinline 
            preload="none"
            poster="<?php echo esc_url($bg_image_url); ?>"
        >
            <!-- Optional WebM for better compression -->
            <?php if ( ! empty( $bg_video_webm['url'] ) ): ?>
                <source src="<?php echo esc_url( $bg_video_webm['url'] ); ?>" type="video/webm">
            <?php endif; ?>

            <!-- MP4 fallback -->
            <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
                    type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
        </video>
    <?php endif; ?>    

    <div class="container">
        <div class="hero-wrapper">
            <div class="hero-content white-text">
                <?php if ($title) : ?>
                    <h1><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                <?php if ($subtitle) : ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
                <?php if ($cta_button && $button_url) : ?>
                    <div class="hero-btn">
                        <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                            <?php echo esc_html($cta_button); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<style>
    .hero-section {
    position: relative;
    overflow: hidden;
}

/* Video background */
.hero-bg-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

/* Content stays above */
.hero-section .container {
    position: relative;
    z-index: 2;
}
</style>
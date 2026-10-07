<?php
/**
 * Industry Page Banner Section - Dynamic from Page
 */
$post_id = $args['post_id'] ?? get_queried_object_id();

// Get data from the current page
$banner_title     = get_the_title($post_id);
$banner_content = get_field('industry_page_banner_content', $post_id);
$industry_banner_button = get_field('industry_banner_button', $post_id);
$banner_image_url = get_the_post_thumbnail_url($post_id, 'full');
?>

<section class="industry-banner">
    <div class=" container">
        <div class="industry-banner__wrapper row">
            
            <div class="industry-banner__content-col col-lg-6  col-sm-12">
                <?php if ( $banner_title ) : ?>
                    <h1 class="industry-banner__title">
                        <?php echo esc_html($banner_title); ?>
                    </h1>
                <?php endif; ?>

                <?php if ( $banner_content ) : ?>
                    <div class="industry-banner__description">
                        <p><?php echo $banner_content; ?></p>
                    </div>
                <?php endif; ?>
                <div class="industry-banner__btn form-group submit-btn">
                    <a href="<?php echo !empty($industry_banner_button['url']) ? esc_url($industry_banner_button['url']) : '#'; ?>"
                    class="btn"
                    target="<?php echo !empty($industry_banner_button['target']) ? esc_attr($industry_banner_button['target']) : '_self'; ?>">
                        <?php echo !empty($industry_banner_button['title']) ? esc_html($industry_banner_button['title']) : 'Learn More'; ?>
                    </a>
                </div>
            </div>

            <div class="industry-banner__image-col col-lg-6  col-sm-12">
                <div class="industry-banner__image-wrapper">
                    <?php if ( $banner_image_url ) : ?>
                        <img 
                            src="<?php echo esc_url($banner_image_url); ?>" 
                            alt="<?php echo esc_attr($banner_title); ?>"
                            class="industry-banner__image"
                        >
                    <?php else : ?>
                        <div class="industry-banner__placeholder"></div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    document.querySelector('.industry-banner__btn').addEventListener('click', function(e) {
    e.preventDefault();

    const target = document.querySelector('#b2b-contact-form');
    const headerHeight = document.querySelector('header').offsetHeight;

    const targetPosition =
        target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

    window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
    });
});
</script>
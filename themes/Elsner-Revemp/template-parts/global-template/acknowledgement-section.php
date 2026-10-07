<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title_acknowledgement', 'option');
$section_content        = get_field('section_content_acknowledgement', 'option');
?>
<section class="acknowledgement-section pd-50">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="acknowledgement-slider slick-slider slider">
            <?php if (have_rows('acknowledgement_block', 'option')) : ?>
                <?php while (have_rows('acknowledgement_block', 'option')) : the_row(); ?>
                    <div class="slider-image">
                        <img src="<?php echo esc_url(get_sub_field('image', 'option')); ?>" loading="lazy" alt="acknowledgement logo" width="120">
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
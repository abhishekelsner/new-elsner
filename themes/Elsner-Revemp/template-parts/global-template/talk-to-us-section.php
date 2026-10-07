<?php
// Retrieve the post ID from the $args array
$section_title          = get_field('heading', 'option');
$section_image          = get_field('talk_to_us_image', 'option');
$cta_talk_to_us         = get_field('cta_talk_to_us', 'option');
$post_id                = $args['post_id'];
$current_url            = $_SERVER['REQUEST_URI'];
$parts                  = explode('-', $current_url);
$value                  = $parts[1];


?>
<section class="talk-to-section blue-section padding-120">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-6">
                <div class="talk-image-block">
                    <img src="<?php echo esc_url($section_image); ?>" alt="talk us" width="690" height="750">
                </div>
            </div>
            <div class="col-md-6">
                <div class="talk-us-content">
                    <div class="heading-wrapper text-left white-text">
                        <h2><?php echo str_replace('%page_title%', ucfirst($value . ' Developer'), $section_title); ?></h2>
                    </div>
                    <div class="cont">
                        <?php if (have_rows('feature', 'option')) : ?>
                            <?php while (have_rows('feature', 'option')) : the_row(); ?>
                                <h2><span style="font-weight: 400;"><?php echo get_sub_field('feature_label'); ?></span></h2>
                                <p><?php echo str_replace('%page_title%', ucfirst($value), get_sub_field('feature_content')); ?></p>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <a href="<?php echo esc_url($cta_talk_to_us); ?>" class="btn btn-secondary">talk to us</a>
                </div>
            </div>
        </div>
    </div>
</section>
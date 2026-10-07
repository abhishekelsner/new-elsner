<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title_achive', $post_id);
$section_content        = get_field('section_content_achive', $post_id);
?>
<section class="achieve-section pd-50 blue-section">
    <div class="container">
        <div class="heading-wrapper white-text max-700">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="counter-stats">
            <div class="row">

                <?php if (have_rows('counter', $post_id)) : ?>
                    <?php while (have_rows('counter', $post_id)) : the_row(); ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 stats">
                            <div class="counter-col">
                                <span class="timer" data-count="<?php echo esc_html(get_sub_field('count', $post_id)); ?>"><?php echo esc_html(get_sub_field('count', $post_id)); ?></span><span>+</span>
                                <h5><?php echo esc_html(get_sub_field('counter_name', $post_id)); ?></h5>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<section class="other-solution-section padding-80">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo get_field('heading_other_sol', $post_id); ?></h2>
            <h6><?php echo get_field('sub_heading_solution', $post_id); ?></h6>
        </div>
        <div class="acknowledgement-slider solution-slider slick-slider">
            <?php if (have_rows('solution_slider', $post_id)) : ?>
                <?php while (have_rows('solution_slider', $post_id)) : the_row(); ?>
                    <div class="slider-image">
                        <img src="<?php echo esc_url(get_sub_field('image', get_the_ID())); ?>" loading="lazy" width="120" alt="acknowledgement logo">
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
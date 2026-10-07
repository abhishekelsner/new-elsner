<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$why_choose_section_image = get_field('why_choose_section_image', $post_id);
$full_image = wp_get_attachment_image_src($why_choose_section_image, 'full');
?>

<section class="why-choose-section blue-section">
    <div class="row m-0">
        <div class="col-md-6 p-0">
            <div class="why-choose-block request-quoteHead">
                <h2 class="Redhat-font"><?php echo get_field('why_choose_heading', $post_id); ?></h2>
                <div class="why-choose-content">
                    <?php echo get_field('why_choose_description', $post_id); ?>
                </div>
                <div class="counting-stats">
                    <div class="row">
                        <?php if (have_rows('counter', $post_id)) : ?>
                            <?php while (have_rows('counter', $post_id)) : the_row(); ?>
                                <div class="col-sm-6 service-stats">
                                    <div class="counter-col">
                                        <span class="timer" data-count="<?php echo esc_html(get_sub_field('counter_number', $post_id)); ?>">
                                            <?php echo esc_html(get_sub_field('counter_number', $post_id)); ?>
                                        </span>
                                        <span>+</span>
                                        <h5><?php echo esc_html(get_sub_field('counter_text', $post_id)); ?></h5>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-secondary">start project</a>
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="why-choose-image">
                <img src="<?php echo $full_image[0]; ?>" alt="Why choose images">
            </div>
        </div>
    </div>
</section>
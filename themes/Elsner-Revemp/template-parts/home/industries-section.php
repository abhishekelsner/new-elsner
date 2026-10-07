<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
// Check if it's the homepage
$is_homepage = is_home() || is_front_page();
// Define the class based on the condition
$section_class = $is_homepage ? 'section-padding' : 'padding-80';
$container_class = $is_homepage ? 'inner-container' : 'container';
?>
<section class="industry-service section <?php echo $section_class; ?>" id="section3">
    <div class="<?php echo $container_class;?>">
        <div class="industry">
            <div class="heading">
                <?php echo get_field('industies_section_title', 'option'); ?>
                <h2 class="subhead">Serving our clients across diverse industries</h2>
            </div>
            <div class="industry-wrapper">
                <?php if (have_rows('indsutries_repeater', 'option')) : ?>
                <?php while (have_rows('indsutries_repeater', 'option')) : the_row(); ?>
                <div class="industry-block">
                    <img class="lazy" src="<?php the_sub_field('indsutries_image', 'option'); ?>" alt="industry logo"
                        height="45" width="60" loading="lazy">
                    <p><?php the_sub_field('indsutries_name', 'option'); ?></p>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="industry-counter row" id="counter">
            <?php if (have_rows('industries_data_counter', $post_id)) : ?>
            <?php while (have_rows('industries_data_counter', $post_id)) : the_row(); ?>
            <div class="counter-col col">
                <span class="timer"
                    data-count="<?php the_sub_field('count'); ?>"><?php the_sub_field('count'); ?></span><span>+</span>
                <p><?php the_sub_field('counter_name'); ?></p>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
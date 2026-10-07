<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title_value', $post_id);
$section_content        = get_field('section_content_value', $post_id);
?>
<section class="value-section pd-b-30">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="value-wrapper">
            <div class="row">

                <?php if (have_rows('value_block', $post_id)) : ?>
                    <?php while (have_rows('value_block', $post_id)) : the_row(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="value-block">
                                <img  src="<?php echo esc_url(get_sub_field('icon', $post_id)); ?>" alt="icon">
                                <h4 class="Redhat-font"><?php echo esc_html(get_sub_field('block_title', $post_id)); ?></h4>
                                <p><?php echo esc_html(get_sub_field('block_content', $post_id)); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
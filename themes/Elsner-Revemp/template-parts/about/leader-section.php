<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title_leader', $post_id);
$section_content        = get_field('section_content_leader', $post_id);

?>
<section class="leader-section pd-50">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="leader-wrapper">

            <?php if (have_rows('leader')) : ?>
                <?php while (have_rows('leader')) : the_row(); ?>
                    <div class="row alinc">
                        <div class="col-md-6">
                            <div class="leader-image">
                                <img  src="<?php echo esc_url(get_sub_field('image', $post_id)); ?>" alt="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="leader-content">
                                <h3><?php echo esc_html(get_sub_field('name', $post_id)); ?></h3>
                                <h4><?php echo esc_html(get_sub_field('designation', $post_id)); ?></h4>
                                <div class="content">
                                    <p><strong>"<?php echo esc_html(get_sub_field('quote', $post_id)); ?>"
                                        </strong></p>
                                    <p><?php echo esc_html(get_sub_field('description', $post_id)); ?></p>
                                </div>
                                <a href="<?php echo esc_url(get_sub_field('cta', $post_id)); ?>" class="btn btn-secondary"><?php echo esc_html('Connect Now'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title_venture', $post_id);
$section_content        = get_field('section_content_venture', $post_id);
?>
<section class="venture-section pd-50">
    <div class="container">
        <div class="heading-wrapper white-text max-700">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="technology-block">
            <div class="row">
                <?php if (have_rows('technology_block')) : ?>
                    <?php while (have_rows('technology_block')) : the_row();
                        $link  = get_sub_field('link');
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                                <div class="technology-content">
                                    <img src="<?php echo esc_url(get_sub_field('image', $post_id)); ?>" alt="Technology image" width="250" height="150">
                                    <h6><?php echo esc_html(get_sub_field('title', $post_id)); ?></h6>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
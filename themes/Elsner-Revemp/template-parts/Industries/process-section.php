<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$process_heading = get_field('process_heading', $post_id);
?>

<section class="our-process our-process-primary padding-80">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo $process_heading; ?></h2>
        </div>
        <div class="process-wrapper">
            <ul>
                <?php if (have_rows('process_items', $post_id)) : ?>
                    <?php while (have_rows('process_items', $post_id)) : the_row(); ?>
                        <li>
                            <div class="image">
                                <img  alt="process img" loading="lazy" src="<?php echo get_sub_field('process_image', get_the_ID()); ?>" width="40" height="40">
                            </div>
                            <h6><?php echo esc_html(get_sub_field('process_iteam_head', $post_id)); ?></h6>
                            <p><?php echo esc_html(get_sub_field('process_iteam_description', $post_id)); ?></p>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>
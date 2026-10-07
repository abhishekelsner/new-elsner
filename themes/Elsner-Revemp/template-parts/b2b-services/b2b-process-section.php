<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
?>

<section class="our-process b2b-process our-process-primary">
    <div class="container">
        <div class="heading-wrapper">
            <h2>Our Process</h2>
        </div>
        <div class="process-wrapper">
            <ul>
                <?php if (have_rows('b2b_process_repeater', $post_id)) : ?>
                <?php while (have_rows('b2b_process_repeater', $post_id)) : the_row(); ?>
                <li>
                    <div class="image">
                        <img alt="process img" loading="lazy"
                            src="<?php echo get_sub_field('b2b_process_icon', get_the_ID()); ?>" width="40" height="40">
                    </div>
                    <h6><?php echo esc_html(get_sub_field('b2b_process_title', $post_id)); ?></h6>
                    <p><?php echo esc_html(get_sub_field('b2b_process_content', $post_id)); ?></p>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>
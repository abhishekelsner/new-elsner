<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading_approch = get_field('heading_approch', $post_id);

?>
<section class="our-process padding-80 gray-bg">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo $heading_approch; ?></h2>
        </div>
        <div class="process-wrapper">
            <ul>
                <?php
                if (have_rows('process_approch', $post_id)) :
                    while (have_rows('process_approch', $post_id)) : the_row();
                        $image = get_sub_field('image', $post_id);
                        $full_image = wp_get_attachment_image_src($image, 'full');
                ?>
                        <li>
                            <div class="grow_image">
                                <img alt="process img" loading="lazy" src="<?php echo $full_image[0]; ?>" width="65" height="65">
                            </div>
                            <h6><?php echo esc_html(get_sub_field('title')); ?></h6>
                        </li>
                <?php
                    endwhile;
                endif;
                ?>

            </ul>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$show = get_field('section_show', $post_id);

if ($show == true) {
?>

    <div class="services-section padding-80">
        <div class="container">
            <div class="block-title text-center">
                <?php
                if (have_rows('local_seo_services', $post_id)) :
                    while (have_rows('local_seo_services', $post_id)) : the_row();
                ?>
                        <h3 class="Redhat-font"><?php echo get_sub_field('local_seo_heading', $post_id); ?></h3>
                        <h5 class="Redhat-font"><?php echo get_sub_field('local_seo_subheading', $post_id); ?></h5>
            </div>
            <div class="service-wrapper">
                <div class="row">
                    <?php
                        $count = 1;
                        if (have_rows('service_box', $post_id)) :
                            while (have_rows('service_box', $post_id)) : the_row();
                                $service_image = get_sub_field('service_image', $post_id);
                                $full_image = wp_get_attachment_image_src($service_image, 'full');
                    ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-list">
                                    <div class="service-list-content">
                                        <img src="<?php echo $full_image[0]; ?>" alt="Capability Icon" width="70" height="60">
                                        <p><?php echo get_sub_field('service_text'); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                                $count++;
                            endwhile;
                        endif; ?>
                </div>
            </div>
    <?php

                    endwhile;
                endif;
    ?>
        </div>
    </div>
<?php
}
?>
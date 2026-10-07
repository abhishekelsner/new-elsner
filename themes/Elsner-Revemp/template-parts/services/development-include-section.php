<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>

<section class="services-section padding-80">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo get_field('heading_main', $post_id); ?></h2>
        </div>
        <div class="service-wrapper">
            <div class="row">
                <?php if (have_rows('development_services_box', $post_id)) : ?>
                    <?php while (have_rows('development_services_box', $post_id)) : the_row(); ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-list">
                                <div class="service-list-num">
                                </div>
                                <div class="service-list-content">
                                    <?php $service_icon = get_sub_field('service_icon', $post_id);
                                        // Check if $service_icon is not empty
                                        if (!empty($service_icon)) {
                                            // Display the image tag if $service_icon is not empty
                                            echo '<img src="' . esc_url($service_icon) . '">';
                                    }?>  
                                    <h3><?php echo get_sub_field('service_head', $post_id); ?></h3>
                                    <p><?php echo get_sub_field('service_description', $post_id); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
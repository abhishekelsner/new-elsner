<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$services_heading = get_field('services_heading', $post_id);
$services_description = get_field('services_description', $post_id);
?>

<section class="custom-healthcare blue-section padding-80">
    <div class="container">
        <div class="heading-wrapper text-left white-text">
            <h2><?php echo $services_heading; ?></h2>
            <p><?php echo $services_description; ?></p>
        </div>
        <div class="healthcare-solutions white-text">
            <div class="row">
                <?php if (have_rows('services_menu', $post_id)) : ?>
                    <?php while (have_rows('services_menu', $post_id)) : the_row(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="healthcare-box">
                                <h6 class="Redhat-font"><?php echo esc_html(get_sub_field('service_menu_heading', $post_id)); ?></h6>
                                <p><?php echo esc_html(get_sub_field('service_menu_description', $post_id)); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
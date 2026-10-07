<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading_capabilities = get_field('heading_capabilities', $post_id);

?>

<div class="services-section padding-80">
    <div class="container">
        <div class="block-title text-center max-700">
            <h3 class="Redhat-font"><?php echo $heading_capabilities; ?></h3>
        </div>
        <div class="service-wrapper">
            <div class="row">

                <?php
                $count = 1;
                if (have_rows('services', $post_id)) :
                    while (have_rows('services', $post_id)) : the_row();
                        $list_image = get_sub_field('list_image', $post_id);
                        $full_image = wp_get_attachment_image_src($list_image, 'full');
                ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-list">
                                <div class="service-list-num">
                                </div>
                                <div class="service-list-content">
                                    <img src="<?php echo $full_image[0]; ?>" alt="Capability Icon" width="60" height="50">
                                    <p><?php echo get_sub_field('list_name'); ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                        $count++;
                    endwhile;
                endif;
                ?>

            </div>
        </div>
    </div>
</div>
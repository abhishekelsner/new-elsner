<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_heading   = get_field('heading_pricing', $post_id);
$banner_subheading   = get_field('sub_heading_pricing', $post_id);
?>

<section class="our-work-banner blue-section packages-banner">
    <div class="container">
        <div class="skillsets-wrapper">
            <div class="row alinc">
                <div class="col-lg-4 col-md-4">
                    <div class="heading white-text">
                        <h1><?php echo $banner_heading; ?></h1>
                        <h5 class="subhead"><?php echo $banner_subheading; ?></h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="work-banner-content">
                        <p><?php echo get_the_content(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
$post_id                 = $args['post_id'];
$banner_head             = get_field('banner_head', $post_id);
$banner_subhead          = get_field('banner_subhead', $post_id);
$banner_content          = get_field('banner_content', $post_id);
?>

<section class="our-work-banner blue-section testimonial-banner">
    <div class="container">
        <div class="skillsets-wrapper">
            <div class="row alinc">
                <div class="col-lg-6 col-md-6">
                    <div class="heading white-text">
                        <h1><?php echo $banner_head; ?></h1>
                        <h5 class="subhead"><?php echo $banner_subhead; ?></h5>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="work-banner-content">
                        <p><?php echo $banner_content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
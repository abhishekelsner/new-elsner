<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_heading   = get_field('banner_heading', $post_id);
$banner_sub_heading   = get_field('banner_sub_heading', $post_id);
$banner_content = get_field('banner_content', $post_id);
?>

<section class="our-work-banner blue-section partner-banner">
    <div class="container">
        <div class="skillsets-wrapper">
            <div class="row alinc">
                <div class="col-lg-4 col-md-4">
                    <div class="heading white-text">
                        <h1><?php echo $banner_heading; ?></h1>
                        <h5 class="subhead"><?php echo $banner_sub_heading; ?></h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="work-banner-content">
                        <p><?php echo $banner_content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
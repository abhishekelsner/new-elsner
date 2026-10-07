<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_heading   = get_field('banner_heading', $post_id);
$banner_subheading   = get_field('banner_sub_heading', $post_id);
$banner_content = get_field('banner_content', $post_id);
?>

<section class="our-work-banner  team-banner">
    <div class="breadcrumb-wrapper">
        <?php custom_breadcrumbs(); ?>
    </div>
    <div class="container">
        <div class="our-work-wrapper">
            <div class="row alinc">
                <div class="col-lg-5 col-md-6 ">
                    <div class="heading">
                        <h1><?php echo $banner_heading; ?></h1>
                        <h5 class="subhead"><?php echo $banner_subheading; ?></h5>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 ">
                    <div class="work-banner-content">
                        <p><?php echo $banner_content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
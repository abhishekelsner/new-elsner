<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_text    = get_field('heading_life_elsner', $post_id);
$sub_heading_life_elsner = get_field('sub_heading_life_elsner', $post_id);
?>
<section class="our-work-banner blue-section elsner-life-banner">
    <div class="container">
        <div class="elsner-life-wrapper">
            <div class="row alinc">
                <div class="col-lg-4 col-md-4">
                    <div class="heading white-text">
                        <h1><?php echo $banner_text; ?></span></h1>
                        <h5 class="subhead"><?php echo $sub_heading_life_elsner; ?></h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="work-banner-content">
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
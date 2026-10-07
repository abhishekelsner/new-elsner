<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>
<section class="our-work-banner blue-section skill-sets-banner">
    <div class="container">
        <div class="skillsets-wrapper">
            <div class="row alinc">
                <div class="col-lg-4 col-md-4">
                    <div class="heading white-text">
                        <h3><?php echo get_field('heading_skillsets', $post_id); ?></h3>
                        <h5 class="subhead"><?php echo get_field('subheading_skillset', $post_id); ?></h5>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="work-banner-content">
                        <p><?php echo get_field('content_skillsets', $post_id); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
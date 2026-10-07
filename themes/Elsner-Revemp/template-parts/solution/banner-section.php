<?php
// Retrieve the post ID from the $args array
$post_id                 = $args['post_id'];
$banner_text             = get_field('portfolio_banner_elsner', $post_id);
$sub_heading_life_elsner = get_field('sub_heading_portfolio_banner', $post_id);
?>
<section class="our-work-banner">
    <div class="container">
        <div class="our-work-wrapper">
            <div class="row alinc">
                <div class="col-lg-3 col-md-4">
                    <div class="heading">
                        <h1>Our <span>Solutions</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
$post_id                 = $args['post_id'];
$banner_text             = get_field('portfolio_banner_elsner', $post_id);
$sub_heading_life_elsner = get_field('sub_heading_portfolio_banner', $post_id);
?>
<section class="our-work-banner">
    <div class="breadcrumb-wrapper">
        <?php custom_breadcrumbs(); ?>
    </div>
    <div class="container">
        <div class="our-work-wrapper">
            <div class="row alinc">
                <div class="col-lg-3 col-md-4">
                    <div class="heading">
                        <h1>Our <span>Work</span></h1>
                        <h5 class="subhead"><?php echo esc_html($banner_text); ?></h5>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="work-banner-content">
                        <p><?php echo esc_html($sub_heading_life_elsner); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
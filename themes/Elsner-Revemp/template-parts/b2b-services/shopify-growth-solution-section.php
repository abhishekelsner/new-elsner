<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$shopify_growth_solutions_content1 = get_field('shopify_growth_solutions_content1', $post_id);
$shopify_growth_solutions_image = get_field('shopify_growth_solutions_image', $post_id);
$shopify_growth_solutions_content2 = get_field('shopify_growth_solutions_content2', $post_id);
?>
<?php if(is_page('shopify-growth-plan')):?>
<section class="services-section padding-80 shopify-growth-block">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo get_field('shopify_growth_solutions_heading', $post_id); ?></h2>
        </div>
        <div class="service-wrapper">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="shopify-growth-solution first-block">
                        <?php echo $shopify_growth_solutions_content1;?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="shopify-growth-solution">
                        <img src=" <?php echo $shopify_growth_solutions_image;?>" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="shopify-growth-solution last-block">
                        <?php echo $shopify_growth_solutions_content2;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
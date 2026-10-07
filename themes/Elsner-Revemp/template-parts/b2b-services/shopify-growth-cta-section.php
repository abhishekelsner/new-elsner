<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$shopify_growth_cta_heading        = get_field('shopify_growth_cta_heading', $post_id);
$shopify_growth_cta_subheading     = get_field('shopify_growth_cta_subheading', $post_id);
$shopify_growth_cta_button         = get_field('shopify_growth_cta_button', $post_id);
$shopify_growth_cta_image         = get_field('shopify_growth_cta_image', $post_id);
$shopify_growth_cta_class = is_page('shopify-growth-plan') ? 'shopify-growth-cta' : '';

?>
<section class="get-touch emc-get-touch <?=$shopify_growth_cta_class?>">
    <div class="container">
        <div class="get-block">
            <div class="row alinc">
                <div class="col-md-7">

                    <div class="brew-content">
                        <h5><?php echo $shopify_growth_cta_subheading; ?>
                        </h5>
                        <h2><?php echo $shopify_growth_cta_heading; ?></h2>
                        <a href="#b2b-contact-form" class="btn btn-secondary"><?php echo $shopify_growth_cta_button; ?></a>
                    </div>
                </div>
                <div class="col-md-5 get-image">
                    <div class="brew-gif">
                        <img src="<?=$shopify_growth_cta_image?>" alt="Ecommerce CTA Image" width="514" height="502" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
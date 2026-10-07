<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$cta_heading        = get_field('cta_heading', $post_id);
$cta_subheading     = get_field('cta_subheading', $post_id);
$cta_button         = get_field('cta_button', $post_id);
?>
<section class="get-touch emc-get-touch">
    <div class="container">
        <div class="get-block">
            <div class="row alinc">
                <div class="col-md-7">

                    <div class="brew-content">
                        <h5><?php echo $cta_subheading; ?>
                        </h5>
                        <h2><?php echo $cta_heading; ?></h2>
                        <a href="/contact-us/" class="btn btn-secondary"><?php echo $cta_button; ?></a>
                    </div>
                </div>
                <div class="col-md-5 get-image">
                    <div class="brew-gif">
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/maintenance/ecommerce-cta-image-new.png'; ?>"
                            alt="Ecommerce CTA Image" width="514" height="502" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
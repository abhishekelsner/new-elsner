<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$b2b_cta_image = get_field('b2b_cta_image', $post_id);
$b2b_cta_title = get_field('b2b_cta_title', $post_id);
$b2b_cta_button_name = get_field('b2b_cta_button_name', $post_id);
?>
<section class="get-touch b2b-get-in-touch">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-7">
                <div class="brew-content">
                    <h2><?php echo $b2b_cta_title; ?></h2>
                    <a href="#b2b-contact-form" class="btn btn-secondary"><?php echo $b2b_cta_button_name; ?></a>
                </div>
            </div>
            <div class="col-md-5 b2b-cta-bg-image">
                <div class="brew-gif">
                    <img src="<?=$b2b_cta_image ?>" />
                </div>
            </div>

        </div>
    </div>
</section>
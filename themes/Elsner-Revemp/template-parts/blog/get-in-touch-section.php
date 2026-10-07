<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$talk_more        = get_field('talk_more', $post_id);
$lets_brew        = get_field('lets_brew', $post_id);
$lottie        = get_field('lottie', $post_id);
?>
<section class="get-touch">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-5">
                <div class="brew-gif">
                    <dotlottie-player src="<?php echo $lottie; ?>" background="transparent" speed="1" loop autoplay>
                    </dotlottie-player>
                </div>
            </div>
            <div class="col-md-7">
                <div class="brew-content blog-get-in-touch">
                    <h2><?php echo  esc_html($talk_more); ?></h2>
                    <p><?php echo ($lets_brew); ?></p>
                    <div class="contact-us-form blog-form">
                        <?php echo do_shortcode('[contact-form-7 id="34985" title="Blog"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
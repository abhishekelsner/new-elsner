<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$talk_more        = get_field('talk_more', 'option');
$lets_brew        = get_field('lets_brew', 'option');
$lottie        = get_field('lottie', 'option');
$ppc_supportplan_pages = is_page(array(36808, 36741, 36811, 36816, 36823));
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
                <div class="brew-content">
                    <h5><?php echo (is_page(36998) ? "Don't wait for website issues to affect your business." : $talk_more); ?>
                    </h5>
                    <h2><?php echo (is_page(36998) ? "Explore our eCommerce Maintenance Packages today!" : $lets_brew); ?>
                    </h2>
                    <?php
                        $contact_link = $ppc_supportplan_pages ? esc_url('#wpcf7-f37316-o2') : esc_url($contact_us_link);
                    ?>
                    <a href="<?php echo $contact_link; ?>"
                        class="btn btn-secondary"><?php echo esc_html('GET IN TOUCH'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
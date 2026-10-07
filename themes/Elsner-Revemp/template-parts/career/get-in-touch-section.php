<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];

$lottie_career  = get_field('lottie_career', $post_id);
$intrested      = get_field('intrested', $post_id);
$audit          = get_field('audit', $post_id);
$share_resume_mail = get_field('share_resume_mail', 'option');

?>
<section class="get-touch">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-5">
                <div class="brew-gif">
                    <dotlottie-player src="<?php echo $lottie_career; ?>" background="transparent" speed="1" loop
                        autoplay>
                    </dotlottie-player>
                </div>
            </div>
            <div class="col-md-7">
                <div class="brew-content">
                    <h5><?php echo $intrested; ?></h5>
                    <h2><?php echo $audit; ?></h2>
                    <a href="mailto:<?php echo $share_resume_mail; ?>" target="_blank"
                        class="btn btn-secondary"><?php echo esc_html('SEND RESUME'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
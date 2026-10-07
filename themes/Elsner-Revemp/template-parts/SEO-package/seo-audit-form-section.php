<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$form_heading   = get_field('form_heading', $post_id);
$form_content   = get_field('form_content', $post_id);
?>

<section class="seoaudit-form-section padding-80">
    <div class="container">
        <div class="row alinc">
            <div class="col-lg-4 col-md-4">
                <div class="heading-wrapper text-left">
                    <h2><?php echo $form_heading; ?></h2>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="work-banner-content">
                    <p><?php echo $form_content; ?></p>
                </div>
            </div>
        </div>
        <div class="seo-audit-form">
            <?php echo do_shortcode('[contact-form-7 id="34901" title="SEO Audit"]'); ?>
        </div>
    </div>
</section>
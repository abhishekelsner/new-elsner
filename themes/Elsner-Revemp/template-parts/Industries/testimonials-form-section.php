<?php
$post_id = $args['post_id'];
$industries_cta_heading = get_field('industries_cta_heading', $post_id);
$industries_cta_subheading = get_field('industries_cta_subheading', $post_id);
$testimonials_form_client_image = get_field('testimonials_form_client_image', $post_id);
$testimonials_form_title = get_field('testimonials_form_title', $post_id);
$testimonials_form_content = get_field('testimonials_form_content', $post_id);
$testimonials_form_client_name = get_field('testimonials_form_client_name', $post_id);
$testimonials_form_client_designation = get_field('testimonials_form_client_designation', $post_id);
$industries_cta_image = get_field('industries_cta_image', $post_id); ?>
<section class="testimonials-form blue-section" id="testimonial-form">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-content">
                <span class="client-line-top"></span>
                <div class="content-inner">
                    <h2><?= $testimonials_form_title;?></h2>
                    <p><?= $testimonials_form_content;?></p>
                    <div class="author-meta">
                        <span class="image-circle">
                            <img src="<?=$testimonials_form_client_image;?>" />
                        </span>
                        <span class="info">
                            <strong class="name"><?= $testimonials_form_client_name;?></strong>
                            <span class="type"><?= $testimonials_form_client_designation;?></span>
                        </span>
                    </div>
                </div>
                <span class="client-line-bottom"></span>
            </div>
            <div class="col-md-7 col-content-form" id="testimonia-banner-form-cta">
                <div class="content-inner">
                    <h2><?php echo $industries_cta_heading;?></h2>
                    <?php echo $industries_cta_subheading; ?>
                    <div class="form-style-2">
                        <?php echo do_shortcode('[contact-form-7 id="40155" title="Industries page Contact Form"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
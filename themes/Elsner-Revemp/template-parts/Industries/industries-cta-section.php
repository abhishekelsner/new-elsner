<?php
$post_id = $args['post_id'];
$industries_cta_heading = get_field('industries_cta_heading', $post_id);
$industries_cta_subheading = get_field('industries_cta_subheading', $post_id);
$industries_cta_image = get_field('industries_cta_image', $post_id); 
$industries_cta_image_alt_tag = get_field('industries_cta_image_alt_tag', $post_id); 
?>
<?php if ( ! is_page(61372) ) : ?>
<section class="get-touch-digital blue-section" id="get-touch-digital">
    <div class="container">
        <div class="row alinc">
            <div class="col-md-4 image">
                <div class="image-inner">
                    <img src="<?php echo $industries_cta_image; ?>" alt="<?php echo $industries_cta_image_alt_tag;?>" width="696"
                        height="696" />
                </div>
            </div>
            <div class="col-md-8 content">
                <div class="content-inner">
                    <h2><?php echo $industries_cta_heading;?></h2>
                    <?php echo $industries_cta_subheading; ?>
                    <?php echo do_shortcode('[contact-form-7 id="38870" title="Industries Pages Form"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
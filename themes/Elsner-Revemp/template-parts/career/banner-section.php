<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$banner_image         = get_field('banner_image', $post_id);
$heading_career         = get_field('heading_career', $post_id);
$sub_headings_career    = get_field('sub_headings_career', $post_id);

?>
<section class="career-banner-section pd-b-30">
    <div class="career-banner-img">
        <img src="<?php echo $banner_image; ?>" alt="about banner" width="1920" height="1080">
        <div class="career-banner-content">
            <div class="container">
                <div class="heading-wrapper white-text">
                    <h1 class="heading1"><?php echo $heading_career; ?></h1>
                    <h6><?php echo $sub_headings_career; ?></h6>
                    <a href="#hiring" class="btn btn-secondary">JOB OFFERS</a>
                </div>
            </div>
        </div>
    </div>
</section>
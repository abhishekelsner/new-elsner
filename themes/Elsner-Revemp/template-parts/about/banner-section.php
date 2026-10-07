<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$banner_image   = get_field('banner_image', $post_id);
$banner_content = get_field('banner_who_we_are', $post_id);
$banner_video = get_field('banner_video_', $post_id);
?>
<section class="about-banner-section pd-b-30">
    <div class="about-banner-img">
        <img src="<?php echo $banner_image; ?>" alt="about banner">
    </div>
    <div class="breadcrumb-wrapper">
        <?php custom_breadcrumbs(); ?>
    </div>
    <div class="container">
        <div class="info-block">
            <div class="about-heading">
                <?php echo $banner_content; ?>
            </div>
            <div class="info-video">
                <iframe width="1200" height="600" src="<?php echo $banner_video; ?>" title="Elsner Technologies Corporate Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</section>
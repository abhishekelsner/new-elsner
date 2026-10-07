<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id                 = $args['post_id'];
?>

<section class="our-work-idea">
    <div class="container">
        <div class="got-project-block">
            <div class="got-project-image">
                <img src="<?php echo site_url() . '/wp-content/uploads/2025/02/image_2025_02_13T09_40_14_256Z-1.png'; ?> " alt="user image" width="160" height="160">
            </div>
            <div class="got-project-content">
                <div class="left-project-content">
                    <h3>Got a Project or Idea in Mind?</h3>
                    <h6>Let our representatives discuss the project in length. Contact us now. </h6>
                </div>
                <div class="get-touch-btn">
                    <a class="btn btn-secondary" href="<?php echo $contact_us_link; ?>">Book A Meeting</a>
                </div>
            </div>
        </div>
    </div>
</section>
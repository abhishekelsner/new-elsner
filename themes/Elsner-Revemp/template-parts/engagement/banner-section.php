<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$heading_engagement = get_field('heading_engagement', $post_id);
$subheading_engagement = get_field('subheading_engagement', $post_id);
?>
<section class="hire-developer-banner padding-120 blue-section">
    <div class="container">
        <div class="hire_developer-wrapper">
            <div class="heading-wrapper white-text width-900">
                <h1 class="heading1"><?php echo $heading_engagement; ?></h1>
                <h6><?php echo $subheading_engagement; ?></h6>
            </div>
        </div>
    </div>
</section>
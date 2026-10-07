<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$section_title          = get_field('section_title', $post_id);
$section_content        = get_field('section_content', $post_id);
$our_mission_title      = get_field('our_mission_title', $post_id);
$our_mission_content    = get_field('our_mission_content', $post_id);
$our_vision_title       = get_field('our_vision_title', $post_id);
$our_vision_content     = get_field('our_vision_content', $post_id);
?>
<section class="we-are-section pd-40">
    <div class="container">
        <div class="heading-wrapper">
            <h2><?php echo esc_html($section_title); ?></h2>
            <p><?php echo esc_html($section_content); ?></p>
        </div>
        <div class="we-are-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="we-are-block">
                        <h3 class="Redhat-font"><?php echo esc_html($our_mission_title); ?></h3>
                        <p><?php echo $our_mission_content; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="we-are-block">
                        <h3 class="Redhat-font"><?php echo esc_html($our_vision_title); ?></h3>
                        <p><?php echo $our_vision_content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
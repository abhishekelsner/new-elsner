<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>
<div class="wrapper-space padding-80">
    <div class="container">
        <div class="cta-section">
            <h2> <?php echo get_field('cta_heading', $post_id); ?></h2>
            <p class="sub-title-holistic"> <?php echo get_field('cta_subheading', $post_id); ?></p>
            <div class="cta-btn-section">
                <a class="btn btn-secondary" href="#"
                    id="learnbtnn"><?php echo get_field('cta_button', $post_id); ?></a>
            </div>
        </div>
    </div>
</div>
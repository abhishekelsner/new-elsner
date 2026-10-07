<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<section class="web-hosting-banner padding-120 blue-section">
    <div class="container">
        <div class="web-hostin-wrapper">
            <div class="heading white-text">
                <h1 class="Redhat-font"><?php echo get_field('heading_hosting', $post_id); ?></h1>
            </div>
            <div class="hosting-content">
                <?php the_content(); ?>
            </div>
            <a href="<?php echo esc_url($contact_us_link); ?>" class="btn btn-primary">Hosting Plan</a>
        </div>
    </div>
</section>
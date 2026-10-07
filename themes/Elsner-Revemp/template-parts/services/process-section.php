<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<?php if (get_field('process_heading')) : ?>
    <section class="process-service padding-80">
        <div class="container">
            <div class="heading-wrapper">
                <h2><?php echo get_field('process_heading', $post_id); ?></h2>
            </div>
            <div class="process-image-service">
                <img src="<?php echo get_field('process_image_migration', $post_id); ?>" alt="Process Image" width="1200" height="600" loading="lazy">
            </div>
        </div>
    </section>
<?php endif; ?>
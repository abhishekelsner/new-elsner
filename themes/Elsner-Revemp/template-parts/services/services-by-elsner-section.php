<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<?php if (get_field('services_by_elsner_heading')) : ?>
    <div class="services-section padding-80">
        <div class="container">
            <div class="block-title text-center max-700">
                <h2><?php echo get_field('services_by_elsner_heading', $post_id); ?></h2>
            </div>
            <div class="service-wrapper">
                <div class="row">
                    <?php if (have_rows('elsner_services_box', $post_id)) : ?>
                        <?php while (have_rows('elsner_services_box', $post_id)) : the_row(); ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-list">
                                    <div class="service-list-num">
                                    </div>
                                    <div class="service-list-content">
                                        <h3><?php echo get_sub_field('elsner_services_box_heading', $post_id); ?></h3>
                                        <p><?php echo get_sub_field('elsner_services_box_description', $post_id); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (get_field('migration__heading')) : ?>
    <section class="migration-about padding-80">
        <div class="container">
            <div class="heading-wrapper">
                <h2><?php echo get_field('migration__heading', $post_id); ?></h2>
            </div>
            <div class="migration-content">
                <?php echo get_field('migration_contents', $post_id); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
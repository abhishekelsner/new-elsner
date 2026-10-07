<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<?php if (have_rows('hosting_plan', $post_id)) : ?>
    <?php while (have_rows('hosting_plan', $post_id)) : the_row(); ?>
        <section class="business-hosting-plan padding-80">
            <div class="container">
                <div class="heading-wrapper">
                    <h2><?php echo get_sub_field('business_plan_heading', $post_id); ?></h2>
                </div>
                <div class="package-block-wrapper">
                    <div class="row">
                        <?php if (have_rows('business_package', $post_id)) : ?>
                            <?php while (have_rows('business_package', $post_id)) : the_row(); ?>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="package-block business-package">
                                        <div class="package-heading">
                                            <h3 class="price-number"><?php echo esc_html(get_sub_field('package_price', $post_id)); ?></h3>
                                            <h5><?php echo esc_html(get_sub_field('package_name', $post_id)); ?></h5>
                                        </div>
                                        <div class="package-list">
                                            <ul>
                                                <?php if (have_rows('package_list', $post_id)) : ?>
                                                    <?php while (have_rows('package_list', $post_id)) : the_row(); ?>
                                                        <li>
                                                            <span class="list-span">
                                                                <h6><?php echo get_sub_field('list_item', $post_id); ?></h6>
                                                            </span>
                                                        </li>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <a href="<?php echo esc_url($contact_us_link); ?>" class="link">Buy Now</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
$ppc_supportplan_pages = is_page(array(36808, 36741, 36811, 36816, 36823));
?>

<?php if (get_field('package_heading')) : ?>
    <div class="package-plan-section padding-80" id="package-plan-section">
        <div class="container">
            <div class="heading-wrapper text-center max-700">
                <h2><?php echo get_field('package_heading', $post_id); ?></h2>
                <h6><?php echo get_field('package_sub_heading', $post_id); ?></h6>
            </div>
            <div class="service-wrapper package-plan-wrapper">
                <div class="row">
                    <?php if (have_rows('package_selection_tab', $post_id)) : ?>
                        <?php while (have_rows('package_selection_tab', $post_id)) : the_row(); ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="service-list">
                                    <?php if (get_sub_field('popular_heading')) : ?>
                                        <div class="package-recomended">
                                            <p><?php echo esc_html(get_sub_field('popular_heading')); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="service-list-content">
                                        <h3><?php echo get_sub_field('package_hour', $post_id); ?></h3>
                                        <h6><?php echo get_sub_field('package_plan', $post_id); ?></h6>
                                        <div class="description_package">
                                            <p><?php echo get_sub_field('package_description', $post_id); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    $acf_link = get_sub_field('package_price', $post_id);

                                    $contact_link = $ppc_supportplan_pages ? esc_url('#wpcf7-f29778-o2') : esc_url($contact_us_link);
                                    // Use ACF link if available, otherwise fallback
                                    $final_link = !empty($acf_link) ? esc_url($acf_link) : $contact_link;

                                    // Button text
                                    $button_text = is_page(36808) ? 'BUY NOW' : 'Buy Now';
                                    ?>
                                    <a href="<?php echo $final_link; ?>" class="btn-primary btn" target="_blank" rel="noopener noreferrer"><?php echo $button_text; ?></a>

                                    <!-- <a href="<?php //echo esc_url($contact_link); 
                                                    ?>" class="btn-primary btn">GET A QUOTE</a> -->
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
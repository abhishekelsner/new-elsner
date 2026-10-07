<?php
// Retrieve the post ID from the $args array
global $contact_us_link;
$post_id = $args['post_id'];
?>

<?php if (get_field('package_heading')) : ?>
<div class="package-plan-section padding-50 growth-package" id="package-plan-section">
    <div class="container">
        <div class="heading-wrapper text-center max-700">
            <h2><?php echo get_field('package_heading', $post_id); ?></h2>
            <h6><?php echo get_field('package_sub_heading', $post_id); ?></h6>
        </div>
        <div class="service-wrapper package-plan-wrapper">
            <div class="row">
                <?php if (have_rows('package_selection_tab', $post_id)) :
                     $counter = 0; ?>
                <?php while (have_rows('package_selection_tab', $post_id)) : the_row(); 
                 $counter++; ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-list">
                        <?php if(get_sub_field('popular_heading')) : ?>
                        <div class="package-recomended">
                            <p><?php echo esc_html(get_sub_field('popular_heading')); ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="service-list-content">
                            <p class="plan-title"><?php echo get_sub_field('package_plan', $post_id); ?></p>
                            <div class="description_package">
                                <p><?php echo get_sub_field('package_description', $post_id); ?></p>
                            </div>
                            <p class="plan-price <?php echo ($counter === 3) ? 'third-package-price-active' : ''; ?>"><?php echo get_sub_field('package_hour', $post_id); ?></p>
                        </div>
                        <a href="<?php echo get_sub_field('package_price', $post_id); ?>" class="btn-primary btn <?php echo ($counter === 3) ? 'third-package-button-active' : ''; ?>">BUY
                            NOW</a>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
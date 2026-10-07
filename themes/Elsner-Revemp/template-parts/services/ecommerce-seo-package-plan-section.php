<?php
// Retrieve the post ID from the $args array
global $post;
$post_id = $args['post_id'];
$post_slug = $post->post_name;
$heading_title = get_field('main_heading_premium_field', 'option');
$package_headline = get_field('package_headline', $post_id);
$package_headline_show = get_field('package_headline_show', $post_id);
$premium_subheading = get_field('premium_subheading', 'option');

// Adjust heading title if necessary
if (is_page('ecommerce-maintenance-packages')) {
    $heading_title = str_replace('Services', '', $heading_title);
}

// Remove 'services' or 'service' from post slug
if (str_contains($post_slug, 'services') || str_contains($post_slug, 'service')) {
    $post_slug = str_replace(['services', 'service'], '', $post_slug);
}

$section_title = str_replace('%tech_name%', ucfirst($post_slug), $heading_title);
$remove_hyphen = str_replace('-', ' ', $section_title);
$show_packages_section = get_field('show_packages_section', $post_id);
$tile_industry_page = is_page('tiles-ecommerce-services') ? 'Grow your <span>Tile E-Commerce Business<span>' : $remove_hyphen;
// Capitalize "ecommerce" if it appears in the page title
if (stripos($tile_industry_page, 'ecommerce') !== false) {
    $tile_industry_page = str_ireplace('ecommerce', 'E-Commerce', $tile_industry_page);
}
?>

<?php if (get_field('main_heading_premium_field', 'option')) : ?>
<?php if ($show_packages_section === true) : ?>
<section class="seo-package-service-section" id="service-package-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo $tile_industry_page; ?></h2>
            <p><?php echo $premium_subheading; ?></p>
        </div>
        <div class="package-block-wrapper">
            <div class="row ecommerce-package-slider slick-slider" id="ecommerce-package-plan-section">
                <?php $count = count(get_field('package', $post_id)); ?>
                <?php if (have_rows('package', $post_id)) : ?>
                <?php while (have_rows('package', $post_id)) : the_row(); ?>
                <?php
                $package_name = get_sub_field('package_name', $post_id);
                $package_description = get_sub_field('package_description', $post_id);
                $package_price = get_sub_field('package_price', $post_id);
                $package_price = str_replace(',', '', $package_price);
                $package_discount_type = get_sub_field('package_discount_type', $post_id);
                $paypal_button_id = get_sub_field('package_button_ids', $post_id);
                // Initialize discounted price with the original price
                $discounted_price = $package_price;

                // Apply discount based on the discount type
                if ($package_discount_type === '5% Discount') {
                    $discounted_price = number_format($package_price * 0.95); // Apply 5% discount
                    $savings_percentage = 5;
                } 
                elseif ($package_discount_type === '10% Discount') {
                    $discounted_price = number_format($package_price * 0.90); // Apply 10% discount
                    $savings_percentage = 10;
                }
                else{
                    $savings_percentage = 0; // No discount applied
                }
                ?>
                <div
                    class="<?php echo ($count === 3) ? 'col-lg-4 col-md-6 col-sm-6' : 'col-xl-3 col-lg-6 col-md-6 col-sm-6'; ?>">
                    <div class="package-block <?php $checked = get_sub_field('recommanded', $post_id);
                    if ($checked) {
                        echo 'active';
                    } ?>">
                        <div class="package-recomended">
                            <p>RECOMMENDED</p>
                        </div>
                        <div class="package-heading">
                            <h5><?php echo esc_html($package_name); ?></h5>
                            <p><?php echo esc_html($package_description); ?></p>
                            <?php if ($package_discount_type !== 'No Discount') : ?>
                            <h3 class="original-price">
                                <span class="old-price">$<?php echo $package_price; ?></span>
                                <?php endif; ?>
                                <?php if($savings_percentage > 0):?>
                                <span class="saving-discount">Save <?php echo $savings_percentage; ?>%</span>
                                <?php endif; ?>
                            </h3>
                            <?php if(!is_page('tiles-ecommerce-services')):?>
                            <h3 class="price-number"><?php echo '$' . $discounted_price; ?>
                                <?php if (is_page('ecommerce-maintenance-packages')) : ?>
                                <span>/ 6 months</span>
                                <?php endif; ?>
                            </h3>
                            <?php endif;?>
                            <?php if(is_page('tiles-ecommerce-services')):?>
                            <a href="/contact-us" class="btn btn-primary">GET A QUOTE</a>
                            <?php endif;?>
                            <?php if (!empty($paypal_button_id)) : ?>
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick" />
                                <input type="hidden" name="hosted_button_id" value="<?php echo $paypal_button_id; ?>" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="submit" class="btn btn-primary" border="0" name="Buy Now" value="Buy Now"
                                    title="PayPal - The safer, easier way to pay online!" alt="Subscribe">
                            </form>
                            <?php endif; ?>
                        </div>
                        <div class="package-list">
                            <ul>
                                <?php if (have_rows('list', $post_id)) : ?>
                                <?php while (have_rows('list', $post_id)) : the_row(); ?>
                                <li><span
                                        class="list-span"><?php echo get_sub_field('package_list', $post_id); ?></span>
                                </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="see-more">
                            <a class="see-more-link" href="javascript:void(0);">See all features</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>
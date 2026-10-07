<?php
// Retrieve the post ID from the $args array
global $post;
$post_id = $args['post_id'];
$post_slug = $post->post_name;
$heading_title          = get_field('main_heading_premium_field', 'option');
$package_headline = get_field('package_headline', $post_id);
$package_headline_show = get_field('package_headline_show', $post_id);
if(is_page(36998)){
    $heading_title = str_replace('Services','', $heading_title);
}
if (str_contains($post_slug, 'services') || str_contains($post_slug, 'service')) {
    $post_slug = str_replace(['services', 'service'], '', $post_slug);
}
$section_title          = str_replace('%tech_name%', ucfirst($post_slug), $heading_title);
$remove_hyphen          = str_replace('-', ' ', $section_title);
$show_packages_section = get_field('show_packages_section', $post_id);
?>

<?php if (get_field('main_heading_premium_field', 'option')) : ?>
<?php if ($show_packages_section === true) : ?>
<section class="seo-package-service-section" id="service-package-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2><?php echo $remove_hyphen; ?></h2>
        </div>
        <div class="package-block-wrapper">
            <div class="row">
                <?php $count = count(get_field('package', $post_id)); ?>
                <?php if (have_rows('package', $post_id)) : ?>
                <?php while (have_rows('package', $post_id)) : the_row(); ?>

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
                            <img src="<?php echo get_sub_field('image', get_the_ID()); ?>" alt="package-image"
                                width="60" height="60">
                            <h5><?php echo esc_html(get_sub_field('package_name', $post_id)); ?></h5>
                            <h3 class="price-number"><?php echo esc_html(get_sub_field('package_price', $post_id)); ?>
                                <?php if (is_page(36998)) : ?>
                                <span>/ 6 months</span>
                                <?php endif; ?>
                            </h3>
                            <?php
                                        $paypal_button_id = '';
                                        switch (get_sub_field('package_name', $post_id)) {
                                            case 'Bronze':
                                                $paypal_button_id = '8MMBCGBWSXKBA';
                                                break;
                                            case 'Silver':
                                                $paypal_button_id = 'QJWKSW5T3FEBG';
                                                break;
                                            case 'Gold - 360°':
                                                $paypal_button_id = 'M5MHNLTJ6Q76Q';
                                                break;
                                        }

                                        if (!empty($paypal_button_id)) : ?>
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
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if($package_headline_show === true): ?>
        <div class="package-headline">
            <h5 class="Redhat-font"><?php echo $package_headline;?></h5>
        </div>
        <?php endif;?>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>
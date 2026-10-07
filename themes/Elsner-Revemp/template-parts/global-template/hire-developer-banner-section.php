<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$page_title = get_field('hire_developer_page_title', $post_id);
$page_excerpt = get_field('hire_developer_content', 'option');
$page_excerpt = str_replace('%page_excerpt%', get_field('tech_excerpt', get_the_ID()), $page_excerpt);
$link = get_field('hire_developer_link', 'option');
$developer_logos = get_field('developer_logos', 'option');
$current_url = $_SERVER['REQUEST_URI'];

$parts = explode('-', $current_url);
$value = $parts[1];

?>
<section class="hire-developer-banner padding-120 blue-section">
    <div class="breadcrumb-wrapper">
        <?php custom_breadcrumbs(); ?>
    </div>
    <div class="container">
        <div class="hire_developer-wrapper">
            <div class="heading-wrapper white-text width-900">
                <h1 class="heading1"><?php echo esc_html($page_title); ?>
                </h1>
                <h6><?php echo esc_html($page_excerpt); ?></h6>
                <?php

                $current_slug = get_post_field('post_name', get_post());

                $button_text = 'HIRE DEDICATED DEVELOPER AT BEST HOURLY RATES';

                if ($current_slug === 'hire-wordpress-developer') {
                    $button_text = 'HIRE WORDPRESS DEVELOPER AT BEST HOURLY RATES';
                } elseif ($current_slug === 'hire-shopify-developer') {
                    $button_text = 'HIRE SHOPIFY DEVELOPER AT BEST HOURLY RATES';
                } elseif ($current_slug === 'hire-ecommerce-developer') {
                    $button_text = 'HIRE ECOMMERCE DEVELOPER AT BEST HOURLY RATES';
                } elseif ($current_slug === 'hire-bigcommerce-developer') {
                    $button_text = 'HIRE BIGCOMMERCE DEVELOPER AT BEST HOURLY RATES';
                } elseif ($current_slug === 'hire-reactjs-developer') {
                    $button_text = 'HIRE REACTJS DEVELOPER AT BEST HOURLY RATES';
                } elseif ($current_slug === 'hire-magento-developer') {
                    $button_text = 'HIRE MAGENTO DEVELOPER AT BEST HOURLY RATES';
                }elseif ($current_slug === 'hire-odoo-developers') {
                    $button_text = 'HIRE ODOO DEVELOPER AT BEST HOURLY RATES';
                }
                ?>
                <a href="<?php echo esc_url($link); ?>"
                    class="btn btn-secondary"><?php echo esc_html($button_text); ?></a>
            </div>
            <div class="developer-logos">
                <ul>
                    <?php if (have_rows('developer_logo', 'option')): ?>
                        <?php while (have_rows('developer_logo', 'option')):
                            the_row(); ?>
                            <li>
                                <img src="<?php echo the_sub_field('developer_logo_image') ?>" alt="developer-logos" height="50"
                                    width="160">
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="developer-counter">
            <div class="row">
                <?php if (have_rows('hire_developer_counter', 'option')): ?>
                    <?php while (have_rows('hire_developer_counter', 'option')):
                        the_row(); ?>
                        <div class="col-md-3 col-sm-6 service-stats">
                            <div class="counter-col">
                                <span class="timers"
                                    data-count="<?php the_sub_field('hire_count'); ?>"><?php the_sub_field('hire_count'); ?></span><span>+</span>
                                <h5>
                                    <?php echo str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), get_sub_field('hire_title')); ?>
                                </h5>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php
// Retrieve the post ID from the $args array
global $contact_form;
$post_id = $args['post_id'];
$term_list = get_the_terms($post_id, 'portfolio-technology');
$types = '';
foreach ($term_list as $term_single) {
    $types .= ucfirst($term_single->slug) . ', ';
}
$technologies = rtrim($types, ', ');
if ($technologies == 'Magento') {
    $slug = 'hire-magento-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'Wordpress') {
    $slug = 'hire-wordpress-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'Shopify') {
    $slug = 'hire-shopify-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'iOS') {
    $slug = 'hire-ios-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'Android') {
    $slug = 'hire-android-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    if (empty($heading)) {
        $heading = 'Hire Android Developers';
    }
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'Reactjs') {
    $slug = 'hire-reactjs-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    if (empty($heading)) {
        $heading = 'Hire ReactJs Developers';
    }
    $content = get_the_content(null, false, $page->ID);
} elseif ($technologies == 'PHP') {
    $slug = 'hire-php-developer';
    $page = get_page_by_path($slug);
    $heading = get_field('hire_developer_heading', $page->ID);
    if (empty($heading)) {
        $heading = 'Hire PHP Developers';
    }
    $content = get_the_content(null, false, $page->ID);
} else {
    $content = get_the_content();
}
?>
<section class="request-quote blue-section padding-80">
    <div class="container">
        <div class="single-portfolio-form">
            <div class="heading-wrapper">
                <h2 class="white-text">Hire a <?php echo ucfirst($value); ?> Developer Now!</h2>
            </div>
            <div class="portfolio-form">
                <div class="form-quote">
                    <?php echo do_shortcode($contact_form); ?>
                </div>
            </div>
        </div>
    </div>
</section>
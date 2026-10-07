<?php
$page = get_page_by_path($page_slug);

if ($page) {
    $page_id = $page->ID;
}
$term_link = get_permalink($page_id) . $term->slug . '/';
$term_slug_parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
$term_last_slug = end($term_slug_parts);
$portfolio_args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 3,
);
$terms = get_terms(array(
    'taxonomy' => 'platform',
    'orderby' => 'id',
    'order' => 'ASC',
));
foreach ($terms as $term) {
    $term_link = get_permalink($page_id) . $term->slug . '/';
    $term_slug_parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
    $term_last_slug = end($term_slug_parts);
    $active_class = ($term_last_slug === $term->slug) ? 'active' : '';

    //add tax query from page slug
    if ($term_last_slug === $term->slug) {
        $portfolio_args['tax_query'] = array(
            array(
                'taxonomy' => 'platform',
                'field' => 'slug',
                'terms' => $term->slug,
            ),
        );
    }
}
$portfolio_query = new WP_Query($portfolio_args);
?>
<div class="work-slider-section">
    <div class="container">
        <div class="work-slider slider">
            <?php
            if ($portfolio_query->have_posts()) {
                while ($portfolio_query->have_posts()) {
                    $portfolio_query->the_post();
            ?>
                    <div class="workitems">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="work-data">
                                    <h5><?php the_title(); ?></h5>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7">
                                <div class="work-slide-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="Nestle" width="550" height="400" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo 'No portfolio posts found.';
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
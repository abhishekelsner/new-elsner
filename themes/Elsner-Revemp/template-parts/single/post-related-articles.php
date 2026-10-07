<?php
$category = get_the_terms(get_the_ID(), 'category');
$related_args = array(
    'post_type' => 'post',
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array($category[0]->slug),
            'include_children' => true,
            'operator' => 'IN'
        ),
    )
);
$related = new WP_Query($related_args);
$page_slug = 'blog';
$page = get_page_by_path($page_slug);
if ($page) {
    $page_link = get_permalink($page->ID);
}
if ($related->have_posts()) :
?>
    <div class="container">
        <div class="related-articles-wrapper padding-80">
            <div class="heading flex">
                <h2 class="heading2">You may also like</h2>
                <div class="all-project">
                    <a href="<?php echo $page_link; ?>" class="all-link">View all Blogs</a>
                </div>
            </div>
            <div class="row">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card">
                            <div class="blog-image">
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                </figure>
                            </div>
                            <div class="blog-description"><a href="#">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="category">' . esc_html($categories[0]->name) . '</span>';
                                    } ?>
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <ul>
                                        <li>by <?php echo get_the_author(); ?></li>
                                        <li><?php echo get_the_date('d F, Y'); ?></li>
                                    </ul>
                                    <a href="<?php the_permalink(); ?>" class="view-more">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/up-icon.svg" alt="view more" width="15" height="15">
                                    </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

<?php

endif;
wp_reset_postdata();
?>
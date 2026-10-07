<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_text = get_field('portfolio_banner_elsner', $post_id);
$sub_heading_life_elsner = get_field('sub_heading_portfolio_banner', $post_id);
?>

<section class="category-filter-section">
    <div class="container">
        <!-- Filter buttons for projects by category -->
        <div class="filter-list">
            <div class="category-filter">
                <?php
                $portfolio_args = array(
                    'post_type' => 'solution',
                    'posts_per_page' => 6,
                );
                $terms = get_terms(array(
                    'taxonomy' => 'solution-category',
                    'orderby' => 'id',
                    'order' => 'ASC',
                ));
                $page_slug = 'solutions';

                $page = get_page_by_path($page_slug);

                if ($page) {
                    $page_id = $page->ID;
                }

                $term_link_all = get_permalink($page_id);
                $current_slug_parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
                $current_last_slug = end($current_slug_parts);
                $post_type = 'solution';
                $taxonomy = 'solution-category';
                $active_class_all = ($current_last_slug === 'solutions') ? 'active' : '';
                echo '<a href="' . $term_link_all . '" type="button" class="filter-btn ' . $active_class_all . '" data-filter="all">All Projects</a>';

                foreach ($terms as $term) {
                    $term_link = get_permalink($page_id) . $term->slug . '/';
                    $term_slug_parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
                    $term_last_slug = end($term_slug_parts);
                    $active_class = ($term_last_slug === $term->slug) ? 'active' : '';
                    echo '<a href="' . $term_link . '" type="button" class="filter-btn ' . $active_class . '" data-filter=".' . $term->slug . '">' . $term->name . '</a>';

                    //add tax query from page slug
                    if ($term_last_slug === $term->slug) {
                        $portfolio_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'solution-category',
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        );
                    }
                }
                ?>
            </div>
        </div>

        <div class="filter-content">
            <div class="row">
                <?php
                $portfolio_query = new WP_Query($portfolio_args);

                $bg_colors = array(
                    '#002840',
                    '#007AC1',
                    '#FF7700',
                    '#a89f63',
                    '#363E47',
                    '#3A52A8',
                );

                $color_counter = 0;

                if ($portfolio_query->have_posts()) {
                    while ($portfolio_query->have_posts()) {
                        $portfolio_query->the_post();
                        $bg_color = $bg_colors[$color_counter % count($bg_colors)];
                        $color_counter++;
                ?>
                        <div class="col-md-6">
                            <div class="work-block" style="background-color: <?php echo $bg_color; ?>;">
                                <div class="project-main-data">
                                    <div class="work-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" width="550" height="400"></a>
                                    </div>
                                    <div class="work-data">
                                        <h5><?php the_title(); ?></h5>
                                        <p><?php echo get_the_excerpt(); ?></p>
                                    </div>
                                </div>
                                <div class="hover-project">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sticky-logo.svg" alt="logo" width="40" height="40" loading="lazy">
                                    <ul>
                                        <?php
                                        $portfolio_categories = get_the_terms(get_the_ID(), 'solution-category');
                                        if ($portfolio_categories) {
                                            foreach ($portfolio_categories as $category) {
                                                echo '<li>#' . $category->name . '</li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?php
            if ($portfolio_query->post_count < 6) {
                echo '<style>#load-more-button-solution { display: none; }</style>';
            }
            ?>
            <div class="load-more text-center">
                <?php if ($current_last_slug !== 'solutions') : ?>
                    <a href="#" id="load-more-button-solution" class="btn btn-primary" data-term="<?php echo $current_last_slug; ?>">Load More</a>
                <?php else : ?>
                    <a href="#" id="load-more-button-solution" class="btn btn-primary" data-posttype="<?php echo $post_type; ?>">Load More</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
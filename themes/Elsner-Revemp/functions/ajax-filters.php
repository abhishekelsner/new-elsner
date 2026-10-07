<?php
// Path: wp-content/themes/elsner2019/template-parts/blog/blog-content.php
function elsner_ajax_load_more_blogs()
{
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $ter_id = isset($_POST['termID']) ? sanitize_text_field($_POST['termID']) : 'all';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $excluded_ids = isset($_POST['excluded_ids']) ? array_map('intval', $_POST['excluded_ids']) : [];

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $page,
        'post_status'    => 'publish',
    );
    // Prevent duplicates
    if (!empty($excluded_ids)) {
        $args['post__not_in'] = $excluded_ids;
    }
    if (!empty($search)) {
        $args['s'] = $search;
    }

    if ($ter_id !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $ter_id,
                'operator' => 'IN',
                'include_children' => false,
            ),
        );
    }

    $additional_blog_query = new WP_Query($args);

    if ($additional_blog_query->have_posts()) {
        while ($additional_blog_query->have_posts()) {
            $additional_blog_query->the_post();
            $category = get_the_category();
            $author = get_the_author();
            $date = get_the_date('d F, Y');
?>
            <div class="col-md-6 hello blog-box" data-post-id="<?php echo get_the_ID(); ?>">
                <div class="blog-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="blog-image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/blog.svg" alt="blog image" width="690" height="auto" />';
                            }
                            ?>
                        </div>
                    </a>
                    <div class="blog-description">
                        <a href="<?php the_permalink(); ?>">
                            <span class="category"><?php echo esc_html($category[0]->name); ?></span>
                            <h4><?php the_title(); ?></h4>
                            <ul>
                                <li>by <?php echo esc_html($author); ?></li>
                                <li><?php echo esc_html($date); ?></li>
                            </ul>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="view-more">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/up-icon.svg" alt="view more" width="15" height="15">
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        wp_reset_postdata();
    }

    wp_die();
}
add_action('wp_ajax_load_more_blogs', 'elsner_ajax_load_more_blogs');
add_action('wp_ajax_nopriv_load_more_blogs', 'elsner_ajax_load_more_blogs');


// Path: wp-content/themes/elsner2019/template-parts/blog/blog-content.php
function search_blog_posts() {
    $searchTerm = sanitize_text_field($_POST['search']);
    $term_url = !empty($_POST['href']) ? sanitize_text_field($_POST['href']) : '';
    $drop_term = !empty($_POST['hrefdrop']) ? sanitize_text_field($_POST['hrefdrop']) : '';
    
    if (empty($term_url) && !empty($drop_term)) {
        $term_url = $drop_term;
    }
    

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        's'              => $searchTerm,
    );

    if (!empty($term_url) && $term_url !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy'         => 'category',
                'field'            => 'slug',
                'terms'            => $term_url,
                'include_children' => false,
            ),
        );
    } else {
        $first_post_id = get_option('els_blog_latest_post');
        if(!empty( $first_post_id )){
            $args['post__not_in'] = array($first_post_id);
        }
    }

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $category = get_the_category();
            $author   = get_the_author();
            $date     = get_the_date('d F, Y');
?>
            <div class="col-md-6 test">
                <div class="blog-card" data-post-id="<?php echo get_the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>">
                        <div class="blog-image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/blog.svg" alt="blog image" width="690" height="auto" />';
                            }
                            ?>
                        </div>
                    </a>
                    <div class="blog-description">
                        <a href="<?php the_permalink(); ?>">
                            <span class="category"><?php echo esc_html($category[0]->name); ?></span>
                            <h4><?php the_title(); ?></h4>
                            <ul>
                                <li>by <?php echo esc_html($author); ?></li>
                                <li><?php echo esc_html($date); ?></li>
                            </ul>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="view-more">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/up-icon.svg" alt="view more" width="15" height="15">
                        </a>
                    </div>
                </div>
            </div>
<?php
        }
        wp_reset_postdata();
    } else {
        echo '<div class="not_found">No posts found</div>';
    }
    wp_die();
}
add_action('wp_ajax_search_blog_posts', 'search_blog_posts');
add_action('wp_ajax_nopriv_search_blog_posts', 'search_blog_posts');



// Path: wp-content/themes/elsner2019/template-parts/our-portfolio/portfolio-content.php
function load_more_posts()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $term_slug = isset($_POST['term_slug']) ? $_POST['term_slug'] : '';

    $portfolio_args = array(
        'post_type' => array('portfolio', 'case-study'),
        'posts_per_page' => 6,
        'offset' => $offset,
        'post_status' => 'publish',
    );

    // Add tax query for the selected term slug
    if (!empty($term_slug)) {
        $portfolio_args['tax_query'] = array(
            array(
                'taxonomy' => 'platform',
                'field' => 'slug',
                'terms' => $term_slug,
            ),
        );
    }

    $portfolio_query = new WP_Query($portfolio_args);

    ob_start();
    $bg_colors = array(
        '#002840',
        '#007AC1',
        '#FF7700',
        '#a89f63',
        '#363E47',
        '#3A52A8',
    );
    $color = '#ffffff';
    $color_counter = 0;
    if ($portfolio_query->have_posts()) {
        while ($portfolio_query->have_posts()) {
            $portfolio_query->the_post();
            $bg_color = $bg_colors[$color_counter % count($bg_colors)];
            $color_counter++;

        ?>
            <div class="col-md-6 mix <?php
                                        $portfolio_technologies = get_the_terms(get_the_ID(), 'portfolio-technology');
                                        if ($portfolio_technologies) {
                                            foreach ($portfolio_technologies as $technology) {
                                                echo $technology->slug . ' ';
                                            }
                                        }
                                        ?>">
                <div class="work-block" style="background-color: <?php echo $bg_color; ?>;">
                    <div class="project-main-data">
                        <div class="work-image">
                            <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                    alt="<?php the_title(); ?>" width="550" height="400"></a>
                        </div>
                        <div class="work-data">
                            <h5><a href="<?php the_permalink(); ?>" style="color: <?php echo $color; ?>;"><?php the_title(); ?></a>
                            </h5>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            wp_reset_postdata();
        }
    } else {
        echo 'No more posts';
    }

    wp_die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts_solution()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $term_slug = isset($_POST['term_slug']) ? $_POST['term_slug'] : '';

    $portfolio_args = array(
        'post_type' => 'solution',
        'posts_per_page' => 6,
        'offset' => $offset,
    );

    // Add tax query for the selected term slug
    if (!empty($term_slug)) {
        $portfolio_args['tax_query'] = array(
            array(
                'taxonomy' => 'solution-category',
                'field' => 'slug',
                'terms' => $term_slug,
            ),
        );
    }

    $portfolio_query = new WP_Query($portfolio_args);

    ob_start();
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
            <div class="col-md-6 mix <?php
                                        $portfolio_technologies = get_the_terms(get_the_ID(), 'portfolio-technology');
                                        if ($portfolio_technologies) {
                                            foreach ($portfolio_technologies as $technology) {
                                                echo $technology->slug . ' ';
                                            }
                                        }
                                        ?>">
                <div class="work-block" style="background-color: <?php echo $bg_color; ?>;">
                    <div class="project-main-data">
                        <div class="work-image">
                            <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                    alt="<?php the_title(); ?>" width="550" height="400"></a>
                        </div>
                        <div class="work-data">
                            <h5><?php the_title(); ?></h5>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
                    <div class="hover-project">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sticky-logo.svg" alt="logo" width="40"
                            height="40" loading="lazy">
                        <ul>
                            <?php
                            $portfolio_categories = get_the_terms(get_the_ID(), 'platform');
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
            wp_reset_postdata();
        }
    } else {
        echo 'No more posts';
    }

    wp_die();
}
add_action('wp_ajax_load_more_posts_solution', 'load_more_posts_solution');
add_action('wp_ajax_nopriv_load_more_posts_solution', 'load_more_posts_solution');
function load_more_testimonials()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $loaded_testimonials = isset($_SESSION['loaded_testimonials']) ? $_SESSION['loaded_testimonials'] : array();
    $testimonials_query = array(
        'post_type' => 'testimonial',
        'posts_per_page' => 6,
        'offset' => $offset,
        'post__not_in' => $loaded_testimonials
    );
    $all_posts = new WP_Query($testimonials_query);
    if ($all_posts->have_posts()) {
        while ($all_posts->have_posts()) {
            $all_posts->the_post();

        ?>
            <div class="testimonial-box grid-item">
                <div class="video">

                </div>
                <p><?php the_excerpt(); ?></p>
                <div class="author-data">
                    <?php
                    $client_photo = get_field('client_photo', get_the_ID());
                    if ($client_photo && is_array($client_photo)) {
                        $thumbnail = wp_get_attachment_image($client_photo['ID'], 'thumbnail');
                        if ($thumbnail) {
                            echo $thumbnail;
                        } else {
                            echo '<img src="' . esc_url($client_photo['url']) . '" alt="Client Photo">';
                        }
                    } else {
                        echo '<img src="' . esc_url(site_url() . '/wp-content/uploads/2016/01/dummy-image-testi1.jpg') . '" alt="Default Client Photo">';
                    }
                    ?>
                    <div class="author-name">
                        <h6><?php the_title(); ?></h6>
                        <p><?php echo get_field('client_position', get_the_ID()); ?></p>
                    </div>
                </div>
            </div>
        <?php
            $loaded_testimonials[] = get_the_ID();
        }
    } else {
        echo '<div class="not_found">No more testimonials found.</div>';
    }
    $_SESSION['loaded_testimonials'] = $loaded_testimonials;

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_testimonials', 'load_more_testimonials');
add_action('wp_ajax_nopriv_load_more_testimonials', 'load_more_testimonials');

//clutch reviews
function load_more_clutch_reviews()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $clutch_reviews_query = array(
        'post_type' => 'clutch_review',
        'posts_per_page' => 6,
        'offset' => $offset,
    );
    $all_posts = new WP_Query($clutch_reviews_query);
    if ($all_posts->have_posts()) {
        while ($all_posts->have_posts()) {
            $all_posts->the_post();
            $rating = get_field('rating', get_the_ID());
        ?>
            <div class="testimonial-box">
                <p><?php the_content(); ?></p>
                <h6 class="Redhat-font">(<?php echo $rating; ?>.0)

                    <span class="rates">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i <= $rating) : ?>
                                <i class="fa fa-star"></i>
                            <?php else : ?>
                                <i class="fa fa-star-o"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </span>
                </h6>
                <div class="clutch-user">
                    <div class="author-data">
                        <?php add_image_size('custom_size_products', 70, 70, true);
                        the_post_thumbnail('custom_size_products'); ?>
                        <div class="author-name">
                            <h6><?php echo get_field('the_reviewer', get_the_ID()); ?></h6>
                            <p><?php echo get_field('reviewer_position', get_the_ID()); ?></p>
                        </div>
                    </div>
                    <img alt="tech img" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/clutch.svg"
                        width="190" height="32">
                </div>
            </div>
<?php
        }
    } else {
        // echo '</div><div class="not_found">No more reviews found.</div>';
    }
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_clutch_reviews', 'load_more_clutch_reviews');
add_action('wp_ajax_nopriv_load_more_clutch_reviews', 'load_more_clutch_reviews');


function load_more_events()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $term_slug = isset($_POST['year']) ? $_POST['year'] : '';
    $filtered_events = new WP_Query(array(
        'post_type' => 'event_acf',
        'posts_per_page' => 6,
        'offset' => $offset,
    ));
    if ($filtered_events->have_posts()) {
        while ($filtered_events->have_posts()) {
            $filtered_events->the_post();
            $event_id = get_the_ID();
            $event_pictures = get_field('gallery', $event_id);

            if (!empty($event_pictures)) {
                $event_date = get_the_date();
                $event_year = date('Y', strtotime($event_date));
                $row_count = count($event_pictures);

                echo '
                            <div class="life-gallery-block grid-item mix year_' . $event_year . '">
                                <div class="gallery-image">
                                    <div class="photo-count">
                                        <p>' . $row_count + 1 . ' Photos</p>
                                    </div>
                                    ';

                $main_image_url = get_the_post_thumbnail_url($event_id); // Get the main image URL

                if ($main_image_url) {
                    echo '<div class="main-image">
                                        <a href="' . $main_image_url . '" class="glightbox" data-gallery="gallery_' . $event_id . '" aria-label="glightbox link">
                                            <img src="' . $main_image_url . '" alt="' . get_the_title($event_id) . '" width="450" height="550" loading="lazy">
                                        </a>
                                    </div><div class="slider-imgs">';
                }

                foreach ($event_pictures as $index => $picture) {
                    if ($index === 0 && !$main_image_url) {
                        continue;
                    }

                    $image_url = $picture['image'];

                    echo '<div class="additional-image">
                                        <a href="' . $image_url . '" class="glightbox" data-gallery="gallery_' . $event_id . '" aria-label="glightbox link">
                                            <img src="' . $image_url . '" alt="' . get_the_title($event_id) . '" width="450" height="550" loading="lazy">
                                        </a>
                                    </div>';
                }

                echo '
                                </div>
                            </div>
                            <div class="gallery-desc white-text">
                                <h4>' . get_the_title($event_id) . '</h4>
                                <a href="' . $main_image_url . '" class="glightbox"  aria-label="glightbox link"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo '<div class="not_found">No more events found.</div>';
    }
    wp_die();
}
add_action('wp_ajax_load_more_events', 'load_more_events');
add_action('wp_ajax_nopriv_load_more_events', 'load_more_events');
// AJAX handler for loading more author posts
function load_more_author_posts_ajax() {
    // Make sure page and author are set
    $page   = isset($_POST['page']) ? intval($_POST['page']) + 1 : 1;
    $author = isset($_POST['author']) ? intval($_POST['author']) : 0;

    $args = array(
        'author'         => $author,
        'posts_per_page' => 3,   // Load 3 posts per click
        'paged'          => $page,
        'post_status'    => 'publish'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <article class="post-card">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumb"><?php the_post_thumbnail('medium'); ?></div>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo get_the_date('F Y'); ?></p>
                </a>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else:
        echo 'no-more'; // Signal no more posts
    endif;

    wp_die();
}
add_action('wp_ajax_load_more_author_posts', 'load_more_author_posts_ajax');
add_action('wp_ajax_nopriv_load_more_author_posts', 'load_more_author_posts_ajax');

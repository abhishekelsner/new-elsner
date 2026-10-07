<?php
/* Template Name: Blog */

get_header(); ?>

<section class="blog-section padding-120">
    <div class="container">
        <div class="heading">
            <h3>Read about latest trends and updates about new <span>technologies and tools</span></h3>
        </div>
        <div class="blog-wrapper">
            <div class="blog-search-head">
                <ul class="nav nav-tabs" id="search_query_selector">
                    <?php
                    $first_row = true;
                    $term_ids = array(76, 148, 503, 1525, 1532, 727, 'all',);

                    $terms = get_terms(array(
                        'taxonomy' => 'category',
                        'include' => $term_ids,
                        'orderby' => 'id',
                        'order' => 'ASC',
                    ));

                    echo '<li><a class="nav-link active" data-toggle="tab" href="#all">All Category</a></li>';

                    foreach ($terms as $term) {
                        if (in_array($term->term_id, array(1439, 388, 1355, 70))) {
                            continue;
                        }
                        echo '<li><a class="nav-link" data-toggle="tab" href="#' . $term->slug . '">' . $term->name . '</a></li>';
                    }
                    echo '<li class="clear-dropdown"><a class="nav-link" data-toggle="tab" href="#all">Clear</a></li>';

                    // Add the "More Technologies" dropdown menu
                    echo '<li class="dropdown">';
                    echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">More Technologies</a>';
                    echo '<a class="nav-link dropdown-toggle dropdown-toggle-mobile" data-toggle="dropdown" href="#">All Category</a>';
                    echo '<div class="dropdown-menu">';
                    $terms_drop = get_terms(array(
                        'taxonomy' => 'category',
                        'orderby' => 'id',
                        'order' => 'DESC',
                    ));
                    $dropdown_mobile_class = '';
                    foreach ($terms_drop as $term) {
                        $dropdown_mobile_class = (in_array($term->term_id, $term_ids)) ? 'dropdown_mobile_class' : '';
                        echo '<a class="dropdown-item '.$dropdown_mobile_class.'" href="#' . $term->slug .'" data-toggle="tab">' . $term->name . '</a>';
                    }
                    echo '</div>';
                    echo '</li>';
                    ?>
                </ul>


                <div class="searchbar">
                    <form class="search-form">
                        <input aria-label="Search" placeholder="Search blog here" type="text" class="me-2 form-control"
                            name="search" value="">
                        <button type="submit" class="search-btn" data-factors-form-bind="true">Search</button>
                    </form>
                </div>
            </div>
            <div class="loader" style="display: none;">
                <dotlottie-player src="<?php echo get_template_directory_uri() . '/assets/lotties/load-more.lottie'; ?>"
                    background="transparent" speed="1" loop autoplay width="100px" height="100px"></dotlottie-player>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php
                $first = $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish', // Only fetch published posts
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                $first_post = new WP_Query($first);
                echo '<div class="tab-pane active" id="all">';
                echo '<div class="service-blog-wrapper blog-page-list">';
                echo '<div class="row">';
                $count = 0;
                $first_post_id = '';
                if ($first_post->have_posts()) {
                    while ($first_post->have_posts()) {
                        $first_post->the_post();
                        $category = get_the_category();
                        $author = get_the_author();
                        $date = get_the_date('d F, Y');
                        $minutes = get_the_content_reading_time();
                        $views = get_post_meta(get_the_ID(), 'views', true);
                        $first_post_id = get_the_ID();

                        update_option( 'els_blog_latest_post',$first_post_id);
                        if ($count === 0) {
                            echo '</div>';
                            echo '<div class="latest-blog-box">';
                            echo '<a href="' . get_permalink() . '">';
                            echo '<div class="latest-blog-img">';
                            if (has_post_thumbnail()) {
                                add_image_size('full', 0, 0, false);
                                the_post_thumbnail('full');
                            } else {
                                echo '<img  src="' . get_stylesheet_directory_uri() . '/assets/images/blog.svg" alt="latest blog image" width="1400" loading="lazy" />';
                            }
                            echo '</div>';
                            echo '</a>';
                            echo '<div class="latest-blog-content">';
                            echo '<span class="category">' . esc_html($category[0]->name) . '</span>';
                            echo '<a href="' . get_permalink() . '"><h2>' . get_the_title() . '</h2></a>';
                            echo '<p><strong>by ' . esc_html($author) . '</strong> ' . esc_html($date) . '</p>';
                            echo '<div class="latest-blog-foot">';
                            echo '<ul>';
                            echo '<li><i class="fa fa-clock"></i> ' . esc_html($minutes) . ' min read</li>';
                            echo '</ul>';
                            echo '<a href="' . get_permalink() . '" class="btn-read-more">Read More</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                            echo '<div class="row">';
                        }
                    }
                    wp_reset_postdata();
                }

                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish', // Only fetch published posts
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post__not_in' => array($first_post_id),
                );
                $latest_portfolio_query = new WP_Query($args);
                if ($latest_portfolio_query->have_posts()) {
                    while ($latest_portfolio_query->have_posts()) {
                        $latest_portfolio_query->the_post();
                        $category = get_the_category();
                        $author = get_the_author();
                        $date = get_the_date('d F, Y');
                        $minutes = get_the_content_reading_time();
                        $views = get_post_meta(get_the_ID(), 'views', true);
                ?>
                <div class="col-md-6">
                    <div class="blog-card" data-post-id="<?php echo get_the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>">
                            <div class="blog-image">
                                <?php
                                        if (has_post_thumbnail()) {
                                            add_image_size('full', 0, 0, false);
                                            the_post_thumbnail('full');
                                        } else {
                                            echo '<img  src="' . get_stylesheet_directory_uri() . '/assets/images/blog.svg" alt="latest blog image" width="1400" loading="lazy" />';
                                        }
                                        ?>
                            </div>
                        </a>
                        <div class="blog-description">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <span class="category"><?php echo esc_html($category[0]->name); ?></span>
                                <h4><?php the_title(); ?></h4>
                                <ul>
                                    <li>by <?php echo esc_html($author); ?></li>
                                    <li><?php echo esc_html($date); ?></li>
                                </ul>
                            </a>
                            <a href="<?php the_permalink(); ?>" class="view-more">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/up-icon.svg"
                                    alt="view more" width="15" height="15" loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>

                <?php


                        $count++;
                    }
                    wp_reset_postdata();
                } else {
                    echo '<div class="not_found">No posts found</div>';
                }

                echo '</div>';
                echo '<div class="view-all-tab text-center">';
                echo '<a href="#" class="btn-primary btn load-more-button" data-term-id="all">VIEW MORE BLOGS</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';


                foreach ($terms as $term) {

                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish', // Only fetch published posts
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        ),
                    );
                    if ($term->slug == 'all') {
                        unset($args['tax_query']);
                        $args['posts_per_page'] = 2;
                    }
                    $category_blog_query = new WP_Query($args);

                    echo '<div class="tab-pane" id="' . $term->slug . '">';
                    echo '<div class="service-blog-wrapper blog-page-list">';
                    echo '<div class="row">';

                    if ($category_blog_query->have_posts()) {
                        while ($category_blog_query->have_posts()) {
                            $category_blog_query->the_post();
                            $category = get_the_category();
                            $author = get_the_author();
                            $date = get_the_date('d F, Y');


                            echo '<div class="col-md-6">';
                            echo '    <div class="blog-card">';
                            echo '        <a href="' . get_the_permalink(), '">';
                            echo '            <div class="blog-image">';

                            if (has_post_thumbnail()) {
                                add_image_size('full', 0, 0, false);
                                the_post_thumbnail('full');
                            } else {
                                echo '<img  src="' . get_template_directory_uri() . '/assets/images/blog.svg" alt="blog image" width="690" height="auto" />';
                            }

                            echo '            </div>';
                            echo '        </a>';
                            echo '        <div class="blog-description">';
                            echo '            <a href="' . get_the_permalink() . '">';
                            echo ' <span class="category">' . esc_html($category[0]->name) . '</span>';
                            echo ' <h4>' . get_the_title() . '</h4>';
                            echo ' <ul>';
                            echo ' <li>by ' . esc_html($author) . '</li>';
                            echo ' <li>' . esc_html($date) . '</li>';
                            echo ' </ul>';
                            echo ' </a>';
                            echo ' <a href="' . get_the_permalink() . '" class="view-more">';
                            echo ' <img src="' . get_template_directory_uri() . '/assets/images/up-icon.svg" alt="view more"
                        width="15" height="15">';
                            echo ' </a>';
                            echo '
            </div>';
                            echo '
        </div>';
                            echo '
    </div>';
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<div class="not_found">No posts found</div>';
                    }
                    echo '</div>';

                    echo '<div class="view-all text-center">';
                    echo '<a href="#" class="btn-primary btn load-more-button" data-term-id="' . $term->slug, '">VIEW MORE
            BLOGS</a>';
                    echo '</div>';


                    echo '</div>';
                    echo '</div>';
                }
                foreach ($terms_drop as $term) {

                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish', // Only fetch published posts
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $term->slug,
                            ),
                        ),
                    );
                    if ($term->slug == 'all') {
                        unset($args['tax_query']);
                        $args['posts_per_page'] = 2;
                    }
                    $category_blog_query = new WP_Query($args);

                    echo '<div class="tab-pane" id="' . $term->slug . '">';
                    echo '<div class="service-blog-wrapper blog-page-list">';
                    echo '<div class="row">';

                    if ($category_blog_query->have_posts()) {
                        while ($category_blog_query->have_posts()) {
                            $category_blog_query->the_post();
                            $category = get_the_category();
                            $author = get_the_author();
                            $date = get_the_date('d F, Y');


                            echo '<div class="col-md-6">';
                            echo ' <div class="blog-card">';
                            echo ' <a href="' . get_the_permalink(), '">';
                            echo ' <div class="blog-image">';

                            if (has_post_thumbnail()) {
                                add_image_size('full', 0, 0, false);
                                the_post_thumbnail('full');
                            } else {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/blog.svg"
                                    alt="blog image" width="690" height="auto" />';
                            }

                            echo ' </div>';
                            echo ' </a>';
                            echo ' <div class="blog-description">';
                            echo ' <a href="' . get_the_permalink() . '">';
                            echo ' <span class="category">' . esc_html($category[0]->name) . '</span>';
                            echo ' <h4>' . get_the_title() . '</h4>';
                            echo ' <ul>';
                            echo ' <li>by ' . esc_html($author) . '</li>';
                            echo ' <li>' . esc_html($date) . '</li>';
                            echo ' </ul>';
                            echo ' </a>';
                            echo ' <a href="' . get_the_permalink() . '" class="view-more">';
                            echo ' <img src="' . get_template_directory_uri() . '/assets/images/up-icon.svg"
                                    alt="view more" width="15" height="15">';
                            echo ' </a>';
                            echo '
                        </div>';
                            echo '
                    </div>';
                            echo '
                </div>';
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<div class="not_found">No posts found</div>';
                    }
                    echo '</div>';

                    echo '<div class="view-all text-center">';
                    echo '<a href="#" class="btn-primary btn load-more-button" data-term-id="' . $term->slug, '">VIEW MORE
                    BLOGS</a>';
                    echo '</div>';


                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

    </div>
</section>

<?php
get_template_part('template-parts/blog/get-in-touch', 'section', array('post_id' => get_the_ID()));
get_footer();
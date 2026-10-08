<section class="blog-section padding-120">
    <div class="container">
        <div class="heading">
            <h3>Read about the latest trends and updates about new <span>technologies and tools</span></h3>
        </div>
        <div class="blog-wrapper">
            <div class="blog-search-head">
                <ul class="nav nav-tabs">
                    <?php
                    $term_ids = array(76, 148, 355, 1044, 202, 950, 355, 'all', 1439, 388, 1355, 70);
                    $terms = get_terms(array(
                        'taxonomy' => 'category',
                        'include' => $term_ids,
                        'orderby' => 'id',
                        'order' => 'ASC',
                    ));

                    foreach ($terms as $term) {
                        if (in_array($term->term_id, array(1439, 388, 1355, 70))) {
                            continue;
                        }

                        echo '<li class="' . ($term->slug === 'all' ? 'active' : '') . '">';
                        echo '<a data-toggle="tab" href="#' . $term->slug . '">' . $term->name . '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
                <div class="searchbar">
                    <form class="search-form">
                        <label for="blog-search-input" class="screen-reader-text" style="display:none;">Search</label>
                        <input type="text" id="blog-search-input" name="search" placeholder="Search..." aria-label="Search">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="loader">
                <dotlottie-player src="<?php echo get_template_directory_uri() . 'assets/lotties/load-more.lottie'; ?>" background="transparent" speed="1" loop autoplay></dotlottie-player>
            </div>

            <div class="tab-content">
                <?php
                $all_query_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5,
                    'orderby' => 'date',
                    'post_status' => 'publish', // Ensure only published posts are fetched
                    'order' => 'DESC',
                );
                $all_posts = get_transient('blog_all_posts');

                if (false === $all_posts) {
                    $all_posts = new WP_Query($all_query_args);
                    set_transient('blog_all_posts', $all_posts, DAY_IN_SECONDS);
                }

                render_blog_posts($all_posts, 'all');

                foreach ($terms as $term) {
                    if (in_array($term->term_id, array(1439, 388, 1355, 70))) {
                        continue;
                    }

                    $category_query_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'post_status' => 'publish', // Ensure only published posts are fetched
                        'order' => 'DESC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $term->slug,
                                'include_children' => false,
                            ),
                        ),
                    );

                    if ($term->slug == 'all') {
                        unset($category_query_args['tax_query']);
                        $category_query_args['posts_per_page'] = 2;
                    }

                    $category_posts_transient_key = 'blog_category_' . $term->slug . '_posts';
                    $category_posts = get_transient($category_posts_transient_key);

                    if (false === $category_posts) {
                        $category_posts = new WP_Query($category_query_args);
                        set_transient($category_posts_transient_key, $category_posts, DAY_IN_SECONDS);
                    }


                    render_blog_posts($category_posts, $term->slug);
                }

                function render_blog_posts($query, $term_slug)
                {
                    if ($query->have_posts()) {
                        echo '<div id="' . $term_slug . '" class="tab-pane fade ' . ($term_slug === 'all' ? 'in active' : '') . '">';

                        while ($query->have_posts()) {
                            $query->the_post();
                            $category = get_the_category();
                            $author = get_the_author();
                            $date = get_the_date('d F, Y');

                            echo '<div class="col-md-6">';
                            echo '<div class="blog-card">';
                            echo '<a href="' . get_the_permalink() . '">';
                            echo '<div class="blog-image">';

                            if (has_post_thumbnail()) {
                                add_image_size('full', 0, 0, false);
                                the_post_thumbnail('full');
                            } else {
                                echo '<img  src="' . get_stylesheet_directory_uri() . '/assets/images/blog.svg" alt="blog image" width="690" height="auto" />';
                            }

                            echo '</div>';
                            echo '</a>';
                            echo '<div class="blog-description">';
                            echo '<a href="' . get_the_permalink() . '">';
                            echo '<span class="category">' . esc_html($category[0]->name) . '</span>';
                            echo '<h4>' . get_the_title() . '</h4>';
                            echo '<ul>';
                            echo '<li>by ' . esc_html($author) . '</li>';
                            echo '<li>' . esc_html($date) . '</li>';
                            echo '</ul>';
                            echo '</a>';
                            echo '<a href="' . get_the_permalink() . '" class="view-more">';
                            echo '<img  src="' . get_template_directory_uri() . '/assets/images/up-icon.svg" alt="view more" width="15" height="15">';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        wp_reset_postdata();
                    } else {
                        // echo '<div class="not_found">No posts found</div>';
                    }

                    echo '</div>';
                    echo '<div class="view-all text-center">';
                    echo '<a href="#" class="btn-primary btn load-more-button" data-term-id="' . $term_slug . '">VIEW MORE BLOGS</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
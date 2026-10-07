<section class="featured-projects section section-padding " id="section4">
    <div class="inner-container">
        <div class="heading flex">
            <h3>Our <span>Featured Projects</span></h3>
            <div class="all-project">
                <?php
                $page_slug = 'our-portfolio';
                $page = get_page_by_path($page_slug);
                if ($page) {
                    $page_link = get_permalink($page->ID);
                }
                ?>
                <a href="<?php echo $page_link; ?>" class="all-link"><?php echo esc_html('All eCommerce Projects'); ?></a>
            </div>
        </div>
        <div class="projects-wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="project-head">
                        <ul class="nav nav-pills">
                            <?php
                            $term_ids = array(26, 27, 110, 1529, 116, 117, 118, 'all'); // Replace with your desired term IDs
                            $terms = get_terms(array(
                                'taxonomy' => 'portfolio-technology',
                                'include' => $term_ids,
                                'orderby' => 'id',
                                'order' => 'ASC',
                            ));

                            echo '<li><a class="term_slugs" data-toggle="pill" href="#all">All</a></li>';

                            foreach ($terms as $term) {
                                echo '<li><a class="term_slugs" data-toggle="pill" href="#' . $term->slug . '">' . $term->name . '</a></li>';
                            }
                            ?>
                        </ul>

                        <a href="<?php echo $page_link; ?>" class="btn btn-primary"><?php echo esc_html('EXPLORE ALL'); ?></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <?php
                    echo '<div class="tab-content">';
                    foreach ($terms as $term) {
                        $active_class = $term->slug == 'all' ? 'active show' : '';
                        echo '<div id="' . $term->slug . '" class="tab-pane fade ' . $active_class . '">';
                        $args = array(
                            'post_type' => array('portfolio', 'case-study'), // Include both post types
                            'posts_per_page' => 2,
                            'orderby' => 'date',  // Order by date
                            'order' => 'DESC',    // Display the latest posts first
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'portfolio-technology',
                                    'field' => 'slug',
                                    'terms' => $term->slug
                                )
                            )
                        );

                        if ($term->slug == 'all') {
                            unset($args['tax_query']);
                            $args['posts_per_page'] = 2;
                        }

                        //  $portfolio_query = get_transient('portfolio_query');
                        // if (!$portfolio_query) {
                        $portfolio_query = new WP_Query($args);
                        //   set_transient('portfolio_query', $portfolio_query, DAY_IN_SECONDS);
                        // }
                        if ($portfolio_query->have_posts()) {
                            echo '<div class="project-box">';
                            echo '<div class="row">';
                            while ($portfolio_query->have_posts()) {
                                $portfolio_query->the_post();
                                echo '<div class="col-md-6">';
                                echo '<div class="projects">';
                                echo '<a href="' . get_permalink() . '">';
                                echo '<div class="project-img">';
                                echo '<img class="lazy" src="' . get_the_post_thumbnail_url() . '" alt="project image" height="400" width="450" loading="lazy">';
                                echo '<div class="hover-project">';
                                echo '<img class="lazy" src="' . get_template_directory_uri() . '/assets/images/sticky-logo.svg" alt="logo" height="40" width="40" loading="lazy">';
                                echo '<ul>';
                                $terms_tag = get_the_terms(get_the_ID(), 'platform');
                                if (!empty($terms_tag) && is_array($terms_tag)) {
                                    foreach ($terms_tag as $term_tag) {
                                        echo '<li>#' . $term_tag->name . '</li>';
                                    }
                                }
                                echo '</ul>';
                                echo '</div>';

                                echo '</div>';
                                echo '<div class="project-description">';

                                echo '<h4>' . get_the_title() . '</h4>';

                                add_filter('excerpt_length', 'custom_excerpt_length');

                                echo '<p>' . get_the_excerpt() . '</p>';

                                remove_filter('excerpt_length', 'custom_excerpt_length');

                                echo '</div>';
                                echo '</a>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div class="not_found"><p>No projects found.</p></div>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                    wp_reset_postdata();
                    ?>
                </div>

            </div>

        </div>
        <div class="brands">
            <div class="heading">
                <h2 class="head text-center"><?php echo get_field('premium_partners_heading', 'option'); ?></h2>
            </div>
            <ul>
                <?php if (have_rows('premium_partners_repeater', 'option')) : ?>
                <?php while (have_rows('premium_partners_repeater', 'option')) : the_row(); ?>
                <?php $image_id = get_sub_field('premium_partners_logos', 'option');
                      $premium_partners_links = get_sub_field('premium_partners_links', 'option'); ?>
                <li>
                    <?php if (!empty($premium_partners_links)) : ?>
                    <a href="<?php echo esc_url($premium_partners_links); ?>" target="_blank">
                        <?php endif; ?>
                        <img class="lazy" src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'full')); ?>"
                            alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                            title="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>"
                            style="width: 100%; height: 100%;" loading="lazy">
                        <?php if (!empty($premium_partners_links)) : ?>
                    </a>
                    <?php endif; ?>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</section>
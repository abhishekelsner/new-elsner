<section class="elsner-life-events">
    <div class="container">
        <div class="filter-list">
            <!-- <h5 class="Redhat-font white-text">Events Category</h5> -->
            <div class="category-filter white-filter">
                <?php
                $selected_years = array();

                if (isset($_GET['selected_years'])) {
                    $selected_years = explode(',', $_GET['selected_years']);
                }

                $years = array();

                $events = new WP_Query(array(
                    'post_type' => 'event_acf',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                ));

                while ($events->have_posts()) {
                    $events->the_post();
                    $event_date = get_the_date();
                    $event_year = date('Y', strtotime($event_date));
                    if (!in_array($event_year, $years)) {
                        $years[] = $event_year;
                    }
                }

                rsort($years);

                // Check if "All Events" is selected
                $all_events_active = empty($selected_years) ? ' active' : '';

                //echo '<button type="button" class="filter-btn' . $all_events_active . '" data-filter=".all" disabled="disabled">All Events</button>';

                foreach ($years as $year) {
                    $active_class = in_array($year, $selected_years) ? ' active' : '';
                    //  echo '<button type="button" class="filter-btn' . $active_class . '" data-filter=".year_' . $year . '">Year ' . $year . '</button>';
                }
                ?>
            </div>

        </div>
        <div class="life_gallary grid-container">
            <div class="grid-sizer"></div>
            <?php
            $selected_posts = array();

            $filtered_events = new WP_Query(array(
                'post_type' => 'event_acf',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
            ));


            
            $all_posts = get_transient('event_all_posts');
            if (false === $all_posts) {
                set_transient('event_all_posts', $filtered_events, DAY_IN_SECONDS);
            }
            render_events($all_posts, 'all');
            foreach ($years as $year) {
                $event_query_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'date_query' => array(
                        array(
                            'year' => $year,
                        ),
                    ),
                );

                if ($term->slug == 'all') {
                    unset($event_query_args['date_query']);
                    $event_query_args['posts_per_page'] = 6;
                }

                $event_posts_transient_key = 'event_' . $year . '_posts';
                $event_posts = get_transient($event_posts_transient_key);

                if (false === $event_posts) {
                    $event_posts = new WP_Query($event_query_args);
                    set_transient($event_posts_transient_key, $event_posts, DAY_IN_SECONDS);
                }

                render_events($event_posts, $year);
            }
            function render_events($query, $event_year)
            {
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
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
                                        <a href="' . $main_image_url . '" class="glightbox" data-gallery="gallery_' . $event_id . '" >
                                            <img src="' . $main_image_url . '" alt="' . get_the_title($event_id) . '" width="450" height="550" loading="lazy">
                                        </a>
                                    </div><div class="slider-imgs">';
                            }

                            foreach ($event_pictures as $index => $picture) {
                                echo $index;

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
                }
            }


            ?>

        </div>
        <div class="view-all text-center view-events">
            <?php
            echo '<a href="#" class="btn-outline btn load-more-event" data-year="' . $event_year . '" data-posttype="event_acf">View more events</a>';
            $page_slug = 'career';
            $page = get_page_by_path($page_slug);
            if ($page) {
                $page_link = get_permalink($page->ID);
            }

            echo '<a href="' . $page_link . '" class="btn btn-secondary">JOIN OUR TEAM</a>';
            ?>
        </div>
    </div>
</section>
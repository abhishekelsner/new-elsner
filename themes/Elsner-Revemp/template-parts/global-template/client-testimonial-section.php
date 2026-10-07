<section class="client-testimonial_sec padding-80 blue-section">
    <div class="container">
        <div class="block-title text-center max-700">
            <h2>Our Happy Clients Testimonials</h2>
        </div>
        <div class="client-review">
            <div class="review-slider-for slick-slider">
                <?php
                $args = array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => 5,
                    'post__in' => array(36220, 80, 6550, 27589, 24127),
                );

                $clients_query = get_transient('clients_query');
                delete_transient('clients_query');
                if (!$clients_query) {
                    $clients_query = new WP_Query($args);
                    set_transient('clients_query', $clients_query, DAY_IN_SECONDS);
                }

                if ($clients_query->have_posts()) {
                    while ($clients_query->have_posts()) : $clients_query->the_post();
                ?>
                <div class="user-slide">
                    <div class="user-img">
                        <?php
                                $client_photo = get_field('client_photo');
                                if ($client_photo) {
                                    $thumbnail = $client_photo['sizes']['thumbnail'];
                                    $medium = $client_photo['sizes']['medium']; // Get the medium size image URL
                                    $large = $client_photo['sizes']['large']; // Get the large size image URL
                                    if ($thumbnail) {
                                        echo '<img src="' . $thumbnail . '" srcset="' . $medium . ' 600w, ' . $large . ' 1200w,' . $thumbnail . ' 300w " alt="' . $client_photo['alt'] . '">';
                                    }
                                }
                                ?>
                    </div>
                    <div class="user-detail">
                        <p class="name"><?php echo esc_html(get_the_title()); ?></p>
                        <p class="designation"><?php echo esc_html(get_field('client_post')); ?></p>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                }
                ?>
            </div>
            <div class="review-slider-nav slick-slider">
                <?php
                if ($clients_query->have_posts()) {
                    while ($clients_query->have_posts()) : $clients_query->the_post();
                        $rating = get_field('rating');
                        if (empty($rating)) {
                            $rating = 5;
                        }
                ?>
                <div class="review-data-slide">
                    <p class="head_rate">
                        <span class="rates">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i <= $rating) : ?>
                            <i class="fa fa-star"></i>
                            <?php else : ?>
                            <i class="fa fa-star-o"></i>
                            <?php endif; ?>
                            <?php endfor; ?>
                        </span> (<?php echo $rating; ?>.0)
                    </p>
                    <div class="description">
                        <p><?php echo get_the_content(); ?></p>
                    </div>
                    <!-- <a href="#" class="btn btn-primary"><i class="fa fa-video"></i>View Video</a> -->
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
        <!-- The Modal -->
        <!-- <div class="modal review-modal" id="reviewModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <iframe width="418" height="300" src="https://www.youtube.com/embed/NLSe3AK0n0w" title="LaMont Henry Talking about Elsner&#39;s Service" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
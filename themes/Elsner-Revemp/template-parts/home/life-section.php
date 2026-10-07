<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$section_style = "style='background-color: #002840;'";
?>
<section class="our-life section section-padding blue-section" id="section7" <?php echo $section_style; ?>>
    <div class="inner-container">
        <div class="heading white">
            <?php echo get_field('section_label', $post_id); ?>
            <h2 class="subhead"><?php echo get_field('section_content_life', $post_id); ?></h2>
        </div>
        <div class="elsnerlife-row">
            <div class="row">
                <?php

                $transient_name = 'event_posts';
                $event_posts = get_transient($transient_name);
                if (false === $event_posts) {
                    $args = array(
                        'post_type' => 'event_acf',
                        'posts_per_page' => 4,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                    $query = new WP_Query($args);

                    $event_posts = array();

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            $title = get_the_title();
                            $cta_link = get_permalink();

                            $event_posts[] = array(
                                'image' => $image,
                                'title' => $title,
                                'cta_link' => $cta_link,
                            );
                        }
                        wp_reset_postdata();
                        set_transient($transient_name, $event_posts, 3600);
                    }
                }

                foreach ($event_posts as $event_post) {
                    $image = $event_post['image'];
                    $title = $event_post['title'];
                    $cta_link = $event_post['cta_link'];
                ?>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="life-elsner-block">
                        <picture>
                            <img class="lazy" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" height="380"
                                width="350" loading="lazy"
                                sizes="(max-width: 710px) 200px, (max-width: 991px) 300px, 380px">
                        </picture>
                        <div class="life-overlay-block">
                            <h2><?php echo $title; ?></h2>
                            <?php
                                $page_slug = 'life-at-elsner';
                                $page = get_page_by_path($page_slug);
                                if ($page) {
                                    $page_link = get_permalink($page->ID);
                                }

                                ?>
                            <div class="read-more">
                                <a class="cta-link" href="<?php echo $page_link; ?>">EXPLORE MORE</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
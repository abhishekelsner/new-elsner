<?php
$recent_projects_title = get_field('recent_projects_title');
$current_post_id = get_the_ID();

// Get shared taxonomy terms (change taxonomy name if different)
$related_terms = wp_get_post_terms($current_post_id, 'portfolio-technology', array('fields' => 'ids'));

?>
<div class="main-case-study-site-wrapper">
    <section>
        <div class="case-study-our-recent-projects">
            <div class="container">
                <h2><?php echo $recent_projects_title; ?></h2>
                <?php
                global $post; // Get the current post              

                $args = array(
                    'post_type'      => array('case-study', 'portfolio'), // BOTH post types
                    'posts_per_page' => 2,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post__not_in'   => array($current_post_id), // Exclude current post
                );

                if (!empty($related_terms)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'portfolio-technology', // same taxonomy
                            'field'    => 'term_id',
                            'terms'    => $related_terms,
                            'operator' => 'IN',
                        ),
                    );
                }

                $recent_projects = new WP_Query($args);

                if ($recent_projects->have_posts()) :
                ?>
                    <div class="portfolio-section test">
                        <div class="display-recent-projects d-flex">
                            <?php while ($recent_projects->have_posts()) : $recent_projects->the_post(); 
                            ?>
                                <div class="projects-show">
                                    <a href="<?php the_permalink(); ?>" class="project-link">
                                        <div class="project-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <p><span><?php the_title(); ?></span></p>
                                        <p><?php the_excerpt(); ?> <span class="case-study-read-btn">Read More </span></p>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                <?php
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
    </section>
</div>
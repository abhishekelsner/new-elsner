<?php
$case_study_heading = get_field('case_study_heading');
$case_study_description = get_field('case_study_description');
$case_study_cta = get_field('case_study_cta');
$selected_terms = get_field('case_study_posts');

if ( !empty($case_study_heading) || !empty($case_study_description) || !empty($selected_terms) ) : ?>
    <!-- Featured Projects Section -->
    <section class="featured-section new-services-dev padding-80">
        <div class="container">
            <div class="section-header">
                <?php if ( !empty($case_study_heading) ) : ?>
                    <h2><?php echo esc_html($case_study_heading); ?></h2>
                <?php endif; ?>

                <?php if ( !empty($case_study_description) ) : ?>
                    <p><?php echo esc_html($case_study_description); ?></p>
                <?php endif; ?>

                <div class="btn-wrapper">
                    <a href="https://www.elsner.com/our-portfolio/">View All</a>
                </div>
            </div>

            <?php
            if ( $selected_terms ) {
                $term_ids = [];
                foreach ( $selected_terms as $term ) {
                    $term_ids[] = is_object($term) ? $term->term_id : $term;
                }
                $term_ids = array_unique($term_ids);

                $args = [
                    'post_type'      => ['case-study', 'portfolio'],
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'tax_query'      => [
                        [
                            'taxonomy' => 'portfolio-technology',
                            'field'    => 'term_id',
                            'terms'    => $term_ids,
                        ],
                    ],
                ];

                $related = new WP_Query($args);

                if ( $related->have_posts() ) : ?>
                    <div class="featured-box">
                        <div class="row">
                            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="featured-main-box">
                                        <div class="image-wrapper">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="featured-main-content">
                                            <div class="featured-title">
                                                <h3><?php the_title(); ?></h3>
                                            </div>
                                            <div class="rich-text">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <div class="btn-featured">
                                                <a href="<?php the_permalink(); ?>" target="_blank">View Case Study</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif;
            }
            ?>
        </div>
    </section>
<?php endif; ?>

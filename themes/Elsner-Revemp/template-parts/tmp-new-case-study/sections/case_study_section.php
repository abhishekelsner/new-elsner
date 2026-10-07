<?php
// Section main fields (from ACF)
$section_heading = get_sub_field('heading');
$description         = get_sub_field('description');
$listing_title = get_sub_field('listing_title'); 
?>

<section class="case-study-section">
    <div class="container">
        <div class="case-study">
            <div class="elsner-content">
                <?php if ($section_heading): ?>
                    <h2 class="section-heading"><?php echo $section_heading; ?></h2>
                <?php endif; ?>
                <?php if ($description): ?>
                    <p class="section-subheading"><?php echo $description; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <h2 class="section-heading">
                <?php echo esc_html($listing_title); ?>
        </h2>
        <?php
        // 🔹 Fetch ALL terms from taxonomy dynamically
        $all_terms = get_terms(array(
            'taxonomy'   => 'portfolio-technology',
            'hide_empty' => true,
        ));
        ?>

        <?php if (!empty($all_terms) && !is_wp_error($all_terms)) : ?>
            <div class="portfolio-filters">
                <?php
                // Get total count for "All Solutions"
                $total_count = wp_count_posts('case-study')->publish + wp_count_posts('portfolio')->publish;
                ?>
                <button class="category-filter active" data-slug="all">
                    All Solutions
                    <span class="filter-count"><?php echo $total_count; ?></span>
                </button>
                <?php foreach ($all_terms as $term) : ?>
                    <button class="category-filter" data-slug="<?php echo esc_attr($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                        <span class="filter-count"><?php echo $term->count; ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        // 🔹 Query posts (case-study + portfolio) under taxonomy
        $args = array(
            'post_type'      => array('case-study', 'portfolio'),
            'posts_per_page' => 3,
            'paged'          => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
        ?>
            <section class="portfolio-case-studies">
                <div class="container">
                    <div id="posts-container" class="portfolio-items">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <article class="portfolio-card"
                                data-category="<?php echo esc_attr(join(' ', wp_list_pluck(get_the_terms(get_the_ID(), 'portfolio-technology'), 'slug'))); ?>">
                                <div class="card-inner">
                                    <div class="portfolio-thumb">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php
                                        $thumb_terms = get_the_terms(get_the_ID(), 'portfolio-technology');
                                        if ($thumb_terms && !is_wp_error($thumb_terms)) :
                                            $first_term = $thumb_terms[0];
                                        ?>
                                            <span class="thumb-tag"><?php echo esc_html($first_term->name); ?></span>
                                        <?php endif; ?>
                                        <?php
                                        $listing_details = get_field('listing_page_details', get_the_ID());
                                        $bottom_text     = $listing_details['listing_page_details_bottom_text_'] ?? null;

                                        if( $bottom_text ): ?>
                                            <div class="thumb-bottom-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path d="M13.3335 5.83325H18.3335V10.8333" stroke="#00BDF2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M18.3332 5.83325L11.2498 12.9166L7.08317 8.74992L1.6665 14.1666" stroke="#00BDF2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <?php echo esc_html($bottom_text); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="portfolio-content">
                                        <h3 class="portfolio-title"><?php the_title(); ?></h3>

                                        <?php 
                                        $listing_details = get_field('listing_page_details', get_the_ID());
                                        $client_name     = $listing_details['client_name'] ?? '';
                                        ?>
                                        <?php if ($client_name) : ?>
                                            <div class="portfolio-meta">
                                                <span class="portfolio-client">
                                                    <?php echo esc_html($client_name); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="portfolio-excerpt"><?php the_content(); ?></div>
                                        <?php
                                        $post_id = get_the_ID();
                                        $portfolio_cards = null;
                                        $sections = get_field('case_study_sections', $post_id);

                                        if( $sections && is_array($sections) ):
                                            foreach( $sections as $section ):
                                                if( $section['acf_fc_layout'] == 'about_case_study_left_right' ):
                                                    $portfolio_cards = $section['cards'] ?? null;
                                                    break;
                                                endif;
                                            endforeach;
                                        endif;

                                        if( $portfolio_cards && is_array($portfolio_cards) ):
                                            $first_two = array_slice($portfolio_cards, 0, 3);
                                        ?>
                                            <div class="portfolio-stat-cards">
                                                <?php foreach( $first_two as $index => $card ):
                                                    $percent = $card['percent'] ?? '';
                                                    $text    = $card['text'] ?? '';
                                                ?>
                                                    <div class="portfolio-stat-item portfolio-stat-item--<?php echo $index + 1; ?>">
                                                        <?php if( $percent ): ?>
                                                            <div class="portfolio-stat-percent"><?php echo esc_html($percent); ?></div>
                                                        <?php endif; ?>
                                                        <?php if( $text ): ?>
                                                            <div class="portfolio-stat-text"><?php echo esc_html($text); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="portfolio-tags">
                                            <?php
                                            $terms = get_the_terms(get_the_ID(), 'case-study-tag');
                                            if ($terms && !is_wp_error($terms)) :
                                                foreach ($terms as $term) :
                                                    echo '<span class="tag">' . esc_html($term->name) . '</span>';
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>

                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Full Case Study<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
<path d="M10 2H14V6" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.6665 9.33333L13.9998 2" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12 8.66667V12.6667C12 13.0203 11.8595 13.3594 11.6095 13.6095C11.3594 13.8595 11.0203 14 10.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V5.33333C2 4.97971 2.14048 4.64057 2.39052 4.39052C2.64057 4.14048 2.97971 4 3.33333 4H7.33333" stroke="white" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
</svg></a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <div class="load-more text-center">
                        <?php
                        // Assuming $query is the WP_Query object used for the loop above
                        // Get the current page number, defaulting to 1
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        // Check if the current page is less than the total number of pages
                        if ($paged < $query->max_num_pages) :
                        ?>
                            <button id="load-more" class="btn btn-primary">Load More Projects</button>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</section>

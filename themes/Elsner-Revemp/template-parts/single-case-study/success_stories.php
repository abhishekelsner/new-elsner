<?php  
// Get ACF fields
$heading     = get_sub_field('heading');  
$sub_heading = get_sub_field('sub_heading');  
$bottom_text = get_sub_field('bottom_text');  

$bottom_btn1 = get_sub_field('bottom_button_1');  
$bottom_btn2 = get_sub_field('bottom_button_2');  
?>

<section class="success-stories">
    <div class="container">
        
        <?php if( $heading ): ?>
            <h2 class="section-title"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <?php if( $sub_heading ): ?>
            <p class="section-subtitle"><?php echo esc_html( $sub_heading ); ?></p>
        <?php endif; ?>

        <?php
        $current_post_id = get_the_ID();

        $tech_terms = wp_list_pluck(
            get_the_terms($current_post_id, 'portfolio-technology') ?: array(),
            'term_id'
        );

        $related_posts = array();

        $common_args = array(
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post__not_in'   => array($current_post_id),
        );

        if (!empty($tech_terms)) {
            $common_args['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio-technology',
                    'field'    => 'term_id',
                    'terms'    => $tech_terms,
                    'operator' => 'IN',
                ),
            );
        }

        // FIRST: fetch case studies
        $case_args  = array_merge($common_args, array(
            'post_type' => 'case-study',
        ));
        $case_query = new WP_Query($case_args);

        if ($case_query->have_posts()) {
            while ($case_query->have_posts()) {
                $case_query->the_post();
                $related_posts[] = get_the_ID();
            }
        }
        wp_reset_postdata();

        // SECOND: fill remaining slots with portfolio posts
        $remaining = 3 - count($related_posts);

        if ($remaining > 0) {
            $portfolio_args  = array_merge($common_args, array(
                'post_type'      => 'portfolio',
                'posts_per_page' => $remaining,
                'post__not_in'   => array_merge(array($current_post_id), $related_posts),
            ));
            $portfolio_query = new WP_Query($portfolio_args);

            if ($portfolio_query->have_posts()) {
                while ($portfolio_query->have_posts()) {
                    $portfolio_query->the_post();
                    $related_posts[] = get_the_ID();
                }
            }
            wp_reset_postdata();
        }

        // FINAL: render cards
        if (!empty($related_posts)) :
            $display_query = new WP_Query(array(
                'post_type'      => array('case-study', 'portfolio'),
                'post__in'       => $related_posts,
                'orderby'        => 'post__in',
                'posts_per_page' => 3,
            ));

            if ($display_query->have_posts()) : ?>
                <div class="stories-grid">
                    <?php while ($display_query->have_posts()) : $display_query->the_post(); ?>
                        <div class="story-card">
                            <div class="story-card-wrapper"> 

                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="story-thumb">
                                        <?php 
                                        $listing_details  = get_field('listing_page_details', get_the_ID());
                                        $suggestion_title = $listing_details['suggestion_image_title'] ?? '';
                                        ?>

                                        <?php if ($suggestion_title) : ?>
                                            <span class="story-img-badge"><?php echo esc_html($suggestion_title); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="story-body">

                                    <?php 
                                    $terms = get_the_terms(get_the_ID(), 'portfolio-technology');
                                    if ($terms && !is_wp_error($terms)) : ?>
                                        <div class="story-tags">
                                            <?php foreach ($terms as $term) : ?>
                                                <span class="story-tag"><?php echo esc_html($term->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="story-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <p class="story-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 22); ?>
                                    </p>

                                    <?php 
                                    $post_cards = null;
                                    $post_id    = get_the_ID();
                                    $sections   = get_field('case_study_sections', $post_id);

                                    if ($sections && is_array($sections)) :
                                        foreach ($sections as $section) :
                                            if ($section['acf_fc_layout'] == 'about_case_study_left_right') :
                                                $post_cards = $section['cards'] ?? null;
                                                break;
                                            endif;
                                        endforeach;
                                    endif;

                                    if ($post_cards && is_array($post_cards)) :
                                        $first_two = array_slice($post_cards, 0, 2);
                                    ?>
                                        <!-- <div class="story-stat-cards">
                                            <?php foreach ($first_two as $index => $card) :
                                                $icon    = $card['icon'];
                                                $percent = $card['percent'];
                                                $text    = $card['text'];
                                            ?>
                                                <div class="story-stat-item story-stat-item--<?php echo $index + 1; ?>">
                                                    <?php if (!empty($icon)) : ?>
                                                        <div class="stat-icon">
                                                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($percent) : ?>
                                                        <div class="stat-percent"><?php echo esc_html($percent); ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($text) : ?>
                                                        <div class="stat-text"><?php echo esc_html($text); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div> -->
                                    <?php endif; ?>

                                    <div class="btn-wrapper">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                            Read Full Case Study 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M2.91669 7H11.0834" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 2.9165L11.0833 6.99984L7 11.0832" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php 
            endif;
            wp_reset_postdata();
        endif; ?>

        <?php if ($bottom_text || $bottom_btn1 || $bottom_btn2) : ?>
            <div class="stories-footer">
                <?php if ($bottom_text) : ?>
                    <p class="footer-text"><?php echo esc_html($bottom_text); ?></p>
                <?php endif; ?>

                <div class="footer-buttons">
                    <?php if ($bottom_btn1) : ?>
                        <a href="<?php echo esc_url($bottom_btn1['url']); ?>" 
                           target="<?php echo esc_attr($bottom_btn1['target'] ?: '_self'); ?>" 
                           class="btn btn-secondary">
                            <?php echo esc_html($bottom_btn1['title']); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                <path d="M2.91669 7H11.0834" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 2.9165L11.0833 6.99984L7 11.0832" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if ($bottom_btn2) : ?>
                        <a href="<?php echo esc_url($bottom_btn2['url']); ?>" 
                           target="<?php echo esc_attr($bottom_btn2['target'] ?: '_self'); ?>" 
                           class="btn btn-primary">
                            <?php echo esc_html($bottom_btn2['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
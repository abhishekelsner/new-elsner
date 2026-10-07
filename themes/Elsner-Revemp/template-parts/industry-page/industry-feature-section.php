<?php

/**
 * Industry Feature Grid Template
 * 
 */
$feature_rows = get_field('industry_page_industry_feature_row');

if ($feature_rows) :
    foreach ($feature_rows as $row) :
        // 1. Style Toggle: Check if 'Style Config' checkbox is ticked
        $is_blue = !empty($row['industry_page_style_config']);
        $section_class = $is_blue ? 'section--blue' : 'section--white';

        // 2. Main Section Header
        $main_title = $row['industry_page_industry_feature_title'];
        $main_desc = $row['industry_page_industry_feature_description'];
?>
        <section class="feature-grid <?php echo esc_attr($section_class); ?>">
            <div class="container">

                <?php if ($main_title || $main_desc) : ?>
                    <div class="feature-grid__header">
                        <?php if ($main_title) : ?>
                            <h2 class="feature-grid__top-title"><?php echo esc_html($main_title); ?></h2>
                        <?php endif; ?>
                        <?php if ($main_desc) : ?>
                            <div class="feature-grid__top-desc"><?php echo wp_kses_post($main_desc); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php
                $sections = $row['industry_page_industry_feature_section'];
                if ($sections) :
                    foreach ($sections as $index => $sec) :
                        // 3. Alternating Logic: Odd indexes get 'row--reversed' (Image Left)
                        $layout_class = ($index % 2 === 0) ? 'row--reversed' : '';

                        $image = $sec['industry_page_industry_feature_section_image'];
                        $content_group = $sec['industry_page_industry_feature_section_content'];
                        $inner_points = $content_group['industry_page_industry_feature_section_inner'];
                ?>
                        <div class="feature-grid__wrapper row <?php echo esc_attr($layout_class); ?>">



                            <div class="feature-grid__image-box col-lg-6">
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image); ?>" alt="Feature Image">
                                <?php endif; ?>
                            </div>
                            <div class="feature-grid__content col-lg-6">
                                <h3 class="feature-grid__main-title">
                                    <?php echo esc_html($content_group['industry_page_industry_feature_section_main_title']); ?>
                                </h3>
                                <div class="feature-grid__main-desc">
                                    <?php echo apply_filters('the_content', $content_group['industry_page_industry_feature_section_main_description']); ?>
                                </div>
                                <?php if ($inner_points) : ?>
                                    <div class="feature-grid__points">
                                        <?php foreach ($inner_points as $point) : ?>
                                            <div class="feature-grid__point-item">
                                                <h4><?php echo esc_html($point['industry_page_industry_feature_section_inner_title']); ?></h4>
                                                <div><?php echo wp_kses_post($point['industry_page_industry_feature_section_inner_description']); ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </section>
<?php
    endforeach;
endif;
?>
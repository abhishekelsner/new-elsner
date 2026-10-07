 <?php
    $section_title = get_sub_field('title');
    $section_description = get_sub_field('description');
    $stats = get_sub_field('items');
    $features = get_sub_field('features_repeater');
    $why_choose_logo = get_sub_field('why_choose_logo');
    $show_logo = get_sub_field('show_wordpress_logo');
    if (!$section_title) return;
    ?>
    
    <section class="why-choose-section tmp-newservice-why-choose">
        <div class="container">
            <div class="section-header">
                <?php if ($section_title): ?>
                    <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($section_description): ?>
                    <p class="section-description"><?php echo esc_html($section_description); ?></p>
                <?php endif; ?>
            </div>

            <?php if ($stats): ?>
                <div class="stats-grid">
                    <?php foreach($stats as $stat): ?>
                        <div class="stat-card <?php echo esc_attr($stat['stat_color']); ?>">
                            <span class="stat-number"><?php echo esc_html($stat['number']); ?></span>
                            <span class="stat-label"><?php echo esc_html($stat['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
<div class="features-grid-wrapper">
    <div class="features-grid">
        <?php
        $count = 0;
        $total = count($features);
        $half = floor($total / 2);
        $logo_block = [
            'is_logo' => true,
            'logo_data' => $why_choose_logo
        ];

        // Insert logo block in the middle
        array_splice($features, $half, 0, [$logo_block]);

        foreach ($features as $index => $feature):

            // If it's a logo, close current row and output logo
            if (isset($feature['is_logo']) && $feature['is_logo'] && !empty($feature['logo_data'])) {
                // Close any open row
                if ($count % 2 !== 0) {
                    echo '</div>';
                }

                // Output logo
                echo '<div class="feature-item center-logo">';
                echo '<img src="' . esc_url($feature['logo_data']['url']) . '" alt="' . esc_attr($feature['logo_data']['alt'] ?? '') . '" class="why-choose-logo-img" />';
                echo '</div>';

                $count = 0; // reset counter
                continue;
            }

            // Open a new row
            if ($count % 2 === 0) {
                echo '<div class="feature-item">';
            }
            ?>

            <div class="feature-item-column">
                <div class="feature-item-content-block">
                    <h3 class="feature-title"><?php echo esc_html($feature['feature_title']); ?></h3>
                    <p class="feature-description"><?php echo esc_html($feature['feature_description']); ?></p>
                </div>
            </div>

            <?php
            $count++;

            // Close the row after 2 items
            if ($count % 2 === 0) {
                echo '</div>';
            }

        endforeach;

        // Close any open row not closed yet
        if ($count % 2 !== 0) {
            echo '</div>';
        }
        ?>
    </div>
</div>



        </div>
    </section>

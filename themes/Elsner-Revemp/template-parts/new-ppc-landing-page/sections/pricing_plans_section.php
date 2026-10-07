<?php
$section_title = get_sub_field('section_title');
$price_feture_heading = get_sub_field('price_feture_heading');
$pricing_plans = get_sub_field('pricing_plans'); // Repeater: plan_name, price, cta_button_link, duration (repeater: plans_text)
$features_list = get_sub_field('features_list'); // Repeater: feature_name
?>

<section class="pricing-table-wrapper">
    <div class="container">
        <div class="pricing-plans-container">
            <?php if ($section_title) : ?>
                <h2 class="pricing-plans-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
            <div class="plan-list-tabs-wrapper">
                <table class="best-plan active">
                    <thead>
                        <tr>
                        <th><?php echo $price_feture_heading; ?></th>
                            <?php if ($pricing_plans) : foreach ($pricing_plans as $plan) : ?>
                                    <th>
                                        <div class="best-plan-name">
                                            <div class="ppc-price-over-name">
                                                <span class="price-plan-name"><?php echo esc_html($plan['plan_name']); ?></span>
                                                <span class="price-timing"> <?php echo esc_html($plan['time']); ?></span>
                                            </div>
                                            <span class="price-tag"> <?php echo esc_html($plan['price']); ?></span> 
                                            <span class="price-button">
                                            <?php if (!empty($plan['cta_button_link'])) : ?>
                                            <p>
                                                <a href="<?php echo esc_url($plan['cta_button_link']['url']); ?>" target="<?php echo esc_attr($plan['cta_button_link']['target']); ?>">
                                                    <?php echo esc_html($plan['cta_button_link']['title']); ?>
                                                </a>
                                            </p>
                                            <?php endif; ?>
                                        </span>
                                        </div>
                                    </th>
                            <?php endforeach;
                            endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($features_list) : foreach ($features_list as $index => $feature) : ?>
                                <tr>
                                    <td><?php echo esc_html($feature['feature_name']); ?></td>

                                    <?php if ($pricing_plans) : foreach ($pricing_plans as $plan) : ?>
                                            <td>
                                                <?php
                                                // Duration is repeater field
                                                if (!empty($plan['duration'])) {
                                                    $duration_rows = $plan['duration'];
                                                    // Safely check if index exists
                                                    $duration_text = isset($duration_rows[$index]['plans_text']) ? $duration_rows[$index]['plans_text'] : '';
                                                    if (!empty($duration_text)) :
                                                        echo '<p> ' . esc_html($duration_text) . '</p>';
                                                    endif;
                                                }
                                                ?>
                                            </td>
                                    <?php endforeach;
                                    endif; ?>

                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


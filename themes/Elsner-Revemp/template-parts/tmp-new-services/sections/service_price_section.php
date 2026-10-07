<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$plans = get_sub_field('pricing_palns_block');
?>

<?php if ($plans): ?>
<section class="pricing-section tmp-pricing-section">
    <div class="tmp-pricing-section-bg-image">
        <img src="https://www.elsner.com/wp-content/uploads/2025/08/Section-1.png" alt="">
    </div>
    <div class="container">
        <div class="pricing-section-heading">
            <?php if ($title): ?>
            <h2 class="pricing-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
            <p class="pricing-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div>
        <div class="pricing-grid" id="price-package">
            <?php 
            $item_index = 0;
            foreach ($plans as $plan): 
                $item_index++;
                $plan_title   = $plan['plan_title'];
                $plan_price   = $plan['plan_price'];
                $plan_time    = $plan['plan_time'];
                $plan_details = $plan['plan_deatils'];
                $cta_link     = $plan['cta_link'];
            ?>
            <div class="pricing-card">
                <?php if ($item_index === 2): ?>
                    <div class="custom-div-one">Recommended</div>
                <?php endif; ?>
                <div class="pricing-card-inner-wrap">
                    <?php if ($item_index === 2): ?>
                    <div class="custom-div-two">Popular</div>
                    <?php endif; ?>

                    <?php if ($plan_title): ?>
                    <h3 class="plan-title"><?php echo esc_html($plan_title); ?></h3>
                    <?php endif; ?>

                    <div class="plan-price-time">
                        <?php if ($plan_price): ?>
                        <span class="plan-price"><?php echo esc_html($plan_price); ?></span>
                        <?php endif; ?>

                        <?php if ($plan_time): ?>
                        <span class="plan-time"><?php echo esc_html($plan_time); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if ($plan_details): ?>
                    <div class="plan-details"><?php echo $plan_details; ?></div>
                    <?php endif; ?>

                    <?php if ($cta_link): ?>
                    <a href="<?php echo esc_url($cta_link['url']); ?>" class="plan-cta-btn"
                        target="<?php echo esc_attr($cta_link['target']); ?>">
                        <?php echo esc_html($cta_link['title']); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
<?php endif; ?>


<?php
$team_title = get_field('team_title');
$team_logo = get_field('team_logo');
$dedicate_botton_title = get_field('dedicate_botton_title');
$dedicate_bottom_link = get_field('dedicate_bottom_link');


?>
<section class="dedicated-section padding-80">
    <div class="container">
        <div class="section-header">
            <div class="section-title">
                <h2><?php echo $team_title; ?></h2>

            </div>
            <?php if (!empty($team_logo)) : ?>
                <div class="section-logo">
                    <img src="<?php echo esc_url($team_logo); ?>" alt="Build Team Logo">
                </div>
            <?php endif; ?>
        </div>
        <?php
        $dedicated_boxes = get_field('dedicated_box');
        if (!empty($dedicated_boxes)) : ?>
            <div class="dedicated-main-wrapper">
                <div class="row">
                    <?php foreach ($dedicated_boxes as $box) :
                        $box_image = $box['box_image'];
                        $box_title = $box['box_title'];
                        $box_description = $box['box_description'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="dedicated-box">
                                <div class="dedicated-img">
                                    <?php if (!empty($box_image)) : ?>
                                        <img src="<?php echo esc_url($box_image['url']); ?>" alt="<?php echo esc_attr($box_image['alt']); ?>">
                                    <?php endif; ?>

                                </div>
                                <div class="dedicated-content-wrapper">
                                    <div class="dedicated-title">
                                        <h3><?php echo esc_html($box_title); ?></h3>
                                    </div>
                                    <?php if (!empty($box_description)) : ?>
                                        <ul>
                                            <?php echo wp_kses_post($box_description); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class  ="nav-migrate">
       
        <div class="nav-migrates-wrapper">
            <?php if (!empty($dedicate_botton_title)) : ?>
                <p class="why-choose-title"><?php echo wp_kses_post($dedicate_botton_title); ?></p>
            <?php endif; ?>
            <?php
            if ($dedicate_bottom_link) :
                $dedicate_bottom_link_url = esc_url($dedicate_bottom_link['url']);
                $dedicate_bottom_link_title = esc_html($dedicate_bottom_link['title']);
                $dedicate_bottom_link_target = !empty($dedicate_bottom_link['target']) ? ' target="' . esc_attr($why_choose_cta['target']) . '"' : '';

                echo '<a href="' . $dedicate_bottom_link_url . '" class="why-choose-cta"' . $dedicate_bottom_link_target . '>' . $dedicate_bottom_link_title . '</a>';
            endif; ?>
        </div>
  
    </div>
</section>
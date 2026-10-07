<?php
$why_choose_top_heading = get_field('why_choose_top_heading');
$why_choose_view_all_link = get_field('why_choose_view_all_link');
$why_choose_title = get_field('why_choose_title');
$why_choose_image = get_field('why_choose_image');
$why_choose_text = get_field('why_choose_text');
$why_choose_cta = get_field('why_choose_cta');
$why_choose_image = get_field('why_choose_image');
?>

<?php if ($why_choose_title || $why_choose_text || $why_choose_cta || $why_choose_top_heading) : ?>
    <section class="why-choose-section">
    <div class="nav-migrate">
                <div class="nav-migrates-wrapper">
                    <?php if (!empty($why_choose_top_heading)) : ?>
                        <p class="why-choose-title"><?php echo wp_kses_post($why_choose_top_heading); ?></p>
                    <?php endif; ?>
                    <?php
                    if ($why_choose_view_all_link) :
                        $why_choose_view_all_link_url = esc_url($why_choose_view_all_link['url']);
                        $why_choose_view_all_link_title = esc_html($why_choose_view_all_link['title']);
                        $why_choose_view_all_link_target = !empty($why_choose_view_all_link['target']) ? ' target="' . esc_attr($why_choose_cta['target']) . '"' : '';

                        echo '<a href="' . $why_choose_view_all_link_url . '" class=""' . $why_choose_view_all_link_target . '>' . $why_choose_view_all_link_title . '</a>';
                    endif; ?>
                </div>
            </div>
        <div class="why-choose-wrapper">
            <div class="container">

                <div class="row why-choose-inner-block-box">
                    <div class="col-12 col-md-4">
                        <?php if (!empty($why_choose_title)) : ?>
                            <h2 class="why-choose-title"><?php echo $why_choose_title; ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($why_choose_text)) : ?>
                            <p class="why-choose-desc"><?php echo wp_kses_post($why_choose_text); ?></p>
                        <?php endif; ?>
                        <?php
                        $why_choose_cta = get_field('why_choose_cta');

                        if ($why_choose_cta) :
                            $cta_url = esc_url($why_choose_cta['url']);
                            $cta_title = esc_html($why_choose_cta['title']);
                            $cta_target = !empty($why_choose_cta['target']) ? ' target="' . esc_attr($why_choose_cta['target']) . '"' : '';

                            echo '<a href="' . $cta_url . '" class="why-choose-cta btn btn-secondary"' . $cta_target . '>' . $cta_title . '</a>';
                        endif;
                        ?>
                    </div>
                    <div class="col-12 col-md-5">
                        <?php if (have_rows('why_choose_content_box')) : ?>
                            <ul class="why-choose-list">
                                <?php while (have_rows('why_choose_content_box')) : the_row();
                                    $item_number = get_sub_field('itme_number');
                                    $item_text = get_sub_field('itme_text');
                                ?>
                                    <li class="why-choose-item">
                                        <?php if (!empty($item_number)) : ?>
                                            <span class="item-number"><?php echo esc_html($item_number); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item_text)) : ?>
                                            <span class="item-text"><?php echo esc_html($item_text); ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-md-3">
                        <?php if ($why_choose_image) : ?>
                            <div class="why-choose-image">
                                <img src="<?php echo esc_url($why_choose_image); ?>" alt="Why Choose Image">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


            </div>
        </div>
    </section>
<?php endif; ?>



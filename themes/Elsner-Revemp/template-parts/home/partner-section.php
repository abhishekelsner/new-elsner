<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

?>
<section class="partner-section section section-padding " id="section6">
    <div class="inner-container">
        <div class="heading">
            <?php echo get_field('section_title_partner', $post_id); ?>
            <p><?php echo get_field('section_description_partner', $post_id); ?></p>
        </div>

        <div class="partner-slider slick-slider">
            <?php
            $partners = get_transient('partners_query');

            if (!$partners) {
                $partners = new WP_Query(array(
                    'post_type' => 'partner',
                    'posts_per_page' => 8,
                ));

                set_transient('partners_query', $partners_query, DAY_IN_SECONDS);
            }

            if ($partners->have_posts()) {
                $count = 0;
                while ($partners->have_posts()) {
                    $partners->the_post();
                    $partner_label = get_the_title();
                    $partner_image = get_the_post_thumbnail_url();
                    $partner_description = get_the_content();
                    $partner_label_color      = get_field('color', get_the_ID());
                    if (!$partner_label_color) {
                        $partner_label_color = '#4C8CCA';
                    }
                    if ($count % 2 === 0) {
                        echo '<div class="partner-column">';
                    }
            ?>

            <div class="partner-card">
                <div class="partner-label" style="background: <?php echo $partner_label_color; ?>">
                    <?php echo $partner_label; ?></div>
                <img class="lazy" src="<?php echo $partner_image; ?>" alt="partner logo" height="60" width="100%"
                    loading="lazy">
                <p><?php echo $partner_description; ?></p>
            </div>
            <?php
                    if ($count % 2 === 1) {
                        echo '</div>';
                    }

                    $count++;
                }
                if ($count % 2 === 1) {
                    echo '</div>';
                }

                wp_reset_postdata();
            }
            ?>
        </div>

    </div>
</section>
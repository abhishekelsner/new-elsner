<section class="new-case-study-solution">
    <div class="container">
        <?php if (have_rows('solution_block_box')) : ?>
            <section class="solution-section">
                <?php while (have_rows('solution_block_box')) : the_row(); ?>
                    <?php $heading = get_sub_field('heading'); ?>
                    <h2 class="solution-heading"><?php echo esc_html($heading); ?></h2>

                    <?php if (have_rows('solution_content_box')) : ?>
                        <div class="solution-grid">
                            <?php while (have_rows('solution_content_box')) : the_row(); ?>
                                <div class="solution-card">
                                    <?php $title = get_sub_field('title'); ?>
                                    <h3 class="solution-title"><?php echo esc_html($title); ?></h3>

                                    <?php if (have_rows('solution_description')) : ?>
                                        <ul class="solution-description">
                                            <?php while (have_rows('solution_description')) : the_row(); ?>
                                                <li><?php echo esc_html(get_sub_field('text')); ?></li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </section>
        <?php endif; ?>
    </div>
</section>
<section class="new-case-study-solution-screenshot">
    <div class="container">
        <?php if (have_rows('solution_image_with_title')) : ?>
            <section class="solution-slider-section">
                <div class="solution-slider">
                    <?php while (have_rows('solution_image_with_title')) : the_row();
                        $title = get_sub_field('title');
                        $image = get_sub_field('image'); ?>
                        <div class="solution-slide">
                            <?php if (!empty($title)) : ?>
                                <h4 class="solution-img-title"><?php echo esc_html($title); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="solution-img" />
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>
</section>

<section class="new-case-study-organizations">
    <div class="container">
        <?php
        $title = get_field('organizations_title');
        $text = get_field('organizations_text');
        $description = get_field('organizations_description');
        $image = get_field('organizations_image');
        ?>

        <?php if ($title || $text || $description || $image): ?>
            <section class="organizations-section">
                <div class="row">
                    <div class="col-sm-6">
                        <?php if (!empty($title)) : ?>
                            <h2 class="org-title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($text)) : ?>
                            <p class="org-subtitle"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <div class="org-description">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6">
                        <?php if (!empty($image)) : ?>
                            <div class="org-image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
</section>
<section class="new-case-study-review">
    <div class="container">
        <?php
        $review_heading = get_field('review_heading');
        $review_description = get_field('review_description');
        $review_text = get_field('review_text');
        $review_image = get_field('review_image');
        ?>
        <?php if ($review_heading || $review_description || $review_text || $review_image): ?>
            <div class="testimonial-box">
                <div class="testimonial-icon">“</div>
                <?php if (!empty($review_heading)) : ?>
                    <p class="testimonial-author"><?php echo esc_html($review_heading); ?></p>
                <?php endif; ?>
                <div class="testimonial-meta">
                    <?php if (!empty($review_image)) : ?>
                        <div class="testimonial-image">
                            <img src="<?php echo esc_url($review_image); ?>" alt="Reviewer">
                        </div>
                    <?php endif; ?>
                    <div class="testimonial-info">
                        <?php if (!empty($review_description)) : ?>
                            <p class="testimonial-role"><?php echo esc_html($review_description); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($review_text)) : ?>
                            <p class="testimonial-text"><?php echo esc_html($review_text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="testimonial-icon right">”</div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        $('.new-case-study-solution .solution-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>
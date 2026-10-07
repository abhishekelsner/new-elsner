
<?php
// Get main title and description
$title = get_sub_field('expertise_title');
$desc = get_sub_field('expertise_description');
$image = get_sub_field('expertise_image');

?>
<section class="expertise-section tmp-new-expertise-section">
    <div class="tmp-new-expertise-wrapper">
        <div class="container">
            <div class="expertise-header">
                <?php if ($image): ?>
                    <div class="expertise-image-wrapper">
                        <div class="expertise-image">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    </div>
                <?php endif; ?>
                <div class="expertise-content">
                    <?php if ($title): ?>
                        <h2 class="expertise-title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if ($desc): ?>
                        <p class="expertise-description"><?php echo $desc; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (have_rows('expertise_block_text')): ?>
                <div class="expertise-wrapper">
                    <div class="expertise-blocks">
                        <?php while (have_rows('expertise_block_text')): the_row(); ?>
                            <div class="expertise-block">
                                <div class="tmp-expertise-block-head">
                                    <h4 class="block-title"><?php the_sub_field('title'); ?></h4>
                                </div>
                                <div class="block-text-wrapper">
                                    <div class="block-text marquee-1"><?php the_sub_field('text'); ?></div>
                                    <div class="block-text marquee-2"><?php the_sub_field('text'); ?></div>
                                    <div class="block-text marquee-3"><?php the_sub_field('text'); ?></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>



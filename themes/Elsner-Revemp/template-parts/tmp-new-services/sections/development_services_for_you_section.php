<?php
// Get main title and description
$section_title = get_sub_field('title');
$section_desc = get_sub_field('description');
?>

<section class="services-section tmp-new-service-section">
    <div class="container">
        <?php if ($section_title): ?>
            <h2 class="services-title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if ($section_desc): ?>
            <p class="services-description"><?php echo esc_html($section_desc); ?></p>
        <?php endif; ?>

        <?php if (have_rows('services_item')): ?>
            <div class="services-items ">
                <?php while (have_rows('services_item')): the_row(); 
                    $icon = get_sub_field('icon');
                    $item_title = get_sub_field('title');
                    $text = get_sub_field('text');
                    $link = get_sub_field('link');
                ?>
                    <div class="service-box">
                        <div class="service-box-icon-text">
                            <?php if ($icon): ?>
                                <div class="service-icon">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                </div>
                            <?php endif; ?>

                            <?php if ($item_title): ?>
                                <h4 class="service-title"><?php echo esc_html($item_title); ?></h4>
                            <?php endif; ?>
                        </div>
                        <?php if ($text): ?>
                            <p class="service-text"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>

                        <?php if ($link): ?>
                            <a class="service-link" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
                                <?php echo esc_html($link['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

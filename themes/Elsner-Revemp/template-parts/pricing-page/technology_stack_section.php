<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$items = get_sub_field('stack_items');
?>
<section class="technology-grid-new-service-section">
    <div class="container">
        <?php if ($title): ?>
            <h2 class="icon-grid-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($description): ?>
            <p class="icon-grid-description"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
<?php if ($items): ?>
        <div class="icon-grid-boxed">
            <div class="icon-grid-wrapper">
                <?php foreach ($items as $item): 
                    $image = $item['image'];
                    if ($image): ?>
                        <div class="icon-grid-item">
                            <div class="icon-grid-icon">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php
// ACF Fields
$text              = get_sub_field('text');
$title             = get_sub_field('title');
$description       = get_sub_field('description');
$button            = get_sub_field('button');
$image             = get_sub_field('image');
$background_image  = get_sub_field('bcakgound_image');
$hilight_text      = get_sub_field('hilight_text');
?>

<section class="brand-section tmp-brand-section" style="background-image: url('<?php // echo esc_url($background_image['url']); ?>');">
    <div class="container">
        <div class="brand-wrapper">
            <div class="brand-left">
                <?php if ($text): ?>
                    <div class="brand-pill"><?php echo esc_html($text); ?></div>
                <?php endif; ?>

                <?php if ($title): ?>
                    <h2 class="brand-title"><?php echo wp_kses_post($title); ?></h2>
                <?php endif; ?>

                <?php if ($description): ?>
                    <p class="brand-description"><?php echo esc_html($description); ?></p>
                <?php endif; ?>

                <div class="brand-avatars">
                <?php if ($image): ?>
                    <div class="brand-right">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endif; ?>
                </div>

                <?php if ($button): ?>
                    <a class="brand-button" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target']); ?>">
                        <?php echo esc_html($button['title']); ?> →
                    </a>
                <?php endif; ?>
            </div>
            <div class="brand-image-right">
                    <img src="https://elsner-new.elsnerdev.com/wp-content/uploads/2025/08/6734f70094aa7b62e8c08b04_UI20Photo.avif.png" alt="image" >
            </div>
        </div>

        <?php if ($hilight_text): ?>
            <div class="brand-highlight-bar">
                <?php echo wp_kses_post($hilight_text); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

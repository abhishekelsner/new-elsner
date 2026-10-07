<?php
// Fetch the repeater field (returns an array if it has rows)
$left_right_content = get_field('left_right_content');
$title = get_field('title');


?>
<div class="certified-box">
    <div class="container">

        <div class="section-header">
            <h2><?php echo wp_kses_post($title); ?></h2>
        </div>
        <div class="certified-box-wrapper">

            <?php
            if ($left_right_content) :
                foreach ($left_right_content as $row) : ?>
                    <?php
                    // Retrieve values from each row
                    $title = $row['title'];
                    $sub_title = $row['sub_title'];
                    $description = $row['description'];
                    $button = $row['button'];
                    $image_url = $row['image']; // Direct URL from ACF

                    // Set default image if no ACF image is set

                    ?>
                    <div class="certified-box-item">
                        <div class="certified-image">
                            <div class="image-wrapper">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($sub_title); ?>">
                            </div>
                            <div class="certified-content">
                                <div class="certified-title">
                                    <h3><?php echo esc_html($sub_title); ?></h3>
                                </div>
                                <div class="rich-text">
                                    <?php echo wp_kses_post($description); ?>
                                </div>
                                <?php if ($button) : ?>
                                    <div class="btn-wraper">
                                        <a href="<?php echo esc_url($button['url']); ?>">
                                            <?php echo esc_html($button['title']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                            <path d="M7 17.5L17 7.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7 7.5H17V17.5" stroke="#202020" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </div>
</div>

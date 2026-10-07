<?php

/**
 * Trusted By Section Template
 * ACF Layout: trusted_by_section
 */

$section_title = get_sub_field("section_title");
$section_title2 = get_sub_field("section_title2");
$section_title3 = get_sub_field("section_title3");
$company_logos = get_sub_field("company_logos");
?>

<section class="new-ppc-trusted-by">
    <div class="container">
        <p class="new-ppc-trusted-by-title"><?php echo $section_title; ?> <span><?php echo $section_title2 ?></span><?php echo $section_title3 ?></p>
        <div class="new-ppc-trusted-by-cmp-logo">
            <?php if ($company_logos): ?>
                <?php foreach ($company_logos as $logo): ?>
                    <div class=" ">
                        <img src="<?php echo esc_url($logo["url"]); ?>"
                            alt="<?php echo esc_attr($logo["alt"]); ?>"
                            class="h-12 w-auto grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>


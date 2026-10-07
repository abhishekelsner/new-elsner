<?php
/**
 * Flexible Content Layout: Hire CTA Banner
 * File: template-parts/flexible/hire_cta_banner.php
 */

$heading  = get_sub_field('heading');
$subtext  = get_sub_field('subtext');
$btn_text = get_sub_field('btn_text');
$btn_link = get_sub_field('btn_link');
$bg_image = get_sub_field('bg_image');
?>

<style>
    
</style>

<section class="get-touch b2b-get-in-touch lp">
    <div class="container">

        <div class="row alinc">
            <div class="col-md-7">
                <?php if ($heading) : ?>
                    <h2 class="lp-hire-cta__heading"><?php echo wp_kses_post($heading); ?></h2>
                <?php endif; ?>
                <?php if ($subtext) : ?>
                    <p class="lp-hire-cta__subtext"><?php echo esc_html($subtext); ?></p>
                <?php endif; ?>
                <?php if ($btn_text && $btn_link) : ?>
                    <a href="<?php echo esc_url($btn_link['url']); ?>" class="btn btn-secondary" <?php echo $btn_link['target'] ? 'target="' . esc_attr($btn_link['target']) . '"' : ''; ?>>
                        <?php echo esc_html($btn_text); ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php if (!empty($bg_image)) : ?>
                <div class="col-md-5 b2b-cta-bg-image">
                    <div class="brew-gif">
                        <img src="<?php echo esc_url($bg_image['url']); ?>"
                        alt="<?php echo esc_attr($bg_image['alt']); ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

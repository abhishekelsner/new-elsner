<?php
/**
 * Flexible Content Layout: Hero With Form
 * File: template-parts/flexible/hero_with_form.php
 */

$heading_line1  = get_sub_field('heading_line1');
$heading_line2  = get_sub_field('heading_line2');
$heading_line3  = get_sub_field('heading_line3');
$subtext        = get_sub_field('subtext');
$trust_bullets  = get_sub_field('trust_bullets');
$client_section = get_sub_field('client_section');
$form_title     = get_sub_field('form_title');
$form_shortcode = get_sub_field('form_shortcode');
$form_btn_text  = get_sub_field('form_btn_text');
$form_note      = get_sub_field('form_note');
$background_image = get_sub_field('background');
?>



<style>
/* ══════════════════════════════════════════════════════
   Hero With Form — Full CSS
   Matches: Dark navy hero, orange accents, white form box,
   trust bullets, stats bar
   ══════════════════════════════════════════════════════ */
 
/* ── Container ───────────────────────────────────────── */
 
/* ── Hero Section ────────────────────────────────────── */

</style>

<section class="lp-hero" id="consultation-form" 
    <?php if ($background_image) : ?>
        style="background-image: url('<?php echo esc_url($background_image['url']); ?>');"
    <?php endif; ?>
>
    <div class="container">
        <div class="lp-hero__inner">
        <!-- Left: heading + subtext + bullets -->
        <div class="lp-hero__content">

            <?php if ($heading_line1 || $heading_line2 || $heading_line3) : ?>
                <h1 class="lp-hero__heading">
                    <?php if ($heading_line1) : ?>
                        <?php echo esc_html($heading_line1); ?>
                    <?php endif; ?>
                    <?php if ($heading_line2) : ?>
                        <span><?php echo esc_html($heading_line2); ?></span>
                    <?php endif; ?>
                    <?php if ($heading_line3) : ?>
                        <?php echo esc_html($heading_line3); ?>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtext) : ?>
                <p class="lp-hero__subtext"><?php echo esc_html($subtext); ?></p>
            <?php endif; ?>

            <?php if ($trust_bullets) : ?>
                <ul class="lp-hero__bullets">
                    <?php foreach ($trust_bullets as $item) : ?>
                        <li class="lp-hero__bullet"><?php echo esc_html($item['bullet_text']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Right: form box -->
        <div class="lp-hero__form-box">
            <?php if ($form_title) : ?>
                <h3 class="lp-hero__form-title"><?php echo esc_html($form_title); ?></h3>
            <?php endif; ?>

            <?php if ($form_shortcode) : ?>
                <?php echo do_shortcode($form_shortcode); ?>
            <?php endif; ?>

            <?php if ($form_note) : ?>
                <p class="lp-hero__form-note"><?php echo esc_html($form_note); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($client_section) : ?>
        <div class="lp-hero__clients">
            
                <?php foreach ($client_section as $item) : ?>
                    <div class="lp-hero__client">
                        <p class="number"><?php echo esc_html($item['number']); ?></p>
                        <p class="title"><?php echo esc_html($item['title']); ?></p>
                    </div>
                <?php endforeach; ?>
            
        </div>
    <?php endif; ?>
    </div>
</section>

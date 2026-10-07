<?php
/**
 * Flexible Content Layout: Client Logo Bar
 * File: template-parts/flexible/logo_bar.php
 */

$logos = get_sub_field('logos');

if (!$logos) return;
?>

<style>

</style>

<section class="lp-logo-bar">
    <div class="lp-logo-bar__track-wrap">
        <!-- Duplicate items for seamless infinite scroll -->
        <div class="lp-logo-bar__track">
            <?php
            // Render logos twice for seamless loop
            for ($i = 0; $i < 2; $i++) :
                foreach ($logos as $logo) :
                    if (empty($logo['logo_image'])) continue;
                    ?>
                    <div class="lp-logo-bar__logo">
                        <img src="<?php echo esc_url($logo['logo_image']['url']); ?>"
                             alt="<?php echo esc_attr($logo['alt_text'] ?: $logo['logo_image']['alt']); ?>">
                    </div>
                <?php endforeach;
            endfor;
            ?>
        </div>
    </div>
</section>

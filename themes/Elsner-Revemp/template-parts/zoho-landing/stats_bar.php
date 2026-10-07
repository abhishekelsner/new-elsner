<?php
/**
 * Flexible Content Layout: Stats Bar
 * File: template-parts/flexible/stats_bar.php
 */

$stats = get_sub_field('stats');

if (!$stats) return;
?>

<style>

</style>

<section class="lp-stats">
    <div class="lp-container">
        <div class="lp-stats__grid">
            <?php foreach ($stats as $stat) : ?>
                <div class="lp-stats__item">
                    <span class="lp-stats__number"><?php echo esc_html($stat['number']); ?></span>
                    <span class="lp-stats__label"><?php echo esc_html($stat['label']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

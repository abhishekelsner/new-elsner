<?php
/**
 * Flexible Content Layout: Services Grid
 * File: template-parts/flexible/services_grid.php
 */

$heading  = get_sub_field('heading');
$subtext  = get_sub_field('subtext');
$services = get_sub_field('services');

if (!$services) return;
?>

<style>

</style>

<section class="lp-services">
    <div class="lp-container container">

        <?php if ($heading || $subtext) : ?>
            <div class="lp-services__header">
                <?php if ($heading) : ?>
                    <h2 class="lp-services__heading"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                <?php if ($subtext) : ?>
                    <p class="lp-services__subtext"><?php echo esc_html($subtext); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="lp-services__grid">
            <?php foreach ($services as $service) : ?>
                <div class="lp-services__card">
                    <?php if (!empty($service['icon'])) : ?>
                        <div class="lp-services__icon">
                            <img src="<?php echo esc_url($service['icon']['url']); ?>"
                                 alt="<?php echo esc_attr($service['icon']['alt'] ?: $service['title']); ?>">
                        </div>
                    <?php endif; ?>
                    <?php if ($service['title']) : ?>
                        <h3 class="lp-services__card-title"><?php echo esc_html($service['title']); ?></h3>
                    <?php endif; ?>
                    <?php if ($service['description']) : ?>
                        <p class="lp-services__card-desc"><?php echo esc_html($service['description']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
/**
 * Flexible Content Layout: Case Studies
 * File: template-parts/flexible/case_studies.php
 */

$heading = get_sub_field('heading');
$cases   = get_sub_field('cases');

if (!$cases) return;
?>

<style>

</style>

<section class="lp-cases">
    <div class="lp-cases__header">
        <?php if ($heading) : ?>
            <h2 class="lp-cases__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
    </div>
    <div class="lp-cases__grid container">
    <?php foreach ($cases as $case) :

        $case_id = is_object($case) ? $case->ID : $case;

        $title   = get_the_title($case_id);
        $excerpt = get_the_excerpt($case_id);
        $link    = get_permalink($case_id);
        $image   = get_the_post_thumbnail_url($case_id, 'large');
    ?>
        <div class="lp-cases__card">

            <?php if ($image) : ?>
                <img class="lp-cases__card-img"
                     src="<?php echo esc_url($image); ?>"
                     alt="<?php echo esc_attr($title); ?>">
            <?php else : ?>
                <div class="lp-cases__card-img-placeholder"></div>
            <?php endif; ?>

            <div class="lp-cases__card-body">

                <h3 class="lp-cases__card-title">
                    <?php echo esc_html($title); ?>
                </h3>

                <p class="lp-cases__card-excerpt">
                    <?php echo esc_html(wp_trim_words($excerpt, 20)); ?>
                </p>

                <a href="<?php echo esc_url($link); ?>" class="lp-cases__card-link">
                    Learn More
                </a>
            </div>

        </div>
    <?php endforeach; ?>
</div>
</section>

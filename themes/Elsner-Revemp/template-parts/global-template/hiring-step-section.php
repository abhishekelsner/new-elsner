<?php
// Retrieve the post ID from the $args array
$post_id                = $args['post_id'];
$section_title          = get_field('heading_process', 'option');
$magento_subheading_process     = get_field('subheading_process', 'option');
$other_subheading_process     = get_field('other_subheading_process', 'option');
$current_url            = $_SERVER['REQUEST_URI'];
$parts                  = explode('-', $current_url);
$value                  = $parts[1];
$section_title = str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), $section_title);
$magento_subheading_process     = str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), $magento_subheading_process);
$other_subheading_process     = str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), $other_subheading_process);
?>
<section class="hiring-step-section padding-80 mt-80">
    <div class="container">
        <div class="hiring-step-wrapper">
            <div class="hiring-block">
                <div class="request-quoteHead first-hiring-block">
                    <h2 class="Redhat-font"><?php echo esc_html($section_title); ?></h2>
                    <p><?php echo esc_html(($value == 'magento') ? $magento_subheading_process : $other_subheading_process); ?>
                    </p>
                </div>
            </div>
            <?php if (have_rows('process', 'option')) : ?>
            <?php $row_count = 1; ?>
            <?php while (have_rows('process', 'option')) : the_row(); ?>
            <div class="hiring-block">
                <div class="hiring-block-inner">
                    <span class="step-count"><?php echo str_pad($row_count, 2, '0', STR_PAD_LEFT); ?></span>
                    <h4><?php the_sub_field('label'); ?></h4>
                    <p><?php echo esc_html(str_replace('%tech_name%', ($value == 'mern' ? strtoupper($value) : ucfirst($value)), get_sub_field('content'))); ?>
                    </p>
                </div>
            </div>
            <?php $row_count++; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

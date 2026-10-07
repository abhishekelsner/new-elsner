<?php
// Check if the fields exist
$title = get_sub_field('title');
$description = get_sub_field('description');
$projects = get_sub_field('projects');
?>

<section class="project-section tmp-project-section">
    <div class="container">
        <div class="project-section-heading">
            <?php if ($title): ?>
            <h2 class="project-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($description): ?>
            <p class="project-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div>
        <?php if (!empty($projects)): ?>
        <div class="projects-grid">
            <?php 
    $counter = 0;
    foreach ($projects as $post): 
        setup_postdata($post);
        $thumbnail = get_the_post_thumbnail_url($post->ID, 'full'); // You can change size
        $year = get_the_date('Y', $post->ID); // Get only the year
        
        // Start wrapper div every 2 items
        if ($counter % 2 == 0) {
            echo '<div class="project-wrapper">';
        }
    ?>
            <div class="project-item">
                <?php if ($thumbnail): ?>
                <div class="project-thumb">
                    <img src="<?php echo esc_url($thumbnail); ?>"
                        alt="<?php echo esc_attr(get_the_title($post->ID)); ?>">
                </div>
                <?php endif; ?>
                <div class="project-title">
                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                        <h5><?php echo esc_html(get_the_title($post->ID)); ?>
                            <span><?php echo esc_html($year); ?></span>
                        </h5>
                        <div class="project-excerpt"><?php the_excerpt(); ?></div>
                    </a>
                </div>
            </div>
            <?php 
        $counter++;
        
        // Close wrapper div every 2 items or at the end
        if ($counter % 2 == 0 || $counter == count($projects)) {
            echo '</div>'; // Close project-wrapper
        }
    ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
        <div class="secondary-cta-btn-wrapper">
            <?php 
    $cta_link = get_sub_field('cta_button'); 
      if ($cta_link): ?>
            <a href="<?php echo esc_url($cta_link['url']); ?>" target="<?php echo esc_attr($cta_link['target']); ?>"
                class="hero-cta">
                <?php echo esc_html($cta_link['title']); ?>
            </a>
            <?php endif; ?>

        </div>
    </div>
</section>
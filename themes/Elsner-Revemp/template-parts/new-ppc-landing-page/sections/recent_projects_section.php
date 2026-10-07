
<?php
/**
 * Recent Projects Section Template
 * ACF Layout: recent_projects_section
 */

$section_title = get_sub_field("section_title");
?>
<section class="new-ppc-landing-section-recent-projects">
    <div class="container">
        <?php if ($section_title): ?>
            <h2 class="new-ppc-recent-projects-heading">
                <?php echo $section_title; ?>
            </h2>
        <?php endif; ?>

        <?php
        $projects = get_sub_field('projects');
        if ($projects):
        ?>
            <div class="new-ppc-recent-projects">
                <?php foreach ($projects as $post): ?>
                    <?php setup_postdata($post); ?>
                    <div class="new-ppc-recent-projects-feature-block">
                            <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-auto rounded']); ?>
                                    </a>
                            <?php endif; ?>
                            <div class="new-ppc-recent-projects-details-wrapper">
                            <h3 class="new-ppc-recent-projects-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="new-ppc-recent-projects-content">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>







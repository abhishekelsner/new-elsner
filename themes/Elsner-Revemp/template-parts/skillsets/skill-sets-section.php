<?php
$post_id = $args['post_id'];
?>

<section class="elsner-life-events skill-sets">
    <div class="container">
        <?php if (have_rows('skills', $post_id)) : ?>
            <?php while (have_rows('skills', $post_id)) : the_row(); ?>
                <?php $skills = get_field_object('skills'); ?>
                <?php if ($skills && isset($skills['sub_fields'])) : ?>
                    <?php foreach ($skills['sub_fields'] as $repeaters) : ?>
                        <?php if ($repeaters['type'] === 'repeater') : ?>
                            <div class="skill-technology">
                                <div class="skill-head">
                                    <h4 class="Redhat-font"><?php echo $repeaters['label']; ?></h4>
                                </div>
                                <div class="row">
                                    <?php while (have_rows($repeaters['name'])) : the_row();
                                        $link = get_sub_field('link'); ?>

                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <?php if ($link): ?>
                                                <a href="<?php echo esc_url($link); ?>" class="tech-links">
                                                <?php endif; ?>

                                                <div class="technologies">
                                                    <img src="<?php the_sub_field('images'); ?>" alt="<?php the_sub_field('image_alt'); ?>" width="135" height="135" loading="lazy">
                                                    <h5><?php the_sub_field('title'); ?></h5>
                                                </div>

                                                <?php if ($link): ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
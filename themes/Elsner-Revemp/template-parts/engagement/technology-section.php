<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>
<section class="technology-engagement padding-80">
    <div class="container">
        <div class="heading-wrapper">
            <h2>Technologies we work with</h2>
        </div>
        <div class="technology-tab">
            <ul class="nav nav-tabs">
                <?php if (have_rows('technologies', $post_id)) : ?>
                    <?php $tab = 1; ?>
                    <?php while (have_rows('technologies', $post_id)) : the_row(); ?>
                        <?php $models_type = get_field_object('technologies'); ?>
                        <?php if ($models_type && isset($models_type['sub_fields'])) : ?>
                            <?php foreach ($models_type['sub_fields'] as $repeaters) : ?>
                                <?php if ($repeaters['type'] === 'tab') : ?>
                                    <li>
                                        <?php
                                        $href = $repeaters['label'];
                                        $tab_id = strtolower(str_replace(' ', '-', $href));
                                        $active_class = ($tab == 1) ? 'active' : '';
                                        ?>
                                        <a class="nav-link <?php echo $active_class; ?>" data-toggle="pill" href="#<?php echo $tab_id; ?>">
                                            <?php echo $repeaters['label']; ?>
                                        </a>
                                    </li>
                <?php $tab++;
                                endif;
                            endforeach;
                        endif;
                    endwhile;
                endif;
                ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <?php if (have_rows('technologies', $post_id)) : ?>
                    <?php $tab = 1; ?>
                    <?php while (have_rows('technologies', $post_id)) : the_row(); ?>
                        <?php $technologies = get_field_object('technologies'); ?>
                        <?php if ($technologies && isset($technologies['sub_fields'])) : ?>
                            <?php foreach ($technologies['sub_fields'] as $repeaters) : ?>
                                <?php if ($repeaters['type'] === 'tab') : ?>
                                    <?php
                                    $href = $repeaters['label'];
                                    $tab_id = strtolower(str_replace(' ', '-', $href));
                                    $active_class = ($tab == 1) ? 'active' : '';
                                    ?>

                                    <div class="tab-pane <?php echo $active_class; ?>" id="<?php echo $tab_id; ?>">
                                        <div class="tech-data-tab">
                                            <ul>
                                                <?php
                                                $repeater_field_name = 'technology_' . $tab_id;
                                                if ($repeater_field_name == 'technology_mobile') {
                                                    $repeater_field_name = 'technology';
                                                } elseif ($repeater_field_name == 'technology_front-end') {
                                                    $repeater_field_name = 'technology_frontend';
                                                } elseif ($repeater_field_name == 'technology_infra-and-devops') {
                                                    $repeater_field_name = 'technology_devops';
                                                }
                                                if (have_rows($repeater_field_name, $post_id)) :
                                                    while (have_rows($repeater_field_name, $post_id)) : the_row();
                                                ?>
                                                        <li>
                                                            <img  src="<?php echo get_sub_field('image'); ?>" alt="image" height="90" loading="lazy" />
                                                            <p><?php echo get_sub_field('title'); ?></p>
                                                        </li>
                                                <?php
                                                    endwhile;
                                                endif;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php $tab++; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
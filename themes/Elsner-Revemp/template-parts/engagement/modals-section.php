<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
?>
<section class="engagement-modals">
    <div class="container">
        <div class="engagement-tabs">
            <ul class="nav nav-pills">
                <?php if (have_rows('models_type', $post_id)) : ?>
                    <?php $tab = 1; ?>
                    <?php while (have_rows('models_type', $post_id)) : the_row(); ?>
                        <?php $models_type = get_field_object('models_type'); ?>
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
                                            <h5><?php echo $repeaters['label']; ?></h5>
                                            <?php
                                            if ($tab == 1) {
                                                echo '<p>' . get_sub_field('tab_subheading') . '</p>';
                                            } elseif ($tab == 2) {
                                                echo '<p>' . get_sub_field('tab_subheading_fix_scope') . '</p>';
                                            } elseif ($tab == 3) {
                                                echo '<p>' . get_sub_field('tab_subheading_dedicated') . '</p>';
                                            }
                                            ?>
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
                <?php if (have_rows('models_type', $post_id)) : ?>
                    <?php $tab = 1; ?>
                    <?php while (have_rows('models_type', $post_id)) : the_row(); ?>
                        <?php $models_type = get_field_object('models_type'); ?>
                        <?php if ($models_type && isset($models_type['sub_fields'])) : ?>
                            <?php foreach ($models_type['sub_fields'] as $repeaters) : ?>
                                <?php if ($repeaters['type'] === 'tab') : ?>
                                    <?php
                                    $href = $repeaters['label'];
                                    $tab_id = strtolower(str_replace(' ', '-', $href));
                                    $active_class = ($tab == 1) ? 'active' : '';
                                    ?>
                                    <div class="tab-pane <?php echo $active_class; ?>" id="<?php echo $tab_id; ?>">
                                        <div class="engagement-content padding-80">
                                            <div class="emgamenent-modal-usage">
                                                <h2 class="Redhat-font"><?php echo get_sub_field('tab_heading' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : ''))); ?></h2>
                                                <p><?php echo get_sub_field('usage_content' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : ''))); ?></p>
                                            </div>
                                            <div class="emgamenent-modal-usage">
                                                <h4 class="Redhat-font"><?php echo get_sub_field('why_use_label' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : ''))); ?></h4>
                                                <ul class="check_ul">
                                                    <?php if (have_rows('why_use_content' . ($tab == 2 ? '_copy_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) :
                                                        while (have_rows('why_use_content' . ($tab == 2 ? '_copy_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) : the_row();
                                                            echo '<li>' . get_sub_field('benefits') . '</li>';
                                                        endwhile;
                                                    endif;
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="why-steps-block">
                                                <div class="row">
                                                    <?php if (have_rows('steps_block' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) :
                                                        while (have_rows('steps_block' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) : the_row();
                                                    ?>
                                                            <div class="col">
                                                                <div class="why-steps">
                                                                    <img  src="<?php echo get_sub_field('image'); ?>" alt="image" width="24" height="24" loading="lazy">
                                                                    <p><?php echo get_sub_field('title'); ?></p>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        endwhile;
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="engagement-pros-cons padding-80 blue-section">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="pros-cons">
                                                                <h5 class="Redhat-font">Pros</h5>
                                                                <ul>
                                                                    <?php if (have_rows('cons' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) :
                                                                        while (have_rows('cons' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) : the_row();
                                                                            echo '<li>' . get_sub_field('text') . '</li>';
                                                                        endwhile;
                                                                    endif;
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="pros-cons ml-auto">
                                                                <h5 class="Redhat-font">Cons</h5>
                                                                <ul>
                                                                    <?php if (have_rows('pros' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) :
                                                                        while (have_rows('pros' . ($tab == 2 ? '_fix_scope' : ($tab == 3 ? '_dedicated' : '')))) : the_row();
                                                                            echo '<li>' . get_sub_field('text') . '</li>';
                                                                        endwhile;
                                                                    endif;
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                <?php $tab++;
                                endif;
                            endforeach;
                        endif;
                    endwhile;
                endif;
                ?>
            </div>

        </div>
    </div>

</section>
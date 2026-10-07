<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$field_group_key = 'group_6461b87989ca9';
$field_group = acf_get_field_group($field_group_key);
?>
<section class="business-modal section section-padding blue-section" id="section5">
    <div class="inner-container">
        <div class="business-tabs">
            <div class="heading white">
                <?php echo get_field('section_title_buisness', $post_id); ?>
            </div>
            <div class="business-modals">
                <ul class="nav nav-tabs businesstab">
                    <?php if (have_rows('models')) : ?>
                    <?php while (have_rows('models')) : the_row();
                            $href = str_replace(' ', '', get_sub_field('text'));
                            $active_class = $first_field ? ' active' : '';
                        ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active_class; ?>" data-toggle="tab"
                            href="#<?php echo $href; ?>"><?php the_sub_field('text'); ?></a>
                    </li>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <?php if (have_rows('models')) : ?>
                    <?php while (have_rows('models')) : the_row();
                            $href = str_replace(' ', '', get_sub_field('text'));
                            $active_class = $first_field ? ' active' : ''; ?>
                    <div id="<?php echo  $href; ?>" class="tab-pane buisness<?php echo $active_class; ?>">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-4">
                                <div class="business-animation">
                                    <img src="<?php echo get_sub_field('lottie'); ?>"
                                        background="transparent" speed="1" loop autoplay alt="<?php echo get_sub_field('text'); ?>"/>
                                    <!-- <dotlottie-player src="<?php //echo get_sub_field('lottie'); ?>"
                                        background="transparent" speed="1" loop autoplay></dotlottie-player> -->
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-8 col-md-8">
                                <div class="business-text">
                                    <h3><?php the_sub_field('text'); ?></h3>
                                    <p><?php the_sub_field('content'); ?></p>
                                    <a href="<?php the_sub_field('button'); ?>" class="btn btn-primary">GET QUOTE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="business-logos">
            <div class="heading white">
                <h3>Our <span>Certificates and Accolades</span></h3>
            </div>
            <div class="business-slider slick-slider">
                <?php if (have_rows('partners_logo', 'option')) : ?>
                <?php while (have_rows('partners_logo', 'option')) : the_row(); ?>
                <div class="business-img">
                    <picture>
                        <img src="<?php the_sub_field('logo_1', 'option'); ?>" alt="business image" width="160"
                            height="50" loading="lazy">
                    </picture>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
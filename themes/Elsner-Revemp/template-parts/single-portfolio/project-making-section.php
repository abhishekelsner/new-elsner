<section class="project-making-section padding-80">
    <div class="container">
        <div class="project-make-wrapper">
            <div class="heading-wrapper max-700">
                <h2><?php echo esc_html('Making of'); ?></h2>
                <p><?php echo get_field('making_of', get_the_ID()); ?></p>
            </div>
            <div class="making-steps-block">
                <div class="row">
                    <?php
                    $making_steps = get_field('making-steps', get_the_ID());
                    if (have_rows('making-steps', get_the_ID())) :
                        while (have_rows('making-steps', get_the_ID())) : the_row();
                    ?>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img src="<?php echo get_sub_field('image', get_the_ID()); ?>" width="24" height="24"
                                alt="steps icon" loading="lazy">
                            <h6 class="Redhat-font"><?php echo get_sub_field('title', get_the_ID()); ?></h6>
                        </div>
                    </div>
                    <?php
                        endwhile;
                    else :
                        ?>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/compass.svg"
                                width="24" height="24" alt="steps icon" loading="lazy">
                            <h6 class="Redhat-font">Discovery Workshop</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img width="24" height="24" alt="steps icon"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/projectm.svg"
                                loading="lazy">
                            <h6 class="Redhat-font">Project Management</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img width="24" height="24" alt="steps icon"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/projectdes.svg"
                                loading="lazy">
                            <h6 class="Redhat-font">Project Design</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img width="24" height="24" alt="steps icon"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/projectd.svg"
                                loading="lazy">
                            <h6 class="Redhat-font">Project Development</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img width="24" height="24" alt="steps icon"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/beta.svg"
                                loading="lazy">
                            <h6 class="Redhat-font">Beta Testing</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="making-steps">
                            <img width="24" height="24" alt="steps icon"
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/qulity.svg"
                                loading="lazy">
                            <h6 class="Redhat-font">Quality Assurance</h6>
                        </div>
                    </div>
                    <?php
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
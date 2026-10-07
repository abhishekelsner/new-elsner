<section class="project-team-section padding-80">
    <div class="container">
        <div class="width-900">
            <div class="heading-wrapper">
                <h2>Team who served</h2>
                <p><?php echo get_field('team_content', get_the_ID()); ?></p>
            </div>
            <div class="team-served">
                <div class="row">
                    <?php
                    $making_steps = get_field('making-steps', get_the_ID());
                    if (have_rows('team_served', get_the_ID())) :
                        while (have_rows('team_served', get_the_ID())) : the_row();
                    ?>
                            <div class="col-md-4 col-sm-6 col-6">
                                <div class="team-dept-block">
                                    <img  src="<?php echo get_sub_field('image', get_the_ID()); ?>" alt="user" height="50" width="95" loading="lazy">
                                    <h5><?php echo get_sub_field('role', get_the_ID()); ?></h5>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    else :
                        ?>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/one-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>Project Manager</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/one-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>Business Analyst</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/one-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>Designer</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/one-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>QA Engineer</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/many-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>Backend Developers</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <div class="team-dept-block">
                                <img  src="<?php echo get_template_directory_uri(); ?>/assets/images/single-work/many-profile.svg" alt="user" height="50" width="95" loading="lazy">
                                <h5>Frontend Developers</h5>
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
<?php
$post_id            = $args['post_id'];
$banner_heading     = get_field('banner_heading', $post_id);
$banner_subheading  = get_field('banner_sub_heading', $post_id);
$banner_content     = get_field('banner_content', $post_id);
$team_member_detail = get_field('team_member_detail', $post_id);
?>

<section class="team-menber">
    <div class="container">
        <div class="team-member-block">

            <?php
            /* ─────────────────────────────────────────────
             *  SECTION 1 — CEO / Featured Member Detail
             *  Shown only when "Team Member Detail" toggle is ON
             * ───────────────────────────────────────────── */
            if ($team_member_detail) :
                $info        = get_field('team_member_designation_with_info', $post_id);
                $image       = $info['image'];       // array (url, alt, width, height)
                $name        = $info['name'];
                $designation = $info['designation'];
                $quote       = $info['quote'];
                $detail_div  = $info['detail_div'];  // extra text/HTML block
                $stats       = $info['detail'];      // repeater → number + text
                $socials     = $info['social_media']; // repeater → image + link
            ?>
            <?php endif; // end team_member_detail ?>


            <?php $i = 0; ?>
            <?php while (have_rows('team_members_designation', $post_id)) : the_row(); ?>

                <div class="col-lg-12 col-md-12 col-sm-12">

                <!-- Role Heading -->
                <?php if ($role = get_sub_field('team_members_role')) : ?>
                    <h3 class="team-members-role"><?php echo esc_html($role); ?></h3>
                <?php endif; ?>

                    <?php if ($i === 0 && $team_member_detail) : ?>
                        <!-- CEO Detail Block (first group only) -->
                        <div class="ceo-detail-section">
                            <div class="row detail-wrapper align-items-center">

                                <div class="image">
                                    <?php if (!empty($image)) : ?>
                                        <div class="ceo-image-wrap">
                                            <img
                                                src="<?php echo esc_url($image['url']); ?>"
                                                alt="<?php echo esc_attr($image['alt'] ?: $name); ?>"
                                                width="<?php echo esc_attr($image['width']); ?>"
                                                height="<?php echo esc_attr($image['height']); ?>"
                                                loading="lazy"
                                            >
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="content">
                                    <div class="ceo-info">

                                        <?php if (!empty($name)) : ?>
                                            <h2 class="ceo-name"><?php echo esc_html($name); ?></h2>
                                        <?php endif; ?>

                                        <?php if (!empty($designation)) : ?>
                                            <p class="ceo-designation"><?php echo esc_html($designation); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($quote)) : ?>
                                            <blockquote class="ceo-quote">
                                                <?php echo esc_html($quote); ?>
                                            </blockquote>
                                        <?php endif; ?>

                                        <?php if (!empty($detail_div)) : ?>
                                            <div class="ceo-detail-text">
                                                <?php echo wp_kses_post($detail_div); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($stats)) : ?>
                                            <div class="ceo-stats">
                                                <?php foreach ($stats as $stat) : ?>
                                                    <div class="ceo-stat-item">
                                                        <span class="ceo-stat-number">
                                                            <?php echo esc_html($stat['number']); ?>
                                                        </span>
                                                        <span class="ceo-stat-text">
                                                            <?php echo esc_html($stat['text']); ?>
                                                        </span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($socials)) : ?>
                                            <div class="ceo-social-links">
                                                <?php foreach ($socials as $social) :
                                                    $icon = $social['image'];
                                                    $link = $social['link'];
                                                    $is_link    = $social['check_gmail']  ?? false;
                                                    $gmail_text = $social['gmail']        ?? '';
                                                    if (empty($icon)) continue;
                                                ?>
                                                    
                                                    <?php if ($is_link && !empty($gmail_text)) : ?>
                                                    <!-- Email / plain text -->
                                                    
                                                    <a    href="mailto:<?php echo esc_attr($gmail_text); ?>"
                                                        rel="noopener noreferrer"
                                                        class="ceo-social-link"
                                                        aria-label="<?php echo esc_attr($icon['alt']); ?>"
                                                    >
                                                        <img
                                                            src="<?php echo esc_url($icon['url']); ?>"
                                                            alt="<?php echo esc_attr($icon['alt']); ?>"
                                                            width="24"
                                                            height="24"
                                                            loading="lazy"
                                                        >
                                                    </a>

                                                    <?php elseif (!empty($link)) : ?>
                                                        <!-- Normal social link -->
                                                        
                                                        <a    href="<?php echo esc_url($link['url']); ?>"
                                                            target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
                                                            rel="noopener noreferrer"
                                                            class="ceo-social-link"
                                                            aria-label="<?php echo esc_attr($link['title'] ?: $icon['alt']); ?>"
                                                        >
                                                            <img
                                                                src="<?php echo esc_url($icon['url']); ?>"
                                                                alt="<?php echo esc_attr($icon['alt']); ?>"
                                                                width="24"
                                                                height="24"
                                                                loading="lazy"
                                                            >
                                                        </a>

                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>

                                    </div><!-- /.ceo-info -->
                                </div>

                            </div><!-- /.row -->
                        </div><!-- /.ceo-detail-section -->
                    <?php endif; ?>

                    <!-- Members Grid -->
                    <div class="row">
                        <?php if (have_rows('team_members')) : ?>
                            <?php while (have_rows('team_members')) : the_row(); ?>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                    <div class="team-member">
                                        <div class="team-member-image">
                                            <img
                                                src="<?php echo esc_url(get_sub_field('member_image')); ?>"
                                                alt="<?php echo esc_attr(get_sub_field('member_name')); ?>"
                                                width="450"
                                                height="550"
                                                loading="lazy"
                                            >
                                        </div>
                                        <div class="team-member-content">
                                            <h4 class="Redhat-font">
                                                <?php echo esc_html(get_sub_field('member_name')); ?>
                                            </h4>
                                            <p>
                                                <?php echo esc_html(get_sub_field('member_designation')); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div><!-- /.row -->

                </div>

            <?php
                $i++;
            endwhile;
            ?>

        </div><!-- /.team-member-block -->
    </div><!-- /.container -->
</section>
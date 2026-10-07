<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$industries = get_sub_field('industries');
?>
<section class="industries-served-section section section-padding">
    <div class="container">
        <?php if ($title) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>

        <?php if ($industries) : ?>
            <div class="industries-wrapper">
                <div class="industries-grid">
                    <?php foreach ($industries as $industry) :
                        $industry_name = $industry['industry_name'];
                        $logos = $industry['logos'];
                        $industry_link = $industry['industry_link'];
                    ?>
                        <div class="industry-item">

                            <?php if ($logos) : ?>
                                <div class="industry-logos">
                                    <div class="row">
                                        <div class="col-lg-3  col-sm-3">
                                            <?php if ($industry_name) : ?>
                                                <h3 class="industry-name">
                                                    <a href="<?php echo esc_url($industry_link); ?>">
                                                        <?php echo esc_html($industry_name); ?>
                                                    </a>
                                                </h3>
                                            <?php endif; ?>
                                        </div>
                                        <?php foreach ($logos as $logo_item) :
                                            $logo = $logo_item['logo'];
                                            if ($logo) :
                                                $logo_url = is_array($logo) ? $logo['url'] : $logo;
                                                $logo_alt = is_array($logo) ? $logo['alt'] : $industry_name . ' Logo';
                                        ?>
                                                <div class="col-lg-3  col-sm-3">
                                                    <div class="industry-logo-item">
                                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>" loading="lazy">
                                                    </div>
                                                </div>
                                        <?php
                                            endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
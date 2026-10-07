<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$partners = get_sub_field('partners');

?>
<section class="technology-partners-section section section-padding">
    <div class="container">
        <?php if ($title) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>
        
        <?php if ($partners) : ?>
            <div class="partners-wrapper">
                <div class="row">
                    <?php foreach ($partners as $partner) : 
                        $logo = $partner['logo'];
                        $partner_title = $partner['title'];
                        $short_description = $partner['short_description'];
                        
                        $logo_url = '';
                        if ($logo) {
                            $logo_url = is_array($logo) ? $logo['url'] : $logo;
                        }
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="partner-item ">
                                <?php if ($logo_url) : ?>
                                    <div class="partner-logo">
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($partner_title); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <?php if ($partner_title) : ?>
                                    <h3><?php echo esc_html($partner_title); ?></h3>
                                <?php endif; ?>
                                <?php if ($short_description) : ?>
                                    <p><?php echo esc_html($short_description); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
     

 
    </div>
</section>


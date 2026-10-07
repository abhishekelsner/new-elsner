<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$partners = get_sub_field('partners');
   $heading = get_sub_field('tech_stack_heading');
?>
<section class="technology-partners-section section section-padding">
    <div class="container">
        <?php if ($heading) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($heading); ?></h2>
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
     

    <section class="tech-stack-section">

        <?php if ( $heading ) : ?>
            <h2 class="tech-stack-heading">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if ( have_rows('tech_stack_logos') ) : ?>
            <div class="tech-stack-logos">
                <?php while ( have_rows('tech_stack_logos') ) : the_row(); ?>

                    <?php
                    $image = get_sub_field('image');
                    if ( $image ) :
                    ?>
                        <div class="tech-stack-logo">
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>">
                        </div>
                    <?php endif; ?>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </section>

    </div>
</section>


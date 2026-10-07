<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$media_logos = get_sub_field('media_logos');
?>
<section class="featured-in-section section section-padding">
  <div class="block-title text-center">
            <h2>Featured In</h2>
  </div>
    <div class="container">
        <?php if ($media_logos) : ?>
            <div class="featured-logos-wrapper">
                <div class="row">
                    <?php foreach ($media_logos as $logo_item) : 
                        $logo = $logo_item['logo'];
                        if ($logo) :
                            $logo_url = is_array($logo) ? $logo['url'] : $logo;
                            $logo_alt = is_array($logo) ? $logo['alt'] : 'Media Logo';
                    ?>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <div class="featured-logo-item">
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
</section>


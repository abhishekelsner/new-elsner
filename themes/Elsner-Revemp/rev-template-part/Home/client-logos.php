<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$client_logos = get_sub_field('client_logo');
?>
<section class="client-logos-section section section-padding">
    <div class="container">
        <div class="client-logos-section-wrapper row">

            <?php if ($title) : ?>
                <div class="block-title col-md-4  ">
                    <h2><?php echo esc_html($title); ?></h2>
                </div>
            <?php endif; ?>
            <div class="client-logos-section col-md-8 ">

                <?php if ($client_logos) : ?>
                    <div class="client-logos-wrapper">
                        <?php foreach ($client_logos as $logo_item) : 
                            $logo_image = $logo_item['logo_image'];
                            if ($logo_image) :
                                $logo_url = is_array($logo_image) ? $logo_image['url'] : $logo_image;
                                $logo_alt = is_array($logo_image) ? $logo_image['alt'] : 'Client Logo';
                        ?>
                            <div class="client-logo-item">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>" loading="lazy">
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


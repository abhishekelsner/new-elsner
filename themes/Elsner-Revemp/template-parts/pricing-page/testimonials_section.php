<?php
$section_title = get_sub_field('title');
$section_description = get_sub_field('description');
$testimonial_posts = get_sub_field('testimonials');
?>

<section class="testimonial-section tmp-newservice-testimonial">
    <div class="container">
        <div class="tmp-newservice-testimonial-heading-details">
            <?php if ($section_title): ?>
                <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <?php if ($section_description): ?>
                <p class="section-description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($testimonial_posts): ?>
        <?php
        $half = ceil(count($testimonial_posts) / 2);
        $row1 = array_slice($testimonial_posts, 0, $half);
        $row2 = array_slice($testimonial_posts, $half);
        ?>

        <div class="testimonial-slider-container">
            <!-- Row 1 -->
            <div class="testimonial-row row-1">
                <div class="slider-track">
                    <?php foreach ($row1 as $post): setup_postdata($post); ?>
                        <?php
                        $author = get_field('testimonial_author');
                        $designation = get_field('testimonial_designation');
                        $client_photo = get_field('client_photo');
                        ?>
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <div class="testimonial-client-details">
                                    <?php if ($client_photo): ?>
                                        <div class="client-photo">
                                            <img src="<?php echo esc_url($client_photo['url']); ?>"
                                            alt="<?php echo esc_attr($client_photo['alt']); ?>">
                                        </div>
                                    <?php endif; ?>
                                
                                <div class="testimonial-author-details">
                                    <h4 class="testimonial-name"><?php the_title(); ?></h4>
                                    <?php if ($author): ?>
                                        <p class="testimonial-author"><?php echo esc_html($author); ?></p>
                                    <?php endif; ?>
                                    <?php if ($designation): ?>
                                        <p class="testimonial-designation"><?php echo esc_html($designation); ?></p>
                                    <?php endif; ?>
                                </div>
                                </div>
                                <div class="testimonial-stars">★★★★★</div>
                            </div>
                            <div class="testimonial-content"><?php the_content(); ?></div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="testimonial-row row-2">
                <div class="slider-track">
                    <?php foreach ($row2 as $post): setup_postdata($post); ?>
                        <?php
                        $author = get_field('testimonial_author');
                        $designation = get_field('testimonial_designation');
                        $client_photo = get_field('client_photo');
                        ?>
                        <div class="testimonial-card">
                            
                            <div class="testimonial-header">
                                <div class="testimonial-client-details">
                                    <?php if ($client_photo): ?>
                                        <div class="client-photo">
                                            <img src="<?php echo esc_url($client_photo['url']); ?>"
                                                alt="<?php echo esc_attr($client_photo['alt']); ?>">
                                        </div>
                                    <?php endif; ?>
                                
                                <div class="testimonial-author-details">
                                    <h4 class="testimonial-name"><?php the_title(); ?></h4>
                                    <?php if ($author): ?>
                                        <p class="testimonial-author"><?php echo esc_html($author); ?></p>
                                    <?php endif; ?>
                                    <?php if ($designation): ?>
                                        <p class="testimonial-designation"><?php echo esc_html($designation); ?></p>
                                    <?php endif; ?>
                                </div>
                                </div>
                                <div class="testimonial-stars">★★★★★</div>
                            </div>
                            <div class="testimonial-content"><?php the_content(); ?></div>
                        </div>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
     <div class="secondary-cta-btn-wrapper">
           <?php 
    $cta_link = get_sub_field('cta_button'); 
      if ($cta_link): ?>
            <a href="<?php echo esc_url($cta_link['url']); ?>" target="<?php echo esc_attr($cta_link['target']); ?>" class="hero-cta">
                <?php echo esc_html($cta_link['title']); ?>
            </a>
    <?php endif; ?>

        </div>
</section>

<style>
.secondary-cta-btn-wrapper {
    text-align: center;
    margin-top: 60px;
}
.secondary-cta-btn-wrapper a.cta-button {
    background: linear-gradient(180deg, #002840 25%, #002840 100%);
    color: #fff;
    padding: 15px 30px;
    border-radius: 96px;
}
</style>



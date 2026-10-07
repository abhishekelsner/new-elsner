<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];

$title = get_sub_field('title');
$selected_case_study = get_sub_field('selected_case_study');
$button = get_sub_field('button');
$button_url = get_sub_field('button_url');
?>
<section class="success-stories-section section section-padding">
    <div class="container">
        <?php if ($title) : ?>
            <div class="block-title text-center">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>
        
        <?php if ($selected_case_study) : ?>
            <div class="success-stories-wrapper">
                <div class="row">
                    <?php 
                    // Handle both single object and array
                    $case_studies = is_array($selected_case_study) ? $selected_case_study : array($selected_case_study);
                    
                    foreach ($case_studies as $case_study) : 
                        if (is_object($case_study) && isset($case_study->ID)) :
                            $case_id = $case_study->ID;
                            $case_title = get_the_title($case_id);
                            $case_excerpt = get_the_excerpt($case_id);
                            $case_link = get_permalink($case_id);
                            
                            // Get featured image
                            $case_image = get_the_post_thumbnail_url($case_id, 'large');
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="case-study-item">
                                <?php if ($case_image) : ?>
                                    <div class="case-study-image">
                                        <img src="<?php echo esc_url($case_image); ?>" alt="<?php echo esc_attr($case_title); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                <div class="case-study-content">
                                    <?php if ($case_title) : ?>
                                         <a href="<?php echo esc_url($case_link); ?>">
                                        <h3><?php echo esc_html($case_title); ?></h3>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($case_excerpt) : ?>
                                        <p><?php echo esc_html($case_excerpt); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ($button && $button_url) : ?>
            <div class="text-center mt-4">
                <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary">
                    <?php echo esc_html($button); ?>
                   <svg xmlns="http://www.w3.org/2000/svg" width="30" height="15" viewBox="0 0 30 15" fill="none">
<path d="M29.7071 8.07112C30.0976 7.6806 30.0976 7.04743 29.7071 6.65691L23.3431 0.292946C22.9526 -0.0975785 22.3195 -0.0975785 21.9289 0.292946C21.5384 0.68347 21.5384 1.31664 21.9289 1.70716L27.5858 7.36401L21.9289 13.0209C21.5384 13.4114 21.5384 14.0446 21.9289 14.4351C22.3195 14.8256 22.9526 14.8256 23.3431 14.4351L29.7071 8.07112ZM0 7.36401V8.36401H29V7.36401V6.36401H0V7.36401Z" fill="white"/>
</svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
// Left section
$left_section_title = get_sub_field('left_section_title');
$our_locations      = get_sub_field('our_location');

// Direct contact
$direct_contact_title   = get_sub_field('direct_contact_title');
$direct_contact_email   = get_sub_field('direct_contact_email');
$direct_contact_number  = get_sub_field('direct_contact_call_number');
$direct_contact_text    = get_sub_field('direct_contact_support_text');
$social_heading    = get_sub_field('social_heading');

// Form section
$form_title       = get_sub_field('form_title');
$form_description = get_sub_field('form_description');
$contact_form     = get_sub_field('contact_form');
?>

<section class="contact-business-section section-padding">
    <div class="container">
        <div class="row">

            <!-- LEFT COLUMN -->
            <div class="col-lg-6">
                <div class="contact-left-box">

                    <?php if ($left_section_title) : ?>
                        <h2><?php echo esc_html($left_section_title); ?></h2>
                    <?php endif; ?>

                    <!-- OUR LOCATION -->
                    <?php if ($our_locations) : ?>
                        <div class="our-location">
                            <?php foreach ($our_locations as $location) : ?>
                                <div class="location-item">
                                        <div class="country-flag-wrapper">
                                            <?php if (!empty($location['country_flag'])) : ?>
                                                <img src="<?php echo esc_url($location['country_flag']['url']); ?>"
                                                     alt="<?php echo esc_attr($location['country_name']); ?>">
                                            <?php endif; ?>
        
                                            <?php if (!empty($location['country_name'])) : ?>
                                                <h4><?php echo esc_html($location['country_name']); ?></h4>
                                            <?php endif; ?>
                                        </div>

                                    <?php if (!empty($location['address'])) : ?>
                                        <p><?php echo nl2br(esc_html($location['address'])); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($location['phone_number'])) : ?>
                                        <p class="phone"><img 
                                        src="https://www.elsner.com/wp-content/uploads/2026/05/Vector.svg"
                                        alt=""
                                        class="cta-icon"
                                        loading="lazy"
                                    ><?php echo esc_html($location['phone_number']); ?></p>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- DIRECT CONTACT -->
                    <!-- <?php if ($direct_contact_title || $direct_contact_email || $direct_contact_number || $direct_contact_text) : ?>
                        <div class="direct-contact">

                            <?php if ($direct_contact_title) : ?>
                                <h4><?php echo esc_html($direct_contact_title); ?></h4>
                            <?php endif; ?>

                            <?php if ($direct_contact_email) : ?>
                                <p>
                                    <img 
                                        src="https://elsner-new.elsnerdev.com/wp-content/uploads/2026/02/email_6244438-1.png"
                                        alt=""
                                        class="cta-icon"
                                        loading="lazy"
                                    >
                                    Email us: <a href="mailto:<?php echo esc_attr($direct_contact_email); ?>">
                                        <?php echo esc_html($direct_contact_email); ?>
                                    </a>
                                </p>
                            <?php endif; ?>

                            <?php if ($direct_contact_number) : ?>
                                <p>
                                 <img 
                                        src="https://elsner-new.elsnerdev.com/wp-content/uploads/2026/02/Group-299.png"
                                        alt=""
                                        class="cta-icon"
                                        loading="lazy"
                                    >    
                                Call us: <a href="tel:<?php echo esc_attr($direct_contact_number); ?>"> <?php echo esc_html($direct_contact_number); ?></a></p>
                            <?php endif; ?>

                            <?php if ($direct_contact_text) : ?>
                                <p>
                                <img 
                                        src="https://elsner-new.elsnerdev.com/wp-content/uploads/2026/02/help_1660165-1.svg"
                                        alt=""
                                        class="cta-icon"
                                        loading="lazy"
                                    >      
                                <?php
                                    $text = esc_html($direct_contact_text);

                                    // Replace email addresses with mailto links
                                    $text = preg_replace(
                                        '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/',
                                        '<a href="mailto:$1">$1</a>',
                                        $text
                                    );

                                    echo $text;
                                    ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?> -->

                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-6">
                <div class="contact-form-box">

                    <?php if ($form_title) : ?>
                        <h2><?php echo esc_html($form_title); ?></h2>
                    <?php endif; ?>

                    <?php if ($form_description) : ?>
                        <p><?php echo esc_html($form_description); ?></p>
                    <?php endif; ?>

                    <?php if ($contact_form) : ?>
                        <div class="form-wrapper">
                            <?php echo apply_filters('the_content', $contact_form); ?>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- <div class="socialblock">
                    <div class="social-heading"> <h4> <?php echo $social_heading; ?> </h4></div>
                    <?php if (have_rows('social_links')) : ?>
                        <div class="social-icons">
                            <?php while (have_rows('social_links')) : the_row(); 
                                $icon = get_sub_field('social_icon');
                                $url  = get_sub_field('social_url');
                            ?>
                                <?php if ($icon && $url) : ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                                        <img 
                                            src="<?php echo esc_url($icon['url']); ?>" 
                                            alt="<?php echo esc_attr($icon['alt']); ?>" 
                                            loading="lazy"
                                        >
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div> -->
            </div>

        </div>
    </div>
</section>

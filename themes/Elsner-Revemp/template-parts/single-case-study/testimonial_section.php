<?php  
// Get fields
$heading            = get_sub_field('heading'); 
$sub_heading        = get_sub_field('sub_heading'); 
$testimonials_list  = get_sub_field('testimonials_list'); // Relationship field (array of posts)
?>

<section class="testimonial-section new-testimonial-design">
    <div class="container">

        <?php if( $heading ): ?>
        <h2 class="testimonial-heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if( $sub_heading ): ?>
        <p class="testimonial-subheading"><?php echo esc_html($sub_heading); ?></p>
        <?php endif; ?>

        <?php if( $testimonials_list ): ?>
        <div class="testimonial-list-wrapper">
            <div class="testimonial-carousel-wrapper">
                <div class="testimonial-list"> <!-- Slick container -->

                    <?php foreach( $testimonials_list as $post ): ?>
                    <?php setup_postdata( $post ); ?>

                    <?php 
                    $client_photo        = get_field('client_photo', $post->ID); 
                    $client_position     = get_field('client_position', $post->ID);
                    $rating              = get_field('rating', $post->ID);
                    $client_logo         = get_field('logo', $post->ID);
                    $client_company_name = get_field('client_company_name', $post->ID);
                    ?>

                    <div class="testimonial-slide"> <!-- Each slide -->
                        <div class="testimonial-item">

                            <!-- Quote Icon -->
                            <div class="testimonial-quote">
                                <span class="quote-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                                        <path d="M18.6666 3.5C18.0478 3.5 17.4543 3.74583 17.0167 4.18342C16.5791 4.621 16.3333 5.21449 16.3333 5.83333V12.8333C16.3333 13.4522 16.5791 14.0457 17.0167 14.4832C17.4543 14.9208 18.0478 15.1667 18.6666 15.1667C18.9761 15.1667 19.2728 15.2896 19.4916 15.5084C19.7104 15.7272 19.8333 16.0239 19.8333 16.3333V17.5C19.8333 18.1188 19.5875 18.7123 19.1499 19.1499C18.7123 19.5875 18.1188 19.8333 17.5 19.8333C17.1906 19.8333 16.8938 19.9562 16.675 20.175C16.4562 20.3938 16.3333 20.6906 16.3333 21V23.3333C16.3333 23.6428 16.4562 23.9395 16.675 24.1583C16.8938 24.3771 17.1906 24.5 17.5 24.5C19.3565 24.5 21.137 23.7625 22.4497 22.4497C23.7625 21.137 24.5 19.3565 24.5 17.5V5.83333C24.5 5.21449 24.2541 4.621 23.8166 4.18342C23.379 3.74583 22.7855 3.5 22.1666 3.5H18.6666Z" stroke="#03497A" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.83333 3.5C5.21449 3.5 4.621 3.74583 4.18342 4.18342C3.74583 4.621 3.5 5.21449 3.5 5.83333V12.8333C3.5 13.4522 3.74583 14.0457 4.18342 14.4832C4.621 14.9208 5.21449 15.1667 5.83333 15.1667C6.14275 15.1667 6.4395 15.2896 6.65829 15.5084C6.87708 15.7272 7 16.0239 7 16.3333V17.5C7 18.1188 6.75417 18.7123 6.31658 19.1499C5.879 19.5875 5.28551 19.8333 4.66667 19.8333C4.35725 19.8333 4.0605 19.9562 3.84171 20.175C3.62292 20.3938 3.5 20.6906 3.5 21V23.3333C3.5 23.6428 3.62292 23.9395 3.84171 24.1583C4.0605 24.3771 4.35725 24.5 4.66667 24.5C6.52318 24.5 8.30366 23.7625 9.61641 22.4497C10.9292 21.137 11.6667 19.3565 11.6667 17.5V5.83333C11.6667 5.21449 11.4208 4.621 10.9832 4.18342C10.5457 3.74583 9.95217 3.5 9.33333 3.5H5.83333Z" stroke="#03497A" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>

                            <!-- Star Rating -->
                            <?php if($rating): ?>
                            <div class="testimonial-stars">
                                <?php for ($i=0; $i < $rating; $i++): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M8.40366 1.67352C8.43561 1.60896 8.48497 1.55462 8.54617 1.51662C8.60737 1.47863 8.67798 1.4585 8.75001 1.4585C8.82205 1.4585 8.89265 1.47863 8.95385 1.51662C9.01505 1.55462 9.06441 1.60896 9.09636 1.67352L10.7807 5.08529C10.8917 5.30985 11.0555 5.50413 11.2581 5.65146C11.4606 5.79878 11.6959 5.89475 11.9438 5.93113L15.7106 6.48238C15.782 6.49272 15.8491 6.52283 15.9042 6.56929C15.9594 6.61576 16.0004 6.67674 16.0227 6.74532C16.045 6.8139 16.0477 6.88736 16.0304 6.95738C16.0132 7.0274 15.9766 7.0912 15.925 7.14154L13.2008 9.79425C13.0212 9.96933 12.8868 10.1854 12.8092 10.424C12.7316 10.6625 12.7131 10.9164 12.7553 11.1636L13.3984 14.9115C13.411 14.9829 13.4033 15.0563 13.3762 15.1235C13.3491 15.1907 13.3036 15.2489 13.245 15.2914C13.1864 15.334 13.117 15.3593 13.0447 15.3643C12.9724 15.3693 12.9002 15.3539 12.8363 15.3199L9.46897 13.5495C9.2471 13.433 9.00025 13.3721 8.74965 13.3721C8.49905 13.3721 8.2522 13.433 8.03032 13.5495L4.66376 15.3199C4.59984 15.3537 4.5277 15.3689 4.45555 15.3638C4.3834 15.3587 4.31414 15.3334 4.25564 15.2909C4.19715 15.2483 4.15176 15.1902 4.12466 15.1232C4.09755 15.0561 4.0898 14.9828 4.1023 14.9115L4.7447 11.1644C4.78713 10.917 4.76875 10.663 4.69113 10.4243C4.61351 10.1856 4.479 9.96937 4.29918 9.79425L1.57501 7.14227C1.52294 7.09198 1.48605 7.02808 1.46852 6.95785C1.451 6.88761 1.45356 6.81387 1.4759 6.74502C1.49824 6.67616 1.53948 6.61497 1.5949 6.56841C1.65032 6.52184 1.71771 6.49178 1.78939 6.48165L5.55553 5.93113C5.80364 5.89503 6.03925 5.79919 6.2421 5.65185C6.44495 5.5045 6.60896 5.31007 6.72001 5.08529L8.40366 1.67352Z" fill="#D97706" stroke="#D97706" stroke-width="1.45833" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <?php endif; ?>

                            <!-- Testimonial Content -->
                            <div class="testimonial-content">
                                <?php the_content(); ?>
                            </div>

                            <!-- Client Info -->
                            <div class="testimonial-client">
                                <?php if($client_photo): ?>
                                <img class="client-photo" src="<?php echo esc_url($client_photo['url']); ?>" alt="<?php echo esc_attr($client_photo['alt']); ?>">
                                <?php else: ?>
                                <div class="client-placeholder"><?php echo strtoupper(substr(get_the_title(), 0, 1)); ?></div>
                                <?php endif; ?>

                                <div class="client-meta">
                                    <h4 class="client-name"><?php the_title(); ?></h4>
                                    <?php if($client_position): ?>
                                    <p class="client-position"><?php echo esc_html($client_position); ?></p>
                                    <?php endif; ?>
                                    <div class="client-company">
                                    <?php 
                                    $logo_url = '';
                                    $logo_alt = '';
                                    if( $client_logo && is_array($client_logo) ) {
                                        $logo_url = $client_logo['url'];
                                        $logo_alt = $client_logo['alt'] ?: $client_company_name;
                                    } elseif( $client_logo && is_string($client_logo) ) {
                                        $logo_url = $client_logo;
                                        $logo_alt = $client_company_name;
                                    }
                                    ?>

                                    <?php if( $logo_url ): ?>
                                        <img class="client-logo" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($logo_alt); ?>">
                                    <?php else: ?>
                                        <!-- <div class="client-logo-placeholder">
                                            <?php echo strtoupper(substr($client_company_name ?: get_the_title(), 0, 1)); ?>
                                        </div> -->
                                    <?php endif; ?>

                                    <?php if($client_company_name): ?>
                                        <span class="client-company-name"><?php echo esc_html($client_company_name); ?></span>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>

                </div> <!-- /.testimonial-list -->
            </div> <!-- /.testimonial-carousel-wrapper -->
        </div> <!-- /.testimonial-list-wrapper -->
        <?php endif; ?>

        <!-- Bottom Stats Section -->
        <div class="testimonial-stats">
            <?php
            if( have_rows('testimonials_cards') ):
                while( have_rows('testimonials_cards') ) : the_row();
                    $title = get_sub_field('title');
                    $text  = get_sub_field('text'); ?>
                <div class="stat">
                    <h3><?php echo $title; ?></h3>
                    <p><?php echo $text; ?></p>
                </div>
            <?php endwhile;
            endif; ?>
        </div>

    </div>
</section>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    if (typeof jQuery !== 'undefined' && jQuery(".testimonial-list").length) {
        jQuery(".testimonial-list").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,       // set true if you want prev/next arrows
            dots: false,         // set true if you want pagination dots
            infinite: true,
            autoplay: true,
            autoplaySpeed: 1000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: { slidesToShow: 1 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 1 }
                }
            ]
        });
    }
});
</script>
<?php
// Retrieve the post ID from the $args array
$post_id = $args['post_id'];
$banner_heading = get_field('banner_heading', $post_id);
$banner_image = get_field('banner_image', $post_id);
$banner_image2 = get_field('banner_image2', $post_id);
$banner_img2_industries_alt_tag = get_field('banner_img2_industries_alt_tag', $post_id);

$banner_logo_1 = get_field('banner_logo_1', $post_id);
$banner_logo_2 = get_field('banner_logo_2', $post_id);
$banner_button = get_field('banner_button', $post_id);
$banner_new_form = get_field('banner_new_form', $post_id);
$tile_industry_image_class = is_page('tiles-ecommerce-services') ? 'tile-industry-image' : 'industry-image';
if(is_page('ai-calling-solutions')){
    $testimonial_form = 'https://www.elsner.com/contact-us/';
}else{
$testimonial_form = is_page('jewelry-e-commerce-development') || is_page('fashion-e-commerce-development') ? '#testimonial-form' : '#get-touch-digital';
}
?>

<section class="industries-banner blue-section padding-120">
    <div class="banner-image" style="background-image: url(<?php echo $banner_image; ?>)"></div>
    <div class="industry-banner-content">
        <div class="breadcrumb-wrapper">
            <?php custom_breadcrumbs(); ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 industry-content">
                    <div class="inner-content">
                        <h1><?php echo $banner_heading; ?></h1>
                        <p><?php echo the_content(); ?></p>
                        <div class="banner-btn">
                            <!-- <a href="<?php 
                                            ?>"
                        class="btn btn-secondary"><?php
                                                    ?></a> -->
                            <a href="<?php echo $testimonial_form; ?>"
                                class="btn btn-secondary"><?php echo $banner_button; ?></a>
                        </div>
                        <div class="review-images">
                            <img src="<?php echo $banner_logo_1; ?>" alt="Review info" width="261" height="76" />
                            <img src="<?php echo $banner_logo_2; ?>" alt="Review info" width="197" height="87" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 <?= $tile_industry_image_class ?>">
                    <div class="hero-main-banner-content-form">
                        <div class="hero-main-banner-content-form-inner">
                            <div class="hero-booking-tab"><span>Book a Free Consultation Call</span></div>
                            <?php  echo $banner_new_form;   ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-main-banner-content {
    display: flex;
    flex-wrap: wrap;
    padding: 0 0 72px 0;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}
.hero-section.tmp-new-service-page-hero .hero-main-banner-content .hero-content {
    text-align: left;
    max-width: 593px;
    margin: 0;
     flex: 0 0 50%;
}
.hero-main-banner-content .hero-heading-2 {
    font-size: clamp(2rem, 5vw, 3rem);
}
.hero-explore-packages-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.hero-explore-packages-list .hero-package-item {
    font-size: 20px;
    font-weight: 400;
    color: #002840;
}
.hero-content .hero-cta {
    margin-bottom: 20px;
}
.hero-main-banner-content-form {
    flex: 0 0 calc(50% - 20px);
    max-width: 550px;
    width: 100%;
    position: relative;
    z-index: 2;
}
.hero-main-banner-content-form-inner {
    padding: 34px 22px;
    box-shadow: 0 0 0 6px rgba(0, 0, 0, .012);
    background-color: #fcfcfc;
    border: 1px solid #0000001F;
    border-radius: 22px;
    outline: 1px solid #0000001F;
    outline-offset: 3px;
}
.hero-head-title p {
    color: #6b7280;
    display: block;
    text-align: justify;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 16px;
}

.hero-booking-tab {
    border: 1px solid rgba(3, 50, 60, .078);
    border-radius: 99px;
    display: flex;
    gap: 10px;
    justify-content: center;
    background: linear-gradient(180deg, rgba(228, 251, 255, 0.2) 0%, rgba(228, 251, 255, 0.5) 50%, rgba(199, 247, 255, 0.8) 100%);
    margin-bottom: 15px;
    padding: 5px;
}

.hero-booking-tab span {
    background: linear-gradient(180deg, rgba(228, 251, 255, .2), rgba(228, 251, 255, .5) 50%, rgba(199, 247, 255, .8));
    box-shadow: inset 0 -4px 11px 0 rgba(68, 68, 68, .059) !important;
    color: #002840;
    font-size: 16px;
    font-weight: 700;
    padding: 6px 16px;
    text-align: center;
    width: 100%;
    border-radius: 99px;
}
.hero-main-banner-content-form-inner input[type="text"] ,
.hero-main-banner-content-form-inner input[type=email],
.hero-main-banner-content-form-inner input[type="url"],
.hero-main-banner-content-form-inner .form-group.form-services-select select,
.hero-main-banner-content-form-inner textarea{
    background: #fff;
    border: 1.5px solid #e5e7eb;
    border-radius: 12px;
    color: #374151;
    font-family: inherit;
    font-size: 14px;
    padding: 11px 16px;
    transition: all .2s ease;
    width: 100%;
    height: auto;
}
.hero-main-banner-content-form-inner .form-group {
    margin-bottom: 15px;
}
.hero-main-banner-content-form-inner .form-group.hero-landing-submit-btn {
    position: relative;
    margin: 0;
}
.hero-main-banner-content-form-inner .form-group.hero-landing-submit-btn span.wpcf7-spinner {
    left: 50%;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
}
.hero-main-banner-content-form-inner .form-group.hero-landing-submit-btn input {
    width: 100%;
    background: linear-gradient(180deg, #002840 25%, #002840 100%);
    text-transform: capitalize;
}
.hero-main-banner-content-form-inner .form-group.form-services-select select {
    position: relative;
    appearance: none;
}
.hero-main-banner-content-form-inner .form-group.form-services-select {
    position: relative;
}
.hero-main-banner-content-form-inner .form-group.form-services-select:before {
    content: '';
    position: absolute;
    right: 0;
    width: 24px;
    height: 24px;
    z-index: 1;
    background-image: url("data:image/svg+xml,%3Csvg width='8' height='5' viewBox='0 0 8 5' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.29125 4.32097L0.14 1.16997C0.0966668 1.12647 0.0625 1.07789 0.0375 1.02422C0.0125 0.970723 0 0.913306 0 0.851973C0 0.729473 0.0414167 0.622972 0.12425 0.532472C0.207083 0.442139 0.31625 0.396973 0.45175 0.396973H7.09025C7.22575 0.396973 7.33492 0.442639 7.41775 0.533972C7.50058 0.625139 7.542 0.731556 7.542 0.853223C7.542 0.883723 7.49525 0.989306 7.40175 1.16997L4.25075 4.32097C4.17842 4.39347 4.10358 4.44639 4.02625 4.47972C3.94892 4.51306 3.86383 4.52972 3.771 4.52972C3.67817 4.52972 3.59308 4.51306 3.51575 4.47972C3.43842 4.44639 3.36358 4.39347 3.29125 4.32097Z' fill='%23333333'/%3E%3C/svg%3E%0A");
    background-repeat: no-repeat;
    top: 44%;
    pointer-events: none;
}

@media(max-width:991px){
    .hero-main-banner-content {
        align-items: center;
        padding: 0 0 25px 0;
    }
    .hero-section.tmp-new-service-page-hero .hero-main-banner-content .hero-content {
        flex: 0 0 100%;
        max-width: unset;
        text-align: center;
        margin: 0 0 30px 0;
    }
    .hero-explore-packages-list {
        justify-content: center;
    }
    .hero-main-banner-content-form {
        flex: 0 0 100%;
        margin: 0 auto;
    }
}
</style>

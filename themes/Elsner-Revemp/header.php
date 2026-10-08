<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
global $template;
$template_name = basename($template); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
    <meta content='width=device-width, initial-scale=1, minimum-scale=1' name='viewport' />
    <title><?php wp_title(''); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    
    <?php global $favicon, $logo, $dark_logo, $menu_group, $sticky_logo, $contact_form, $sales_phone_number, $sales_email_address, $skype_id, $partners, $address, $facebook, $instagram, $linekdin, $google, $twitter, $pinterest, $youtube, $github, $header;

    if ($favicon) {
        echo '<link rel="icon" href="' . $favicon . '" type="image/png">';
    }
    ?><script>
    <?php
        the_field('script_in_head', 'option');
        ?>
    </script><?php

                $post_id = get_queried_object_id();
                if (get_field('nofollow_-_noindex', $post_id)) {
                    echo '<meta name="robots" content="noindex, nofollow">';
                } ?>

    <?php
    // Add dynamic author meta tag
    if (is_singular()) {
        $author_name = get_the_author_meta('display_name', get_post_field('post_author', get_the_ID()));
        echo '<meta name="author" content="' . esc_attr($author_name) . '" />';
    }
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Elsner Technologies Pvt. Ltd.",
        "image": "https://www.elsner.com/wp-content/uploads/2020/05/elsner_logo_2020.svg",
        "@id": "",
        "url": "https://www.elsner.com/",
        "telephone": "+1 (607) 524-4040",
        "priceRange": "$$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "3405 Pennsylvania Common",
            "addressLocality": "Fremont",
            "addressRegion": "CA",
            "postalCode": "94536",
            "addressCountry": "US"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 37.55292315798208,
            "longitude": -121.98721527302101
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ],
            "opens": "00:00",
            "closes": "23:59"
        },
        "sameAs": [
            "https://www.linkedin.com/company/elsner-technology-pvt--ltd-",
            "https://www.youtube.com/@elsnertechnologiespvtltd.5430",
            "https://www.facebook.com/ElsnerTechnologiesPvtLtd/",
            "https://www.instagram.com/elsnertechnologies/"
        ],


        "department": [{
                "@type": "LocalBusiness",
                "name": "Ecommerce Web Dev | Shopify, Magento, WP | Elsner Technologies AU",
                "description": "At Elsner, our expert team provides top-notch ecommerce web development (Shopify, Magento, WordPress), digital marketing (SEO, PPC, social media) & web design services in Australia.",
                "url": "https://www.elsner.com.au/",
                "@id": "https://www.elsner.com.au/#EcommerceDevelopment",
                "image": "https://www.elsner.com.au/wp-content/uploads/2020/02/orange-logo-svg-2020-elsner.svg",
                "telephone": "+61 413 223 826",
                "priceRange": "$$$",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": " Level 24, Three International Towers,300 Barangaroo Ave",
                    "addressLocality": "Barangaroo ",
                    "addressRegion": "NSW",
                    "postalCode": "2000",
                    "addressCountry": "AU"
                },
                "location": {
                    "@type": "Place",
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": "-33.865008650542144",
                        "longitude": "151.20223199913357"
                    }
                }

            },

            {
                "@type": "LocalBusiness",
                "name": "Ecommerce Web Dev Solutions | Shopify, Magento, WP| Elsner Technologies UK",
                "description": "Boost your UK business with Elsner Tech. Expert ecommerce web development, digital marketing, and SEO services to drive sales and enhance online visibility.",
                "url": "https://www.elsner.com",
                "@id": "https://www.elsner.com/#EcommerceDevelopment",
                "image": "https://www.elsner.com/wp-content/uploads/2020/05/elsner_logo_2020.svg",
                "telephone": "+44 020 8381 3000",
                "priceRange": "$$$",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "85 Great Portland St",
                    "addressRegion": "London",
                    "postalCode": "W1W 7LT",
                    "addressCountry": "UK"
                },
                "location": {
                    "@type": "Place",
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": "51.518617822768434",
                        "longitude": "-0.14225681534118823"
                    }
                }

            },

            {
                "@type": "LocalBusiness",
                "name": "Canadian Digital Solutions By Elsner Technologies | Ecommerce, Web Design, SEO, PPC",
                "description": "levate your Canadian business online. Elsner Tech offers top-notch ecommerce development, digital marketing, and web design services to boost your brand and drive sales.",
                "url": "https://www.elsner.com",
                "@id": "https://www.elsner.com/#DigitalWebSolutions",
                "image": "https://www.elsner.com/wp-content/uploads/2020/05/elsner_logo_2020.svg",
                "telephone": "+1 (607) 524-4040",
                "priceRange": "$$$",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "908-585 River Avenue",
                    "addressLocality": "Winnipeg",
                    "addressRegion": "Manitoba",
                    "postalCode": "R3L 2S9",
                    "addressCountry": "CA"
                },
                "location": {
                    "@type": "Place",
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": "49.8780083325925",
                        "longitude": "-97.15110467116469"
                    }
                }
            }
        ]
    }
    </script>
    <?php
    if (is_page('ecommerce-development')) {
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "eCommerce Development Services",
        "description": "Elsner Technologies offers expert eCommerce development services, including custom solutions for Shopify, Magento, WooCommerce, and BigCommerce.",
        "provider": {
            "@type": "Organization",
            "name": "Elsner Technologies Pvt. Ltd.",
            "url": "https://www.elsner.com",
            "logo": "https://www.elsner.com/wp-content/uploads/2021/12/logo-1.svg",
            "sameAs": [
                "https://www.facebook.com/ElsnerTechnologies",
                "https://www.linkedin.com/company/elsner-technologies-pvt-ltd-/",
                "https://twitter.com/elsnertech",
                "https://www.instagram.com/elsnertechnologies/"
            ]
        },
        "areaServed": {
            "@type": "Place",
            "name": "Global"
        },
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "eCommerce Development Offerings",
            "itemListElement": [{
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Magento Development"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Shopify Development"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "WooCommerce Development"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "BigCommerce Development"
                    }
                }
            ]
        },
        "url": "https://www.elsner.com/services/ecommerce-development/"
    }
    </script>
    <?php
    }
    ?>
    <?php
    if (is_single('zoho-commerce-guide-online-store-setup-management')) {
    ?>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "headline": "Zoho Commerce 2025: A Complete Guide to Building and Managing Your Online Store",
        "datePublished": "2025-07-29T08:00:00+05:30",
        "dateModified": "2025-07-29T09:15:00+05:30",
        "author": {
            "@type": "Person",
            "name": "Pankaj Sakariya",
            "url": "https://www.elsner.com/author/admin/"
        },
        "image": {
            "@type": "ImageObject",
            "url": "https://www.elsner.com/wp-content/uploads/2025/07/Zoho-Commerce-2025-A-Complete-Guide-to-Your-Online-Store.jpeg"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Elsner Technologies",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.elsner.com/wp-content/uploads/2023/05/logo.svg"
            }
        },
        "description": "Thinking of starting your online store in 2025? Elsner shows you how to set up, launch, and run your store smoothly with Zoho Commerce. From setup to features and smart integrations, we’ve got you covered with expert tips."
    }
    </script>
    <?php
    }
    ?>
    <?php
    if (is_single('how-to-fix-slow-wordpress-website-and-boost-sales')) {
    ?>
    <meta name="robots" content="max-image-preview:large">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://www.elsner.com/how-to-fix-slow-wordpress-website-and-boost-sales/"
        },
        "headline": "WordPress Website Loading Slowly? Fix Speed Issues and Boost Sales",
        "description": "Is your WordPress website loading slowly? Learn quick and effective ways to fix speed issues, improve performance, and boost your online sales effortlessly.",
        "image": "https://www.elsner.com/wp-content/uploads/2025/11/Is-your-WordPress-website-slowing-sales-Fix-It-Here.jpg",
        "author": {
            "@type": "Person",
            "name": "Pankaj Sakariya",
            "url": "https://www.elsner.com/author/admin/"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Elsner Technologies",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.elsner.com/wp-content/uploads/2023/05/logo.svg"
            }
        },
        "datePublished": "2025-11-06T09:00:00+05:30",
        "dateModified": "2025-11-06T09:00:00+05:30"
    }
    </script>
    <?php
    }
    ?>
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="7ncVNuFrZau6u3T9ItzbDQ" async></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php the_field('body_scripts', 'option'); ?>
    <!-- <div id="loader">
        <img src="<?php //echo get_template_directory_uri(); 
                    ?>/assets/images/EclipseLoader.gif" alt="loader" width="110" height="110" loading="lazy">
    </div> -->

    <div class="main-page">
        <?php $current_slug = get_post_field('post_name', get_post());

        // Skip header entirely only for 'ecommerce-website-design'
        if ($current_slug === 'ecommerce-website-design' || $current_slug === 'lp-thank-you' || $current_slug === 'wordpress-website-development') {
            return;
        }

        // Get ACF field for header selection
        $header = get_field('select_header', get_the_ID());

        // If no header is selected, use a default header
        if (empty($header)) {
            $header = 'default';
        }
        ?>
        <?php if ($header === 'header 6') :
            $header6_location = get_field('header6_location', 'option');
        ?>
        <div class="header-6-location-bar">
            <span><?php echo esc_html($header6_location); ?></span>
        </div>
        <?php endif; ?>
        <header class="elsner-header header <?php echo ($header === 'header 2' || http_response_code() === 410 || http_response_code() === 404 ) ? 'header-2' : ''; 
                echo ($header === 'header 5') ? 'header-5' : ''; echo ($header === 'header 6') ? 'header-6' : ''; ?>">
            <div class="container-fluid">
                <div class="header-wrapper">
                    <!-- top bar  -->

                    
                     <!-- <div class="navbar navbar-expand-lg header-top-bar event-ticker">
                        <div class="container event-ticker-container">
                            <p class="event-ticker-heading">Catch Elsner at the <span class="event-name-highlighted">UK Ecommerce Expo</span> and <span class="event-name-highlighted">Seamless Digital Commerce Dubai</span>, 2026</p>

                            <p id="book-a-slot">
                                <a href="https://www.elsner.com/uk-ecommerce-expo-2026/">Meet Us in UK</a>
                                <a href="https://www.elsner.com/seamless-dubai-2026/">Meet Us in Dubai</a>
                            </p>
                        </div>
                     </div> -->
                    
                     <!-- top bar end  -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="<?php echo home_url(); ?>">
                            <?php if ($header === 'header 3') { ?>
                            <img src="<?php echo $sticky_logo; ?>" alt="logo" width="180" height="40" loading="lazy">
                            <?php } elseif($header === 'header 5') { ?>
                            <a href="<?php echo site_url(); ?>">
                                <img src="https://www.elsner.com/wp-content/uploads/2026/03/logo-blue.png" alt="Elsner Logo" width="160">
                            </a>
                            <?php } else if($header === 'header 6') { ?>
                            <img src="<?php echo $dark_logo; ?>" class="logo" alt="logo" width="180" height="40" loading="lazy">
                            <img src="<?php echo $sticky_logo;  ?>" class="sticky-logo" alt="logo" width="180" height="40" loading="lazy">
                            <?php } else { ?>
                            <img src="<?php echo $dark_logo; ?>" class="logo" alt="logo" width="180" height="40"
                                loading="lazy">
                            <img src="<?php echo $sticky_logo; ?>" class="sticky-logo" alt="logo" width="180" height="40"
                                loading="lazy">
                            <?php } ?>
                        </a>
                        <?php if ($header !== 'header 3' && $header !== 'header 5' ) : ?>
                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navmenu" aria-controls="navmenu" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navmenu">
                            <div class="mobile-search-bar-wrapper">
                                    <div class="mega-search-box">
                                        <label for="mobile-mega-menu-search-input" class="screen-reader-text" style="display:none;">Search</label>
                                        <input type="text" id="mobile-mega-menu-search-input" aria-label="Search" class="mega-menu-search-input" placeholder="Search">
                                        <button type="submit" class="mega-search-btn" aria-label="Search">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="7" stroke="#007AC1" stroke-width="2"/>
                                                <line x1="16.65" y1="16.65" x2="22" y2="22" stroke="#007AC1" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                    </div>
                            </div>

                            <div class="mobile-search-results-wrapper">
                                    <!-- Results will appear here from your existing search functionality -->
                            </div>


                            <?php
                                if ($header === 'header 6') :
                                    wp_nav_menu(array(
                                        'menu'           => '2395',
                                        'menu_class'     => 'navmenu',
                                        'container'      => '',
                                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                                        'depth'          => 0,
                                        'fallback_cb'    => 'wp_page_menu',
                                        'walker'         => new NewElsnerMenu()
                                    ));
                                else :    
                                    wp_nav_menu(array(
                                        'theme_location' => 'header',
                                        'menu_class'     => 'navmenu',
                                        'container'      => '',
                                        'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                                        'depth'          => 0,
                                        'fallback_cb'    => 'wp_page_menu',
                                        'walker'         => new NewElsnerMenu()
                                    ));
                                endif;    
                            ?>
                            <?php if ($header !== 'header 6') : ?>
                                <div class="about-menu">
                                    <button class="menubtn" aria-label="Menu-button">
                                        <span></span>
                                        <span></span>
                                    </button>
                                    <div class="header-secondmenu">
                                        <div class="row alinc">
                                            <div class="col-md-7">
                                                <div class="second-menu-content">
                                                    <div class="menu-left">
                                                        <h6 class="Redhat-font">Menu</h6>
                                                        <?php
                                                            $args = array(
                                                                'theme_location' => 'header-secondmenu',
                                                                'container' => 'ul',
                                                                'container_class' => '',
                                                                'menu_class' => '',
                                                                'walker' => new HeaderSecondMenu()
                                                            );
                                                            wp_nav_menu($args);
                                                            ?>
                                                    </div>
                                                    <div class="menu-right">
                                                        <div class="menu-contactlink">
                                                            <a
                                                                href="mailto:<?php echo $sales_email_address; ?>"><?php echo $sales_email_address; ?></a>
                                                            <a
                                                                href="tel:<?php echo $sales_phone_number; ?>"><?php echo $sales_phone_number; ?></a>
                                                        </div>
                                                        <div class="menu-address">
                                                            <h6><?php echo esc_html('Headquarter-India'); ?></h6>
                                                            <address>

                                                                <?php echo $address; ?>
                                                            </address>
                                                        </div>
                                                        <div class="menu-address">
                                                            <h6><?php echo esc_html('USA'); ?></h6>
                                                            <div class="multiple-address">
                                                                <?php echo get_field('usa_address', 'option'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="social-links-menu">
                                                            <ul>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $facebook; ?>"
                                                                        aria-label="Elsner Facebook"><i
                                                                            class="fa-brands fa-facebook-f"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $instagram; ?>"
                                                                        aria-label="Elsner instagram"><i
                                                                            class="fa-brands fa-instagram"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $linekdin; ?>"
                                                                        aria-label="Elsner linkedin"><i
                                                                            class="fa-brands fa-linkedin-in"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $twitter; ?>"
                                                                        aria-label="Elsner twitter"><i
                                                                            class="fa-brands fa-x-twitter"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $youtube; ?>"
                                                                        aria-label="Elsner youtube"><i
                                                                            class="fa-brands fa-youtube"></i></a>
                                                                </li>
                                                                <li>
                                                                    <a target="_blank" href="<?php echo $github; ?>"
                                                                        aria-label="Elsner github"><i
                                                                            class="fa-brands fa-github"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="menu-right-img">
                                                    <?php
                                                        $image = get_field('menu_image', 'option');

                                                        if ($image) {
                                                            echo '<img src="' . $image['url'] . '" alt="menu-image" width="' . $image['width'] . '" height="' . $image['height'] . '" />';
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($header === 'header 5') : ?>
                        <div class="header-5-right">
                            <div class="header-5-contact">
                                <?php if ($sales_phone_number) : ?>
                                <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $sales_phone_number)); ?>" class="header-5-link">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/phone.svg" alt="Phone Icon" class="icon">
                                    <?php echo esc_html($sales_phone_number); ?>
                                </a>
                                <?php endif; ?>
                                <?php if ($sales_email_address) : ?>
                                <a href="mailto:<?php echo esc_attr($sales_email_address); ?>" class="header-5-link">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/email.svg" alt="Email Icon" class="icon">
                                    <?php echo esc_html($sales_email_address); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <!-- <?php 
                            $h5_cta_text = get_field('header5_cta_text', get_the_ID()) ?: 'Book Free Consultation';
                            $h5_cta_link = get_field('header5_cta_link', get_the_ID()) ?: '#consultation-form';
                            ?>
                            <a href="<?php echo esc_url($h5_cta_link); ?>" class="header-5-cta">
                                <?php echo esc_html($h5_cta_text); ?>
                            </a> -->
                        </div>
                        <?php endif; ?>
                        <?php if ($header === 'header 6') : 
                            $h6_cta_text = get_field('header6_cta_text', get_the_ID()) ?: 'Book Your Slot';
                            $h6_cta_link = get_field('header6_cta_link', get_the_ID()) ?: '#meeting-contact';
                        ?>
                        <div class="header-6-right">
                            <a href="<?php echo esc_url($h6_cta_link); ?>" class="header-6-cta">
                            <img 
                                src="https://www.elsner.com/wp-content/uploads/2026/09/calendar-logo.png" 
                                alt="Calendar Icon"
                                class="header-6-cta-icon">
                            <span><?php echo esc_html($h6_cta_text); ?></span>
                            <span>Let’s Chat</span>
                        </a>
                        </div>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </header>

        <?php 
        if (
            $template_name === 'services.php'
            || $template_name === 'WeekMate.php'
            || is_singular('product')
            || $template_name === 'hire-developer.php'
            || $template_name === 'single-portfolio.php'
            || $template_name === 'our-portfolio.php'
            || $template_name === 'industries-template.php'
            || $template_name === 'new-service-design.php'
            || $template_name === 'whatsapp-integration-template.php'
            || $template_name === 'template-home-new.php'
            || is_single()
            || is_front_page()
            || is_home()
        ) :
            if (get_the_ID() != 8212) :
        ?>
        <!-- Popup -->

        <div class="modal fade modal-start-project" id="elsner-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="flex-row">
                            <div class="col modal-left-col modal-info">
                                <div class="highlighted-serivces">
                                    <?php if (have_rows('popup_repeater', 'option')) :
                                            ?>
                                    <?php while (have_rows('popup_repeater', 'option')) : the_row();
                                                ?>
                                    <div class="item">
                                        <div class="icon">
                                            <img src="<?php the_sub_field('popup_icons');
                                                                        ?>" />
                                        </div>
                                        <div class="content">
                                            <h5><?php the_sub_field('popup_left_heading');
                                                                ?></h5>
                                            <p><?php the_sub_field('popup_left_subheading');
                                                                ?></p>
                                        </div>
                                    </div>
                                    <?php endwhile;
                                                ?>
                                    <?php endif;
                                            ?>
                                </div>
                            </div>
                            <div class="col modal-right-col modal-form">
                                <div class="content-inner">
                                    <div class="form-headingtext">
                                        <span class="title-label">Connect with us</span>
                                        <h2>Get <span>No-Cost Quote</span> and Expert Consultation</h2>
                                    </div>
                                    <div class="contact-form project-form">
                                        <?php echo get_field('popup_enquiry_form', 'option');
                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end popup -->
        <?php 
        endif;
        endif;
        ?>

        <?php if ($template_name === 'ecommerce-maintenence-package.php') : ?>
        <!-- ecommerce package Popup -->
        <div class="modal fade modal-ecommerce" id="ecommerce-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="flex-row">
                            <div class="col modal-left-col modal-info">
                                <div class="ecommerce-left-image">
                                    <img
                                        src="<?php echo site_url(); ?>/wp-content/uploads/2024/02/ecommerce-left-image.png" />
                                </div>
                            </div>
                            <div class="col modal-right-col modal-form">
                                <div class="content-inner">
                                    <div class="form-headingtext">
                                        <h2>Secure Your <span>Free Website Audit</span> Today! Limited Time Offer </h2>
                                        <span class="title-label">Enter your details to get a comprehensive Audit of
                                            your website</span>
                                    </div>
                                    <div class="contact-form project-form">
                                        <?php echo do_shortcode('[contact-form-7 id="39349" title="Ecommerce Maintenance Package Popup Form"]');
                                            ?>
                                    </div>
                                    <div class="terms-and-condition">
                                        <a href="/terms-and-condition">*Terms & conditions apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end ecommerce package popup -->
        <?php endif;
        ?>

        <!-- start whatsapp chat popup -->
        <div class="modal fade whatsapp-chat-popup" id="whatsapp-chat-popup" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="inner">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512">
                                    <path
                                        d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="flex-row">
                                <div class="modal-main-christmas-form">
                                    <div class="whatsapp-chat-image">
                                        <?php
                                        $whatsapp_chat_image = get_field('whatsapp_chat_image', 'options');
                                        $whatsapp_chat_image_alt = get_field('whatsapp_chat_image_alt', 'options');
                                        ?>
                                        <img src="<?php echo $whatsapp_chat_image; ?>"
                                            alt="<?php echo $whatsapp_chat_image_alt; ?>" />

                                    </div>
                                    <div class="whatsapp-chat-button">
                                        <a href="https://api.whatsapp.com/send?phone=9898607411&text=Hi"
                                            class="btn btn-secondary" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="18"
                                                viewBox="0 0 448 512" fill="#fff">
                                                <path
                                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                            </svg>
                                            Chat Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end whatsapp chat popup -->

        <div class="main-wrapper">
            <?php if (is_front_page()) : ?>
            <div class="sidebar-menu">
                <ul id="menu">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'sidebar-menu',
                            'container' => false,
                            'menu_class' => '',
                            'items_wrap' => '%3$s',
                            'walker' => new SidebarMenu()
                        ));
                        ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], '/services/') !== false || basename($template) === 'hire-developer.php') :
            ?>
            <!-- Trigger Button -->
            <div id="linkedinPostsBtn" style="position:fixed;bottom:20px;right:150px;z-index:1000;cursor:pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 112.196 112.196">
                    <g>
                        <circle cx="56.098" cy="56.097" r="56.098" fill="#007ab9" />
                        <path
                            d="M89.616 60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118-3.705 0-5.906 2.491-6.878 4.903-.353.862-.444 2.059-.444 3.268v22.524h-13.41V43.41h13.411v5.715h.089c1.782-2.742 4.96-6.662 12.085-6.662 8.822 0 15.436 5.764 15.436 18.149zM34.656 23.969c-4.587 0-7.588 3.011-7.588 6.967 0 3.872 2.914 6.97 7.412 6.97h.087c4.677 0 7.585-3.098 7.585-6.97-.089-3.956-2.908-6.967-7.496-6.967zM27.865 83.097H41.27V42.767H27.865v40.33z"
                            fill="#f1f2f2" />
                    </g>
                </svg>
            </div>

            <!-- Popup Wrapper -->
            <div class="linkedinPostsBtn-wrapper">
                <div id="linkedinPopup">
                    <div class="linkedinPosts-logo"><a
                            href="https://www.linkedin.com/company/1005672/admin/dashboard/"><img
                                src="https://www.elsner.com/wp-content/uploads/2023/05/logo.svg" class="logo lazyloaded"
                                alt="logo" width="180" height="40" loading="lazy"
                                data-src="https://www.elsner.com/wp-content/uploads/2023/05/logo.svg" decoding="async"
                                data-eio-rwidth="180" data-eio-rheight="40"></a></div>
                    <button id="closeLinkedinPopup" style="float:right;">✖</button>
                    <?php echo do_shortcode('[juicer name="elsner-technology-pvt-ltd"]'); ?>
                </div>
            </div>

            <?php endif; ?>
            <style>
                /* ── Header 5 ─────────────────────────────────────── */

                .page-template-london-event .elsner-header.header-5 {
                    background: #fff;
                }

                .page-template-london-event .elsner-header.header-5 .container-fluid .navbar {
                    justify-content: space-between;
                    align-items: center;
                }

                .page-template-london-event .header-5 .navbar-brand {
                    margin-right: auto;
                }

                .page-template-london-event .header-5-right {
                    display: flex;
                    align-items: center;
                    gap: 24px;
                    margin-left: auto;
                }

                .page-template-london-event .header-5-contact {
                    display: flex;
                    align-items: center;
                    gap: 20px;
                }

                .page-template-london-event .header-5-link {
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    color: #000000;
                    text-decoration: none;
                    font-size: 14px;
                    white-space: nowrap;
                }

                .page-template-london-event .header-5-link svg {
                    color: #005282;
                }

                .page-template-london-event .header-5-link:hover {
                    color: #000000;
                    opacity: 0.8;
                }

                .page-template-london-event .header-5-cta {
                    display: inline-block;
                    padding: 10px 22px;
                    background: #03497A;
                    color: #fff;
                    border-radius: 30px;
                    text-decoration: none;
                    font-size: 12px;
                    font-weight: 600;
                    letter-spacing: 0.8px;
                    text-transform: uppercase;
                    white-space: nowrap;
                    border: 2px solid #03497A;
                    transition: background 0.2s, color 0.2s;
                }

                .page-template-london-event .header-5-cta:hover {
                    background: transparent;
                    color: #005282;
                }

                /* hide hamburger + nav collapse for header 5 */
                .page-template-london-event .header-5 .navbar-toggler,
                .page-template-london-event .header-5 .navbar-collapse {
                    display: none;
                }

                /* ── Header 6 ─────────────────────────────────────── */
                .page-template-london-event .header-6.fixed .sticky-logo {
                    display: none;
                }
                .page-template-london-event .header-6.fixed .logo {
                    display: block;
                }
                @media screen and (max-width: 991px) {
                    .page-template-london-event.menu-active .elsner-header.header-6 .navbar-brand .sticky-logo {
                        display: block;
                    }
                }
                .page-template-london-event .header-6-cta {
                    position: relative;
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    padding: 10px 20px;
                    background: #007AC1;
                    color: #fff;
                    border-radius: 6px;
                    text-decoration: none;
                    font-size: 16px;
                    font-weight: 600;
                    white-space: nowrap;
                    border: 2px solid #007AC1;
                    overflow: hidden;
                    transition: background 0.2s, color 0.2s;
                }

                .page-template-london-event .header-6-cta svg {
                    flex-shrink: 0;
                }

                /* Legacy hover-triggered text-slide on the raw <span> children —
                   kept as-is, just scoped. Note: the CTA text swap is also
                   implemented as an always-on infinite loop via
                   .header-6-cta-text/.header-6-cta-track in london-event.css
                   (section 8). If both end up wired to the same markup they
                   will fight each other — worth reconciling to one approach. */
                .page-template-london-event .header-6-cta > span {
                    position: relative;
                    display: block;
                    white-space: nowrap;
                    transition: transform 0.4s ease;
                }

                .page-template-london-event .header-6-cta > span:nth-of-type(1) {
                    transform: translateY(0);
                }

                .page-template-london-event .header-6-cta > span:nth-of-type(2) {
                    position: absolute;
                    left: 33%;
                    top: 60%;
                    transform: translateY(100%);
                }

                .page-template-london-event .header-6-cta:hover > span:nth-of-type(1) {
                    transform: translateY(-157%);
                }

                .page-template-london-event .header-6-cta:hover > span:nth-of-type(2) {
                    transform: translateY(-72%);
                }

                .page-template-london-event .header-6-location-bar {
                    background: #050d1f;
                    color: #c9c9c9;
                    font-size: 12px;
                    padding: 0px 30px;
                    position: sticky;
                    top: 16px;
                }

                .page-template-london-event .header.fixed ul.navmenu > li > a {
                    color: #fff;
                }

                .page-template-london-event .header-6 .navmenu .menu-item a:hover {
                    color: #00bdf2;
                }

                .page-template-london-event .elsner-header.fixed .navmenu > .menu-item:last-child > a,
                .page-template-london-event .elsner-header.fixed .navmenu > .menu-item:last-child > a:hover,
                .page-template-london-event .elsner-header.header-2 .navmenu > .menu-item:last-child > a:hover {
                    background-color: transparent;
                    color: #00bdf2;
                }

                .page-template-london-event .elsner-header.header-6 {
                    background: #0a1a3c;
                }

                .page-template-london-event .elsner-header.header-6 .container-fluid .navbar {
                    justify-content: space-between;
                    align-items: center;
                }

                .page-template-london-event .header-6 .navbar-brand {
                    margin-right: auto;
                }

                .page-template-london-event .header-6 .navmenu .menu-item a {
                    color: #fff;
                    text-transform: uppercase;
                }

                .page-template-london-event .elsner-header.header .navmenu li a.mega-left-item {
                    color: #000;
                }

                .page-template-london-event .header-6 .navmenu > .menu-item:last-child > a {
                    border: none;
                    background: transparent;
                }

                .page-template-london-event .header-6 .navmenu > .menu-item:last-child > a:after {
                    content: unset;
                }

                .page-template-london-event .header-6 .menubtn span {
                    color: #fff;
                }

                .page-template-london-event .elsner-header.fixed .navmenu > .menu-item:last-child > a {
                    text-transform: uppercase;
                    color: #fff;
                }

                .page-template-london-event .header-6-right {
                    display: flex;
                    align-items: center;
                    margin-left: 24px;
                }

                .page-template-london-event header.elsner-header.header.header-6 {
                    background: transparent;
                }

                /* .page-template-london-event header.elsner-header.header.header-6 .container-fluid {
                    max-width: 1640px;
                } */

                .page-template-london-event header.elsner-header.header.header-6.fixed {
                    background: transparent;
                    backdrop-filter: blur(20px);
                }

                .page-template-london-event .header-6 .navmenu .menu-item:last-child > a {
                    padding: 0px;
                }

                .page-template-london-event .header-6.fixed .navmenu .menu-item:last-child > a {
                    padding: 0px;
                    min-width: auto;
                    font-size: 18px;
                    font-weight: 500;
                }
                .page-template-london-event .header-6 .navmenu .mega-menu a.industry-btn{
                    color:#fff;
                    background-color: #03497a;
                    border-radius: 10px;
                    color: #fff;
                    display: inline-block;
                    font-family: Poppins, sans-serif;
                    font-size: 18px;
                    font-weight: 500;
                    margin-top: 15px;
                    padding: 10px;
                    text-decoration: none;
                    width: -moz-max-content;
                    width: max-content;
                }
                .page-template-london-event .header-6  .navmenu .mega-menu  a{
                    color:#000;
                }
                .page-template-london-event .elsner-header.header .navmenu li a.mega-left-item.active{
                    color:#fff;
                }
                .page-template-london-event .header-6 .navmenu .mega-menu a{
                    text-transform: capitalize;
                    font-weight:500;
                }
                /* =========================================================================
                   Responsive
                   ========================================================================= */
                @media (max-width: 991px) {
                    /* .navbar-collapse is hidden until toggled open, so only
                       3 flex items remain (logo, hamburger, CTA). The
                       desktop justify-content:space-between then centers
                       the hamburger between the other two. Pack everything
                       left instead, and push the hamburger + CTA together
                       to the right edge as a pair. */
                    .page-template-london-event .elsner-header.header-6 .container-fluid .navbar {
                        justify-content: flex-start;
                    }
                  .page-template-london-event  .elsner-header ul.navmenu{
                    gap:0;
                    }
                    .page-template-london-event  .elsner-header .navmenu>.menu-item:last-child>a{
                        text-aling:left;
                    }
                    .page-template-london-event .header-6 .navbar-toggler {
                        margin-left: auto;
                    }

                    .page-template-london-event .header-6-location-bar {
                    
                        font-size: 11px;
                    }
                    .page-template-london-event .header-6 .navmenu .menu-item a{
                        color:#000;
                    }
                    .page-template-london-event .elsner-header.fixed button.navbar-toggler.collapsed span,
                    .page-template-london-event .elsner-header.header-2 button.navbar-toggler.collapsed span {
                        background: #fff;
                    }
                    .page-template-london-event .elsner-header.fixed .navmenu > .menu-item:last-child > a,
                    .page-template-london-event .header.fixed ul.navmenu > li > a{
                        color:#000;
                    }
                    .page-template-london-event .header-6-right {
                        margin-left: 12px;
                    }

                    .page-template-london-event .header-6-cta {
                        padding: 8px 14px;
                        font-size: 11px;
                    }

                    .page-template-london-event .header-6-cta span {
                        display: none;
                    }
                }

                @media (max-width: 767px) {
                    .page-template-london-event .header-5-right {
                        gap: 12px;
                    }

                    .page-template-london-event .header-5-contact {
                        display: none;
                    }

                    .page-template-london-event .header-5-cta {
                        padding: 8px 14px;
                        font-size: 11px;
                    }
                }
            </style>
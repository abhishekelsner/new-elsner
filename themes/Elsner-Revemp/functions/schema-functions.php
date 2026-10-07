<?php
//faq schema for blog & services pages
function generate_faq_schema()
{
    $faq_schema_showhide = get_field('faq_schema_showhide');
    $service_faq_schema_showhide = get_field('show_yesno');

    if ($faq_schema_showhide === true) {
        $faq_schema = array(
            "@context"    => "https://schema.org",
            "@type"       => "FAQPage",
            "mainEntity"  => array(),
        );

        // Get FAQs from ACF repeater field
        $faqs = get_field('faq_schema_repeater');

        if ($faqs) {
            foreach ($faqs as $faq) {
                $question = $faq['faq_schema_title'];
                $answer   = $faq['faq_schema_content'];

                $answer = html_entity_decode(strip_tags($answer));
                $answer = str_replace(["\n", "\r"], '', $answer);

                $faq_schema['mainEntity'][] = array(
                    "@type"           => "Question",
                    "name"            => $question,
                    "acceptedAnswer"  => array(
                        "@type" => "Answer",
                        "text"  => $answer,
                    ),
                );
            }
        }
        return $faq_schema;
    }

    // Condition 4 — Home page FAQ
    if (is_front_page() || is_home()) {
        $home_flexible_content = get_field('home');

        if ($home_flexible_content) {
            foreach ($home_flexible_content as $layout) {
                if (
                    $layout['acf_fc_layout'] === 'home_page_faq_section' &&
                    !empty($layout['home_page_show_faq']) &&
                    $layout['home_page_show_faq'] == true &&
                    !empty($layout['home_faqs'])
                ) {
                    $home_faq_schema = array(
                        "@context"   => "https://schema.org",
                        "@type"      => "FAQPage",
                        "mainEntity" => array(),
                    );

                    foreach ($layout['home_faqs'] as $faq) {
                        $question = $faq['home_faq_question'];
                        $answer = $faq['home_faq_answer'];

                        if (!$question || !$answer) continue;

                        $answer = str_replace(['<li>', '</li>', '<ul>', '</ul>', '<ol>', '</ol>'], [' ', ' ', ' ', ' ', ' ', ' '], $answer);
                        $answer = html_entity_decode(strip_tags($answer));
                        $answer = str_replace(["\n", "\r"], '', $answer);
                        $answer = preg_replace('/\s+/', ' ', $answer); 
                        $answer = trim($answer);

                        $home_faq_schema['mainEntity'][] = array(
                            "@type"          => "Question",
                            "name"           => $question,
                            "acceptedAnswer" => array(
                                "@type" => "Answer",
                                "text"  => $answer,
                            ),
                        );
                    }

                    return $home_faq_schema;
                }
            }
        }
    }

    if ($service_faq_schema_showhide === true) {
        $service_faq_schema = array(
            "@context"    => "https://schema.org",
            "@type"       => "FAQPage",
            "mainEntity"  => array(),
        );

        // Get FAQs from ACF repeater field
        $services_faqs = get_field('faq');

        if ($services_faqs) {
            foreach ($services_faqs as $service_faq) {
                $question = $service_faq['faq_question'];
                $answer   = $service_faq['faq_answer'];

                $answer = html_entity_decode(strip_tags($answer));
                $answer = str_replace(["\n", "\r"], '', $answer);

                $service_faq_schema['mainEntity'][] = array(
                    "@type"           => "Question",
                    "name"            => $question,
                    "acceptedAnswer"  => array(
                        "@type" => "Answer",
                        "text"  => $answer,
                    ),
                );
            }
        }

    return $service_faq_schema;
    }

    // Third condition — faqs_block inside flexible content (no checkbox needed)
    $flexible_content = get_field('new_services_template');

    if ($flexible_content) {
        foreach ($flexible_content as $layout) {
            if ($layout['acf_fc_layout'] === 'faqs_section' && !empty($layout['faqs_block'])) {

                $faqs_block_schema = array(
                    "@context"   => "https://schema.org",
                    "@type"      => "FAQPage",
                    "mainEntity" => array(),
                );

                foreach ($layout['faqs_block'] as $faq) {
                    $question = $faq['questions'];
                    $answer   = html_entity_decode(strip_tags($faq['answer']));
                    $answer   = str_replace(["\n", "\r"], '', $answer);

                    $faqs_block_schema['mainEntity'][] = array(
                        "@type"          => "Question",
                        "name"           => $question,
                        "acceptedAnswer" => array(
                            "@type" => "Answer",
                            "text"  => $answer,
                        ),
                    );
                }

                return $faqs_block_schema;
            }
        }
    }
}

function output_faq_schema_in_head()
{
    if ( is_home() || is_front_page() ) {
        ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Service",
                "@id": "https://www.elsner.com/#service",
                "name": "AI-Driven Web, eCommerce & Digital Services",
                "serviceType": [
                    "Web Development",
                    "eCommerce Development",
                    "Magento / Adobe Commerce",
                    "Shopify Development",
                    "WooCommerce Development",
                    "WordPress Development",
                    "Zoho Development & Integrations",
                    "Odoo ERP Development",
                    "Mobile App Development",
                    "Digital Marketing",
                    "SEO (Search Engine Optimization)",
                    "GEO (Generative Engine Optimization)",
                    "PIM/PIMcore Development"
                ],
                "url": "https://www.elsner.com/",
                "description": "Elsner Technologies provides AI-first web, eCommerce, ERP/CRM, mobile, and digital marketing services, including Magento/Adobe Commerce, Shopify, WooCommerce, WordPress, Zoho, Odoo ERP, mobile apps, SEO and GEO.",
                "areaServed": [{
                        "@type": "Country",
                        "name": "India"
                    },
                    {
                        "@type": "Country",
                        "name": "United States"
                    },
                    {
                        "@type": "Country",
                        "name": "United Arab Emirates"
                    },
                    {
                        "@type": "Country",
                        "name": "Australia"
                    }
                ],
                "availableChannel": [{
                        "@type": "ServiceChannel",
                        "serviceUrl": "https://www.elsner.com/contact-us/",
                        "serviceLocation": {
                            "@type": "Place",
                            "name": "Online",
                            "url": "https://www.elsner.com/contact-us/"
                        }
                    },
                    {
                        "@type": "ServiceChannel",
                        "servicePhone": {
                            "@type": "ContactPoint",
                            "telephone": "+91 98986 07411",
                            "contactType": "sales"
                        },
                        "serviceLocation": {
                            "@type": "Place",
                            "name": "Headquarter - India",
                            "address": {
                                "@type": "PostalAddress",
                                "streetAddress": "2nd Floor, IFFCO BHAVAN, 132 Feet Ring Rd, Shivranjani, Ayojan Nagar",
                                "addressLocality": "Ahmedabad",
                                "addressRegion": "Gujarat",
                                "postalCode": "380015",
                                "addressCountry": "IN"
                            }
                        }
                    }
                ],
                "hasOfferCatalog": {
                    "@type": "OfferCatalog",
                    "name": "Elsner Services",
                    "itemListElement": [{
                            "@type": "OfferCatalog",
                            "name": "eCommerce Solutions",
                            "itemListElement": [{
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Magento / Adobe Commerce Development",
                                        "url": "https://www.elsner.com/services/magento-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Shopify Development",
                                        "url": "https://www.elsner.com/services/shopify-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "WooCommerce Development",
                                        "url": "https://www.elsner.com/services/woocommerce-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Pimcore / PIM Development",
                                        "url": "https://www.elsner.com/services/pimcore-development/"
                                    }
                                }
                            ]
                        },
                        {
                            "@type": "OfferCatalog",
                            "name": "Web, CMS & ERP/CRM",
                            "itemListElement": [{
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "WordPress Development",
                                        "url": "https://www.elsner.com/services/wordpress-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Laravel / PHP Development",
                                        "url": "https://www.elsner.com/services/laravel-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Zoho Development & Integrations",
                                        "url": "https://www.elsner.com/services/zoho-development-services/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Odoo ERP Development",
                                        "url": "https://www.elsner.com/services/odoo-development/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "ReactJS Development",
                                        "url": "https://www.elsner.com/services/reactjs-development/"
                                    }
                                }
                            ]
                        },
                        {
                            "@type": "OfferCatalog",
                            "name": "Marketing & Growth",
                            "itemListElement": [{
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Search Engine Optimization (SEO)",
                                        "url": "https://www.elsner.com/services/seo-services/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Generative Engine Optimization (GEO)",
                                        "url": "https://www.elsner.com/services/geo-services/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "PPC Management",
                                        "url": "https://www.elsner.com/services/ppc-management/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Content Marketing",
                                        "url": "https://www.elsner.com/services/content-marketing/"
                                    }
                                },
                                {
                                    "@type": "Offer",
                                    "itemOffered": {
                                        "@type": "Service",
                                        "name": "Social Media Management",
                                        "url": "https://www.elsner.com/services/social-media-marketing/"
                                    }
                                }
                            ]
                        }
                    ]
                },
                "offers": {
                    "@type": "AggregateOffer",
                    "priceCurrency": "USD",
                    "lowPrice": "0",
                    "priceSpecification": {
                        "@type": "PriceSpecification",
                        "price": "0",
                        "priceCurrency": "USD",
                        "description": "Pricing varies by scope. Contact for a tailored quote."
                    },
                    "availability": "https://schema.org/InStock",
                    "url": "https://www.elsner.com/contact-us/"
                }
            }
        </script>
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Elsner Technologies",
            "url": "https://www.elsner.com/",
            "logo": "https://www.elsner.com/wp-content/uploads/2023/05/logo.svg",
            "description": "Elsner is a leading provider of AI-driven digital transformation services, including development, digital marketing, and business scaling. Established in 2006 by Harshal Shah, our company was born with a vision to empower and tackle the pain points of the market with smart & innovative solutions. ",
            "foundingDate": "2006",
            "founder": {
                "@type": "Person",
                "name": "Harshal Shah"
            },
            "sameAs": [
                "https://www.facebook.com/ElsnerTecnologies/",
                "https://x.com/Elsnertech",
                "https://www.instagram.com/elsnertechnologies/?hl=en",
                "https://www.youtube.com/channel/UCN32Sn_MQ1vLLo7tAloz_NA",
                "https://in.linkedin.com/company/elsner-technology-pvt--ltd-",
                "https://clutch.co/profile/elsner-technologies"

            ],
            "knowsAbout": [
                "Magento Development",
                "Shopify Development",
                "Ecommerce Development",
                "Woocommerce Development",
                "Wordpress Development",
                "Digital Makreting",
                "AI Agent Development",
                "Zoho Development",
                "Product Engineering",
                "SaaS Development"
            ]
            }
        </script>
        <?php
    }
    $combined_faq_schema = generate_faq_schema();
    if (!empty($combined_faq_schema)) {
    ?>
    <script type="application/ld+json">
     <?php echo json_encode($combined_faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
    </script>
    <?php
    }
}
add_action('wp_head', 'output_faq_schema_in_head');

add_action('wp_head', 'custom_service_schema');

function custom_service_schema() {

    function clean_address($value) {
        return trim(preg_replace('/\s+/', ' ', strip_tags($value)));
    }
    $service_pages = [
        'ppc-management-services',
        'magento-development',
        'woocommerce-development',
        'bigcommerce-development',
        'shopify-development',
        'hyva-theme-development-services',
        'adobe-commerce-development',
        'ecommerce-development',
        'pimcore-development',
        'wordpress-development',
        'zoho-development-services',
        'generative-engine-optimization-services',
        'answer-engine-optimization-services',
        'seo-services',
        'tiles-digital-transformation-solutions'
    ];
    if ( ! is_page( $service_pages ) ) {
        return;
    }
    
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "@id" =>  home_url() ."#service",
        "name" => get_the_title(),
        "url" => get_permalink(),
        "description" => get_the_excerpt(),

        "areaServed" => [
            [
                "@type" => "Place",
                "name" => clean_address(get_field('development_center_address', 'option'))
            ],
            [
                "@type" => "Place",
                "name" => clean_address(get_field('usa_address', 'option'))
            ]
        ],

        "provider" => [
            "@type" => "Organization",
            "@id" => home_url() . "#organization",
            "name" => get_bloginfo('name'),
            "url" => home_url(),
            "logo" => get_field('sticky_logo', 'option'),
            "telephone" => get_field('sales_phone_number', 'option')
        ]
    ];

    echo '<script type="application/ld+json">'
        . wp_json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        )
        . '</script>';
}
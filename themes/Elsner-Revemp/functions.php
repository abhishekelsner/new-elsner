<?php

/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */

if (!function_exists('twentytwentytwo_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since Twenty Twenty-Two 1.0
     *
     * @return void
     */
    function twentytwentytwo_support()
    {

        // Add support for block styles.
        add_theme_support('wp-block-styles');

        // Enqueue editor styles.
        add_editor_style('style.css');
    }

endif;

add_action('after_setup_theme', 'twentytwentytwo_support');

if (!function_exists('twentytwentytwo_styles')) :

    /**
     * Enqueue styles.
     *
     * @since Twenty Twenty-Two 1.0
     *
     * @return void
     */
    function twentytwentytwo_styles()
    {
        // Register theme stylesheet.
        $theme_version = wp_get_theme()->get('Version');

        $version_string = is_string($theme_version) ? $theme_version : false;
    }

endif;

add_action('wp_enqueue_scripts', 'twentytwentytwo_styles');


/**
 * Custom template tags for this theme.
 */
require_once get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require_once get_parent_theme_file_path('/inc/template-functions.php');

/**
 * SVG icons functions and filters.
 */
require_once get_parent_theme_file_path('/inc/icon-functions.php');

require_once get_parent_theme_file_path('/inc/duplicate-url-remove.php');

$functions_includes = array(
    '/global-elsner.php',
    '/partner-portal.php',
    '/enqueue-css-js.php',
    '/twentyseventeen-functions.php',
    '/elsner-shortcode.php',
    '/partner-functions.php',
    '/other-functions.php',
    '/schema-functions.php',
    '/menu-walker.php',
    '/ajax-filters.php',
);

foreach ($functions_includes as $file) {
    $filepath = locate_template('functions' . $file);
    if (!$filepath) {
        trigger_error(sprintf('Error locating /inc%s for inclusion', $file), E_USER_ERROR);
    }
    require_once $filepath;
}



// add script to head
function add_custom_head_code_script()
{
    if (is_single()) {
        global $post;
        $post_id = get_the_ID();
        $post_title = get_the_title($post_id);
        $post_url = get_permalink($post_id);
        $post_excerpt = get_the_excerpt($post_id);
        $post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');
        $post_date = get_the_date('c', $post_id);

        // Fallbacks if there's no featured image or excerpt
        if (!$post_thumbnail_url) {
            $post_thumbnail_url = 'default-image-url'; // Replace with a default image URL
        }
        if (!$post_excerpt) {
            $post_excerpt = 'Default description text.'; // Provide a fallback description
        }

        echo '<script type="application/ld+json">';
        echo '
        {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "mainEntityOfPage": {
              "@type": "WebPage",
              "@id": "' . esc_url($post_url) . '"
            },
            "headline": "' . esc_html($post_title) . '",
            "description": "' . esc_html($post_excerpt) . '",
            "image": "' . esc_url($post_thumbnail_url) . '",
            "author": {
              "@type": "Organization",
              "name": "Elsner Technologies",
              "url": "https://www.elsner.com/"
            },
            "datePublished": "' . esc_html($post_date) . '"
          }';
        echo '</script>';
    }
}
add_action('wp_head', 'add_custom_head_code_script');

function add_mailchimp_popup(){
    global $post;

// Get current slug and template name
    $current_slug = $post ? $post->post_name : '';
    $template_name = get_page_template_slug();
    // echo "<title class='sdfsdfsdf'>".$template_name."</title>";
    if ( $template_name == 'services.php' || is_author() || $template_name == 'Revamp-Template/new-service-design-2025.php' || $template_name == 'Revamp-Template/shopify-growth-plan.php' || $current_slug == 'smm-packages' || $current_slug == 'agency-web-development-solutions' || $current_slug == 'clientele-and-testimonials' || $current_slug == 'smo-packages' || $current_slug == 'not-found' || $current_slug == 'digital-marketing-packages' || $current_slug == 'solutions' || $current_slug == 'engagement-models' || $current_slug == 'life-at-elsner' || $current_slug == 'career' || $template_name == 'Revamp-Template/template-services-new.php' || $current_slug == 'seo-packages' || $current_slug == 'wordpress-development' || $current_slug == 'awards-and-accolades' || $current_slug == 'wordpress-service' || $current_slug == 'about-us' || $current_slug == 'skillsets' || $current_slug == 'thank-you' || $current_slug == 'contact-us' || $current_slug == 'team' || $current_slug == 'partners-and-alliances' ) { // for popup
    ?>
        <!-- Inline JavaScript for Popup Functionality -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Make sure Bootstrap modal function is available
                if (typeof jQuery !== "undefined" && typeof jQuery.fn.modal === "function") {
                    setTimeout(function() {
                        jQuery(".dropdown-toggle").each(function (index, element) {
                        const isLast = index === jQuery(".dropdown-toggle").length - 1;
                        jQuery(element).click();
                        if (isLast) {
                            jQuery(element).click();
                         //   console.log('clicked last element');
                        }
                        });
                        // if (jQuery(".dropdown-toggle").hasClass('show')) {
                        //     jQuery(".dropdown-toggle.show").trigger('click');
                        // }
                    }, 2000);
                }
            });
        </script>
    <?php
    }else{
        ?>
        <!-- Inline JavaScript for Popup Functionality -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Make sure Bootstrap modal function is available
                if (typeof jQuery !== "undefined" && typeof jQuery.fn.modal === "function") {
                    setTimeout(function() {
                        jQuery(".dropdown-toggle").each(function (index, element) {
                        const isLast = index === jQuery(".dropdown-toggle").length - 1;
                        jQuery(element).click();
                        // if (isLast) {
                        //     jQuery(element).click();
                        //     console.log('clicked last element');
                        // }
                        });
                        // if (jQuery(".dropdown-toggle").hasClass('show')) {
                        //     jQuery(".dropdown-toggle.show").trigger('click');
                        // }
                    }, 2000);
                }
            });
        </script>
    <?php
    }
}
add_action('wp_footer', 'add_mailchimp_popup');

//  ====== start  breadcrumb code =======

function custom_breadcrumbs()
{
    $separator = ' / ';
    $home = 'Home';

    global $post, $template;
    $template_name = basename($template);

    if (!is_front_page()) {
        global $post, $wp;

        // Get the current URL and check for specific slugs
        $current_url = home_url(add_query_arg(array(), $wp->request));
        $skip_slugs = array('about-us', 'career');
        $skip = false;

        // color class
        $excluded_slugs = array('team', 'another-slug', 'another-slug-2');
        $page_slug = $post->post_name;

        $additional_class = !in_array($page_slug, $excluded_slugs) ? 'breadcrumbs-color-change' : '';

        foreach ($skip_slugs as $slug) {
            if (strpos($current_url, '/' . $slug . '/') !== false) {
                $skip = true;
                break;
            }
        }

        if ($skip && !in_array($slug, ['about-us', 'career'])) {
            echo '<div class="container breadcrumb-wrapper"><nav class="breadcrumbs et-custom" id="breadcrumbs-custom">';
            echo '<a class="blue-color-breadcrumbs" href="' . home_url() . '">' . $home . '</a>' . $separator;
            // Only display the final part of the URL without the skipped slug
            echo get_the_title($post->ID);
            echo '</nav></div>';
        } elseif (!$skip) {
            echo '<div class="container  breadcrumb-wrapper"><nav class="breadcrumbs ' . ($template_name == 'hire-developer.php' ? 'hire-virtual-assistant-custom' : '') . ' et-custom" id="breadcrumbs-custom">';
            echo '<a class="blue-color-breadcrumbs ' . $additional_class . '" href="' . home_url() . '">' . $home . '</a><span class="' . $additional_class . '">' . $separator . '</span>';

            if (is_category() || is_single()) {
                $post_type = get_post_type($post);

                if ($post_type === 'post') {
                    echo '<a class="blue-color-breadcrumbs" href="' . home_url('/blog/') . '">Blogs</a>';
                } elseif ($post_type === 'portfolio') {
                    echo '<a class="blue-color-breadcrumbs" href="' . home_url('/our-portfolio/') . '" style="color:#000;">Portfolio</a>';
                } elseif ($post_type === 'case-study') {
                    echo '<a class="blue-color-breadcrumbs" href="' . home_url('/our-portfolio/') . '">Case Study</a>';
                } else {
                    // This else block only runs if none of the above post types match.
                    $post_type_object = get_post_type_object($post_type);
                    if ($post_type_object) {
                        echo '<a class="blue-color-breadcrumbs" href="' . home_url('/' . $post_type . '/') . '">' . $post_type_object->labels->name . '</a>';
                    }
                }

                // This part is for the single post breadcrumb, and it should run after the post type checks.
                if (is_single()) {
                    echo $separator;
                    echo '<span class="blue-color-breadcrumbs">' . get_the_title() . '</span>'; // Current page is not a link
                }
            } elseif (is_page() && !$post->post_parent) {
                echo '<span class="blue-color-breadcrumbs ' . $additional_class . ' hire-virtual-assistant-2">' . get_the_title($post->ID) . '</span>'; // Current page is not a link
            } elseif (is_page() && $post->post_parent) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<span class="blue-color-breadcrumbs">' . get_the_title($page->ID) . '</span>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) echo $crumb . $separator;
                echo '<span class="blue-color-breadcrumbs">' . get_the_title($post->ID) . '</span>'; // Current page is not a link
            } elseif (is_tag()) {
                echo '<a class="blue-color-breadcrumbs" href="#">Tag: ' . single_tag_title('', false) . '</a>';
            } elseif (is_day()) {
                echo '<a class="blue-color-breadcrumbs" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
                echo '<a class="blue-color-breadcrumbs" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $separator;
                echo '<span class="blue-color-breadcrumbs">' . get_the_time('d') . '</span>'; // Current page is not a link
            } elseif (is_month()) {
                echo '<a class="blue-color-breadcrumbs" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $separator;
                echo '<span class="blue-color-breadcrumbs">' . get_the_time('F') . '</span>'; // Current page is not a link
            } elseif (is_year()) {
                echo '<span class="blue-color-breadcrumbs">' . get_the_time('Y') . '</span>'; // Current page is not a link
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo '<span class="blue-color-breadcrumbs">Articles by ' . $userdata->display_name . '</span>'; // Current page is not a link
            } elseif (is_search()) {
                echo '<span class="blue-color-breadcrumbs">Search results for "' . get_search_query() . '"</span>'; // Current page is not a link
            } elseif (is_404()) {
                echo '<span class="blue-color-breadcrumbs">Error 404</span>'; // Current page is not a link
            }
            echo '</nav></div> ';
        }
    }
}
//  ====== End  breadcrumb code =======
//  ====== Start Code for Case Study Upload PDF =======
function custom_cf7_before_send_mail($contact_form)
{
    // Check if the submitted form matches the specific form ID (39525)
    if ($contact_form->id() == 43688) {
        // Retrieve the submitted form data
        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            // Get the posted data from the form
            $posted_data = $submission->get_posted_data();

            // Get the user's email from the posted data (assuming 'email-873' is the name of the email field in your form) comment on 19th August 2026
            // $user_email = isset($posted_data['email-873']) ? $posted_data['email-873'] : '';
            // $first_name = isset($posted_data['text-789']) ? $posted_data['text-789'] : 'there';

            //change at 19th August 2026
            $user_email = isset($posted_data['email']) ? $posted_data['email'] : '';
            $first_name = isset($posted_data['first-name']) ? $posted_data['first-name'] : 'there';
            // Get the current post ID using the form's submission referrer (fallback approach)
            $post_id = url_to_postid(wp_get_referer());

            if (!$post_id) {
                $post_id = get_the_ID(); // Fallback to the current post ID
            }

            // Retrieve the current post name
            $current_post_name = get_the_title($post_id);

            // Retrieve the custom meta field for the case study PDF URL
            $pdf_url = get_field('download_case_study_url', $post_id);
            // Retrieve the custom meta field for the case study Content
            $download_case_study_content = get_field('download_case_study_content', $post_id);
            // SEND EMAIL TO USER (IF A USER EMAIL IS PROVIDED)
            if ($user_email) {
                // Set up the email to send to the user
                $user_mail = array(
                    'to' => $user_email,
                    'subject' => 'Get Your Free Industry Guide Now!',
                    'message' => '
                        <html>
                        <body>
                        <p>Hi ' . $first_name . ',</p>
                        <p>Are you ready to unlock the secrets of ' . $current_post_name . ' success?</p>
                        <p>We have compiled a comprehensive ' . $current_post_name . ' guide that reveals the strategies and tactics used by top e-commerce businesses to maximize their sales during the busiest shopping season of the year.</p>
                        <p>' . $download_case_study_content . '</p>
                         <p>
                            <a style="display: inline-flex;
                                    align-items: center;
                                    min-width: 142px;
                                    padding: 20px 20px;
                                    background-color: #ff7700;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 5px;
                                    font-size: 16px;
                                    line-height: 0;" href="' . esc_url($pdf_url) . '">Download Case Study</a>
                        </p>
                        </body>
                        </html>
                    ',
                    'headers' => array(
                        'Content-Type: text/html; charset=UTF-8' // Ensure the email is sent as HTML
                    )
                );

                // Send the email
                wp_mail($user_email, $user_mail['subject'], $user_mail['message'], $user_mail['headers']);
            }
        }
    }
}
// Hook into Contact Form 7's 'before_send_mail' action
add_action('wpcf7_before_send_mail', 'custom_cf7_before_send_mail');
//  ====== End Code for Case Study Upload PDF =======

//  ====== Start Code for Blog Detail Page Table Content  =======

function generate_toc($content)
{
    // Ensure TOC is added only on singular post pages
    if (!is_singular(['post', 'news'])) {
        return $content;
    }

    $matches = [];
    // Find all H2 and H3 headings in the content
    preg_match_all('/<h([2-3])[^>]*>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);

    // If no headings found, return the content unmodified
    if (count($matches) === 0) {
        return $content;
    }

    // Start TOC container with a toggle button and an unordered list
    $toc = '<div class="toc blog-detail-custom-toc"><h2><button id="toc-toggle" class="toc-toggle"><span class="toc-text">Table of Contents</span><span class="toc-symbol">+</span></button></h2><ul>';

    foreach ($matches as $match) {
        $level = intval($match[1]); // Heading level (2 for H2, 3 for H3)
        $title = strip_tags($match[2]); // Extract the text from the heading
        $id = sanitize_title($title); // Create a sanitized ID for the heading

        // Add each heading text as a TOC list item (li) with a link to the heading
        $toc .= sprintf('<li><a href="#%1$s">%2$s</a></li>', $id, $title);

        // Insert the generated ID into the actual heading in the content
        $content = str_replace($match[0], '<h' . $level . ' id="' . $id . '">' . $title . '</h' . $level . '>', $content);
    }

    // Close the unordered list and TOC container
    $toc .= '</ul></div>';

    // Prepend the TOC to the content and return it
    return $toc . $content;
}
add_filter('the_content', 'generate_toc');

function enqueue_custom_toc_script()
{
    if (is_singular(['post', 'news'])) {
        wp_add_inline_script(
            'jquery',
            "
            jQuery(document).ready(function($) {
                const \$tocToggle = $('#toc-toggle');
                const \$tocContent = $('.toc ul');
                const \$tocSymbol = $('.toc-symbol');
                const \$tocLinks = $('.toc a');

                if (\$tocToggle.length && \$tocContent.length && \$tocSymbol.length) {
                    \$tocToggle.on('click', function() {
                        if (\$tocContent.css('display') === 'none' || \$tocContent.css('display') === '') {
                            \$tocContent.css('display', 'block');
                            \$tocSymbol.text('-');
                        } else {
                            \$tocContent.css('display', 'none');
                            \$tocSymbol.text('+');
                        }
                    });

                    \$tocContent.css('display', 'none');
                    \$tocSymbol.text('+');
                }

                // Smooth scroll for TOC links
                if (\$tocLinks.length) {
                    \$tocLinks.each(function() {
                        $(this).on('click', function(e) {
                            e.preventDefault();
                            const targetId = $(this).attr('href').substring(1);
                            const \$targetElement = $('#' + targetId);

                            if (\$targetElement.length) {
                                $('html, body').animate({
                                    scrollTop: \$targetElement.offset().top
                                }, 900);
                            }
                        });
                    });
                }

                // Optional: Regenerate TOC with only H2 and #faq
                const \$tocList = $('.toc ul');
                if (\$tocList.length) {
                    \$tocList.empty(); // Clear existing TOC

                    $('h2').each(function() {
                        const id = $(this).attr('id');
                        const text = $(this).text();
                        if (id) {
                            \$tocList.append('<li><a href=\"#' + id + '\">' + text + '</a></li>');
                        }
                    });

                    // Add FAQ section manually if it exists
                    if ($('#faq').length) {
                        \$tocList.append('<li><a href=\"#faq\">FAQs</a></li>');
                    }
                }
            });
            "
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_toc_script');


require_once get_parent_theme_file_path('/functions/tracking-info-functions.php');

function enforce_trailing_slash()
{
    if (is_admin()) {
        return;
    }

    $request_uri = $_SERVER['REQUEST_URI'];
    $parsed_url = parse_url($request_uri);
    $path = $parsed_url['path'];
    $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';

    // Exclude common static file types (images, CSS, JS, etc.)
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $excluded_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'css', 'js', 'ico', 'txt', 'woff', 'woff2', 'ttf', 'eot', 'otf', 'pdf', 'mp4'];

    // Also exclude specific paths like robots.txt
    $excluded_paths = ['/robots.txt', '/favicon.ico', '/ads.txt', '/sitemap.xml'];

    if (
        !in_array($path, $excluded_paths) &&
        !in_array(strtolower($ext), $excluded_extensions) &&
        substr($path, -1) !== '/'
    ) {
        $redirect_url = home_url(trailingslashit($path) . $query);
        wp_redirect($redirect_url, 301);
        exit;
    }
}
add_action('template_redirect', 'enforce_trailing_slash');

add_filter('aioseo_robots_txt', function ($output) {
    $output .= "\nLLMs: https://www.elsner.com/llms.txt";
    return $output;
});

add_action('init', function() {
    $fields = [
        '_aioseo_title',
        '_aioseo_description',
        '_aioseo_keywords',
        '_aioseo_og_title',
        '_aioseo_og_description',
        '_aioseo_twitter_title',
        '_aioseo_twitter_description'
    ];

    foreach ($fields as $f) {
        register_post_meta('post', $f, [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string'
        ]);
    }
});
function serve_webp_correctly() {
    if ( isset($_SERVER['REQUEST_URI']) && preg_match('/\.webp$/', $_SERVER['REQUEST_URI']) ) {
        header('Content-Type: image/webp');
    }
}
add_action('template_redirect', 'serve_webp_correctly', 1);

function send_email_on_first_publish($new_status, $old_status, $post) {

    // Only trigger when post is first published
    if ($old_status !== 'publish' && $new_status === 'publish' && $post->post_type === 'post') {

        // Multiple email recipients
        $recipients = array(
            'ritu@elsner.com',
            'harshal@elsner.in',
            'divya@elsner.com',
            'aadil@elsner.com'
        );

        // Email subject
        $subject = 'A new blog post has been published';

        // Email body
        $message  = "Hello,\n\nA new blog post has just been published.\n\n";
        $message .= "Title: " . $post->post_title . "\n";
        $message .= "Link: " . get_permalink($post->ID) . "\n\n";

        // Send email
        foreach ($recipients as $to) {
            wp_mail($to, $subject, $message);
        }
    }
}







//Redirecting to 410 instead of 404

add_action('parse_request', 'elsner_status_request');

function elsner_status_request() {
	
	$gone_urls = [
		'critical-flaw-in-fortnite-app-for-android-users-vulnerable-to-hackers',
        'new-wordpress-4-8-2-featuring-nine-security-fixes',
        'tele-health-solution-from-elsner',
        'a-huge-magecart-campaign-steals-data-from-magento-1-stores',
        'google-algorithm-update-may-2020',
        'why-angularjs-is-better-for-web-development',
        'sales-booster-premium-magento-extensions-free',
        'klaviyo-integration-service/5-53',
        'a-deep-dive-into-lavishing-laravel-5-3-features',
        'laravel-8-62-released-get-the-best-insights-here',
        'banking-malware-approach-risk-factor-increased-for-14-popular-apps',
        'speed-up-mobile-website-for-improved-ux',
        'hybrid-mobile-apps-googles-new-endless-expanding-app-universe',
        'checkout-laravels-5-8-exciting-new-features',
        'modern-games-development-technologies-ar-vr',
        'the-million-dollar-question-about-magento-website-development-cost',
        'best-10-reasons-for-selecting-magento-2-0-for-website-development',
        'magento-2-3-2-has-finally-released',
        'get-mcommerce-apps-and-enjoy-more-revenues',
        'how-gdpr-impacts-on-different-businesses',
        '2019/03/29/did-you-know-about-php-7-3-new-features',
        'android-o-a-complete-guide-for-the-android-users',
        'magento-extension/shipping-calculator',
        'our-partners',
        'productive-seo-practises-that-will-work-effectively-in-2018',
        'magento-2-4-1-released-everything-you-need-to-know-the-latest-version',
        'wordpress-5-3-kirk-is-released-check-out-the-updated-features',
        'seo-digital-marketing',
        'write',
        'magento-extension/magento-2-cancel-order',
        'cloud-development',
        'magento-extension/media/magento_extension/rotate/Installation_guide.pdf',
        'our-nda',
        'attachment',
        'wordpress-4-8-new-key-features-you-should-be-aware-about',
        'magento-extension/event-manager-magento-2?utm_source=Landofcoder&utm_medium=Landofcoder_review&utm_campaign=event_tickets',
        'magento-extension/shipping-per-price-magento-2?utm_source=Landofcoder&utm_medium=Landofcoder_review&utm_campaign=shipping_per_product',
        'magento-2-3-release-paving-new-opportunities-for-ecommerce-stores',
        'iphone-a-complete-guide-to-the-splendid-feature',
        'wordpress-trends-2019',
        'agora-now-superlative-human-engagement-is-possible',
        'iphone-templates',
        'magento-extension/one-step-checkout-magento-2',
        'not',
        'magento-extension/stripe-plugin',
        'magento-extension/magento-2-price-negotiation',
        'how-to-increase-google-adwords-ctr-in-2018',
        'reach-a-new-milestone-with-the-new-wordpress-5-5',
        'services/cross-platform-mobile-app-development',
        'bitcoin-wallet-app-for-mobile-payments',
        'wordpress-5-3-release-candidate-is-live-now',
        'ppc',
        'important-new-supee-10497-for-magento-open-source-1-9-1-1',
        'do-not-pay-for-ransomware-here-is-how-to-prevent-it',
        'top-10-magento-extensions-for-your-ecommerce-store',
		'the-magnificent-power-of-magento-community',
		'magento-1-support-ends-in-june-2020',
		'seo-trends-2020',
		'18-android-developer-conferences-in-2018-infographic',
		'on-page-seo-insights-for-2019',
		'reach-a-new-milestone-with-the-new-wordpress-5-5',
		'whats-new-in-laravel-5-4',
		'two-tiered-serp-relates-with-content-strategy',
		'launch-of-whatsapp-payment-option-in-india-gets-confirmed'
	];

	// Normalize the request URI: remove query string and trailing slash
    $request = rtrim(ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/'), '/');

	if (in_array($request, $gone_urls, true)) {

		// Set correct HTTP status
		status_header(410);
		nocache_headers();

		get_header();

		echo '<div class="main-wrapper">';

		echo '
		
			<section class="cms-section padding-80">
				<div class="container">
					<div class="cms-page-wrapper">
						<div class="not-found-page text-center">
							<h1>ooops!</h1>
							<h4>The page you are looking for has been permanently removed.</h4>
							<p><a class="btn btn-primary more-btn-color" href="https://www.elsner.com/">Back To Home</a></p>
							</div>
						</div>
				</div>
			</section>
		';
		get_footer();
		echo '</div>';
		exit;
	}
}

add_filter('pre_get_document_title', function($title) {
    if ( http_response_code() === 410 ) {
        return 'Page Permanently Removed';
    }
    return $title;
});

// Add checkbox in user profile
add_action('show_user_profile', 'elsner_revision_setting_field');
add_action('edit_user_profile',  'elsner_revision_setting_field');

function elsner_revision_setting_field($user) {
    $enabled = get_user_meta($user->ID, 'elsner_enable_revisions', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="elsner_enable_revisions">Enable Edit</label></th>
            <td>
                <input type="checkbox" name="elsner_enable_revisions" id="elsner_enable_revisions" value="1"
                    <?php checked($enabled, '1'); ?> />
            </td>
        </tr>
    </table>
    <?php
}

// Save user profile field
add_action('personal_options_update', 'elsner_save_revision_setting');
add_action('edit_user_profile_update', 'elsner_save_revision_setting');

function elsner_save_revision_setting($user_id) {
    if (!current_user_can('edit_user', $user_id)){
		return false;
	}

    $value = isset($_POST['elsner_enable_revisions']) ? '1' : '0';
    update_user_meta($user_id, 'elsner_enable_revisions', $value);
}

// Hide revisions if user did not enable them
add_action('admin_head', 'elsner_hide_revisions_based_on_permission');

function elsner_hide_revisions_based_on_permission() {

    $enabled = get_user_meta(get_current_user_id(), 'elsner_enable_revisions', true);

    // If enabled → do nothing
    if ($enabled === '1') {
        return;
    }

    // Hide revisions in Classic Editor
    remove_meta_box('revisionsdiv', 'post', 'normal');

    // Hide revision count link on top
    echo '
    <style>
        .misc-pub-section.misc-pub-revisions {
            display: none !important;
        }
    </style>
    ';
}


// Ajax function for  Header Search Bar
add_action('wp_ajax_elsner_mega_search', 'elsner_mega_search');
add_action('wp_ajax_nopriv_elsner_mega_search', 'elsner_mega_search');

function elsner_mega_search() {
    if (empty($_GET['q'])) {
        wp_send_json([]);
    }

    global $wpdb;

    $keyword = sanitize_text_field($_GET['q']);
    $like = '%' . $wpdb->esc_like($keyword) . '%';

    $sql = $wpdb->prepare("
        SELECT ID, post_title, post_type
        FROM {$wpdb->posts}
        WHERE post_status = 'publish'
          AND post_type IN ('post', 'page')
          AND post_title LIKE %s
        ORDER BY post_title ASC
        LIMIT 10
    ", $like);

    $posts = $wpdb->get_results($sql);

    $results = [];

    foreach ($posts as $post) {
        $results[] = [
            'title' => $post->post_title,
            'url'   => get_permalink($post->ID),
            'type'  => $post->post_type,
        ];
    }

    wp_send_json($results);
}



// function force_webp_content_type() {
//     $request_uri = $_SERVER['REQUEST_URI'];

//     if (strpos($request_uri, '.webp') !== false) {
//         header('Content-Type: image/webp');
//     }
// }
// add_action('send_headers', 'force_webp_content_type');

// AJAX handler for case study listing
function filter_portfolio_case_study_callback() {
    $term  = sanitize_text_field($_POST['term']);
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 3;

    $args = array(
        'post_type'      => array('case-study', 'portfolio'),
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );

    if ($term !== "all") {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio-technology',
                'field'    => 'slug',
                'terms'    => $term,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            
            <article class="portfolio-card">
                <div class="card-inner">
                    
                    <!-- Left Side -->
                    <div class="portfolio-thumb">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php endif; ?>
                        <?php
                        $thumb_terms = get_the_terms(get_the_ID(), 'portfolio-technology');
                        if ($thumb_terms && !is_wp_error($thumb_terms)) :
                            $first_term = $thumb_terms[0];
                        ?>
                            <span class="thumb-tag"><?php echo esc_html($first_term->name); ?></span>
                        <?php endif; ?>

                        <?php
                        $listing_details = get_field('listing_page_details', get_the_ID());
                        $bottom_text     = $listing_details['listing_page_details_bottom_text_'] ?? null;

                        if( $bottom_text ): ?>
                            <div class="thumb-bottom-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3335 5.83325H18.3335V10.8333" stroke="#00BDF2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.3332 5.83325L11.2498 12.9166L7.08317 8.74992L1.6665 14.1666" stroke="#00BDF2" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <?php echo esc_html($bottom_text); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right Side -->
                    <div class="portfolio-content">
                        <h3 class="portfolio-title"><?php the_title(); ?></h3>
                        <?php
                        $listing_details = get_field('listing_page_details', get_the_ID());
                        $client_name     = $listing_details['client_name'] ?? '';
                        ?>
                        <?php if ($client_name) : ?>
                            <div class="portfolio-meta">
                                <span class="portfolio-client">
                                    <?php echo esc_html($client_name); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="portfolio-excerpt"><?php the_content(); ?></div>

                        <?php
                        $post_id = get_the_ID();
                        $portfolio_cards = null;
                        $sections = get_field('case_study_sections', $post_id);

                        if( $sections && is_array($sections) ):
                            foreach( $sections as $section ):
                                if( $section['acf_fc_layout'] == 'about_case_study_left_right' ):
                                    $portfolio_cards = $section['cards'] ?? null;
                                    break;
                                endif;
                            endforeach;
                        endif;

                        if( $portfolio_cards && is_array($portfolio_cards) ):
                            $first_two = array_slice($portfolio_cards, 0, 3);
                        ?>
                            <div class="portfolio-stat-cards">
                                <?php foreach( $first_two as $index => $card ):
                                    $percent = $card['percent'] ?? '';
                                    $text    = $card['text'] ?? '';
                                ?>
                                    <div class="portfolio-stat-item portfolio-stat-item--<?php echo $index + 1; ?>">
                                        <?php if( $percent ): ?>
                                            <div class="portfolio-stat-percent"><?php echo esc_html($percent); ?></div>
                                        <?php endif; ?>
                                        <?php if( $text ): ?>
                                            <div class="portfolio-stat-text"><?php echo esc_html($text); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="portfolio-tags">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'case-study-tag');
                            if ($terms && !is_wp_error($terms)) :
                                foreach ($terms as $term) :
                                    echo '<span class="tag">' . esc_html($term->name) . '</span>';
                                endforeach;
                            endif;
                            ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="btn-view btn btn-primary"> View Full Case Study
                            <svg class="custom-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M10 2H14V6" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.6665 9.33333L13.9998 2" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8.66667V12.6667C12 13.0203 11.8595 13.3594 11.6095 13.6095C11.3594 13.8595 11.0203 14 10.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V5.33333C2 4.97971 2.14048 4.64057 2.39052 4.39052C2.64057 4.14048 2.97971 4 3.33333 4H7.33333" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

        <?php endwhile;
    } else {
        echo ""; // no posts
    }

    wp_die();
}
add_action('wp_ajax_filter_portfolio_case_study', 'filter_portfolio_case_study_callback');
add_action('wp_ajax_nopriv_filter_portfolio_case_study', 'filter_portfolio_case_study_callback');





// AJAX handler
function filter_news_by_category_callback() {
    if (!check_ajax_referer('news_filter_nonce', 'nonce', false)) {
        wp_send_json_error(['message' => 'Nonce verification failed']);
        return;
    }

    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $paged    = isset($_POST['paged']) ? absint($_POST['paged']) : 1; // ← new

    if (empty($category)) {
        wp_send_json_error(['message' => 'No category provided']);
        return;
    }

    $args = [
        'post_type'      => 'news',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged, // ← new
    ];

    // For "all" tab: offset by 4 already shown statically on page 1
        if ($category === 'all' && $paged >= 2) {
            // Remove 'paged', use offset instead
            unset($args['paged']);
            $args['offset'] = 4 + (($paged - 2) * 4); // page2=offset4, page3=offset8, etc.
        }

    if ($category !== 'latest' && $category !== 'all') {
        $args['tax_query'] = [[
            'taxonomy' => 'news-updates',
            'field'    => 'slug',
            'terms'    => $category,
            'include_children' => false,// this hides the childs of all
        ]];
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            ?>
            <a href="<?php the_permalink(); ?>" class="news-card">
                <div class="news-single-content-image">
                <?php if ($thumb_url) : ?>
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
                </div>
                <div class="news-card__content">
                    <h3><?php the_title(); ?></h3>
                    <p class="date"><?php echo get_the_date('F j, Y'); ?></p>
                    <div><?php the_excerpt(); ?></div>
                    <span href="<?php the_permalink(); ?>">Know More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </span>
                </div>
                </a>
            <?php
        }
        wp_reset_postdata();
    } else {
        if ($paged <= 1) {
        $label = ucfirst($category); // "News", "Events", etc.
        echo '<div class="no-posts-message"><p>No ' . esc_html($label) . ' Found.</p></div>';
        }
    }

    $html = ob_get_clean();

    // After new WP_Query(...)
    $total_posts = wp_count_posts('news-letter')->publish;
    $already_shown = 4; // static render
    $max_pages = ceil(($total_posts - $already_shown) / 4) + 1; // +1 for page 1

    wp_send_json_success([
        'html'       => $html,
        'post_count' => $query->post_count,
        'max_pages'  => $max_pages,
    ]);
}

add_action('wp_ajax_filter_news_by_category', 'filter_news_by_category_callback');
add_action('wp_ajax_nopriv_filter_news_by_category', 'filter_news_by_category_callback');

function add_defer_attribute($tag, $handle, $src) {

    $defer_scripts = array(
        'elsner-common-js',
        'elsner-custom',
        'elsner-custom-js',
        'elsner-home-js',
        'elsner-mega-menu-js',
        'news-filter',
        'portfolio-filter',
        'weekmate-custom-js'
    );

    if (in_array($handle, $defer_scripts)) {
        return '<script src="' . esc_url($src) . '" defer></script>';
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 3);

add_action('wp_enqueue_scripts', function () {

    // Only run where CF7 is actually loaded on the page
    if (!function_exists('wpcf7_enqueue_scripts')) {
        return;
    }

    $inline_js = <<<JS
    document.addEventListener('DOMContentLoaded', function () {

        // Re-enable button once CF7 finishes (success / fail / invalid)
        document.addEventListener('wpcf7submit', function (event) {
            var form = event.target;
            var button = form.querySelector('input[type="submit"], button[type="submit"]');
            if (button) {
                button.disabled = false;
            }
        }, false);

        // Disable button immediately on submit, before duplicate clicks can fire
        document.addEventListener('submit', function (event) {
            var form = event.target;
            if (form.classList && form.classList.contains('wpcf7-form')) {
                var button = form.querySelector('input[type="submit"], button[type="submit"]');
                if (button && !button.disabled) {
                    button.disabled = true;
                    // Safety fallback in case wpcf7submit never fires
                    setTimeout(function () {
                        button.disabled = false;
                    }, 8000);
                }
            }
        }, true); // capture phase

    });
    JS;

    wp_add_inline_script('contact-form-7', $inline_js);
});


// 	return $components;
// }, 10, 3);


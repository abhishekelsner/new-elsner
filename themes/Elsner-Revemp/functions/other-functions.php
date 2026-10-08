<?php
add_action('wpcf7_before_send_mail', 'add_serial_number_mail');
function add_serial_number_mail($WPCF7_ContactForm)
{
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $posted_data = $submission->get_posted_data();
        // nothing's here... do nothing...
        if (empty($posted_data))
            return;

        $mail = $WPCF7_ContactForm->prop('mail');
        $mail['subject'] = $mail['subject'] . ' #' . random_int(100000, 999999);
        // Save the email body
        $WPCF7_ContactForm->set_properties(array("mail" => $mail));
        return $WPCF7_ContactForm;
    }
}

// Add this code to your theme's functions.php file or custom plugin

function register_portfolio_tags_taxonomy()
{
    $labels = array(
        'name'              => __('Portfolio Tags'),
        'singular_name'     => __('Portfolio Tag'),
        'search_items'      => __('Search Portfolio Tags'),
        'all_items'         => __('All Portfolio Tags'),
        'edit_item'         => __('Edit Portfolio Tag'),
        'update_item'       => __('Update Portfolio Tag'),
        'add_new_item'      => __('Add New Portfolio Tag'),
        'new_item_name'     => __('New Portfolio Tag Name'),
        'menu_name'         => __('Portfolio Tags'),
    );

    $args = array(
        'hierarchical'      => false, // Set to true if you want hierarchical tags like categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'portfolio-tag'), // Customize the slug here
    );

    register_taxonomy('portfolio-tag', 'portfolio', $args);
}
add_action('init', 'register_portfolio_tags_taxonomy');

function custom_filter_wpcf7_is_tel($result, $tel)
{
    return (bool) preg_match('/^\(?\+?([0-9]{1,2})?\)?[-\. ]?(\d{10})$/', $tel);
}

add_filter('wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2);

/*To turn off updates for plugins*/
add_filter('auto_update_plugin', '__return_false');

/*To turn off updates for themes*/
add_filter('auto_update_theme', '__return_false');

function dontload()
{

    if (wp_is_mobile()) {
        if (is_page(array(5))) {
            add_filter('wpcf7_load_js', '__return_false');
            add_filter('wpcf7_load_css', '__return_false');
        }
    }
}


function recaptchaCheck()
{
    if (is_page(array(5))) {
        if (wp_is_mobile()) {
            remove_action('wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts');
        }
    }
}
function dm_remove_wp_block_library_css()
{
    if (is_page(array(5))) {
        wp_dequeue_style('wp-block-library');
    }
}
add_action('wp_enqueue_scripts', 'dm_remove_wp_block_library_css');
add_action('wp_enqueue_scripts', 'awp_remove_dashicons_on_frontend');
function awp_remove_dashicons_on_frontend()
{
    if (!is_user_logged_in()) {
        if (is_page(array(5))) {
            wp_deregister_style('dashicons');
        }
    }
}



//add_filter('wp_head', 'aioseo_filter_canonical_url');

function aioseo_filter_canonical_url($url)
{
    if (is_page(array(4320))) {
        $url = 'https://www.elsner.com/services/seo-services/';
    }
?>
<link rel="canonical" href="<?php echo $url ?>" />
<?php }

function webp_upload_mimes($existing_mimes)
{
    $existing_mimes['webp'] = 'image/webp';

    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

function webp_is_displayable($result, $path)
{
    if ($result === false) {
        $displayable_image_types = array(IMAGETYPE_WEBP);
        $info = @getimagesize($path);

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }

    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

function test_for_seo_servicepage()
{ ?>

<script type="text/javascript">
jQuery(document).ready(function(e) {
    jQuery('.whole-post').hide();
    jQuery('.contact-info a.read').on('click', function() {
        jQuery('.whole-post').toggle();
        jQuery('a.read').hide();
    });
});
</script>
<?php
}
add_action('wp_footer', 'test_for_seo_servicepage');

function prevent_cf7_multiple_emails()
{
?>

<script type="text/javascript">
var disableSubmit = false;
jQuery('.contact_us_Submit').click(function() {
    //alert("yes clicked");
    //return false;
    jQuery('.contact_us_Submit').attr('value', "Sending...");
    if (disableSubmit == true) {
        return false;
    }
    disableSubmit = true;
    return true;
})

var wpcf7Elm = document.querySelector('.wpcf7');
wpcf7Elm.addEventListener('wpcf7_before_send_mail', function(event) {
    jQuery('.contact_us_Submit').attr('value', "Sent");
    disableSubmit = false;
}, false);

wpcf7Elm.addEventListener('wpcf7invalid', function(event) {
    jQuery('.contact_us_Submit').attr('value', "Submit")
    disableSubmit = false;
}, false);
</script>
<?php
}
function add_json_to_upload_mimes($mimes)
{
    $mimes['json'] = 'text/plain';
    $mimes['ico'] = 'image/x-icon';
    return $mimes;
}
add_filter('upload_mimes', 'add_json_to_upload_mimes');
add_filter('wp_mime_type_icon', function ($icon, $mime, $post_id) {
    if ($src = false || 'image/x-icon' === $mime && $post_id > 0)
        $src = wp_get_attachment_image_src($post_id);

    return is_array($src) ? array_shift($src) : $icon;
}, 10, 3);
function add_async_forscript($url)
{
    if (strpos($url, '#asyncload') !== false) {
        if (is_admin()) {
            return str_replace('#asyncload', '', $url);
        }
        return str_replace('#asyncload', '', $url) . "' async='async";
    }

    if (strpos($url, '#defer') !== false) {
        if (is_admin()) {
            return str_replace('#defer', '', $url);
        }
        return str_replace('#defer', '', $url) . "' defer='defer";
    }

    return $url;
}
add_filter('clean_url', 'add_async_forscript', 11, 1);

// add_filter('style_loader_tag',  'preload_filter', 10, 2);
// function preload_filter($html, $handle)
// {
//     if (strcmp($handle, 'elsner-base') == 0) {
//         $html = str_replace("rel='stylesheet'", "rel='preload' as='style' ", $html);
//     }

//     if (strcmp($handle, 'elsner-home') == 0) {
//         $html = str_replace("rel='stylesheet'", "rel='preload' as='style' ", $html);
//     }
//     return $html;
// }
add_filter('use_block_editor_for_post', '__return_false');
function enable_featured_images_for_event()
{
    add_theme_support('post-thumbnails', array('event'));
}
add_action('after_setup_theme', 'enable_featured_images_for_event');

function custom_excerpt_length($length)
{
    return 20;
}
function custom_excerpt_length_portfolio($length)
{
    return 45;
}

function remove_excerpt_ellipsis($more)
{
    return '...';
}
add_filter('excerpt_more', 'remove_excerpt_ellipsis');
add_filter('show_advanced_plugins', 'f711_hide_advanced_plugins', 10, 2);

function f711_hide_advanced_plugins($default, $type)
{
    if ($type == 'mustuse') return false; // Hide Must-Use
    return $default;
}


add_action('wp_ajax_set_exit_url_in_session', 'set_exit_url_in_session');
add_action('wp_ajax_nopriv_set_exit_url_in_session', 'set_exit_url_in_session');

function set_exit_url_in_session()
{
    // Start the session to use $_SESSION
    session_start();

    // Check if the exit_url is passed via AJAX
    if (isset($_POST['exit_url'])) {
        $_SESSION['exit_url'] = sanitize_text_field($_POST['exit_url']);
    }

    // Send the URL back as part of the response for redirection
    wp_send_json_success(array('exit_url' => $_SESSION['exit_url']));
}

add_action('wp_footer', 'mycustosm_wp_footer');
function mycustosm_wp_footer()
{
    $current_slug = get_post_field('post_name', get_post());

    // Set default thank-you page
    $redirect_url = 'https://www.elsner.com/thank-you/';

    // If current slug is 'ecommerce-website-design', change the thank-you URL
    if ($current_slug === 'ecommerce-website-design' || $current_slug === 'wordpress-website-development') {
        $redirect_url = 'https://www.elsner.com/lp-thank-you/';
    }
    elseif ($current_slug === 'career') { // <-- change 'career' to your actual page slug
        $redirect_url = 'https://www.elsner.com/career-thank-you/';
    }

    if (
        is_singular('case-study') ||
        is_singular('product') ||
        is_page('weekmate')
    ) {
        // For these pages, do not redirect. Just show response message.
    ?>
<script type="text/javascript">
document.addEventListener('wpcf7submit', function(event) {
    if (event.detail.status === 'mail_sent') {
        var responseDiv = event.target.querySelector('.wpcf7-response-output');
        if (responseDiv) {
            responseDiv.style.setProperty('display', 'block', 'important');
        }
    }
}, false);
</script>
<?php
        return;
    }
    ?>

<script type="text/javascript">
var redirectUrl = '<?php echo esc_url($redirect_url); ?>';

document.addEventListener('wpcf7submit', function(event) {
    if (event.detail.status === 'mail_sent') {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        var params = 'action=set_exit_url_in_session&exit_url=' + encodeURIComponent(redirectUrl);
        console.log("Redirect URL set:", params);

        xhr.send(params);

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success && response.data.exit_url) {
                    window.location.href = response.data.exit_url;
                }
            }
        };
    }
}, false);
</script>
<?php
}



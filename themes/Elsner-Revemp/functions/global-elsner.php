<?php
function load_global()
{
    global $favicon, $logo, $dark_logo, $menu_group, $sticky_logo, $contact_form, $sales_phone_number, $sales_email_address, $skype_id, $partners, $address, $facebook, $instagram, $linekdin, $google, $twitter, $pinterest, $youtube, $contact_us_link, $usa_address, $github;

    $favicon                = get_template_directory_uri() . '/assets/favicon.ico';
    $logo                   = get_field('light_logo', 'option');
    $dark_logo              = get_field('dark_logo', 'option');
    $menu_group             = get_field('menu_group', 'option');
    $sticky_logo            = get_field('sticky_logo', 'option');
    $contact_form           = get_field('form_shortcode', 'option');
    $sales_phone_number     = get_field('sales_phone_number', 'option');
    $sales_email_address    = get_field('sales_email_address', 'option');
    $skype_id               = get_field('skype_id', 'option');
    $partners               = get_field('elsner_parners', 'option');
    $address                = get_field('development_center_address', 'option');
    $usa_address            = get_field('usa_address', 'option');
    $facebook               = get_field('facebook', 'option');
    $instagram              = get_field('instagram', 'option');
    $linekdin               = get_field('linkedin', 'option');
    $twitter                = get_field('twitter', 'option');
    $google                 = get_field('google', 'option');
    $pinterest              = get_field('pinterest', 'option');
    $youtube                = get_field('youtube', 'option');
    $contact_us_link        = get_field('cta_talk_to_us', 'option');
    $github                 = get_field('github', 'option');
}

// Call the function to set the global variables
if(!is_admin())
	load_global();


// register sidebar menu
function register_my_menus()
{
    register_nav_menus(
        array(
            'sidebar-menu' => __('Sidebar Menu'),
            'footer-menu' => __('Footer Menu'),
            'header-secondmenu' => __('Header Second Menu')
        )
    );
}
add_action('init', 'register_my_menus');

function get_the_content_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());

    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time;
}
function get_headings($content)
{
    $headings = array();
    $pattern = '/<h([1-3])[^>]*>(?:<[^>]+>)?(.*?)<\/h[1-3]>/i';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $title = strip_tags($match[2]);
        $headings[] = array(
            'id' => sanitize_title($title),
            'title' => $title
        );
    }

    return $headings;
}
function add_ids_to_headings($content)
{
    $dom = new DOMDocument;
    if (!empty($content)) {
        $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    }
    $headings = $dom->getElementsByTagName('h1');
    foreach ($headings as $heading) {
        $id = sanitize_title($heading->nodeValue);
        $heading->setAttribute('id', $id);
    }
    $headings = $dom->getElementsByTagName('h2');
    foreach ($headings as $heading) {
        $id = sanitize_title($heading->nodeValue);
        $heading->setAttribute('id', $id);
    }
    $headings = $dom->getElementsByTagName('h3');
    foreach ($headings as $heading) {
        $id = sanitize_title($heading->nodeValue);
        $heading->setAttribute('id', $id);
    }
    return $dom->saveHTML();
}
function add_cache_control_headers()
{
    $expires = 31536000;
    header("Cache-Control: public, max-age=$expires");
}
//add_action('send_headers', 'add_cache_control_headers');
function add_etags($headers)
{
    $file_path = get_stylesheet_directory() . $_SERVER['REQUEST_URI'];
    if (file_exists($file_path)) {
        $headers['ETag'] = md5_file($file_path);
    }
    return $headers;
}
add_filter('wp_headers', 'add_etags');
function add_svg_cache_control_headers($headers, $url)
{
    if (is_string($url) && pathinfo($url, PATHINFO_EXTENSION) === 'svg') {
        $expires = 31536000; // Set the expiration time in seconds (one year in this example)
        $headers['Cache-Control'] = 'public, max-age=' . $expires;
    }
    return $headers;
}
add_filter('wp_headers', 'add_svg_cache_control_headers', 10, 2);
function move_scripts_to_footer()
{
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action('wp_enqueue_scripts', 'move_scripts_to_footer');
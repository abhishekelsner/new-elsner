<?php
/**
 * PHPUnit / Test Suite Bootstrap for WordPress Theme and Plugins.
 * Provides clean in-memory mocks for WordPress core and ACF functions.
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__DIR__) . '/');
}

if (!defined('IMAGETYPE_WEBP')) {
    define('IMAGETYPE_WEBP', 18);
}

// Global in-memory storage for test isolation
global $wp_test_options, $wp_test_filters, $wp_test_actions, $wp_test_post_meta, $wp_test_theme_mods;
$wp_test_options    = array();
$wp_test_filters    = array();
$wp_test_actions    = array();
$wp_test_post_meta  = array();
$wp_test_theme_mods = array();

// Hook functions
function add_action($tag, $callback, $priority = 10, $accepted_args = 1) {
    global $wp_test_actions;
    $wp_test_actions[$tag][] = $callback;
    return true;
}

function do_action($tag, ...$args) {
    global $wp_test_actions;
    if (!empty($wp_test_actions[$tag])) {
        foreach ($wp_test_actions[$tag] as $callback) {
            if (is_callable($callback)) {
                call_user_func_array($callback, $args);
            }
        }
    }
}

function add_filter($tag, $callback, $priority = 10, $accepted_args = 1) {
    global $wp_test_filters;
    $wp_test_filters[$tag][] = $callback;
    return true;
}

function apply_filters($tag, $value, ...$args) {
    global $wp_test_filters;
    if (!empty($wp_test_filters[$tag])) {
        foreach ($wp_test_filters[$tag] as $callback) {
            if (is_callable($callback)) {
                $value = call_user_func_array($callback, array_merge(array($value), $args));
            }
        }
    }
    return $value;
}

function remove_action($tag, $callback, $priority = 10) {
    return true;
}

function remove_filter($tag, $callback, $priority = 10) {
    return true;
}

// Option functions
function get_option($key, $default = false) {
    global $wp_test_options;
    return isset($wp_test_options[$key]) ? $wp_test_options[$key] : $default;
}

function update_option($key, $value) {
    global $wp_test_options;
    $wp_test_options[$key] = $value;
    return true;
}

function delete_option($key) {
    global $wp_test_options;
    unset($wp_test_options[$key]);
    return true;
}

// Sanitization & Formatting
function sanitize_text_field($str) {
    return is_string($str) ? trim(strip_tags($str)) : '';
}

function sanitize_textarea_field($str) {
    return is_string($str) ? trim(strip_tags($str)) : '';
}

function sanitize_title($title, $fallback_title = '', $context = 'save') {
    $title = strip_tags($title);
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $title);
    $title = preg_replace('/&.+?;/', '', $title);
    $title = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
    return empty($title) ? $fallback_title : $title;
}

function absint($val) {
    return abs(intval($val));
}

function esc_html($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

function esc_attr($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

function esc_url($url) {
    return filter_var($url, FILTER_SANITIZE_URL) ?: '';
}

function esc_textarea($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

function wp_strip_all_tags($string, $remove_breaks = false) {
    $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
    $string = strip_tags($string);
    return trim($string);
}

function wp_parse_args($args, $defaults = array()) {
    if (is_object($args)) {
        $r = get_object_vars($args);
    } elseif (is_array($args)) {
        $r = &$args;
    } else {
        $r = array();
    }
    if (is_array($defaults)) {
        return array_merge($defaults, $r);
    }
    return $r;
}

// Translation helpers
function __($text, $domain = 'default') {
    return $text;
}

function _e($text, $domain = 'default') {
    echo $text;
}

function esc_html__($text, $domain = 'default') {
    return esc_html($text);
}

function esc_attr__($text, $domain = 'default') {
    return esc_attr($text);
}

function esc_attr_e($text, $domain = 'default') {
    echo esc_attr($text);
}

function esc_html_e($text, $domain = 'default') {
    echo esc_html($text);
}

function _n($single, $plural, $number, $domain = 'default') {
    return 1 === (int)$number ? $single : $plural;
}

// Error class
class WP_Error {
    public $errors = array();
    public $error_data = array();

    public function __construct($code = '', $message = '', $data = '') {
        if (!empty($code)) {
            $this->errors[$code][] = $message;
            if (!empty($data)) {
                $this->error_data[$code] = $data;
            }
        }
    }

    public function get_error_message($code = '') {
        if (empty($code)) {
            $code = key($this->errors);
        }
        return isset($this->errors[$code][0]) ? $this->errors[$code][0] : '';
    }

    public function get_error_code() {
        return key($this->errors);
    }
}

function is_wp_error($thing) {
    return ($thing instanceof WP_Error);
}

// Post & Query stubs
class WP_Post {
    public $ID = 1;
    public $post_title = 'Sample Post';
    public $post_name = 'sample-post';
    public $post_type = 'post';
    public $post_content = 'Sample content';
    public $post_status = 'publish';

    public function __construct($data = array()) {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
    }
}

class WP_Query {
    public $posts = array();
    public $post_count = 0;
    public $current_post = -1;
    public $post = null;

    public function __construct($args = array()) {
        $this->posts = array(
            new WP_Post(array('ID' => 101, 'post_title' => 'Sample Portfolio 1', 'post_name' => 'sample-portfolio-1', 'post_type' => 'portfolio')),
            new WP_Post(array('ID' => 102, 'post_title' => 'Sample Portfolio 2', 'post_name' => 'sample-portfolio-2', 'post_type' => 'portfolio'))
        );
        $this->post_count = count($this->posts);
    }

    public function have_posts() {
        return ($this->current_post + 1) < $this->post_count;
    }

    public function the_post() {
        $this->current_post++;
        $this->post = $this->posts[$this->current_post];
        $GLOBALS['post'] = $this->post;
        return $this->post;
    }
}

function get_posts($args = array()) {
    return array(
        new WP_Post(array('ID' => 1, 'post_title' => 'Test Post 1', 'post_name' => 'test-post-1', 'post_type' => isset($args['post_type']) ? $args['post_type'] : 'post')),
        new WP_Post(array('ID' => 2, 'post_title' => 'Test Post 2', 'post_name' => 'test-post-2', 'post_type' => isset($args['post_type']) ? $args['post_type'] : 'post'))
    );
}

function get_post_field($field, $post_id) {
    return 'test-post-slug';
}

function get_the_title($post_id = 0) {
    return 'Test Post Title';
}

function get_the_ID() {
    global $post;
    return isset($post->ID) ? $post->ID : 101;
}

function the_permalink(...$args) {
    echo 'https://example.com/post-permalink/';
}

function the_title(...$args) {
    $before = isset($args[0]) ? $args[0] : '';
    $after  = isset($args[1]) ? $args[1] : '';
    $echo   = isset($args[2]) ? $args[2] : true;
    $title  = $before . 'Sample Post Title' . $after;
    if ($echo) {
        echo $title;
    }
    return $title;
}

function the_post_thumbnail(...$args) {
    echo '<img src="https://example.com/thumb.jpg" alt="thumb" />';
}

function the_post_thumbnail_url(...$args) {
    echo 'https://example.com/thumb.jpg';
    return 'https://example.com/thumb.jpg';
}

function get_the_post_thumbnail_url(...$args) {
    return 'https://example.com/thumb.jpg';
}

function has_post_thumbnail(...$args) {
    return true;
}

function wp_reset_postdata(...$args) {
    return true;
}

function get_post_mime_type(...$args) {
    return 'image/jpeg';
}

function wp_get_attachment_metadata(...$args) {
    return array('sizes' => array('large' => array('file' => 'large-test.jpg')));
}

function get_attached_file(...$args) {
    return sys_get_temp_dir() . '/test-image.jpg';
}

function wp_list_pluck($list, $field) {
    $result = array();
    foreach ($list as $item) {
        if (is_object($item) && isset($item->$field)) {
            $result[] = $item->$field;
        } elseif (is_array($item) && isset($item[$field])) {
            $result[] = $item[$field];
        }
    }
    return $result;
}

function get_the_terms(...$args) {
    $t1 = new stdClass();
    $t1->term_id = 1;
    $t1->name = 'WordPress';
    $t1->slug = 'wordpress';
    return array($t1);
}

function get_the_category(...$args) {
    $cat = new stdClass();
    $cat->term_id = 5;
    $cat->name = 'Technology';
    $cat->slug = 'technology';
    return array($cat);
}

function get_the_author(...$args) {
    return 'Admin';
}

function get_the_author_meta(...$args) {
    return 1;
}

function get_author_posts_url(...$args) {
    return 'https://example.com/author/admin/';
}

function get_the_time(...$args) {
    return 1728000000;
}

function get_the_modified_time(...$args) {
    return 1728000000;
}

function get_the_modified_date(...$args) {
    $format = isset($args[0]) ? $args[0] : 'Y-m-d';
    return date($format);
}

function get_permalink(...$args) {
    return 'https://example.com/sample-post/';
}

function get_the_date(...$args) {
    $format = !empty($args[0]) ? $args[0] : 'Y-m-d';
    return date($format);
}

// Taxonomy & Post Type registration stubs
function register_taxonomy($taxonomy, $object_type, $args = array()) {
    return true;
}

function register_post_type($post_type, $args = array()) {
    return true;
}

function load_theme_textdomain($domain, $path = false) { return true; }
function add_theme_support($feature, ...$args) { return true; }
function register_nav_menus($locations = array()) { return true; }
function add_image_size($name, $width = 0, $height = 0, $crop = false) { return true; }
function add_editor_style($stylesheet = 'editor-style.css') { return true; }

// Theme Conditionals & Helpers
function is_admin(...$args) { return false; }
function is_multi_author(...$args) { return true; }
function is_singular(...$args) { return false; }
function is_customize_preview(...$args) { return false; }
function is_front_page(...$args) { return true; }
function is_home(...$args) { return false; }
function is_page(...$args) { return false; }
function is_archive(...$args) { return false; }
function is_404(...$args) { return false; }
function wp_is_mobile(...$args) { return false; }
function is_user_logged_in(...$args) { return true; }
function has_header_image(...$args) { return true; }
function is_active_sidebar(...$args) { return true; }

function get_theme_mod($name, $default = false) {
    global $wp_test_theme_mods;
    return isset($wp_test_theme_mods[$name]) ? $wp_test_theme_mods[$name] : $default;
}

function set_theme_mod($name, $value) {
    global $wp_test_theme_mods;
    $wp_test_theme_mods[$name] = $value;
}

function get_header_textcolor() { return '000000'; }
function get_stylesheet_directory() { return dirname(__DIR__) . '/themes/Elsner-Revemp'; }
function get_template_directory() { return dirname(__DIR__) . '/themes/Elsner-Revemp'; }
function get_template_directory_uri() { return 'https://example.com/wp-content/themes/Elsner-Revemp'; }
function get_parent_theme_file_path($file = '') { return dirname(__DIR__) . '/themes/Elsner-Revemp' . $file; }
function site_url($path = '') { return 'https://example.com' . $path; }
function home_url($path = '') { return 'https://example.com/' . ltrim($path, '/'); }
function trailingslashit($string) { return rtrim($string, '/\\') . '/'; }

// HTTP & Remote
global $wp_test_remote_response;
$wp_test_remote_response = array('code' => 200, 'body' => '{"content":[{"text":"Generated alt text description"}]}');

function wp_remote_post($url, $args = array()) {
    global $wp_test_remote_response;
    return $wp_test_remote_response;
}

function wp_remote_retrieve_response_code($res) {
    return is_array($res) && isset($res['code']) ? $res['code'] : 200;
}

function wp_remote_retrieve_body($res) {
    return is_array($res) && isset($res['body']) ? $res['body'] : '';
}

function wp_json_encode($data, $options = 0) {
    return json_encode($data, $options);
}

// Nonce, Auth & User Capabilities
function wp_verify_nonce($nonce, $action = -1) { return true; }
function check_ajax_referer($action = -1, $query_arg = false, $die = true) { return true; }
function current_user_can($capability, ...$args) { return true; }

// AJAX stubs
function wp_send_json_success($data = null) {
    return array('success' => true, 'data' => $data);
}

function wp_send_json_error($data = null) {
    return array('success' => false, 'data' => $data);
}

function wp_die($message = '') {
    return $message;
}

function add_management_page($page_title, $menu_title, $capability, $menu_slug, $callback = '') {}
function wp_nonce_field($action = -1, $name = '_wpnonce', $referer = true, $echo = true) {
    $html = '<input type="hidden" name="' . esc_attr($name) . '" value="test_nonce" />';
    if ($echo) { echo $html; }
    return $html;
}
function get_post_types($args = array(), $output = 'names') {
    $pts = array('post' => 'Posts', 'page' => 'Pages', 'portfolio' => 'Portfolios');
    if ($output === 'objects') {
        $objs = array();
        foreach ($pts as $slug => $label) {
            $objs[$slug] = (object) array('name' => $slug, 'labels' => (object) array('singular_name' => $label));
        }
        return $objs;
    }
    return array_keys($pts);
}
function nocache_headers() {}
function selected($selected, $current = true, $echo = true) {
    $res = ((string)$selected === (string)$current) ? ' selected="selected"' : '';
    if ($echo) { echo $res; }
    return $res;
}
function submit_button(...$args) { echo '<input type="submit" />'; }
function settings_fields(...$args) {}
function register_setting(...$args) {}
function add_options_page(...$args) {}
function add_media_page(...$args) {}
function admin_url(...$args) { return 'https://example.com/wp-admin/' . (isset($args[0]) ? ltrim($args[0], '/') : ''); }

function add_shortcode(...$args) { return true; }
function register_activation_hook(...$args) { return true; }
function size_format(...$args) { return '10 MB'; }
function get_page_by_path(...$args) { return null; }
function the_field(...$args) { echo 'Sample Field Value'; }
function get_the_content(...$args) { return 'This is sample content for testing shortcodes.'; }
function wp_trim_words($text, $num_words = 55, $more = null) {
    $words = explode(' ', $text);
    return implode(' ', array_slice($words, 0, $num_words)) . ($more ?: '...');
}
function have_rows(...$args) { return false; }
function the_row(...$args) { return false; }
function get_sub_field(...$args) { return ''; }

if (!defined('OBJECT')) {
    define('OBJECT', 'OBJECT');
}

function wp_max_upload_size() { return 10485760; }
require_once dirname(__DIR__) . '/themes/Elsner-Revemp/functions/twentyseventeen-functions.php';
function get_terms($args = array(), $deprecated = '') {
    $t = new stdClass();
    $t->term_id = 1;
    $t->name = 'Main Menu';
    $t->slug = 'main-menu';
    return array($t);
}

// ACF stubs
function get_fields($post_id = false) {
    return array(
        'hero_title' => 'Hello World Title',
        'hero_desc'  => 'Hero description text',
        'cta_link'   => 'https://example.com/contact'
    );
}

function get_field($selector, $post_id = false, $format_value = true) {
    if (in_array($selector, array('enable_mega_menu', 'enable_industries_mega', 'enable_resource_mega', 'faq_schema_showhide', 'show_yesno', 'home', 'new_services_template'), true)) {
        return false;
    }
    $fields = get_fields($post_id);
    return isset($fields[$selector]) ? $fields[$selector] : 'Sample Field Value';
}

function get_field_object($selector, $post_id = false) {
    return array(
        'key'   => 'field_12345',
        'label' => ucwords(str_replace('_', ' ', $selector)),
        'name'  => $selector,
        'type'  => 'text'
    );
}

function update_field($selector, $value, $post_id = false) {
    return true;
}

function acf_get_field_groups($args = array()) {
    return array(
        array(
            'key'      => 'group_hero_section',
            'title'    => 'Hero Section Group',
            'location' => array(array(array('param' => 'options_page')))
        )
    );
}

function acf_get_field_group($key) {
    return array('key' => $key, 'title' => 'Hero Section Group');
}

function acf_get_fields($parent) {
    return array(
        array('key' => 'field_1', 'label' => 'Hero Title', 'name' => 'hero_title', 'type' => 'text'),
        array('key' => 'field_2', 'label' => 'Hero Desc', 'name' => 'hero_desc', 'type' => 'textarea')
    );
}

function acf_add_options_page($args = array()) {
    return true;
}

// Nav Menu Walker base stub
class Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {}
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {}
}

class acf_field {
    public $name = '';
    public $label = '';
    public $category = '';
    public $defaults = array();
    public function __construct() {}
}

function update_user_meta($user_id, $meta_key, $meta_value, $prev_value = '') { return true; }
function get_current_user_id() { return 1; }

// User / Ultimate Member stubs
function um_user($data) { return 1; }
function UM() {
    return new class {
        public function builtin() {
            return new class {
                public function get_specific_field($name) { return array('title' => $name); }
            };
        }
        public function fields() {
            return new class {
                public function edit_field($key, $data) { return '<input name="' . $key . '" />'; }
            };
        }
    };
}

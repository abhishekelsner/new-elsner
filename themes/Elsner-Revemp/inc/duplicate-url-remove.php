<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ─────────────────────────────────────────────
//  HELPERS
// ─────────────────────────────────────────────

function sdr_get_protected_urls() {
    $raw   = get_option( 'sdr_duplicate_urls', '' );
    $lines = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );
    $urls  = array();
    foreach ( $lines as $line ) {
        $norm = sdr_normalise( $line );
        if ( $norm ) {
            $urls[] = $norm;
        }
    }
    return array_unique( $urls );
}

function sdr_normalise( $url ) {
    $url = trim( $url );
    $url = strtolower( $url );
    $url = strtok( $url, '?' );
    $url = strtok( $url, '#' );
    if ( ! empty( $url ) ) {
        $url = rtrim( $url, '/' ) . '/';
    }
    return $url;
}

/**
 * Remove duplicate <url> blocks from raw XML string.
 * Keeps first occurrence of each protected URL, removes the rest.
 */
function sdr_deduplicate_xml( $xml ) {
    $protected = sdr_get_protected_urls();
    if ( empty( $protected ) || empty( $xml ) ) {
        return $xml;
    }

    $seen = array();

    $xml = preg_replace_callback(
        '/<url>[\s\S]*?<\/url>/i',
        function( $matches ) use ( $protected, &$seen ) {
            $block = $matches[0];

            if ( ! preg_match( '/<loc>\s*(.*?)\s*<\/loc>/i', $block, $loc_m ) ) {
                return $block;
            }

            $loc = sdr_normalise( html_entity_decode( trim( $loc_m[1] ) ) );

            if ( ! in_array( $loc, $protected, true ) ) {
                return $block;
            }

            if ( isset( $seen[ $loc ] ) ) {
                return ''; // strip duplicate
            }

            $seen[ $loc ] = true;
            return $block;
        },
        $xml
    );

    return $xml;
}


// ─────────────────────────────────────────────
//  LAYER 1 — Output buffer (catches everything)
//  Fires on any request URL containing sitemap
// ─────────────────────────────────────────────

add_action( 'init', 'sdr_intercept_sitemap_request', 1 );
function sdr_intercept_sitemap_request() {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';

    $is_sitemap =
        ( strpos( $uri, 'sitemap' ) !== false && strpos( $uri, '.xml' ) !== false ) ||
        isset( $_GET['sitemap'] ) ||
        isset( $_GET['sitemap_n'] );

    if ( $is_sitemap ) {
        ob_start();
        add_action( 'shutdown', 'sdr_shutdown_filter', 0 );
    }
}

function sdr_shutdown_filter() {
    $output = ob_get_clean();
    if ( empty( $output ) ) {
        return;
    }
    if ( strpos( $output, '<urlset' ) !== false || strpos( $output, '<sitemapindex' ) !== false ) {
        $output = sdr_deduplicate_xml( $output );
    }
    echo $output;
}


// ─────────────────────────────────────────────
//  LAYER 2 — AIOSEO specific filters
// ─────────────────────────────────────────────

// Filter the full URLs array AIOSEO builds
add_filter( 'aioseo_sitemap_urls', 'sdr_filter_aioseo_urls_array', 99 );
function sdr_filter_aioseo_urls_array( $urls ) {
    if ( empty( $urls ) || ! is_array( $urls ) ) {
        return $urls;
    }
    $protected = sdr_get_protected_urls();
    if ( empty( $protected ) ) {
        return $urls;
    }

    $seen   = array();
    $result = array();
    foreach ( $urls as $entry ) {
        $loc = '';
        if ( is_array( $entry ) && ! empty( $entry['loc'] ) ) {
            $loc = sdr_normalise( $entry['loc'] );
        } elseif ( is_string( $entry ) ) {
            $loc = sdr_normalise( $entry );
        }

        if ( $loc && in_array( $loc, $protected, true ) ) {
            if ( isset( $seen[ $loc ] ) ) {
                continue; // skip duplicate
            }
            $seen[ $loc ] = true;
        }
        $result[] = $entry;
    }
    return $result;
}

// Filter individual AIOSEO URL entry
add_filter( 'aioseo_sitemap_url', 'sdr_filter_aioseo_single_url', 99, 2 );
function sdr_filter_aioseo_single_url( $url_data, $object ) {
    static $seen = array();
    if ( empty( $url_data ) || empty( $url_data['loc'] ) ) {
        return $url_data;
    }
    $protected = sdr_get_protected_urls();
    $loc = sdr_normalise( $url_data['loc'] );
    if ( in_array( $loc, $protected, true ) ) {
        if ( isset( $seen[ $loc ] ) ) {
            return false;
        }
        $seen[ $loc ] = true;
    }
    return $url_data;
}


// ─────────────────────────────────────────────
//  LAYER 3 — WP Core sitemap filters (fallback)
// ─────────────────────────────────────────────

add_filter( 'wp_sitemaps_posts_entry',      'sdr_filter_wp_core_entry', 99, 3 );
add_filter( 'wp_sitemaps_taxonomies_entry', 'sdr_filter_wp_core_entry', 99, 3 );
add_filter( 'wp_sitemaps_users_entry',      'sdr_filter_wp_core_entry', 99, 2 );
function sdr_filter_wp_core_entry( $entry, $item, $post_type = '' ) {
    static $seen = array();
    if ( empty( $entry['loc'] ) ) {
        return $entry;
    }
    $protected = sdr_get_protected_urls();
    $loc = sdr_normalise( $entry['loc'] );
    if ( in_array( $loc, $protected, true ) ) {
        if ( isset( $seen[ $loc ] ) ) {
            return false;
        }
        $seen[ $loc ] = true;
    }
    return $entry;
}


// ─────────────────────────────────────────────
//  ADMIN MENU & SETTINGS PAGE
// ─────────────────────────────────────────────

add_action( 'admin_menu', 'sdr_add_admin_menu' );
function sdr_add_admin_menu() {
    add_options_page(
        'Sitemap Duplicate Remover',
        'Sitemap Duplicates',
        'manage_options',
        'sitemap-duplicate-remover',
        'sdr_settings_page'
    );
}

add_action( 'admin_init', 'sdr_register_settings' );
function sdr_register_settings() {
    register_setting( 'sdr_settings_group', 'sdr_duplicate_urls', array(
        'sanitize_callback' => 'sdr_sanitize_urls',
        'default'           => '',
    ) );
}

function sdr_sanitize_urls( $input ) {
    $lines = explode( "\n", $input );
    $clean = array();
    foreach ( $lines as $line ) {
        $norm = sdr_normalise( $line );
        if ( ! empty( $norm ) && filter_var( $norm, FILTER_VALIDATE_URL ) ) {
            $clean[] = $norm;
        }
    }
    return implode( "\n", array_unique( $clean ) );
}

function sdr_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Test URL tool
    $test_result = '';
    if ( isset( $_POST['sdr_test_url'] ) && check_admin_referer( 'sdr_test_nonce' ) ) {
        $test_url  = sdr_normalise( sanitize_text_field( $_POST['sdr_test_url'] ) );
        $protected = sdr_get_protected_urls();
        $test_result = in_array( $test_url, $protected, true )
            ? '<p style="color:#00a32a;font-weight:600;">✅ Protected — duplicates of this URL WILL be removed from the sitemap.</p>'
            : '<p style="color:#cc1818;font-weight:600;">❌ Not protected — add this URL to the list above to protect it.</p>';
    }

    $saved    = get_option( 'sdr_duplicate_urls', '' );
    $url_list = array_filter( array_map( 'trim', explode( "\n", $saved ) ) );
    $aioseo   = class_exists( 'AIOSEO\Plugin\AIOSEO' ) || defined( 'AIOSEO_VERSION' );
    ?>
    <div class="wrap">
        <h1>🗺️ Sitemap Duplicate URL Remover
            <span style="font-size:12px;font-weight:400;background:#00a32a;color:#fff;padding:2px 10px;border-radius:20px;vertical-align:middle;margin-left:8px;">v2.0 Active</span>
        </h1>
        <p style="color:#555;max-width:680px;">Add URLs below that appear multiple times in your sitemap. The plugin will keep only the first occurrence and remove all extras.</p>

        <?php settings_errors( 'sdr_settings_group' ); ?>

        <!-- Stats -->
        <div style="display:flex;gap:12px;margin:16px 0 24px;flex-wrap:wrap;">
            <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:12px 24px;text-align:center;">
                <div style="font-size:30px;font-weight:700;color:#2271b1;"><?php echo count( $url_list ); ?></div>
                <div style="font-size:12px;color:#777;">Protected URLs</div>
            </div>
            <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:12px 24px;text-align:center;">
                <div style="font-size:16px;font-weight:600;color:<?php echo $aioseo ? '#00a32a' : '#f0a500'; ?>;">
                    <?php echo $aioseo ? 'AIOSEO ✅' : 'AIOSEO ❌'; ?>
                </div>
                <div style="font-size:12px;color:#777;">SEO Plugin</div>
            </div>
            <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:12px 24px;text-align:center;">
                <div style="font-size:16px;font-weight:600;color:#00a32a;">3 Layers</div>
                <div style="font-size:12px;color:#777;">of Protection</div>
            </div>
        </div>

        <!-- How it works banner -->
        <div style="background:#f0f6fc;border-left:4px solid #2271b1;padding:12px 16px;max-width:680px;margin-bottom:24px;border-radius:0 6px 6px 0;">
            <strong>How the 3 layers work:</strong><br>
            <span style="font-size:13px;color:#444;">
                1️⃣ <strong>Output Buffer</strong> — intercepts raw XML before it's sent to browser (catches ALL sitemap plugins)<br>
                2️⃣ <strong>AIOSEO Filters</strong> — hooks into AIOSEO's URL array directly<br>
                3️⃣ <strong>WP Core Filters</strong> — hooks into WordPress built-in sitemap system
            </span>
        </div>

        <!-- Settings form -->
        <form method="post" action="options.php">
            <?php settings_fields( 'sdr_settings_group' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="sdr_duplicate_urls">Protected URLs</label></th>
                    <td>
                        <textarea
                            id="sdr_duplicate_urls"
                            name="sdr_duplicate_urls"
                            rows="12"
                            style="width:100%;max-width:680px;font-family:monospace;font-size:13px;border-radius:6px;border:1px solid #ccc;padding:10px;"
                            placeholder="https://www.elsner.com/hire-ecommerce-developer/&#10;https://www.elsner.com/another-page/&#10;https://www.elsner.com/one-more-page/"
                        ><?php echo esc_textarea( $saved ); ?></textarea>
                        <p class="description">One URL per line. URLs are automatically normalised (lowercase, trailing slash added).</p>
                    </td>
                </tr>
            </table>
            <?php submit_button( 'Save URLs' ); ?>
        </form>

        <!-- Test Tool -->
        <hr style="margin:24px 0;">
        <h2>🔍 Test a URL</h2>
        <form method="post" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            <?php wp_nonce_field( 'sdr_test_nonce' ); ?>
            <label for="sdr_test_url" class="screen-reader-text" style="display:none;">Test URL</label>
            <input type="url" id="sdr_test_url" aria-label="Test URL" name="sdr_test_url" style="width:420px;padding:6px 10px;border-radius:4px;border:1px solid #ccc;"
                placeholder="https://www.elsner.com/hire-ecommerce-developer/" />
            <button type="submit" class="button button-secondary">Test URL</button>
        </form>
        <?php echo $test_result; ?>

        <!-- Current protected URL list -->
        <?php if ( ! empty( $url_list ) ) : ?>
        <hr style="margin:24px 0;">
        <h2>Currently Protected (<?php echo count( $url_list ); ?> URLs)</h2>
        <table class="widefat" style="max-width:720px;">
            <thead>
                <tr><th style="width:40px;">#</th><th>URL</th></tr>
            </thead>
            <tbody>
                <?php foreach ( $url_list as $i => $url ) : ?>
                <tr>
                    <td style="color:#999;"><?php echo $i + 1; ?></td>
                    <td style="font-family:monospace;font-size:13px;">
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php echo esc_html( $url ); ?></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <!-- Debug -->
        <hr style="margin:24px 0;">
        <h2>🛠 Debug Info</h2>
        <table class="widefat" style="max-width:500px;">
            <thead>
                <tr><th scope="col">Setting</th><th scope="col">Value</th></tr>
            </thead>
            <tbody>
            <tr><td><strong>AIOSEO Active</strong></td><td><?php echo $aioseo ? '<span style="color:#00a32a">Yes ✅</span>' : '<span style="color:#cc1818">No</span>'; ?></td></tr>
            <tr><td><strong>AIOSEO Version</strong></td><td><?php echo defined('AIOSEO_VERSION') ? esc_html(AIOSEO_VERSION) : 'N/A'; ?></td></tr>
            <tr><td><strong>PHP Version</strong></td><td><?php echo phpversion(); ?></td></tr>
            <tr><td><strong>WordPress Version</strong></td><td><?php echo get_bloginfo('version'); ?></td></tr>
            <tr><td><strong>Your Sitemap</strong></td><td>
                <a href="<?php echo esc_url( home_url('/page-sitemap.xml') ); ?>" target="_blank">
                    <?php echo esc_html( home_url('/page-sitemap.xml') ); ?>
                </a>
            </td></tr>
            </tbody>
        </table>
    </div>
    <?php
}

// ─────────────────────────────────────────────
//  ACTIVATION NOTICE
// ─────────────────────────────────────────────

register_activation_hook( __FILE__, function() {
    set_transient( 'sdr_activated_notice', true, 10 );
} );

add_action( 'admin_notices', function() {
    if ( get_transient( 'sdr_activated_notice' ) ) {
        delete_transient( 'sdr_activated_notice' );
        $url = admin_url( 'options-general.php?page=sitemap-duplicate-remover' );
        echo '<div class="notice notice-success is-dismissible"><p>';
        echo '✅ <strong>Sitemap Duplicate Remover v2.0</strong> is active! <a href="' . esc_url( $url ) . '">Add your URLs here →</a>';
        echo '</p></div>';
    }
} );
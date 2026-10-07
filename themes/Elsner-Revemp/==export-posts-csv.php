<?php
// Load WordPress environment
require_once( dirname(__FILE__) . '/../../../wp-load.php' );

// Only allow admin users
if ( !current_user_can('manage_options') ) {
    wp_die('Unauthorized access');
}

// Clear any output buffers
if (ob_get_level()) {
    ob_end_clean();
}

// CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=wordpress-posts.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV header row
fputcsv($output, ['Post Title', 'Post URL']);

// Fetch all published posts
$posts = get_posts([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => -1
]);

foreach ($posts as $post) {
    fputcsv($output, [$post->post_title, get_permalink($post->ID)]);
}

fclose($output);
exit;

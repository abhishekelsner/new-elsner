<?php

/**
 * Elsner 2019 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Elsner
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('elsner');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'main'    => __('Main Menu', 'twentyseventeen'),
		)
	);
	register_nav_menus(
		array(
			'header'    => __('header Menu', 'twentyseventeen'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	// Load regular editor styles into the new block-based editor.
	add_theme_support('editor-styles');

	// Load default block styles.
	add_theme_support('wp-block-styles');

	// Add support for responsive embeds.
	add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'twentyseventeen_setup');

add_action('wp_footer', 'mise_function');
function mise_function()
{ ?>
	<script>
		jQuery.browser = {
			msie: false,
			version: 0
		};
	</script>
	<?php }


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Blog Sidebar', 'twentyseventeen'),
			'id'            => 'sidebar-1',
			'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'twentyseventeen_widgets_init');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'twentyseventeen_pingback_header');


/**
 * Enqueues scripts and styles.
 */
function elsner_scripts()
{
	if (wp_is_mobile() && is_front_page()) {
		wp_enqueue_style('elsner-phone', get_template_directory_uri() . '/css/homepage.css', array(), '1.0');
	}

	wp_enqueue_style('elsner-fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), '1.0');
	wp_enqueue_style('elsner-style', get_template_directory_uri() . '/css/style.css', array(), '1.0');
	wp_enqueue_style('elsner-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0');
	wp_enqueue_style('elsner-all', get_template_directory_uri() . '/css/all.css', array(), '1.0');
	// wp_enqueue_style( 'elsner-aos', get_template_directory_uri().'/css/aos.css', array(), '1.0' );
	wp_enqueue_style('style-2020', get_template_directory_uri() . '/css/style-2020.css', array(), '1.0');
	wp_enqueue_style('elsner-owl', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '1.0');
	wp_enqueue_style('header-style-2020', get_template_directory_uri() . '/css/header-style-2020.css', array(), '1.0');
	wp_enqueue_style('responsive-2020', get_template_directory_uri() . '/css/responsive-2020.css', array(), '1.0');
	wp_enqueue_style('responsive-2020', get_template_directory_uri() . '/css/new-seo-services.css', array(), '1.0');
	wp_enqueue_style('custom-css', get_template_directory_uri() . '/css/custom.css', array(), '1.0');

	if (is_single(array(16149, 15720))) {

		wp_enqueue_style('foodtaxi-style', get_template_directory_uri() . '/css/food-taxi.css', array(), '1.0');
	}
	//wp_enqueue_style( 'elsner-stylev2', get_template_directory_uri().'/css/style_v2.css', array(), '1.0' );
	if (!is_front_page()) {
		wp_enqueue_style('elsner-default', get_stylesheet_uri(), array(), '1.0');
		wp_enqueue_style('elsner-owltheme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), '1.0');
		wp_enqueue_style('elsner-seo-pack', get_template_directory_uri() . '/css/seo-pack.css', array(), '1.0');
	}
	//service page enqueue
	wp_enqueue_style('service-offering', get_template_directory_uri() . '/css/service-offering.css', array(), '1.0');

	if (is_page(array(24538, 24606, 24621, 24711))) {
		//new service page enqueue
		wp_enqueue_style('new-seo-servicepage', get_template_directory_uri() . '/css/new-seo-services.css', array(), '1.0');
	}


	//landing page enqueue
	wp_enqueue_style('elsner-landing', get_template_directory_uri() . '/css/landing-page.css', array());
	wp_enqueue_style('elsner-slick-css', get_template_directory_uri() . '/css/slick.css', array(), time());

	wp_enqueue_script('jquery');
	if (is_single(array(16149, 15720))) {

		wp_enqueue_script('foodtaxi-scriot', get_template_directory_uri() . '/js/smooth-scroll.js', array(), '1.0', true);
	}
	wp_enqueue_script('elsner-marquee', get_template_directory_uri() . '/js/jquery.marquee.min.js', array(), '1.0', true);
	wp_enqueue_script('elsner-pause', get_template_directory_uri() . '/js/jquery.pause.js', array(), '1.0', true);
	wp_enqueue_script('elsner-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0', true);
	wp_enqueue_script('elsner-owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '1.0', true);
	// wp_enqueue_script( 'elsner-aos', get_template_directory_uri().'/js/aos.js', array(), '1.0', true );

	wp_enqueue_script('elsner-slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), time(), true);
	wp_enqueue_script('elsner-masonry', get_template_directory_uri() . '/js/masonry.pkgd.js', array(), '1.0', true);


	// wp_enqueue_script( 'elsner-mo', get_template_directory_uri().'/js/mo.min.js', array(), '1.0', true );
	wp_enqueue_script('elsner-custom1', get_template_directory_uri() . '/js/custom.js', array(), '', true);

	//Enqueue new custom js
	wp_enqueue_script('elsner-new-custom', get_template_directory_uri() . '/js/new-custom.js', array(), '1.0', true);

	wp_enqueue_script('jquery-waypoint', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array(), '1.0', true);
	wp_enqueue_script('jquery-inview', get_template_directory_uri() . '/js/inview.min.js', array(), '1.0', true);
	// wp_enqueue_script( 'counter-js', get_template_directory_uri().'/js/counter.js', array(), '1.0', true );


}
add_action('wp_enqueue_scripts', 'elsner_scripts');


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr($sizes, $size)
{
	$width = $size[0];

	if (740 <= $width) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if (is_active_sidebar('sidebar-1') || is_archive() || is_search() || is_home() || is_page()) {
		if (!(is_page() && 'one-column' === get_theme_mod('page_options')) && 767 <= $width) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
	if (is_archive() || is_search() || is_home()) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template($template)
{
	return is_home() ? '' : $template;
}
add_filter('frontpage_template', 'twentyseventeen_front_page_template');

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args($args)
{
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter('widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args');

/**
 * Get unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @staticvar int $id_counter
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id($prefix = '')
{
	static $id_counter = 0;
	if (function_exists('wp_unique_id')) {
		return wp_unique_id($prefix);
	}
	return $prefix . (string) ++$id_counter;
}

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
require_once get_parent_theme_file_path('/inc/elsner-mega-menu.php');



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


function elsner_header_scripts()
{
	if (is_page('thank-you')) { ?>
		<!-- Event snippet for Contact Us From 1 conversion page -->
		<script>
			gtag('event', 'conversion', {
				'send_to': 'AW-784550292/FdWuCIbkmZQBEJSTjfYC'
			});
		</script>
		<?php
	}
}
add_action('wp_head', 'elsner_header_scripts');


function custom_filter_wpcf7_is_tel($result, $tel)
{
	return (bool) preg_match('/^\(?\+?([0-9]{1,2})?\)?[-\. ]?(\d{10})$/', $tel);
}

add_filter('wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2);



function testimonial_shortcode()
{
	$testimonials = array(
		'post_type' => 'testimonial',
		'posts_per_page' => '3',

	);
	$testimonialquery = new WP_Query($testimonials);
	if ($testimonialquery->have_posts()) {
		while ($testimonialquery->have_posts()) {
			$testimonialquery->the_post(); ?>

			<div class="review-item">
				<div class="row">
					<div class="col-md-6">
						<div class="client-image">
							<img src="<?php the_field('client_photo'); ?>" alt="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="client-description">
							<img src="/wp-content/themes/elsner2019/images/quote-new.svg" alt="quote img">
							<div class="review">
								<div class="testimonial__content">
									<p><?php the_content(); ?></p>
								</div>
								<h5><?php the_title(); ?></h5>
								<h6><?php the_field('client_position'); ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php }
	}
	wp_reset_postdata();
}
add_shortcode('testimonial', 'testimonial_shortcode');

function portfolios_shortcode($atts)
{

	$portfolios = array(
		'post_type' => 'portfolio',
		'posts_per_page' => 10,
	);

	$portfolioquery = new WP_Query($portfolios);
	if ($portfolioquery->have_posts()) { ?>
		<div class="row">
			<?php while ($portfolioquery->have_posts()) {
				$portfolioquery->the_post(); ?>
				<div class="col-md-4 gal-item">
					<div class="box">
						<div class="workimg">

							<a href="<?php the_permalink(); ?>">
								<img src="<?php the_post_thumbnail_url(); ?>" class="project">
							</a>
						</div>
						<h6><?php
							$terms = get_the_terms(get_the_ID(), array('platform'));
							if (!empty($terms) && !is_wp_error($terms)) {
								foreach ($terms as $term) {
									echo $term->name;
								}
							}
							?></h6>

						<p><?php the_title(); ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php  } ?>
	<?php wp_reset_postdata();
}
add_shortcode('portfolio', 'portfolios_shortcode');


function portfolioslider_shortcode($atts)
{
	if (isset($atts['category'])) {
		$category = $atts['category'];
		$portfolioslider = array(
			'post_type' => 'portfolio',


			'tax_query' => array(
				array(
					'taxonomy' => 'platform',
					'field' => 'slug',
					'terms' => $category,
				)
			)
		);
	} else {
		$portfolioslider = array(
			'post_type' => 'portfolio',
			'posts_per_page' => 10,
		);
	}
	$portfoliosliderquery = new WP_Query($portfolioslider);
	if ($portfoliosliderquery->have_posts()) { ?>

		<?php while ($portfoliosliderquery->have_posts()) {
			$portfoliosliderquery->the_post(); ?>
			<div class="service_desc">
				<div class="projects-image-section"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
				<h6><?php
					$terms = get_the_terms(get_the_ID(), array('platform'));
					if (!empty($terms) && !is_wp_error($terms)) {
						foreach ($terms as $term) {
							echo $term->name;
						}
					}
					?></h6>
				<a href="<?php the_permalink(); ?>">
					<p><?php the_title(); ?></p>
				</a>
			</div>
		<?php } ?>

	<?php  } ?>
<?php wp_reset_postdata();
}
add_shortcode('portfolio-slider', 'portfolioslider_shortcode');


function blog_shortcode($atts)
{

	if (isset($atts['category'])) {
		$category = $atts['category'];
		$blogs = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $category,
				)
			)
		);
	} else {
		$blogs = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
		);
	}


	$blogsquery = new WP_Query($blogs); ?>

	<div class="row blogs">

		<?php if ($blogsquery->have_posts()) {
			while ($blogsquery->have_posts()) {
				$blogsquery->the_post(); ?>
				<div class="col-md-4">
					<div class="blog-post">
						<?php the_post_thumbnail(); ?>
						<div class="blog-content">
							<h5><?php the_title(); ?></h5>
							<h6><?php the_date(); ?></h6>
							<p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
							<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
						</div>
					</div>
				</div>

			<?php } ?>
		<?php  } ?>
	</div>
	<?php wp_reset_postdata();
}

add_shortcode('blog', 'blog_shortcode');




function recent_posts_shortcode($atts, $content = NULL)
{
	$atts = shortcode_atts(
		[
			'orderby' => 'date',
			'posts_per_page' => '1',
			'order' => 'DESC'
		],
		$atts,
		'recent-posts'
	);

	$query = new WP_Query($atts);

	while ($query->have_posts()) : $query->the_post(); ?>
		<div class="row alinc">
			<div class="col-md-5">
				<div class="blog-text">
					<h2><?php the_title(); ?></h2>
					<div class="date_time">
						<a href="<?php the_permalink(); ?>"><img src="<?php the_field('calendar_image', 'option'); ?>" /alt=""><?php the_date(); ?></a>
						<a href="<?php the_permalink(); ?>"> <img src="<?php the_field('eye_image', 'option'); ?>" /alt=""> <?php //echo do_shortcode('[views id="'.get_the_ID().'"]'); 
																															?> </a>

					</div>
					<p><?php echo wp_trim_words(get_the_content(), 90); ?></p>
					<a href="<?php the_permalink(); ?>" class="read_more"><?php the_field('read_more_button', 'option'); ?></a>
				</div>
			</div>
			<div class="col-md-7">
				<div class="blogimg_right">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>
		</div>



	<?php endwhile;

	wp_reset_query();
}
add_shortcode('recent-posts', 'recent_posts_shortcode');

function blogpage_shortcode($atts)
{

	$mainblog = array(
		'post_type' => 'post',
		'posts_per_page' => 6,
		'orderby' => 'date',
		'order' => 'DESC'

	);


	$blogsquery = new WP_Query($mainblog); ?>


	<?php if ($blogsquery->have_posts()) {
		while ($blogsquery->have_posts()) {
			$blogsquery->the_post(); ?>
			<div class="col-md-4">
				<div class="blog-post">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?>
						<div class="blog-content">
							<h5><?php the_title(); ?></h5>
					</a>
					<div class="date_time">
						<a href="<?php the_permalink(); ?>"><img src="<?php the_field('calendar_image', 'option'); ?>" /alt=""><?php the_date(); ?></a>
						<a href="<?php the_permalink(); ?>"><img src="<?php the_field('eye_image', 'option'); ?>" /alt="">
							<?php //echo do_shortcode('[views id="' . get_the_ID() . '"]'); 
							?> </a>
					</div>
				</div>
			</div>
			</div>


		<?php } ?>
	<?php  } ?>

<?php wp_reset_postdata();
}

add_shortcode('blog-page', 'blogpage_shortcode');

//Defer parsing of JavaScript code
//function defer_parsing_of_js( $url ) {
// if ( is_user_logged_in() ) return $url; //don't break WP Admin
// if ( FALSE === strpos( $url, '.js' ) ) return $url;
// if ( strpos( $url, 'jquery.js' ) ) return $url;
// return str_replace( ' src', ' defer src', $url );
//}
//add_filter( 'script_loader_tag', 'defer_parsing_of_js', 10 );

add_action('wp_enqueue_scripts', 'add_stylesheets');

/**
 * Add stylesheet to the page
 */
function add_stylesheets()
{
	//wp_enqueue_style('google-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:100');
}

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

//This function prints the JavaScript to the footer
function cf7_footer_script()
{

	//if page name is covid19.

	if (is_page('covid19')) { ?>

		<script>
			document.addEventListener('Covid19', function(event) {
				location = 'http://www.elsner.com/thank-you';
			}, false);
		</script>

	<?php }
}
add_action('wp_footer', 'cf7_footer_script');


add_filter('wp_head', 'aioseo_filter_canonical_url');

function aioseo_filter_canonical_url($url)
{
	if (is_page(array(4320))) {
		$url = 'https://www.elsner.com/services/seo-services/';
	}
	?>
	<link rel="canonical" href="<?php echo $url ?>" />
<?php }


// function wpse_302620_canonical_url( $canonical_url, $post ) {
//     if ( $post->ID === 1234 ) {
//         $canonical_url = 'https://www.examplesite.com/my-guest-post';
//     } 

//     return $canonical_url;
// }
// add_filter( 'get_canonical_url', 'wpse_302620_canonical_url', 10, 2 );


function webp_upload_mimes($existing_mimes)
{
	// add webp to the list of mime types
	$existing_mimes['webp'] = 'image/webp';

	// return the array back to the function with our added mime type
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

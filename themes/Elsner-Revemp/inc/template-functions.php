<?php

/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

//show_admin_bar(false);


// add_action('template_redirect', 'elsner_custom_redirect');
// function elsner_custom_redirect()
// {
// 	if (is_404()) {
// 		wp_redirect(home_url('not-found/'));
// 		exit;
// 	}
// }
add_filter('template_include', 'elsner_force_404_php', 99);
function elsner_force_404_php($template) {
    if (is_404()) {
        $php_template = get_stylesheet_directory() . '/404.php';
        if (file_exists($php_template)) {
            return $php_template;
        }
    }
    return $template;
}

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Mega Menu',
		'menu_title'	=> 'Mega Menu',
		'menu_slug' 	=> 'mega-menu',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Global Sections',
		'menu_title'	=> 'Global Sections',
		'menu_slug' 	=> 'global-section',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twentyseventeen_body_classes($classes)
{
	// Add class of group-blog to blogs with more than 1 published author.
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if (is_customize_preview()) {
		$classes[] = 'twentyseventeen-customizer';
	}

	// Add class on front page.
	if (is_front_page() && 'posts' !== get_option('show_on_front')) {
		$classes[] = 'twentyseventeen-front-page';
	}

	// Add a class if there is a custom header.
	if (has_header_image()) {
		$classes[] = 'has-header-image';
	}

	// Add class if sidebar is used.
	if (is_active_sidebar('sidebar-1') && !is_page()) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if (is_page() || is_archive()) {
		if ('one-column' === get_theme_mod('page_layout')) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Add class if the site title and tagline is hidden.
	if ('blank' === get_header_textcolor()) {
		$classes[] = 'title-tagline-hidden';
	}

	return $classes;
}
add_filter('body_class', 'twentyseventeen_body_classes');

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function twentyseventeen_panel_count()
{

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $num_sections Number of front page sections.
	 */
	$num_sections = apply_filters('twentyseventeen_front_page_sections', 4);

	// Create a setting and control for each of the sections available in the theme.
	for ($i = 1; $i < (1 + $num_sections); $i++) {
		if (get_theme_mod('panel_' . $i)) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the front page or not.
 */
function twentyseventeen_is_frontpage()
{
	return (is_front_page() && !is_home());
}

//Paypal Checkout
add_action('template_redirect', 'package_paypal_checkout');
function package_paypal_checkout()
{
	if ($_GET['paypal'] == 'checkout' || ($_GET['token'] != '' && $_GET['PayerID'] != '')) {
		include_once(get_template_directory() . "/inc/paypal/config.php");
		include_once(get_template_directory() . "/inc/paypal/functions.php");
		include_once(get_template_directory() . "/inc/paypal/paypal.class.php");

		$paypal = new MyPayPal();

		//Post Data received from product list page.
		if (_GET('paypal') == 'checkout') {

			$products = [];

			$products[0]['ItemName'] = _GET('itemname'); //Item Name
			$products[0]['ItemPrice'] = _GET('itemprice'); //Item Price
			$products[0]['ItemNumber'] = _GET('itemnumber'); //Item Number
			$products[0]['ItemDesc'] = _GET('itemdesc'); //Item Number
			$products[0]['ItemQty']	= 1; // Item Quantity

			$charges = [];

			//Other important variables like tax, shipping cost
			$charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
			$charges['HandalingCost'] = 0;  //Handling cost for this order.
			$charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
			$charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
			$charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

			//------------------SetExpressCheckOut-------------------

			//We need to execute the "SetExpressCheckOut" method to obtain paypal token

			$paypal->SetExpressCheckOut($products, $charges);
		} elseif (_GET('token') != '' && _GET('PayerID') != '') {

			$result = $paypal->DoExpressCheckoutPayment();

			if ("SUCCESS" == strtoupper($result["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($result["ACK"])) {
				$status = 'SUCCESS';
				$transation_id = urldecode($result["TRANSACTIONID"]);

				$body = '<p>Hi,</p>';
				$body .= '<p>New order received for SEO package. Please find details below.</p>';
				$body .= '<p>Package Name: ' . urldecode($result['L_PAYMENTREQUEST_0_NAME0']) . '</p>';
				$body .= '<p>Paid Amount: ' . urldecode($result['AMT']) . ' USD</p>';
				$body .= '<p>Customer Name: ' . urldecode($result['FIRSTNAME']) . ' ' . urldecode($result['LASTNAME']) . '</p>';
				$body .= '<p>Customer Email: ' . urldecode($result['EMAIL']) . '</p>';
				$body .= '<p>Customer Country: ' . urldecode($result['COUNTRYCODE']) . '</p>';
				$body .= '<p>Paypal Payer ID: ' . urldecode($result['PAYERID']) . '</p>';
				$body .= '<p>Paypal Transaction ID: ' . urldecode($result['TRANSACTIONID']) . '</p>';
				$body .= '<br/><p>Thanks.</p>';

				wp_mail('support@elsner.com', 'New Order of SEO Package', $body);

				$body = '<p>Hi ' . $result['FIRSTNAME'] . ',</p>';
				$body .= '<p>New order has been received for SEO package. Please find details below.</p>';
				$body .= '<p>Package Name: ' . urldecode($result['L_PAYMENTREQUEST_0_NAME0']) . '</p>';
				$body .= '<p>Paid Amount: ' . urldecode($result['AMT']) . ' USD</p>';
				$body .= '<p>Your Name: ' . urldecode($result['FIRSTNAME']) . ' ' . urldecode($result['LASTNAME']) . '</p>';
				$body .= '<p>Your Email: ' . urldecode($result['EMAIL']) . '</p>';
				$body .= '<p>Paypal Payer ID: ' . urldecode($result['PAYERID']) . '</p>';
				$body .= '<p>Paypal Transaction ID: ' . urldecode($result['TRANSACTIONID']) . '</p>';
				$body .= '<br/><p>Thanks.</p>';

				wp_mail(urldecode($result['EMAIL']), 'Receipt of New Order for SEO Package', $body);
			} else
				$status = 'FAIL';

			wp_redirect(get_permalink() . '?status=' . $status . '&transation_id=' . $transation_id);
			exit;
		}
	}
}

add_action('wp_ajax_nopriv_getPostClapCount', 'getPostClapCount');
add_action('wp_ajax_getPostClapCount', 'getPostClapCount');
function getPostClapCount()
{
	$clap_count = get_post_meta($_POST['post_id'], 'clap_count', true);
	if (!$clap_count)
		$clap_count = 0;
	echo $clap_count;
	exit;
}

add_action('wp_ajax_nopriv_updatePostClapCount', 'updatePostClapCount');
add_action('wp_ajax_updatePostClapCount', 'updatePostClapCount');
function updatePostClapCount()
{
	update_post_meta($_POST['post_id'], 'clap_count', $_POST['clap_count']);
	exit;
}


function elsner_pagination($max_num_pages = 0)
{
	/** Stop execution if there's only 1 page */

	if ($max_num_pages <= 1)

		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

	$max   = intval($max_num_pages);



	/** Add current page to the array */

	if ($paged >= 1)

		$links[] = $paged;



	/** Add the pages around the current page to the array */

	if ($paged >= 3) {

		$links[] = $paged - 1;

		$links[] = $paged - 2;
	}



	if (($paged + 2) <= $max) {

		$links[] = $paged + 2;

		$links[] = $paged + 1;
	}

	echo '<div class="row"><div class="col-sm-12"><ul class="paginate pag5 clearfix">' . "\n";



	/** Previous Post Link */

	if (get_previous_posts_link())

		printf('<li>%s</li>' . "\n", get_previous_posts_link('<span aria-hidden="true">prev</span>'));



	/** Link to first page, plus ellipses if necessary */

	if (!in_array(1, $links)) {

		$class = 1 == $paged ? ' class="current"' : '';

		if ($class == '')

			printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		else

			printf('<li%s>%s</li>' . "\n", $class, '1');



		//if ( ! in_array( 2, $links ) )

		//echo '<li>…</li>';

	}



	/** Link to current page, plus 2 pages in either direction if necessary */

	sort($links);

	foreach ((array) $links as $link) {

		$class = $paged == $link ? ' class="current"' : '';

		if ($class == '')

			printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);

		else

			printf('<li%s>%s</li>' . "\n", $class, $link);
	}



	/** Link to last page, plus ellipses if necessary */

	if (!in_array($max_num_pages, $links)) {

		//if ( ! in_array( $max_num_pages - 1, $links ) )

		//echo '<li>…</li>' . "\n";

		$class = $paged == $max_num_pages ? ' class="current"' : '';

		if ($class == '')

			printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max_num_pages)), $max_num_pages);

		else

			printf('<li%s>%s</li>' . "\n", $class, $max_num_pages);
	}

	/** Next Post Link */
	if (get_next_posts_link('<span aria-hidden="true">next</span>', $max_num_pages))

		printf('<li>%s</li>' . "\n", get_next_posts_link('<span aria-hidden="true">next</span>', $max_num_pages));
	echo '</ul></div></div>' . "\n";
}

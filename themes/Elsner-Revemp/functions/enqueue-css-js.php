<?php
function elsner_styles_scripts()
{
	global $post, $template;
	$template_name = basename($template);
	$post_slug = $post->post_name;
	//enqueue styles
	if (wp_is_mobile()) :
		wp_enqueue_style('elsner-fontawesome-mobile', get_template_directory_uri() . '/assets/css/font-awesome-mobile.css', array(), time(), 'all');
	else :
		wp_enqueue_style('elsner-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), time(), 'all');
		wp_style_add_data('elsner-fontawesome', 'preload', 'all');
	endif;

	wp_enqueue_style('elsner-bootstrap-min', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), time(), 'all');
	// wp_style_add_data('elsner-bootstrap-min', 'preload', 'all');
	wp_enqueue_style('elsner-slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), time());
	wp_enqueue_style('elsner-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), time());
	wp_enqueue_style('elsner-base-css', get_template_directory_uri() . '/assets/css/base.css', array(), time());
	// wp_style_add_data('elsner-base-css', 'preload', 'all');
	wp_enqueue_style('elsner-head-foot', get_template_directory_uri() . '/assets/css/header-footer.css', array(), time());

	if (!is_front_page()) :
		wp_enqueue_style('elsner-main', get_template_directory_uri() . '/assets/css/main.css', array(), time());
	endif;

	//enqueue scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-migrate');

	if(is_front_page() || $template_name === 'new-service-design.php' || is_singular('product') || $template_name === 'new-services-seo-packages.php' || $template_name === 'whatsapp-integration-template.php' || $template_name === 'ecommerce-maintenence-package.php' || $template_name === 'industries-template.php' || $template_name === 'services.php' || $template_name === 'our-team.php') :
		wp_enqueue_style('elsner-home', get_template_directory_uri() . '/assets/css/home.css', array(), time());
		wp_style_add_data('elsner-home', 'preload', 'all');
	endif;

	if (is_front_page()) :
		wp_enqueue_style('new-rev-css', get_template_directory_uri() . '/assets/css/new-rev-css.css', array(), time());
		wp_enqueue_script('new-rev-js', get_template_directory_uri() . '/assets/js/new-rev-js.js', array('jquery'),time());
		wp_enqueue_style('elsner-main', get_template_directory_uri() . '/assets/css/main.css', array(), time());
		wp_enqueue_style('elsner-fullpage-min', get_template_directory_uri() . '/assets/css/fullpage.min.css', array(), time());
		// wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css', [], '5');
   		// wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js', [], '5', true);
		if (!wp_is_mobile()) :
			// wp_enqueue_script('elsner-fullpage', get_template_directory_uri() . '/assets/js/fullpage.min.js#asyncload', array(), time(), true);
			// wp_enqueue_script('elsner-fullpage-init', get_template_directory_uri() . '/assets/js/fullpage-init.min.js#asyncload', array(), time(), true);
		
		endif;
		wp_enqueue_script('elsner-home-js', get_template_directory_uri() . '/assets/js/home.min.js', array(), time(), true);
	endif;

	if ($template_name === 'ecommerce-maintenence-package.php') :
		wp_enqueue_style('ecommerce-package-popup', get_template_directory_uri() . '/assets/css/ecommerce-package-popup.css', array(), time());
	endif;
	
	if ($template_name === 'new-ppc-landing-page.php') :
		wp_enqueue_style('new-ppc-landing-page-custom-css', get_template_directory_uri() . '/assets/css/new-ppc-landing-page.css',array(),time());
		wp_enqueue_script('new-ppc-landing-page-js', get_template_directory_uri() . '/src/js/new-ppc-landing-page.js', array('jquery'),true);
	endif;
	if ($template_name === 'WeekMate.php' || $template_name === 'new-ppc-landing-page.php' || is_singular('product')) :
		wp_enqueue_style('weekmate-custom-css', get_template_directory_uri() . '/assets/css/weekmate.css',array(),time());
		wp_enqueue_style('weekmate-swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css',array(),time());
		wp_enqueue_script('weekmate-swiper-js', get_template_directory_uri() . '/src/js/swiper-bundle.min.js', array('jquery'),time(),true);
		wp_enqueue_script('weekmate-custom-js', get_template_directory_uri() . '/src/js/weekmate.js', array('jquery', 'weekmate-swiper-js'),true);
	endif;
	if ($template_name === 'template-services-new.php' || $template_name === 'pricing-page.php') :
		wp_enqueue_style('new-tmp-services.css', get_template_directory_uri() . '/assets/css/new-tmp-services.css',array(),time());
		wp_enqueue_script('new-tmp-services.js', get_template_directory_uri() . '/src/js/new-tmp-services.js', array('jquery'),true);
		wp_enqueue_style('pricing-page.css', get_template_directory_uri() . '/assets/css/pricing-page.css',array(),time());
	endif;

	if ($template_name === 'industries-page-template.php') :
		wp_enqueue_style('industry-page-template.css', get_template_directory_uri() . '/assets/css/industry-page-template.css',array(),time());
	endif;

	if (is_page('digital-marketing-solutions-for-agency-partners') || is_page('shopify-seo-services') || is_page('hire-zoho-developer') || is_page('business-intelligence') || is_page('legacy-software-modernization') || is_page('product-modernization') || is_page('performance-marketing') || is_page('custom-software-development') || is_page('video-marketing') || is_page('brand-management') || is_page('agency-web-development-solutions') || is_page('conversion-rate-optimization')  || is_page('conversational-ai-chatbot-development')|| is_page('predictive-analytics') || is_page('web-development') || is_page('saas-development') || is_page('hybrid-app-development') || is_page('mvp-development') || is_page('product-strategy-consulting') || is_page('product-development-services') || is_page('ai-ml-development') || is_page('ai-strategy-consulting') || is_page('data-engineering-mlops')  || is_page('answer-engine-optimization-services') || is_page('magento-development') || is_page('generative-engine-optimization-services') || is_page('ecommerce-development')|| is_page('shopify-development') || is_page('pimcore-development')|| is_page('wordpress-development') || is_page('ecommerce-development-new') || is_page('zoho-development-services') || is_page('woocommerce-seo-services') || is_page('woocommerce-development') || is_page('shopify-growth-plan') || is_page('team') || is_page('ai-agent-development') || is_page('product-development') || is_page('magento-seo-services') || is_page('seo-services') || is_page('wordpress-seo-services') || $template_name === 'industries-page-template.php' || is_page('ai-calling-solutions')) :
		wp_enqueue_style('b2b-marketing-css', get_template_directory_uri() . '/assets/css/b2b-css.css', array(), time());
		wp_enqueue_style('b2b-responsive-css', get_template_directory_uri() . '/assets/css/b2b-responsive.css', array(), time());
		wp_enqueue_script('b2b-marketing-js', get_template_directory_uri() . '/assets/js/b2b-marketing.min.js', array('jquery'), time(), true);

	endif;
	
	if($template_name === 'home-new-2026.php' || is_page('ai-calling-solutions')) : 
		wp_enqueue_style('fancybox-style', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css', [], '5');
   		wp_enqueue_script('fancybox-script', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js', [], '5', true);
		wp_enqueue_style('elsner-new-home-css', get_template_directory_uri() . '/assets/css/elsner-home-new.css',array(),time());
			wp_enqueue_script(
				'elsner-new-home-js',
				get_template_directory_uri() . '/assets/js/elsner-home-new.min.js',
				array('jquery', 'elsner-slick-js', 'fancybox-script'),
				time(),
				true
			);
		wp_enqueue_style('elsner-new-global-css', get_template_directory_uri() . '/assets/css/elsner-home-new-global.css',array(),time());
	endif;

	wp_enqueue_style('elsner-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), time());

	if (is_page('blog') || is_page('life-at-elsner')) :
		wp_enqueue_script('elsner-ajax', get_template_directory_uri() . '/assets/js/custom-ajax.min.js', array('jquery'), time(), true);
		wp_localize_script('elsner-ajax', 'elsner_ajax_data', array(
			'elsner_url' => admin_url('admin-ajax.php'),
			'loader' => get_template_directory_uri() . 'assets/lotties/load-more.lottie',
			'totalPosts' => wp_count_posts('portfolio')->publish,
			'totalPostsClutch' => wp_count_posts('clutch')->publish,
			'nonce' => wp_create_nonce('elsner-ajax-nonce'),
		));

	endif;

	if ($template_name === 'template-landing-page-2026.php') :
		wp_enqueue_style('template-landing-page-2026', get_template_directory_uri() . '/assets/css/zoho-landing-page.css',array(),time());
	endif;
	
	if($template_name === 'london-event.php') : 
		wp_enqueue_style('elsner-new-home-css', get_template_directory_uri() . '/assets/css/london-event.css', array(),time());
		wp_enqueue_script(
				'london-event-js',
				get_template_directory_uri() . '/assets/js/upcoming-event.js',
				array('jquery'),
				time(),
				true
			);		wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css', [], '5');
   		wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js', [], '5', true);
		wp_enqueue_style('elsner-new-global-css', get_template_directory_uri() . '/assets/css/london-event.css',array(),time());
	endif;

	if (is_page('our-portfolio')) :
		wp_enqueue_script('elsner-ajax', get_template_directory_uri() . '/assets/js/custom-ajax.min.js', array('jquery'), time(), true);
		wp_localize_script('elsner-ajax', 'elsner_ajax_data', array(
			'elsner_url' => admin_url('admin-ajax.php'),
			'loader' => get_template_directory_uri() . 'assets/lotties/load-more.lottie',
			'totalPosts' => wp_count_posts('portfolio')->publish,
			'nonce' => wp_create_nonce('elsner-ajax-nonce'),
		));
	endif;

	

	if (is_page('clientele-and-testimonials') || $template_name === 'our-portfolio.php' || $template_name === 'solution.php') :

		wp_enqueue_script('elsner-ajax', get_template_directory_uri() . '/assets/js/custom-ajax.min.js', array('jquery'), time(), true);
		wp_localize_script('elsner-ajax', 'elsner_ajax_data', array(
			'elsner_url' => admin_url('admin-ajax.php'),
			'loader' => get_template_directory_uri() . 'assets/lotties/load-more.lottie',
			'totalPosts' => wp_count_posts('portfolio')->publish,
			'nonce' => wp_create_nonce('elsner-ajax-nonce'),
		));
		wp_enqueue_script('elsner-masonry-js', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.min.js', array('jquery'), time(), true);
		wp_enqueue_script('elsner-masonry-infinite-js', get_template_directory_uri() . '/assets/js/infinite-scroll.pkgd.min.min.js', array('jquery'), time(), true);
		wp_enqueue_script('elsner-masonry-init', get_template_directory_uri() . '/assets/js/masonry-init.min.js', array('jquery'), time(), true);
	endif;

	wp_enqueue_script('elsner-popper', get_template_directory_uri() . '/assets/js/popper.min.min.js', array(), time(), true);

	wp_enqueue_script('elsner-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.min.js', array('jquery'), time(), true);
	wp_enqueue_script('elsner-cookie-min', get_template_directory_uri() . '/assets/js/jquery.cookie.min.min.js', array(), time(), true);
	
	wp_enqueue_script('elsner-slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array(), time(), true);

	if (version_compare(WPCF7_VERSION, '5.2') >= 0) {
		wp_dequeue_script('google-recaptcha');
		wp_dequeue_script('wpcf7-recaptcha');
	} else {
		wp_dequeue_script('google-recaptcha');
	}

	wp_enqueue_script('elsner-common-js', get_template_directory_uri() . '/assets/js/common-pages.min.js', array(), time(), true);

	$is_home = is_front_page() ? true : false;

	wp_localize_script('elsner-common-js', 'customScriptData', array(
		'isHome' => $is_home,
		'sitekey' => '',
		'version' => WPCF7_VERSION,
		'actions' => apply_filters('wpcf7_recaptcha_actions', array(
			'homepage' => 'homepage',
			'contactform' => 'contactform',
		)),
	));

	wp_enqueue_script('elsner-lottie', get_template_directory_uri() . '/assets/js/dotlottie-player.min.js#defer', array(), time(), true);
	wp_style_add_data('elsner-lottie', 'preload', 'all');

	if(is_page('ecommerce-maintenance-packages')):
		wp_enqueue_script('offer-countdown', get_template_directory_uri() . '/assets/js/offer-countdown.min.js', array('jquery'), time());
	endif;

	if (is_page('life-at-elsner')) :
		wp_enqueue_style('elsner-glightbox', get_template_directory_uri() . '/assets/css/glightbox.min.css', array(), time());
		wp_enqueue_script('elsner-glightbox-js', get_template_directory_uri() . '/assets/js/glightbox.min.min.js', array('jquery'), time(), true);
		wp_enqueue_script('elsner-glightbox-init', get_template_directory_uri() . '/assets/js/glightbox-init.min.js', array('jquery'), time(), true);
		//wp_enqueue_script('elsner-mixitup', get_template_directory_uri() . '/assets/js/mixitup.min.min.js', array('jquery'), time(), true);
		//wp_enqueue_script('elsner-mixitup-init', get_template_directory_uri() . '/assets/js/mixitup-init.min.js', array('jquery'), time(), true);
		// wp_localize_script('elsner-mixitup-init', 'MixItUp', array(
		// 	'isPage' => $post_slug
		// ));
		wp_enqueue_script('elsner-masonry-js', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.min.js', array('jquery'), time(), true);
		wp_enqueue_script('elsner-masonry-infinite-js', get_template_directory_uri() . '/assets/js/infinite-scroll.pkgd.min.min.js', array('jquery'), time(), true);
		wp_enqueue_script('elsner-masonry-init', get_template_directory_uri() . '/assets/js/masonry-init.min.js', array('jquery'), time(), true);
	endif;

	if (!is_front_page()) :
	wp_enqueue_script('elsner-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array(), time(), true);
	$is_home = is_front_page() ? true : false;
	wp_localize_script('elsner-custom', 'customScriptData', array(
		'isHome' => $is_home
	));
	endif;

	if ($template_name === 'services.php' || $template_name === 'hire-developer.php' || is_singular('product') || $template_name === 'WeekMate.php' || $template_name === 'our-portfolio.php' || $template_name === 'single-portfolio.php' || $template_name === 'industries-template.php' || is_home() || is_front_page() || $template_name === 'new-service-design.php' || $template_name === 'whatsapp-integration-template.php'|| is_page(5) || is_single()) :
		wp_enqueue_style('elsner-popup-css', get_template_directory_uri() . '/assets/css/popup-css.css', array(), time());
		wp_enqueue_script('elsner-modal-popup-custom', get_template_directory_uri() . '/src/js/modal-bootsrtap.js', array('jquery'), time(), true);
        // wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
	endif;
	
	if ($template_name === 'partner-portal.php'|| $template_name === 'WeekMate.php' || is_singular('product')) :
		wp_enqueue_style('elsner-fancybox-css', get_template_directory_uri() . '/assets/css/fancybox.css', array(), time());
		wp_enqueue_script('elsner-fancybox', get_template_directory_uri() . '/assets/js/fancybox.umd.min.js', array(), '', true);
		wp_enqueue_script('elsner-partner-module', get_template_directory_uri() . '/assets/js/partner-portal.min.js', array(), '', true);
		wp_enqueue_style('elsner-partner-module', get_template_directory_uri() . '/assets/css/partner-portal.css', array(), time());
		wp_enqueue_style('datatablecss', get_template_directory_uri() . '/assets/css/datatable.css', array(), time());
		wp_enqueue_script('datatablesjs', get_template_directory_uri() . '/js/datatable.min.js', array(), time());
	endif;

	// Enqueue the JS file
	wp_enqueue_script('elsner-mega-menu-js', get_template_directory_uri() . '/src/js/elsner-header.js', array('jquery'), time(), true);
	wp_localize_script('elsner-mega-menu-js', 'elsnerMega', [
    'ajaxUrl' => admin_url('admin-ajax.php'),
	]);
	// Enqueue the CSS file (Fixed)
	wp_enqueue_style('elsner-mega-menu-css', get_template_directory_uri() . '/assets/css/elsner-header.css', array(), time());

	if ($template_name === 'news-room.php' || is_singular('news')) {
		wp_enqueue_style(
			'news-letter-style',
			get_template_directory_uri() . '/assets/css/news-room.css',
			array(),
			'1.0'
		);
		wp_enqueue_script(
        'news-filter',
        get_stylesheet_directory_uri() . '/assets/js/news-room.min.js',
        array('jquery'),
        '1.0.0',
        true
    );
    
    // Localize script with AJAX URL and nonce
    wp_localize_script('news-filter', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('news_filter_nonce')
    ));
	}

	if ($template_name === 'our-portfolio.php' || is_singular('case-study')) {
	wp_enqueue_style('new-rev-portfolio', get_template_directory_uri() . '/assets/css/new-rev-portfolio.css', array(), time());
	wp_enqueue_script(
        'portfolio-filter',
        get_template_directory_uri() . '/assets/js/portfolio-listing.min.js',
        array('jquery'),
        '1.0',
        true
    );

    // Pass ajax url to JS
    wp_localize_script(
        'portfolio-filter',
        'portfolio_ajax',
        array(
            'ajax_url' => admin_url('admin-ajax.php')
        )
    );
	}
}
add_action('wp_enqueue_scripts', 'elsner_styles_scripts');

function enqueue_admin_script()
{
	wp_enqueue_script('admin-custom', get_template_directory_uri() . '/assets/js/admin-custom.min.js', array(), time());
	wp_enqueue_style('datatablecss-admin', get_template_directory_uri() . '/assets/css/datatable.css', array(), time());
	wp_enqueue_style('admin-css', get_template_directory_uri() . '/assets/css/admin-css.css', array(), time());
	wp_enqueue_script('datatablesjs-admin', get_template_directory_uri() . '/assets/js/datatable.min.js', array(), time());
	// wp_enqueue_script("admin-custom");	
}
add_action('admin_enqueue_scripts', 'enqueue_admin_script');

function zoho_script()
{
	$current_site = $_SERVER['HTTP_HOST'];
	$current_protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
	$elsner_site = 'elsner.com';

	if (get_site_url() == 'https://www.elsner.com') { ?>
		<script type="text/javascript" id="zsiqchat">
			var $zoho = $zoho || {};
			$zoho.salesiq = $zoho.salesiq || {
			    widgetcode: "3e15d36a88e0a8015984797c7e56ee68de82c1d03482305bb4f004d08ef3fb974ac7adc43beab98729016db6c3998aef",
			    values: {},
			    ready: function() {}
			};
			var d = document;
			s = d.createElement("script");
			s.type = "text/javascript";
			s.id = "zsiqscript";
			s.defer = true;
			s.src = "https://salesiq.zoho.com/widget";
			t = d.getElementsByTagName("script")[0];
			t.parentNode.insertBefore(s, t);
		</script>
	<?php }
}
//add_action('wp_footer', 'zoho_script');


// function recaptcha_dequee_cf7()
// {
// 	if (version_compare(WPCF7_VERSION, '5.2') >= 0) {
// 		wp_dequeue_script('google-recaptcha');
// 		wp_dequeue_script('wpcf7-recaptcha');
// 	} else {
// 		wp_dequeue_script('google-recaptcha');
// 	}
// }
// add_action('wp_print_scripts', 'recaptcha_dequee_cf7', 99);
// add_action('wp_enqueue_scripts', 'recaptcha_dequee_cf7', 99);


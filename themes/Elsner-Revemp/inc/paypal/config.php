<?php
	session_start(); 
	// sandbox or live
	define('PPL_MODE', 'live');

	if(PPL_MODE=='sandbox'){
		
		define('PPL_API_USER', 'pankaj-facilitator_api1.xhtmljunkies.com');
		define('PPL_API_PASSWORD', '1394540650');
		define('PPL_API_SIGNATURE', 'AEB1Jn01jWbyhlqsCa1KnKTx0I-OA7YOcjuJTTGH4aBgcWx8M1AkSgf7');
	}
	else{
		
		define('PPL_API_USER', 'paypal_api1.elsner.in');
		define('PPL_API_PASSWORD', 'RPAZWA5U45UMBKE5');
		define('PPL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AQAXGblnVnp-atunim1fhu9xQnYL');
	}
	global $post;
	define('PPL_LANG', 'EN');
	
	define('PPL_LOGO_IMG', home_url().'/wp-content/uploads/2015/11/logo.png');
	define('PPL_RETURN_URL', get_permalink($post->ID));
	define('PPL_CANCEL_URL', get_permalink($post->ID));

	define('PPL_CURRENCY_CODE', 'USD');

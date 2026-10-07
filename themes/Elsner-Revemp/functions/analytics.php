<?php
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

<?php
// Leads Custom Post Type
function leads_init()
{
	// set up leads labels
	$labels = array(
		'name' => 'Leads',
		'singular_name' => 'Lead',
		'add_new' => 'Add New Lead',
		'add_new_item' => 'Add New Lead',
		'edit_item' => 'Edit Lead',
		'new_item' => 'New Lead',
		'all_items' => 'All Leads',
		'view_item' => 'View Lead',
		'search_items' => 'Search Leads',
		'not_found' =>  'No Leads Found',
		'not_found_in_trash' => 'No Leads found in Trash',
		'parent_item_colon' => '',
		'menu_name' => 'Leads',
	);

	// register post type
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'leads'),
		'query_var' => true,
		'menu_icon' => 'dashicons-businessman',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes'
		)
	);
	//register_post_type('leads', $args);
}
//add_action('init', 'leads_init');
// add_role(
// 	'partner',
// 	__(
// 		'Partner'
// 	),
// 	array(
// 		'read'            => true, // Allows a user to read
// 		'create_posts'    => true, // Allows user to create new posts
// 		'edit_posts'      => true, // Allows user to edit their own posts
// 	)
// );

/*************** Start General Tab Custom Field *******************/
//add_action('um_after_account_general', 'custom_field_for_general', 100);
function custom_field_for_general()
{
	$id = um_user('ID');
	$output = '';
	$names = array('user_profile_photo');
	$fields = array();
	foreach ($names as $name)
		$fields[$name] = UM()->builtin()->get_specific_field($name);
	$fields = apply_filters('um_account_secure_fields', $fields, $id);
	foreach ($fields as $key => $data)
		$output .= UM()->fields()->edit_field($key, $data);
	echo $output;
}

//add_action('um_account_pre_update_profile', 'get_user_profile_photo', 100);
function get_user_profile_photo()
{
	$id = um_user('ID');
	$names = array('user_profile_photo');
	foreach ($names as $name)
		update_user_meta($id, $name, $_POST[$name]);
}
/*************** End General Tab Custom Field *******************/

/*************** Start View/Add Leads Tab *******************/
/* add new tab called "view_add_leads" */
//add_filter('um_account_page_default_tabs_hook', 'leads_tab', 100);
function leads_tab($tabs)
{
	$tabs[800]['leads']['icon'] = 'um-faicon-th-list';
	$tabs[800]['leads']['title'] = 'View/Add Leads';
	$tabs[800]['leads']['show_button'] = false;
	$tabs[800]['leads']['custom'] = true;
	return $tabs;
}

/* make our new tab hookable */
//add_action('um_account_tab__leads', 'account_tab__leads');
function account_tab__leads($info)
{
	global $ultimatemember;
	extract($info);

	$output = $ultimatemember->account->get_tab_output('leads');
	if ($output) {
		echo $output;
	}
}

/* Finally we add some content in the tab */
//add_filter('um_account_content_hook_leads', 'hook_leads');
function hook_leads($output)
{
	ob_start();
	$user_id = get_current_user_id();
	$args = array(
		'post_type' 		=> 'leads',
		'post_status' 		=> 'publish',
		'orderby'			=> 'date',
		'order'   			=> 'DESC',
		'author' 			=>	$user_id,
		'posts_per_page' 	=> -1
	);
	$leads = new WP_Query($args);
	echo '<div class="um-field client-table">';
	$current_user = wp_get_current_user();
	$current_user_email = $current_user->user_email;
	echo '<input type="hidden" class="current-user-email" value="' . $current_user_email . '">';
	echo '<a class="button btn" href="javascript:void(0)" data-fancybox="dialog" data-src="#add-lead-form">Add Lead</a>';
	if ($leads->have_posts()) { ?>
<table id="leads-table" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Client Name</th>
            <th>Status</th>
            <th>Comments</th>
            <th>Transactions</th>
        </tr>
    </thead>
    <tbody>
        <?php //$all_status = get_field_object( 'field_63aeabb82f058' ); 
				?>
        <?php while ($leads->have_posts()) : $leads->the_post();
					$status = get_field('status'); ?>
        <tr>
            <td class="client-name">
                <?php echo '<a href="javascript:void(0)" data-fancybox="dialog_client_detail_' . get_the_ID() . '" data-src="#' . get_the_ID() . '-client-detail">' . get_the_title() . '</a>'; ?>
            </td>
            <td>
                <?php
							if ($status) {
								echo $status['label'];
							} else {
								echo 'In review';
							}
							?>
            </td>

            <td class="comment-td">
                <?php
							$comments = get_field('comments');
							if ($comments) {
								$last_comment = end($comments);
								echo substr($last_comment['comment'], 0, 20) . '&nbsp; <a href="javascript:void(0)" data-fancybox="dialog_comment_' . get_the_ID() . '" data-src="#' . get_the_ID() . '-comments">Read More</a>';
							} else {
								echo 'No Comments';
							}
							?></td>
            <td class="view-trn"><button data-fancybox="dialog_trn_<?= get_the_ID() ?>"
                    data-src="#<?php echo get_the_ID(); ?>">View Transactions</button></td>
        </tr>

        <div class="custom-fancybox partner_portal_fancybox" id="<?php echo get_the_ID() . '-client-detail'; ?>"
            style="">
            <h2>Client Details</h2>
            <div class="client-details">
                <?php
							$website_url = get_field('website_url');
							$lead_msg = get_the_content(); ?>
                <p><label>Client Name</label>: &nbsp;<?php echo get_the_title(); ?></p>
                <p><label>Email Address</label>: &nbsp;<?php echo get_field('email_id'); ?></p>
                <?php if (empty($website_url)) { ?>
                <p><label>Website URL</label>: &nbsp;<?php echo 'N/A'; ?></p>
                <?php } else { ?>
                <p><label>Website URL</label>: &nbsp;<?php echo get_field('website_url'); ?></p>
                <?php } ?>
                <?php if (empty($lead_msg)) { ?>
                <p><label>Lead Message</label>: &nbsp;<?php echo 'N/A'; ?></p>
                <?php } else { ?>
                <p><label>Lead Message</label>: &nbsp;<?php echo $lead_msg; ?></p>
                <?php } ?>
            </div>
        </div>

        <div class="custom-fancybox partner_portal_fancybox" id="<?php echo get_the_ID() . '-comments'; ?>" style="">
            <h2>All Comments</h2>
            <div class="all-comments"><?php
													if (have_rows('comments')) {
														while (have_rows('comments')) : the_row(); ?>
                <div class="comment">
                    <?php $user_id = get_sub_field('comment_writer');
															$user = get_userdata($user_id);
															$user_name = $user->nickname;
															$comment_date = get_sub_field('comment_date');
															// echo $comment_date.' '.$user_name.'- '.get_sub_field('comment');
															echo '<label>( ' . $comment_date . ' ) ' . $user_name . '</label>- &nbsp ' . get_sub_field('comment'); ?>
                </div>
                <?php endwhile;
													} else {
														echo '<p class="comment-not-found">No Comments Found!</p>';
													} ?>
            </div>
            <?php
						// $user_id = get_current_user_id();
						// $user = get_userdata( $user_id );
						// $user_name = $user->nickname;
						?>
            <!-- <div class="comment-form">
								<input class="admin-ajax-url" type="hidden" value="<?php //echo admin_url('admin-ajax.php'); 
																					?>" />
								<input class="current-date" type="hidden" value="<?php //echo date( 'm/d/Y' ); 
																					?>" />
								<input class="current-post-id" type="hidden" value="<?php //echo get_the_ID(); 
																					?>" />
								<input class="current-user-name" type="hidden" value="<?php //echo $user_name; 
																						?>" />
								<input type="text" class="your-comment" value="" tabindex="1" name="your-comment" />
								<a href="javascript:void(0)" class="add-new-comment button btn">Add Comment</a>
							</div> -->
        </div>
        <?php endwhile;
				wp_reset_postdata(); ?>
    </tbody>
</table>
<?php while ($leads->have_posts()) : $leads->the_post(); ?>
<div class="custom-fancybox partner_portal_fancybox" id="<?php echo get_the_ID(); ?>" style="">
    <h2>View Transactions</h2>
    <div class="trn-box"><?php
										if (have_rows('transactions')) { ?>
        <table id="client-transaction-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Transaction Date</th>
                    <th>Invoice Number</th>
                    <th>Amount</th>
                    <!-- <th>Commission</th> -->
                </tr>
            </thead>
            <tbody>
                <?php while (have_rows('transactions')) : the_row();
												$invoice_amount = get_sub_field('amount');
												if (get_field('user_currency', 'user_' . $user_id)) {
													$user_currency = get_field('user_currency', 'user_' . $user_id);
												} else {
													$user_currency = '$';
												}

												// $commission_percentage = 10;
												// $commission = ($invoice_amount*$commission_percentage)/100;
								?>
                <tr>
                    <td><?php echo get_sub_field('transaction_date'); ?></td>
                    <td class="invoice-number"><?php echo get_sub_field('invoice_number'); ?></td>
                    <td class="currency-number"><?php echo $user_currency . $invoice_amount; ?></td>
                    <!-- <td><?php //echo $commission; 
													?></td> -->
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table><?php
										} else {
											echo '<div class="not-found">No Transactions Found!</div>';
										} ?>
    </div>
</div>
<?php endwhile;
	} else {
		echo '<div class="not-found">No Leads found!</div>';
	}
	echo '</div>';
	$output .= ob_get_contents();
	ob_end_clean();
	echo '<div id="add-lead-form" style="display:none; width:35%;">' . do_shortcode('[add_lead]') . '</div>';
	return $output;
}
/*************** End View/Add Leads Tab *******************/

/*************** Start Transaction Tab *******************/
/* add new tab called "transaction" */
//add_filter('um_account_page_default_tabs_hook', 'transaction_tab', 100);
function transaction_tab($tabs)
{
	$tabs[801]['transaction']['icon'] = 'um-faicon-list-alt';
	$tabs[801]['transaction']['title'] = 'View Transactions';
	$tabs[801]['transaction']['show_button'] = false;
	$tabs[801]['transaction']['custom'] = true;
	return $tabs;
}

/* make our new tab hookable */
//add_action('um_account_tab__transaction', 'account_tab__transaction');
function account_tab__transaction($info)
{
	global $ultimatemember;
	extract($info);

	$output = $ultimatemember->account->get_tab_output('transaction');
	if ($output) {
		echo $output;
	}
}

/* Finally we add some content in the tab */
//add_filter('um_account_content_hook_transaction', 'hook_transaction');
function hook_transaction($output)
{
	ob_start();
	$user_id = get_current_user_id();
	$args = array(
		'post_type' 		=> 'leads',
		'post_status' 		=> 'publish',
		'author' 			=>	$user_id,
		'posts_per_page' 	=> -1
	);
	$leads = new WP_Query($args); ?>
<div class="um-field">
    <?php if ($leads->have_posts()) { ?>
    <table id="view-transaction-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Transaction Date</th>
                <th>Client Name</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Commission</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($leads->have_posts()) : $leads->the_post();
						if (have_rows('transactions')) {
							while (have_rows('transactions')) : the_row();
								$transaction_date = get_sub_field('transaction_date');
								$invoice_amount = get_sub_field('amount');
								$commission_percentage = 10;
								$commission = ($invoice_amount * $commission_percentage) / 100;
								if (get_field('user_currency', 'user_' . $user_id)) {
									$user_currency = get_field('user_currency', 'user_' . $user_id);
								} else {
									$user_currency = '$';
								}
					?>
            <tr>
                <td><?php echo $transaction_date; ?></td>
                <td><?php echo get_the_title(); ?></td>
                <td class="invoice-number"><?php echo get_sub_field('invoice_number'); ?></td>
                <td class="currency-number"><?php echo $user_currency . $invoice_amount; ?></td>
                <td class="currency-number"><?php echo $user_currency . $commission; ?></td>
            </tr>
            <?php endwhile;
						}
					endwhile; ?>
        </tbody>
    </table>
    <?php } else {
			echo '<div class="not-found">No Transactions Found!</div>';
		} ?>
</div>
<?php
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
}
/*************** End Transaction Tab *******************/

/*************** Start View Payout Tab *******************/
/* add new tab called "payout" */
//add_filter('um_account_page_default_tabs_hook', 'payout_tab', 100);
function payout_tab($tabs)
{
	$tabs[802]['payout']['icon'] = 'um-faicon-print';
	$tabs[802]['payout']['title'] = 'View Payouts';
	$tabs[802]['payout']['show_button'] = false;
	$tabs[802]['payout']['custom'] = true;
	return $tabs;
}

/* make our new tab hookable */
//add_action('um_account_tab__payout', 'account_tab__payout');
function account_tab__payout($info)
{
	global $ultimatemember;
	extract($info);

	$output = $ultimatemember->account->get_tab_output('payout');
	if ($output) {
		echo $output;
	}
}

/* Finally we add some content in the tab */
//add_filter('um_account_content_hook_payout', 'hook_payout');
function hook_payout($content = '')
{
	ob_start();
	$output = '';
	$output .= '<div class="um-field">';
	$user_id = get_current_user_id();
	if (get_field('user_currency', 'user_' . $user_id)) {
		$user_currency = get_field('user_currency', 'user_' . $user_id);
	} else {
		$user_currency = '$';
	}
	global $wpdb;
	$table_name = $wpdb->prefix . 'payouts';
	$payouts = $wpdb->get_results("SELECT * FROM $table_name WHERE ( partner_id = $user_id AND status = 'paid' ) ");
	if ($payouts) {
		$total_collection = 0;
		$output .= '<table id="payout-separate-table" class="display" style="width:100%">
				<thead>
					<tr>
						<th hidden>Ordering</th>
						<th>Date</th>
						<th>Invoice ID</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>';
		foreach ($payouts as $payout) {
			$month_and_year = $payout->month_and_year;
			$separate_month_year = explode(",", $month_and_year);
			$just_month = $separate_month_year[0];
			$month_number = date('m', strtotime($just_month));
			$just_year = $separate_month_year[1];
			$total_collection = $total_collection + $payout->amount;
			$output .= '<tr>
						<td hidden>' . $just_year . $month_number . '</td>
						<td>' . $month_and_year . '</td>
						<td class="invoice-id">' . $payout->invoice_id . '</td>
						<td class="currency-number">' . $user_currency . $payout->amount . '</td>
					</tr>';
		}
		$output .= '</tbody>
			</table>';
		echo '<h6 class="total-collection green"><strong>Total Collection: ' . $user_currency . $total_collection . '</strong></h6>';
	} else {
		$output .= '<div class="not-found">No Payouts Found!</div>';
	}
	$output .= '</div>';
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
}
/*************** End View Payout Tab *******************/

/*************** Start Update Paypal ID Tab *******************/
/* add new tab called "paypal" */
//add_filter('um_account_page_default_tabs_hook', 'paypal_tab', 100);
function paypal_tab($tabs)
{
	$tabs[803]['paypal']['icon'] = 'um-faicon-pencil';
	$tabs[803]['paypal']['title'] = 'Update Paypal ID';
	$tabs[803]['paypal']['custom'] = true;
	return $tabs;
}

/* make our new tab hookable */
//add_action('um_account_tab__paypal', 'account_tab__paypal');
function account_tab__paypal($info)
{
	global $ultimatemember;
	extract($info);

	$output = $ultimatemember->account->get_tab_output('paypal');
	if ($output) {
		echo $output;
	}
}

/* Finally we add some content in the tab */
//add_filter('um_account_content_hook_paypal', 'hook_paypal');
function hook_paypal($output)
{
	ob_start();
	$user_id = get_current_user_id();
?>
<div class="um-field">
</div>
<?php
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
}

//add_action('um_after_account_paypal', 'custom_field_for_paypal', 100);
function custom_field_for_paypal()
{
	$id = um_user('ID');
	$output = '';
	$names = array('paypal_id');
	$fields = array();
	foreach ($names as $name)
		$fields[$name] = UM()->builtin()->get_specific_field($name);
	$fields = apply_filters('um_account_secure_fields', $fields, $id);
	foreach ($fields as $key => $data)
		$output .= UM()->fields()->edit_field($key, $data);
	echo $output;
}

//add_action('um_account_pre_update_profile', 'get_paypal_id', 100);
function get_paypal_id()
{
	$id = um_user('ID');
	$names = array('paypal_id');
	foreach ($names as $name)
		update_user_meta($id, $name, $_POST[$name]);
}

/*************** End Update Paypal ID Tab *******************/

function add_lead()
{
	if (is_user_logged_in()) {
		ob_start();
		$result = '';
		/*if (isset($_POST['new_lead'])) {
			$result1 .= '<p class="green">Your lead has been added successfully!</p>';

			form_submission();
			
			header("Refresh:0; url=" . site_url() . "/account/leads");

			return $result1;
			// die;
		}*/
		
		if(isset($_GET['ldsuccess']) && $_GET['ldsuccess'] == 1){
			$result .= '<p style="color:green" class="ldsc">Your lead has been added successfully!</p>';
		}
		
		$result .= '<form id="new_lead" name="new_lead" method="post" action="">';
		$result .= '<p><label for="client-name">Client Name</label><input type="text" id="client-name" value="" tabindex="1" name="client-name" required /></p>';
		//$result .= '<p><label for="business-name">Business Name</label><input type="text" id="business-name" value="" tabindex="1" name="business-name" required /></p>';
		$result .= '<p><label for="email-id">Email ID</label><input type="email" id="email-id" value="" tabindex="1" name="email-id" required /></p>';
		$result .= '<p><label for="website-url">Website URL</label><input type="text" id="website-url" value="" tabindex="1" name="website-url" /></p>';
		$result .= '<p><label for="lead-message">Message</label><input type="text" id="lead-message" value="" tabindex="1" name="lead-message" required /></p>';
		/*$result .= '<p><label for="status">Status</label><br />';
		$result .= '<select id="status" name="status">';
		$field = get_field_object('field_63aeabb82f058');
		$result .= '<option>Select</option>';
		foreach ($field['choices'] as $key => $value) {
			$result .= '<option value="'.$key.'">'.$value.'</option>';
		}
		$result .= '</select>';
		$result .= '</p>';
		$result .= '<p><label for="comment">Comment</label><input type="text" id="comment" value="" tabindex="1" name="comment" /></p>'; */
		$result .= wp_nonce_field('add-lead-form');
		$result .= '<p style="text-align:center;"><button type="submit" id="add_new_lead" form="new_lead" value="Add Lead" name="new_lead" class="button">Add Lead</button></p>';
		$result .= '</form>';
		ob_end_clean();
		return $result;
	} else {
		wp_safe_redirect(site_url());
	}
}
add_shortcode('add_lead', 'add_lead');

//add_action( 'init', 'form_submission' );
function form_submission()
{
	if (isset($_POST['new_lead'])) {
		$user_info = wp_get_current_user();
		if (is_user_logged_in()) {
			$user_id = $user_info->ID;
			$user_email = $user_info->user_email;
		} else {
			$user_id = 1;
		}

		$client_name = $_POST['client-name'];
		//$business_name = $_POST['business-name'];
		$email_id = $_POST['email-id'];
		$website_url = $_POST['website-url'];
		$lead_message = $_POST['lead-message'];
		//$status = $_POST['status'];
		// $comment = $_POST['comment'];

		$new_lead = array(
			'post_title'    => $client_name,
			'post_content'  => $lead_message,
			'post_type'		=> 'leads',
			'post_status'   => 'publish',
			'post_author'   => $user_id
		);

		// Insert the post into the database
		$new_lead_id = wp_insert_post($new_lead);
		//update_field( 'business_name', $business_name, $new_lead_id );
		update_field('email_id', $email_id, $new_lead_id);
		update_field('website_url', $website_url, $new_lead_id);
		//update_field( 'status', $status, $new_lead_id );

		$multiple_recipients = array(
			'chirag@elsner.com',
			'harshal@elsner.in'
		);
		$subj = 'New Lead Added - Elsner Partner Program';
		$body = 'Hello, <br>New Lead have been added by ' . $user_info->display_name;
		$body = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
			<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
			<tbody>
				<tr>
					<td style="padding: 15px;">
						<center>
							<table style="width: 100%; max-width: 800px; background-color: #ffffff;">
								<tbody>
									<tr>
										<td style="height: 40px;"></td>
									</tr>
									<tr>
										<td style="text-align: center;">
											<a href="https://elsner.com/">
												<img src="https://elsner.com/wp-content/uploads/2023/05/Elsner-logo.png" alt="Elsner Technologies Pvt Ltd">
											</a>
										</td>
									</tr>
									<tr>
										<td style="height: 40px;"></td>
									</tr>
									<tr>
										<td style="margin: 24px;">
											<table style="width: 100%; background-color: #ffffff;">
												<tbody>
													<tr>
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/new-lead.png" alt="New Lead Added by ' . $user_info->display_name . '"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">New Lead Added by ' . $user_info->nickname . '</h1></td>
													</tr>
													<tr>
														<td style="height: 40px;"></td>
													</tr>
													<tr>
														<td>
															<table style="width: 100%; background-color: #03497A; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px; border-radius: 10px; background-image: url(https://elsner.com/wp-content/uploads/2023/05/epp-email-bg.png); background-size: cover; background-position: center; background-repeat: no-repeat;">
																<tbody>
																	<tr>
																		<td style="padding: 40px 20px;">
																			<table style="max-width: 700px; margin-left: auto; margin-right: auto;">
																				<tbody>
																					<tr>
																						<td>
																							<span style="display: inline-block; background-image: url(https://elsner.com/wp-content/uploads/2023/05/heading-bg.png); background-repeat: no-repeat; background-size: 100% 100%; background-position: center; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:16px; font-weight: 600; line-height: 1.8; letter-spacing: 7px; text-transform: uppercase; padding: 8px 18px; border-radius: 10px;">
																								Hello Admin,
																							</span>
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #ffffff;">';
		$body .= "<p style='color: #ffffff;'>We wanted to inform you that a new lead has been added to Elsner Partner Program by <b>" . $user_info->nickname . ".</b> Please log in to your account to review the details and follow up with <b>" . $user_info->nickname . "</b> if necessary.</p>";
		$body .= "<p style='color: #ffffff;'><b>Lead Information:</b><br/>Client Name: " . $client_name . "<br/>Email: " . $email_id . "<br/>Website: " . $website_url . "<br/>Message: " . $lead_message . "<br/></p>";
		$body .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
		$body .= '
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #00BDF2; font-family: Helvetica, Arial, sans-serif; font-size:20px; font-weight: 600;">
																							<span>
																								Best regards,<br>
																								Team Elsner
																							</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</center>
					</td>
				</tr>
			</tbody>
			</table>
			</body>';
		$authorbody = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
			<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
			<tbody>
				<tr>
					<td style="padding: 15px;">
						<center>
							<table style="width: 100%; max-width: 800px; background-color: #ffffff;">
								<tbody>
									<tr>
										<td style="height: 40px;"></td>
									</tr>
									<tr>
										<td style="text-align: center;">
											<a href="https://elsner.com/">
												<img src="https://elsner.com/wp-content/uploads/2023/05/Elsner-logo.png" alt="Elsner Technologies Pvt Ltd">
											</a>
										</td>
									</tr>
									<tr>
										<td style="height: 40px;"></td>
									</tr>
									<tr>
										<td style="margin: 24px;">
											<table style="width: 100%; background-color: #ffffff;">
												<tbody>
													<tr>
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/new-lead.png" alt="New Lead Added by ' . $user_info->display_name . '"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">New Lead Added</h1></td>
													</tr>
													<tr>
														<td style="height: 40px;"></td>
													</tr>
													<tr>
														<td>
															<table style="width: 100%; background-color: #03497A; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px; border-radius: 10px; background-image: url(https://elsner.com/wp-content/uploads/2023/05/epp-email-bg.png); background-size: cover; background-position: center; background-repeat: no-repeat;">
																<tbody>
																	<tr>
																		<td style="padding: 40px 20px;">
																			<table style="max-width: 700px; margin-left: auto; margin-right: auto;">
																				<tbody>
																					<tr>
																						<td>
																							<span style="display: inline-block; background-image: url(https://elsner.com/wp-content/uploads/2023/05/heading-bg.png); background-repeat: no-repeat; background-size: 100% 100%; background-position: center; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:16px; font-weight: 600; line-height: 1.8; letter-spacing: 7px; text-transform: uppercase; padding: 8px 18px; border-radius: 10px;">
																								Hello Member,
																							</span>
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #ffffff;">';
		$authorbody .= "<p style='color: #ffffff;'>We wanted to inform you that a your lead has been added to Elsner Partner Program.</p>";
		$authorbody .= "<p style='color: #ffffff;'>Thank you for your support.</p>";
		$authorbody .= '
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #00BDF2; font-family: Helvetica, Arial, sans-serif; font-size:20px; font-weight: 600;">
																							<span>
																								Best regards,<br>
																								Team Elsner
																							</span>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</center>
					</td>
				</tr>
			</tbody>
			</table>
			</body>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		//wp_mail($multiple_recipients, $subj, $body, $headers);
		//wp_mail($user_email, $subj, $authorbody, $headers);
		
		wp_redirect(home_url('account/?ldsuccess=1'));
		exit;
	}
}

function custom_admin_menu_pages()
{
	add_menu_page(
		'Transactions',
		'Transactions',
		'edit_posts',
		'Transactions',
		'transactions_callback_function',
		'dashicons-money-alt',
		71
	);

	add_menu_page(
		'Payouts',
		'Payouts',
		'edit_posts',
		'Payouts',
		'payouts_callback_function',
		'dashicons-bank',
		72
	);
}
//add_action('admin_menu', 'custom_admin_menu_pages');

function transactions_callback_function()
{
	echo '<div class="wrap">';
	$args = array(
		'post_type' 		=> 'leads',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
	);
	$leads = new WP_Query($args);
	echo '<h1 class="wp-heading-inline">All Transactions</h1>';
	if ($leads->have_posts()) {
		echo '<table id="view-transaction-table" class="display" style="width:100%">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Client Name</th>
						<th>Invoice Number</th>
						<th>Amount</th>
						<th>Commission</th>
					</tr>
				</thead>
				<tbody>';
		while ($leads->have_posts()) : $leads->the_post();
			$author_id = get_post_field('post_author', get_the_ID());

			if (have_rows('transactions')) {
				while (have_rows('transactions')) : the_row();
					$transaction_date = get_sub_field('transaction_date');
					$invoice_amount = get_sub_field('amount');
					$commission_percentage = 10;
					$commission = ($invoice_amount * $commission_percentage) / 100;
					if (get_field('user_currency', 'user_' . $author_id)) {
						$user_currency = get_field('user_currency', 'user_' . $author_id);
					} else {
						$user_currency = '$';
					}
					echo '<tr>
									<td>' . $transaction_date . '</td>
									<td>' . get_the_title() . '</td>
									<td class="invoice-number">' . get_sub_field('invoice_number') . '</td>
									<td class="currency-number">' . $user_currency . $invoice_amount . '</td>
									<td class="currency-number">' . $user_currency . $commission . '</td>
								</tr>';
				endwhile;
			}
		endwhile;
		echo '</tbody>
			</table>';
	} else {
		echo '<div class="not-found">No Transactions Found!</div>';
	}
	echo '</div>';
}

function payouts_callback_function()
{
	echo '<div class="wrap">';
	echo '<h1 class="wp-heading-inline">Payouts</h1>';

	// $partner_users = get_users( array( 'role' => 'partner', ) );

	$args = array(
		'post_type' 		=> 'leads',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> -1,
	);

	$leads = new WP_Query($args);
	if ($leads->have_posts()) {
		$total_collection = 0;
		$temp = array();
		$temp_years = array();

		while ($leads->have_posts()) : $leads->the_post();
			$partner_id = get_post_field('post_author', get_the_ID());
			$partner_name = get_the_author();

			if (have_rows('transactions')) :
				while (have_rows('transactions')) : the_row();
					$invoice_amount = get_sub_field('amount');
					$commission_percentage = 10;
					$payout_amout = ($invoice_amount * $commission_percentage) / 100;
					$total_collection = $total_collection + $payout_amout;

					$transaction_date = get_sub_field('transaction_date');
					$transaction_date_to_str = str_replace('/', '-', $transaction_date);
					$transaction_month = date('F', strtotime($transaction_date_to_str));
					$date = str_replace('/', '-', $transaction_date);
					$newDate_month = date('F', strtotime($date));
					$newDate_year = date('Y', strtotime($date));

					$temp_years[$newDate_year] = $newDate_year;

					$temp[$newDate_year][$newDate_month][$partner_name]['partner_id'] = $partner_id;
					$temp[$newDate_year][$newDate_month][$partner_name]['partner_name'] = $partner_name;

					if (isset($temp[$newDate_year][$newDate_month][$partner_name]['amount']) && $temp[$newDate_year][$newDate_month][$partner_name]['amount'] > 0) {
						$temp_amount = $temp[$newDate_year][$newDate_month][$partner_name]['amount'] + $payout_amout;
						$temp[$newDate_year][$newDate_month][$partner_name]['amount'] = $temp_amount;
					} else {
						$temp[$newDate_year][$newDate_month][$partner_name]['amount'] = $payout_amout;
					}

				endwhile;
			endif;
		endwhile;

		krsort($temp);
		krsort($temp_years);
	}


	// echo '<pre>';
	// print_r( $temp );
	// echo '</pre>';

	global $wpdb;
	$table_name = $wpdb->prefix . 'payouts';

	$payouts = $wpdb->get_results("SELECT * FROM $table_name");
	$all_unique_ids = array();
	foreach ($payouts as $payout) {
		$all_unique_ids[] = $payout->unique_id;
		$all_amount[$payout->unique_id] = $payout->amount;
		$invoice_id[$payout->unique_id] = $payout->invoice_id;
		$status[$payout->unique_id] = $payout->status;
	}

	// echo '<pre>';
	// print_r( $status );
	// echo '</pre>';

	$yearly_payout = $temp;
	if ($yearly_payout) {
		echo '<input class="admin-ajax-url" type="hidden" value="' . admin_url('admin-ajax.php') . '">';
		echo '<table id="view-payouts-table" class="display" style="width:100%">
				<thead>
					<tr>
						<th hidden>ordering</th>
						<th hidden>Unique ID</th>
						<th>Partner Name</th>
						<th>Month and year</th>
						<th>Invoice ID</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		foreach ($yearly_payout as $year => $monthly_detail) {
			foreach ($monthly_detail as $month => $user_wise_detail) {
				$month_number = date('m', strtotime($month));
				foreach ($user_wise_detail as $user => $user_details) {
					$create_time = (new DateTime)->getTimestamp();
					$paid_date = '';
					$partner_id = $user_details['partner_id'];
					$partner_name = $user_details['partner_name'];
					$amount = $user_details['amount'];
					$month_and_year = $month . ', ' . $year;
					$unique_id = $year . '-' . $month_number . '-' . $partner_id;

					if (in_array($unique_id, $all_unique_ids)) {
						$dbAmount = $all_amount[$unique_id];
						if ($dbAmount != $amount) {
							$wpdb->update($table_name, array('amount' => $amount), array('unique_id' => $unique_id));
						}
					} else {
						$wpdb->insert($table_name, array(
							'unique_id'			=> $unique_id,
							'partner_id' 		=> $partner_id,
							'partner_name' 		=> $partner_name,
							'month_and_year' 	=> $month_and_year,
							'amount' 			=> $amount,
						));
					}

					$status_var = $status[$unique_id];
					$selected = '';
					if ($status_var == 'paid') {
						$selected = 'selected';
					}
					if (get_field('user_currency', 'user_' . $partner_id)) {
						$user_currency = get_field('user_currency', 'user_' . $partner_id);
					} else {
						$user_currency = '$';
					}
					echo '<tr>
									<td hidden>' . $year . $month_number . '</td>
									<td class="unique-id" hidden>' . $unique_id . '</td>
									<td>' . $user . '</td>
									<td>' . $month . ', ' . $year . '</td>
									<td class="invoice-id">' . $invoice_id[$unique_id] . '</td>
									<td>' . $user_currency . $user_details['amount'] . '</td>
									<td class="updated-status">
										<select class="payout-status-selection">
											<option value="pending">Pending</option>
											<option value="paid"' . $selected . '>Paid</option>
										</select>
									</td>
									<td><a class="custom-update button" href="javascript:void(0)">Update</td>
								</tr>';
				}
			}
		}
		echo '</tbody>
			</table>';
	} else {
		echo '<div class="not-found">No Payouts Found!</div>';
	}
	echo '</div>';
}

function admin_payout_management()
{
	$unique_id 	= $_REQUEST['unique_id'];
	$invoice_id = $_REQUEST['invoice_id'];
	$status 	= $_REQUEST['status'];
	$paid_date 	= current_time('timestamp');

	if ($invoice_id != '' || $invoice_id != NULL || $invoice_id != 'undefined') {
		// print_r( $invoice_id );
		// print_r( $status );
		// print_r( $unique_id );
		// print_r( $paid_date );

		global $wpdb;
		$table_name = $wpdb->prefix . 'payouts';
		$wpdb->update($table_name, array('invoice_id' => $invoice_id, 'status' => $status, 'paid_date' => $paid_date), array('unique_id' => $unique_id));
	}
	wp_die();
}
//add_action('wp_ajax_admin_payout_management', 'admin_payout_management');
// //add_action( 'wp_ajax_nopriv_admin_payout_management', 'admin_payout_management' );

// function user_profile_picture(){
// 	var_dump($_FILES);
//     exit();
// $user_id = get_current_user_id();
// // print_r( $user_profile_image );
// require_once( ABSPATH . 'wp-admin/includes/image.php' );
// require_once( ABSPATH . 'wp-admin/includes/file.php' );
// require_once( ABSPATH . 'wp-admin/includes/media.php' );
// if( $user_image != '' && $user_image != 'undefined' ){
// 	$uploadedfile = $user_image;
// 	$movefile = wp_handle_upload( $uploadedfile, array('test_form' => false) );
// 	if ($movefile) {
// 		$wp_upload_dir = wp_upload_dir();
// 		$attachment = array(
// 			'guid' => $wp_upload_dir['url'].'/'.basename($movefile['file']),
// 			'post_mime_type' => $movefile['type'],
// 			'post_title' => preg_replace('/\.[^.]+$/', "", basename($movefile['file'])),
// 			'post_content' => "",
// 			'post_status' => 'inherit'
// 		);
// 		$attach_id = wp_insert_attachment($attachment, $movefile['file']);

// 		update_field('user_profile_photo', $attach_id, 'user_'.$user_id);
// 	}
// }
// 	wp_die();
// }
// //add_action( 'wp_ajax_user_profile_picture', 'user_profile_picture' );
// //add_action( 'wp_ajax_nopriv_user_profile_picture', 'user_profile_picture' );

function db_custom_table()
{
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$tablename = $wpdb->prefix . 'payouts';
	$charset_collate = $wpdb->get_charset_collate();
	// $main_sql_create = 'CREATE TABLE ' . $tablename . ';';
	$main_sql_create = "CREATE TABLE " . $tablename . " (
		id int(11) NOT NULL AUTO_INCREMENT,
		unique_id varchar(11) NOT NULL,
		partner_id int(10) NOT NULL,
		partner_name VARCHAR(20) NOT NULL,
		month_and_year varchar(15),
		invoice_id varchar(40),
		amount varchar(40),
		status varchar(20),
		paid_date varchar(20),
		created_at timestamp default current_timestamp, 
  		updated_at timestamp on update now() ,
		PRIMARY KEY  (id)
		) $charset_collate;";
	maybe_create_table($tablename, $main_sql_create);
}
//add_action('admin_init', 'db_custom_table');

//add_action('um_custom_field_validation_user_email_details', 'um_custom_validate_user_email_details', 999, 3);
function um_custom_validate_user_email_details($key, $array, $args)
{
	if ($key == 'user_email' && isset($args['user_email'])) {
		if (isset(UM()->form()->errors['user_email'])) {
			unset(UM()->form()->errors['user_email']);
		}
		if (empty($args['user_email'])) {
			UM()->form()->add_error('user_email', __('E-mail Address is required', 'ultimate-member'));
		} elseif (!is_email($args['user_email'])) {
			UM()->form()->add_error('user_email', __('The email you entered is invalid', 'ultimate-member'));
		} elseif (email_exists($args['user_email'])) {
			UM()->form()->add_error('user_email', __('Entered email address is already exist', 'ultimate-member'));
		}
	}
}

//add_filter('gettext', 'custom_text_for_reset_password_page');
function custom_text_for_reset_password_page($text)
{
	$text = str_ireplace('To reset your password, please enter your email address or username below.', 'To reset your password, please enter your email address below.', $text);
	return $text;
}
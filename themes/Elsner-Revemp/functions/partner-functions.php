<?php

//add_action('save_post_leads', 'fun_save_post_leads', 10, 3);   
function fun_save_post_leads($post_id, $post, $update)
{
	if ($update) {
		$new_value = $_REQUEST['acf']['field_644b71edfd2d8'];

		$new_field_vals = array();
		if ($new_value) {
			$j = 0;
			foreach ($new_value as $nkeys => $nvalues) {
				$new_field_vals[$j]['date'] = $nvalues['field_644b73c5fd2d9'];
				$new_field_vals[$j]['no'] = $nvalues['field_644b73d5fd2da'];
				$new_field_vals[$j]['amt'] = $nvalues['field_644b73e8fd2db'];
				$j++;
			}
		}

		$old_value = get_field('transactions', $post_id, true);
		$old_field_vals = array();
		if ($old_value) {
			$j = 0;
			foreach ($old_value as $okeys => $ovalues) {
				$temp_date = explode('/', $ovalues['transaction_date']);
				if ($temp_date) {
					$old_field_vals[$j]['date'] = $temp_date[2] . $temp_date[1] . $temp_date[0];
				}
				$old_field_vals[$j]['no'] = $ovalues['invoice_number'];
				$old_field_vals[$j]['amt'] = $ovalues['amount'];
				$j++;
			}
		}

		$change_flag = 0;

		foreach ($old_field_vals as $ofv_key => $ofv_value) {
			if ($ofv_value['date'] != $new_field_vals[$ofv_key]['date']) {
				$change_flag = 1;
				break;
			}
			if ($ofv_value['no'] != $new_field_vals[$ofv_key]['no']) {
				$change_flag = 1;
				break;
			}
			if ($ofv_value['amt'] != $new_field_vals[$ofv_key]['amt']) {
				$change_flag = 1;
				break;
			}
		}

		if (count($old_field_vals) != count($new_field_vals)) {
			$change_flag = 1;
		}

		/*for ($i=0; $i < count($old_field_vals); $i++) { 
			if( $old_field_vals[$i] != $new_field_vals[$i] ){
				$change_flag = 1;
				break;
			}
		}*/
		$post = get_post($post_id);
		$lead_name = $post->post_title;
		$author_id = $post->post_author;
		$author_email = get_the_author_meta('user_email', $author_id);
		$author_name = get_the_author_meta('nickname', $author_id);
		$title = get_the_title($post_id);

		// Send email if transactions are updated
		if ($change_flag > 0) {
			// Prepare email content
			$subject = 'New Transaction added to ' . get_the_title($post_id);
			$temp_date = '';
			foreach ($new_field_vals as $nkey => $nvalue) {

				/*echo '<pre>';
			    print_r($nvalue);
			    echo '</pre>';*/
				// code...
				$temp_date .= '<br/>Transaction date: ' . date('YYYY-mm-dd', strtotime($nvalue['date'])) . '<br/>';
				$temp_date .= 'Invoice number: ' . $nvalue['no'] . '<br/>';
				$temp_date .= 'Amount: $' . $nvalue['amt'] . '<br/>';
			}
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
															<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/txn.png" alt="New Transaction Added to Portal"></td>
														</tr>
														<tr>
															<td><h1 style="color: #ffffff; margin: 0; text-align: center;">New Transaction Added to Portal</h1></td>
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
			$body .= "<p style='color: #ffffff;'>We wanted to inform you that a new transaction has been added to:<b>" . $lead_name . " </b><b>" . $temp_date . "</b>Please log in to your account to review the details and confirm that they are accurate.</p>";
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
															<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/txn.png" alt="New Transaction Added to Portal"></td>
														</tr>
														<tr>
															<td><h1 style="color: #F56F07; margin: 0; text-align: center;">New Transaction Added to Portal</h1></td>
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
																									Hello ' . $author_name . ',
																								</span>
																							</td>
																						</tr>
																						<tr>
																							<td style="height: 30px;"></td>
																						</tr>
																						<tr>
																							<td style="color: #ffffff;">';
			$authorbody .= "<p style='color: #ffffff;'>We wanted to inform you that a new transaction has been added to: <b>" . $lead_name . "</b> <b>" . $temp_date . "</b> Please log in to your account to review the details and confirm that they are accurate.</p>";
			$authorbody .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
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

			/*$body .= 'Transaction date: ' . $latest_transaction['transaction_date'] . '<br/>';
	        $body .= 'Invoice number: ' . $latest_transaction['invoice_number'] . '<br/>';
	        $body .= 'Amount: ' . $latest_transaction['amount'] . '<br/>';*/

			// $body .= $temp_date;

			// Send email to admin
			$admin_email = array(
				'chirag@elsner.com',
				'harshal@elsner.in'

			);
			$headers = array('Content-Type: text/html; charset=UTF-8');
			//wp_mail($admin_email, $subject, $body, $headers);

			// Send email to user
			//wp_mail($author_email, $subject, $authorbody, $headers);
		}

		/*echo '<pre>';
	    print_r($new_field_vals);
	    echo '</pre>';
	    echo '<pre>';
	    print_r($change_flag);
	    echo '</pre>';
	    exit;
	    */

		$status_updated = false;
		// Get the updated value of the status select field
		$field_name = 'status';
		$new_value = '';

		if (is_array(get_field($field_name, $post_id, true))) {
			$new_value = get_field($field_name, $post_id, true)['value'];
		} elseif (get_field($field_name, $post_id, true)) {
			$new_value = get_field($field_name, $post_id, true);
		}

		// Get the old value of the status select field from the post
		$old_value = '';

		if (isset($_POST['acf']['field_645897048990a'])) {
			$old_value = $_POST['acf']['field_645897048990a'];
		}

		// Compare the old and new values and set the flag if they are different
		if ($new_value !== $old_value) {
			$status_updated = true;
		}

		// Send email if status is updated
		if ($status_updated) {
			if ($old_value === 'won') {
				$subject = 'Won Client Notification';
				$messageadmin = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
													<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Won-Client-Notification.png" alt="Won Client Notification"></td>
												</tr>
												<tr>
													<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Won Client Notification</h1></td>
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
				$messageadmin .= "<p style='color: #ffffff;'>We're happy to inform you that we have won a new client $lead_name who has decided to use our services. Please log in to your account to review the details and follow up with the client as necessary.</p>";
				$messageadmin .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageadmin .= '
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
				$messageauthor = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Won-Client-Notification.png" alt="Won Client Notification"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Won Client Notification</h1></td>
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
																								Hello ' . $author_name . ',
																							</span>
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #ffffff;">';
				$messageauthor .= "<p style='color: #ffffff;'>We're happy to inform you that we have won a new client $lead_name who has decided to use our services. Please log in to your account to review the details and follow up with the client as necessary.</p>";
				$messageauthor .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageauthor .= '
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
			} elseif ($old_value === 'lost') {
				$subject = 'Lost Client Notification';
				$messageadmin = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Lost-Client-Notification.png" alt="Lost Client Notification"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Lost Client Notification</h1></td>
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
				$messageadmin .= "<p style='color: #ffffff;'>We regret to inform you that a client $lead_name we were working with has decided to discontinue our discussion. Please log in to your account to review the details and follow up with the client as necessary.</p>";
				$messageadmin .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageadmin .= '
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
				$messageauthor = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Lost-Client-Notification.png" alt="Lost Client Notification"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Lost Client Notification</h1></td>
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
																								Hello ' . $author_name . ',
																							</span>
																						</td>
																					</tr>
																					<tr>
																						<td style="height: 30px;"></td>
																					</tr>
																					<tr>
																						<td style="color: #ffffff;">';
				$messageauthor .= "<p style='color: #ffffff;'>We regret to inform you that a client $lead_name we were working with has decided to discontinue our discussion. Please log in to your account to review the details and follow up with the client as necessary.</p>";
				$messageauthor .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageauthor .= '
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
			} elseif ($old_value === 'future') {
				$subject = 'Future with Client Notification';
				$messageadmin = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Future-with-Client-Notification.png" alt="Future with Client Notification"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Future with Client Notification</h1></td>
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
				$messageadmin .= "<p style='color: #ffffff;'>We wanted to inform you that a client $lead_name has expressed interest in working with us in the future. Please log in to your Elsner Partner Program account to review the details and follow up with the client as necessary.</p>";
				$messageadmin .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageadmin .= '
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
				$messageauthor = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
															<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/Future-with-Client-Notification.png" alt="Future with Client Notification"></td>
														</tr>
														<tr>
															<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Future with Client Notification</h1></td>
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
																									Hello ' . $author_name . ',
																								</span>
																							</td>
																						</tr>
																						<tr>
																							<td style="height: 30px;"></td>
																						</tr>
																						<tr>
																							<td style="color: #ffffff;">';
				$messageauthor .= "<p style='color: #ffffff;'>We wanted to inform you that a client $lead_name has expressed interest in working with us in the future. Please log in to your Elsner Partner Program account to review the details and follow up with the client as necessary.</p>";
				$messageauthor .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageauthor .= '
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
			} elseif ($old_value === 'discussion') {
				$subject = 'Client Discussion Notification';
				$messageadmin = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/client-disuation.png" alt="Client Discussion Notification"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Client Discussion Notification</h1></td>
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
				$messageadmin .= "<p style='color: #ffffff;'>We wanted to inform you that a new discussion has taken place with one of our clients $lead_name. Please log in to your account to review the details and respond as necessary.</p>";
				$messageadmin .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageadmin .= '
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
				$messageauthor = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
															<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/client-disuation.png" alt="Client Discussion Notification"></td>
														</tr>
														<tr>
															<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Client Discussion Notification</h1></td>
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
																									Hello ' . $author_name . ',
																								</span>
																							</td>
																						</tr>
																						<tr>
																							<td style="height: 30px;"></td>
																						</tr>
																						<tr>
																							<td style="color: #ffffff;">';
				$messageauthor .= "<p style='color: #ffffff;'>We wanted to inform you that a new discussion has taken place with one of our clients $lead_name. Please log in to your account to review the details and respond as necessary.</p>";
				$messageauthor .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageauthor .= '
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
			} else {
				$subject = 'Lead Status';
				$messageadmin = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
														<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/client-disuation.png" alt="Lead Status"></td>
													</tr>
													<tr>
														<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Lead Status</h1></td>
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
				$messageadmin .= "<p style='color: #ffffff;'>The Lead Status of $lead_name has been updated to: $old_value</p>";
				$messageadmin .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageadmin .= '
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
				$messageauthor = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
															<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/client-disuation.png" alt="Lead Status"></td>
														</tr>
														<tr>
															<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Lead Status</h1></td>
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
																									Hello ' . $author_name . ',
																								</span>
																							</td>
																						</tr>
																						<tr>
																							<td style="height: 30px;"></td>
																						</tr>
																						<tr>
																							<td style="color: #ffffff;">';
				$messageauthor .= "<p style='color: #ffffff;'>The Lead Status field has been updated to: $old_value</p>";
				$messageauthor .= "<p style='color: #ffffff;'>Thank you for your prompt attention to this matter.</p>";
				$messageauthor .= '
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
			}
		}
		$admin_email = array(
			'chirag@elsner.com',
			'harshal@elsner.in'
		);
		//$headers = array('Content-Type: text/html; charset=UTF-8');
		//wp_mail($admin_email, $subject, $messageadmin, $headers);

		// Send email to user

		//wp_mail($author_email, $subject, $messageauthor, $headers);
	} //check $update
}

//add_action('wp_ajax_send_payout_email', 'send_payout_email_callback');

function send_payout_email_callback()
{

	$unique_id 	= $_REQUEST['unique_id'];
	$invoice_id = $_REQUEST['invoice_id'];
	$status 	= $_REQUEST['status'];

	global $wpdb;
	$table_name = $wpdb->prefix . 'payouts';
	$payouts = $wpdb->get_results($wpdb->prepare("SELECT partner_id, paid_date, amount FROM $table_name WHERE  unique_id = %s", $unique_id));
	$user_email = '';
	foreach ($payouts as $payout) {
		$partner_id = $payout->partner_id;
		$user = get_user_by('ID', $partner_id);
		$user_email = $user ? $user->user_email : '';
		// $user_nickname = $user ? $user->user_nicename : '';
		$user_nickname = get_the_author_meta('nickname', $partner_id);
		//$user_nickname = $user ? $user->nickname : '';
		$paid_date = date('d-m-Y', $payout->paid_date);
		$amount = $payout->amount;
	}
	// Retrieve the necessary information from the database using $unique_id
	$to_admin = array(
		'chirag@elsner.com',
		'harshal@elsner.in'
	);
	$to_user = $user_email;
	$subject = 'Payout Status Update: Paid';
	$adminmessage = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
													<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/payout.png" alt="Payout Status Update"></td>
												</tr>
												<tr>
													<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Payout Status Update</h1></td>
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
	$adminmessage .= "<p style='color: #ffffff;'>We wanted to inform you that the status of a payout has been updated from 'Pending' to 'Paid' on Elsner Partner Program. Please log in to your account to review the details and confirm that they are accurate.</p><p style='color: #ffffff;'>Payout details are as follows:<b><br/>
																						Date - " . $paid_date . "<br/>
																						Amount - $" . $amount . "<br/>
																						Invoice Id - " . $invoice_id . "</b></p>";
	$adminmessage .= '</td>
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
	$authormessage = '<body style="margin: 0px; background-color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size:20px;" text="#000000" bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
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
													<td style="text-align: center;"><img src="https://elsner.com/wp-content/uploads/2023/05/payout.png" alt="Payout Status Update"></td>
												</tr>
												<tr>
													<td><h1 style="color: #F56F07; margin: 0; text-align: center;">Congratulations!</h1></td>
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
                                                                                            Hello ' . $user_nickname . ',
																						</span>
																					</td>
																				</tr>
																				<tr>
																					<td style="height: 30px;"></td>
																				</tr>
																				<tr>
																					<td style="color: #ffffff;">';
	$authormessage .= "<p style='color: #ffffff;'>We wanted to inform you that the status of a payout has been updated from 'Pending' to 'Paid' on Elsner Partner Program. Please log in to your account to review the details and confirm that they are accurate.</p><p style='color: #ffffff;'>Payout details are as follows:<b><br/>
																						Date : " . $paid_date . "<br/>
																						Amount - $" . $amount . "<br/>
																						Invoice Id - " . $invoice_id . "</b></p>";
	$authormessage .= '</td>
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

	// Send email to admin
	//wp_mail($to_admin, $subject, $adminmessage, $headers);

	// Send email to user
	//wp_mail($to_user, 'Congratulations for Payout', $authormessage, $headers);

	wp_die();
}
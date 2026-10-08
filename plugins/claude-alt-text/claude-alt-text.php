<?php
/**
 * Plugin Name:       Claude Alt Text
 * Description:        Generate descriptive, SEO-friendly alt text for images using Claude's vision model. Adds a one-click button in the Media Library and a bulk tool for every image missing alt text.
 * Version:           1.0.0
 * Author:            Elsner Marketing
 * License:           GPL-2.0-or-later
 * Requires at least: 5.8
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'CAT_OPTION', 'cat_settings' );
define( 'CAT_API_URL', 'https://api.anthropic.com/v1/messages' );

/* ------------------------------------------------------------------ *
 * Settings
 * ------------------------------------------------------------------ */

function cat_defaults() {
	return array(
		'api_key' => '',
		'model'   => 'claude-haiku-4-5-20251001',
		'prompt'  => 'Write concise, descriptive alt text for this image for accessibility and image SEO. Describe what is visually shown in about 125 characters or fewer. Do not start with "image of" or "photo of". If readable text appears prominently in the image, include it. Return only the alt text, with no quotes or extra commentary.',
	);
}

function cat_get( $key ) {
	$opts = wp_parse_args( get_option( CAT_OPTION, array() ), cat_defaults() );
	return isset( $opts[ $key ] ) ? $opts[ $key ] : '';
}

add_action( 'admin_init', function () {
	register_setting( 'cat_group', CAT_OPTION, 'cat_sanitize' );
} );

function cat_sanitize( $input ) {
	$out            = cat_defaults();
	$out['api_key'] = isset( $input['api_key'] ) ? trim( sanitize_text_field( $input['api_key'] ) ) : '';
	$allowed        = array( 'claude-haiku-4-5-20251001', 'claude-sonnet-4-6', 'claude-opus-4-8' );
	$out['model']   = ( isset( $input['model'] ) && in_array( $input['model'], $allowed, true ) ) ? $input['model'] : 'claude-haiku-4-5-20251001';
	$out['prompt']  = isset( $input['prompt'] ) ? sanitize_textarea_field( $input['prompt'] ) : cat_get( 'prompt' );
	return $out;
}

add_action( 'admin_menu', function () {
	add_options_page( 'Claude Alt Text', 'Claude Alt Text', 'manage_options', 'claude-alt-text', 'cat_settings_page' );
	add_media_page( 'Generate Alt Text', 'Generate Alt Text', 'upload_files', 'cat-bulk', 'cat_bulk_page' );
} );

function cat_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$model = cat_get( 'model' );
	?>
	<div class="wrap">
		<h1>Claude Alt Text</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'cat_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<td style="width: 200px; vertical-align: top; font-weight: 600; padding: 20px 10px 20px 0;"><label for="cat_api_key">Anthropic API key</label></td>
					<td>
						<input name="<?php echo esc_attr( CAT_OPTION ); ?>[api_key]" id="cat_api_key" type="password"
							value="<?php echo esc_attr( cat_get( 'api_key' ) ); ?>" class="regular-text" autocomplete="off" />
						<p class="description">Get one at console.anthropic.com. Stored in your site's database; never leaves your server except to call the API.</p>
					</td>
				</tr>
				<tr>
					<td style="width: 200px; vertical-align: top; font-weight: 600; padding: 20px 10px 20px 0;"><label for="cat_model">Model</label></td>
					<td>
						<select name="<?php echo esc_attr( CAT_OPTION ); ?>[model]" id="cat_model">
							<option value="claude-haiku-4-5-20251001" <?php selected( $model, 'claude-haiku-4-5-20251001' ); ?>>Haiku 4.5 — fast & cheap (recommended)</option>
							<option value="claude-sonnet-4-6" <?php selected( $model, 'claude-sonnet-4-6' ); ?>>Sonnet 4.6 — more detail</option>
							<option value="claude-opus-4-8" <?php selected( $model, 'claude-opus-4-8' ); ?>>Opus 4.8 — highest quality</option>
						</select>
						<p class="description">Haiku is plenty for alt text and keeps costs low for bulk runs.</p>
					</td>
				</tr>
				<tr>
					<td style="width: 200px; vertical-align: top; font-weight: 600; padding: 20px 10px 20px 0;"><label for="cat_prompt">Instruction</label></td>
					<td>
						<textarea name="<?php echo esc_attr( CAT_OPTION ); ?>[prompt]" id="cat_prompt" rows="4" class="large-text"><?php echo esc_textarea( cat_get( 'prompt' ) ); ?></textarea>
						<p class="description">Tune the tone or length. Keep "return only the alt text" so nothing extra gets saved.</p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<p><a href="<?php echo esc_url( admin_url( 'upload.php?page=cat-bulk' ) ); ?>">Go to the bulk tool &rarr;</a></p>
	</div>
	<?php
}

/* ------------------------------------------------------------------ *
 * Core: generate alt text for one attachment
 * ------------------------------------------------------------------ */

function cat_image_payload( $attachment_id ) {
	$allowed = array(
		'image/jpeg' => 'image/jpeg',
		'image/jpg'  => 'image/jpeg',
		'image/png'  => 'image/png',
		'image/gif'  => 'image/gif',
		'image/webp' => 'image/webp',
	);
	$mime = get_post_mime_type( $attachment_id );
	if ( ! isset( $allowed[ $mime ] ) ) {
		return new WP_Error( 'unsupported', 'Unsupported type (' . esc_html( $mime ) . '). Claude vision accepts JPEG, PNG, GIF, WEBP.' );
	}

	// Prefer a smaller generated size to keep the payload light.
	$path = false;
	$meta = wp_get_attachment_metadata( $attachment_id );
	$base = get_attached_file( $attachment_id );
	if ( $base && ! empty( $meta['sizes']['large']['file'] ) ) {
		$dir  = trailingslashit( dirname( $base ) );
		$try  = $dir . $meta['sizes']['large']['file'];
		$path = file_exists( $try ) ? $try : false;
	}
	if ( ! $path ) {
		$path = $base;
	}
	if ( ! $path || ! file_exists( $path ) ) {
		return new WP_Error( 'no_file', 'Image file not found on disk.' );
	}

	$bytes = file_get_contents( $path );
	if ( false === $bytes ) {
		return new WP_Error( 'read_fail', 'Could not read the image file.' );
	}
	return array(
		'media_type' => $allowed[ $mime ],
		'data'       => base64_encode( $bytes ),
	);
}

function cat_generate( $attachment_id ) {
	$key = cat_get( 'api_key' );
	if ( empty( $key ) ) {
		return new WP_Error( 'no_key', 'Add your Anthropic API key in Settings first.' );
	}

	$img = cat_image_payload( $attachment_id );
	if ( is_wp_error( $img ) ) {
		return $img;
	}

	$context = get_the_title( $attachment_id );
	$prompt  = cat_get( 'prompt' );
	if ( $context ) {
		$prompt .= ' Filename/context for reference: "' . wp_strip_all_tags( $context ) . '".';
	}

	$body = array(
		'model'      => cat_get( 'model' ),
		'max_tokens' => 200,
		'messages'   => array(
			array(
				'role'    => 'user',
				'content' => array(
					array(
						'type'   => 'image',
						'source' => array(
							'type'       => 'base64',
							'media_type' => $img['media_type'],
							'data'       => $img['data'],
						),
					),
					array(
						'type' => 'text',
						'text' => $prompt,
					),
				),
			),
		),
	);

	$res = wp_remote_post( CAT_API_URL, array(
		'timeout' => 30,
		'headers' => array(
			'content-type'      => 'application/json',
			'x-api-key'         => $key,
			'anthropic-version' => '2023-06-01',
		),
		'body'    => wp_json_encode( $body ),
	) );

	if ( is_wp_error( $res ) ) {
		return $res;
	}

	$code = wp_remote_retrieve_response_code( $res );
	$json = json_decode( wp_remote_retrieve_body( $res ), true );

	if ( 200 !== (int) $code ) {
		$detail = isset( $json['error']['message'] ) ? $json['error']['message'] : 'HTTP ' . $code;
		return new WP_Error( 'api_error', 'API error: ' . esc_html( $detail ) );
	}

	$text = '';
	if ( ! empty( $json['content'] ) && is_array( $json['content'] ) ) {
		foreach ( $json['content'] as $block ) {
			if ( isset( $block['type'] ) && 'text' === $block['type'] ) {
				$text .= $block['text'];
			}
		}
	}
	$text = trim( wp_strip_all_tags( $text ) );
	$text = trim( $text, "\"' " );

	if ( '' === $text ) {
		return new WP_Error( 'empty', 'Model returned no text.' );
	}

	update_post_meta( $attachment_id, '_wp_attachment_image_alt', sanitize_text_field( $text ) );
	return $text;
}

/* ------------------------------------------------------------------ *
 * AJAX
 * ------------------------------------------------------------------ */

add_action( 'wp_ajax_cat_generate', function () {
	check_ajax_referer( 'cat_nonce', 'nonce' );
	$id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : 0;
	if ( ! $id || ! current_user_can( 'edit_post', $id ) ) {
		wp_send_json_error( array( 'message' => 'Not allowed.' ) );
	}
	$result = cat_generate( $id );
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( array( 'message' => $result->get_error_message() ) );
	}
	wp_send_json_success( array( 'alt' => $result ) );
} );

/* ------------------------------------------------------------------ *
 * Media Library column with inline Generate button
 * ------------------------------------------------------------------ */

add_filter( 'manage_media_columns', function ( $cols ) {
	$cols['cat_alt'] = 'Alt text';
	return $cols;
} );

add_action( 'manage_media_custom_column', function ( $col, $id ) {
	if ( 'cat_alt' !== $col ) {
		return;
	}
	$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
	echo '<div class="cat-cell" data-id="' . esc_attr( $id ) . '">';
	echo '<span class="cat-alt-text">' . ( $alt ? esc_html( $alt ) : '<em style="color:#a00">missing</em>' ) . '</span><br>';
	echo '<button type="button" class="button button-small cat-gen">' . ( $alt ? 'Regenerate' : 'Generate' ) . '</button>';
	echo '<span class="cat-spin" style="display:none"> &hellip;</span>';
	echo '</div>';
}, 10, 2 );

/* ------------------------------------------------------------------ *
 * Bulk tool page
 * ------------------------------------------------------------------ */

function cat_bulk_page() {
	if ( ! current_user_can( 'upload_files' ) ) {
		return;
	}
	$q = new WP_Query( array(
		'post_type'      => 'attachment',
		'post_mime_type' => array( 'image/jpeg', 'image/png', 'image/gif', 'image/webp' ),
		'post_status'    => 'inherit',
		'posts_per_page' => 200,
		'meta_query'     => array(
			'relation' => 'OR',
			array( 'key' => '_wp_attachment_image_alt', 'compare' => 'NOT EXISTS' ),
			array( 'key' => '_wp_attachment_image_alt', 'value' => '', 'compare' => '=' ),
		),
	) );
	?>
	<div class="wrap">
		<h1>Generate Alt Text</h1>
		<?php if ( empty( cat_get( 'api_key' ) ) ) : ?>
			<div class="notice notice-warning"><p>Add your Anthropic API key in <a href="<?php echo esc_url( admin_url( 'options-general.php?page=claude-alt-text' ) ); ?>">Settings &rarr; Claude Alt Text</a> before generating.</p></div>
		<?php endif; ?>
		<p><?php echo (int) $q->found_posts; ?> image(s) are missing alt text (showing up to 200).</p>
		<p>
			<button type="button" class="button button-primary" id="cat-run-all">Generate all below</button>
			<span id="cat-progress" style="margin-left:10px;"></span>
		</p>
		<table class="widefat striped" id="cat-bulk-table">
			<thead><tr><th style="width:80px">Preview</th><th>File</th><th>Alt text</th><th style="width:140px">Action</th></tr></thead>
			<tbody>
			<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); $id = get_the_ID(); ?>
				<tr class="cat-row" data-id="<?php echo esc_attr( $id ); ?>">
					<td><?php echo wp_get_attachment_image( $id, array( 60, 60 ) ); ?></td>
					<td><?php echo esc_html( get_the_title() ); ?></td>
					<td class="cat-alt-text"><em style="color:#888">—</em></td>
					<td><button type="button" class="button button-small cat-gen">Generate</button><span class="cat-spin" style="display:none"> &hellip;</span></td>
				</tr>
			<?php endwhile; wp_reset_postdata(); else : ?>
				<tr><td colspan="4">Every image already has alt text. Nice.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/* ------------------------------------------------------------------ *
 * Admin assets (only on Media list + bulk page)
 * ------------------------------------------------------------------ */

add_action( 'admin_footer', function () {
	$screen = get_current_screen();
	if ( ! $screen || ! in_array( $screen->id, array( 'upload', 'media_page_cat-bulk' ), true ) ) {
		return;
	}
	printf(
		'<script>window.CAT=%s;</script>',
		wp_json_encode( array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'cat_nonce' ),
		) )
	);
	?>
	<script>
	(function () {
		function gen(btn) {
			var cell = btn.closest('.cat-cell, .cat-row, td');
			var holder = btn.closest('.cat-cell') || btn.closest('.cat-row');
			var id = holder && holder.getAttribute('data-id');
			if (!id) { return Promise.resolve(false); }
			var spin = holder.querySelector('.cat-spin');
			var out  = holder.querySelector('.cat-alt-text');
			btn.disabled = true;
			if (spin) spin.style.display = 'inline';
			var fd = new FormData();
			fd.append('action', 'cat_generate');
			fd.append('nonce', window.CAT.nonce);
			fd.append('id', id);
			return fetch(window.CAT.url, { method: 'POST', body: fd, credentials: 'same-origin' })
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (res.success) {
						if (out) { out.textContent = res.data.alt; out.style.color = ''; }
						btn.textContent = 'Regenerate';
						return true;
					}
					if (out) { out.innerHTML = '<span style="color:#a00">' + (res.data.message || 'Failed') + '</span>'; }
					return false;
				})
				.catch(function () { if (out) out.innerHTML = '<span style="color:#a00">Request failed</span>'; return false; })
				.finally(function () { btn.disabled = false; if (spin) spin.style.display = 'none'; });
		}

		document.addEventListener('click', function (e) {
			var btn = e.target.closest('.cat-gen');
			if (btn) { e.preventDefault(); gen(btn); }
		});

		var runAll = document.getElementById('cat-run-all');
		if (runAll) {
			runAll.addEventListener('click', function () {
				var btns = Array.prototype.slice.call(document.querySelectorAll('#cat-bulk-table .cat-gen'));
				var prog = document.getElementById('cat-progress');
				var i = 0, ok = 0;
				runAll.disabled = true;
				(function next() {
					if (i >= btns.length) {
						prog.textContent = 'Done — ' + ok + ' of ' + btns.length + ' generated.';
						runAll.disabled = false;
						return;
					}
					prog.textContent = 'Generating ' + (i + 1) + ' of ' + btns.length + ' …';
					gen(btns[i]).then(function (good) { if (good) ok++; i++; next(); });
				})();
			});
		}
	})();
	</script>
	<?php
} );

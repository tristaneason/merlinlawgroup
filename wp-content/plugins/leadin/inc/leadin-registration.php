<?php
if ( ! defined( 'LEADIN_PLUGIN_VERSION' ) ) {
	wp_die( '', '', 403 );
}

if ( is_admin() ) {
	add_action( 'wp_ajax_leadin_registration_ajax', 'leadin_registration_ajax' );
}

/**
 * AJAX handler to connect portal to wordpress
 */
function leadin_registration_ajax() {
	delete_option( 'leadin_hapikey' );
	$existing_portal_id = get_option( 'leadin_portalId' );

	if ( ! empty( $existing_portal_id ) ) {
		wp_die( '{"error": "Registration is already complete for this portal"}', '', 400 );
	}

	$request_body = file_get_contents( 'php://input' );
	$data         = json_decode( $request_body, true );

	$new_portal_id = $data['portalId'];

	if ( empty( $new_portal_id ) ) {
		$error_body = array(
			'error'   => 'Registration missing required fields',
			'request' => $request_body,
		);

		wp_die( json_encode( $error_body ), '', 400 );
	}

	$user_id               = $data['userId'];
	$access_token          = $data['accessToken'];
	$refresh_token         = $data['refreshToken'];
	$connection_time_in_ms = $data['connectionTimeInMs'];

	add_option( 'leadin_portalId', $new_portal_id );
	add_option( 'leadin_userId', $user_id );
	add_option( 'leadin_accessToken', $access_token );
	add_option( 'leadin_refreshToken', $refresh_token );
	add_option( 'leadin_connectionTimeInMs', $connection_time_in_ms );

	wp_die( '{"message": "Success!"}' );
}

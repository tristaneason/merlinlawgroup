<?php
if ( ! defined( 'LEADIN_PLUGIN_VERSION' ) ) {
	wp_die( '', '', 403 );
}

if ( is_admin() ) {
	add_action( 'wp_ajax_leadin_disconnect_ajax', 'leadin_disconnect_ajax' );
}

/**
 * AJAX handler to disconnect portal id
 */
function leadin_disconnect_ajax() {
	if ( get_option( 'leadin_portalId' ) ) {
		delete_option( 'leadin_portalId' );
		delete_option( 'leadin_slumber_mode' );
		delete_option( 'leadin_hapikey' );

		delete_option( 'leadin_accessToken' );
		delete_option( 'leadin_refreshToken' );
		delete_option( 'leadin_oauth_mode' );
		delete_option( 'leadin_userId' );
		delete_option( 'leadin_connectionTimeInMs' );

		wp_die( '{"message": "Success!"}' );
	} else {
		wp_die( '{"error": "No leadin_portalId found, cannot disconnect."}', '', 400 );
	}
}

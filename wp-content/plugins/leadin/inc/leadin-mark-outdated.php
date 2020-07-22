<?php
if ( ! defined( 'LEADIN_PLUGIN_VERSION' ) ) {
	wp_die( '', '', 403 );
}

if ( is_admin() ) {
	add_action( 'wp_ajax_leadin_mark_outdated', 'leadin_mark_outdated_ajax' );
}

/**
 * AJAX handler to set the current version as outdated
 */
function leadin_mark_outdated_ajax() {
	update_option( 'leadin_outdated_version', true );
	wp_die( '{"message": "Success!"}' );
}

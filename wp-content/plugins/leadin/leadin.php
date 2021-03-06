<?php
/**
 * Plugin Name: HubSpot All-In-One Marketing - Forms, Popups, Live Chat
 * Plugin URI: http://www.hubspot.com/integrations/wordpress
 * Description: HubSpot’s official WordPress plugin allows you to add forms, popups, and live chat to your website and integrate with the best WordPress CRM.
 * Version: 7.5.4
 * Author: HubSpot
 * Author URI: http://www.hubspot.com
 * License: GPL v3
 * Text Domain: leadin
 * Domain Path: /languages/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// =============================================
// Define Constants
// =============================================
if ( ! defined( 'LEADIN_BASE_PATH' ) ) {
	define( 'LEADIN_BASE_PATH', __FILE__ );
}

if ( ! defined( 'LEADIN_PATH' ) ) {
	define( 'LEADIN_PATH', untrailingslashit( plugins_url( '', LEADIN_BASE_PATH ) ) );
}

if ( ! defined( 'LEADIN_PLUGIN_DIR' ) ) {
	define( 'LEADIN_PLUGIN_DIR', untrailingslashit( dirname( LEADIN_BASE_PATH ) ) );
}

if ( ! defined( 'LEADIN_PLUGIN_SLUG' ) ) {
	define( 'LEADIN_PLUGIN_SLUG', basename( dirname( LEADIN_BASE_PATH ) ) );
}

if ( file_exists( LEADIN_PLUGIN_DIR . '/inc/leadin-overrides.php' ) ) {
	require_once LEADIN_PLUGIN_DIR . '/inc/leadin-overrides.php';
}

if ( ! defined( 'LEADIN_REQUIRED_WP_VERSION' ) ) {
	define( 'LEADIN_REQUIRED_WP_VERSION', '4.0' );
}

if ( ! defined( 'LEADIN_REQUIRED_PHP_VERSION' ) ) {
	define( 'LEADIN_REQUIRED_PHP_VERSION', '5.6' );
}

if ( ! defined( 'LEADIN_DB_VERSION' ) ) {
	define( 'LEADIN_DB_VERSION', '2.2.5' );
}

if ( ! defined( 'LEADIN_PLUGIN_VERSION' ) ) {
	define( 'LEADIN_PLUGIN_VERSION', '7.5.4' );
}

if ( ! defined( 'LEADIN_SOURCE' ) ) {
	define( 'LEADIN_SOURCE', 'leadin.com' );
}

if ( ! defined( 'LEADIN_SCRIPT_LOADER_DOMAIN' ) ) {
	define( 'LEADIN_SCRIPT_LOADER_DOMAIN', 'js.hs-scripts.com' );
}

if ( ! defined( 'LEADIN_FORMS_SCRIPT_URL' ) ) {
	define( 'LEADIN_FORMS_SCRIPT_URL', '//js.hsforms.net/forms/v2.js' );
}

if ( ! defined( 'LEADIN_FORMS_PAYLOAD' ) ) {
	define( 'LEADIN_FORMS_PAYLOAD', '' );
}

if ( ! defined( 'LEADIN_ENV' ) ) {
	define( 'LEADIN_ENV', 'prod' );
}

if ( ! defined( 'LEADIN_BASE_URL' ) ) {
	define( 'LEADIN_BASE_URL', 'https://app.hubspot.com' );
}

if ( ! defined( 'LEADIN_SIGNUP_BASE_URL' ) ) {
	define( 'LEADIN_SIGNUP_BASE_URL', LEADIN_BASE_URL );
}

// =============================================
// Include Needed Files
// =============================================
if ( file_exists( LEADIN_PLUGIN_DIR . '/inc/leadin-constants.php' ) ) {
	require_once LEADIN_PLUGIN_DIR . '/inc/leadin-constants.php';
}

require_once LEADIN_PLUGIN_DIR . '/inc/leadin-functions.php';
require_once LEADIN_PLUGIN_DIR . '/inc/leadin-registration.php';
require_once LEADIN_PLUGIN_DIR . '/inc/leadin-disconnect.php';
require_once LEADIN_PLUGIN_DIR . '/inc/leadin-wp-get.php';
require_once LEADIN_PLUGIN_DIR . '/inc/leadin-mark-outdated.php';
require_once LEADIN_PLUGIN_DIR . '/admin/class-leadinadmin.php';

require_once LEADIN_PLUGIN_DIR . '/inc/class-leadin.php';


// =============================================
// Hooks & Filters
// =============================================
/**
 * Activate the plugin
 *
 * @param bool $network_wide network_wide.
 */
function leadin_activate( $network_wide ) {
	// Check activation on entire network or one blog.
	if ( is_multisite() && $network_wide ) {
		global $wpdb;

		// Get this so we can switch back to it later.
		$current_blog = $wpdb->blogid;
		// For storing the list of activated blogs.
		$activated = array();

		// Get all blogs in the network and activate plugin on each one.
		$blog_ids = $wpdb->get_col(
			"SELECT blog_id FROM $wpdb->blogs"
		);
		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			leadin_add_defaults();
			$activated[] = $blog_id;
		}

		// Switch back to the current blog.
		switch_to_blog( $current_blog );

		// Store the array for a later function.
		update_site_option( 'leadin_activated', $activated );
	} else {
		leadin_add_defaults();
	}
}

/**
 * Check Leadin installation and set options
 */
function leadin_add_defaults() {
	global $wpdb;
	$options = get_option( 'leadin_options' );

	if ( ( 1 !== $options['li_installed'] ) || ( ! is_array( $options ) ) ) {
		$opt = array(
			'li_installed'            => 1,
			'leadin_version'          => LEADIN_PLUGIN_VERSION,
			'li_email'                => get_bloginfo( 'admin_email' ),
			'li_updates_subscription' => 1,
			'onboarding_step'         => 1,
			'onboarding_complete'     => 0,
			'ignore_settings_popup'   => 0,
			'data_recovered'          => 1,
			'delete_flags_fixed'      => 1,
			'beta_tester'             => 0,
			'converted_to_tags'       => 1,
			'names_added_to_contacts' => 1,
			'affiliate_code'          => '',
		);

		// Add the Pro flag if this is a pro installation.
		if ( ( defined( 'LEADIN_UTM_SOURCE' ) && 'leadin%20repo%20plugin' !== LEADIN_UTM_SOURCE ) || ! defined( 'LEADIN_UTM_SOURCE' ) ) {
			$opt['pro'] = 1;
		}

		// this is a hack because multisite doesn't recognize local options using either update_option or update_site_option...
		if ( is_multisite() ) {
			$multisite_prefix = ( is_multisite() ? $wpdb->prefix : '' );
			$wpdb->query(
				$wpdb->prepare(
					"INSERT INTO %soptions ( option_name, option_value ) VALUES ('leadin_options', %s)",
					$multisite_prefix,
					serialize( $opt )
				)
			);
			// TODO: Glob settings for multisite.
		} else {
			update_option( 'leadin_options', $opt );
		}
	}

	setcookie( 'ignore_social_share', '1', 2592000, '/' );
}

/**
 * Deactivate Leadin plugin hook
 *
 * @param bool $network_wide network_wide.
 */
function leadin_deactivate( $network_wide ) {
	if ( is_multisite() && $network_wide ) {
		global $wpdb;

		// Get this so we can switch back to it later.
		$current_blog = $wpdb->blogid;

		// Get all blogs in the network and activate plugin on each one.
		$blog_ids = $wpdb->get_col(
			"SELECT blog_id FROM $wpdb->blogs"
		);
		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
		}

		// Switch back to the current blog.
		switch_to_blog( $current_blog );
	}
}

/**
 * Handler for wpmu_new_blog
 *
 * @param any $blog_id read wpmu_new_blog doc.
 * @param any $user_id read wpmu_new_blog doc.
 * @param any $domain read wpmu_new_blog doc.
 * @param any $path read wpmu_new_blog doc.
 * @param any $site_id read wpmu_new_blog doc.
 * @param any $meta read wpmu_new_blog doc.
 */
function leadin_activate_on_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
	global $wpdb;

	if ( is_plugin_active_for_network( 'leadin/leadin.php' ) ) {
		$current_blog = $wpdb->blogid;
		switch_to_blog( $blog_id );
		leadin_add_defaults();
		switch_to_blog( $current_blog );
	}
}

/**
 * Parse shortcode
 *
 * @param array $attributes Shortcode attributes.
 */
function leadin_add_hubspot_shortcode( $attributes ) {
	$parsed_attributes = shortcode_atts(
		array(
			'type'   => null,
			'portal' => null,
			'id'     => null,
		),
		$attributes
	);

	if (
		! isset( $parsed_attributes['type'] ) ||
		! isset( $parsed_attributes['portal'] ) ||
		! isset( $parsed_attributes['id'] )
	) {
		return;
	}

	$portal_id = $parsed_attributes['portal'];
	$id        = $parsed_attributes['id'];

	switch ( $parsed_attributes['type'] ) {
		case 'form':
			return '
				<' . 'script charset="utf-8" type="text/javascript" src="' . LEADIN_FORMS_SCRIPT_URL . '"></script>
				<script>
					hbspt.forms.create({
						portalId: ' . $portal_id . ',
						formId: "' . $id . '",
						shortcode: "wp",
						' . LEADIN_FORMS_PAYLOAD . '
					});
				</script>
			';
		case 'cta':
			return '
				<!--HubSpot Call-to-Action Code -->
				<span class="hs-cta-wrapper" id="hs-cta-wrapper-' . $id . '">
						<span class="hs-cta-node hs-cta-' . $id . '" id="' . $id . '">
								<!--[if lte IE 8]>
								<div id="hs-cta-ie-element"></div>
								<![endif]-->
								<a href="https://cta-redirect.hubspot.com/cta/redirect/' . $portal_id . '/' . $id . '" >
										<img class="hs-cta-img" id="hs-cta-img-' . $id . '" style="border-width:0px;" src="https://no-cache.hubspot.com/cta/default/' . $portal_id . '/' . $id . '.png"  alt="New call-to-action"/>
								</a>
						</span>
						<' . 'script charset="utf-8" src="//js.hubspot.com/cta/current.js"></script>
						<script type="text/javascript">
								hbspt.cta.load(' . $portal_id . ', \'' . $id . '\', {});
						</script>
				</span>
				<!-- end HubSpot Call-to-Action Code -->
			';
	}
}

/**
 * Checks the stored database version against the current data version + updates if needed
 */
function leadin_init() {
		load_plugin_textdomain( 'leadin', false, '/leadin/languages' );
		$leadin_wp = new Leadin();
		add_shortcode( 'hubspot', 'leadin_add_hubspot_shortcode' );
}

add_action( 'plugins_loaded', 'leadin_init', 14 );

if ( is_admin() ) {
	// Activate + install Leadin.
	register_activation_hook( __FILE__, 'leadin_activate' );

	// Deactivate Leadin.
	register_deactivation_hook( __FILE__, 'leadin_deactivate' );

	// Activate on newly created wpmu blog.
	add_action( 'wpmu_new_blog', 'leadin_activate_on_new_blog', 10, 6 );
}



<?php
/**
 * Class LeadinFunctionsTest
 *
 * @package Leadin
 */

/**
 * Test leadin-functions.php
 */
class LeadinMarkOutdatedTest extends WP_UnitTestCase {

	/**
	 * Test function leadin_get_affiliate_code
	 */
	public function test_mark_outdated_ajax() {
		$this->assertFalse( get_option( 'leadin_outdated_version', false ) );
		$response;

		try {
			leadin_mark_outdated_ajax();
		} catch ( WPDieException $e ) {
			$response = $e;
		}

		$this->assertTrue( isset( $response ) );
		$array = json_decode( $response->getMessage() );
		$this->assertTrue( isset( $array ) );
		$this->assertTrue( get_option( 'leadin_outdated_version', false ) );
		delete_option( 'leadin_outdated_version' );
	}
}

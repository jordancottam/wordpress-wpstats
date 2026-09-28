<?php

// Prevent direct access
defined( 'ABSPATH' ) or exit();

/**
 * Handles automatic plugin updates.
 */
require_once wpstats_CLASSES_PATH . 'wpstats_Automatic_Updater.php';

add_action( 'admin_init', 'wpstats_automatic_updater', 0 );

/**
 * Initialises the wpstats automatic updater.
 *
 * @since 0.2.8
 */
function wpstats_automatic_updater() {
	new WPStats_Automatic_Updater( wpstats_STORE_URL, dirname( __FILE__ ) . '/wpstats.php', array(
		'version'   => wpstats_VERSION,
		'license'   => get_option( 'wpstats_license_key' ),
		'item_name' => wpstats_NAME,
		'author'    => 'WPStats',
		'url'       => home_url(),
	));
}
<?php

/**
 * wpstats Settings AJAX-related functions.
 * 
 * @since 1.0.0
 *
 * @package wpstats\Ajax\Settings
 */

defined( 'ABSPATH' ) or exit();

add_action( 'wp_ajax_wpstats_ajax_settings_save_settings', 'wpstats_ajax_settings_save_settings' );

function wpstats_ajax_settings_save_settings() {

	/**
	 * Page access related functions.
	 * @since 0.4.0
	 */
	require_once wpstats_FUNCTIONS_PATH . 'access.php';
	if ( ! wpstats_can_current_user_access_settings() ) {
		exit();
	}

	// Brand Name
	$brand_name = ( ! empty( $_POST[ 'brand_name' ] ) ) ?
		wp_strip_all_tags( stripslashes( $_POST[ 'brand_name' ] ) ) :
		wpstats_NAME;
	update_option( 'wpstats_brand_name', $brand_name );

	// Brand Menu Name
	$brand_menu_name = ( ! empty( $_POST[ 'brand_menu_name' ] ) ) ?
		wp_strip_all_tags( stripslashes( $_POST[ 'brand_menu_name' ] ) ) :
		wpstats_NAME;
	update_option( 'wpstats_brand_menu_name', $brand_menu_name );

	// Brand Logo URL
	$brand_logo_image_url = ( ! empty( $_POST[ 'brand_logo_image_url' ] ) ) ?
		esc_url( $_POST[ 'brand_logo_image_url' ] ) :
		wpstats_DEFAULT_LOGO_IMAGE_URL;
	update_option( 'wpstats_brand_logo_image_url', $brand_logo_image_url );

	// Brand Background URL
	$brand_background_image_url = ( ! empty( $_POST[ 'brand_background_image_url' ] ) ) ?
		esc_url( $_POST[ 'brand_background_image_url' ] ) :
		'';
	update_option( 'wpstats_brand_background_image_url', $brand_background_image_url );

	// Brand Background Color
	require_once wpstats_FUNCTIONS_PATH . 'sanitization.php';
	$brand_background_color = ( isset( $_POST[ 'brand_background_color' ] ) ) ?
		wpstats_sanitize_hex_color( $_POST[ 'brand_background_color' ] ) :
		'#333';
	update_option( 'wpstats_brand_background_color', $brand_background_color );

	// Date Range Label Color
	$date_range_label_color = ( isset( $_POST[ 'wpstats_date_range_label_color' ] ) ) ?
		wpstats_sanitize_hex_color( $_POST[ 'wpstats_date_range_label_color' ] ) :
		'#fff';
	update_option( 'wpstats_date_range_label_color', $date_range_label_color );

	// Mashboard Menu Name
	$mashboard_menu_name = ( isset( $_POST[ 'wpstats_mashboard_menu_name' ] ) ) ?
		wp_strip_all_tags( stripslashes( $_POST[ 'wpstats_mashboard_menu_name' ] ) ) :
		__( 'Mashboard', 'wpstats' );
	update_option( 'wpstats_mashboard_menu_name', $mashboard_menu_name );

	// Role Access
	$registered_roles = (array) get_editable_roles();
	$role_access = array();
	if ( ! empty( $_POST[ 'role_access' ] ) ) {

		$post_role_access = $_POST[ 'role_access' ];

		if ( isset( $registered_roles[ $post_role_access ] ) ) {

			foreach ( $registered_roles as $identifier => $role_data ) {
				$role_access[] = $identifier;
				if ( $post_role_access === $identifier ) {
					break;
				}
			}
			update_option( 'wpstats_selected_role_access', $post_role_access );
		}
	}
	update_option( 'wpstats_role_access', $role_access );

	// Default Dashboard
	$default_dashboard = ( ! empty( $_POST[ 'default_dashboard' ] ) && in_array( $_POST[ 'default_dashboard' ], array(
			'wpstats_mashboard',
			'wordpress_dashboard',
		)
	) ) ?
		$_POST[ 'default_dashboard' ] :
		'wpstats_mashboard';
	update_option( 'wpstats_default_dashboard', $default_dashboard );

	// Caching
	$cache_mode = ( ! empty( $_POST[ 'cache_mode' ] ) && in_array( $_POST[ 'cache_mode' ], array(
			'enabled',
			'disabled',
		)
	) ) ?
		$_POST[ 'cache_mode' ] :
		'enabled';
	update_option( 'wpstats_cache_mode', $cache_mode );

	// Mashboard cards visibility status
	if ( is_array( $_POST[ 'mashboard_cards_visibility_status' ] ) && ! empty( $_POST[ 'mashboard_cards_visibility_status' ] ) ) {
		require_once wpstats_FUNCTIONS_PATH . 'mashboard_cards.php';
		$mashboard_cards_visibility_status = $_POST[ 'mashboard_cards_visibility_status' ];
		$mashboard_card_identifiers = wpstats_get_mashboard_card_identifiers();
		$new_mashboard_cards_visibility_status = array();
		foreach ( $mashboard_card_identifiers as $identifier ) {
			$status = isset( $mashboard_cards_visibility_status[ $identifier ] ) && $mashboard_cards_visibility_status [ $identifier] == '1' ? '1' : '0';
			$new_mashboard_cards_visibility_status[ $identifier ] = $status;
		}
		update_option( 'wpstats_mashboard_cards_visibility_status', $new_mashboard_cards_visibility_status );
	}

	// Role identifiers allowed to view and access the reports (mashboard & detail pages)
	if ( array_key_exists( 'wpstats_reports_users_allowed_access', $_POST ) ) {

		if ( empty( $_POST[ 'wpstats_reports_users_allowed_access' ] ) ) {
			update_option( 'wpstats_reports_users_allowed_access', array() );
		} elseif ( is_array( $_POST[ 'wpstats_reports_users_allowed_access' ] ) ) {
			$wpstats_reports_users_allowed_access = $_POST[ 'wpstats_reports_users_allowed_access' ];
			$registered_roles = array_keys( (array) get_editable_roles() );
			$role_identifiers = array();
			foreach ( $wpstats_reports_users_allowed_access as $role_identifier ) {
				if ( in_array( $role_identifier, $registered_roles ) ) {
					$role_identifiers[] = $role_identifier;
				}
			}
			if ( ! empty( $role_identifiers ) ) {
				update_option( 'wpstats_reports_users_allowed_access', $role_identifiers );
			}
		}
	}

	/*
	 * User ids allowed to view/change the wpstats settings, as well as view/change an integrations settings, or setup
	 * integrations.
	 */
	if ( array_key_exists( 'wpstats_settings_users_allowed_access', $_POST ) ) {

		if ( empty( $_POST[ 'wpstats_settings_users_allowed_access' ] ) ) {
			update_option( 'wpstats_settings_users_allowed_access', array() );
		} elseif ( is_array( $_POST[ 'wpstats_settings_users_allowed_access' ] ) ) {
			$settings_user_ids_allowed_access = $_POST[ 'wpstats_settings_users_allowed_access' ];
			$user_ids = array();
			foreach ( $settings_user_ids_allowed_access as &$user_id ) {
				$user_id = (string) $user_id;
				if ( ctype_digit( $user_id ) && ! in_array( $user_id, $user_ids ) ) {
					$user_ids[] = $user_id;
				}
			}
			if ( ! empty( $user_ids ) ) {
				update_option( 'wpstats_settings_users_allowed_access', $user_ids );
			}
		}
	}

	exit();
}
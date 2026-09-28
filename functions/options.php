<?php

/**
 * wpstats option-related functions.
 * 
 * @since 0.0.1
 *
 * @package wpstats
 */

// Prevent direct access
defined( 'ABSPATH' ) or exit();

/**
 * Returns options used for blogs and sites.
 * 
 * @since 0.0.1
 * 
 * @return array
 */
function wpstats_get_options() {

	$options = array();

	$options[ 'site' ][ 'wpstats_version' ] = wpstats_VERSION;
	$options[ 'blog' ][ 'wpstats_version' ] = wpstats_VERSION;

	$options[ 'site' ][ 'wpstats_perform_network_install' ]    = false;

	$options[ 'blog' ][ 'wpstats_license_key' ]                = null;
	$options[ 'blog' ][ 'wpstats_brand_name' ]                 = wpstats_NAME;
	$options[ 'blog' ][ 'wpstats_brand_menu_name' ]            = wpstats_NAME;
	$options[ 'blog' ][ 'wpstats_brand_background_image_url' ] = wpstats_DEFAULT_BACKGROUND_IMAGE_URL;
	$options[ 'blog' ][ 'wpstats_brand_logo_image_url' ]       = wpstats_DEFAULT_LOGO_IMAGE_URL;
	$options[ 'blog' ][ 'wpstats_mashboard_menu_name' ]        = __( 'Mashboard', 'wpstats' );

	// (string) Hex color for background color on wpstats pages.
	$options[ 'blog' ][ 'wpstats_brand_background_color' ]     = '#333';

	// (bool) Whether to remove WordPress Update Notice on wpstats pages.
	$options[ 'blog' ][ 'wpstats_remove_update_nag' ]          = false;

	/*
	 * (string) The role which is allowed access to the wpstats pages.
	 * Any role above the role is also allowed access.
	 */
	$options[ 'blog' ][ 'wpstats_selected_role_access' ]       = '';

	// (string) Location user is redirected upon login (wpstats Mashboard or WordPress dashboard).
	$options[ 'blog' ][ 'wpstats_default_dashboard' ]          = 'wpstats_mashboard';

	// (string[]) Contains role identifiers as string-values.
	$options[ 'blog' ][ 'wpstats_role_access' ]                = array();

	// (array) Mashboard cards positions
	$options[ 'blog' ][ 'wpstats_mashboard_card_positions' ]   = array(
		'postbox-container-1' => array(
			'googleanalytics_1',
			'youtube_5',
			'wordpress_9',
		),
		'postbox-container-2' => array(
			'facebook_2',
			'googleplus_6',
			'aweber_10',
		),
		'postbox-container-3' => array(
			'twitter_3',
			'linkedin_7',
		),
		'postbox-container-4' => array(
			'googleadwords_11',
			'vote_13',
			'paypal_4',
			'mailchimp_8',
			'campaignmonitor_12',
		),
	);

	$options[ 'blog' ][ 'wpstats_mashboard_cards_visibility_status' ] = array(
		// 1 = visible, 0 = hidden (all visible by default)
		'googleanalytics_1' => '1',
		'facebook_2'        => '1',
		'twitter_3'         => '1',
		'paypal_4'          => '1',
		'youtube_5'         => '1',
		'googleplus_6'      => '1',
		'linkedin_7'        => '1',
		'mailchimp_8'       => '1',
		'wordpress_9'       => '1',
		'aweber_10'         => '1',
		'googleadwords_11'  => '1',
		'campaignmonitor_12'=> '1',
		'vote_13'           => '0',
	);

	// (null|string) Selected Google Analytics Google Account Email
	$options[ 'blog' ][ 'wpstats_selected_google_analytics_google_account_email' ] = null;

	// (null|string) Selected Google Analytics Profile ID for data retrieval
	$options[ 'blog' ][ 'wpstats_selected_google_analytics_profile_id' ] = null;

	// (null|string) Selected Facebook Page ID for data retrieval
	$options[ 'blog' ][ 'wpstats_selected_facebook_page_id' ] = null;

	// (string) Whether to use the cache when fetching data for any integration (default: enabled).
	$options[ 'blog' ][ 'wpstats_cache_mode' ] = 'enabled';

	// (null|string) The license type (free, personal, business, developer)
	$options[ 'blog' ][ 'wpstats_license_type' ] = null;

	// (null|string) Adwords Customer/Account Id
	$options[ 'blog' ][ 'wpstats_google_adwords_selected_customer_id' ] = null;

	// (null|string) Adwords Campaign Id
	$options[ 'blog' ][ 'wpstats_google_adwords_selected_campaign_id' ] = null;

	// (array) Adwords accounts
	$options[ 'blog' ][ 'wpstats_google_adwords_accounts' ] = array();

	// (string) Date Range Label Color
	$options[ 'blog' ][ 'wpstats_date_range_label_color' ] = '#fff';

	// (array) identifiers of roles as values that are allowed to view and access the reports (mashboard & detail pages).
	$options[ 'blog' ][ 'wpstats_reports_users_allowed_access' ] = array();

	// (array) Ids of users as values that are allowed to view and change the Settings.
	$options[ 'blog' ][ 'wpstats_settings_users_allowed_access' ] = array();

	// (bool) Whether Google Adwords has been setup (as of 0.4.2)
	$options[ 'blog' ][ 'wpstats_google_adwords_setup' ] = false;

	return $options;
}
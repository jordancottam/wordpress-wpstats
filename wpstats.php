<?php

/*
	Plugin Name: wpstats
	Plugin URI: https://example.com
	Description: A Better WordPress Dashboard.
	Version: 0.4.6
	Author: wpstats
	Author URI: https://example.com
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Text Domain: wpstats
*/

/**
 * wpstats plugin entry point.
 * 
 * @since 0.0.1
 *
 * @package wpstats
 */
// Prevent direct access
defined( 'ABSPATH' ) or exit();

/**
 * Load definitions, configuration, etc.
 */
require_once dirname( __FILE__ ) . '/bootstrap.php';

add_action( 'init', 'wpstats_load_translations', 10 );
/**
 * Loads the translation file for wpstats.
 *
 * Uses a custom translation provided by a user from (defaults to `/wp-content/languages/wpstats/`), and using any
 * translation shipped with the plugin as a fallback.
 *
 * @since 0.1.4
 */
function wpstats_load_translations() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'wpstats' );
	$wp_languages_mo_file = WP_LANG_DIR . '/wpstats/' . 'wpstats' . '-' . $locale . '.mo';
	$plugin_mo_file = wpstats_ROOT_PATH . 'languages/' . 'wpstats' . '-' . $locale . '.mo';
	$mo_file = ( file_exists( $wp_languages_mo_file ) ) ? $wp_languages_mo_file : $plugin_mo_file;
	load_textdomain( 'wpstats', $mo_file );
}

add_action( 'init', function() {
	if ( isset( $_GET[ 'wpstats_auth_popup_window_complete' ] ) ) {
		_e( "Integration setup successfully. If you see this message and/or the popup hasn't closed, please close this popup. If a loading icon doesn't appear on the integration after closing this popup, please reload the page.", 'wpstats' );
		exit();
	}
});

/**
 * Install wpstats.
 */
require_once wpstats_ROOT_PATH . 'install.php';

/**
 * Handles automatic plugin updates.
 */
require_once wpstats_ROOT_PATH . 'updater.php';

/**
 * AJAX-related functions.
 */
require_once wpstats_FUNCTIONS_PATH . 'ajax.php';

add_filter( 'login_redirect', 'wpstats_login_redirect', 11, 3 );
/**
 * Modifies the login redirect URL to the Mashboard URL if the user has access to the stats.
 * @param string $request_to
 * @param string $request
 * @param WP_User $user
 * @return string
 */
function wpstats_login_redirect( $request_to, $request, $user ) {
	$url = ! empty( $request_to ) ? $request_to : ( ! empty( $request ) ? $request : admin_url() );
	if ( ! $user instanceof WP_User ) {
		return $url;
	}
	if ( 'wpstats_mashboard' !== get_option( 'wpstats_default_dashboard' ) ) {
		return $url;
	}
	$reports_roles_allowed_access = get_option( 'wpstats_reports_users_allowed_access' );
	// Roles haven't been setup yet, or it has been set as blank. For consistency, we now require the role of the user
	// to be set for Stats Access, in order for them to be redirected when logging in or when revisiting the WP dashboard.
	if ( ! is_array( $reports_roles_allowed_access ) ) {
		return $url;
	}
	// Otherwise, only allow redirection if user is apart of a role that is permitted access
	foreach ( $user->roles as $identifier ) {
		if ( in_array( $identifier, $reports_roles_allowed_access, true ) ) {
			return wpstats_MASHBOARD_PAGE_URL;
		}
	}
	return $url;
}

add_action( 'admin_init', 'wpstats_redirect_logged_in_user', 10 );
/**
 * Redirects a logged in user to the wpstats mashboard.
 *
 * Only redirects the logged in user if the default dashboard is the wpstats Mashboard and the url ends in wp-admin/,
 * which allows users to still be able to visit the WordPress dashboard page (wp-admin/index.php).
 * Also the user must be apart of a role which is allowed access to the wpstats pages, which is configurable via the
 * Settings page.
 *
 * @since 0.2.8
 */
function wpstats_redirect_logged_in_user() {
	if ( 'wpstats_mashboard' !== get_option( 'wpstats_default_dashboard' ) ) {
		return;
	}
	/**
	 * wpstats access related functions.
	 */
	require_once wpstats_FUNCTIONS_PATH . 'access.php';
	// Make sure we don't try to redirect users who don't have access to the wpstats pages
	if ( ! wpstats_can_current_user_access_reports() ) {
		return;
	}
	if ( ! isset( $_SERVER[ 'HTTP_HOST' ], $_SERVER[ 'REQUEST_URI' ] ) ) {
		return;
	}
	$current_url = ( isset( $_SERVER[ 'HTTPS' ] ) ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$admin_url = admin_url();
	if ( $current_url === $admin_url ) {
		wp_redirect( wpstats_MASHBOARD_PAGE_URL );
		exit();
	}
}

add_action( 'admin_notices', 'wpstats_admin_notices', 20 );
/**
 * Display notice on activation.
 *
 * @since 0.0.5
 */
function wpstats_admin_notices() {
	$msg_shown = get_option( 'wpstats_activation_message_shown' );
	if ( false === $msg_shown || 'false' === $msg_shown ) {
		update_option( 'wpstats_activation_message_shown', 'true' );
		$html = '<div class="updated">';
		$html .= '<p>';
		$html .= sprintf( __('Thanks for activating wpstats! Go to the <a href="%s">settings</a> page to enter your license key.', 'wpstats'), wpstats_SETTINGS_PAGE_URL );
		$html .= '</p>';
		$html .= '</div>';
		echo $html;
	}
}

add_filter( 'plugin_action_links', 'wpstats_add_plugin_detail_setting_link', 10, 4 );
/**
 * Add a settings link to the plugins links on the Plugins page.
 * 
 * Supports WP installation versions 2.5.0 and upward.
 * 
 * @since 0.1.1
 */
function wpstats_add_plugin_detail_setting_link( $actions, $plugin_file, $plugin_data, $context  ) {
	if ( 'wpstats/wpstats.php' !== $plugin_file ) {
		return $actions;
	}

	if ( 'all' !== $context && 'active' !== $context && 'recently_activated' !== $context && 'upgrade' !== $context ) {
		return $actions;
	}

	$filtered_actions = array();

	$settings_url = admin_url( 'admin.php?page=wpstats-settings' );

	foreach ( $actions as $action => $link ) {
		$filtered_actions[ $action ] = $link;
		if ( 'edit' === $action ) {
			$filtered_actions[ 'settings' ] = '<a href="' . $settings_url . '">' . __( 'Settings', 'wpstats' ) . '</a>';
		}
	}

	return $filtered_actions;
}

/**
 * Run on deactivation.
 *
 * @since 0.0.5
 */
function wpstats_deactivate() {
	update_option( 'wpstats_activation_message_shown', 'false' );
}
register_deactivation_hook( __FILE__, 'wpstats_deactivate' );

add_action( 'admin_menu', 'wpstats_admin_menu', 10 );
/**
 * Run when the `admin_menu` action fires.
 * 
 * @since 1.0.0
 *
 * @global $wp_version
 */
function wpstats_admin_menu() {

	/**
	 * Page access related functions.
	 */
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	global $wp_version;
	/*
	 * We use a color version of the menu icon for WordPress versions < 3.8
	 */
	$icon_url = ( '3.8' <= $wp_version ) ? wpstats_TEMPLATE_IMAGES_URL . 'menu-icon.png' : wpstats_TEMPLATE_IMAGES_URL . 'menu-icon-lt-38.png';

	/*
	 * Capability required to access mashboard, detail, and setting pages.
	 * We check after if the user has the required role(s) to access the pages.
	 * as this can be configured from the settings.
	 */
	$required_access_capability = 'read';

	$brand_name = sanitize_text_field( get_option( 'wpstats_brand_name' ) );

	// Only show report pages (Mashboard & detail pages) if user has access
	if ( wpstats_can_current_user_access_reports() ) {

		// Mashboard Page
		$mashboard_menu_name = get_option( 'wpstats_mashboard_menu_name', __( 'Mashboard', 'wpstats' ) );
		$mashboard = sprintf( __( '%s %s', 'wpstats' ), $brand_name, $mashboard_menu_name );
		add_menu_page( $mashboard, get_option( 'wpstats_brand_menu_name' ), $required_access_capability, 'wpstats-mashboard', 'wpstats_mashboard', $icon_url, '0.9' );
		add_submenu_page( 'wpstats-mashboard', $mashboard, $mashboard_menu_name, $required_access_capability, 'wpstats-mashboard' );

		$mashboard_cards_visibility_status = get_option( 'wpstats_mashboard_cards_visibility_status' );

		// Google Analytics Detail Page
		if ( ! isset( $mashboard_cards_visibility_status[ 'googleanalytics_1' ]) || ( isset( $mashboard_cards_visibility_status[ 'googleanalytics_1' ] ) && $mashboard_cards_visibility_status[ 'googleanalytics_1' ] === '1' ) ) {
			$google = sprintf(__('%s Google Analytics', 'wpstats'), $brand_name);
			add_submenu_page('wpstats-mashboard', $google, __('Google Analytics', 'wpstats'), $required_access_capability, 'wpstats-google-analytics', 'wpstats_google_analytics');
		}

		// Facebook Detail Page
		if ( ! isset( $mashboard_cards_visibility_status[ 'facebook_2' ]) || ( isset( $mashboard_cards_visibility_status[ 'facebook_2' ] ) && $mashboard_cards_visibility_status[ 'facebook_2' ] === '1' ) ) {
			$facebook = sprintf( __( '%s Facebook', 'wpstats'), $brand_name );
			add_submenu_page('wpstats-mashboard', $facebook, __( 'Facebook', 'wpstats' ), $required_access_capability, 'wpstats-facebook', 'wpstats_facebook');
		}

		// Twitter detail page
		if ( ! isset( $mashboard_cards_visibility_status[ 'twitter_3' ]) || ( isset( $mashboard_cards_visibility_status[ 'twitter_3' ] ) && $mashboard_cards_visibility_status[ 'twitter_3' ] === '1' ) ) {
			$twitter = sprintf( __( '%s Twitter', 'wpstats'), $brand_name );
			add_submenu_page('wpstats-mashboard', $twitter, __( 'Twitter', 'wpstats' ), $required_access_capability, 'wpstats-twitter', 'wpstats_twitter');
		}

		// Google Adwords Detail Page
		if ( ! isset( $mashboard_cards_visibility_status[ 'googleadwords_11' ] ) || ( isset( $mashboard_cards_visibility_status[ 'googleadwords_11' ] ) && $mashboard_cards_visibility_status[ 'googleadwords_11' ] === '1' ) ) {
			$google_adwords_page_title = sprintf( __( '%s Google Adwords', 'wpstats' ), $brand_name );
			add_submenu_page( 'wpstats-mashboard', $google_adwords_page_title, __( 'Google Adwords', 'wpstats' ), $required_access_capability, 'wpstats-google-adwords', 'wpstats_google_adwords' );
		}

		// MailChimp Detail Page
		if ( ! isset( $mashboard_cards_visibility_status[ 'mailchimp_8' ] ) || ( isset( $mashboard_cards_visibility_status[ 'mailchimp_8' ] ) && $mashboard_cards_visibility_status[ 'mailchimp_8' ] === '1' ) ) {
			$mailchimp_page_title = sprintf( __( '%s MailChimp', 'wpstats' ), $brand_name );
			add_submenu_page( 'wpstats-mashboard', $mailchimp_page_title, __( 'MailChimp', 'wpstats' ), $required_access_capability, 'wpstats-mailchimp', 'wpstats_mailchimp' );
		}
	}

	// Only show Settings page if user is allowed to view/change the settings (or the setting hasn't been configured yet)
	if ( wpstats_can_current_user_access_settings() ) {
		// Settings Page
		$settings_page_title = sprintf( __( '%s Settings', 'wpstats' ), $brand_name );
		add_submenu_page( 'wpstats-mashboard', $settings_page_title, __( 'Settings', 'wpstats' ), $required_access_capability, 'wpstats-settings', 'wpstats_settings' );
	}
}

/**
 * Displays content for the wpstats mashboard menu page.
 * 
 * @since 1.0.0
 */
function wpstats_mashboard() {
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'mashboard.php';
}

/**
 * Displays content for the wpstats Google Analytics menu page.
 * 
 * @since 1.0.0
 */
function wpstats_google_analytics() {
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'google-analytics.php';
}

/**
 * Displays content for the wpstats Facebook menu page.
 * 
 * @since 1.0.0
 */
function wpstats_facebook() {
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'facebook.php';
}

/**
 * Displays content for the Twitter detail page.
 *
 * @since 0.2.4
 */
function wpstats_twitter() {
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'twitter.php';
}

/**
 * Displays content for the wpstats Google Adwords detail page.
 *
 * @since 0.2.8
 */
function wpstats_google_adwords() {
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'google-adwords.php';
}

/**
 * Displays content for the wpstats MailChimp detail page.
 *
 * @since 0.3.2
 */
function wpstats_mailchimp() {
	/**
	 * See function description
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'mailchimp.php';
}

/**
 * Displays content for the wpstats settings menu page.
 * 
 * @since 1.0.0
 */
function wpstats_settings() {
	/**
	 * Licensing API related functions.
	 */
	require_once wpstats_API_FUNCTIONS_PATH . 'licensing.php';
	/**
	 * See function description.
	 */
	require_once wpstats_TEMPLATE_ADMIN_PATH . 'settings.php';
}

add_action( 'admin_enqueue_scripts', 'wpstats_admin_enqueue_scripts', 10 );

/**
 * Run when the `admin_enqueue_scripts` action fires.
 * 
 * @since 1.0.0
 */
function wpstats_admin_enqueue_scripts() {

	$page = ( isset( $_GET[ 'page' ] ) ) ? $_GET[ 'page' ] : '';

	require_once wpstats_FUNCTIONS_PATH . 'scripts.php';

	// Any scripts used on any WP dashboard page
	wpstats_enqueue_style( 'wpstats-backend', 'backend.css' );

	if ( ! $page ) {
		return;
	}

	$pages = array(
		'wpstats-mashboard',
		'wpstats-google-analytics',
		'wpstats-facebook',
		'wpstats-twitter',
		'wpstats-google-adwords',
		'wpstats-mailchimp',
		'wpstats-settings',
	);

	if ( ! in_array( $page, $pages, true ) ) {
		return;
	}
	// Scripts & styles for all wpstats pages
	wpstats_admin_enqueue_global_scripts();

	switch ( $page ) {
		case 'wpstats-mashboard':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_mashboard_scripts();
			break;
		case 'wpstats-google-analytics':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_detail_pages_scripts();
			wpstats_admin_enqueue_google_analytics_scripts();
			break;
		case 'wpstats-facebook':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_detail_pages_scripts();
			wpstats_admin_enqueue_facebook_scripts();
			break;
		case 'wpstats-twitter':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_detail_pages_scripts();
			wpstats_admin_enqueue_twitter_scripts();
			break;
		case 'wpstats-google-adwords':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_detail_pages_scripts();
			wpstats_admin_enqueue_google_adwords_scripts();
			break;
		case 'wpstats-mailchimp':
			wpstats_admin_enqueue_service_scripts();
			wpstats_admin_enqueue_detail_pages_scripts();
			wpstats_admin_enqueue_mailchimp_scripts();
			break;
		case 'wpstats-settings':
		default:
			wpstats_admin_enqueue_settings_scripts();
			break;
	}
}

/**
 * Scripts designed to be used for all wpstats pages.
 * 
 * @since 1.0.0
 * 
 * @global string $wp_version Version of WordPress installed.
 */
function wpstats_admin_enqueue_global_scripts() {

	global $wp_version;

	$brand_background_image_url = get_option( 'wpstats_brand_background_image_url' );

	// Fallback or alternative to a background image
	$brand_background_color = get_option( 'wpstats_brand_background_color' );

	// jQuery UI CSS v1.11.2
	wpstats_enqueue_minified_style( 'jquery-ui-wpstats', 'jquery-ui-1.11.2.min.css' );

	// Global CSS
	wpstats_enqueue_style( 'wpstats', 'admin.css', array(), wpstats_VERSION );

	// Chosen v1.4.2
	wpstats_enqueue_minified_style( 'wpstats-chosen', 'chosen.min.css' );

	?>
	<style type="text/css">
		#wpcontent {
			<?php if ( $brand_background_color ) : ?> background-color: <?php echo $brand_background_color; endif; ?>;
			min-height: 1000px;
		}
	</style>
	<?php

	// jQuery v1.10.2
	wpstats_enqueue_minified_script( 'jquery-wpstats', 'jquery-1.10.2.min.js' );

	// jQuery UI v1.11.2
	wpstats_enqueue_minified_script( 'jquery-ui-wpstats', 'jquery-ui-1.11.2.min.js' );

	// Backstretch v2.0.4 (Minified)
	wpstats_enqueue_minified_script( 'wpstats-backstretch', 'backstretch.min.js' );

	// Global jQuery file
	wpstats_enqueue_script( 'wpstats', 'wpstats.js' );

	// Global jQuery file data
	wp_localize_script( 'wpstats', 'wpstats', array( 
		'brand_background_image_url' => $brand_background_image_url,
		'brand_background_color'     => $brand_background_color,
		'wp_version'                 => $wp_version,
	) );

	// Chosen v1.4.2
	wpstats_enqueue_minified_script( 'wpstats-chosen', 'chosen.jquery.min.js' );
}

/**
 * Scripts used for the Mashboard and Detail pages.
 * 
 * @since 1.0.0
 */
function wpstats_admin_enqueue_service_scripts() {
	?>
	<script type="text/javascript">
		WebFontConfig = {
			google: { families: [ 'Montserrat::latin', 'Open+Sans::latin' ] }
		};
		(function() {
			var wf = document.createElement('script' );
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>
	<?php

	$date_range_label_color = get_option( 'wpstats_date_range_label_color', '#fff' );

	?>
	<style>
		.wpstats-query-parameter-label {
			color: <?php echo $date_range_label_color; ?>;
			vertical-align: baseline;
		}
	</style>
	<?php

	// wpstats Services CSS
	wpstats_enqueue_style( 'wpstats-services', 'services.css' );

	// Excanvas - Adds support for the HTML5 canvas tag on Internet Explorer
	?>
	<!--[if lte IE 8]>
	<script language="javascript" type="text/javascript" src="<?php echo wpstats_TEMPLATE_JS_URL . 'excanvas.min.js'; ?>"></script>
	<![endif]-->
	<?php

	// Flot v0.8.3
	wpstats_enqueue_script( 'wpstats-flot', 'jquery.flot.js' );

	// Flot categories v1
	wpstats_enqueue_script( 'wpstats-flot-categories', 'jquery.flot.categories.js' );

	// Flot tooltip v0.8.4
	wpstats_enqueue_script( 'wpstats-flot-tooltip', 'jquery.flot.tooltip.js' );

	// wpstats Chart Functions
	wpstats_enqueue_script( 'wpstats-chart-functions', 'chart-functions.js' );

	wpstats_enqueue_script( 'wpstats-integrations', 'integrations.js' );
}

/**
 * Scripts used on the mashboard page.
 *
 * @global string $wp_version Installed version of WordPress.
 *
 * @since 0.0.1
 */
function wpstats_admin_enqueue_mashboard_scripts() {

	global $wp_version;

	// wpstats Mashboard CSS
	wpstats_enqueue_style( 'wpstats-mashboard', 'mashboard.css' );

	// Raphael v2.1.0
	wpstats_enqueue_minified_script( 'wpstats-raphael', 'raphael.min.js' );

	// Morris v0.5.0
	wpstats_enqueue_minified_script( 'wpstats-morris', 'morris.min.js' );

	// wpstats Mashboard Chart Categories
	wpstats_enqueue_script( 'wpstats-mashboard-categories', 'mashboard-flot-categories.js', array( 'wpstats-flot-categories' ) );

	// wpstats Mashboard JS
	wpstats_enqueue_script( 'wpstats-mashboard', 'mashboard.js' );

	/*
	 * Required for any integration specific translations, errors, or data for the mashboard.
	 */
	require_once wpstats_API_FUNCTIONS_PATH . 'google-analytics.php';
	require_once wpstats_API_FUNCTIONS_PATH . 'facebook.php';
	require_once wpstats_API_FUNCTIONS_PATH . 'twitter.php';
	require_once wpstats_API_FUNCTIONS_PATH . 'google-adwords.php';
	require_once wpstats_API_FUNCTIONS_PATH . 'mailchimp.php';
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	$mashboard_data = array(
		'google_analytics' => array(
			'selected_profile_id' => get_option( 'wpstats_selected_google_analytics_profile_id' ),
			'auth_popup_window_url' => wpstats_api_google_analytics_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
			'selected_google_account_email' => get_option( 'wpstats_selected_google_analytics_google_account_email' ),
		),
		'facebook' => array(
			'selected_page_id' => get_option( 'wpstats_selected_facebook_page_id' ),
			'auth_popup_window_url' => wpstats_facebook_get_authentication_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		),
		'twitter' => array(
			'auth_popup_window_url' => wpstats_api_twitter_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		),
		'google_adwords' => array(
			'selected_customer_id' => get_option( 'wpstats_google_adwords_selected_customer_id' ),
			'selected_campaign_id' => get_option( 'wpstats_google_adwords_selected_campaign_id' ),
			'auth_popup_window_url' => wpstats_api_google_adwords_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
			'setup' => get_option( 'wpstats_google_adwords_setup' ),
		),
		'mailchimp' => array(
			'auth_popup_window_url' => wpstats_api_mailchimp_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'template_images_url' => wpstats_TEMPLATE_IMAGES_URL,
		'mashboard_cards_visibility_status' => get_option( 'wpstats_mashboard_cards_visibility_status' ),
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
	);

	$translations = array(
		'google_adwords_api_errors'     => wpstats_api_google_adwords_get_api_error_translations(),
		'licensing'                     => wpstats_api_licensing_get_license_status_translations( wpstats_MASHBOARD_PAGE_URL ),
		'date_range_same'               => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_below_min'          => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_exceeds_today'      => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'date_range_exceeds_limit'      => __( 'Please select a date period within or equal to 91 days. The current 91 days worth of data are being loaded for you automatically.', 'wpstats' ),
		'twitter_historical_data_error' => __( 'Sorry, we don\'t have access to data for your account before {DATE} (or the data we have access to may be limited). Please select a different period. We will collect data for your account each day since you first setup the integration.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$mashboard_data = array_merge_recursive( $mashboard_data, array(
			'l10n_print_after' => 'wpstats_mashboard.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$mashboard_data = array_merge_recursive( $mashboard_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-mashboard', 'wpstats_mashboard', $mashboard_data );
}

/**
 * Scripts used for the Detail Pages only.
 * 
 * @since 1.0.0
 */
function wpstats_admin_enqueue_detail_pages_scripts() {
	wpstats_enqueue_style( 'wpstats-detail-pages', 'detail-pages.css' );
}

/**
 * Scripts used for the Google Analytics Detail Page.
 *
 * @global string $wp_version Installed version of WordPress.
 * 
 * @since 1.0.0
 */
function wpstats_admin_enqueue_google_analytics_scripts() {

	global $wp_version;

	wpstats_enqueue_style( 'wpstats-google-analytics', 'google-analytics.css' );

	wpstats_enqueue_script( 'wpstats-google-analytics', 'google-analytics-detail-page.js' );

	require_once wpstats_FUNCTIONS_PATH . 'access.php';
	require_once wpstats_API_FUNCTIONS_PATH . 'google-analytics.php';

	$google_analytics_data = array(
		'auth_popup_window_url'          => wpstats_api_google_analytics_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'selected_profile_id'            => get_option( 'wpstats_selected_google_analytics_profile_id' ),
		'selected_google_account_email'  => get_option( 'wpstats_selected_google_analytics_google_account_email' ),
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
	);

	$translations = array(
		'licensing'                => wpstats_api_licensing_get_license_status_translations( wpstats_GOOGLE_ANALYTICS_DETAIL_PAGE_URL ),
		'date_range_below_min'     => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_same'          => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_exceeds_today' => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$google_analytics_data = array_merge_recursive( $google_analytics_data, array(
			'l10n_print_after' => 'wpstats_google_analytics.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$google_analytics_data = array_merge_recursive( $google_analytics_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-google-analytics', 'wpstats_google_analytics', $google_analytics_data );
}

/**
 * Scripts used for the Facebook Detail Page.
 *
 * @global string $wp_version Installed version of WordPress.
 * 
 * @since 0.0.1
 */
function wpstats_admin_enqueue_facebook_scripts() {

	global $wp_version;

	wpstats_enqueue_script( 'wpstats-facebook', 'facebook-detail-page.js' );

	require_once wpstats_API_FUNCTIONS_PATH . 'facebook.php';
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	$facebook_data = array(
		'auth_popup_window_url' => wpstats_facebook_get_authentication_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'selected_page_id'    => get_option( 'wpstats_selected_facebook_page_id' ),
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
	);

	$translations = array(
		'licensing'                => wpstats_api_licensing_get_license_status_translations( wpstats_FACEBOOK_DETAIL_PAGE_URL ),
		'date_range_same'          => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_below_min'     => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_exceeds_today' => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'date_range_exceeds_limit' => __( 'Please select a date period within or equal to 91 days. The current 91 days worth of data are being loaded for you automatically.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$facebook_data = array_merge_recursive( $facebook_data, array(
			'l10n_print_after' => 'wpstats_facebook.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$facebook_data = array_merge_recursive( $facebook_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-facebook', 'wpstats_facebook', $facebook_data );
}

/**
 * Scripts used for the Twitter detail page.
 *
 * @global string $wp_version Installed version of WordPress.
 *
 * @since 0.2.5
 */
function wpstats_admin_enqueue_twitter_scripts() {

	global $wp_version;

	wpstats_enqueue_script( 'wpstats-twitter', 'twitter-detail-page.js' );

	require_once wpstats_API_FUNCTIONS_PATH . 'twitter.php';
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	$twitter_data = array(
		'auth_popup_window_url' => wpstats_api_twitter_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
	);

	$translations = array(
		'licensing'                => wpstats_api_licensing_get_license_status_translations( wpstats_FACEBOOK_DETAIL_PAGE_URL ),
		'date_range_same'          => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_below_min'     => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_exceeds_today' => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'twitter_historical_data_error' => __( 'Sorry, we don\'t have access to data for your account before {DATE} (or the data we have access to may be limited). Please select a different period. We will collect data for your account each day since you first setup the integration.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$twitter_data = array_merge_recursive( $twitter_data, array(
			'l10n_print_after' => 'wpstats_twitter.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$twitter_data = array_merge_recursive( $twitter_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-twitter', 'wpstats_twitter', $twitter_data );
}

/**
 * Scripts used for the Google Adwords detail page.
 *
 * @global string $wp_version Installed version of WordPress.
 *
 * @since 0.2.8
 */
function wpstats_admin_enqueue_google_adwords_scripts() {
	global $wp_version;

	wpstats_enqueue_script( 'wpstats-google-adwords', 'google-adwords-detail-page.js', array( 'jquery', 'jquery-ui-datepicker' ) );

	require_once wpstats_API_FUNCTIONS_PATH . 'google-adwords.php';
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	$google_adwords_data = array(
		'selected_customer_id' => get_option( 'wpstats_google_adwords_selected_customer_id' ),
		'selected_campaign_id' => get_option( 'wpstats_google_adwords_selected_campaign_id' ),
		'auth_popup_window_url'  => wpstats_api_google_adwords_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
		'setup' => get_option( 'wpstats_google_adwords_setup' ),
	);

	$translations = array(
		'google_adwords_api_errors'=> wpstats_api_google_adwords_get_api_error_translations(),
		'licensing'                => wpstats_api_licensing_get_license_status_translations( wpstats_FACEBOOK_DETAIL_PAGE_URL ),
		'date_range_same'          => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_below_min'     => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_exceeds_today' => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$google_adwords_data = array_merge_recursive( $google_adwords_data, array(
			'l10n_print_after' => 'wpstats_google_adwords.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$google_adwords_data = array_merge_recursive( $google_adwords_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-google-adwords', 'wpstats_google_adwords', $google_adwords_data );
}

/**
 * Scripts used on the MailChimp detail page.
 *
 * @since 0.3.2
 *
 * @global string $wp_version Installed version of WordPress.
 */
function wpstats_admin_enqueue_mailchimp_scripts() {
	global $wp_version;

	wpstats_enqueue_script( 'wpstats-mailchimp', 'mailchimp-detail-page.js', array( 'jquery', 'jquery-ui-datepicker' ) );

	require_once wpstats_API_FUNCTIONS_PATH . 'mailchimp.php';
	require_once wpstats_FUNCTIONS_PATH . 'access.php';

	$mailchimp_data = array(
		'auth_popup_window_url'  => wpstats_api_mailchimp_get_authorization_url( wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL ),
		'auth_popup_window_complete_url' => wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL,
		'current_user_can_access_settings' => wpstats_can_current_user_access_settings(),
	);

	$translations = array(
		'licensing'                => wpstats_api_licensing_get_license_status_translations( wpstats_FACEBOOK_DETAIL_PAGE_URL ),
		'date_range_same'          => __( 'Start date cannot be after the end date.', 'wpstats' ),
		'date_range_below_min'     => __( 'Start and end date must be on or after January 1st, 2005.', 'wpstats' ),
		'date_range_exceeds_today' => __( 'Start and end date cannot be after today.', 'wpstats' ),
		'current_user_settings_access_denied_error' => __( "Sorry, you don't have access to this integration's settings. Please contact the person who setup the integration, or has access to the settings, to setup the integration or change any settings for you.", 'wpstats' ),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$mailchimp_data = array_merge_recursive( $mailchimp_data, array(
			'l10n_print_after' => 'wpstats_mailchimp.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$mailchimp_data = array_merge_recursive( $mailchimp_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-mailchimp', 'wpstats_mailchimp', $mailchimp_data );
}
/**
 * Loads any scripts used on the settings page.
 * 
 * @since 0.0.1
 *
 * @global string $wp_version The installed version of WP.
 */
function wpstats_admin_enqueue_settings_scripts() {
	global $wp_version;

	// Settings CSS
	wpstats_enqueue_style( 'wpstats-settings', 'settings.css' );

	?>
	<style>
		.ui-accordion-header-icon {
			background-image: url( " <?php echo wpstats_TEMPLATE_IMAGES_URL . 'admin-sprite.png'; ?>" ) !important;
		}
	</style>
	<?php

	wpstats_enqueue_minified_script( 'wpstats-fileupload', 'jquery.fileupload.min.js' );

	wpstats_enqueue_minified_script( 'wpstats-fileupload-ui', 'jquery.fileupload-ui.min.js' );

	if ( $wp_version >= '3.5' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	} else {
		wpstats_enqueue_minified_style( 'wpstats-colorpicker', 'colorpicker.min.css' );
		wpstats_enqueue_minified_script( 'wpstats-colorpicker', 'colorpicker.min.js' );
	}

	wpstats_enqueue_script( 'wpstats-settings', 'settings.js' );

	$settings_data = array(
		'wp_version' => $wp_version,
	);

	$translations = array(
		'licensing' => wpstats_api_licensing_get_license_validation_request_translations(),
	);

	// These versions don't handle multidimensional arrays
	if ( $wp_version < '3.4' ) {
		$settings_data = array_merge_recursive( $settings_data, array(
			'l10n_print_after' => 'wpstats_settings.trans = ' . json_encode( $translations ) . ';',
		) );
	} else {
		$settings_data = array_merge_recursive( $settings_data, array(
			'trans' => $translations,
		) );
	}

	wp_localize_script( 'wpstats-settings', 'wpstats_settings', $settings_data );
}

add_action( 'admin_footer', 'wpstats_admin_footer' );

/**
 * Admin footer.
 *
 * @since 0.2.4
 */
function wpstats_admin_footer() {

	$page = ( isset( $_GET[ 'page' ] ) ) ? $_GET[ 'page' ] : '';

	if ( ! $page ) {
		return;
	}

	$pages = array(
		'wpstats-mashboard',
		'wpstats-google-analytics',
		'wpstats-facebook',
		'wpstats-twitter',
		'wpstats-google-adwords',
		'wpstats-mailchimp',
	);

	if ( ! in_array( $page, $pages, true ) ) {
		return;
	}

	/*
	 * 0.2.4 - 1st May 2015
	 * Fixes conflict with Google Analyticator plugin.
	 * De-enqueues/registers the Flot chart library on the Mashboard and
	 * detail pages.
	 */
	if ( wp_script_is( 'flot' ) ) {
		wp_dequeue_script( 'flot' );
		if ( wp_script_is( 'flot', 'registered' ) ) {
			wp_deregister_script( 'flot' );
		}
	}

	/*
	 * 0.3.7 - 17th May 2016
	 * Fixes conflict with "edit-flow" plugin v0.8.1
	 */
	if ( wp_script_is( 'edit_flow-timepicker' ) ) {
		wp_dequeue_script( 'edit_flow-timepicker' );
		if ( wp_script_is( 'edit_flow-timepicker', 'registered' ) ) {
			wp_deregister_script( 'edit_flow-timepicker' );
		}
	}
}
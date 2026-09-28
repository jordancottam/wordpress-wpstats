<?php

/**
 * wpstats definitions.
 * 
 * @since 0.0.1
 *
 * @package wpstats
 */

// Prevent direct access
defined( 'ABSPATH' ) or exit();

/**
 * The name of the plugin.
 *
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_NAME', 'wpstats' );

/**
 * Whether to use minified versions of CSS & JavaScript.
 *
 * Useful for testing there are no inconsistencies between the two
 * versions and/or to improve performance. This is always set to true by default.
 *
 * @since 0.0.1
 *
 * @var bool
 */
define( 'wpstats_USE_MINIFIED_SCRIPTS', false );

/**
 * The mode of the plugin.
 *
 * This directive is, and must be, used by developers/testers only.
 * 
 * Options:
 * 
 * local_dev = Local development
 * 
 * local_prod = Local Production
 * 
 * remote_dev = Remote Development
 * 
 * remote_prod = Remote Production
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_MODE', 'remote_prod' );

/**
 * This release version of wpstats.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_VERSION', '0.4.6' );

/**
 * Name of template to use.
 * 
 * Note: Experimental feature. Changing to a template that doesn't exist or have the necessary files won't work.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_NAME', 'default' );

/**
 * Absolute path to wpstats plugin root.
 *
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_ROOT_PATH', dirname( dirname( __FILE__ ) ) . '/' );

/**
 * Absolute path to wpstats plugin includes directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_INCLUDES_PATH', wpstats_ROOT_PATH . 'includes/' );

/**
 * Absolute path to wpstats plugin classes directory
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_CLASSES_PATH', wpstats_ROOT_PATH . 'classes/' );

/**
 * Absolute path to wpstats plugin functions directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_FUNCTIONS_PATH', wpstats_ROOT_PATH . 'functions/' );

/**
 * Absolute path to wpstats plugin API functions directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_API_FUNCTIONS_PATH', wpstats_FUNCTIONS_PATH . 'api/' );

/**
 * Absolute path to wpstats templates directory
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATES_PATH', wpstats_ROOT_PATH . 'templates/' );

/**
 * Absolute path to active wpstats template directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_PATH', wpstats_TEMPLATES_PATH . wpstats_TEMPLATE_NAME . '/' );

/**
 * Absolute path to active wpstats template admin directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_ADMIN_PATH', wpstats_TEMPLATE_PATH . 'admin/' );

/**
 * Absolute URL to wpstats root.
 *
 * @since 0.0.1
 * 
 * @var string
 */
defined( 'wpstats_ROOT_URL' ) or define( 'wpstats_ROOT_URL', plugin_dir_url( dirname( __FILE__ ) ) );

/**
 * Absolute URL to wpstats templates directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATES_URL', wpstats_ROOT_URL . 'templates/' );

/**
 * Absolute URL to active wpstats template directory.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_URL', wpstats_TEMPLATES_URL . wpstats_TEMPLATE_NAME . '/' );

/**
 * Absolute URL to wpstats static (css, js, and images) folder.
 *
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_STATIC_URL', wpstats_TEMPLATE_URL . 'static/' );

/**
 * Absolute URL to wpstats images folder.
 *
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_IMAGES_URL', wpstats_TEMPLATE_STATIC_URL . 'images/' );

/**
 * Absolute URL to wpstats default background image.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_DEFAULT_BACKGROUND_IMAGE_URL', wpstats_TEMPLATE_IMAGES_URL . 'background.jpg' );

/**
 * Absolute URL to wpstats default logo image.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_DEFAULT_LOGO_IMAGE_URL', wpstats_TEMPLATE_IMAGES_URL . 'logo.png' );

/**
 * Absolute URL to wpstats CSS folder.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_CSS_URL', wpstats_TEMPLATE_STATIC_URL . 'css/' );

/**
 * Absolute URL to wpstats minified CSS folder.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_CSS_MIN_URL' , wpstats_TEMPLATE_CSS_URL );

/**
 * Absolute URL to wpstats JavaScript folder.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_JS_URL', wpstats_TEMPLATE_STATIC_URL . 'js/' );

/**
 * Absolute URL to wpstats minified JavaScript folder.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_TEMPLATE_JS_MIN_URL', wpstats_TEMPLATE_JS_URL );

/**
 * Absolute URL to where you can purchase a license key to unlock all wpstats' features.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
switch ( wpstats_MODE ) {
	case 'remote_dev':
	case 'remote_prod':
		define( 'wpstats_PURCHASE_LICENSE_KEY_URL', 'https://example.com/' );
		break;
	case 'local_dev':
	case 'local_prod':
	default:
		define( 'wpstats_PURCHASE_LICENSE_KEY_URL', 'http://example.dev/' );
		break;
}

/**
 * Absolute URL to the wpstats store.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
switch ( wpstats_MODE ) {
	case 'remote_dev':
	case 'remote_prod':
		define( 'wpstats_STORE_URL', 'https://example.com/' );
		break;
	case 'local_dev':
	case 'local_prod':
	default:
		define( 'wpstats_STORE_URL', 'http://example.dev/' );
		break;
}

/**
 * Product name.
 * 
 * This shouldn't be modified unless you know what you're doing.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
define( 'wpstats_PRODUCT_NAME', 'wpstats' );

/**
 * Absolute URL to the wpstats API.
 * 
 * @since 0.0.1
 * 
 * @var string
 */
switch ( wpstats_MODE ) {
	case 'remote_dev':
		define( 'wpstats_API_URL', 'http://dev.example.com/' );
		break;
	case 'remote_prod':
		define( 'wpstats_API_URL', 'http://app.example.com/' );
		break;
	case 'local_dev':
	case 'local_prod':
	default:
		define( 'wpstats_API_URL', 'http://example.com/' );
		break;
}

/**
 * wpstats Google Analytics API version.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_VERSION', 'v1' );

/**
 * wpstats Google Analytics API URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_URL', wpstats_API_URL . 'api/' . wpstats_GOOGLE_ANALYTICS_API_VERSION . '/googleAnalytics/' );

/**
 * wpstats Google Analytics API authorize URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_AUTHORIZE_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'authenticate' );

/**
 * wpstats Google Analytics API deauthorize URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_DEAUTHORIZE_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'deauthorize' );

/**
 * wpstats Google Analytics API Google accounts URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_GOOGLE_ACCOUNTS_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getGoogleAccounts' );

/**
 * wpstats Google Analytics API configuration data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_CONFIGURATION_DATA_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getConfigurationData' );

/**
 * wpstats Google Analytics API Mashboard view data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_MASHBOARD_VIEW_DATA_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getMashboardViewData' );

/**
 * wpstats Google Analytics API Detail view data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_DETAIL_VIEW_DATA_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getDetailViewData' );

/**
 * wpstats Google Analytics API top keywords data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_TOP_KEYWORDS_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getTopKeywords' );

/**
 * wpstats Google Analytics API top search engine referrals data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_TOP_SEARCH_ENGINE_REFERRALS_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getTopSearchEngineReferrals' );

/**
 * wpstats Google Analytics API top landing pages data URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_TOP_LANDING_PAGES_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getTopLandingPages' );

/**
 * wpstats Google Analytics API top visitor locations URL.
 *
 * @since 0.3.5
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_API_GET_TOP_VISITOR_LOCATIONS_URL', wpstats_GOOGLE_ANALYTICS_API_URL . 'getTopVisitorLocations' );

/**
 * @since 0.4.2
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ADWORDS_API_VERSION', 'v1' );

/**
 * @since 0.4.2
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ADWORDS_API_URL', wpstats_API_URL . 'api/v1/googleAdwords/' );

/**
 * Timeout for API calls in seconds.
 * 
 * @since 0.0.1
 * 
 * @var int
 */
define( 'wpstats_API_REQUEST_TIMEOUT', 120 );

/**
 * Whether to compress the request body for API calls.
 * 
 * @since 0.0.1
 * 
 * @var bool
 */
define( 'wpstats_API_REQUEST_COMPRESS', true );

/**
 * Whether to check if the SSL certificate is valid for the API domain.
 * 
 * @since 0.0.1
 * 
 * @var bool
 */
define( 'wpstats_API_REQUEST_VERIFY_SSL', false );

if ( ini_get( 'max_execution_time' ) <= 30 ) {
	ini_set( 'max_execution_time', wpstats_API_REQUEST_TIMEOUT );
}

/**
 * URL to the mashboard page.
 *
 * @since 0.1.4
 *
 * @var string
 */
define( 'wpstats_MASHBOARD_PAGE_URL', admin_url( 'admin.php?page=wpstats-mashboard' ) );

/**
 * URL to the Facebook detail page.
 *
 * @since 0.1.4
 *
 * @var string
 */
define( 'wpstats_FACEBOOK_DETAIL_PAGE_URL', admin_url( 'admin.php?page=wpstats-facebook' ) );

/**
 * URL to the Google Analytics detail page.
 *
 * @since 0.1.4
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ANALYTICS_DETAIL_PAGE_URL', admin_url( 'admin.php?page=wpstats-google-analytics' ) );

/**
 * Absolute URL to the Twitter detail page.
 *
 * @since 0.2.5
 *
 * @var string
 */
define( 'wpstats_TWITTER_DETAIL_PAGE_URL', admin_url( 'admin.php?page=wpstats-twitter' ) );

/**
 * URL to the Google Adwords detail page.
 *
 * @since 0.2.8
 *
 * @var string
 */
define( 'wpstats_GOOGLE_ADWORDS_DETAIL_PAGE_URL', admin_url( 'admin.php?page=wpstats-google-adwords' ) );

/**
 * URL to the MailChimp detail page.
 *
 * @since 0.3.2
 *
 * @var string
 */
define( 'wpstats_MAILCHIMP_DETAIL_PAGE_URL', admin_url( 'admin.php?page=wpstats-mailchimp' ) );

/**
 * URL to the settings page.
 *
 * @since 0.1.4
 *
 * @var string
 */
define( 'wpstats_SETTINGS_PAGE_URL', admin_url( 'admin.php?page=wpstats-settings' ) );

/**
 * Absolute URL to renew a license key.
 *
 * @since 0.1.5
 *
 * @var string
 */
define( 'wpstats_RENEW_LICENSE_KEY_URL', 'https://example.com/checkout/?edd_license_key={LICENSE_KEY}&download_id=29' );

/**
 * Version identifier for script and styles.
 *
 * @since 0.2.5
 *
 * @var string
 */
define( 'wpstats_SCRIPTS_VERSION', 'wpstats-premium-046-1510612990' );

/**
 * Authorization popup window complete URL.
 *
 * The URL the popup window redirects to after an integration is setup.
 *
 * @since 0.3.0
 *
 * @var string
 */
define( 'wpstats_AUTH_POPUP_WINDOW_COMPLETE_URL', admin_url( 'admin.php?wpstats_auth_popup_window_complete=1' ) );
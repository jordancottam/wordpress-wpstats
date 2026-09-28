<?php

// Prevent direct access
defined( 'ABSPATH' ) or exit();

/**
 * wpstats mashboard cards related functions.
 *
 * @since 0.2.9
 *
 * @package wpstats\Mashboard
 */

/**
 * Return array as key (mashboard card element ID) => value (translated display name) pairs
 *
 * @since 0.2.9
 *
 * @return array
 */
function wpstats_get_mashboard_card_names() {
	return array(
		'googleanalytics_1'  => __( 'Google Analytics', 'wpstats' ),
		'facebook_2'         => __( 'Facebook', 'wpstats' ),
		'twitter_3'          => __( 'Twitter', 'wpstats' ),
		'paypal_4'           => __( 'PayPal', 'wpstats' ),
		'youtube_5'          => __( 'YouTube', 'wpstats' ),
		'googleplus_6'       => __( 'Google Plus', 'wpstats' ),
		'linkedin_7'         => __( 'LinkedIn', 'wpstats' ),
		'mailchimp_8'        => __( 'MailChimp', 'wpstats' ),
		'wordpress_9'        => __( 'WordPress', 'wpstats' ),
		'aweber_10'          => __( 'AWeber', 'wpstats' ),
		'googleadwords_11'   => __( 'Google Adwords', 'wpstats' ),
		'campaignmonitor_12' => __( 'Campaign Monitor', 'wpstats' ),
		'vote_13'            => __( 'Vote', 'wpstats' ),
		'upgrading_14'       => __( 'Upgrade', 'wpstats' ),
	);
}

/**
 * Returns array of mashboard cards element IDs.
 *
 * @since 0.2.9
 *
 * @return array
 */
function wpstats_get_mashboard_card_identifiers() {
	return array(
		'googleanalytics_1',
		'facebook_2',
		'twitter_3',
		'paypal_4',
		'youtube_5',
		'googleplus_6',
		'linkedin_7',
		'mailchimp_8',
		'wordpress_9',
		'aweber_10',
		'googleadwords_11',
		'campaignmonitor_12',
		'vote_13',
		'upgrading_14',
	);
}

/**
 * Return array as key (mashboard card element ID) => value (1 (enabled) or 0 (disabled)) pairs.
 *
 * @since 0.2.9
 *
 * @return array
 */
function wpstats_get_mashboard_cards_enabled_status() {
	return array(
		'googleanalytics_1'  => '1',
		'facebook_2'         => '1',
		'twitter_3'          => '1',
		'paypal_4'           => '0',
		'youtube_5'          => '0',
		'googleplus_6'       => '0',
		'linkedin_7'         => '0',
		'mailchimp_8'        => '1',
		'wordpress_9'        => '0',
		'aweber_10'          => '0',
		'googleadwords_11'   => '1',
		'campaignmonitor_12' => '0',
		'vote_13'            => '0',
		'upgrading_14'       => '0',
	);
}
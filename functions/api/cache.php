<?php

/**
 * wpstats API cache-related functions.
 * 
 * @since 1.1.1
 *
 * @package wpstats\API\Cache
 */

defined( 'ABSPATH' ) or exit();

/**
 * Return a cache row specified by $name.
 * 
 * @since 1.1.1
 * 
 * @param string $name Cache name.
 * 
 * @return mixed False if the cache does not exist, otherwise the value of the cache.
 */
function wpstats_api_cache_get( $name ) {

	if ( 'enabled' !== get_option( 'wpstats_cache_mode' ) ) {
		return false;
	}

	global $wpdb;

	$name = sanitize_key( $name );

	$var = $wpdb->get_var( "SELECT `cache_value` FROM `{$wpdb->prefix}wpstats_cache` WHERE `cache_name` = '{$name}'");

	if ( ! $var ) {
		return false;
	}

	$var = unserialize( $var );

	if ( ! is_array( $var ) ) {
		return false;
	}

	if ( ! ( array_key_exists( 'data', $var ) && array_key_exists( 'responseType', $var ) && array_key_exists( 'responseContext', $var ) ) ) {
		return false;
	}

	return $var;
}

/**
 * Inserts or updates a cache row.
 * 
 * @since 1.1.1
 * 
 * @param string $name  Cache name.
 * 
 * @param mixed  $value Cache value.
 * 
 * @return bool|null    False if the caching is disabled. Otherwise null.
 */
function wpstats_api_cache_set( $name, $value ) {

	if ( ! ( ! empty( $value ) && is_array( $value ) ) ) {
		return;
	}

	if ( ! $value = serialize( $value ) ) {
		return;
	}

	global $wpdb;

	$table = $wpdb->prefix . 'wpstats_cache';

	$name = sanitize_key( $name );

	if ( $cache_id = $wpdb->get_var( "SELECT `cache_id` FROM `{$table}` WHERE `cache_name` = '{$name}'" ) ) {
		$wpdb->update( $table, array(
			'cache_value' => $value,
		), array(
			'cache_id'   => $cache_id,
		) );
	} else {
		$wpdb->insert( $wpdb->prefix . 'wpstats_cache', array(
			'cache_name'  => $name,
			'cache_value' => $value,
		) );
	}
}

/**
 * Delete a cache row identified by $name.
 * 
 * @since 1.1.1
 * 
 * @param string $name  Cache name.
 * 
 * @return void
 */
function wpstats_api_cache_delete( $name ) {
	global $wpdb;
	$table = $wpdb->prefix . 'wpstats_cache';
	$name = sanitize_key( $name );
	$wpdb->query( "DELETE FROM `{$table}` WHERE `cache_name` = '{$name}'" );
}

/**
 * Deletes one or more cache rows matching the query.
 * 
 * @since 1.1.1
 * 
 * @param string $name_like
 * 
 * @return void
 */
function wpstats_api_cache_delete_name_like( $name_like ) {
	global $wpdb;
	$table = $wpdb->prefix . 'wpstats_cache';
	$name_like = esc_sql( $name_like );
	$wpdb->query( "DELETE FROM `{$table}` WHERE `cache_name` LIKE '%{$name_like}%'" );
}
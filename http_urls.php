<?php
/**
 * Plugin Name: HTTP URLs
 * Plugin URI:  http://wordpress.org/plugins/http-urls
 * Description: The easiest way to get the HTTP/HTTPS version of any URL.
 * Version:     1.0
 * Author:      Mickey Kay & MIGHTYminnow
 * Author URI:  http://mightyminnow.com
 * License:     GPLv2+
 * Text Domain: hu
 * Domain Path: /languages
 */

// Useful global constants
define( 'HU_VERSION', '1.0' );
define( 'HU_URL',     plugin_dir_url( __FILE__ ) );
define( 'HU_PATH',    dirname( __FILE__ ) . '/' );
 
/**
 * Get the HTTP version of a URL.
 *
 * @return string $url Current page/post URL converted to HTTP.
 */
function hu_get_http_url( $url ) {
    return preg_replace( '/^https:/', 'http:', $url );
}

/**
 * Get the HTTPS version of a URL.
 *
 * @return string $url Current page/post URL converted to HTTPS.
 */
function hu_get_https_url( $url ) {
    return preg_replace( '/^http:/', 'https:', $url );
}

/**
 * HTTP URL Shortcode.
 * 
 * Output the HTTP version of a URL based on:
 *  1. 'url' shortcode attribute, else
 *  2. permalink for current post
 *
 * @return string $url Current page/post URL converted to HTTP.
 */
function hu_shortcode( $atts ) {
 

 	// Get shortcode attributes
	extract( shortcode_atts( array(
		'url'      => '',
		'to_https' => '',
	), $atts, 'http-url' ) );

	// Use permalink for current post if no URL shortcode attribute is specified
    $url = $url ? $url : get_permalink();

    // Get converted URL, depending on 'to_https' filter
    $url = $to_https ? hu_get_https_url( $url ) : hu_get_http_url( $url );
 
    return $url;
}

// Add the shortcode
add_shortcode( 'http-url', 'hu_shortcode' );
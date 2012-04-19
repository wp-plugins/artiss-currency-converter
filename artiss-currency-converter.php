<?php
/*
Plugin Name: Artiss Currency Converter
Plugin URI: http://www.artiss.co.uk/currency-converter
Description: Convert currency values
Version: 1.0
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

/**
* Artiss Currency Converter
*
* Main code - include various functions
*
* @package	Artiss-Currency-Converter
* @since	1.0
*/

define( 'artiss_currency_converter_version', '1.0' );

$functions_dir = WP_PLUGIN_DIR . '/artiss-currency-converter/includes/';

// Include all the various functions

include_once( $functions_dir . 'acc-get-options.php' );			            // Fetch/create default options

include_once( $functions_dir . 'acc-shared-functions.php' );			    // Shared functionality

include_once( $functions_dir . 'acc-convert-currency.php' );			// Main code to perform currency conversion

if ( is_admin() ) {

    include_once( $functions_dir . 'acc-admin-config.php' );		        // Assorted admin configuration changes

} else {

	include_once( $functions_dir . 'acc-shortcodes.php' );			        // Shortcodes

	include_once( $functions_dir . 'acc-functions.php' );			        // PHP function calls
}
?>
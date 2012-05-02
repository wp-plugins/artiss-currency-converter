<?php
/**
* Get Parameters
*
* Fetch options - if none exist set them.
*
* @package	Artiss-Currency-Converter
* @since	1.0
*
* @return	string	Array of default options
*/

function acc_get_options() {

	$options = get_option( 'artiss_currency_converter' );
	$changed = false;

	// If array doesn't exist, set defaults

	if ( !is_array( $options ) ) {
		$options = array( 'from' => 'USD', 'to' => 'EUR', 'round' => 'nearest', 'dp' => 'match', 'rates_cache' => 60, 'codes_cache' => 24 );
		$changed = true;
	}

	// Update the options, if changed, and return the result

	if ( $changed ) { update_option( 'artiss_currency_converter', $options ); }

	return $options;
}
?>
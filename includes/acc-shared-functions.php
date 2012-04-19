<?php
/**
* Shared Functions Functions
*
* Various functions that are called from a number of sources
*
* @package	Artiss-Currency-Converter
*/

/**
* Get exchange rates
*
* Extract exchange rates and convert from JSON to an array
*
* @since	1.0
*
* @param    string  $cache      Length of time to cache results (optional, default 60 minutes)
* @return	string				Array containing exchange rates
*/

function acc_get_rates( $cache = 60 ) {

    $rates = false;
    $cache_key = 'acc_rates';

    // Check if a cached version already exists - if so, return it

    if ( strtolower( $cache ) != 'no' ) { $rates = get_transient( $cache_key ); }

    // If cache doesn't exist use CURL to get the exchange rates

    if ( !$rates ) {

        $file = acc_get_file( 'http://openexchangerates.org/latest.json' );

        if ( $file[ 'rc' ] != 0 ) {

            $rates = __( 'Could not fetch exchange rate information' );

        } else {

            $json = $file[ 'file' ];

            // Decode the JSON output to an array

            $array = json_decode( $json, true );

            // Extract out just the rates element of the array

            $rates = $array[ rates ];

            // Check that something was returned

            if ( $rates == '' ) {

                $rates = __( 'No exchange rate information returned' );

            } else {

                // Save to cache

                if ( strtolower( $cache ) != 'no' ) { set_transient( $cache_key, $rates, 60 * $cache ); }
            }
        }
    }

    return $rates;

}

/**
* Get currency code
*
* Extract currency codes and convert from JSON to an array
*
* @since	1.0
*
* @param    string  $cache      Length of time to cache results (optional, default 24 hours)
* @return	string				Array containing currency codes
*/

function acc_get_codes( $cache = 24 ) {

    $codes = false;
    $cache_key = 'acc_codes';

    // Check if a cached version already exists - if so, return it

    if ( strtolower( $cache ) != 'no' ) { $codes = get_transient( $cache_key ); }

    // If cache doesn't exist use CURL to get the currency codes

    if ( !$codes ) {

        $file = acc_get_file( 'http://openexchangerates.org/currencies.json' );

        if ( $file[ 'rc' ] != 0 ) {

            $rates = __( 'Could not fetch currency code information' );

        } else {

            $json = $file[ 'file' ];

            // Decode the JSON output to an array

            $codes = json_decode( $json, true );

            // Check that something was returned

            if ( $codes == '' ) {

                $rates = __( 'No currency code information returned' );

            } else {

                // Save to cache

                if ( strtolower( $cache ) != 'no' ) { set_transient( $cache_key, $codes, 3600 * $cache ); }
            }
        }
    }

    return $codes;
}

/**
* Fetch a file (1.6)
*
* Use WordPress API to fetch a file and check results
* RC is 0 to indicate success, -1 a failure
*
* @since	1.0
*
* @param	string	$filein		File name to fetch
* @param	string	$header		Only get headers?
* @return	string				Array containing file contents and response
*/

function acc_get_file( $filein, $header = false ) {

	$rc = 0;
	$error = '';
	if ( $header ) {
		$fileout = wp_remote_head( $filein );
		if ( is_wp_error( $fileout ) ) {
			$error = 'Header: ' . $fileout -> get_error_message();
			$rc = -1;
		}
	} else {
		$fileout = wp_remote_get( $filein );
		if ( is_wp_error( $fileout ) ) {
			$error = 'Body: ' . $fileout -> get_error_message();
			$rc = -1;
		} else {
			if ( isset( $fileout[ 'body' ] ) ) {
				$file_return[ 'file' ] = $fileout[ 'body' ];
			}
		}
	}

	$file_return[ 'error' ] = $error;
	$file_return[ 'rc' ] = $rc;
	if ( !is_wp_error( $fileout ) ) {
		if ( isset( $fileout[ 'response' ][ 'code' ] ) ) {
			$file_return[ 'response' ] = $fileout[ 'response' ][ 'code' ];
		}
	}

	return $file_return;
}

/**
* Extract Parameters (1.1)
*
* Function to extract parameters from an input string
*
* @since	1.0
*
* @param	$input	string	Input string
* @param	$para	string	Parameter to find
* @return			string	Parameter value
*/

function acc_get_parameters( $input, $para, $divider = '=', $seperator = '&' ) {

    $start = strpos( strtolower( $input ), $para . $divider);
    $content = '';
    if ( $start !== false ) {
        $start = $start + strlen( $para ) + 1;
        $end = strpos( strtolower( $input ), $seperator, $start );
        if ( $end !== false ) { $end = $end - 1; } else { $end = strlen( $input ); }
        $content = substr( $input, $start, $end - $start + 1 );
    }
    return $content;
}
?>
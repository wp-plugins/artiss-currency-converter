<?php
/**
* Convert Currency
*
* Perform currency conversions
*
* @package	Artiss-Currency-Converter
*/

/**
* Convert Currency
*
* Perform a currency conversion and output the results
*
* @since	1.0
*
* @uses 	acc_perform_conversion  Perform the actual currency conversion
*
* @param    string      $number     Number to convert
* @param    string      $from       Currency code to convert from
* @param    string      $to         Currency code to convert to
* @param    string      $dp         Number of decimal points
* @param    string      $template   Output template
* @return   string                  Output
*/

function acc_convert_currency( $number = '', $from = '', $to = '', $dp = '', $template = '' ) {

    $tag = '%result%';
    $suppress_errors = false;

    // If no template has been provided, create a default one

    if ( $template == '' ) { $template = $tag; } else { $suppress_errors = true; }

    if ( $number == '' ) {

        // Report an error if no number was supplied

        $result = '#' . __( 'No number supplied for conversion', 'currency-converter' );

    } else {

        // Perform the conversion

        $result = acc_perform_conversion( $number, $from, $to, $dp );
    }

    // If using a template and an error is returned, return nothing.
    // Otherwsie, replace the figure in the template

    if ( substr( $result, 0, 1 ) == '#' ) {
        if ( $suppress_errors ) {
            return;
        } else {
            return '<span style="font-weight: bold; color: #f00;">' . __( 'Artiss Currency Converter Error: ', 'currency-converter' ) . substr( $result, 1 ) . '</span>';
        }
    } else {
        return str_replace( $tag, $result, $template );
    }
}

/**
* Perform Currency Conversion
*
* Perform a currency conversion and output the results
*
* @since	1.0
*
* @uses 	acc_get_options         Get the default options
* @uses     acc_get_rates           Get the array of exchange rates
*
* @param    string      $number     Number to convert
* @param    string      $from       Currency code to convert from
* @param    string      $to         Currency code to convert to
* @param    string      $dp         Number of decimal points
* @return   string                  Result
*/

function acc_perform_conversion( $number = '', $from = '', $to = '', $dp = '' ) {

    $error = '';
    $result = '';
    $options = acc_get_options();

    // If any of the details are missing, get them from the default options that are set

    if ( $from == '' ) {
        if ( defined( global_convert_from ) ) {
            $from = global_convert_from;
        } else {
            $from = $options[ 'from' ];
        }
    }
    if ( $to == '' ) {
        if ( defined( global_convert_to ) ) {
            $to = global_convert_to;
        } else {
            $to = $options[ 'to' ];
        }
    }
    if ( $dp == '' ) { $dp = $options[ 'dp' ]; }

    // Get exchange rates from array

    $rates_array = acc_get_rates( $options[ 'rates_cache' ] );

    if ( is_array( $rates_array ) ) {

        $from = $rates_array[ strtoupper( $from ) ];
        $to = $rates_array[ strtoupper( $to ) ];

        if ( ( $from == '' ) or ( $to == '' ) ) {

            $error = '#' . __( 'Could not fetch one of the required exchange rates', 'currency-converter' );

        } else {

            // If the DP parameter is to match then calculcate the number of decimal places that
            // the passed value is

            if ( !is_numeric( $dp ) ) {
                $decimal_pos = strpos( $number, '.' );
                if ( !$decimal_pos ) {
                    $dp = 0;
                } else {
                    $dp = strlen( $number ) - ( $decimal_pos + 1 );
                }
            }

            // Perform the conversion

            $result = number_format( round( $number * ( $to * ( 1 / $from ) ), $dp ), $dp );
        }
    } else {

        $error = $rates_array;
    }

    if ( $error != '' ) { $result = $error; }
    return $result;
}
?>
<?php
/**
* Functions
*
* Functions calls
*
* @package	Artiss-Currency-Converter
*/

/**
* Conversion Function
*
* Function call to perform and return conversion
*
* @since	1.0
*
* @param	string	$paras		Parameters
* @return	string				Output
*/

function get_conversion( $paras = '' ) {

    // Extra parameters

    $number = acc_get_parameters( $paras, 'number' );
    $from = acc_get_parameters( $paras, 'from' );
    $to = acc_get_parameters( $paras, 'to' );
    $dp = acc_get_parameters( $paras, 'dp' );

    // Perform currency conversion using supplied parameters

    return acc_convert_currency( $number, $from, $to, $dp, '' );
}
?>
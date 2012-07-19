<?php
/**
* Shortcodes
*
* Shortcode functions
*
* @package	Artiss-Currency-Converter
*/

/**
* Conversion Shortcode
*
* Shortcode to perform and output conversion
*
* @since	1.0
*
* @param	string	$paras		Shortcode parameters
* @param	string	$content	Optional template
* @return	string				Output
*/

function acc_convert_shortcode( $paras = '', $content = '' ) {

	extract( shortcode_atts( array( 'number' => '', 'from' => '', 'to' => '', 'dp' => '', 'template' => '' ), $paras ) );

    // If content provided, assume this to be the template

    if ( $content != '' ) { $template = $content; }

    // Perform currency conversion using supplied parameters

    return acc_convert_currency( $number, $from, $to, $dp, $template );

}
add_shortcode( 'convert', 'acc_convert_shortcode' );
?>
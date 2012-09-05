<?php
/**
* Exchange rates
*
* View exchange rate information
*
* @package	Artiss-Currency-Converter
* @since	1.0
*
* @uses	ace_get_embed_paras	Get the options
*/

// Fetch information from external functions

$options = acc_get_options();
$rates_array = acc_get_rates( $options[ 'rates_cache' ] );
$codes_array = acc_get_codes( $options[ 'codes_cache' ] );

// If a currency conversion has been requested, work out the result

if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'acc-rates' , 'artiss_currency_converter_nonce' ) ) ) {
    $result = $_POST[ 'acc_from' ] . ' ' . $_POST[ 'acc_number' ] . ' = ' . $_POST[ 'acc_to' ] . ' ' . acc_perform_conversion( $_POST[ 'acc_number' ], $_POST[ 'acc_from' ], $_POST[ 'acc_to' ], '2' );
} else {
    $result = false;
}
?>

<div class="wrap">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>
<h2><?php _e( 'Artiss Currency Converter Rates', 'currency-converter' ); ?></h2>

<?php
if ( $options[ 'id' ] == '' ) {
?>

<div class="error fade"><p><strong><?php _e( 'No App ID has been specified, so exchange rates cannot be displayed', 'currency-converter' ); ?></strong></p></div>

<?php
} else {

if ( $options[ 'donated'] != 1 ) { artiss_plugin_ads(); }
?>

<p><?php _e( 'Below are the current exchange rates. All rates are in relation to USD. Alternatively use the following form to perform a quick conversion.', 'currency-converter' );?></p>

<p><form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=acc-rates' ?>">

<?php _e( 'Amount', 'currency-converter' );?>&nbsp;<input type="text" size="8" name="acc_number" value=""/>

<?php _e( 'From', 'currency-converter' );?>&nbsp;<select name="acc_from">
<?php
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<option value="' . $cc . '"';
    if ( $options[ 'from' ] == $cc ) { echo " selected='selected'"; }
    echo '>' . $cc . '</option>';
    next( $rates_array );
}
?>
</select>

<?php _e( 'To', 'currency-converter' );?>&nbsp;<select name="acc_to">
<?php
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<option value="' . $cc . '"';
    if ( $options[ 'to' ] == $cc ) { echo " selected='selected'"; }
    echo '>' . $cc . '</option>';
    next( $rates_array );
}
?>
</select>

<?php wp_nonce_field( 'acc-rates', 'artiss_currency_converter_nonce', true, true ); ?>

<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Convert', 'currency-converter' ); ?>"/>

<?php if ( $result !== false ) { echo '&nbsp;'. $result; } ?>

</form></p>

<table>
<tr><td></td><td><strong><?php _e( 'Currency Code', 'currency-converter' ); ?></strong></td><td><strong><?php _e( 'Currency Name', 'currency-converter' ); ?></strong></td><td><strong><?php _e( 'Exchange Rate', 'currency-converter' ); ?></strong></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<?php
reset ($rates_array);
foreach ( $rates_array as $cc => $exchange_rate ) {
    echo '<tr><td width="26px">';

    // Output a flag, if one exists

    $flag_dir = WP_PLUGIN_URL . '/artiss-currency-converter/images/flags/';
    $flag_file = strtolower( $cc ) . '.png';
    $flag_name = __( 'Flag', 'currency-converter' );
    if ( $codes_array[ $cc ] != '' ) { $flag_name = sprintf( __( 'Flag for %s', 'currency-converter' ), $codes_array[ $cc ] ); }

    echo '<img src="' . $flag_dir . $flag_file . '" alt="' . $flag_name . '" title="' . $flag_name . '" width="16px" height="11px">';

    // Now output the rest of the currency information

    echo '</td><td width="100px">' . $cc . '</td><td width="300px">' . $codes_array[ $cc ] . '</td><td>' . $exchange_rate . '</td>';
    next ( $rates_array );
    echo "</tr>\n";
}
?>
</table>

</div>
<?php } ?>
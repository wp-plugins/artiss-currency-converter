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
    $result = $_POST[ 'acc_from' ] . ' ' . $_POST[ 'acc_number' ] . ' = ' . $_POST[ 'acc_to' ] . ' ' . acc_perform_conversion( $_POST[ 'acc_number' ], $_POST[ 'acc_from' ], $_POST[ 'acc_to' ], '' );
} else {
    $result = false;
}
?>

<div class="wrap">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>
<h2><?php _e( 'Artiss Currency Converter Rates' ); ?></h2>

<p>Below are the current exchange rates. All rates are in relation to USD. Alternatively use the following form to perform a quick conversion.</p>

<p><form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=acc-rates' ?>">

Amount&nbsp;<input type="text" size="8" name="acc_number" value=""/>

From&nbsp;<select name="acc_from">
<?php
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<option value="' . $cc . '"';
    if ( $options[ 'from' ] == $cc ) { echo " selected='selected'"; }
    echo '>' . $cc . '</option>';
    next( $rates_array );
}
?>
</select>

To&nbsp;<select name="acc_to">
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

<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Convert' ); ?>"/>

<?php if ( $result !== false ) { echo '&nbsp;'. $result; } ?>

</form></p>

<table>
<tr><td><strong>Currency Code</strong></td><td><strong>Currency Name</strong></td><td><strong>Exchange Rate</strong></td></tr>
<tr><td colspan="3">&nbsp;</td></tr>
<?php
reset ($rates_array);
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<tr><td width="100px">' . $cc . '</td><td width="300px">' . $codes_array[ $cc ] . '</td><td>' . $exchange_rate . '</td>';
    next( $rates_array );
    echo "</tr>\n";
}
?>
</table>

</div>
<?php
/**
* Set Default Options
*
* Allow the user to change the default options
*
* @package	Artiss-Currency-Converter
* @since	1.0
*
* @uses	acc_get_options Get the options
*/
?>
<div class="wrap">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>
<h2><?php _e( 'Artiss Currency Converter Options' ); ?></h2>
<?php

// If options have been updated on screen, update the database

if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'acc-options' , 'artiss_currency_converter_options_nonce' ) ) ) {

	// Update the options array from the form fields.

	$options[ 'from' ] = $_POST[ 'acc_from' ];
	$options[ 'to' ] = $_POST[ 'acc_to' ];
	$options[ 'dp' ] = $_POST[ 'acc_dp' ];
	$options[ 'rates_cache' ] = trim( $_POST[ 'acc_rates_cache' ] );
    if ( $options[ 'rates_cache' ] == '' ) { $options[ 'rates_cache' ] = 60; }
	$options[ 'codes_cache' ] = trim( $_POST[ 'acc_codes_cache' ] );
    if ( $options[ 'codes_cache' ] == '' ) { $options[ 'codes_cache' ] = 24; }

    update_option( 'artiss_currency_converter', $options );

    echo '<div class="updated fade"><p><strong>' . __( 'Settings Saved.' ) . "</strong></p></div>\n";
}

// Fetch options and rates into an array

$options = acc_get_options();
$rates_array = acc_get_rates( $options[ 'rates_cache' ] );
$codes_array = acc_get_codes( $options[ 'codes_cache' ] );
?>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=acc-options' ?>">

<?php _e( 'Specify the default options that will be used if any specific parameters are not supplied.' ); ?>

<table class="form-table">

<tr>
<th scope="row"><?php _e( 'From' ); ?></th>
<td><select name="acc_from">
<?php
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<option value="' . $cc . '"';
    if ( $options[ 'from' ] == $cc ) { echo " selected='selected'"; }
    echo '>' . $cc . ' - ' . $codes_array[ $cc ] . '</option>';
    next( $rates_array );
}
?>
</select>&nbsp;<span class="description"><?php _e( 'The currency to convert from' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'To' ); ?></th>
<td><select name="acc_to">
<?php
foreach( $rates_array as $cc => $exchange_rate ){
    echo '<option value="' . $cc . '"';
    if ( $options[ 'to' ] == $cc ) { echo " selected='selected'"; }
    echo '>' . $cc . ' - ' . $codes_array[ $cc ] . '</option>';
    next( $rates_array );
}
?>
</select>&nbsp;<span class="description"><?php _e( 'The currency to convert to' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Decimal Places' ); ?></th>
<td><select name="acc_dp">
<option value="0"<?php if ( $options[ 'dp' ] == '0' ) { echo " selected='selected'"; } ?>><?php _e ( '0' ); ?></option>
<option value="1"<?php if ( $options[ 'dp' ] == '1' ) { echo " selected='selected'"; } ?>><?php _e ( '1' ); ?></option>
<option value="2"<?php if ( $options[ 'dp' ] == '2' ) { echo " selected='selected'"; } ?>><?php _e ( '2' ); ?></option>
<option value="match"<?php if ( $options[ 'dp' ] == 'match' ) { echo " selected='selected'"; } ?>><?php _e ( 'Match' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( "The number of decimal points that the result should be to.  '1' will cause a final 0 to be added and 'Match' will get the result to match the number given." ); ?></span></td>
</tr>



<tr>
<th scope="row"><?php _e( 'Exchange Rates Cache' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="acc_rates_cache" value="<?php echo $options[ 'rates_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( "The length of time, in minutes, to cache the exchange rates. Enter 'No' to switch caching off." ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Currency Codes Cache' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="acc_codes_cache" value="<?php echo $options[ 'codes_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( "The length of time, in hours, to cache the currency codes. Enter 'No' to switch caching off." ); ?></span></td>
</tr>

</table>

<?php wp_nonce_field( 'acc-options', 'artiss_currency_converter_options_nonce', true, true ); ?>

<br/><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Settings' ); ?>"/>

</form>

</div>
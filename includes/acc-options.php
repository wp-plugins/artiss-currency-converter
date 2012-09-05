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
<h2><?php _e( 'Artiss Currency Converter Options', 'currency-converter' ); ?></h2>
<?php

// If options have been updated on screen, update the database

$fetch_options = true;
if ( ( !empty( $_POST ) ) && ( check_admin_referer( 'acc-options' , 'artiss_currency_converter_options_nonce' ) ) ) {

    // Check validity of App ID

    $error = __( 'The App ID is invalid.', 'currency-converter' );
    if ( strlen( $_POST[ 'acc_app_id' ] ) != 32 ) {
        $fetch_options = false;
    } else {
        $file = acc_get_file( 'http://openexchangerates.org/latest.json?app_id=' . $_POST[ 'acc_app_id' ] );
        if ( $file[ 'rc' ] != 0 ) {
            $error = __( 'Could not validate App ID. Please try again later.', 'currency-converter' );
            $fetch_options = false;
        } else {
            if ( strpos( $file[ 'file' ], 'invalid_app_id' ) !== false ) { $fetch_options = false; }
        }
    }

    // Update the options array from the form fields.

    if ( $fetch_options ) { $options[ 'id' ] = $_POST[ 'acc_app_id' ]; }

    $options[ 'from' ] = $_POST[ 'acc_from' ];
    $options[ 'to' ] = $_POST[ 'acc_to' ];
    $options[ 'dp' ] = $_POST[ 'acc_dp' ];
    $options[ 'donated' ] = $_POST[ 'acc_donated' ];

    // Check caches and ensure they are valid

    $options[ 'rates_cache' ] = acc_check_cache( $_POST[ 'acc_rates_cache' ], 60 );
    $options[ 'codes_cache' ] = acc_check_cache( $_POST[ 'acc_codes_cache' ], 1 );

    // Update the options

    update_option( 'artiss_currency_converter', $options );

    if ( $fetch_options ) {

        echo '<div class="updated fade"><p><strong>' . __( 'Settings Saved.', 'currency-converter' ) . "</strong></p></div>\n";

    } else {

        echo '<div class="error fade"><p><strong>' . $error . "</strong></p></div>\n";
    }
}

// Fetch options and rates into an array

$options = acc_get_options();
if ( $fetch_options) { $options[ 'key' ] = $_POST[ 'acc_app_id' ]; }
$rates_array = acc_get_rates( $options[ 'rates_cache' ] );
$codes_array = acc_get_codes( $options[ 'codes_cache' ] );
?>

<form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/admin.php?page=acc-options' ?>">

<table class="form-table">

<tr>
<th scope="row"><?php _e( 'App ID' ); ?></th>
<td><input type="text" size="32" maxlength="32" name="acc_app_id" value="<?php echo $options[ 'id' ]; ?>"/>&nbsp;<span class="description"><?php _e( "Your App ID. <a href=\"https://openexchangerates.org/signup\">Sign up here</a> if you don't have one.", 'currency-converter' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Remove Adverts', 'currency-converter' ); ?></th>
<td><input type="checkbox" name="acc_donated" value="1"<?php if ( $options[ 'donated' ] == "1" ) { echo ' checked="checked"'; } ?>/>&nbsp;<span class="description"><?php _e( "If you've <a href=\"http://www.artiss.co.uk/donate\">donated</a>, tick here to remove the adverts.", 'currency-converter' ); ?></span></td>
</tr>

</table>

<?php
// Display ads

if ( $options[ 'donated'] != 1 ) { artiss_plugin_ads( 'currency-converter' ); } else { echo '<br/>'; }
?>

<p><?php _e( 'Specify the default options that will be used if any specific parameters are not supplied.', 'currency-converter' ); ?></p>

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
</select>&nbsp;<span class="description"><?php _e( 'The currency to convert from', 'currency-converter' ); ?></span></td>
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
</select>&nbsp;<span class="description"><?php _e( 'The currency to convert to', 'currency-converter' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Decimal Places', 'currency-converter' ); ?></th>
<td><select name="acc_dp">
<option value="0"<?php if ( $options[ 'dp' ] == '0' ) { echo " selected='selected'"; } ?>>0</option>
<option value="1"<?php if ( $options[ 'dp' ] == '1' ) { echo " selected='selected'"; } ?>>1</option>
<option value="2"<?php if ( $options[ 'dp' ] == '2' ) { echo " selected='selected'"; } ?>>2</option>
<option value="match"<?php if ( $options[ 'dp' ] == 'match' ) { echo " selected='selected'"; } ?>><?php _e ( 'Match' ); ?></option>
</select>&nbsp;<span class="description"><?php _e( "The number of decimal points that the result should be to.<br/>'1' will cause a final 0 to be added and 'Match' will get the result to match the number given.", 'currency-converter' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Exchange Rates Cache', 'currency-converter' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="acc_rates_cache" value="<?php echo $options[ 'rates_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( "The length of time, in minutes, to cache the exchange rates. Minimum is 60.", 'currency-converter' ); ?></span></td>
</tr>

<tr>
<th scope="row"><?php _e( 'Currency Codes Cache', 'currency-converter' ); ?></th>
<td><input type="text" size="3" maxlength="3" name="acc_codes_cache" value="<?php echo $options[ 'codes_cache' ]; ?>"/>&nbsp;<span class="description"><?php _e( "The length of time, in hours, to cache the currency codes. Minimum is 1.", 'currency-converter' ); ?></span></td>
</tr>

</table>

<?php wp_nonce_field( 'acc-options', 'artiss_currency_converter_options_nonce', true, true ); ?>

<br/><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Settings', 'currency-converter' ); ?>"/>

</form>

</div>
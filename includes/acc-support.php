<?php
/**
* Support Page
*
* Support for the plugin
*
* @package	Artiss-Currency-Converter
* @since	1.0
*/
?>
<div class="wrap">
<div class="icon32"><img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/screen_icon.png" alt="" title="" height="32px" width="32px"/><br /></div>

<h2><?php _e( 'Artiss Currency Converter Support', 'currency-converter' ); ?></h2>

<?php
$options = acc_get_options();
if ( $options[ 'donated'] != 1 ) { artiss_plugin_ads(); }
?>

<p><?php echo sprintf( __( 'You are using Artiss Currency Converter version %s. It was written by David Artiss.', 'currency-converter' ), artiss_currency_converter_version ); ?></p>

<img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/CurrencyBot.png" alt="Currency Bot" title="Currency Bot" align="right"/>

<?php

// Exchange Rates Support Information

echo '<h3>' . __( 'Exchange Rates Support Information', 'currency-converter' ) . "</h3>\n";
echo '<p>' . sprintf ( __( 'Exchange rates, updated hourly, are provided courtesy of %s.', 'currency-converter' ), '<a href="http://josscrowcroft.github.com/open-exchange-rates/">Open Source Exchange Rates</a>', 'currency-converter' ) . "</a></p>\n";
echo '<p><a href="http://josscrowcroft.github.com/open-exchange-rates/">' . __( 'Open Source Exchange Rates API documentation', 'currency-converter' ) . "</a></p>\n";
echo '<p><a href="https://twitter.com/#!/josscrowcroft">' . __( 'Follow the author, Joss Crowcroft, on Twitter', 'currency-converter' ) . "</a></p>\n";
echo '<p><a href="https://github.com/currencybot/open-exchange-rates">' . __( 'Visit the GitHub repository', 'currency-converter' ) . "</a></p>\n";
echo '<h4>' . __( 'The exchange rate data is supplied for free. If you feel it\'s worthwhile to you, please help keep it alive by making a <a title="Flattr" href="http://flattr.com/thing/622410/Open-Exchange-Rates-API" target="_blank">micropayment donation</a>.', 'currency-converter' ) . "</h4>\n";

// Plugin Support information

echo '<h3>' . __( 'Plugin Support Information', 'currency-converter' ) . "</h3>\n";
echo '<p><a href="http://www.artiss.co.uk/currency-converter">' . __( 'Artiss Currency Converter plugin documentation', 'currency-converter' ) . "</a></p>\n";
echo '<p><a href="http://www.artiss.co.uk/forum/specific-plugins-group2/artiss-currency-converter-forum19">' . __( 'Artiss Currency Converter support forum', 'currency-converter' ) . "</a></p>\n";
echo '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.', 'currency-converter' ) . "</h4>\n";

// Acknowledgements

echo '<h3>' . __( 'Acknowledgements', 'currency-converter' ) . "</h3>\n";
echo '<p>' . sprintf( __( 'Images have been compressed with %s.' ), '<a href="http://www.smushit.com/ysmush.it/">Smush.it</a>', 'currency-converter' ) . "</p>\n";
echo '<p>' . sprintf( __( 'The %s is kindly provided by %s.', 'currency-converter' ), '<a href="http://josscrowcroft.github.com/open-exchange-rates/">Open Source Exchange Rates API</a>', '<a href="http://www.josscrowcroft.com/">Joss Crowcroft</a>' ) . "</p>\n";
echo '<p>' . sprintf( __( 'Icons are provided courtesy of %s.', 'currency-converter' ), '<a href="http://www.everaldo.com/crystal/">Crystal Project</a>' ) . "</p>\n";
echo '<p>' . sprintf( __( 'Currency Bot image is from %s.', 'currency-converter' ), '<a href="http://robohash.org/">RoboHash</a>' ) . "</p>\n";

// Stay in touch

echo '<h3>' . __( 'Stay in Touch', 'currency-converter' ) . "</h3>\n";
echo '<p>' . __( '<a href="http://www.artiss.co.uk/wp-plugins">See the full list</a> of Artiss plugins, including beta releases.', 'currency-converter' ) . "</p>\n";
echo '<p>' . __( '<a href="http://www.twitter.com/artiss_tech">Follow Artiss.co.uk</a> on Twitter.', 'currency-converter' ) . "</p>\n";
echo '<p>' . __( '<a href="http://www.artiss.co.uk/feed">Subscribe</a> to the Artiss.co.uk news feed.', 'currency-converter' ) . "</p>\n";
?>
</div>
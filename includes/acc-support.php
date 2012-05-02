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

<h2><?php _e( 'Artiss Currency Converter Support'); ?></h2>

<p><?php echo sprintf( __( 'You are using Artiss Currency Converter version %s. It was written by David Artiss.' ), artiss_currency_converter_version ); ?></p>

<img src="<?php echo plugins_url(); ?>/artiss-currency-converter/images/CurrencyBot.png" alt="Currency Bot" title="Currency Bot" align="right"/>

<?php

// Exchange Rates Support Information

echo '<h3>' . __( 'Exchange Rates Support Information' ) . "</h3>\n";
echo '<p>' . sprintf ( __( 'Exchange rates, updated hourly, are provided courtesy of %s.' ), '<a href="http://josscrowcroft.github.com/open-exchange-rates/">Open Source Exchange Rates</a>' ) . "</a></p>\n";
echo '<p><a href="http://josscrowcroft.github.com/open-exchange-rates/">' . __( 'Open Source Exchange Rates API documentation' ) . "</a></p>\n";
echo '<p><a href="https://twitter.com/#!/josscrowcroft">' . __( 'Follow the author, Joss Crowcroft, on Twitter' ) . "</a></p>\n";
echo '<p><a href="https://github.com/currencybot/open-exchange-rates">' . __( 'Visit the GitHub repository' ) . "</a></p>\n";
echo '<h4>' . __( 'The exchange rate data is supplied for free. If you feel it\'s worthwhile to you, please help keep it alive by making a <a title="Flattr" href="http://flattr.com/thing/622410/Open-Exchange-Rates-API" target="_blank">micropayment donation</a>.' ) . "</h4>\n";

// Plugin Support information

echo '<h3>' . __( 'Plugin Support Information' ) . "</h3>\n";
echo '<p><a href="http://www.artiss.co.uk/currency-converter">' . __( 'Artiss Currency Converter plugin documentation' ) . "</a></p>\n";
echo '<p><a href="http://www.artiss.co.uk/forum/specific-plugins-group2/artiss-currency-converter-forum19">' . __( 'Artiss Currency Converter support forum' ) . "</a></p>\n";
echo '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.' ) . "</h4>\n";

// Acknowledgements

echo '<h3>' . __( 'Acknowledgements' ) . "</h3>\n";
echo '<p>' . sprintf( __( 'Images have been compressed with %s.' ), '<a href="http://www.smushit.com/ysmush.it/">Smush.it</a>' ) . "</p>\n";
echo '<p>' . sprintf( __( 'The %s is kindly provided by %s.' ), '<a href="http://josscrowcroft.github.com/open-exchange-rates/">Open Source Exchange Rates API</a>', '<a href="http://www.josscrowcroft.com/">Joss Crowcroft</a>' ) . "</p>\n";
echo '<p>' . sprintf( __( 'Icons are provided courtesy of %s.' ), '<a href="http://www.everaldo.com/crystal/">Crystal Project</a>' ) . "</p>\n";
echo '<p>' . sprintf( __( 'Currency Bot image is from %s.' ), '<a href="http://robohash.org/">RoboHash</a>' ) . "</p>\n";

// Stay in touch

echo '<h3>' . __( 'Stay in Touch' ) . "</h3>\n";
echo '<p>' . __( '<a href="http://www.artiss.co.uk/wp-plugins">See the full list</a> of Artiss plugins, including beta releases.' ) . "</p>\n";
echo '<p>' . __( '<a href="http://www.twitter.com/artiss_tech">Follow Artiss.co.uk</a> on Twitter.' ) . "</p>\n";
echo '<p>' . __( '<a href="http://www.artiss.co.uk/feed">Subscribe</a> to the Artiss.co.uk news feed.' ) . "</p>\n";

?>
</div>
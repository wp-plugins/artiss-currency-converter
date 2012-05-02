<?php
/**
* README Page
*
* Display the README instructions
*
* @package	Artiss-Currency-Converter
* @since	1.0
*/
?>
<div class="wrap">
<div class="icon32" id="icon-edit-pages"></div>

<?php $plugin = 'Artiss Currency Converter'; ?>

<h2><?php _e( $plugin . ' README' ); ?></h2>

<?php
if ( !function_exists( 'wp_readme_parser' ) ) {
    echo '<p>You shouldn\'t be able to see this but I guess that odd things can happen!<p>';
    echo '<p>To display the README you must install the <a href="http://wordpress.org/extend/plugins/wp-readme-parser/">README Parser plugin</a>.</p>';
} else {
    echo wp_readme_parser( array( 'exclude' => 'meta,upgrade notice,screenshots,support,changelog,links,installation,licence', 'ignore' => 'For help with this plugin,,for more information and advanced options ' ), 'http://plugins.svn.wordpress.org/artiss-currency-converter/tags/' . artiss_currency_converter_version . '/readme.txt' );
}
?>
</div>
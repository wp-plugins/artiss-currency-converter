<?php
/**
* Admin Menu Functions
*
* Various functions relating to the various administration screens
*
* @package	Artiss-Currency-Converter
*/

/**
* Show Admin Messages
*
* Display messages on the administration screen
*
* @since	1.2
*
*/

function acc_show_admin_messages() {

    $options = get_option( 'artiss_currency_converter' );

    if ( ( $options[ 'id' ] == '' ) && ( current_user_can( 'install_plugins' ) ) ) {
        echo '<div id="message" class="error"><p>' . __( '<a href="admin.php?page=acc-options">An App ID must be specified</a> before Currency Converter will work.', 'currency-converter' ) . '</p></div>';
    }
}

add_action( 'admin_notices', 'acc_show_admin_messages' );

/**
* Add Settings link to plugin list
*
* Add a Settings link to the options listed against this plugin
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function acc_add_settings_link( $links, $file ) {

	static $this_plugin;

	if ( !$this_plugin ) { $this_plugin = plugin_basename( __FILE__ ); }

	if ( strpos( $file, 'code-embed.php' ) !== false ) {
		$settings_link = '<a href="admin.php?page=acc-options">' . __( 'Settings', 'currency-converter' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}
add_filter( 'plugin_action_links', 'acc_add_settings_link', 10, 2 );

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	1.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function acc_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, '[plugin file name].php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="[support url]">' . __( 'Support', 'currency-converter' ) . '</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate', 'currency-converter' ) . '</a>' ) );
	}

	return $links;
}
add_filter( 'plugin_row_meta', 'acc_set_plugin_meta', 10, 2 );

/**
* Administration Menu
*
* Add a new option to the Admin menu and context menu
*
* @since	1.0
*
* @uses acc_help		Return help text
*/

function acc_menu() {

    // Depending on WordPress version and available functions decide which (if any) contextual help system to use

    $contextual_help = acc_contextual_help_type();
    
    // Depending on access, decide which screen the top level will link to
    
    if ( current_user_can( 'install_plugins' ) ) {
        $top_menu = 'options';
    } else {
        $top_menu = 'rates';
    }

    // Add main admin option

	add_menu_page( __( 'Artiss Currency Converter Settings', 'currency-converter' ), __( 'Currency', 'currency-converter' ), 'edit_posts', 'acc-' . $top_menu, 'acc_'. $top_menu, plugins_url() . '/artiss-currency-converter/images/menu_icon.png' );

    // Add options sub-menu

    if ( $contextual_help == 'new' ) { global $acc_options_hook; }

	$acc_options_hook = add_submenu_page( 'acc-' . $top_menu, __( 'Artiss Currency Converter Options', 'currency-converter' ), __( 'Options', 'currency-converter' ), 'install_plugins', 'acc-options', 'acc_options' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $acc_options_hook, 'acc_add_options_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $acc_options_hook, acc_options_help() ); }

    // Add rates sub-menu

    if ( $contextual_help == 'new' ) { global $acc_rates_hook; }

    $acc_rates_hook = add_submenu_page( 'acc-' . $top_menu, __( 'Artiss Currency Converter Rates', 'currency-converter' ), __( 'Rates', 'currency-converter' ), 'edit_posts', 'acc-rates', 'acc_rates' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $acc_rates_hook, 'acc_add_rates_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $acc_rates_hook, acc_rates_help() ); }

    // Add readme sub-menu

    if ( function_exists( 'wp_readme_parser' ) ) {
        add_submenu_page( 'acc-' . $top_menu, __( 'Artiss Currency Converter README', 'currency-converter' ), __( 'README', 'currency-converter' ), 'edit_posts', 'acc-readme', 'acc_readme' );
    }

    // Add support sub-menu

    add_submenu_page( 'acc-' . $top_menu, __( 'Artiss Currency Converter Support', 'currency-converter' ), __( 'Support', 'currency-converter' ), 'edit_posts', 'acc-support', 'acc_support' );

}
add_action( 'admin_menu','acc_menu' );

/**
* Get contextual help type
*
* Return whether this WP installation requires the new or old contextual help type, or none at all
*
* @since	1.0
*
* @return   string			Contextual help type - 'new', 'old' or false
*/

function acc_contextual_help_type() {

    global $wp_version;

    $type = false;

    if ( ( float ) $wp_version >= 3.3 ) {
        $type = 'new';
    } else {
        if ( function_exists( 'add_contextual_help' ) ) {
            $type = 'old';
        }
    }

    return $type;
}

/**
* Add Options Help
*
* Add help tab to options screen
*
* @since	1.0
*
* @uses     acc_options_help    Return help text
*/

function acc_add_options_help() {

    global $acc_options_hook;
    $screen = get_current_screen();

    if ( $screen->id != $acc_options_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'acc-options-help-tab', 'title'	=> __( 'Help', 'currency-converter' ), 'content' => acc_options_help() ) );
}

/**
* Add Rates Help
*
* Add help tab to exchange rates screen
*
* @since	1.0
*
* @uses     acc_search_help    Return help text
*/

function acc_add_rates_help() {

    global $acc_rates_hook;
    $screen = get_current_screen();

    if ( $screen->id != $acc_rates_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'acc-rates-help-tab', 'title' => __( 'Help', 'currency-converter' ), 'content' => acc_rates_help() ) );
}

/**
* Options screen
*
* Define an option screen
*
* @since	1.0
*/

function acc_options() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'acc-options.php' );

}

/**
* Rates screen
*
* Define the exchange rates screen
*
* @since	1.0
*/

function acc_rates() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'acc-rates.php' );

}

/**
* README screen
*
* Define the README screen
*
* @since	1.0
*/

function acc_readme() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'acc-readme.php' );

}

/**
* Support screen
*
* Define the support screen
*
* @since	1.0
*/

function acc_support() {

	include_once( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) . 'acc-support.php' );

}

/**
* Options Help
*
* Return help text for options screen
*
* @since	1.0
*
* @return	string	Help Text
*/

function acc_options_help() {

	$help_text = '<p>' . __( "This screen allows you to set some default options - if, when using the shortcode or function call, you don't specify a particular parameter then the default from this screen will be used.", 'currency-converter' ) . '</p>';
	$help_text .= '<p>' . __( 'You can also set caching times as well - this is to limit the regularity of updates to the exchange rates and currency codes. The former is updated hourly and the latter ad-hoc, so retrieving this information everytime is not required.', 'currency-converter' ) . '</p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.', 'currency-converter' ) . '</h4>';

	return $help_text;
}

/**
* Rates Help
*
* Return help text for exchange rates screen
*
* @since	1.0
*
* @return	string	Help Text
*/

function acc_rates_help() {

	$help_text = '<p>' . __( 'Use this screen to view the current exchange rates along with all the currency codes. All exchange rates are in relation to the US Dollar.', 'currency-converter' ) . '</p>';
	$help_text .= '<p>' . __( 'You can also perform a currency conversion from this screen.', 'currency-converter' ) . '</p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.', 'currency-converter' ) . '</h4>';

	return $help_text;
}

/**
* Detect plugin activation
*
* Upon detection of activation set an option
*
* @since	1.0
*/

function acc_plugin_activate() {

	update_option( 'artiss_currency_converter_activated', true );

}
register_activation_hook( WP_PLUGIN_DIR . "/artiss-currency-converter/artiss-currency-converter.php", 'acc_plugin_activate' );

// If plugin activated, run activation commands and delete option

global $wp_version;

if ( get_option( 'artiss_currency_converter_activated' ) ) {

    if ( ( float ) $wp_version >= 3.3 ) {

        add_action( 'admin_enqueue_scripts', 'acc_admin_enqueue_scripts' );

    }

    delete_option( 'artiss_currency_converter_activated' );
}

/**
* Enqueue Feature Pointer files
*
* Add the required feature pointer files
*
* @since	1.0
*/

function acc_admin_enqueue_scripts() {

    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );

    add_action( 'admin_print_footer_scripts', 'acc_admin_print_footer_scripts' );
}

/**
* Show Feature Pointer
*
* Display feature pointer
*
* @since	1.0
*/

function acc_admin_print_footer_scripts() {

    $pointer_content = '<h3>' . __( 'Welcome to Artiss Currency Converter', 'currency-converter' ) . '</h3>';
    $pointer_content .= '<p style="font-style:italic;">' . __( 'Thank you for installing this plugin.', 'currency-converter' ) . '</p>';
    $pointer_content .= '<p>' . __( 'A new menu has been added to the sidebar. This will allow you to change the default settings and see the current exchange rate information. Currency conversion cannot be performed until you have supplied an App Key in the Options screen.', 'currency-converter' );
?>
<script>
jQuery(function () {
	var body = jQuery(document.body),
	menu = jQuery('#toplevel_page_acc-options'),
	collapse = jQuery('#collapse-menu'),
	pluginmenu = menu.find("a[href='admin.php?page=acc-options']"),
	options = {
		content: '<?php echo $pointer_content; ?>',
		position: {
			edge: 'left',
			align: 'center',
			of: menu.is('.wp-menu-open') && !menu.is('.folded *') ? pluginmenu : menu
		},
		close: function() {
		}};

	if ( !pluginmenu.length )
		return;

	body.pointer(options).pointer('open');
});
</script>
<?php
}
?>
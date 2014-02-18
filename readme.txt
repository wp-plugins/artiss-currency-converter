=== Artiss Currency Converter ===
Contributors: DarkDesigns
Tags: artiss, cash, conversion, convert, currency, dollar, euro, franc, money, pound, rupee, shortcode, sterling, template, yen
Requires at least: 2.5
Tested up to: 3.4.1
Stable tag: 1.2

This plugin will convert currencies within the text of a post or page.

== Description ==

**If you are upgrading from a version previous to 1.1 then you will need to sign up an App ID before currency conversions will work again - please see "Other Notes" for further information**

If you have a wish to convert currencies "on the fly" within the text of a post or page then this plugin will offer this functionality!

For example, I run a UK based site and will refer to currencies in GBP. However, the majority of visitors are from the US, so I may have a wish to also show the dollar equivalent. Using this plugin I can do this without having to work out the conversion and then re-visit it in future to take into account conversion changes.

Features include...

* No need to update exchange rates yourself - data is fetched from an Open Source API
* 159 currencies supported
* An easy to use shortcode for embedding directly into your posts and pages
* A PHP function for those people who wish to add features in their theme
* Results can be cached, reducing resources and improving response
* Template to allow you to control how results are output
* Administration screen allowing you to define defaults and to view current exchange rates
* Fully internationalized ready for translations. **If you would like to add a translation to this plugin then please [contact me](http://artiss.co.uk/contact "Contact")**

To add to your site simply use the `[convert]` shortcode. For example...

`[convert number=49.99 from="gbp" to="usd"]`

This would convert 49.99 GBP to USD.

The above should get you started - for more information and advanced options please read the "Other Notes" tab.

**Disclaimer**

The exchange rate data is provided for free via the [Open Source Exchange Rates](http://openexchangerates.org/ "Open Source Exchange Rates") project. Its accuracy and availability are never guaranteed, and there's no warranty provided.

**For help with this plugin, or simply to comment or get in touch, please read the appropriate section in "Other Notes" for details. This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== The Options Screen ==

Once the plugin is activated a new option will appear, named Currency Converter, on the left sidebar menu in the Administration screen. Under this are a number of sub-options...

* **Options** - Allows you to specify default settings for any currency conversion
* **Rates** - Displays the current exchange rates along with a list of all the valid exchange codes
* **README** - If you have the README Parser plugin active this option will appear and will allow you to browse these instructions
* **Support** - Copyright, acknowledgements and support information

Before using this plugin it is highly recommended that you review the Options screen and change any values, as appropriate. You will also need to sign up for and enter an App Key before conversions will work - see the next section.

== Getting an App Key ==

Open Exchange Rates now requires an App Key to be specified. This is to prevent over-use of the exchange system and to provide premium features.

A free plan is available and this plugin should not cause your usage to be exceeded. Premium plans are also available - as features are added to these they will be added to this plugin. For the time being, however, having a premium plan does not add any extra features to this plugin.

To get your App Key [sign up on the Open Exchange Rates site](https://openexchangerates.org/signup "Sign Up - Open Exchange Rates") for the plan that best suits your need. Now head to the Currency  Converter options screen and enter the App Key into the appropriate field. Save the results.

== Using the Shortcode ==

The shortcode of '[convert]' has the following parameters that you may specify...

* **number** - The number that you wish to convert from one currency to another. This is required
* **from** - The currency code that you wish to convert from (see the admin options for a list of valid codes). If you do not specify this value then the default from the options screen will be used
* **to** - The currency code that you wish to convert to (see the admin options for a list of valid codes). If you do not specify this value then the default from the options screen will be used.
* **dp** - How many decimal places the output should be. This should be numeric or the word "match". The latter is the default and will mean that the output will match the number of decimal places that the **number** was.
* **template** - See the later section, "Using Templates", for further information

Example of use are...

`[convert number=49.99 from="gbp" to="usd"]`

This would convert 49.99 from UK pounds to US dollars and output the result to 2 decimal places.

`[convert number=50 from="usd" to="gbp"]`

This would convert 50 from US dollars to UK pounds and output the result without any decimal places.

If the conversion can't be done then an appropriate error message will be output instead. If you wish to suppress these messages then you need to use a template (see the later section on this) - in this case no output will be generated in the case of an error.

== Using Templates ==

The template option allows you to specify other information to be output along with the conversion result. None of the template will be output if any error occurs, including any error messages, allowing you to suppress any conversion text in the case of a problem.

The template text must include `%result%` where you wish the output to appear.

Here's an example...

`The retail price is �49.99[convert number=50 from="gbp" to="usd" template=" (approx. $%result%)"].`

Normally, this would print a result such as...

`The retail price is �49.99 (approx. $79.11).`

However, if an error occurs then it will print as...

`The retail price is �49.99.`

You may also include the template between opening and closing shortcode tags. For example...

`The retail price is �49.99[convert number=50 from="gbp" to="usd"] (approx. $%result%)[/convert].`

== Using the Function Call ==

If you wish to perform a currency conversion within your theme, rather than within a post or page, then you can use a PHP function call. The function name is `get_conversion` and will return the result back.

* All of the shortcode parameters are valid, except for the template which isn't required
* The parameters are specified in any order and are separated with an ampersand
* You should not add quotes around each parameter value, as you do with the shortcode

For example...

`<?php echo get_conversion( 'number=49.99&from=gbp&to=usd' ); ?>`

== Global conversion variables ==

For the use of developers, 2 global variables have been added which, if assigned within your site code, will override the conversion codes.

The variables are `global_convert_from` and `global_convert_to`.

This is useful if, say, you have multiple versions of the site in different languages - you can then assign these global variables depending on which site is being viewed and all currency will be converted based upon these settings.

These will only override the options screen and not specific parameters specified with a shortcode or function call.

== Licence ==

This WordPress plugin is licensed under the [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License").

The [Open Source Exchange Rates API](http://josscrowcroft.github.com/open-exchange-rates/ "Open Source Exchange Rates API") is kindly provided by [Joss Crowcroft](http://www.josscrowcroft.com/ "Joss Crowcroft ").

== Support ==

All of my plugins are supported via [my website](http://www.artiss.co.uk "Artiss.co.uk").

Please feel free to visit the site for plugin updates and development news - either visit the site regularly or [follow me on Twitter](http://www.twitter.com/artiss_tech "Artiss.co.uk on Twitter") (@artiss_tech).

For problems, suggestions or enhancements for this plugin, there is [a dedicated page]([[http://www.artiss.co.uk/currency-converter "Artiss Currency Converter"]]) and [a forum](http://www.artiss.co.uk/forum "WordPress Plugins Forum"). The dedicated page will also list any known issues and planned enhancements.

**This plugin, and all support, is supplied for free, but [donations](http://artiss.co.uk/donate "Donate") are always welcome.**

== Installation ==

1. Upload the entire `artiss-currency-converter` folder to your wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Visit the new administration options screen and set your defaults.
4. Now you can add the shortcode to your posts and pages!

== Frequently Asked Questions ==

= Which version of PHP does this plugin work with? =

PHP 5.2 is the minimum current requirement for WordPress. This plugin requires at least PHP version 5.2.1 due to having to decode JSON responses from the Open Source Exchange Rates API.

== Screenshots ==

1. The new menu added to the administration screen
2. The options screen
3. The exchange rate screen

== Changelog ==

= 1.2 =
* Maintenance: Updated advertising engine code to latest version
* Maintenance: Updated README Parser function name
* Bug: Corrected the user permissions
* Enhancement: Added message to admin screen if App Key not set

= 1.1.1 =
* Bug: Error on activation when installed alongside certain other plugins which share a particular function

= 1.1 =
* Maintenance: Advertisements now appear in the options screens, but implemented option to switch off if donated
* Maintenance: New App Key requirements implemented
* Maintenance: Put in place minimum values for caching - no longer able to switch off
* Bug: Fixed internationalisation, including rates screens which was not being translated
* Enhancement: Country flag icons, where appropriate, are now shown on the rates screen
* Enhancement: Added global variables for overriding default currencies
* Enhancement: Conversion in rates screen now shows results as 2 DP

= 1.0.1 =
* Fixed bug where currency output that contained a thousand seperator was being interpreted as an error message!

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.2 =
* Update for minor enhancements and bug fixes

= 1.1.1 =
* Bug fix to prevent error when installed with certain other plugins

= 1.1 =
* Critical update to add App ID, otherwise currency conversions will not work

= 1.0.1 =
* Update to fix a bug where output was incorrect if conversion result was over a thousand

= 1.0 =
* Initial release
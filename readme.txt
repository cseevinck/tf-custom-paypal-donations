=== Plugin Name ===

Contributors:      Corky Seevinck
Plugin Name:       TF Custom Paypal Donations
Tags:              paypal, recurring donations, custom donations, donations
Author URI:        http://www.chs-webs.com
Author:            Corky Seevinck
Donate link:       
Requires at least: 3.0
Tested up to:      5.6
Stable tag:        1.2.6
Version:           1.2.6
License: 		       GPLv2 or later
License URI: 	     https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

This plugin allows sites to accept user-entered custom donation amounts through Paypal, including recurring donations.  This plugin was created in response to Paypal changing the functionality of their donate buttons in October 2016 and allows users access to features which Paypal made harder to customize/access.  This plugin features customizable options and text fields.

The front end view of the plugin is very basic.  I hope to add some more view options in the future.  For the time being, many users will want to style the plugin output using their own CSS.
Orginal plugin by Peter VanKoughnett - to many changes to keep giving him credit 
as author.

== Installation ==

1. Install the plugin
1. Customize the plugin settings
1. Use the shortcode [tf-custom-paypal-donations] where you want the plugin to output

== Upgrade Notice ==
=1.2.5=
 *  Change the donations approach - use only one form 
 *  This form will collect the donor's name and email and the giving 
 *  instructions. After submission of the form, "process_form_data" in 
 *  cusdon-donations.php will get control. There a Paypal request form will
 *  and that form will be auto submitted. The admin will need to reconcile
 *  the email details with the paypal transactions. There is a chance that
 *  user will not complete the paypal transaction which will result in an 
 *  orphan email which could be used to reach out to the user to offer help.
 *
=1.2.5=
* Changed text field to textarea - change style in table
=1.2.4=
* fixed admin bug where organization name field does not display, tested with 4.7.2
=1.2.1=
* security and compatibility improvements
=1.1=
*Fixed bug where content outputs out of place
=1.0=
* First Version


== Screenshots ==
1. Screenshot of front end of plugin output
2. Screenshot of plugin admin interface

== Changelog ==

=1.2.1=
* fixed function namespacing issue
=1.2=
* Not allowing direct file access, changed prefix from cd_ to cusdon_, replaced hardcoded paths with wordpress constants
=1.0=
* First version!


== Frequently Asked Questions ==

=How do I customize the look of the plugin?=

I haven't built any tools to customize the look of the plugin yet.  You can disable the plugin CSS and write your own CSS.
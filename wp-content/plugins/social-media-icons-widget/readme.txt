=== Social Icons Widget ===
Contributors: dannisbet, nisbetcreative
Tags: social, media, widget, follow, profile, icons, 500px, About.me, Behance, Dribbble, Codepen, Email, Envato, Facebook, Flickr, FourSquare, GitHub, Google+, Instagram, Kickstarter, Klout, LinkedIn, Medium, Path, Pinterest, RSS, Speaker Deck, StumbleUpon, Technorati, Tumblr, Twitter, Vimeo, Vine, WordPress, Yelp, YouTube, Zerply
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CJN7XU3Z7XHDL
Requires at least: 3.5.1
Tested up to: 4.5
Stable tag: 16.07
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Displays a list of social media website icons and a link to your profile.

== Description ==

The Social Media Icons widget takes a simple, extendable approach to displaying links to your social media profiles in WordPress. The purpose of this plugin was to strip away the complexities I found most other plugins to have and simply display a set of basic social icons in an unordered list. There's no frills and no fanciness, making it easy to style to your website's look.

= Icons =

Default icons are from the [Simple Icons](http://simpleicons.org/) set created by Dan Leech.

Envelope designed by [Cy Me](http://www.thenounproject.com/Litrynn) from the [Noun Project](http://www.thenounproject.com)

== Installation ==

Download the zip file and upload to your WordPress installation. Upon activation, widget is available under Appearance > Widgets. Drag the widget into your sidebar, adjust the settings, and populate the profiles you wish to show on your website.

== Frequently Asked Questions ==

= Custom Icons =

Custom icons are easy to add. To enable them, select "Custom" from the Icon Type dropdown in the widget settings. In the directory of your active theme, create a folder titled 'social_icons'. Within that directory, add folders titled 'small', 'medium', and 'large' for each icon size you wish to use. Add your icons in .gif, .jpg, .jpeg, or .png format, following the naming format used for the default set of icons.

= Extending =

Developers can easily add more social media websites by creating a filter in the active theme's functions.php file like such:

	function add_new_icons($icon_list) {
		$icon_list['Full Website Name'] = 'full-website-id';
 
		return $icon_list;
	}
	add_filter('social_icon_accounts', 'add_new_icons');

The full-website-id should reflect the name of the image you create in each of the icon folder sizes, or in your custom icon directory. It is also used to populate the class field of the icon when the widget displays. The Social Icon Widget looks for .gif, .jpg, .jpeg, and .png in order and returns the first extention it finds.

= Altering Widget Output =

Output of each icon can be adjusted with the social_icon_output filter:

	function social_icons_html_output($format) {
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		return $format;
	}
	add_filter('social_icon_output', 'social_icons_html_output');

The opening and closing unordered list tags can be edited or changed with the social_icon_opening_tag and social_icon_closing_tag filters:

	function social_icons_change_opening($opening) {
		$opening = '<ul class="'.$ul_class.'">';
		return $opening;
	}
	add_filter('social_icon_opening_tag', 'social_icons_change_opening');

	function social_icons_change_closing($closing) {
		$closing = '</ul>';
		return $closing;
	}
	add_filter('social_icon_closing_tag', 'social_icons_change_closing');

== Screenshots ==

1. Some examples of how the plugin displays by default in its various settings available via the widget.
2. Widget settings via the Appearance > Widgets screen.

== Changelog ==

= 16.07 =
* Updated some social icons to their newer logos

= 15.10 =
* Removed all of the floats in favor of display:inline-block instead
* Style now queues above theme's style.css in most themes

= 15.10 =
* Fix error with WPML where changing languages broke the icon path

= 15.07 =
* Replaced http:// in unused input boxes with placeholder attribute instead
* Added CSS for icons in widget settings
* Updated the way icon path for custom icons is generated to stop conflicts with multilingual plugins

= 15.06 =
* Fixed Undefined index errors
* Removed Technorati profile field
* Added dailymotion and Twitch profile fields

= 14.10 =
* Added Soundcloud to default list of services
* Implemented slash fix for those running the plugin on XAMMP/Windows (Thanks VictoriousK)

= 14.08 =
* Added prefixes to PHP variables to prevent conflicts with other plugins

= 14.07 =
* Added 500px, Codepen, Envato, Kickstarter, Speaker Deck, Vine
* Removed Forrst
* Added ability to filter opening, closing tags and HTML for icon output
* Added target="_blank" for links to open in a new window by default

= 14.05 =
* Fixed broken image links when WordPress is installed under a directory

= 14.04 =
* Added new options for About.me, Email, GitHub, Medium, and WordPress profile links
* Updated all icons to Simple Icons set

= 14.03 =
* Removed @getimagesize function for compatibility purposes
* New accounts are now added via WordPress filter rather than editing core plugin code

= 13.05 =
* Fixed image and CSS paths

= 13.04 =
* Initial commit

= trunk =
* Initial commit

== Upgrade Notice ==

= 15.10 =
* Removed all of the floats in favor of display:inline-block instead
* Style now queues above theme's style.css in most themes

= 14.03 =
Removed @getimagesize function for compatibility purposes. New accounts are now added via WordPress filter rather than editing core plugin code

= 13.05 =
Fixed image and CSS paths

= 13.04 =
Initial commit to WordPress plugin repository
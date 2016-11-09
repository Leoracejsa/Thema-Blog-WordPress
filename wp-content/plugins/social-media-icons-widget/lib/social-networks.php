<?php
/*
	Declare supported social media websites

	By default, the Social Icons Widget provides a variety of popular social media websites. Developers can easily add more social media websites by creating a filter in the active theme's functions.php file like such:

		`function add_new_icons($icon_list) {
			$icon_list['Full Website Name'] = 'full-website-id';
		 
			return $icon_list;
		}
		add_filter('social_icon_accounts', 'add_new_icons');`

	The full-website-id should reflect the name of the image you create in each of the icon folder sizes, or in your custom icon directory. It is also used to populate the class field of the icon when the widget displays. The Social Icon Widget looks for .gif, .jpg, .jpeg, and .png in order and returns the first extention it finds.
*/

	global $siw_social_accounts;
	$siw_social_accounts = array(
		'500px' => 'fivehundredpx',
		'About.me' => 'aboutme',
		'Behance' => 'behance',
		'Codepen' => 'codepen',
		'dailymotion' => 'dailymotion',
		'Dribbble' => 'dribbble',
		'Email' => 'email',
		'Envato' => 'envato',
		'Facebook' => 'facebook',
		'Flickr' => 'flickr',
		'Foursquare' => 'foursquare',
		'GitHub' => 'github',
		'Google+' => 'googleplus',
		'Instagram' => 'instagram',
		'Kickstarter' => 'kickstarter',
		'Klout' => 'klout',
		'LinkedIn' => 'linkedin',
		'Medium' => 'medium',
		'Path' => 'path',
		'Pinterest' => 'pinterest',
		'RSS Feed' => 'rss',
		'SoundCloud' => 'soundcloud',
		'Speaker Deck' => 'speakerdeck',
		'StumbleUpon' => 'stumbleupon',
		'Tumblr' => 'tumblr',
		'Twitter' => 'twitter',
		'Twitch' => 'twitch',
		'Vimeo' => 'vimeo',
		'Vine' => 'vine',
		'WordPress' => 'wordpress',
		'Yelp' => 'yelp',
		'YouTube' => 'youtube',
		'Zerply' => 'zerply'
	);

	if( has_filter('social_icon_accounts') ) {
		$siw_social_accounts = apply_filters('social_icon_accounts', $siw_social_accounts);
	}
?>
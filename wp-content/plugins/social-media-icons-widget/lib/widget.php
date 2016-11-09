<?php
global $siw_social_accounts;
extract($args);

$siw_title = empty($instance['title']) ? 'Follow Us' : apply_filters('widget_title', $instance['title']);
$siw_icons = $instance['icons'];
$siw_labels = $instance['labels'];
$siw_show_title = $instance['show_title'];

echo $before_widget;

if($siw_show_title == '') {
	echo $before_title;
	echo $siw_title;
	echo $after_title;
}

if($siw_labels == 'show') { $ul_class = 'show-labels '; }
else { $ul_class = ''; }
$ul_class .= 'icons-'.$siw_icons;
?>

<?php echo apply_filters('social_icon_opening_tag', '<ul class="'.$ul_class.'">'); ?>

<?php foreach($siw_social_accounts as $siw_title => $id) : ?>
	<?php if($instance[$id] != '' && $instance[$id] != 'http://') :
		
		global $siw_data;
		global $siw_icon_output;

		$imgsize = '';

		$siw_data['id'] = $id;
		$siw_data['url'] = $instance[$id];
		$siw_custom_sizes = array('custom_small','custom_medium','custom_large');

		if (in_array($siw_icons, $siw_custom_sizes)) {
			$size = str_replace("custom_","",$siw_icons);
			$siw_icon_path = get_stylesheet_directory() .'/social_icons/'.$size.'/'.$id.'.{gif,jpg,jpeg,png}';
		}
		else {
			$siw_abs_path = str_replace('lib/', '', plugin_dir_path( __FILE__ ));

			/*	Fix for Windows/XAMPP where the slash goes the wrong way.
				Thanks to VictoriousK */
			$siw_abs_path = str_replace('\\', '/', $siw_abs_path);
			
			$siw_icon_path =  $siw_abs_path . 'icons/'.$siw_icons.'/'.$id.'.{gif,jpg,jpeg,png}';

			if($siw_icons == 'large') { $imgsize = 'height="64" width="64"'; }
			elseif($siw_icons == 'medium') { $imgsize = 'height="32" width="32"'; }
			elseif($siw_icons == 'small') { $imgsize = 'height="16" width="16"'; }
		}
		
		$result = glob( $siw_icon_path, GLOB_BRACE );

		if($result) {
			if (in_array($siw_icons, $siw_custom_sizes)) {
				$siw_path = explode('themes', $result[0]);
				$siw_icon = site_url().'/wp-content/themes'.$siw_path[1];
			}
			else {
				$siw_path = explode('plugins', $result[0]);
				$siw_icon = plugins_url().''.$siw_path[1];
			}
		}
		elseif( $siw_labels != 'show' && $siw_icons != 'small' ) {
			$siw_icon = plugins_url().'/social-media-icons-widget/icons/'.$siw_icons.'/_unknown.jpg';
		}
		else {
			$siw_icon = '';
		}

		if ( $siw_icon ) { $siw_data['image'] = '<img class="site-icon" src="'.$siw_icon.'" alt="'.$siw_title.'" title="'.$siw_title.'" '.$imgsize.' />'; }
		else { $siw_data['image'] = ''; }
		
		if($siw_labels != 'show') { $siw_data['title'] = ''; }
		else { $siw_data['title'] = '<span class="site-label">'.$siw_title.'</span>'; }
	
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		$siw_icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($siw_icon_output, $siw_data);

	?>
		
	<?php endif; ?>
<?php endforeach; ?>

<?php echo apply_filters('social_icon_closing_tag', '</ul>'); ?>

<?php 
echo $after_widget;
?>
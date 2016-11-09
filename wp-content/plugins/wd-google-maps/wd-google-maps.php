<?php

/**
 * Plugin Name: Google Maps WD
 * Plugin URI: https://web-dorado.com/products/wordpress-google-maps-plugin.html
 * Description: Google Maps WD is an intuitive tool for creating Google maps with advanced markers, custom layers and overlays for   your website.
 * Version: 1.0.23
 * Author: WebDorado
 * Author URI: http://web-dorado.com/
 * License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
 
define('GMWD_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('GMWD_NAME', plugin_basename(dirname(__FILE__)));
define('GMWD_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('GMWD_MAIN_FILE', plugin_basename(__FILE__));

require_once( GMWD_DIR. '/framework/functions.php' );
if ( is_admin() ) {
	require_once( 'gmwd_admin_class.php' );
    register_activation_hook(__FILE__, array('GMWDAdmin', 'gmwd_activate'));
	add_action( 'plugins_loaded', array('GMWDAdmin', 'gmwd_get_instance'));

    add_action('wp_ajax_add_marker',  array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_download_markers',  array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_select_marker_icon', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_marker_size', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_polygon', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_polyline', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_circle', array('GMWDAdmin', 'gmwd_ajax'));
    add_action('wp_ajax_add_rectangle', array('GMWDAdmin', 'gmwd_ajax'));

}

require_once( 'gmwd_class.php' );

add_action( 'plugins_loaded', array('GMWD', 'gmwd_get_instance'));


add_action('wp_ajax_get_ajax_markers', array('GMWD','gmwd_frontend'));
add_action('wp_ajax_nopriv_get_ajax_markers', array('GMWD','gmwd_frontend'));
add_action('wp_ajax_get_ajax_store_loactor', array('GMWD','gmwd_frontend'));
add_action('wp_ajax_nopriv_get_ajax_store_loactor', array('GMWD','gmwd_frontend'));

function gmwd_map($shortcode_id, $map_id ){
    GMWD::gmwd_get_instance();
    $params = array();
    $params ['map'] = $map_id;
    $params ['id'] = $shortcode_id;

    $map_controller = new GMWDControllerFrontendMap($params);
    $map_controller->display();
}
require_once( GMWD_DIR. '/widgets.php' );




?>

<?php

class GMWDControllerFrontendMap extends  GMWDControllerFrontend{
	////////////////////////////////////////////////////////////////////////////////////////
	// Events                                                                             //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Constants                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Variables                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Constructor & Destructor                                                           //
	////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////
	// Public Methods                                                                     //
	////////////////////////////////////////////////////////////////////////////////////////
	public function get_ajax_markers(){
		global $wpdb;
       

        $searched_value = isset($_POST["search"]) && esc_html(stripslashes($_POST["search"])) != "" ? " AND (T_MARKER_CATEGORIES.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.description LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.address LIKE '%".esc_html(stripslashes($_POST["search"]))."%')" : "";
		$id = (int)$_POST["map_id"];
		
		$markers = $wpdb->get_results("SELECT T_MARKERS.*, T_MARKER_CATEGORIES.title AS cat_title FROM (SELECT * FROM " . $wpdb->prefix . "gmwd_markers WHERE published = '1') AS T_MARKERS LEFT JOIN  " . $wpdb->prefix . "gmwd_markercategories AS T_MARKER_CATEGORIES ON T_MARKERS.category = T_MARKER_CATEGORIES.id WHERE T_MARKERS.map_id= '".$id."' ".$searched_value."  ORDER BY id");
        $row_all_markers = array();
		foreach($markers as $marker){
            $row_all_markers[$marker->id] = $marker;			
		}
		echo json_encode($row_all_markers);
		die();	
	}
 	public function get_ajax_store_loactor(){
		global $wpdb;

		$id = (int)$_POST["map_id"];
		$radius = floatval($_POST["radius"]);
		$lat = floatval($_POST["lat"]);
		$lng = floatval($_POST["lng"]);
		$distance_in = esc_html(stripslashes($_POST["distance_in"]));

        $distance_in =  $distance_in == "km" ? 6371 : 3959;

		$markers = $wpdb->get_results("SELECT T_MARKERS.*, ( ".$distance_in." * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$lng.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) AS distance FROM (SELECT * FROM " . $wpdb->prefix . "gmwd_markers WHERE published = '1' AND map_id= '".$id."' ) AS T_MARKERS HAVING distance<".$radius." " );
        
  

		echo json_encode($markers);
		die();	
	}   
    		
	////////////////////////////////////////////////////////////////////////////////////////
	// Getters & Setters                                                                  //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Private Methods                                                                    //
	////////////////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////////////////
	// Listeners                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
}
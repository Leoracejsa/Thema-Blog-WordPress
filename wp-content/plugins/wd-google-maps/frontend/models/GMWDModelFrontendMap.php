<?php
        
class GMWDModelFrontendMap extends GMWDModelFrontend{
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
	public function get_map(){

		global $wpdb;
		$params = $this->params;
    
		$id = isset($params["map"]) ? (int)$params["map"] : 0;
		$shortcode_id = isset($params["id"]) ? $params["id"] : '';
        if(!$shortcode_id){
            echo "<h2>". __("Invalid Request","gmwd"). "</h2>";
        } 
        elseif(!$id){
            echo "<h2>". __("Please Select Map","gmwd"). "</h2>";
        }
        else{ 
            $row = parent::get_row_by_id($id, "maps");   
         
            if($row && $row->published == 1) {
                $row->height = $row->height ? $row->height : 300;
                // params for widget
                $row->width = isset($params["width"])  ? esc_html(stripslashes($params["width"])) : $row->width;
                $row->height = isset($params["height"]) ? esc_html(stripslashes($params["height"])) : $row->height;
                $row->width_percent = isset($params["width_unit"]) ? esc_html(stripslashes($params["width_unit"])) : $row->width_percent;                
                $row->zoom_level = isset($params["zoom_level"]) && $params["zoom_level"] ? esc_html(stripslashes($params["zoom_level"])) : $row->zoom_level;
                $row->type = isset($params["type"]) &&  $params["type"] ? esc_html(stripslashes($params["type"])) : $row->type;
               
                return $row;
            }
            else{
               echo "<h2>". __("Invalid Request","gmwd"). "</h2>";
            }
        }
	
	}
	
	public function get_overlays($id){
		global $wpdb;
		$params = $this->params;
		$id = (int)$params["map"];
		$overlays = new StdClass();
        $overlays->markers = array();
        $overlays->polygons = array();
        $overlays->polylines = array();
		if($id){
			
			$order_by = isset($_POST["order_by"]) ?  esc_html(stripslashes($_POST["order_by"])) : "T_MARKERS.id";
			$order_dir = isset($_POST["order_dir"]) ? esc_html(stripslashes($_POST["order_dir"])) : "";
            $categories = isset($_POST["categories"]) ? esc_html(stripslashes($_POST["categories"])) : array();
            array_walk($categories, create_function('&$value', '$value = (int)$value;'));
                       
            $radius = isset($_POST["radius"]) ? esc_html(stripslashes($_POST["radius"])) : "";
            $lat = isset($_POST["lat"]) ? esc_html(stripslashes($_POST["lat"])) : "";
            $lng = isset($_POST["lng"]) ? esc_html(stripslashes($_POST["lng"])) : "";
            $distance_in = isset($_POST["distance_in"]) ? esc_html(stripslashes($_POST["distance_in"])) : "";
            $distance_in = $distance_in == "km" ? 6371 : 3959;
            
            $filter_categories =  count( $categories ) > 0 ? " AND category IN (".implode(",", $categories ).")" : "";
			$searched_value = isset($_POST["search"]) && $_POST["search"]!= "" ? " AND (T_MARKER_CATEGORIES.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.description LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.address LIKE '%".esc_html(stripslashes($_POST["search"]))."%')" : "";
            $select_distance = "";
            $having_distance = "";
            if($distance_in && $radius && $lat && $lng){
                $select_distance = ", ( ".$distance_in." * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$lng.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) AS distance";
                $having_distance = "HAVING distance<".$radius;
            }
            
            $limit = isset($_POST["limit"]) ? esc_html(stripslashes($_POST["limit"])) : 20;      
            $limit_by = " LIMIT 0, ". (int)$limit;
      
            $markers = $wpdb->get_results("SELECT T_MARKERS.*, T_MARKER_CATEGORIES.title AS cat_title ".$select_distance." FROM (SELECT * FROM " . $wpdb->prefix . "gmwd_markers WHERE published = '1' ) AS T_MARKERS LEFT JOIN  " . $wpdb->prefix . "gmwd_markercategories AS T_MARKER_CATEGORIES ON T_MARKERS.category = T_MARKER_CATEGORIES.id WHERE T_MARKERS.map_id= '".$id."' ".$searched_value.$filter_categories. " ".$having_distance." ORDER BY ".$order_by." ".$order_dir. " ".$limit_by);	

			$row_markers = array();
			foreach($markers as $marker){
                $marker->description = '';
				$row_markers[$marker->id] = $marker;			
			}
			$overlays->markers  = $row_markers;
            
            $all_markers = $wpdb->get_results("SELECT T_MARKERS.*, T_MARKER_CATEGORIES.title AS cat_title ".$select_distance." FROM (SELECT * FROM " . $wpdb->prefix . "gmwd_markers WHERE published = '1' ) AS T_MARKERS LEFT JOIN  " . $wpdb->prefix . "gmwd_markercategories AS T_MARKER_CATEGORIES ON T_MARKERS.category = T_MARKER_CATEGORIES.id WHERE T_MARKERS.map_id= '".$id."' ".$searched_value.$filter_categories. " ".$having_distance." ORDER BY ".$order_by." ".$order_dir);	

			$row_all_markers = array();
			foreach($all_markers as $marker){
                $marker->description = '';
				$row_all_markers[$marker->id] = $marker;			
			}
			$overlays->all_markers  = $row_all_markers;            
			          
					
			$polygons = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "gmwd_polygons WHERE map_id= '".$id."' AND published = '1'  ORDER BY id ");
			$row_polygons = array();
			foreach($polygons as $polygon){
				$row_polygons[$polygon->id] = $polygon;			
			}
			$overlays->polygons = $row_polygons;
			
			$polylines = $wpdb-> get_results("SELECT * FROM " . $wpdb->prefix . "gmwd_polylines WHERE map_id= '".$id."' AND published = '1' ORDER BY id ");
			$row_polylines = array();
			foreach($polylines as $polyline){
				$row_polylines[$polyline->id] = $polyline;			
			}
			$overlays->polylines = $row_polylines;

		}
        return $overlays;
	}
    
    public function get_markers_page_nav(){
        global $wpdb;
		$params = $this->params;
		$id = (int)$params["map"];
        if($id){
            $order_by = isset($_POST["order_by"]) ? "T_MARKERS." . esc_html(stripslashes($_POST["order_by"])) : "T_MARKERS.id";
            $order_dir = isset($_POST["order_dir"]) ? esc_html(stripslashes($_POST["order_dir"])) : "";
            $categories = isset($_POST["categories"]) ?esc_html(stripslashes( $_POST["categories"])) : array();
            array_walk($categories, create_function('&$value', '$value = (int)$value;'));          
            $radius = isset($_POST["radius"]) ? esc_html(stripslashes($_POST["radius"])) : "";
            $lat = isset($_POST["lat"]) ? esc_html(stripslashes($_POST["lat"])) : "";
            $lng = isset($_POST["lng"]) ? esc_html(stripslashes($_POST["lng"])) : "";
            $distance_in = isset($_POST["distance_in"]) ? esc_html(stripslashes($_POST["distance_in"])) : "";
            $distance_in = $distance_in == "km" ? 6371 : 3959;
            
            $filter_categories =  count( $categories ) > 0 ? " AND category IN (".implode(",", $categories ).")" : "";
            
            $searched_value = isset($_POST["search"]) && $_POST["search"]!= "" ? " AND (T_MARKER_CATEGORIES.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.title LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.description LIKE '%".esc_html(stripslashes($_POST["search"]))."%' OR T_MARKERS.address LIKE '%".esc_html(stripslashes($_POST["search"]))."%')" : "";
            
            $select_distance = "";
            $having_distance = "";
            if($distance_in && $radius && $lat && $lng){
                $select_distance = ", ( ".$distance_in." * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$lng.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) AS distance";
                $having_distance = "HAVING distance<".$radius;
            }
                   
            $markers = $wpdb->get_results("SELECT T_MARKERS.*, T_MARKER_CATEGORIES.title AS cat_title ".$select_distance." FROM (SELECT * FROM " . $wpdb->prefix . "gmwd_markers WHERE published = '1' ) AS T_MARKERS LEFT JOIN  " . $wpdb->prefix . "gmwd_markercategories AS T_MARKER_CATEGORIES ON T_MARKERS.category = T_MARKER_CATEGORIES.id WHERE T_MARKERS.map_id= '".$id."' ".$searched_value.$filter_categories. " ".$having_distance." ORDER BY ".$order_by." ".$order_dir);	
            return count($markers);
        }
        return 0;
    
    }

	public function get_theme($theme_id){
		global $wpdb;
		$theme = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "gmwd_themes WHERE `default`='1'");	          
		return $theme;		
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
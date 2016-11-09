<?php
// get option function
function gmwd_get_option($option_name){
    global $wpdb;
    $query = "SELECT * FROM ". $wpdb->prefix . "gmwd_options ";
    $rows = $wpdb->get_results($query);	

    $options = new stdClass();
    foreach ($rows as $row) {
        $name = $row->name;
        $value = $row->value !== "" ? $row->value : $row->default_value;
        $options->$name = $value;
    }
    
    return $options->$option_name;
}


function upgrade_pro($text = false){
?>
    <div class="gmwd_upgrade wd-clear" >
        <div class="wd-right">
            <a href="https://web-dorado.com/products/wordpress-google-maps-plugin.html" target="_blank">
                <div class="wd-table">
                    <div class="wd-cell wd-cell-valign-middle">
                        <?php _e("Upgrade to paid version", "gmwd"); ?>
                    </div>
                     
                    <div class="wd-cell wd-cell-valign-middle">
                        <img src="<?php echo GMWD_URL; ?>/images/web-dorado.png" >
                    </div>
                </div>     
            </a>                  
        </div>
    </div>
    <?php if($text){
    ?>
        <div class="wd-text-right wd-row" style="color: #15699F; font-size: 20px; margin-top:10px; padding:0px 15px;">
            <?php echo sprintf(__("This is FREE version, Customizing %s is available only in the PAID version.","gmwd"), $text);?>
        </div>
    <?php
    }

}

function api_key_notice(){
    echo '<div style="width:99%">
                <div class="error">
                    <p style="font-size:18px;"><strong>'.__("Important. API key is required for Google Maps to work.","gmwd").'</strong></p>
                    <p><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,static_maps_backend,geocoding_backend,roads,street_view_image_backend,geolocation,places_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank" class="wd-btn wd-btn-primary" style="text-decoration:none;">'.__("GET API KEY FOR FREE","gmwd").'</a></p>
                    <p>'.__("For getting API key read more in","gmwd").'
                        <a href="https://web-dorado.com/wordpress-google-maps/installation-wizard-options-menu/configuring-api-key.html" target="_blank" style="color: #00A0D2;">'. __("User Manual","gmwd").'</a>.
                    </p>
                    <p>After creating the API key, please paste it here.</p>
                    <form method="post">
                        '.wp_nonce_field('nonce_gmwd', 'nonce_gmwd').'
                        <p>'.__("API Key","gmwd").' <input type="text" name="gmwd_api_key_general"> <button class="wd-btn wd-btn-primary">'.__("Save","gmwd").'</button></p>
                        <input type="hidden" name="task" value="save_api_key">
                        <input type="hidden" name="page" value="'.GMWDHelper::get("page").'">
                        <input type="hidden" name="step" value="'.GMWDHelper::get("step").'">
                    </form>
                    <p>'.__("It may take up to 5 minutes for API key change to take effect.","gmwd").'</p>
                </div>
          </div>';
}


?>
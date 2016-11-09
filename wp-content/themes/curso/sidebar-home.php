<?php 
	if(is_active_sidebar('sidebar-1')){
	dynamic_sidebar('sidebar-1' );
}

echo do_shortcode('[contact-form-7 id="113" title="Formulário Sidebar"]');
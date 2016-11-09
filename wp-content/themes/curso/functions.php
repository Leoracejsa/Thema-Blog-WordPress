<?php 

//Incluindo nosso customizer
require get_template_directory() . '/inc/customizer.php';


remove_action( 'wp_head', 'wp_generator' );

// Função para carregamento dos scripts
function carrega_scripts(){
	// Enfileirando estilos e scripts próprios
	wp_enqueue_style( 'template', get_template_directory_uri() . '/css/template.css', array(), '1.0', 'all');
	wp_enqueue_script( 'template', get_template_directory_uri(). '/js/template.js', array(), null, true);
	// Enfileirando Bootstrap
	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7', 'all');
	wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true);	
}
add_action( 'wp_enqueue_scripts', 'carrega_scripts' );

// Função para registro de nossos menus
register_nav_menus(
	array(
		'meu_menu_principal' => 'Menu Principal',
		'menu_rodape' => 'Menu Rodapé'
	)
);

// Adicionando suporte ao tema
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('video', 'image'));
add_theme_support('html5', array('search-form'));
add_theme_support('custom-logo', array(
      'width'   =>  200,
      'height'  =>  100,
      ));

// Registrando Sidebars

if (function_exists('register_sidebar')){
	register_sidebar(
      array(
      	'name' => 'Barra Lateral 1',
      	'id'   => 'sidebar-1',
      	'description' => 'Barra lateral da página home',
      	'before_widget'  =>  '<div class="widget-wrapper">',
      	'after_widget'   =>  '</div>',
      	'before_title'   =>  '<h2 class="widget-titulo">',
      	'after_title'    =>  '</h2>',
      	)
	 );

	register_sidebar(
      array(
      	'name' => 'Barra Lateral 2',
      	'id'   => 'sidebar-2',
      	'description' => 'Barra lateral da página blog',
      	'before_widget'  =>  '<div class="widget-wrapper">',
      	'after_widget'   =>  '</div>',
      	'before_title'   =>  '<h2 class="widget-titulo">',
      	'after_title'    =>  '</h2>',
      	)
	 );

      register_sidebar(
      array(
            'name' => 'Redes Sociais',
            'id'   => 'redes-sociais',
            'description' => 'Widgets para redes sociais',
            'before_widget'  =>  '<div class="widget-wrapper">',
            'after_widget'   =>  '</div>',
            'before_title'   =>  '<h2 class="widget-titulo">',
            'after_title'    =>  '</h2>',
            )
       );

}


// Shortcodes

function mostra_telefone(){
      if (wp_is_mobile()){
            $resultado = '<div class="telefone"><p>Ligue agora: <a href="tel:0215555555">0215555555</a></p></div>';
      
      }

      return $resultado;
}

add_shortcode('meutelefone', 'mostra_telefone');
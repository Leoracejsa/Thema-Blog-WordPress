<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'eaducativa02');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@~t%&|B*&Y|3dS8 <S(x/D[A<}JIcs^!g=r`IHI;Z]M]FTF@B2}.6HWi~X2&l-3g');
define('SECURE_AUTH_KEY',  '&w_sG8Bs05R*bj:h^>1ilom>u7gT-=7`M/&{];o+#,.99D0,#@E<O$C&*f)`vGmf');
define('LOGGED_IN_KEY',    'Ct,3lJ{n{G*N>sa%9Hi(CFYkUgaPa~Kbf!etND=G2r0`8 !,Zltv^gWeQGI$?:dJ');
define('NONCE_KEY',        'ql.%HfMA)Z2ZW~]30s-%{d!{)rcrnRb/5#ms[O-;oe4Jv]C0&RfJ=)yp40rVKJhM');
define('AUTH_SALT',        'q{!_%{@#+R#ey8a(5:*pNULyJJ99bD3q1H{4RwW^ZBNB:q%s-$ucw2dlubu :4qP');
define('SECURE_AUTH_SALT', '&!8syUt|hDtp?1@Xp,H H3*)KF+79HjSmF*2<9:%%DPrk._g$}/ -B5sCX,A57g4');
define('LOGGED_IN_SALT',   'N#~u-Z !e1bUD%Rf Ks[h*CZ}xUFlJ%b}D~RY+u3EWianc7ElLKcs5>0DlN6!0r%');
define('NONCE_SALT',       'vHEn}0$ypk%qr*%l3]8,@Y0eQp R.nz UE(#![&hgU6y}IyW_PdD f|/f-EaOgWT');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');

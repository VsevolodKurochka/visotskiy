<?php

/**
 * Plugins connect
 */
require get_template_directory() . '/tgm/connect.php';

/**
 * Visual Composer Init
 */
require get_template_directory() . '/visual_composer/visual_composer_init.php';

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/no-timber.html';
	});
	
	return;
}

show_admin_bar(false);

// function custom_posts_per_page( $query ) {

// 	if ( $query->is_archive() ) {
// 	    set_query_var('posts_per_page', 1);
// 	}
// }
// add_action( 'pre_get_posts', 'custom_posts_per_page' );

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'custom-logo' );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );


		add_action( 'wp_footer', array( $this, 'register_scripts' ) );
		add_filter('upload_mimes', array($this, 'cc_mime_types'), 1, 1);

		$this->add_options_page();
		$this->generate_menu();


		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function register_scripts() {
		wp_enqueue_style( 'css-style', get_stylesheet_uri() );

		wp_enqueue_style( 'css-main', get_template_directory_uri() . '/static/build/css/style.css' );

		//wp_enqueue_script( 'js-libs', get_template_directory_uri() . '/static/build/js/libs.min.js', array('jquery'), '20151215', true );

		//wp_enqueue_script( 'js-jquery', get_template_directory_uri() . '/static/build/js/jquery.main.js', array(), '20151215', true );

		wp_enqueue_script( 'js-vanilla-scripts', get_template_directory_uri() . '/static/build/js/vanilla.main.js', array(), '20151215', true );
	}

	function generate_menu() {
		
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Меню в шапке', 'visotskiy' ),
		) );
	}

	function add_options_page() {
		acf_add_options_page();
	}

	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['pdf'] = 'application/pdf';
		return $mimes;
	}



	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu('menu-1');
		$context['site'] = $this;

		$context['options'] = get_fields('option');
		return $context;
	}


	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();

<?php
class WP_ALLSHARE_SCRIPTS{
	protected static $instance = null;
	
	public function __construct(){
		add_action('wp_enqueue_scripts',array($this,'load_wpallshare_front_scripts'));
	}

	public function load_wpallshare_front_scripts(){
		wp_register_style('wpallshare-default', plugins_url('assets/css/style.css', dirname(__FILE__)) );
		
		wp_register_style('wpallshare-theme1', plugins_url('assets/css/theme-1.css', dirname(__FILE__)), array('wpallshare-default') );
		wp_register_style('wpallshare-theme2', plugins_url('assets/css/theme-2.css', dirname(__FILE__)), array('wpallshare-default') );
		wp_register_style('wpallshare-theme3', plugins_url('assets/css/theme-3.css', dirname(__FILE__)), array('wpallshare-default') );
		wp_register_style('wpallshare-theme4', plugins_url('assets/css/theme-4.css', dirname(__FILE__)), array('wpallshare-default') );
		
		wp_enqueue_script( 'wpallshare-respond', plugins_url('assets/js/respond.min.js', dirname(__FILE__)) );
		wp_script_add_data( 'wpallshare-respond', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'wpallshare-html5shiv',plugins_url('assets/js/html5shiv.js', dirname(__FILE__)) );
		wp_script_add_data( 'wpallshare-html5shiv', 'conditional', 'lt IE 9' );

		wp_register_script( 'wpallshare-trigger', plugins_url('assets/js/wpas-trigger.js', dirname(__FILE__)),array('jquery') );

	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
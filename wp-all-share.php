<?php
/*
Plugin Name: WP All Share
Description: A plugin that shares everything you want
Plugin URI: http://wordpress.org/plugins/wp-all-share
Author: Kanchha Kaji Prajapati
Author URI: http://www.creativekaji.com/
Version: 1.4
License: GPL2
Text Domain: wp_all_share
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('WPALLSHARE_DIR', dirname( __FILE__ ) );

require_once WPALLSHARE_DIR.'/classes/class.wp-all-share.php';
require_once WPALLSHARE_DIR.'/classes/class.scripts.php';
require_once WPALLSHARE_DIR.'/classes/class.shortcodes.php';
require_once WPALLSHARE_DIR.'/classes/class.widgets.php';

add_action( 'plugins_loaded', array('WP_ALLSHARE', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_ALLSHARE_SCRIPTS', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_ALLSHARE_SHORTCODES', 'get_instance' ) );
add_action( 'plugins_loaded', array('WP_ALLSHARE_WIDGETS', 'get_instance' ) );
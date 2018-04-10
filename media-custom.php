<?php
/*
Plugin Name: I Love Coding
Plugin URI: http://vuminhdao.info
Version: 1.0.0
Description: Plugin test
Author: vmdao
*/

if (!defined('ABSPATH')){
	die('Access denied.');
}

add_action( 'plugins_loaded', array( 'MediaCustom', 'get_instance' ) );

class MediaCustom {

	private static $instance;

	/**
	 * Returns an instance of this class. 
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new MediaCustom();
		} 

		return self::$instance;

	} 

	private function __construct() {
		
		add_action( 'admin_init',  array( $this, 'hook_media_custom_columns') );
		add_action( 'admin_print_styles-upload.php',  array( $this, 'custom_style') );
	
	} 


	function hook_media_custom_columns() {
		add_filter( 'manage_media_columns', array( $this, 'custom_name' )  );
		add_action( 'manage_media_custom_column',  array( $this, 'custom_content'), 10, 2 );
	}

	function custom_style() {
		echo '<style>.wp-list-table.media:hover{ background: violet}</style>';
	}

	function custom_name( $cols ) {
        $cols['filename'] = 'Custom Column';
        return $cols;
	}

	function custom_content( $column_name, $id ) {
		$content = '<input type="checkbox" name="isProtected"> Is it protected ? <br>'
					. '<a href="#" onclick="alert(\'Hello World\')">Configure private urls</a>';
		echo $content;
	}
} 


